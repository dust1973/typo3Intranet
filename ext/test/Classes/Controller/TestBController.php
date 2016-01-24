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
 * TestBController
 */
class TestBController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * testBRepository
	 *
	 * @var \WOEHRL\Test\Domain\Repository\TestBRepository
	 * @inject
	 */
	protected $testBRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$testBs = $this->testBRepository->findAll();
		$this->view->assign('testBs', $testBs);
	}

	/**
	 * action show
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestB $testB
	 * @return void
	 */
	public function showAction(\WOEHRL\Test\Domain\Model\TestB $testB) {
		$this->view->assign('testB', $testB);
	}

	/**
	 * action new
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestB $newTestB
	 * @ignorevalidation $newTestB
	 * @return void
	 */
	public function newAction(\WOEHRL\Test\Domain\Model\TestB $newTestB = NULL) {
		$this->view->assign('newTestB', $newTestB);
	}

	/**
	 * action create
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestB $newTestB
	 * @return void
	 */
	public function createAction(\WOEHRL\Test\Domain\Model\TestB $newTestB) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->testBRepository->add($newTestB);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestB $testB
	 * @ignorevalidation $testB
	 * @return void
	 */
	public function editAction(\WOEHRL\Test\Domain\Model\TestB $testB) {
		$this->view->assign('testB', $testB);
	}

	/**
	 * action update
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestB $testB
	 * @return void
	 */
	public function updateAction(\WOEHRL\Test\Domain\Model\TestB $testB) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->testBRepository->update($testB);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \WOEHRL\Test\Domain\Model\TestB $testB
	 * @return void
	 */
	public function deleteAction(\WOEHRL\Test\Domain\Model\TestB $testB) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->testBRepository->remove($testB);
		$this->redirect('list');
	}

}