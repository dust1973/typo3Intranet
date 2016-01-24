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
 * GruppeController
 */
class GruppeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * gruppeRepository
	 * 
	 * @var \Woehrl\WoehrlForum\Domain\Repository\GruppeRepository
	 * @inject
	 */
	protected $gruppeRepository = NULL;

	/**
	 * action list
	 * 
	 * @return void
	 */
	public function listAction() {
		$gruppes = $this->gruppeRepository->findAll();
		$this->view->assign('gruppes', $gruppes);
	}

	/**
	 * action show
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe
	 * @return void
	 */
	public function showAction(\Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe) {
		$this->view->assign('gruppe', $gruppe);
	}

	/**
	 * action new
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $newGruppe
	 * @ignorevalidation $newGruppe
	 * @return void
	 */
	public function newAction(\Woehrl\WoehrlForum\Domain\Model\Gruppe $newGruppe = NULL) {
		$this->view->assign('newGruppe', $newGruppe);
	}

	/**
	 * action create
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $newGruppe
	 * @return void
	 */
	public function createAction(\Woehrl\WoehrlForum\Domain\Model\Gruppe $newGruppe) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->gruppeRepository->add($newGruppe);
		$this->redirect('list');
	}

	/**
	 * action edit
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe
	 * @ignorevalidation $gruppe
	 * @return void
	 */
	public function editAction(\Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe) {
		$this->view->assign('gruppe', $gruppe);
	}

	/**
	 * action update
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe
	 * @return void
	 */
	public function updateAction(\Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->gruppeRepository->update($gruppe);
		$this->redirect('list');
	}

	/**
	 * action delete
	 * 
	 * @param \Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe
	 * @return void
	 */
	public function deleteAction(\Woehrl\WoehrlForum\Domain\Model\Gruppe $gruppe) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->gruppeRepository->remove($gruppe);
		$this->redirect('list');
	}

}