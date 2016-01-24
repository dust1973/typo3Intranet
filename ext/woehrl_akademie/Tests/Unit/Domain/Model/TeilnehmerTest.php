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
 * Test case for class \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class TeilnehmerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getAnredeReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getAnrede()
		);
	}

	/**
	 * @test
	 */
	public function setAnredeForBooleanSetsAnrede() {
		$this->subject->setAnrede(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'anrede',
			$this->subject
		);
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
	public function getFilialeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFiliale()
		);
	}

	/**
	 * @test
	 */
	public function setFilialeForStringSetsFiliale() {
		$this->subject->setFiliale('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'filiale',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPositionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPosition()
		);
	}

	/**
	 * @test
	 */
	public function setPositionForStringSetsPosition() {
		$this->subject->setPosition('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'position',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPersonalNrReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPersonalNr()
		);
	}

	/**
	 * @test
	 */
	public function setPersonalNrForStringSetsPersonalNr() {
		$this->subject->setPersonalNr('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'personalNr',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getKostenstelleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getKostenstelle()
		);
	}

	/**
	 * @test
	 */
	public function setKostenstelleForStringSetsKostenstelle() {
		$this->subject->setKostenstelle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'kostenstelle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTelefonReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTelefon()
		);
	}

	/**
	 * @test
	 */
	public function setTelefonForStringSetsTelefon() {
		$this->subject->setTelefon('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'telefon',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGenehmigtReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getGenehmigt()
		);
	}

	/**
	 * @test
	 */
	public function setGenehmigtForStringSetsGenehmigt() {
		$this->subject->setGenehmigt('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'genehmigt',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmaildesvorgeseztenReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmaildesvorgesezten()
		);
	}

	/**
	 * @test
	 */
	public function setEmaildesvorgeseztenForStringSetsEmaildesvorgesezten() {
		$this->subject->setEmaildesvorgesezten('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'emaildesvorgesezten',
			$this->subject
		);
	}
}
