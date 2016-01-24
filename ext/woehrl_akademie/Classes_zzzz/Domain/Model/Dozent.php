<?php
namespace Woehrl\WoehrlAkademie\Domain\Model;


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
 * Dozent
 */
class Dozent extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * vorname
	 * 
	 * @var string
	 */
	protected $vorname = '';

	/**
	 * nachname
	 * 
	 * @var string
	 */
	protected $nachname = '';

	/**
	 * bild
	 * 
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $bild = NULL;

	/**
	 * beschreibung
	 * 
	 * @var string
	 */
	protected $beschreibung = '';

	/**
	 * Returns the vorname
	 * 
	 * @return string $vorname
	 */
	public function getVorname() {
		return $this->vorname;
	}

	/**
	 * Sets the vorname
	 * 
	 * @param string $vorname
	 * @return void
	 */
	public function setVorname($vorname) {
		$this->vorname = $vorname;
	}

	/**
	 * Returns the nachname
	 * 
	 * @return string $nachname
	 */
	public function getNachname() {
		return $this->nachname;
	}

	/**
	 * Sets the nachname
	 * 
	 * @param string $nachname
	 * @return void
	 */
	public function setNachname($nachname) {
		$this->nachname = $nachname;
	}

	/**
	 * Returns the bild
	 * 
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $bild
	 */
	public function getBild() {
		return $this->bild;
	}

	/**
	 * Sets the bild
	 * 
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $bild
	 * @return void
	 */
	public function setBild(\TYPO3\CMS\Extbase\Domain\Model\FileReference $bild) {
		$this->bild = $bild;
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

}