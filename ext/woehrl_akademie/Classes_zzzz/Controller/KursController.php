<?php
namespace Woehrl\WoehrlAkademie\Controller;

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
 *
 * @package woehrl_akademie
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class KursController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * kursRepository
	 * 
	 * @var \Woehrl\WoehrlAkademie\Domain\Repository\KursRepository
	 * @inject
	 */
	protected $kursRepository;
	
	
	/**
	 * kategorieRepository
	 * 
	 * @var Woehrl\WoehrlAkademie\Domain\Repository\KategorieRepository
	 * @inject
	 */
	protected $kategorieRepository = NULL;
	
	
	/**
	 * schulungsortRepository
	 *
	 * @var \Woehrl\WoehrlAkademie\Domain\Repository\SchulungsortRepository
	 * @inject
	 */
	protected $schulungsortRepository = NULL;

	/**
	 * action list
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorie
	 * @return void
	 */
	public function listAction( Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorie=NULL) {
		//$kurs = $this->kursRepository->findAll();
		//$this->view->assign('kurs', $kurs);
		
		if(isset($kategorie)) {
			$kurses = $this->kursRepository->findByKategorie($kategorie);
			$this->view->assign('requestKategorie', $kategorie->getUid());
		} else {
			$kurses = $this->kursRepository->findAll();
		}
		
		
		$kategorien = $this->kategorieRepository->findAll();
		$this->view->assign('kategorien', $kategorien);
		
		$this->view->assign('kurses', $kurses);
	}

	/**
	 * action show
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs
	 * @return void
	 */
	public function showAction(\Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs) {
		$this->view->assign('kurs', $kurs);
	}

	/**
	 * action new
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kurs $newKurs
	 * @ignorevalidation $newKurs
	 * @return void
	 */
	public function newAction(\Woehrl\WoehrlAkademie\Domain\Model\Kurs $newKurs = NULL) {
		
		 //\TYPO3\CMS\Core\Utility\DebugUtility::debugInPopUpWindow($config, 'test');
		$this->view->assign('newKurs', $newKurs);
	}
	
	 /**
	 * action buchen
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kurs $neueBuchung
	 * @ignorevalidation $neueBuchung
	 * @return void
	 */
	public function buchenAction(\Woehrl\WoehrlAkademie\Domain\Model\Kurs $neueBuchung = NULL) {
	     //\TYPO3\CMS\Core\Utility\DebugUtility::debugInPopUpWindow($neueBuchung, 'neueBuchung');
		 
		$this->view->assign('neueBuchung', $neueBuchung);
	}


	/**
	 * action create
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kurs $newKurs
	 * @return void
	 */
	public function createAction(\Woehrl\WoehrlAkademie\Domain\Model\Kurs $newKurs) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->kursRepository->add($newKurs);
		$this->redirect('list');
	}

	/**
	 * action edit
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs
	 * @ignorevalidation $kurs
	 * @return void
	 */
	public function editAction(\Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs) {
		$this->view->assign('kurs', $kurs);
	}

	/**
	 * action update
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs
	 * @return void
	 */
	public function updateAction(\Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->kursRepository->update($kurs);
		$this->redirect('list');
	}

	/**
	 * action delete
	 * 
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs
	 * @return void
	 */
	public function deleteAction(\Woehrl\WoehrlAkademie\Domain\Model\Kurs $kurs) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->kursRepository->remove($kurs);
		$this->redirect('list');
	}

}