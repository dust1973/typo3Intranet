<?php
namespace Woehrl\WoehrlAkademie\Tests\Unit\Controller;
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
 * Test case for class Woehrl\WoehrlAkademie\Controller\KursController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class KursControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlAkademie\Controller\KursController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlAkademie\\Controller\\KursController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllKurssFromRepositoryAndAssignsThemToView() {

		$allKurss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$kursRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KursRepository', array('findAll'), array(), '', FALSE);
		$kursRepository->expects($this->once())->method('findAll')->will($this->returnValue($allKurss));
		$this->inject($this->subject, 'kursRepository', $kursRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('kurss', $allKurss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenKursToView() {
		$kurs = new \Woehrl\WoehrlAkademie\Domain\Model\Kurs();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('kurs', $kurs);

		$this->subject->showAction($kurs);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenKursToView() {
		$kurs = new \Woehrl\WoehrlAkademie\Domain\Model\Kurs();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newKurs', $kurs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($kurs);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenKursToKursRepository() {
		$kurs = new \Woehrl\WoehrlAkademie\Domain\Model\Kurs();

		$kursRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KursRepository', array('add'), array(), '', FALSE);
		$kursRepository->expects($this->once())->method('add')->with($kurs);
		$this->inject($this->subject, 'kursRepository', $kursRepository);

		$this->subject->createAction($kurs);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenKursToView() {
		$kurs = new \Woehrl\WoehrlAkademie\Domain\Model\Kurs();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('kurs', $kurs);

		$this->subject->editAction($kurs);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenKursInKursRepository() {
		$kurs = new \Woehrl\WoehrlAkademie\Domain\Model\Kurs();

		$kursRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KursRepository', array('update'), array(), '', FALSE);
		$kursRepository->expects($this->once())->method('update')->with($kurs);
		$this->inject($this->subject, 'kursRepository', $kursRepository);

		$this->subject->updateAction($kurs);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenKursFromKursRepository() {
		$kurs = new \Woehrl\WoehrlAkademie\Domain\Model\Kurs();

		$kursRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KursRepository', array('remove'), array(), '', FALSE);
		$kursRepository->expects($this->once())->method('remove')->with($kurs);
		$this->inject($this->subject, 'kursRepository', $kursRepository);

		$this->subject->deleteAction($kurs);
	}
}
