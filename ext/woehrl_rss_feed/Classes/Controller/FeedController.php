<?php
namespace WOEHRL\WoehrlRssFeed\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <Alexander.Fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * FeedController
 */
class FeedController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {


	/**
	 * called by all actions
	 *
	 * @see typo3/sysext/extbase/Classes/MVC/Controller/Tx_Extbase_MVC_Controller_ActionController#initializeAction()
	 * @return
	 */
	public function initializeAction() {
		// get config settings
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$this->settings = $extbaseFrameworkConfiguration;
	}



	/**
	 * action list
	 * 
	 * @return void
	 */
	public function listAction() {

        // get page id of this page
		$pageid = intval($GLOBALS['TSFE']->id);
		if($pageid == 520){
		//$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		//$tsService = new \TYPO3\CMS\Extbase\Service\TypoScriptService();
		//$this->settings = $tsService->convertTypoScriptArrayToPlainArray($extbaseFrameworkConfiguration['plugin.']['tx_woehrlrssfeed.']['settings.']);﻿
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath']);
		//\TYPO3\CMS\Core\Utility\DebugUtility::debug($extbaseFrameworkConfiguration);
			\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $this->settings['plugin.']  );
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $templateRootPath );
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump( $partialRootPath );
		//$feeds = $this->feedRepository->findAll();
		}
		$this->view->assign('feeds', $feeds = NULL);
	}

}