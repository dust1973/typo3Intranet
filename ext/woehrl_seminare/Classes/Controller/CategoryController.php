<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Alexander Fuchs <alexander.fuchs@woehrl.de>, WÖHRL Akademie
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
 *
 * @package woehrl_seminare
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_WoehrlSeminare_Controller_CategoryController extends Tx_WoehrlSeminare_Controller_AbstractController {

	/**
	 * Initializes the current action
	 *
	 * idea from tx_news extension
	 *
	 * @return void
	 */
	public function initializeAction() {

		// Only do this in Frontend Context
		if (!empty($GLOBALS['TSFE']) && is_object($GLOBALS['TSFE'])) {
			// We only want to set the tag once in one request, so we have to cache that statically if it has been done
			static $cacheTagsSet = FALSE;

			/** @var $typoScriptFrontendController \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController  */
			$typoScriptFrontendController = $GLOBALS['TSFE'];
			if (!$cacheTagsSet) {
				$typoScriptFrontendController->addCacheTags(array(0 => 'tx_woehrlseminare_cat_' . $this->settings['storagePid']));
				$cacheTagsSet = TRUE;
			}
			$this->typoScriptFrontendController = $typoScriptFrontendController;
		}
	}

	/**
	 * action list
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Category $category
	 * @ignorevalidation
	 * @return void
	 */
	public function listAction(Tx_WoehrlSeminare_Domain_Model_Category $category = NULL) {

//~ t3lib_utility_Debug::debug($this->settings, 'settings... ');
		// take the root category of the flexform
		$category = $this->categoryRepository->findAllByUids(t3lib_div::intExplode(',', $this->settings['categorySelection'], TRUE))->getFirst();

//~ t3lib_utility_Debug::debug($category, 'category... ');
		$categories = $this->categoryRepository->findCurrentBranch($category);
		//~ $categories = $this->categoryRepository->findCurrentLevel($category);
//~ t3lib_utility_Debug::debug($categories, 'listAction... ');

		if (count($categories) == 0) {
			// there are no further child categories --> show events
			$this->forward('gbList');
		} else {
			$this->view->assign('categories', $categories);
		}
	}

	/**
	 * action gbList
	 *
	 * List of genius bar events with category description, contact photo and calendar link
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Category $category
	 * @ignorevalidation
	 * @return void
	 */
	public function gbListAction(Tx_WoehrlSeminare_Domain_Model_Category $category = NULL) {

		if ($category != NULL) {
			$events = $this->eventRepository->findAllGbByCategory($category);
		}

		$this->view->assign('events', $events);
		$this->view->assign('category', $category);
		$this->view->assign('parentcategory', $category->getParent()->current());
	}

	/**
	 * action show
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Category $category
	 * @return void
	 */
	public function showAction(Tx_WoehrlSeminare_Domain_Model_Category $category) {
		$this->view->assign('category', $category);
	}

}

?>
