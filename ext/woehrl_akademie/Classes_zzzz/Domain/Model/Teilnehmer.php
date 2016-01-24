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
 * Teilnehmer
 */
class Teilnehmer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * anrede
	 * 
	 * @var boolean
	 */
	protected $anrede = FALSE;

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
	 * filiale
	 * 
	 * @var string
	 */
	protected $filiale = '';

	/**
	 * position
	 * 
	 * @var string
	 */
	protected $position = '';

	/**
	 * personalNr
	 * 
	 * @var string
	 */
	protected $personalNr = '';

	/**
	 * kostenstelle
	 * 
	 * @var string
	 */
	protected $kostenstelle = '';

	/**
	 * email
	 * 
	 * @var string
	 */
	protected $email = '';

	/**
	 * telefon
	 * 
	 * @var string
	 */
	protected $telefon = '';

	/**
	 * genehmigt
	 * 
	 * @var string
	 */
	protected $genehmigt = '';

	/**
	 * emaildesvorgesezten
	 * 
	 * @var string
	 */
	protected $emaildesvorgesezten = '';

	/**
	 * Returns the anrede
	 * 
	 * @return boolean $anrede
	 */
	public function getAnrede() {
		return $this->anrede;
	}

	/**
	 * Sets the anrede
	 * 
	 * @param boolean $anrede
	 * @return void
	 */
	public function setAnrede($anrede) {
		$this->anrede = $anrede;
	}

	/**
	 * Returns the boolean state of anrede
	 * 
	 * @return boolean
	 */
	public function isAnrede() {
		return $this->anrede;
	}

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
	 * Returns the filiale
	 * 
	 * @return string $filiale
	 */
	public function getFiliale() {
		return $this->filiale;
	}

	/**
	 * Sets the filiale
	 * 
	 * @param string $filiale
	 * @return void
	 */
	public function setFiliale($filiale) {
		$this->filiale = $filiale;
	}

	/**
	 * Returns the position
	 * 
	 * @return string $position
	 */
	public function getPosition() {
		return $this->position;
	}

	/**
	 * Sets the position
	 * 
	 * @param string $position
	 * @return void
	 */
	public function setPosition($position) {
		$this->position = $position;
	}

	/**
	 * Returns the personalNr
	 * 
	 * @return string $personalNr
	 */
	public function getPersonalNr() {
		return $this->personalNr;
	}

	/**
	 * Sets the personalNr
	 * 
	 * @param string $personalNr
	 * @return void
	 */
	public function setPersonalNr($personalNr) {
		$this->personalNr = $personalNr;
	}

	/**
	 * Returns the kostenstelle
	 * 
	 * @return string $kostenstelle
	 */
	public function getKostenstelle() {
		return $this->kostenstelle;
	}

	/**
	 * Sets the kostenstelle
	 * 
	 * @param string $kostenstelle
	 * @return void
	 */
	public function setKostenstelle($kostenstelle) {
		$this->kostenstelle = $kostenstelle;
	}

	/**
	 * Returns the email
	 * 
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 * 
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
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

	/**
	 * Returns the genehmigt
	 * 
	 * @return string $genehmigt
	 */
	public function getGenehmigt() {
		return $this->genehmigt;
	}

	/**
	 * Sets the genehmigt
	 * 
	 * @param string $genehmigt
	 * @return void
	 */
	public function setGenehmigt($genehmigt) {
		$this->genehmigt = $genehmigt;
	}

	/**
	 * Returns the emaildesvorgesezten
	 * 
	 * @return string $emaildesvorgesezten
	 */
	public function getEmaildesvorgesezten() {
		return $this->emaildesvorgesezten;
	}

	/**
	 * Sets the emaildesvorgesezten
	 * 
	 * @param string $emaildesvorgesezten
	 * @return void
	 */
	public function setEmaildesvorgesezten($emaildesvorgesezten) {
		$this->emaildesvorgesezten = $emaildesvorgesezten;
	}

}