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
 * Theme
 */
class Theme extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * geschlossen
	 * 
	 * @var boolean
	 */
	protected $geschlossen = FALSE;

	/**
	 * betreff
	 * 
	 * @var string
	 */
	protected $betreff = '';

	/**
	 * autor
	 * 
	 * @var string
	 */
	protected $autor = '';

	/**
	 * erstellt
	 * 
	 * @var \DateTime
	 */
	protected $erstellt = NULL;

	/**
	 * wieoftwurdedasThemaangesehen
	 * 
	 * @var integer
	 */
	protected $wieoftwurdedasThemaangesehen = 0;

	/**
	 * anzahlderAnworten
	 * 
	 * @var integer
	 */
	protected $anzahlderAnworten = 0;

	/**
	 * ersteNachricht
	 * 
	 * @var string
	 */
	protected $ersteNachricht = '';

	/**
	 * letzterNachricht
	 * 
	 * @var string
	 */
	protected $letzterNachricht = '';

	/**
	 * kategorie
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlForum\Domain\Model\Kategorie>
	 */
	protected $kategorie = NULL;

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
	}

	/**
	 * Returns the geschlossen
	 * 
	 * @return boolean $geschlossen
	 */
	public function getGeschlossen() {
		return $this->geschlossen;
	}

	/**
	 * Sets the geschlossen
	 * 
	 * @param boolean $geschlossen
	 * @return void
	 */
	public function setGeschlossen($geschlossen) {
		$this->geschlossen = $geschlossen;
	}

	/**
	 * Returns the boolean state of geschlossen
	 * 
	 * @return boolean
	 */
	public function isGeschlossen() {
		return $this->geschlossen;
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
	 * Returns the erstellt
	 * 
	 * @return \DateTime $erstellt
	 */
	public function getErstellt() {
		return $this->erstellt;
	}

	/**
	 * Sets the erstellt
	 * 
	 * @param \DateTime $erstellt
	 * @return void
	 */
	public function setErstellt(\DateTime $erstellt) {
		$this->erstellt = $erstellt;
	}

	/**
	 * Returns the wieoftwurdedasThemaangesehen
	 * 
	 * @return integer $wieoftwurdedasThemaangesehen
	 */
	public function getWieoftwurdedasThemaangesehen() {
		return $this->wieoftwurdedasThemaangesehen;
	}

	/**
	 * Sets the wieoftwurdedasThemaangesehen
	 * 
	 * @param integer $wieoftwurdedasThemaangesehen
	 * @return void
	 */
	public function setWieoftwurdedasThemaangesehen($wieoftwurdedasThemaangesehen) {
		$this->wieoftwurdedasThemaangesehen = $wieoftwurdedasThemaangesehen;
	}

	/**
	 * Returns the anzahlderAnworten
	 * 
	 * @return integer $anzahlderAnworten
	 */
	public function getAnzahlderAnworten() {
		return $this->anzahlderAnworten;
	}

	/**
	 * Sets the anzahlderAnworten
	 * 
	 * @param integer $anzahlderAnworten
	 * @return void
	 */
	public function setAnzahlderAnworten($anzahlderAnworten) {
		$this->anzahlderAnworten = $anzahlderAnworten;
	}

	/**
	 * Returns the ersteNachricht
	 * 
	 * @return string $ersteNachricht
	 */
	public function getErsteNachricht() {
		return $this->ersteNachricht;
	}

	/**
	 * Sets the ersteNachricht
	 * 
	 * @param string $ersteNachricht
	 * @return void
	 */
	public function setErsteNachricht($ersteNachricht) {
		$this->ersteNachricht = $ersteNachricht;
	}

	/**
	 * Returns the letzterNachricht
	 * 
	 * @return string $letzterNachricht
	 */
	public function getLetzterNachricht() {
		return $this->letzterNachricht;
	}

	/**
	 * Sets the letzterNachricht
	 * 
	 * @param string $letzterNachricht
	 * @return void
	 */
	public function setLetzterNachricht($letzterNachricht) {
		$this->letzterNachricht = $letzterNachricht;
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

}