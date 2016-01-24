<?php

namespace Woehrl\WoehrlForum\Tests\Unit\Domain\Model;

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
 * Test case for class \Woehrl\WoehrlForum\Domain\Model\Eintrag.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class EintragTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlForum\Domain\Model\Eintrag
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlForum\Domain\Model\Eintrag();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getAutorReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAutor()
		);
	}

	/**
	 * @test
	 */
	public function setAutorForStringSetsAutor() {
		$this->subject->setAutor('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'autor',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBetreffReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBetreff()
		);
	}

	/**
	 * @test
	 */
	public function setBetreffForStringSetsBetreff() {
		$this->subject->setBetreff('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'betreff',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIPAdresseReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIPAdresse()
		);
	}

	/**
	 * @test
	 */
	public function setIPAdresseForStringSetsIPAdresse() {
		$this->subject->setIPAdresse('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'iPAdresse',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZuletztbearbeitetReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getZuletztbearbeitet()
		);
	}

	/**
	 * @test
	 */
	public function setZuletztbearbeitetForDateTimeSetsZuletztbearbeitet() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setZuletztbearbeitet($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'zuletztbearbeitet',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnzahlderBearbeitungenReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getAnzahlderBearbeitungen()
		);
	}

	/**
	 * @test
	 */
	public function setAnzahlderBearbeitungenForIntegerSetsAnzahlderBearbeitungen() {
		$this->subject->setAnzahlderBearbeitungen(12);

		$this->assertAttributeEquals(
			12,
			'anzahlderBearbeitungen',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNachrichtReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getNachricht()
		);
	}

	/**
	 * @test
	 */
	public function setNachrichtForStringSetsNachricht() {
		$this->subject->setNachricht('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'nachricht',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKategorieReturnsInitialValueForKategorie() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getKategorie()
		);
	}

	/**
	 * @test
	 */
	public function setKategorieForObjectStorageContainingKategorieSetsKategorie() {
		$kategorie = new \Woehrl\WoehrlForum\Domain\Model\Kategorie();
		$objectStorageHoldingExactlyOneKategorie = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneKategorie->attach($kategorie);
		$this->subject->setKategorie($objectStorageHoldingExactlyOneKategorie);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneKategorie,
			'kategorie',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addKategorieToObjectStorageHoldingKategorie() {
		$kategorie = new \Woehrl\WoehrlForum\Domain\Model\Kategorie();
		$kategorieObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$kategorieObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($kategorie));
		$this->inject($this->subject, 'kategorie', $kategorieObjectStorageMock);

		$this->subject->addKategorie($kategorie);
	}

	/**
	 * @test
	 */
	public function removeKategorieFromObjectStorageHoldingKategorie() {
		$kategorie = new \Woehrl\WoehrlForum\Domain\Model\Kategorie();
		$kategorieObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$kategorieObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($kategorie));
		$this->inject($this->subject, 'kategorie', $kategorieObjectStorageMock);

		$this->subject->removeKategorie($kategorie);

	}

	/**
	 * @test
	 */
	public function getThemaReturnsInitialValueForTheme() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getThema()
		);
	}

	/**
	 * @test
	 */
	public function setThemaForObjectStorageContainingThemeSetsThema() {
		$thema = new \Woehrl\WoehrlForum\Domain\Model\Theme();
		$objectStorageHoldingExactlyOneThema = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneThema->attach($thema);
		$this->subject->setThema($objectStorageHoldingExactlyOneThema);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneThema,
			'thema',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addThemaToObjectStorageHoldingThema() {
		$thema = new \Woehrl\WoehrlForum\Domain\Model\Theme();
		$themaObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$themaObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($thema));
		$this->inject($this->subject, 'thema', $themaObjectStorageMock);

		$this->subject->addThema($thema);
	}

	/**
	 * @test
	 */
	public function removeThemaFromObjectStorageHoldingThema() {
		$thema = new \Woehrl\WoehrlForum\Domain\Model\Theme();
		$themaObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$themaObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($thema));
		$this->inject($this->subject, 'thema', $themaObjectStorageMock);

		$this->subject->removeThema($thema);

	}
}
