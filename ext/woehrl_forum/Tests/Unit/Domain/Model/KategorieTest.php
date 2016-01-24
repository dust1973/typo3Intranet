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
 * Test case for class \Woehrl\WoehrlForum\Domain\Model\Kategorie.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class KategorieTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlForum\Domain\Model\Kategorie
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlForum\Domain\Model\Kategorie();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBeschreibungReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getBeschreibung()
		);
	}

	/**
	 * @test
	 */
	public function setBeschreibungForStringSetsBeschreibung() {
		$this->subject->setBeschreibung('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'beschreibung',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGruppeReturnsInitialValueForGruppe() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getGruppe()
		);
	}

	/**
	 * @test
	 */
	public function setGruppeForObjectStorageContainingGruppeSetsGruppe() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();
		$objectStorageHoldingExactlyOneGruppe = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneGruppe->attach($gruppe);
		$this->subject->setGruppe($objectStorageHoldingExactlyOneGruppe);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneGruppe,
			'gruppe',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addGruppeToObjectStorageHoldingGruppe() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();
		$gruppeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$gruppeObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($gruppe));
		$this->inject($this->subject, 'gruppe', $gruppeObjectStorageMock);

		$this->subject->addGruppe($gruppe);
	}

	/**
	 * @test
	 */
	public function removeGruppeFromObjectStorageHoldingGruppe() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();
		$gruppeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$gruppeObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($gruppe));
		$this->inject($this->subject, 'gruppe', $gruppeObjectStorageMock);

		$this->subject->removeGruppe($gruppe);

	}
}
