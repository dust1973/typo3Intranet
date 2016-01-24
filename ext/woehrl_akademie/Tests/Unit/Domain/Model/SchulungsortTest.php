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
 * Test case for class \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class SchulungsortTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitelReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitel()
		);
	}

	/**
	 * @test
	 */
	public function setTitelForStringSetsTitel() {
		$this->subject->setTitel('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'titel',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStrasseReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStrasse()
		);
	}

	/**
	 * @test
	 */
	public function setStrasseForStringSetsStrasse() {
		$this->subject->setStrasse('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'strasse',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPlzReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPlz()
		);
	}

	/**
	 * @test
	 */
	public function setPlzForStringSetsPlz() {
		$this->subject->setPlz('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'plz',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOrtReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getOrt()
		);
	}

	/**
	 * @test
	 */
	public function setOrtForStringSetsOrt() {
		$this->subject->setOrt('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ort',
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
}
