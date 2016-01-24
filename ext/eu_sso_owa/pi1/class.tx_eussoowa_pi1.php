<?php
/***************************************************************
*  Copyright notice
*  
*  (c) 2002 Norman Seibert (seibert@eumedia.de)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is 
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
 * Plugin 'OWA-SSO' for the 'eu_sso_owa' extension.
 *
 * @author	Norman Seibert <seibert@entios.de>
 */

define('KEY_FILE','d:/inetpub/owa_key.php');
require_once(KEY_FILE);

require_once(PATH_tslib.'class.tslib_pibase.php');

class tx_eussoowa_pi1 extends tslib_pibase {
	var $prefixId = 'tx_eussoowa_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_eussoowa_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey = 'eu_sso_owa';	// The extension key.
	
	var $cObj;
	
	var $url;
	var $path;
	
	function encrypt($key, $message) {
		static $mcrypt_deinit;
		if (extension_loaded('mcrypt')) {
            $this->_srand();
            $td = @mcrypt_module_open(MCRYPT_GOST, '', MCRYPT_MODE_ECB, '');
            if ($td) {
                $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
                @mcrypt_generic_init($td, $key, $iv);
                $encrypted_data = mcrypt_generic($td, $message);

                if (!isset($mcrypt_deinit)) {
                    $mcrypt_deinit = function_exists('mcrypt_generic_deinit');
                }

                if ($mcrypt_deinit) {
                    mcrypt_generic_deinit($td);
                } else {
                    mcrypt_generic_end($td);
                }

                return $encrypted_data;
            }
        }
	}

    /**
     * Return a secret key, either from a cookie, or if the cookie
     * isn't there, assume we are using a munged version of a known
     * base value.
     *
     * @access public
     *
     * @param optional string $keyname  The name of the key to get.
     *
     * @return string  The secret key.
     */
    function getKey($keyname = 'generic') {
        if (array_key_exists($keyname . '_key', $_COOKIE)) {
			return $_COOKIE[$keyname . '_key'];
		} else {
			return $GLOBALS['TSFE']->fe_user->user['ses_id'];
		}
    }
	
	function _srand() {
        static $initialized;

        if (empty($initialized)) {
            mt_srand((double)microtime() * 1000000);
            $initialized = true;
        }
    }
	
	function main($content,$conf)	{
	
		global $ssokey;
		
		$this->conf=$conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		
		$GLOBALS['TSFE']->set_no_cache();
		
		if ($GLOBALS['TSFE']->fe_user->user['uid']) {
			$t3_user = $this->conf['domain'].'\\'.$GLOBALS['TSFE']->fe_user->user['username'];
			if ($GLOBALS['TSFE']->fe_user->sesData['password']) {
				$t3_pwd = $GLOBALS['TSFE']->fe_user->sesData['password'];
			} else {
				$t3_pwd = $this->encrypt($GLOBALS['TSFE']->fe_user->user['ses_id'], $GLOBALS['TSFE']->fe_user->user['password']);
			}
		}
		
		$host = $this->conf['host'];
		$wg_path = $this->conf['wg_path'];
		
		$key1 = time().$GLOBALS['TSFE']->fe_user->user['ses_id'];

		$url = $host.'/'.$wg_path.'/eu_sso.php?init=';
		
		$arrparam = Array();
		
		$arrparam['t3_sessionid'] = $GLOBALS['TSFE']->fe_user->user['ses_id'];
		$arrparam['webgrab_path'] = $host.'/exchweb/bin/auth/owaauth.dll';
		$arrparam['tstamp'] = time();
		$arrparam['key1'] = $key1;
		$arrparam['destination'] = $host.'/exchange/';
		$arrparam['referer'] = $host.'/exchweb/bin/auth/owalogon.asp';
		
		$arrparam['username'] = $t3_user;
		$arrparam['pwd_field'] = 'password';
		$arrparam['pwd_content'] = $t3_pwd;
		$arrparam['SubmitCreds'] = 'Log On';
		$arrparam['flags'] = '4';
		$querystring = base64_encode($this->encrypt($ssokey, serialize($arrparam)));
		unset($arrparam);
		
		$ch = curl_init ();
		//Session Optionen setzen
		//debug($url.$querystring); die();
		curl_setopt ($ch, CURLOPT_URL, $url.$querystring);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	
		//Ausführen der Aktionen
		curl_exec ($ch);
	
		$content = curl_close ($ch);
		
		$url = $host.'/'.$wg_path.'/eu_sso.php?call=';
		$arrparam['userkey'] = $this->encrypt($key1, $this->getKey());
		$arrparam['t3_sessionid'] = $GLOBALS['TSFE']->fe_user->user['ses_id'];
		$querystring = base64_encode($this->encrypt($ssokey, serialize($arrparam)));
		header("HTTP/1.1 302 Moved Temporarily\r\n");
		header("Location: ".$url.$querystring."\r\n");
		header("Content-Length:0\r\n");
		
		$content = 'dummy';

		return $this->pi_wrapInBaseClass($content);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/eu_sso_owa/pi1/class.tx_eussoowa_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/eu_sso_owa/pi1/class.tx_eussoowa_pi1.php']);
}

?>
