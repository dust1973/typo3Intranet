<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
if (!defined ('PATH_typo3conf')) die ('Could not access this script directly!');
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') die('No Ajax request!');

$version = class_exists('t3lib_utility_VersionNumber') ?
t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version) : t3lib_div::int_from_ver(TYPO3_version);
if ($version < 6002000) {
  require_once(PATH_tslib.'class.tslib_pibase.php');
  require_once(PATH_tslib.'class.tslib_fe.php');
  require_once(PATH_t3lib.'class.t3lib_page.php');
}

class tx_myquizpoll_eidstarrating extends tslib_pibase {
    
    var $answerChoiceMax = 6;
        
	function main(){
		$version = class_exists('t3lib_utility_VersionNumber') ?
		t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version) : t3lib_div::int_from_ver(TYPO3_version);

		$this->cObj = t3lib_div::makeInstance('tslib_cObj');
		if ($version < 6002000) {
		  $GLOBALS['TSFE'] = t3lib_div::makeInstance('tslib_fe'); 
		  $GLOBALS['TSFE']->connectToDB();
		  $GLOBALS['TSFE']->initFEuser();
		  $GLOBALS['TSFE']->determineId();
		  $GLOBALS['TSFE']->getCompressedTCarray();
		  $GLOBALS['TSFE']->initTemplate();
		  $GLOBALS['TSFE']->getConfigArray(); 
		  $this->templateCode = $this->cObj->fileResource($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_myquizpoll_pi1.']['templateFile']);
		  $template = $this->cObj->getSubpart($this->templateCode, "###TEMPLATE_STAR_RATING_DETAILS_ITEM###");
		} else {
		  $template = '<div class="tx_myquizpoll_pi1-details_item">###ITEM_ANSWER### <span class="tx_myquizpoll_pi1-details_percent">###ITEM_PERCENT###%</span> <span class="tx_myquizpoll_pi1-details_count">(###ITEM_COUNTS###)</span></div>';
		}
		
		// Initialize FE user object:
		//$feUserObj = tslib_eidtools::initFeUser();
		// Connect to database:
		tslib_eidtools::connectDB();
                
		$qid = intval(t3lib_div::_GET('qid'));
				
        if($qid) {
                
            if ($this->conf['answerChoiceMax'])
    			$this->answerChoiceMax = intval($this->conf['answerChoiceMax']);
    
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				"*",
				"tx_myquizpoll_question",
				"hidden = 0 AND deleted = 0 AND uid = ".$qid,
				"",
				"uid ASC"
			);

            while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
                    $answerNumber = 1;
                    $totalAnswers = 0;
                    while($answerNumber <= $this->answerChoiceMax) {
                        if($row['answer'.$answerNumber])
                            $totalAnswers++;
                        $answerNumber++;
                    }
            }
		
			
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
				"*",
				"tx_myquizpoll_relation",
				"hidden = 0 AND question_id = ".$qid,
				"",
				"uid ASC"
			);
                
                    $totalPoints = 0;
                    while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
                        $answerNumber = 1;
                        while($answerNumber <= $totalAnswers) {
                            if($row['checked'.$answerNumber]) {
                                $stat[$qid]['stars'][$answerNumber] += $row['checked'.$answerNumber];
                                $totalPoints++;
                            }
                            $answerNumber++;
                        }
                    }
		    
                    if($stat) {
                        $answerNumber = 1;
                        while($answerNumber <= $totalAnswers) {
                            $points = ($stat[$qid]['stars'][$answerNumber] ? $stat[$qid]['stars'][$answerNumber] : '0');
                            $percent = number_format($points/$totalPoints*100, 0, ',',' ');
                            $stars = 1;
                            //$resstr .= $qid.' '.$answerNumber.': ';
                            $tempAnswer = '';
                            //$tempAnswer = '<div>';
                            while($stars <= $totalAnswers) {
                                $tempAnswer .= '<input type="radio" name="qid'.$qid.'-answer'.$answerNumber.'" class="star" disabled="disabled" '.($answerNumber == $stars ? 'checked="checked" ' : '').' />';
                                $stars++;
                            }
                            $markerArray["###ITEM_ANSWER###"] = $tempAnswer;
                            $markerArray["###ITEM_PERCENT###"] = $percent;
                            $markerArray["###ITEM_COUNTS###"] = $points;
                            //$tempAnswer .= ' '.$percent.'% ('.$points.')</div>';
                            $resstr .= $this->cObj->substituteMarkerArray($template, $markerArray);
                            //$resstr .= $tempAnswer;
                            $answerNumber++;
                        }
                    }
                }
		
		$resstr = empty($resstr) ? '-1': $resstr;
                
		// and fire ...
		//$ajax_return_data = t3lib_div::array2xml(array('data'=>$resstr));
		$ajax_return_data = $resstr;
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: ' . gmdate( "D, d M Y H:i:s" ) . 'GMT');
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
		header('Content-Length: '.strlen($ajax_return_data));
		//header('Content-Type: text/xml');

		echo $ajax_return_data;
		//echo "id: ".$GLOBALS["TSFE"]->id;
		exit;
	}
}

$output = t3lib_div::makeInstance('tx_myquizpoll_eidstarrating');
$output->main();
?>