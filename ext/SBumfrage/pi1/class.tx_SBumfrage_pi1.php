<?php
/***************************************************************
*  Copyright notice
*  
*  (c) 2003 ilypsys ()
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
 * Plugin 'Poll' for the 'umfrage' extension.
 *
 * @author	ilypsys <solidbase@ilypsys.de>
 */


require_once(PATH_tslib."class.tslib_pibase.php");

class tx_SBumfrage_pi1 extends tslib_pibase {
	var $prefixId = "tx_SBumfrage_pi1";		// Same as class name
	var $scriptRelPath = "pi1/class.tx_SBumfrage_pi1.php";	// Path to this script relative to the extension dir.
	var $extKey = "SBumfrage";	// The extension key.
	var $uid    = 0;
	var $arrQ = array();
	
	/**
	 * [Put your description here]
	 */
	function main($content,$conf)	{
                global $_COOKIE,$_GET,$_POST;
                
		$this->LLkey="de";
		$this->conf=$conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		
		
		if (!isset($this->piVars['a']) && isset($this->conf['archive']) && $this->conf['archive']) {
		  $this->piVars['a'] = 1;
		}
		
		$this->conf['strFTimeDate'] = '%d.%m.%Y';
		
		$limitoffset = intval($this->conf['limitoffset']);
        
    if (isset($this->conf['pid']) && intval($this->conf['pid'])>0) {
      $page = intval($this->conf['pid']);
    }
    else {
		  $page = $GLOBALS['TSFE']->id;
    }
		$query = "SELECT * FROM tx_SBumfrage_list ";
		$query .= "WHERE  deleted=0 AND hidden=0 AND (pid='".intval($page)."')";
    $query .= " AND ( (starttime<=".time().") AND (endtime=0 OR endtime>".time().") ".
              "  OR starttime > 0 AND endtime > 0 AND endtime < ".time().")"; 
	  if (intval($this->piVars['uid']) > 0) $query .= ' AND uid='.intval($this->piVars['uid']);
	  $query .= " ORDER BY (endtime > 0 AND endtime < ".time()."), endtime DESC ";
		$query .= " LIMIT $limitoffset,2";
    
        //echo "KEYLIST : <br>$queryKey<br><br>";
        //echo "QUERY : <br>$query<br>";

		$res = mysql(TYPO3_db, $query);
        if  (mysql_num_rows($res)==0 ) {
        	return "";
        }
		echo mysql_error();
		if ($row=mysql_fetch_assoc($res)) {
			$this->uid = $row["uid"];
			$title     = $row["title"];
			$question  = $row["question"];	 
			$answers   = $row["answers"]; 	
			$votes     = $row["votes"];
			$this->arrQ = $row;
		}
	    $ans = array();
	    $ans = $this->_getAnswerList($answers);		
	    /*
	    $ndquery = "SELECT * FROM tx_SBumfrage_list ";
  		$ndquery .= "WHERE  deleted=0 AND hidden=0 AND (pid='".intval($page)."')";
  	  $ndquery .= " AND (starttime > 0 AND endtime > 0 AND endtime <=".time().")";   	    
  	  $ndquery .= " ORDER BY endtime DESC LIMIT 0,1";
  	  $ndres = mysql(TYPO3_db, $ndquery);		  
		  $arrAktQnd =  array();
		  if ($ndres) {
		    $arrAktQnd = mysql_fetch_assoc($ndres);		    
		  }*/
		  		
		if ($res) {
	    $arrAktQnd = mysql_fetch_assoc($res);
	  }
	    
		
		
		if(isset($this->piVars['poll'])) {
	       if($this->conf['cookie']=='yes') {
	         // cookie setzen
	         setcookie ("poll",$question, time()+3600*12); 
	       }  
	       
	       
	       if($_COOKIE["poll"]!=$question || $this->conf['cookie']!='yes') {       
	       	// Votes hochzählen
	         $ans[$this->piVars['poll']][0] +=1;
	       
	         $query = "UPDATE tx_SBumfrage_list SET votes=votes+1 WHERE uid=" . intval($this->uid);
	         $res = mysql(TYPO3_db, $query);
             echo mysql_error();
	       
	         $query = "UPDATE tx_SBumfrage_list SET answers='".$this->_getAnswerString($ans)."' WHERE uid=" . intval($this->uid);
	         $res = mysql(TYPO3_db, $query);
             echo mysql_error();
	       }
	       
	       if ($this->conf["result"]!="") {
	          $content  = $this->_getQuestion($title,$question,$ans);	  
	          $content .= '
	                       <script langauage="javascript">
	                       <!--
	                        window.open("index.php?id='.$this->conf["result"].'&'.$this->prefixId.'[erg]=1&no_cache=1","poll","width=250,height=350");
	                       //-->
	                       </script>
	                     ';  
	       } 
	       else {
	       	  $content = $this->_getResult($title,$question,$ans,$votes); 
	       }	   
	    }
	    else {
	      if(isset($this->piVars['erg'])) {	
	        $content = $this->_getResult($title,$question,$ans,$votes); 
	      } 
	      else {	
		    $content = $this->_getQuestion($title,$question,$ans);		  
	      }
	    }		
			
		if ($this->piVars['a'] == '1') {
		  $content = $this->cObj->substituteSubpart($content,'###SUBPART_POLLLIST_ARCHIVE###',$this->cObj->getSubpart($content,'###SUBPART_POLLLIST_ARCHIVE###'));
		  $content = $this->_parsePollList($content,'###SUBPART_POLLLIST_ROW###'); 
		}
		else {
		  $content = $this->cObj->substituteSubpart($content,'###SUBPART_POLLLIST_ARCHIVE###','');
		}
		
		//if (is_Array($arrAktQnd) && $arrAktQnd['uid'] > 0) {
		  $arrMarker = array(
		  '###LINK_ARCHIVE###' => $this->pi_getPageLink($GLOBALS['TSFE']->id,'',array(
                                                                      		          $this->prefixId.'[erg]' => '1',
                                                                      		          $this->prefixId.'[a]' => '1',
                                                                      		          $this->prefixId.'[uid]' => $arrAktQnd['uid']
                                                                      		          )));
      $content = $this->cObj->substituteMarkerArrayCached($content,$arrMarker);
		//}
		$arrTmpMarker = array();
		$arrTmpMarker["###PID_CURRENT_PAGE###"] = $GLOBALS['TSFE']->id;
		$arrTmpMarker["###LINK_CURRENT_PAGE###"] = $this->pi_getPageLink($GLOBALS['TSFE']->id);
		$content = $this->cObj->substituteMarkerArrayCached($content,$arrTmpMarker);
		return $this->pi_wrapInBaseClass($content);
	}
    
