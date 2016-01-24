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
 * Schulungsort
 */
class Schulungsort extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * titel
	 * 
	 * @var string
	 */
	protected $titel = '';

	/**
	 * strasse
	 * 
	 * @var string
	 */
	protected $strasse = '';

	/**
	 * plz
	 * 
	 * @var string
	 */
	protected $plz = '';

	/**
	 * ort
	 * 
	 * @var string
	 */
	protected $ort = '';

	/**
	 * telefon
	 * 
	 * @var string
	 */
	protected $telefon = '';

	/**
	 * Returns the titel
	 * 
	 * @return string $titel
	 */
	public function getTitel() {
		return $this->titel;
	}

	/**
	 * Sets the titel
	 * 
	 * @param string $titel
	 * @return void
	 */
	public function setTitel($titel) {
		$this->titel = $titel;
	}

	/**
	 * Returns the strasse
	 * 
	 * @return string $strasse
	 */
	public function getStrasse() {
		return $this->strasse;
	}

	/**
	 * Sets the strasse
	 * 
	 * @param string $strasse
	 * @return void
	 */
	public function setStrasse($strasse) {
		$this->strasse = $strasse;
	}

	/**
	 * Returns the plz
	 * 
	 * @return string $plz
	 */
	public function getPlz() {
		return $this->plz;
	}

	/**
	 * Sets the plz
	 * 
	 * @param string $plz
	 * @return void
	 */
	public function setPlz($plz) {
		$this->plz = $plz;
	}

	/**
	 * Returns the ort
	 * 
	 * @return string $ort
	 */
	public function getOrt() {
		return $this->ort;
	}

	/**
	 * Sets the ort
	 * 
	 * @param string $ort
	 * @return void
	 */
	public function setOrt($ort) {
		$this->ort = $ort;
	}

	/**
	 * Returns the telefon
	 * 
	 * @return string $telefon
	 */
	public function getTelefon() {
		return $this->telefon;
	}

	/**
	 * Sets the telefon
	 * 
	 * @param string $telefon
	 * @return void
	 */
	public function setTelefon($telefon) {
		$this->telefon = $telefon;
	}

}