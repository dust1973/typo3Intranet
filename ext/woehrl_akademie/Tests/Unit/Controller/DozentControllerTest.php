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
 * Test case for class Woehrl\WoehrlAkademie\Controller\DozentController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class DozentControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlAkademie\Controller\DozentController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlAkademie\\Controller\\DozentController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllDozentsFromRepositoryAndAssignsThemToView() {

		$allDozents = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$dozentRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\DozentRepository', array('findAll'), array(), '', FALSE);
		$dozentRepository->expects($this->once())->method('findAll')->will($this->returnValue($allDozents));
		$this->inject($this->subject, 'dozentRepository', $dozentRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('dozents', $allDozents);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenDozentToView() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('dozent', $dozent);

		$this->subject->showAction($dozent);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenDozentToView() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newDozent', $dozent);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($dozent);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenDozentToDozentRepository() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();

		$dozentRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\DozentRepository', array('add'), array(), '', FALSE);
		$dozentRepository->expects($this->once())->method('add')->with($dozent);
		$this->inject($this->subject, 'dozentRepository', $dozentRepository);

		$this->subject->createAction($dozent);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenDozentToView() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('dozent', $dozent);

		$this->subject->editAction($dozent);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenDozentInDozentRepository() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();

		$dozentRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\DozentRepository', array('update'), array(), '', FALSE);
		$dozentRepository->expects($this->once())->method('update')->with($dozent);
		$this->inject($this->subject, 'dozentRepository', $dozentRepository);

		$this->subject->updateAction($dozent);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenDozentFromDozentRepository() {
		$dozent = new \Woehrl\WoehrlAkademie\Domain\Model\Dozent();

		$dozentRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\DozentRepository', array('remove'), array(), '', FALSE);
		$dozentRepository->expects($this->once())->method('remove')->with($dozent);
		$this->inject($this->subject, 'dozentRepository', $dozentRepository);

		$this->subject->deleteAction($dozent);
	}
}
