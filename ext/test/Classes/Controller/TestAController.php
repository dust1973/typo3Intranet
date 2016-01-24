<?php
namespace WOEHRL\Test\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * TestAController
 */
class TestAController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * testARepository
	 *
	 * @var \WOEHRL\Test\Domain\Repository\TestARepository
	 * @inject
	 */
	protected $testARepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$testAs = $this->testARepository->findAll();
		$this->view->assign('testAs', $testAs);
	}

	/**
	 * action show
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestA $testA
	 * @return void
	 */
	public function showAction(\WOEHRL\Test\Domain\Model\TestA $testA) {
		$this->view->assign('testA', $testA);
	}

	/**
	 * action new
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestA $newTestA
	 * @ignorevalidation $newTestA
	 * @return void
	 */
	public function newAction(\WOEHRL\Test\Domain\Model\TestA $newTestA = NULL) {
		$this->view->assign('newTestA', $newTestA);
	}

	/**
	 * action create
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestA $newTestA
	 * @return void
	 */
	public function createAction(\WOEHRL\Test\Domain\Model\TestA $newTestA) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->testARepository->add($newTestA);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestA $testA
	 * @ignorevalidation $testA
	 * @return void
	 */
	public function editAction(\WOEHRL\Test\Domain\Model\TestA $testA) {
		$this->view->assign('testA', $testA);
	}

	/**
	 * action update
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestA $testA
	 * @return void
	 */
	public function updateAction(\WOEHRL\Test\Domain\Model\TestA $testA) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->testARepository->update($testA);
		$this->redirect('list');
	}

}