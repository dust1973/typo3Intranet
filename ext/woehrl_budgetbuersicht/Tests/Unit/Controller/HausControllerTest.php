<?php
namespace Woehrl\WoehrlBudgetbuersicht\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Alex Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * Test case for class Woehrl\WoehrlBudgetbuersicht\Controller\HausController.
 *
 * @author Alex Fuchs <alexander.fuchs@woehrl.de>
 */
class HausControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlBudgetbuersicht\Controller\HausController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlBudgetbuersicht\\Controller\\HausController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllHausesFromRepositoryAndAssignsThemToView() {

		$allHauses = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$hausRepository = $this->getMock('Woehrl\\WoehrlBudgetbuersicht\\Domain\\Repository\\HausRepository', array('findAll'), array(), '', FALSE);
		$hausRepository->expects($this->once())->method('findAll')->will($this->returnValue($allHauses));
		$this->inject($this->subject, 'hausRepository', $hausRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('hauses', $allHauses);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenHausToView() {
		$haus = new \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newHaus', $haus);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($haus);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenHausToHausRepository() {
		$haus = new \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus();

		$hausRepository = $this->getMock('Woehrl\\WoehrlBudgetbuersicht\\Domain\\Repository\\HausRepository', array('add'), array(), '', FALSE);
		$hausRepository->expects($this->once())->method('add')->with($haus);
		$this->inject($this->subject, 'hausRepository', $hausRepository);

		$this->subject->createAction($haus);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenHausToView() {
		$haus = new \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('haus', $haus);

		$this->subject->editAction($haus);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenHausInHausRepository() {
		$haus = new \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus();

		$hausRepository = $this->getMock('Woehrl\\WoehrlBudgetbuersicht\\Domain\\Repository\\HausRepository', array('update'), array(), '', FALSE);
		$hausRepository->expects($this->once())->method('update')->with($haus);
		$this->inject($this->subject, 'hausRepository', $hausRepository);

		$this->subject->updateAction($haus);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenHausFromHausRepository() {
		$haus = new \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus();

		$hausRepository = $this->getMock('Woehrl\\WoehrlBudgetbuersicht\\Domain\\Repository\\HausRepository', array('remove'), array(), '', FALSE);
		$hausRepository->expects($this->once())->method('remove')->with($haus);
		$this->inject($this->subject, 'hausRepository', $hausRepository);

		$this->subject->deleteAction($haus);
	}
}
