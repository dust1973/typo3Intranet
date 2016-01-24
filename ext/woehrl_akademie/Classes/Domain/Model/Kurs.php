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
 * Kurs
 */
class Kurs extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * kursnummer
	 * 
	 * @var string
	 */
	protected $kursnummer = '';

	/**
	 * title
	 * 
	 * @var string
	 */
	protected $title = '';

	/**
	 * kursbeginn
	 * 
	 * @var \DateTime
	 */
	protected $kursbeginn = NULL;

	/**
	 * kursende
	 * 
	 * @var \DateTime
	 */
	protected $kursende = NULL;

	/**
	 * registrierungsbeginn
	 * 
	 * @var \DateTime
	 */
	protected $registrierungsbeginn = NULL;

	/**
	 * registrierungsende
	 * 
	 * @var \DateTime
	 */
	protected $registrierungsende = NULL;

	/**
	 * subtitle
	 * 
	 * @var string
	 */
	protected $subtitle = '';

	/**
	 * bodytext
	 * 
	 * @var string
	 */
	protected $bodytext = '';

	/**
	 * maxTeilnehmerAnzahl
	 * 
	 * @var string
	 */
	protected $maxTeilnehmerAnzahl = '';

	/**
	 * preis
	 * 
	 * @var string
	 */
	protected $preis = '';

	/**
	 * previewImage
	 * 
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $previewImage = NULL;

	/**
	 * files
	 * 
	 * @var string
	 */
	protected $files = '';

	/**
	 * documents
	 * 
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $documents = NULL;

	/**
	 * kursBewertung
	 * 
	 * @var integer
	 */
	protected $kursBewertung = 0;

	/**
	 * Location
	 * 
	 * @var \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort
	 */
	protected $location = NULL;

	/**
	 * Kategorien
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Kategorie>
	 */
	protected $kategorien = NULL;

	/**
	 * Kompetenzen
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Kompetenz>
	 */
	protected $kompetenzen = NULL;

	/**
	 * Zielgruppen
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe>
	 */
	protected $zielgruppen = NULL;

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
		$this->kategorien = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->kompetenzen = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->zielgruppen = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the kursnummer
	 * 
	 * @return string $kursnummer
	 */
	public function getKursnummer() {
		return $this->kursnummer;
	}

	/**
	 * Sets the kursnummer
	 * 
	 * @param string $kursnummer
	 * @return void
	 */
	public function setKursnummer($kursnummer) {
		$this->kursnummer = $kursnummer;
	}

	/**
	 * Returns the title
	 * 
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 * 
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the kursbeginn
	 * 
	 * @return \DateTime $kursbeginn
	 */
	public function getKursbeginn() {
		return $this->kursbeginn;
	}

	/**
	 * Sets the kursbeginn
	 * 
	 * @param \DateTime $kursbeginn
	 * @return void
	 */
	public function setKursbeginn(\DateTime $kursbeginn) {
		$this->kursbeginn = $kursbeginn;
	}

	/**
	 * Returns the kursende
	 * 
	 * @return \DateTime $kursende
	 */
	public function getKursende() {
		return $this->kursende;
	}

	/**
	 * Sets the kursende
	 * 
	 * @param \DateTime $kursende
	 * @return void
	 */
	public function setKursende(\DateTime $kursende) {
		$this->kursende = $kursende;
	}

	/**
	 * Returns the registrierungsbeginn
	 * 
	 * @return \DateTime $registrierungsbeginn
	 */
	public function getRegistrierungsbeginn() {
		return $this->registrierungsbeginn;
	}

	/**
	 * Sets the registrierungsbeginn
	 * 
	 * @param \DateTime $registrierungsbeginn
	 * @return void
	 */
	public function setRegistrierungsbeginn(\DateTime $registrierungsbeginn) {
		$this->registrierungsbeginn = $registrierungsbeginn;
	}

	/**
	 * Returns the registrierungsende
	 * 
	 * @return \DateTime $registrierungsende
	 */
	public function getRegistrierungsende() {
		return $this->registrierungsende;
	}

	/**
	 * Sets the registrierungsende
	 * 
	 * @param \DateTime $registrierungsende
	 * @return void
	 */
	public function setRegistrierungsende(\DateTime $registrierungsende) {
		$this->registrierungsende = $registrierungsende;
	}

	/**
	 * Returns the subtitle
	 * 
	 * @return string $subtitle
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Sets the subtitle
	 * 
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * Returns the bodytext
	 * 
	 * @return string $bodytext
	 */
	public function getBodytext() {
		return $this->bodytext;
	}

	/**
	 * Sets the bodytext
	 * 
	 * @param string $bodytext
	 * @return void
	 */
	public function setBodytext($bodytext) {
		$this->bodytext = $bodytext;
	}

	/**
	 * Returns the maxTeilnehmerAnzahl
	 * 
	 * @return string $maxTeilnehmerAnzahl
	 */
	public function getMaxTeilnehmerAnzahl() {
		return $this->maxTeilnehmerAnzahl;
	}

	/**
	 * Sets the maxTeilnehmerAnzahl
	 * 
	 * @param string $maxTeilnehmerAnzahl
	 * @return void
	 */
	public function setMaxTeilnehmerAnzahl($maxTeilnehmerAnzahl) {
		$this->maxTeilnehmerAnzahl = $maxTeilnehmerAnzahl;
	}

	/**
	 * Returns the preis
	 * 
	 * @return string $preis
	 */
	public function getPreis() {
		return $this->preis;
	}

	/**
	 * Sets the preis
	 * 
	 * @param string $preis
	 * @return void
	 */
	public function setPreis($preis) {
		$this->preis = $preis;
	}

	/**
	 * Returns the previewImage
	 * 
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImage
	 */
	public function getPreviewImage() {
		return $this->previewImage;
	}

	/**
	 * Sets the previewImage
	 * 
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImage
	 * @return void
	 */
	public function setPreviewImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImage) {
		$this->previewImage = $previewImage;
	}

	/**
	 * Returns the files
	 * 
	 * @return string $files
	 */
	public function getFiles() {
		return $this->files;
	}

	/**
	 * Sets the files
	 * 
	 * @param string $files
	 * @return void
	 */
	public function setFiles($files) {
		$this->files = $files;
	}

	/**
	 * Returns the documents
	 * 
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $documents
	 */
	public function getDocuments() {
		return $this->documents;
	}

	/**
	 * Sets the documents
	 * 
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $documents
	 * @return void
	 */
	public function setDocuments(\TYPO3\CMS\Extbase\Domain\Model\FileReference $documents) {
		$this->documents = $documents;
	}

	/**
	 * Returns the kursBewertung
	 * 
	 * @return integer $kursBewertung
	 */
	public function getKursBewertung() {
		return $this->kursBewertung;
	}

	/**
	 * Sets the kursBewertung
	 * 
	 * @param integer $kursBewertung
	 * @return void
	 */
	public function setKursBewertung($kursBewertung) {
		$this->kursBewertung = $kursBewertung;
	}

	/**
	 * Returns the location
	 * 
	 * @return \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort $location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the location
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort $location
	 * @return void
	 */
	public function setLocation(\Woehrl\WoehrlAkademie\Domain\Model\Schulungsort $location) {
		$this->location = $location;
	}

	/**
	 * Adds a Kategorie
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorien
	 * @return void
	 */
	public function addKategorien(\Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorien) {
		$this->kategorien->attach($kategorien);
	}

	/**
	 * Removes a Kategorie
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorienToRemove The Kategorie to be removed
	 * @return void
	 */
	public function removeKategorien(\Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorienToRemove) {
		$this->kategorien->detach($kategorienToRemove);
	}

	/**
	 * Returns the kategorien
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Kategorie> $kategorien
	 */
	public function getKategorien() {
		return $this->kategorien;
	}

	/**
	 * Sets the kategorien
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Kategorie> $kategorien
	 * @return void
	 */
	public function setKategorien(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kategorien) {
		$this->kategorien = $kategorien;
	}

	/**
	 * Adds a Kompetenz
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz $kompetenzen
	 * @return void
	 */
	public function addKompetenzen(\Woehrl\WoehrlAkademie\Domain\Model\Kompetenz $kompetenzen) {
		$this->kompetenzen->attach($kompetenzen);
	}

	/**
	 * Removes a Kompetenz
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz $kompetenzenToRemove The Kompetenz to be removed
	 * @return void
	 */
	public function removeKompetenzen(\Woehrl\WoehrlAkademie\Domain\Model\Kompetenz $kompetenzenToRemove) {
		$this->kompetenzen->detach($kompetenzenToRemove);
	}

	/**
	 * Returns the kompetenzen
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Kompetenz> $kompetenzen
	 */
	public function getKompetenzen() {
		return $this->kompetenzen;
	}

	/**
	 * Sets the kompetenzen
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Kompetenz> $kompetenzen
	 * @return void
	 */
	public function setKompetenzen(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kompetenzen) {
		$this->kompetenzen = $kompetenzen;
	}

	/**
	 * Adds a Zielgruppe
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe $zielgruppen
	 * @return void
	 */
	public function addZielgruppen(\Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe $zielgruppen) {
		$this->zielgruppen->attach($zielgruppen);
	}

	/**
	 * Removes a Zielgruppe
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe $zielgruppenToRemove The Zielgruppe to be removed
	 * @return void
	 */
	public function removeZielgruppen(\Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe $zielgruppenToRemove) {
		$this->zielgruppen->detach($zielgruppenToRemove);
	}

	/**
	 * Returns the zielgruppen
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe> $zielgruppen
	 */
	public function getZielgruppen() {
		return $this->zielgruppen;
	}

	/**
	 * Sets the zielgruppen
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe> $zielgruppen
	 * @return void
	 */
	public function setZielgruppen(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $zielgruppen) {
		$this->zielgruppen = $zielgruppen;
	}

}