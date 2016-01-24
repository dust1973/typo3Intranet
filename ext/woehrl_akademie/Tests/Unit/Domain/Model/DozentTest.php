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
 * Test case for class \Woehrl\WoehrlAkademie\Domain\Model\Dozent.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class DozentTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlAkademie\Domain\Model\Dozent
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getVornameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getVorname()
		);
	}

	/**
	 * @test
	 */
	public function setVornameForStringSetsVorname() {
		$this->subject->setVorname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'vorname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNachnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getNachname()
		);
	}

	/**
	 * @test
	 */
	public function setNachnameForStringSetsNachname() {
		$this->subject->setNachname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'nachname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBildReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getBild()
		);
	}

	/**
	 * @test
	 */
	public function setBildForFileReferenceSetsBild() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setBild($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'bild',
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
}
