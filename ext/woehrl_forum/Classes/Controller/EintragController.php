<?php
namespace Woehrl\WoehrlForum\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * EintragController
 */
class EintragController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * eintragRepository
	 * 
	 * @var \Woehrl\WoehrlForum\Domain\Repository\EintragRepository
	 * @inject
	 */
	protected $eintragRepository = NULL;

	/**
	 * action list
	 * 
	 * @return void
	 */
	public function listAction() {
		$eintrags = $this->eintragRepository->findAll();
		$this->view->assign('eintrags', $eintrags);
	}

	/**
	 * action show
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag
	 * @return void
	 */
	public function showAction(\Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag) {
		$this->view->assign('eintrag', $eintrag);
	}

	/**
	 * action new
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Eintrag $newEintrag
	 * @ignorevalidation $newEintrag
	 * @return void
	 */
	public function newAction(\Woehrl\WoehrlForum\Domain\Model\Eintrag $newEintrag = NULL) {
		$this->view->assign('newEintrag', $newEintrag);
	}

	/**
	 * action create
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Eintrag $newEintrag
	 * @return void
	 */
	public function createAction(\Woehrl\WoehrlForum\Domain\Model\Eintrag $newEintrag) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->eintragRepository->add($newEintrag);
		$this->redirect('list');
	}

	/**
	 * action edit
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag
	 * @ignorevalidation $eintrag
	 * @return void
	 */
	public function editAction(\Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag) {
		$this->view->assign('eintrag', $eintrag);
	}

	/**
	 * action update
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag
	 * @return void
	 */
	public function updateAction(\Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->eintragRepository->update($eintrag);
		$this->redirect('list');
	}

	/**
	 * action delete
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag
	 * @return void
	 */
	public function deleteAction(\Woehrl\WoehrlForum\Domain\Model\Eintrag $eintrag) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->eintragRepository->remove($eintrag);
		$this->redirect('list');
	}

}