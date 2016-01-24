<?php
namespace WOEHRL\Woehrlrrsupport\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * SettingsController
 */
class SettingsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {



	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		//$result = $this->getWSDL()->PingPong();

		/*$redu = new \stdClass();
		$redu->Pin = '2B9AFD95';

		$result = $this->getWSDL()->GetSettings($redu);

		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);
		$settings = $result;
		$this->view->assign('settings', $settings);*/
	}

	/**
	 * action show
	 *
	 * @return void
	 */
	public function showAction() {
		$redu = new \stdClass();
		$redu->Pin = '1';
		$result = $this->getWSDL()->GetSettings($redu);
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);
		$settings = $result->Parameters;
		$this->view->assign('settings', $settings);
	}

	/**
	 * action new
	 *
	 * @param \WOEHRL\Woehrlrrsupport\Domain\Model\Settings $newSettings
	 * @ignorevalidation $newSettings
	 * @return void
	 */
	public function newAction(\WOEHRL\Woehrlrrsupport\Domain\Model\Settings $newSettings = NULL) {
		$this->view->assign('newSettings', $newSettings);
	}

	/**
	 * action create
	 *
	 * @param \WOEHRL\Woehrlrrsupport\Domain\Model\Settings $newSettings
	 * @return void
	 */
	public function createAction(\WOEHRL\Woehrlrrsupport\Domain\Model\Settings $newSettings) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->settingsRepository->add($newSettings);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @return void
	 */
	public function editAction() {


		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($result);

		//$this->view->assign('settings', $settings);
	}

	/**
	 * action update
	 *
	 * @param \WOEHRL\Woehrlrrsupport\Domain\Model\Settings $settings
	 * @return void
	 */
	public function updateAction(\WOEHRL\Woehrlrrsupport\Domain\Model\Settings $settings) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->settingsRepository->update($settings);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \WOEHRL\Woehrlrrsupport\Domain\Model\Settings $settings
	 * @return void
	 */
	public function deleteAction(\WOEHRL\Woehrlrrsupport\Domain\Model\Settings $settings) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->settingsRepository->remove($settings);
		$this->redirect('list');
	}

	private function getWSDL(){

		ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
		$wsdl = 'https://redurunner.zentrale-woehrl.de/Helpdesk/server.wsdl';

		$lol = stream_context_create(array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		));

		$client = new \SoapClient($wsdl,
			array(
				"trace" => 1,
				'exceptions' => 1,
				'login'=>'developer',
				'password'=>'developer',
				'stream_context' => $lol,
				'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_FIXED | 1
			)
		);

		return $client;

	}

}