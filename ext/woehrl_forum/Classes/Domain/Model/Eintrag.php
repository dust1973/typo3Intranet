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
 * Eintrag
 */
class Eintrag extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * autor
	 * 
	 * @var string
	 */
	protected $autor = '';

	/**
	 * betreff
	 * 
	 * @var string
	 */
	protected $betreff = '';

	/**
	 * iPAdresse
	 * 
	 * @var string
	 */
	protected $iPAdresse = '';

	/**
	 * zuletztbearbeitet
	 * 
	 * @var \DateTime
	 */
	protected $zuletztbearbeitet = NULL;

	/**
	 * anzahlderBearbeitungen
	 * 
	 * @var integer
	 */
	protected $anzahlderBearbeitungen = 0;

	/**
	 * nachricht
	 * 
	 * @var string
	 */
	protected $nachricht = '';

	/**
	 * kategorie
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Kategorie>
	 */
	protected $kategorie = NULL;

	/**
	 * thema
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Theme>
	 */
	protected $thema = NULL;

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
		$this->kategorie = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->thema = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the autor
	 * 
	 * @return string $autor
	 */
	public function getAutor() {
		return $this->autor;
	}

	/**
	 * Sets the autor
	 * 
	 * @param string $autor
	 * @return void
	 */
	public function setAutor($autor) {
		$this->autor = $autor;
	}

	/**
	 * Returns the betreff
	 * 
	 * @return string $betreff
	 */
	public function getBetreff() {
		return $this->betreff;
	}

	/**
	 * Sets the betreff
	 * 
	 * @param string $betreff
	 * @return void
	 */
	public function setBetreff($betreff) {
		$this->betreff = $betreff;
	}

	/**
	 * Returns the iPAdresse
	 * 
	 * @return string $iPAdresse
	 */
	public function getIPAdresse() {
		return $this->iPAdresse;
	}

	/**
	 * Sets the iPAdresse
	 * 
	 * @param string $iPAdresse
	 * @return void
	 */
	public function setIPAdresse($iPAdresse) {
		$this->iPAdresse = $iPAdresse;
	}

	/**
	 * Returns the zuletztbearbeitet
	 * 
	 * @return \DateTime $zuletztbearbeitet
	 */
	public function getZuletztbearbeitet() {
		return $this->zuletztbearbeitet;
	}

	/**
	 * Sets the zuletztbearbeitet
	 * 
	 * @param \DateTime $zuletztbearbeitet
	 * @return void
	 */
	public function setZuletztbearbeitet(\DateTime $zuletztbearbeitet) {
		$this->zuletztbearbeitet = $zuletztbearbeitet;
	}

	/**
	 * Returns the anzahlderBearbeitungen
	 * 
	 * @return integer $anzahlderBearbeitungen
	 */
	public function getAnzahlderBearbeitungen() {
		return $this->anzahlderBearbeitungen;
	}

	/**
	 * Sets the anzahlderBearbeitungen
	 * 
	 * @param integer $anzahlderBearbeitungen
	 * @return void
	 */
	public function setAnzahlderBearbeitungen($anzahlderBearbeitungen) {
		$this->anzahlderBearbeitungen = $anzahlderBearbeitungen;
	}

	/**
	 * Returns the nachricht
	 * 
	 * @return string $nachricht
	 */
	public function getNachricht() {
		return $this->nachricht;
	}

	/**
	 * Sets the nachricht
	 * 
	 * @param string $nachricht
	 * @return void
	 */
	public function setNachricht($nachricht) {
		$this->nachricht = $nachricht;
	}

	/**
	 * Adds a Kategorie
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Kategorie $kategorie
	 * @return void
	 */
	public function addKategorie(\Woehrl\WoehrlForum\Domain\Model\Kategorie $kategorie) {
		$this->kategorie->attach($kategorie);
	}

	/**
	 * Removes a Kategorie
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Kategorie $kategorieToRemove The Kategorie to be removed
	 * @return void
	 */
	public function removeKategorie(\Woehrl\WoehrlForum\Domain\Model\Kategorie $kategorieToRemove) {
		$this->kategorie->detach($kategorieToRemove);
	}

	/**
	 * Returns the kategorie
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Kategorie> $kategorie
	 */
	public function getKategorie() {
		return $this->kategorie;
	}

	/**
	 * Sets the kategorie
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Kategorie> $kategorie
	 * @return void
	 */
	public function setKategorie(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kategorie) {
		$this->kategorie = $kategorie;
	}

	/**
	 * Adds a Theme
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Theme $thema
	 * @return void
	 */
	public function addThema(\Woehrl\WoehrlForum\Domain\Model\Theme $thema) {
		$this->thema->attach($thema);
	}

	/**
	 * Removes a Theme
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Theme $themaToRemove The Theme to be removed
	 * @return void
	 */
	public function removeThema(\Woehrl\WoehrlForum\Domain\Model\Theme $themaToRemove) {
		$this->thema->detach($themaToRemove);
	}

	/**
	 * Returns the thema
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Theme> $thema
	 */
	public function getThema() {
		return $this->thema;
	}

	/**
	 * Sets the thema
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Theme> $thema
	 * @return void
	 */
	public function setThema(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $thema) {
		$this->thema = $thema;
	}

}