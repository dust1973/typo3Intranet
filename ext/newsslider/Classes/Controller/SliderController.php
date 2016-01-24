<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Helmut Hackbarth <typo3@t3solution.de>
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
 * Slider Controller
 *
 * @package TYPO3
 * @subpackage T3S\Newsslider\
 */
class Tx_Newsslider_Controller_SliderController extends Tx_News_Controller_NewsController {


	/**
	 * @var Tx_News_Domain_Repository_NewsRepository
	 */
	protected $newsRepository;


	/**
	* Configuration Manager
	*
	* @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	* @inject
	*/
	protected $configurationManager;


	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {

		$tsSettings = $this->configurationManager->getConfiguration(
				\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK,
				'news',
				'news_pi1'
			);
		$originalSettings = $this->configurationManager->getConfiguration(
				\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
			);
			// start override
		if (isset($tsSettings['settings']['overrideFlexformSettingsIfEmpty'])) {
			$overrideIfEmpty = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $tsSettings['settings']['overrideFlexformSettingsIfEmpty'], TRUE);
			foreach ($overrideIfEmpty as $key) {
					// if flexform setting is empty and value is available in TS
				if ((!isset($originalSettings[$key]) || empty($originalSettings[$key]))
						&& isset($tsSettings['settings'][$key])) {
					$originalSettings[$key] = $tsSettings['settings'][$key];
				}
			}
		}

		$this->settings = $originalSettings;

		$this->settings['jslidernews'] = Tx_Newsslider_Utility_Dims::getDims($this->settings['jslidernews']);

	}


	/**
	 * Output a jslidernews view of news
	 *
	 * @return return string the Rendered view
	 */
	public function jslidernewsAction() {

		$demand = parent::createDemandObjectFromSettings($this->settings);

		$this->view->assign('news',$this->newsRepository->findDemanded($demand));

	}


	/**
	 * Output a flexslider view of news
	 *
	 * @return return string the Rendered view
	 */
	public function flexsliderAction() {

		$demand = parent::createDemandObjectFromSettings($this->settings);

		$this->view->assign('news',$this->newsRepository->findDemanded($demand));
	}


	/**
	 * Output a nivolider view of news
	 *
	 * @return return string the Rendered view
	 */
	public function nivosliderAction() {

		$demand = parent::createDemandObjectFromSettings($this->settings);

		$this->view->assign('news',$this->newsRepository->findDemanded($demand));
	}


}


?>