<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>
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
 * This hook extends the tcemain class.
 * It preselects the author field with the current be_user id.
 *
 * @author	Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class Tx_WoehrlSeminare_Slots_Tceforms {

	function getMainFields_preProcess($table, &$row, $tceform) {

		if ($table == 'tx_woehrlseminare_domain_model_event') {
			global $TCA;
			t3lib_div::loadTCA('tx_woehrlseminare_domain_model_event');

			if ($row['author'] == 0 || empty($row['author']))
				$row['author'] = $GLOBALS['BE_USER']->user['uid'];

			if (empty($row['contact_name']))
				$row['contact_name'] = $GLOBALS['BE_USER']->user['realName'];

			if (empty($row['contact_email']))
				$row['contact_email'] = $GLOBALS['BE_USER']->user['email'];

			if (empty($row['end_date_time_select']) && empty($row['end_date_time']))
					$row['end_date_time_select'] = 60;

			if (empty($row['sub_end_date_time_select']) && empty($row['sub_end_date_time']))
					$row['sub_end_date_time_select'] = 1440;

		}
	}

	function getSingleField_preProcess($table, $field, &$row, $altName, $palette, $extra, $pal, &$pObj) {

		if ($table == 'tx_woehrlseminare_domain_model_event') {

			// bugfix for TYPO3 < 6.1
			if (t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version) <  '6001000') {
				if ($row['location'] == 0)
					$row['location'] = '';
			}

		}

	}
}
