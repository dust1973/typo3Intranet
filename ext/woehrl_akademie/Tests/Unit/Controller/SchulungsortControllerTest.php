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
 * Test case for class Woehrl\WoehrlAkademie\Controller\SchulungsortController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class SchulungsortControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlAkademie\Controller\SchulungsortController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlAkademie\\Controller\\SchulungsortController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllSchulungsortsFromRepositoryAndAssignsThemToView() {

		$allSchulungsorts = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$schulungsortRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\SchulungsortRepository', array('findAll'), array(), '', FALSE);
		$schulungsortRepository->expects($this->once())->method('findAll')->will($this->returnValue($allSchulungsorts));
		$this->inject($this->subject, 'schulungsortRepository', $schulungsortRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('schulungsorts', $allSchulungsorts);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenSchulungsortToView() {
		$schulungsort = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('schulungsort', $schulungsort);

		$this->subject->showAction($schulungsort);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenSchulungsortToView() {
		$schulungsort = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newSchulungsort', $schulungsort);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($schulungsort);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenSchulungsortToSchulungsortRepository() {
		$schulungsort = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();

		$schulungsortRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\SchulungsortRepository', array('add'), array(), '', FALSE);
		$schulungsortRepository->expects($this->once())->method('add')->with($schulungsort);
		$this->inject($this->subject, 'schulungsortRepository', $schulungsortRepository);

		$this->subject->createAction($schulungsort);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenSchulungsortToView() {
		$schulungsort = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('schulungsort', $schulungsort);

		$this->subject->editAction($schulungsort);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenSchulungsortInSchulungsortRepository() {
		$schulungsort = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();

		$schulungsortRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\SchulungsortRepository', array('update'), array(), '', FALSE);
		$schulungsortRepository->expects($this->once())->method('update')->with($schulungsort);
		$this->inject($this->subject, 'schulungsortRepository', $schulungsortRepository);

		$this->subject->updateAction($schulungsort);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenSchulungsortFromSchulungsortRepository() {
		$schulungsort = new \Woehrl\WoehrlAkademie\Domain\Model\Schulungsort();

		$schulungsortRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\SchulungsortRepository', array('remove'), array(), '', FALSE);
		$schulungsortRepository->expects($this->once())->method('remove')->with($schulungsort);
		$this->inject($this->subject, 'schulungsortRepository', $schulungsortRepository);

		$this->subject->deleteAction($schulungsort);
	}
}
