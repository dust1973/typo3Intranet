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
 * Test case for class \Woehrl\WoehrlForum\Domain\Model\Theme.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class ThemeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlForum\Domain\Model\Theme
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlForum\Domain\Model\Theme();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getGeschlossenReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getGeschlossen()
		);
	}

	/**
	 * @test
	 */
	public function setGeschlossenForBooleanSetsGeschlossen() {
		$this->subject->setGeschlossen(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'geschlossen',
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
	public function getErstelltReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getErstellt()
		);
	}

	/**
	 * @test
	 */
	public function setErstelltForDateTimeSetsErstellt() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setErstellt($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'erstellt',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getWieoftwurdedasThemaangesehenReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getWieoftwurdedasThemaangesehen()
		);
	}

	/**
	 * @test
	 */
	public function setWieoftwurdedasThemaangesehenForIntegerSetsWieoftwurdedasThemaangesehen() {
		$this->subject->setWieoftwurdedasThemaangesehen(12);

		$this->assertAttributeEquals(
			12,
			'wieoftwurdedasThemaangesehen',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnzahlderAnwortenReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getAnzahlderAnworten()
		);
	}

	/**
	 * @test
	 */
	public function setAnzahlderAnwortenForIntegerSetsAnzahlderAnworten() {
		$this->subject->setAnzahlderAnworten(12);

		$this->assertAttributeEquals(
			12,
			'anzahlderAnworten',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getErsteNachrichtReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getErsteNachricht()
		);
	}

	/**
	 * @test
	 */
	public function setErsteNachrichtForStringSetsErsteNachricht() {
		$this->subject->setErsteNachricht('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ersteNachricht',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLetzterNachrichtReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLetzterNachricht()
		);
	}

	/**
	 * @test
	 */
	public function setLetzterNachrichtForStringSetsLetzterNachricht() {
		$this->subject->setLetzterNachricht('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'letzterNachricht',
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
}
