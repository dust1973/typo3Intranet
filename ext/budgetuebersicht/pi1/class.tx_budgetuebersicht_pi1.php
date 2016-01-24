<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Fuchs, Alexander <Alexander.Fuchs@woehrl.de>
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
 * Plugin 'Budgetübersicht' for the 'budgetuebersicht' extension.
 *
 * @author	Fuchs, Alexander <Alexander.Fuchs@woehrl.de>
 * @package	TYPO3
 * @subpackage	tx_budgetuebersicht
 */
class tx_budgetuebersicht_pi1 extends tslib_pibase {
	var $prefixId = 'tx_budgetuebersicht_pi1';
	// Same as class name
	var $scriptRelPath = 'pi1/class.tx_budgetuebersicht_pi1.php';
	// Path to this script relative to the extension dir.
	var $extKey = 'budgetuebersicht';
	// The extension key.
	var $pi_checkCHash = true;

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this -> conf = $conf;
		//echo t3lib_div::debug($this -> conf['listUid'] ,'arrCourses');
		$GLOBALS['TSFE']->set_no_cache();
		$this -> pi_setPiVarDefaults();
		$this -> pi_loadLL();
		$this -> pi_initPIflexForm();
		// Einmal am Anfang der main-Funktion
		$haus = $this -> pi_getFFvalue($this -> cObj -> data['pi_flexform'], 'haus');
		$maxBudget = $this -> pi_getFFvalue($this -> cObj -> data['pi_flexform'], 'budget');
		
		if(!isset($maxBudget)){
			$maxBudget=0;
		}

		//echo t3lib_div::debug($haus);
		
		//$alletermine = $this::alleTermineHolen();
		//$kostenstellen = $this::alleKostenstenlleHolen();
		$kosten = $this::KostenstenlleNachNRHolen($haus);

		//echo t3lib_div::debug($kosten);
		
				/*print '<pre>';
					print_r ($kosten);
					print '<pre>';
					die;
	*/
		
