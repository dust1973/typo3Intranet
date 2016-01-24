<?php

namespace Woehrl\WoehrlAkademie\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Woehrl\WoehrlAkademie\Domain\Model\Kurs.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class KursTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlAkademie\Domain\Model\Kurs
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlAkademie\Domain\Model\Kurs();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getKursnummerReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getKursnummer()
		);
	}

	/**
	 * @test
	 */
	public function setKursnummerForStringSetsKursnummer() {
		$this->subject->setKursnummer('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'kursnummer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKursbeginnReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getKursbeginn()
		);
	}

	/**
	 * @test
	 */
	public function setKursbeginnForDateTimeSetsKursbeginn() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setKursbeginn($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'kursbeginn',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKursendeReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getKursende()
		);
	}

	/**
	 * @test
	 */
	public function setKursendeForDateTimeSetsKursende() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setKursende($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'kursende',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRegistrierungsbeginnReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getRegistrierungsbeginn()
		);
	}

	/**
	 * @test
	 */
	public function setRegistrierungsbeginnForDateTimeSetsRegistrierungsbeginn() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setRegistrierungsbeginn($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'registrierungsbeginn',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRegistrierungsendeReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getRegistrierungsende()
		);
	}

	/**
	 * @test
	 */
	public function setRegistrierungsendeForDateTimeSetsRegistrierungsende() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setRegistrierungsende($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'registrierungsende',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSubtitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSubtitle()
		);
	}

	/**
	 * @test
	 */
	public function setSubtitleForStringSetsSubtitle() {
		$this->subject->setSubtitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'subtitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBodytextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBodytext()
		);
	}

	/**
	 * @test
	 */
	public function setBodytextForStringSetsBodytext() {
		$this->subject->setBodytext('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'bodytext',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMaxTeilnehmerAnzahlReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMaxTeilnehmerAnzahl()
		);
	}

	/**
	 * @test
	 */
	public function setMaxTeilnehmerAnzahlForStringSetsMaxTeilnehmerAnzahl() {
		$this->subject->setMaxTeilnehmerAnzahl('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'maxTeilnehmerAnzahl',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPreisReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPreis()
		);
	}

	/**
	 * @test
	 */
	public function setPreisForStringSetsPreis() {
		$this->subject->setPreis('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'preis',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPreviewImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getPreviewImage()
		);
	}

	/**
	 * @test
	 */
	public function setPreviewImageForFileReferenceSetsPreviewImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setPreviewImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'previewImage',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFilesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFiles()
		);
	}

	/**
	 * @test
	 */
	public function setFilesForStringSetsFiles() {
		$this->subject->setFiles('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'files',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDocumentsReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getDocuments()
		);
	}

	/**
	 * @test
	 */
	public function setDocumentsForFileReferenceSetsDocuments() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setDocuments($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'documents',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKursBewertungReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getKursBewertung()
		);
	}

	/**
	 * @test
	 */
	public function setKursBewertungForIntegerSetsKursBewertung() {
		$this->subject->setKursBewertung(12);

		$this->assertAttributeEquals(
			12,
			'kursBewertung',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForSchulungsort() {
		$this->assertEquals(
			NULL,
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForSchulungsortSetsLocation() {
		$locationFixture = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();
		$this->subject->setLocation($locationFixture);

		$this->assertAttributeEquals(
			$locationFixture,
			'location',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKategorienReturnsInitialValueForKategorie() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getKategorien()
		);
	}

	/**
	 * @test
	 */
	public function setKategorienForObjectStorageContainingKategorieSetsKategorien() {
		$kategorien = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();
		$objectStorageHoldingExactlyOneKategorien = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneKategorien->attach($kategorien);
		$this->subject->setKategorien($objectStorageHoldingExactlyOneKategorien);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneKategorien,
			'kategorien',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addKategorienToObjectStorageHoldingKategorien() {
		$kategorien = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();
		$kategorienObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$kategorienObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($kategorien));
		$this->inject($this->subject, 'kategorien', $kategorienObjectStorageMock);

		$this->subject->addKategorien($kategorien);
	}

	/**
	 * @test
	 */
	public function removeKategorienFromObjectStorageHoldingKategorien() {
		$kategorien = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();
		$kategorienObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$kategorienObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($kategorien));
		$this->inject($this->subject, 'kategorien', $kategorienObjectStorageMock);

		$this->subject->removeKategorien($kategorien);

	}

	/**
	 * @test
	 */
	public function getKompetenzenReturnsInitialValueForKompetenz() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getKompetenzen()
		);
	}

	/**
	 * @test
	 */
	public function setKompetenzenForObjectStorageContainingKompetenzSetsKompetenzen() {
		$kompetenzen = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();
		$objectStorageHoldingExactlyOneKompetenzen = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneKompetenzen->attach($kompetenzen);
		$this->subject->setKompetenzen($objectStorageHoldingExactlyOneKompetenzen);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneKompetenzen,
			'kompetenzen',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addKompetenzenToObjectStorageHoldingKompetenzen() {
		$kompetenzen = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();
		$kompetenzenObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$kompetenzenObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($kompetenzen));
		$this->inject($this->subject, 'kompetenzen', $kompetenzenObjectStorageMock);

		$this->subject->addKompetenzen($kompetenzen);
	}

	/**
	 * @test
	 */
	public function removeKompetenzenFromObjectStorageHoldingKompetenzen() {
		$kompetenzen = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();
		$kompetenzenObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$kompetenzenObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($kompetenzen));
		$this->inject($this->subject, 'kompetenzen', $kompetenzenObjectStorageMock);

		$this->subject->removeKompetenzen($kompetenzen);

	}

	/**
	 * @test
	 */
	public function getZielgruppenReturnsInitialValueForZielgruppe() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getZielgruppen()
		);
	}

	/**
	 * @test
	 */
	public function setZielgruppenForObjectStorageContainingZielgruppeSetsZielgruppen() {
		$zielgruppen = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();
		$objectStorageHoldingExactlyOneZielgruppen = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneZielgruppen->attach($zielgruppen);
		$this->subject->setZielgruppen($objectStorageHoldingExactlyOneZielgruppen);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneZielgruppen,
			'zielgruppen',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addZielgruppenToObjectStorageHoldingZielgruppen() {
		$zielgruppen = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();
		$zielgruppenObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$zielgruppenObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($zielgruppen));
		$this->inject($this->subject, 'zielgruppen', $zielgruppenObjectStorageMock);

		$this->subject->addZielgruppen($zielgruppen);
	}

	/**
	 * @test
	 */
	public function removeZielgruppenFromObjectStorageHoldingZielgruppen() {
		$zielgruppen = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();
		$zielgruppenObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$zielgruppenObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($zielgruppen));
		$this->inject($this->subject, 'zielgruppen', $zielgruppenObjectStorageMock);

		$this->subject->removeZielgruppen($zielgruppen);

	}

	/**
	 * @test
	 */
	public function getTeilnehmerReturnsInitialValueForTeilnehmer() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getTeilnehmer()
		);
	}

	/**
	 * @test
	 */
	public function setTeilnehmerForObjectStorageContainingTeilnehmerSetsTeilnehmer() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();
		$objectStorageHoldingExactlyOneTeilnehmer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneTeilnehmer->attach($teilnehmer);
		$this->subject->setTeilnehmer($objectStorageHoldingExactlyOneTeilnehmer);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneTeilnehmer,
			'teilnehmer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addTeilnehmerToObjectStorageHoldingTeilnehmer() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();
		$teilnehmerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$teilnehmerObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($teilnehmer));
		$this->inject($this->subject, 'teilnehmer', $teilnehmerObjectStorageMock);

		$this->subject->addTeilnehmer($teilnehmer);
	}

	/**
	 * @test
	 */
	public function removeTeilnehmerFromObjectStorageHoldingTeilnehmer() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();
		$teilnehmerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$teilnehmerObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($teilnehmer));
		$this->inject($this->subject, 'teilnehmer', $teilnehmerObjectStorageMock);

		$this->subject->removeTeilnehmer($teilnehmer);

	}

	/**
	 * @test
	 */
	public function getDozentReturnsInitialValueForDozent() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDozent()
		);
	}

	/**
	 * @test
	 */
	public function setDozentForObjectStorageContainingDozentSetsDozent() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();
		$objectStorageHoldingExactlyOneDozent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDozent->attach($dozent);
		$this->subject->setDozent($objectStorageHoldingExactlyOneDozent);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDozent,
			'dozent',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDozentToObjectStorageHoldingDozent() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();
		$dozentObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$dozentObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($dozent));
		$this->inject($this->subject, 'dozent', $dozentObjectStorageMock);

		$this->subject->addDozent($dozent);
	}

	/**
	 * @test
	 */
	public function removeDozentFromObjectStorageHoldingDozent() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();
		$dozentObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$dozentObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($dozent));
		$this->inject($this->subject, 'dozent', $dozentObjectStorageMock);

		$this->subject->removeDozent($dozent);

	}
}
