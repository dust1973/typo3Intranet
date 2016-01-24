<?php
namespace Woehrl\WoehrlLoginstatus\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf  WÖHRL AG
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
 * Status
 */
class Status extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * user
	 * 
	 * @var string
	 */
	protected $user = '';

	/**
	 * Returns the user
	 * 
	 * @return string $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 * 
	 * @param string $user
	 * @return void
	 */
	public function setUser($user) {
		$this->user = $user;
	}

}