		$uid_group = $GLOBALS['TSFE'] -> fe_user -> groupData['uid'];
		$listUid = $this -> conf['listUid'] = 338;
		$singleUid = $this -> conf['singleUid'] = 339;
		if ($GLOBALS[TSFE] -> id == $listUid) {
		//if(1==1){

			$content .= '<table class="table table-striped" style="margin-bottom:0;"><tr>
			<td><b>Kostenstelle</b></td>
			<td width="70%"><b>Wert der aufgelaufenen Seminarbuchungen</b></td>
			
			<td><b>Soll-Budget</b></td>
			<td><b>Verbliebene Budget</b></td>
			<td><b>Anzeigen</b></td>';

			$cost = 0;
			if($kosten){
			foreach ($kosten as $kostenstelle) {
				$cost = $kostenstelle['cost'] + $cost;
			}
			$i = 0;


					$Verbliebene_Budget = $maxBudget - $cost;
					$hgcolor = '';
					if($Verbliebene_Budget < 0){
						$hgcolor = ' class="danger" ';
					}else{
						$hgcolor = ' class="success" ';
					}
				$content .= '<tr '.$hgcolor.'>';
				$content .= '<td><p>' . $haus . '</p></td><td><p>' . number_format($cost,2,',','.') . ' €</p></td>
				<td><p>' . number_format($maxBudget,2,',','.') . ' €</p></td>
				<td><p>'
				. number_format($Verbliebene_Budget,2,',','.'). ' €</p></td><td><p><a href="index.php?id='.$singleUid.'&kostenstelle=' . $haus . '" title="Anzeigen" style="text-align:center;display:block;width:100%;height:100%;" class="ajax" >
			<span class="glyphicon glyphicon-eye-open"></span>
			</a>
			</p></td>';

				$content .= '</tr>';
				//$i = $i + 1;
			//}
			}else{
				$content .= '<tr><td><p>' . $haus . '</p></td>
				
				<td><p>0,00 €</p></td>
				<td><p>' . number_format($maxBudget,2,',','.'). ' €</p></td>
				<td><p>' . number_format($maxBudget,2,',','.') . ' </p></td>
				<td><p></p></td></tr>';
				
			}
			$content .= '</table>';

		} elseif ($GLOBALS[TSFE] -> id == $singleUid) {
			$content .= '<table class="table table-hover">
				<tr><th><b>Kostenstelle</b></th><th><b>Seminar</b></th><th><b>Preis</b></th>
		<th><b>Vorname, Name</b></th><th><b>ID</b></th>
		
		<th><b>E-Mail</b></th>';
			$nr = $_GET['kostenstelle'];

			//$abfrage = $this::alleKostenstenlleHolen();
			$abfrage = $this::KostenstenlleNachNRHolen($nr);
			//TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($abfrage);
			//echo t3lib_div::debug($abfrage);
			//$abfrage = $this::KostenstenlleNachNRHolen($nr);
			$doppeltenvermeiden = array();
			$summe = 0;
			foreach ($abfrage as $abfrag) {

				//if (!in_array($abfrag['uid_participant'] . $abfrag['uid_event'], $doppeltenvermeiden)) {

					//$doppeltenvermeiden[] = $abfrag['uid_participant'] . $abfrag['uid_event'];
					if ($abfrag['kostenstelle'] == $nr) {

						$summe += $abfrag['cost'];
						//$data_participant = $this::participantNachId($abfrag['uid_participant']);
						//$data_event = $this::eventNachId($abfrag['uid_event']);
						//$event_participants = true;
						$content .= '<tr><td><p>' . $abfrag['kostenstelle'] . '</p></td><td width="75%"><p>' . $abfrag['eventtitle'] . '</p></td><td><p>' . $abfrag['cost'] . '</p></td>
								<td><p>' . $abfrag['vorname'] . ' ' . $abfrag['name'] . '</p></td><td><p>' . $abfrag['uid'] .'</p></td>
								
								<td><p>' . $abfrag['email'] . '</p></td></tr>';
					}
				//}

			}
			$content .= '<tr><td>&nbsp;</td><td>&nbsp;</td><td width="200" style="padding:5px;"> <b>Summe:</b> ' . $summe . ' €</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
			$content .= '</table>';
			$content .= "<h4><a class='btn btn-default' href='index.php?id=".$listUid."&no_cache=1'>Zur&uuml;ck</a></h4>";
		}

		return $this -> pi_wrapInBaseClass($content);
	}


	function KostenstenlleNachNRHolen($nr) {
		$where = " kostenstelle = '" . $nr . "'";
		//t3lib_utility_Debug::debugInPopUpWindow($where, ' Kostenstelle ');
		//die;
		# SELECT-Abfrage
		//$res = $GLOBALS['TYPO3_DB'] -> exec_SELECTquery('kostenstelle, cost, hausnr ,uid_event, uid_participant', 'tx_abcourses_kostenstelle_cost_mm', $where, '', '');
		
		$res = $GLOBALS['TYPO3_DB'] -> sql_query("
		SELECT uid,kostenstelle, preis as cost, haus as hausnr, eventtitle, vorname, name, email
FROM tx_woehrlseminare_domain_model_kostenstelle
WHERE  hidden= 0 AND deleted = 0 AND kostenstelle LIKE '" . $nr . "'
 ORDER BY kostenstelle ASC");
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($res);
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($res);
		//die;
			# Liefert eine Integer zurück mit der Anzahl der betroffenen Datenzeilen
		if (!$GLOBALS['TYPO3_DB'] -> sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB'] -> sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB'] -> sql_fetch_assoc($res)) {
					$result[]=$data;

				}

				return $result;
			} else {
				$this -> arrStatus[] = 'Query returns no data';
				return 0;
			}
		} else {
			$this -> fError = 1;
			$this -> arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listCategorys.';
			$this -> arrStatus[] = $GLOBALS['TYPO3_DB'] -> debug();
			return 0;
		}

	}



}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/budgetuebersicht/pi1/class.tx_budgetuebersicht_pi1.php']) {
	include_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/budgetuebersicht/pi1/class.tx_budgetuebersicht_pi1.php']);
}
?>