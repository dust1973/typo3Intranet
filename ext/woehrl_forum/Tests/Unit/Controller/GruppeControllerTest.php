<?php
namespace Woehrl\WoehrlForum\Tests\Unit\Controller;
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
 * Test case for class Woehrl\WoehrlForum\Controller\GruppeController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class GruppeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlForum\Controller\GruppeController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlForum\\Controller\\GruppeController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllGruppesFromRepositoryAndAssignsThemToView() {

		$allGruppes = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$gruppeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\GruppeRepository', array('findAll'), array(), '', FALSE);
		$gruppeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allGruppes));
		$this->inject($this->subject, 'gruppeRepository', $gruppeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('gruppes', $allGruppes);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenGruppeToView() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('gruppe', $gruppe);

		$this->subject->showAction($gruppe);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenGruppeToView() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newGruppe', $gruppe);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($gruppe);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenGruppeToGruppeRepository() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();

		$gruppeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\GruppeRepository', array('add'), array(), '', FALSE);
		$gruppeRepository->expects($this->once())->method('add')->with($gruppe);
		$this->inject($this->subject, 'gruppeRepository', $gruppeRepository);

		$this->subject->createAction($gruppe);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenGruppeToView() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('gruppe', $gruppe);

		$this->subject->editAction($gruppe);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenGruppeInGruppeRepository() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();

		$gruppeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\GruppeRepository', array('update'), array(), '', FALSE);
		$gruppeRepository->expects($this->once())->method('update')->with($gruppe);
		$this->inject($this->subject, 'gruppeRepository', $gruppeRepository);

		$this->subject->updateAction($gruppe);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenGruppeFromGruppeRepository() {
		$gruppe = new \Woehrl\WoehrlForum\Domain\Model\Gruppe();

		$gruppeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\GruppeRepository', array('remove'), array(), '', FALSE);
		$gruppeRepository->expects($this->once())->method('remove')->with($gruppe);
		$this->inject($this->subject, 'gruppeRepository', $gruppeRepository);

		$this->subject->deleteAction($gruppe);
	}
}
