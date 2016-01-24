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
 * Test case for class Woehrl\WoehrlForum\Controller\ThemeController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class ThemeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Woehrl\WoehrlForum\Controller\ThemeController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Woehrl\\WoehrlForum\\Controller\\ThemeController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllThemesFromRepositoryAndAssignsThemToView() {

		$allThemes = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$themeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\ThemeRepository', array('findAll'), array(), '', FALSE);
		$themeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allThemes));
		$this->inject($this->subject, 'themeRepository', $themeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('themes', $allThemes);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenThemeToView() {
		$theme = new \Woehrl\WoehrlForum\Domain\Model\Theme();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('theme', $theme);

		$this->subject->showAction($theme);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenThemeToView() {
		$theme = new \Woehrl\WoehrlForum\Domain\Model\Theme();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newTheme', $theme);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($theme);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenThemeToThemeRepository() {
		$theme = new \Woehrl\WoehrlForum\Domain\Model\Theme();

		$themeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\ThemeRepository', array('add'), array(), '', FALSE);
		$themeRepository->expects($this->once())->method('add')->with($theme);
		$this->inject($this->subject, 'themeRepository', $themeRepository);

		$this->subject->createAction($theme);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenThemeToView() {
		$theme = new \Woehrl\WoehrlForum\Domain\Model\Theme();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('theme', $theme);

		$this->subject->editAction($theme);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenThemeInThemeRepository() {
		$theme = new \Woehrl\WoehrlForum\Domain\Model\Theme();

		$themeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\ThemeRepository', array('update'), array(), '', FALSE);
		$themeRepository->expects($this->once())->method('update')->with($theme);
		$this->inject($this->subject, 'themeRepository', $themeRepository);

		$this->subject->updateAction($theme);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenThemeFromThemeRepository() {
		$theme = new \Woehrl\WoehrlForum\Domain\Model\Theme();

		$themeRepository = $this->getMock('Woehrl\\WoehrlForum\\Domain\\Repository\\ThemeRepository', array('remove'), array(), '', FALSE);
		$themeRepository->expects($this->once())->method('remove')->with($theme);
		$this->inject($this->subject, 'themeRepository', $themeRepository);

		$this->subject->deleteAction($theme);
	}
}
