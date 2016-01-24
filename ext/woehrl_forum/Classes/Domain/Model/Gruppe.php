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
 * Gruppe
 */
class Gruppe extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * frontendBenutzer
	 * 
	 * @var string
	 */
	protected $frontendBenutzer = '';

	/**
	 * frontendGruppen
	 * 
	 * @var string
	 */
	protected $frontendGruppen = '';

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
	 * Returns the frontendBenutzer
	 * 
	 * @return string $frontendBenutzer
	 */
	public function getFrontendBenutzer() {
		return $this->frontendBenutzer;
	}

	/**
	 * Sets the frontendBenutzer
	 * 
	 * @param string $frontendBenutzer
	 * @return void
	 */
	public function setFrontendBenutzer($frontendBenutzer) {
		$this->frontendBenutzer = $frontendBenutzer;
	}

	/**
	 * Returns the frontendGruppen
	 * 
	 * @return string $frontendGruppen
	 */
	public function getFrontendGruppen() {
		return $this->frontendGruppen;
	}

	/**
	 * Sets the frontendGruppen
	 * 
	 * @param string $frontendGruppen
	 * @return void
	 */
	public function setFrontendGruppen($frontendGruppen) {
		$this->frontendGruppen = $frontendGruppen;
	}

}