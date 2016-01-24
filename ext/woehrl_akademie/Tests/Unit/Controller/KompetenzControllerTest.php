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
 * Test case for class Woehrl\WoehrlAkademie\Controller\KompetenzController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class KompetenzControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlAkademie\Controller\KompetenzController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlAkademie\\Controller\\KompetenzController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllKompetenzsFromRepositoryAndAssignsThemToView() {

		$allKompetenzs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$kompetenzRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KompetenzRepository', array('findAll'), array(), '', FALSE);
		$kompetenzRepository->expects($this->once())->method('findAll')->will($this->returnValue($allKompetenzs));
		$this->inject($this->subject, 'kompetenzRepository', $kompetenzRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('kompetenzs', $allKompetenzs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenKompetenzToView() {
		$kompetenz = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('kompetenz', $kompetenz);

		$this->subject->showAction($kompetenz);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenKompetenzToView() {
		$kompetenz = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newKompetenz', $kompetenz);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($kompetenz);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenKompetenzToKompetenzRepository() {
		$kompetenz = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();

		$kompetenzRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KompetenzRepository', array('add'), array(), '', FALSE);
		$kompetenzRepository->expects($this->once())->method('add')->with($kompetenz);
		$this->inject($this->subject, 'kompetenzRepository', $kompetenzRepository);

		$this->subject->createAction($kompetenz);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenKompetenzToView() {
		$kompetenz = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('kompetenz', $kompetenz);

		$this->subject->editAction($kompetenz);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenKompetenzInKompetenzRepository() {
		$kompetenz = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();

		$kompetenzRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KompetenzRepository', array('update'), array(), '', FALSE);
		$kompetenzRepository->expects($this->once())->method('update')->with($kompetenz);
		$this->inject($this->subject, 'kompetenzRepository', $kompetenzRepository);

		$this->subject->updateAction($kompetenz);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenKompetenzFromKompetenzRepository() {
		$kompetenz = new \Woehrl\WoehrlAkademie\Domain\Model\Kompetenz();

		$kompetenzRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KompetenzRepository', array('remove'), array(), '', FALSE);
		$kompetenzRepository->expects($this->once())->method('remove')->with($kompetenz);
		$this->inject($this->subject, 'kompetenzRepository', $kompetenzRepository);

		$this->subject->deleteAction($kompetenz);
	}
}
