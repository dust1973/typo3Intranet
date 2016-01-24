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
 * LogsController
 */
class LogsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {


	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		//$logs = $this->logsRepository->findAll();
		$args = $this->request->getArguments();
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($args);

		if($args['pin']){
			$redu = new \stdClass();
			//$redu->Pin = '24e9ff4a';
			$redu->Pin = $args['pin'];
			$result = $this->getWSDL()->GetDebugRecord($redu);
			$returnlogs = ($result->Parameters->Logs);
			$logs = unserialize($returnlogs);
		}else{
			$logs = array();
		}




		if($args['currentPage']){
			$limit = $args['currentPage']*10;
			$count = $limit - 10;
			if($args['page']=='Previous'){
				if($args['currentPage']<2){
					$currentPage = 1;
				}else{
					$currentPage = $args['currentPage']-1;
				}
			}elseif($args['page']=='Next'){
				if($args['currentPage'] >= floor(count($logs)/10)){
					$currentPage = ceil(count($logs)/10);
				}else{
					$currentPage = $args['currentPage']+1;
				}
			}else{
				$currentPage = $args['currentPage'];
			}
		}else{
			$limit = 10;
			$currentPage = 1;
		}

		$logarray = array();
		$cc= 1;
		$gesamteAnzahlSeiten = array();

		foreach ($logs as $log){

			if($cc%10 == 0) {
				$gesamteAnzahlSeiten[] = $cc;
			}


			if(($cc >= $count) AND ($cc <= $limit)) {
				$logarray[] = unserialize($log[0]);
			}
			$cc++;
		}


		$this->view->assign('returnlogs', $gesamteAnzahlSeiten);
		$this->view->assign('pin', $redu->Pin);
		$this->view->assign('currentPage', $currentPage);
		$this->view->assign('logs', $logarray);
	}

	/**
	 * action show
	 *
	 * @param \WOEHRL\Woehrlrrsupport\Domain\Model\Logs $logs
	 * @return void
	 */
	public function showAction(\WOEHRL\Woehrlrrsupport\Domain\Model\Logs $logs) {
		$this->view->assign('logs', $logs);
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