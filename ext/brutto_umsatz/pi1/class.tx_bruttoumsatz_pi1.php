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

if (!class_exists('tslib_pibase')) require_once(PATH_tslib . 'class.tslib_pibase.php');


/**
 * Plugin 'Brutto-Umsatz' for the 'brutto_umsatz' extension.
 *
 * @author	Fuchs, Alexander <Alexander.Fuchs@woehrl.de>
 * @package	TYPO3
 * @subpackage	tx_bruttoumsatz
 */
class tx_bruttoumsatz_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_bruttoumsatz_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_bruttoumsatz_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'brutto_umsatz';	// The extension key.
	var $pi_checkCHash = true;
	
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
		
		$cache = 0;
		$this->pi_USER_INT_obj = 1;
		
		// Get the template
		$this->templateHtml = $this->cObj->fileResource('EXT:brutto_umsatz/template.html');
		//echo t3lib_div::debug($this->templateHtml, 'arrCourses');
		// Extract subparts from the template
		$subpart = $this->cObj->getSubpart($this->templateHtml, '###TEMPLATE###');
		  
		// Fill marker array
		$result = $this->getUmsatz();
		$markerArray['###MARKER1###'] = $result['umsatz'];
		//echo t3lib_div::debug($result, 'arrCourses');
		$markerArray['###MARKER2###'] = $result['sum'];
		 
		// Create the content by replacing the content markers in the template
		$content = $this->cObj->substituteMarkerArrayCached($subpart, $markerArray);
		
	/*
		$content='
			<strong>This is a few paragraphs:</strong><br />
			<p>This is line 1</p>
			<p>This is line 2</p>
	
			<h3>This is a form:</h3>
			<form action="'.$this->pi_getPageLink($GLOBALS['TSFE']->id).'" method="POST">
				<input type="text" name="'.$this->prefixId.'[input_field]" value="'.htmlspecialchars($this->piVars['input_field']).'">
				<input type="submit" name="'.$this->prefixId.'[submit_button]" value="'.htmlspecialchars($this->pi_getLL('submit_button_label')).'">
			</form>
			<br />
			<p>You can click here to '.$this->pi_linkToPage('get to this page again',$GLOBALS['TSFE']->id).'</p>
		';
	*/
		return $this->pi_wrapInBaseClass($content);
	}
	
	function getUmsatz(){
		
		$select = '
		monat,
		   laufend_w
		  ,vorjahr_w
		  ,prozent_zu_vj_w
		  ,laufend_s
		  ,vorjahr_s
		  ,prozent_zu_vj_s
		  ,prozent_zu_vj
		';
		
		$where = ' deleted=0 AND hidden = 0 ' ;
		

		$res=$GLOBALS['TYPO3_DB']->exec_SELECTquery(
             $select,   #select
             'tx_bruttoumsatz_woehrl', #from
             $where,  #where
             $groupBy='',
             $orderBy=''
		);
			$laufend_w = 0;
			$vorjahr_w = 0;
			$laufend_s = 0;
			$vorjahr_s = 0;
			$sum_prozent_zu_vj_w = 0;
		
		while( 
		$row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
			

			if($row['prozent_zu_vj_w'] < 0){
				$row_prozent_zu_vj_w = '<span style="color:#D43F3A;"><span class="glyphicon glyphicon-arrow-down"></span>'.$row['prozent_zu_vj_w'].' %</span>';
			}else{
				$row_prozent_zu_vj_w = '<span style="color:green;"><span class="glyphicon glyphicon glyphicon-arrow-up"></span>'.$row['prozent_zu_vj_w'].' % </span>';
			}
			
			if($row['prozent_zu_vj_s'] < 0){
				$row_prozent_zu_vj_s = '<span style="color:#D43F3A;"><span class="glyphicon glyphicon-arrow-down"></span>'.$row['prozent_zu_vj_s'].' %</span>';
			}else{
				$row_prozent_zu_vj_s = '<span style="color:green;"><span class="glyphicon glyphicon glyphicon-arrow-up"></span>'.$row['prozent_zu_vj_s'].' % </span>';
			}
			
			if( number_format ($row['prozent_zu_vj'], 2, ',', '.') < 0){
				$row_prozent_zu_vj = '<span style="color:#D43F3A;"><span class="glyphicon glyphicon-arrow-down"></span>'.number_format ( $row['prozent_zu_vj'], 2, ',', '.').' %</span>';
			}else{
				$row_prozent_zu_vj = '<span style="color:green;"><span class="glyphicon glyphicon glyphicon-arrow-up"></span>'.number_format ( $row['prozent_zu_vj'], 2, ',', '.').' % </span>';
			}
			
		$umsatz .='
			<tr>
					<td class="col spa">'.$row['monat'].'</td>
					<td class="col zahl">'.number_format($row['laufend_w'],2,',','.').' Tsd. €</td>
					<td class="col zahl">'.number_format($row['vorjahr_w'],2,',','.').' Tsd. €</td>
					<td class="col">'.$row_prozent_zu_vj_w.'</td>
					<td class="col spa">'.$row['monat'].'</td>
					<td class="col zahl">'.number_format($row['laufend_s'],2,',','.').' Tsd. €</td>
					<td class="col zahl">'.number_format($row['vorjahr_s'],2,',','.').' Tsd. €</td>
					<td class="col">'.$row_prozent_zu_vj_s.'</td>
					<td class="col">'.$row_prozent_zu_vj.'</td>
			</tr>';
			$laufend_w = $laufend_w + $row['laufend_w'];
			$vorjahr_w = $vorjahr_w + $row['vorjahr_w'];
			$laufend_s = $laufend_s + $row['laufend_s'];
			$vorjahr_s = $vorjahr_s + $row['vorjahr_s'];


		}
		
		$sum = '<tr>
					<td class="col spa">Summe</td>
					<td class="col zahl" style="background-color:#fff;"><i>'.number_format($laufend_w,2,',','.').' Tsd. €</i></td>
					<td class="col zahl" style="background-color:#fff;"><i>'.number_format($vorjahr_w,2,',','.').' Tsd. €</i></td>
					<td class="col"></td>
					<td class="col spa">Summe</td>
					<td class="col zahl" style="background-color:#fff;"><i>'.number_format($laufend_s,2,',','.').' Tsd. €</i></td>
					<td class="col zahl" style="background-color:#fff;"><i>'.number_format($vorjahr_s,2,',','.').' Tsd. €</i></td>
					<td class="col">&nbsp;</td>
					<td class="col">&nbsp;</td>
			</tr>';
		$rueckgabe['umsatz'] = $umsatz;
		$rueckgabe['sum'] = $sum;
		
		return  $rueckgabe;
	}
	
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/brutto_umsatz/pi1/class.tx_bruttoumsatz_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/brutto_umsatz/pi1/class.tx_bruttoumsatz_pi1.php']);
}

?>