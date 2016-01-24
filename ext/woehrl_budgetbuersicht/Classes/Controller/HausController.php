<?php
namespace Woehrl\WoehrlBudgetbuersicht\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alex Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * HausController
 */
class HausController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * hausRepository
	 * 
	 * @var \Woehrl\WoehrlBudgetbuersicht\Domain\Repository\HausRepository
	 * @inject
	 */
	protected $hausRepository = NULL;


	/**
	 * budgetRepository
	 *
	 * @var \Woehrl\WoehrlBudgetbuersicht\Domain\Repository\BudgetRepository
	 * @inject
	 */


	protected $budgetRepository = NULL;

	/**
	 * action list
	 * 
	 * @return void
	 */
	public function listAction() {


		$kostenstelle = $this->budgetRepository->findAll();

		//$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager');
		//$persistenceManager->persistAll();
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($kostenstelle);
		$this->debugQuery($kostenstelle);

		die;
		$hauses = $this->hausRepository->findAll();
		$this->view->assign('hauses', $hauses);
	}

	/**
	 * action new
	 * 
	 * @param \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $newHaus
	 * @ignorevalidation $newHaus
	 * @return void
	 */
	public function newAction(\Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $newHaus = NULL) {
		$this->view->assign('newHaus', $newHaus);
	}

	/**
	 * action create
	 * 
	 * @param \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $newHaus
	 * @return void
	 */
	public function createAction(\Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $newHaus) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->hausRepository->add($newHaus);
		$this->redirect('list');
	}

	/**
	 * action edit
	 * 
	 * @param \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $haus
	 * @ignorevalidation $haus
	 * @return void
	 */
	public function editAction(\Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $haus) {
		$this->view->assign('haus', $haus);
	}

	/**
	 * action update
	 * 
	 * @param \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $haus
	 * @return void
	 */
	public function updateAction(\Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $haus) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->hausRepository->update($haus);
		$this->redirect('list');
	}

	/**
	 * action delete
	 * 
	 * @param \Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $haus
	 * @return void
	 */
	public function deleteAction(\Woehrl\WoehrlBudgetbuersicht\Domain\Model\Haus $haus) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->hausRepository->remove($haus);
		$this->redirect('list');
	}


	/**
	 * Debugs a SQL query from a QueryResult
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult
	 * @param boolean $explainOutput
	 * @return void
	 */
	public function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult, $explainOutput = FALSE){
		$GLOBALS['TYPO3_DB']->debugOuput = 2;
		if($explainOutput){
			$GLOBALS['TYPO3_DB']->explainOutput = true;
		}
		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
		$queryResult->toArray();
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
		$GLOBALS['TYPO3_DB']->explainOutput = false;
		$GLOBALS['TYPO3_DB']->debugOuput = false;
	}

}