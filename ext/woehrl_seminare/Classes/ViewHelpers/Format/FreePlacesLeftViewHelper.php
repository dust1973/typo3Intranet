<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, WÖHRL Akademie
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Calculate Free Places
 *

 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @api
 */

class Tx_WoehrlSeminare_ViewHelpers_Format_FreePlacesLeftViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * subscriberRepository
	 *
	 * @var Tx_WoehrlSeminare_Domain_Repository_SubscriberRepository
	 * @inject
	 */
	protected $subscriberRepository;

	/**
	 * Calculate the free places for a given event.
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $event
	 * @return int
 	 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
	 * @api
	 */
	public function render(Tx_WoehrlSeminare_Domain_Model_Event $event = NULL) {

		if ($event != NULL) {
			$free = $event->getMaxSubscriber() - $this->subscriberRepository->countAllByEvent($event);
		} else {
			$free = 0;
		}

		return ($free > 0)? $free : 0;

	}
}
?>
