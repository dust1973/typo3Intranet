<?php
namespace WOEHRL\Woehrlrrsupport\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * Test case for class WOEHRL\Woehrlrrsupport\Controller\LogsController.
 *
 * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
 */
class LogsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WOEHRL\Woehrlrrsupport\Controller\LogsController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WOEHRL\\Woehrlrrsupport\\Controller\\LogsController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllLogssFromRepositoryAndAssignsThemToView() {

		$allLogss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$logsRepository = $this->getMock('WOEHRL\\Woehrlrrsupport\\Domain\\Repository\\LogsRepository', array('findAll'), array(), '', FALSE);
		$logsRepository->expects($this->once())->method('findAll')->will($this->returnValue($allLogss));
		$this->inject($this->subject, 'logsRepository', $logsRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('logss', $allLogss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenLogsToView() {
		$logs = new \WOEHRL\Woehrlrrsupport\Domain\Model\Logs();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('logs', $logs);

		$this->subject->showAction($logs);
	}
}
