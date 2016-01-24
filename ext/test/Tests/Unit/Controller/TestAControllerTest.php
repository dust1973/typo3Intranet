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
 * Test case for class WOEHRL\Test\Controller\TestAController.
 *
 */
class TestAControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\Test\Controller\TestAController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\Test\\Controller\\TestAController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTestAsFromRepositoryAndAssignsThemToView() {

		$allTestAs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$testARepository = $this->getMock('WOEHRL\\Test\\Domain\\Repository\\TestARepository', array('findAll'), array(), '', FALSE);
		$testARepository->expects($this->once())->method('findAll')->will($this->returnValue($allTestAs));
		$this->inject($this->subject, 'testARepository', $testARepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('testAs', $allTestAs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTestAToView() {
		$testA = new \WOEHRL\Test\Domain\Model\TestA();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('testA', $testA);

		$this->subject->showAction($testA);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenTestAToView() {
		$testA = new \WOEHRL\Test\Domain\Model\TestA();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newTestA', $testA);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($testA);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTestAToTestARepository() {
		$testA = new \WOEHRL\Test\Domain\Model\TestA();

		$testARepository = $this->getMock('WOEHRL\\Test\\Domain\\Repository\\TestARepository', array('add'), array(), '', FALSE);
		$testARepository->expects($this->once())->method('add')->with($testA);
		$this->inject($this->subject, 'testARepository', $testARepository);

		$this->subject->createAction($testA);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTestAToView() {
		$testA = new \WOEHRL\Test\Domain\Model\TestA();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('testA', $testA);

		$this->subject->editAction($testA);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTestAInTestARepository() {
		$testA = new \WOEHRL\Test\Domain\Model\TestA();

		$testARepository = $this->getMock('WOEHRL\\Test\\Domain\\Repository\\TestARepository', array('update'), array(), '', FALSE);
		$testARepository->expects($this->once())->method('update')->with($testA);
		$this->inject($this->subject, 'testARepository', $testARepository);

		$this->subject->updateAction($testA);
	}
}
