<?php
namespace Woehrl\WoehrlForum\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * Kategorie
 */
class Kategorie extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 * 
	 * @var string
	 */
	protected $name = '';

	/**
	 * beschreibung
	 * 
	 * @var string
	 */
	protected $beschreibung = '';

	/**
	 * Forum-Gruppen die Zugriff auf diese Kategorie haben
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Gruppe>
	 */
	protected $gruppe = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 * 
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->gruppe = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

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
	 * Returns the beschreibung
	 * 
	 * @return string $beschreibung
	 */
	public function getBeschreibung() {
		return $this->beschreibung;
	}

	/**
	 * Sets the beschreibung
	 * 
	 * @param string $beschreibung
	 * @return void
	 */
	public function setBeschreibung($beschreibung) {
		$this->beschreibung = $beschreibung;
	}

	/**
	 * Adds a Gruppe
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe
	 * @return void
	 */
	public function addGruppe(\Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe) {
		$this->gruppe->attach($gruppe);
	}

	/**
	 * Removes a Gruppe
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppeToRemove The Gruppe to be removed
	 * @return void
	 */
	public function removeGruppe(\Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppeToRemove) {
		$this->gruppe->detach($gruppeToRemove);
	}

	/**
	 * Returns the gruppe
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Gruppe> $gruppe
	 */
	public function getGruppe() {
		return $this->gruppe;
	}

	/**
	 * Sets the gruppe
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Gruppe> $gruppe
	 * @return void
	 */
	public function setGruppe(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $gruppe) {
		$this->gruppe = $gruppe;
	}

}