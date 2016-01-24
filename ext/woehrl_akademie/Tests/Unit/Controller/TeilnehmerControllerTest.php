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
 * Test case for class Woehrl\WoehrlAkademie\Controller\TeilnehmerController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class TeilnehmerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlAkademie\Controller\TeilnehmerController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlAkademie\\Controller\\TeilnehmerController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTeilnehmersFromRepositoryAndAssignsThemToView() {

		$allTeilnehmers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$teilnehmerRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\TeilnehmerRepository', array('findAll'), array(), '', FALSE);
		$teilnehmerRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTeilnehmers));
		$this->inject($this->subject, 'teilnehmerRepository', $teilnehmerRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('teilnehmers', $allTeilnehmers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTeilnehmerToView() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('teilnehmer', $teilnehmer);

		$this->subject->showAction($teilnehmer);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenTeilnehmerToView() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newTeilnehmer', $teilnehmer);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($teilnehmer);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTeilnehmerToTeilnehmerRepository() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();

		$teilnehmerRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\TeilnehmerRepository', array('add'), array(), '', FALSE);
		$teilnehmerRepository->expects($this->once())->method('add')->with($teilnehmer);
		$this->inject($this->subject, 'teilnehmerRepository', $teilnehmerRepository);

		$this->subject->createAction($teilnehmer);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTeilnehmerToView() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('teilnehmer', $teilnehmer);

		$this->subject->editAction($teilnehmer);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTeilnehmerInTeilnehmerRepository() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();

		$teilnehmerRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\TeilnehmerRepository', array('update'), array(), '', FALSE);
		$teilnehmerRepository->expects($this->once())->method('update')->with($teilnehmer);
		$this->inject($this->subject, 'teilnehmerRepository', $teilnehmerRepository);

		$this->subject->updateAction($teilnehmer);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTeilnehmerFromTeilnehmerRepository() {
		$teilnehmer = new \Woehrl\WoehrlAkademie\Domain\Model\Teilnehmer();

		$teilnehmerRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\TeilnehmerRepository', array('remove'), array(), '', FALSE);
		$teilnehmerRepository->expects($this->once())->method('remove')->with($teilnehmer);
		$this->inject($this->subject, 'teilnehmerRepository', $teilnehmerRepository);

		$this->subject->deleteAction($teilnehmer);
	}
}
