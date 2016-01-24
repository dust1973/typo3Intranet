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
 *
 *
 * @package woehrl_seminare
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_WoehrlSeminare_Domain_Model_Discipline extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * Name of the specialists discipline
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * parent
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_WoehrlSeminare_Domain_Model_Discipline>
	 * @lazy
	 */
	protected $parent;

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Adds a Discipline
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Discipline $parent
	 * @return void
	 */
	public function addParent(Tx_WoehrlSeminare_Domain_Model_Discipline $parent) {
		$this->parent->attach($parent);
	}

	/**
	 * Removes a Discipline
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Discipline $parentToRemove The Location to be removed
	 * @return void
	 */
	public function removeParent(Tx_WoehrlSeminare_Domain_Model_Discipline $parentToRemove) {
		$this->parent->detach($parentToRemove);
	}

	/**
	 * Returns the parent
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_WoehrlSeminare_Domain_Model_Discipline> $parent
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Sets the parent
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_WoehrlSeminare_Domain_Model_Discipline> $parent
	 * @return void
	 */
	public function setParent(Tx_Extbase_Persistence_ObjectStorage $parent) {
		$this->parent = $parent;
	}

}
?>
