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
 * Test case for class Woehrl\WoehrlAkademie\Controller\KategorieController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class KategorieControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlAkademie\Controller\KategorieController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlAkademie\\Controller\\KategorieController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllKategoriesFromRepositoryAndAssignsThemToView() {

		$allKategories = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$kategorieRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KategorieRepository', array('findAll'), array(), '', FALSE);
		$kategorieRepository->expects($this->once())->method('findAll')->will($this->returnValue($allKategories));
		$this->inject($this->subject, 'kategorieRepository', $kategorieRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('kategories', $allKategories);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenKategorieToView() {
		$kategorie = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('kategorie', $kategorie);

		$this->subject->showAction($kategorie);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenKategorieToView() {
		$kategorie = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newKategorie', $kategorie);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($kategorie);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenKategorieToKategorieRepository() {
		$kategorie = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();

		$kategorieRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KategorieRepository', array('add'), array(), '', FALSE);
		$kategorieRepository->expects($this->once())->method('add')->with($kategorie);
		$this->inject($this->subject, 'kategorieRepository', $kategorieRepository);

		$this->subject->createAction($kategorie);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenKategorieToView() {
		$kategorie = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('kategorie', $kategorie);

		$this->subject->editAction($kategorie);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenKategorieInKategorieRepository() {
		$kategorie = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();

		$kategorieRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KategorieRepository', array('update'), array(), '', FALSE);
		$kategorieRepository->expects($this->once())->method('update')->with($kategorie);
		$this->inject($this->subject, 'kategorieRepository', $kategorieRepository);

		$this->subject->updateAction($kategorie);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenKategorieFromKategorieRepository() {
		$kategorie = new \Woehrl\WoehrlAkademie\Domain\Model\Kategorie();

		$kategorieRepository = $this->getMock('Woehrl\\WoehrlAkademie\\Domain\\Repository\\KategorieRepository', array('remove'), array(), '', FALSE);
		$kategorieRepository->expects($this->once())->method('remove')->with($kategorie);
		$this->inject($this->subject, 'kategorieRepository', $kategorieRepository);

		$this->subject->deleteAction($kategorie);
	}
}
