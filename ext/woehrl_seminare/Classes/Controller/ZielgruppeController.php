<?php



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
 * ZielgruppeController
 */
class Tx_WoehrlSeminare_Controller_ZielgruppeController extends Tx_Extbase_MVC_Controller_ActionController {

    /**
     * zielgruppeRepository
     *
     * @var Tx_WoehrlSeminare_Domain_Repository_ZielgruppeRepository
     * @inject
     */
    protected $zielgruppeRepository = NULL;

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {
        $zielgruppes = $this->zielgruppeRepository->findAll();
        $this->view->assign('zielgruppes', $zielgruppes);
    }

    /**
     * action show
     *
     * @param Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe
     * @return void
     */
    public function showAction(Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe) {
        $this->view->assign('zielgruppe', $zielgruppe);
    }

    /**
     * action new
     *
     * @param Tx_WoehrlSeminare_Domain_Model_Zielgruppe $newZielgruppe
     * @ignorevalidation $newZielgruppe
     * @return void
     */
    public function newAction(Tx_WoehrlSeminare_Domain_Model_Zielgruppe $newZielgruppe = NULL) {
        $this->view->assign('newZielgruppe', $newZielgruppe);
    }

    /**
     * action create
     *
     * @param Tx_WoehrlSeminare_Domain_Model_Zielgruppe $newZielgruppe
     * @return void
     */
    public function createAction(Tx_WoehrlSeminare_Domain_Model_Zielgruppe $newZielgruppe) {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->zielgruppeRepository->add($newZielgruppe);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe
     * @ignorevalidation $zielgruppe
     * @return void
     */
    public function editAction(Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe) {
        $this->view->assign('zielgruppe', $zielgruppe);
    }

    /**
     * action update
     *
     * @param Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe
     * @return void
     */
    public function updateAction(Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe) {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->zielgruppeRepository->update($zielgruppe);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe
     * @return void
     */
    public function deleteAction(Tx_WoehrlSeminare_Domain_Model_Zielgruppe $zielgruppe) {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->zielgruppeRepository->remove($zielgruppe);
        $this->redirect('list');
    }

}