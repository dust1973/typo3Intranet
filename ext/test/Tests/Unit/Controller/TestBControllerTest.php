<?php
namespace WOEHRL\Test\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 
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
 * Test case for class WOEHRL\Test\Controller\TestBController.
 *
 */
class TestBControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\Test\Controller\TestBController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\Test\\Controller\\TestBController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTestBsFromRepositoryAndAssignsThemToView() {

		$allTestBs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$testBRepository = $this->getMock('WOEHRL\\Test\\Domain\\Repository\\TestBRepository', array('findAll'), array(), '', FALSE);
		$testBRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTestBs));
		$this->inject($this->subject, 'testBRepository', $testBRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('testBs', $allTestBs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTestBToView() {
		$testB = new \WOEHRL\Test\Domain\Model\TestB();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('testB', $testB);

		$this->subject->showAction($testB);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenTestBToView() {
		$testB = new \WOEHRL\Test\Domain\Model\TestB();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newTestB', $testB);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($testB);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTestBToTestBRepository() {
		$testB = new \WOEHRL\Test\Domain\Model\TestB();

		$testBRepository = $this->getMock('WOEHRL\\Test\\Domain\\Repository\\TestBRepository', array('add'), array(), '', FALSE);
		$testBRepository->expects($this->once())->method('add')->with($testB);
		$this->inject($this->subject, 'testBRepository', $testBRepository);

		$this->subject->createAction($testB);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTestBToView() {
		$testB = new \WOEHRL\Test\Domain\Model\TestB();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('testB', $testB);

		$this->subject->editAction($testB);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTestBInTestBRepository() {
		$testB = new \WOEHRL\Test\Domain\Model\TestB();

		$testBRepository = $this->getMock('WOEHRL\\Test\\Domain\\Repository\\TestBRepository', array('update'), array(), '', FALSE);
		$testBRepository->expects($this->once())->method('update')->with($testB);
		$this->inject($this->subject, 'testBRepository', $testBRepository);

		$this->subject->updateAction($testB);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTestBFromTestBRepository() {
		$testB = new \WOEHRL\Test\Domain\Model\TestB();

		$testBRepository = $this->getMock('WOEHRL\\Test\\Domain\\Repository\\TestBRepository', array('remove'), array(), '', FALSE);
		$testBRepository->expects($this->once())->method('remove')->with($testB);
		$this->inject($this->subject, 'testBRepository', $testBRepository);

		$this->subject->deleteAction($testB);
	}
}
