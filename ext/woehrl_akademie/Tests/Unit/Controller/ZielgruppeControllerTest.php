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
 * Test case for class Woehrl\WoehrlAkademie\Controller\ZielgruppeController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class ZielgruppeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlAkademie\Controller\ZielgruppeController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlAkademie\\Controller\\ZielgruppeController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllZielgruppesFromRepositoryAndAssignsThemToView() {

		$allZielgruppes = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$zielgruppeRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\ZielgruppeRepository', array('findAll'), array(), '', FALSE);
		$zielgruppeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allZielgruppes));
		$this->inject($this->subject, 'zielgruppeRepository', $zielgruppeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('zielgruppes', $allZielgruppes);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenZielgruppeToView() {
		$zielgruppe = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('zielgruppe', $zielgruppe);

		$this->subject->showAction($zielgruppe);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenZielgruppeToView() {
		$zielgruppe = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newZielgruppe', $zielgruppe);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($zielgruppe);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenZielgruppeToZielgruppeRepository() {
		$zielgruppe = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();

		$zielgruppeRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\ZielgruppeRepository', array('add'), array(), '', FALSE);
		$zielgruppeRepository->expects($this->once())->method('add')->with($zielgruppe);
		$this->inject($this->subject, 'zielgruppeRepository', $zielgruppeRepository);

		$this->subject->createAction($zielgruppe);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenZielgruppeToView() {
		$zielgruppe = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('zielgruppe', $zielgruppe);

		$this->subject->editAction($zielgruppe);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenZielgruppeInZielgruppeRepository() {
		$zielgruppe = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();

		$zielgruppeRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\ZielgruppeRepository', array('update'), array(), '', FALSE);
		$zielgruppeRepository->expects($this->once())->method('update')->with($zielgruppe);
		$this->inject($this->subject, 'zielgruppeRepository', $zielgruppeRepository);

		$this->subject->updateAction($zielgruppe);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenZielgruppeFromZielgruppeRepository() {
		$zielgruppe = new \Woehrl\WoehrlAkademie\Domain\Model\Zielgruppe();

		$zielgruppeRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\ZielgruppeRepository', array('remove'), array(), '', FALSE);
		$zielgruppeRepository->expects($this->once())->method('remove')->with($zielgruppe);
		$this->inject($this->subject, 'zielgruppeRepository', $zielgruppeRepository);

		$this->subject->deleteAction($zielgruppe);
	}
}
