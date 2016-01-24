<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2014 Fuchs, Alexander <Alexander.Fuchs@woehrl.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

//require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'smspasscode' for the 'smspasscode' extension.
 *
 * @author	Fuchs, Alexander <Alexander.Fuchs@woehrl.de>
 * @package	TYPO3
 * @subpackage	tx_smspasscode
 */
class tx_smspasscode_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_smspasscode_pi1';		// Same as class name
	//var $scriptRelPath = 'pi1/class.tx_smspasscode_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'smspasscode';	// The extension key.
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		$this->pi_USER_INT_obj = 1;	// Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!
		$useruid = $GLOBALS['TSFE']->fe_user->user['uid'];
		$username = $GLOBALS['TSFE']->fe_user->user['username'];
		
		// verwenden von ldap bind
		$ldaprdn  = 'zentrale-woehrl\svc_typo3';     // ldap rdn oder dn
		$ldappass = 'qRh92WdZFBAvxwTO9zch';  // entsprechendes password

		// verbinden zum ldap server
		$ldapconn = ldap_connect("ldap://dc1:389")
		or die("Keine Verbindung zum LDAP server möglich.");
		
		//var_dump(checkNTUser($ldaprdn,$ldappass));
		
		
		$ds=$ldapconn;
		ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
		$r=ldap_bind($ds, $ldaprdn, $ldappass);
		$dn = 'OU=Benutzer,OU=Woehrl,DC=zentrale-woehrl,DC=de';
		$filter="(samaccountname=$username)";
		$justthese = array( "samaccountname","displayname","mail","extensionAttribute1");
		$sr = ldap_search($ds, $dn, $filter,$justthese);
		$info = ldap_get_entries($ds, $sr);
		
		$status = '';
		if($info['count'] == 0 OR $info == NULL){
			$extensionattribute1 ='';
		}else{
		//print '<pre>';
		//print_r ($info);
		//print '<pre>';
			$extensionattribute1 = $info[0]['extensionattribute1'][0];
		  //$pattern = "/^(\+[0-9]{2}|0+[0-9]{0}).+[\d\s\/\(\)-]/";
			  $pattern = "/^(\+[0-9]{2})/";
			  if (preg_match ($pattern, $extensionattribute1, $hit)){
				$extensionattribute1 = substr($extensionattribute1,3);
			  }

		  }
		 
		if($this->piVars['submit_button']){
		
			if($this->piVars['extensionattribute1']){
				 $prefix = substr($extensionattribute1,0,3);
				 $pattern = "/^(\+49[0-9]{0}|49[0-9]{0}|.+[_a-z\s\/\(\)-])/";
				if (!preg_match ($pattern, $this->piVars['extensionattribute1'], $hit)){

				

				$altenummer = $extensionattribute1;
	
				
				

				/**************************************************/
				if($altenummer == (trim(htmlspecialchars($this->piVars['extensionattribute1'])))){
					$extensionattribute1 = trim(htmlspecialchars($this->piVars['extensionattribute1']));
					$extensionattribute1 = $extensionattribute1 *= 1;
					$status = '<p style="color:red;">Ihre Telefonnummer wurde nicht ge&auml;ndert.</p>';
				}else{
					$extensionattribute1 = trim(htmlspecialchars($this->piVars['extensionattribute1']));
					$extensionattribute1 = $extensionattribute1 *= 1;
					if($dn){
						$dn = $info[0]['dn'];
					   $userdata=array('extensionattribute1'=>'+49'.$extensionattribute1);
						if($return = ldap_modify($ds, $dn, $userdata)){
							$status =	'<p>Ihre Telefonnummer wurde erfolgreich ge&auml;ndert:<br />
							Alte Telefonnummer: '.$altenummer.'<br />
							<b>Neue Telefonnummer: +49'.$extensionattribute1.'</b></p>';
						}else{
							$extensionattribute1 = $info[0]['extensionattribute1'][0];
							$status = '<p style="color:red;">Es ist ein Fehler aufgetreten versuchen sie es sp&auml;ter erneut</p>';
					}
				}else{
					print 'DN = NULL';
				}
			
				}
				
				/*******************************************/
			
				}else{
					$status = '<p style="color:red;">Es ist ein Fehler aufgetreten. Die Nummer enth&auml;lt nicht erlaubte Zeichen: <b>' . $hit[0] . '</b></p>';	
				}
			
			}
		
	
		}
		ldap_close($ds);
		$content='
			
			<p>&nbsp</p>
			<p>Die Ihnen zugeordnete Telefonnummer ist <span style="font-size:16px;"><span class="glyphicon glyphicon-earphone"></span> <b>+49<span style="color:#333;">'.$extensionattribute1.'</span></b></span><br /> Standardm&auml;ssig erhalten Sie den Einmalpasscode an diese Telefonnummer.<br />
			Bitte geben Sie Ihre Telefonnummer ein. Folgendes Format ist zul&auml;ssig: +491522563843</p>
			<form class="form-inline" action="'.$this->pi_getPageLink($GLOBALS['TSFE']->id).'" method="POST">
<div class="form-group">
				<label for="Telefonnummer">Telefonnummer:</label>
<div class="input-group">
 <div class="input-group-addon">+49</div>
				<input type="text"  class="form-control" name="'.$this->prefixId.'[extensionattribute1]" value="'.$extensionattribute1.'" maxlength="15">
	    </div>
  </div>
  				<div>
				<br><input type="submit"  class="btn btn-primary" name="'.$this->prefixId.'[submit_button]" value="Speichern">
				<input type="reset"  class="btn btn-primary"  name="'.$this->prefixId.'[reset_button]" value="Zur&uuml;cksetzen">
				</div>
			</form>
	
			<br />'.$status.'
		';
	
		return $this->pi_wrapInBaseClass($content);
	}
	
	function checkNTUser ($username,$passwort)
	{
	$ldapserver = 'ldap://dc1:389';
	$ds=ldap_connect($ldapserver);
	if ($ds)
    {
      $dn="cn=$username,cn=Users, DC=zentrale-woehrl, DC=de";
      $r=@ldap_bind($ds,$dn,$passwort); 
       if ($r)
        {
          return true;
        }
       else
        {
          return false;
        }
     }
	}
	
	function TelnummerValidieren ($tel)
	{
		$pattern = "/^(\+[0-9]{2,2}|4+[0-9]{2,15})/";
		if (preg_match ($pattern, $tel, $hit))
		{
			//print '<pre>';
			//print_r ($hit);
			//print '</pre>';
			return $hit;
							
		}
	
		
	
	}
	
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/smspasscode/pi1/class.tx_smspasscode_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/smspasscode/pi1/class.tx_smspasscode_pi1.php']);
}

?>