    /**
     * HTML-Ausgabe des Ergebnisses
     *
     */
    function _getResult($title,$question,$ans,$votes) { 
    	global $HTTP_COOKIE_VARS;
    	if ($this->piVars['a'] == '1') {    	  
    	   $this->templateCode = $this->cObj->fileResource($this->conf["tplarchive"]);
    	}
    	else $this->templateCode = $this->cObj->fileResource($this->conf["tplresult"]);
		$tl = array();
	    $tl["total"]   = $this->cObj->getSubpart($this->templateCode,"###TOTAL###");
	    $tl["content"] = $this->cObj->getSubpart($tl["total"],"###CONTENT###");
	    $tl["list"]    = $this->cObj->getSubpart($tl["content"],"###LIST###");
	    
	    
    	
    	foreach ($ans as $item) {
	         $hcent += $item[0];	       
	    }	
	    	    
	    
	    $limitoffset = intval($this->conf['limitoffset']);
	    $page = $GLOBALS['TSFE']->id;
		  $query = "SELECT * FROM tx_SBumfrage_list ";		
		  $query .= "WHERE  deleted=0 AND hidden=0 AND (pid='".intval($page)."')";
		  $query .= " AND uid='".intval($this->piVars['uid'])."' ";
	    $query .= " AND (starttime<=".time().") AND (endtime=0 OR endtime>".time().") "; 	    
	    $query .= " ORDER BY endtime DESC  ";
		  $query .= " LIMIT $limitoffset,1";	   
		  $res = mysql(TYPO3_db, $query);		  
		 
		  $arrAktQ = mysql_fetch_assoc($res);
		  
		  if ($this->uid <> $arrAktQ['uid']) $bArchived = true;
		  else $bArchived = false;
		  
		  
	    
	    for ($i=0;$i<sizeof($ans);$i++) {
		   $marker = array();		   
		   if ($hcent > 0) $marker["###PERCENT###"] = round($ans[$i][0]/($hcent/100));
		   else $marker["###PERCENT###"] = 0;
		   
		   if ($hcent > 0) $marker["###WIDTH###"]   = round(floor($ans[$i][0]/($hcent/100))/3);
		   else $marker['###WIDTH###'] = 0;
		   
		   $marker["###ANSWER###"]  = $ans[$i][1];
		   
		   if ($this->piVars['poll'] == $i) {
		     $tl['total'] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_MYVOTE_'.$i.'###',
		        $this->cObj->getSubpart($tl['total'],'###SUBPART_MYVOTE_'.$i.'###')
		     
		     );
		   }
		   else {
		     $tl['total'] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_MYVOTE_'.$i.'###','');
		   }
		    
		   if ($bArchived && (($this->arrQ['highlightnr']-1) == $i)) {
		     //Highlight
		     $tl['total'] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_ANSWER_NO_HL_'.$i.'###','');
		     $tl['total'] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_ANSWER_HL_'.$i.'###',
		        $this->cObj->getSubpart($tl['total'],'###SUBPART_ANSWER_HL_'.$i.'###')
		     );
		   }
		   else {
		     //No highlight
		     $tl['total'] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_ANSWER_HL_'.$i.'###','');
		     $tl['total'] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_ANSWER_NO_HL_'.$i.'###',
		        $this->cObj->getSubpart($tl['total'],'###SUBPART_ANSWER_NO_HL_'.$i.'###')
		     );
		      
		   }
		   
		   
		   $tl["total"] = $this->cObj->substituteMarkerArrayCached($tl['total'],
		        array(
		          "###VOTELINK_".$i."###" => $this->pi_getPageLink($GLOBALS["TSFE"]->id,'',array($this->prefixId.'[poll]' => $i)),
		          '###PERCENT_'.$i.'###' => $marker['###PERCENT###'],
		          '###WIDTH_'.$i.'###' => $marker['###WIDTH###'],
		          '###RIGHTANSWER###' => $this->arrQ['rightanswer']
		          
		        ));
		   $tl["total"] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_ANSWER_'.$i.'###',$this->cObj->substituteMarkerArrayCached($this->cObj->getSubpart($tl['total'],'###SUBPART_ANSWER_'.$i.'###'),$marker));
		   $content_row .= $this->cObj->substituteMarkerArrayCached($tl['list'],$marker,array(),array());
	    }	
	    $subpart = array();


	    $subpart["###CONTENT###"] = $content_row;
	    	    
	    $marker = array();
	    $marker["###SUM###"]      = intval($hcent);
		$marker["###TITLE###"]    = $title;
		$marker["###QUESTION###"] = $question;
		$output = $this->cObj->substituteMarkerArrayCached($tl["total"],$marker,$subpart,array());	
	    
	    if ($this->conf["tplresult"]=="") {
	    	$output = '<table border="0" cellpadding="1" cellspacing="1">
	    	            <tr bgcolor="#a1a1a1"><td><h1>SBpoll<br>No Template found</h1></td>
	    	            </tr></table>';
	    }	
	        
	    return $output;  
    }	
    
    /**
     * HTML Ausgabe der Frage
     *
     * @access private
     * @param string $title     Titel
     * @param string $question  Frage
     * @param array  $ans       Array mit Antworten und werten
     * @return string $content
     */
    function _getQuestion($title,$question,$ans) {
        $page = $this->pi_getPageLink($GLOBALS["TSFE"]->id);
        
        $page = $this->pi_getPageLink($GLOBALS["TSFE"]->id);

		$this->templateCode = $this->cObj->fileResource($this->conf["tplpoll"]);
				
		$tl = array();
	    $tl["total"]   = $this->cObj->getSubpart($this->templateCode,"###TOTAL###");
	    $tl["content"] = $this->cObj->getSubpart($tl["total"],"###CONTENT###");
	    $tl["list"]    = $this->cObj->getSubpart($tl["content"],"###LIST###");
	    
	    for ($i=0;$i<sizeof($ans);$i++) {
		   $marker = array();
		   $marker["###NAME###"]   = $this->prefixId.'[poll]';
		   $marker["###VALUE###"]  = $i;
		   $marker["###ANSWER###"] = $ans[$i][1];
		   $tl["total"] = $this->cObj->substituteMarkerArrayCached($tl['total'],array("###VOTELINK_".$i."###" => $this->pi_getPageLink($GLOBALS["TSFE"]->id,'',array($this->prefixId.'[poll]' => $i))));
		   $tl["total"] = $this->cObj->substituteSubpart($tl['total'],'###SUBPART_ANSWER_'.$i.'###',$this->cObj->substituteMarkerArrayCached($this->cObj->getSubpart($tl['total'],'###SUBPART_ANSWER_'.$i.'###'),$marker));
		   $content_row .= $this->cObj->substituteMarkerArrayCached($tl['list'],$marker,array(),array());
	    }	
	    $subpart = array();
	    $subpart["###CONTENT###"] = $content_row;

	    $marker = array();
	    //$marker["###PAGE###"]     = $page;
		$marker["###TITLE###"]    = $title;
		$marker["###QUESTION###"] = $question;

	    if ($this->conf["tplpoll"]=="") {
	    	$output = '<table border="0" cellpadding="1" cellspacing="1">
	    	            <tr bgcolor="#a1a1a1"><td><h1>SBpoll<br>No Template found</h1></td>
	    	            </tr></table>';
	    }
	    $para = "";
	    global $_GET;
	    foreach ($_GET as $key => $value) {
	    	if ( !is_array($value) ) {
	    		if ($key!="id") {
	    			$para .= "&".$key.'='.$value;
	    		}    
	    	} else {
	    		$para .= $this->_rollArray($value,$key);	
	    	}	    		    		
	    }	
	    $marker["###PAGE###"]     = $page . $para;  
	    $output = $this->cObj->substituteMarkerArrayCached($tl["total"],$marker,$subpart,array());	
	    return $output;
    } 
    
    
    /**
	* Übertragenes Array ausrollen
	*
	* @access	private
	* @author	Thomas Andress
	*/
	function _rollArray($arr,$k) {
		$s = "";
		foreach($arr as $key => $value) {
			if ( !is_array($value) ) {
				$s .= '&'.$k.'['.$key.']='.htmlentities($value);
        	} else {
            	$s .= $this->_rollArray($value,$k."[".$key."]");	
        	}				
		}			
		return $s;
	}	
    
    
    /**
     * Aufsplitten der Antworten in einem durchnummerierten Feld,
     * das als Wert wieder ein 2 Dim. Feld mit der Anzahl und der
     * Frage enthält.
     *
     * @access private
     * @param string $answers Antworten als String
     * @return array
     */ 
    function _getAnswerList($answers) {
       $ans = array();
       $list = split("\n",$answers);	
	   for ($i=0;$i<sizeof($list);$i++) {
  	     if (preg_match("/\|/",$list[$i])) {
  	       $pair = array();
  	       $pair = split("\|",$list[$i]);
  	       if (strlen(trim($pair[1])) > 0) {
 	           $ans[$i] = array($pair[0],$pair[1],$pair[2]);    	       
 	         }
 	         //$ans[$i] = array($pair[0],$pair[1]);    	       
  	     }
  	     else {
  	       if (!preg_match("/^\s*$/",$list[$i])) {
  	         $ans[$i] = array(0,$list[$i],0); 	
  	       }
  	     }		 
       }		
       return $ans;	
    }  
    
    /**
     * Erstellt aus dem Antwort Feld einen String der in der
     * Datenbank gespeichert werden kann.
     * 
     * @access private
     * @param array $ans
     * @return string
     */  
    function _getAnswerString($ans) {
       for ($i=0;$i<sizeof($ans);$i++) {
         $str .= $ans[$i][0] . "|" . $ans[$i][1] . "|" . $ans[$i][2]. "\n";
       }   
       return $str;
    }	

    function _parsePollList($strTemplate,$strSubpart) {
      $page = $GLOBALS['TSFE']->id;
  		$query = "SELECT * FROM tx_SBumfrage_list ";
  		$query .= "WHERE  deleted=0 AND hidden=0 AND (pid='".intval($page)."')";
  	    $query .= " AND (starttime > 0 AND endtime > 0 AND endtime <=".time().")";   	    
  	  $query .= " ORDER BY endtime DESC";
  	  if ($this->conf['intLimitPollList'] > 0) $query .= ' LIMIT 0,'.$this->conf['intLimitPollList'];
  
      $strTmp = '';
      $strSP = $this->cObj->getSubpart($strTemplate,$strSubpart);
            
  		$res = mysql(TYPO3_db, $query);
  		$isFirst = false;
  		while ($res && ($arrRow = mysql_fetch_assoc($res))) {
  		  if ($isFirst) $isFirst = false;
  		  else {
  		  
    		  $arrMarker = array();
    		  
    		  foreach ($arrRow as $fKey=>$fVal) {
    		    $arrMarker['###STR_'.strtoupper($fKey).'###'] = $fVal;
    		  }
    		  $arrMarker['###STR_STARTTIME###'] = strftime($this->conf['strFTimeDate'],$arrMarker['###STR_STARTTIME###']);
    		  $arrMarker['###LINK_QUESTION###'] = $this->pi_getPageLink($GLOBALS['TSFE']->id,'',array($this->prefixId.'[a]' => '1',$this->prefixId.'[uid]' => $arrRow['uid'],$this->prefixId.'[erg]' => 1));  		  
    		  $strTmp .= $this->cObj->substituteMarkerArrayCached($strSP,$arrMarker);
    		}
  		}
  		$strTemplate = $this->cObj->substituteSubpart($strTemplate,$strSubpart,$strTmp);
      
      return $strTemplate;
    }

}

if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/SBumfrage/pi1/class.tx_SBumfrage_pi1.php"])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/SBumfrage/pi1/class.tx_SBumfrage_pi1.php"]);
}

?>