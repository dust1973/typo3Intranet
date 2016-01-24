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
class Tx_WoehrlSeminare_Controller_EventController extends Tx_WoehrlSeminare_Controller_AbstractController {


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
				$typoScriptFrontendController->addCacheTags(array(1 => 'tx_woehrlseminare_' . $this->settings['storagePid']));
				$cacheTagsSet = TRUE;
			}
			$this->typoScriptFrontendController = $typoScriptFrontendController;
		}
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {

		if (!empty($this->settings['categorySelection'])) {
			$categoriesIds = t3lib_div::intExplode(',', $this->settings['categorySelection'], TRUE);

			if ($this->settings['categorySelectionRecursive']) {
				// add somehow the other categories...
				foreach ($categoriesIds as $category) {
					$foundRecusiveCategories = $this->categoryRepository->findAllChildCategories($category);
					if (count($foundRecusiveCategories) > 0)
						$categoriesIds = array_merge($foundRecusiveCategories, $categoriesIds);
				}
			}
			$this->settings['categoryList'] = $categoriesIds;
		}

		if (!empty($this->settings['disciplineSelection'])) {
			$disciplineIds = t3lib_div::intExplode(',', $this->settings['disciplineSelection'], TRUE);

			if ($this->settings['disciplineSelectionRecursive']) {
				// add somehow the other categories...
				foreach ($disciplineIds as $discipline) {
					$foundRecusiveDisciplines = $this->disciplineRepository->findAllChildDisciplines($discipline);
					if (count($foundRecusiveDisciplines) > 0)
						$disciplineIds = array_merge($foundRecusiveDisciplines, $disciplineIds);
				}
			}
			$this->settings['disciplineList'] = $disciplineIds;
		}

		$events = $this->eventRepository->findAllBySettings($this->settings);
		$monate = array(
			1=>"Januar",
			2=>"Februar",
			3=>"März",
			4=>"April",
			5=>"Mai",
			6=>"Juni",
			7=>"Juli",
			8=>"August",
			9=>"September",
			10=>"Oktober",
			11=>"November",
			12=>"Dezember")
		;
		$monaten = array();
		foreach ($events as $event){

			$monat = $event->getStartDateTime()->format('m');
			$jahr = $event->getStartDateTime()->format('Y');
			$monat = intval($monat);


			if (in_array($monate[$monat] . ' '. $jahr ,$monaten)) {
				$monaten[]= NULL;
			}else{
				$monaten[]= $monate[$monat]  . ' '. $jahr ;
			}
			$endArray = end($monaten);
			$event->setMonatfilter($endArray);

		}

		//TYPO3\CMS\Extbase\Utility\debuggerUtility::var_dump($events);
		//die;
		$this->view->assign('events', $events);
	}

	/**
	 * action initializeShow
	 *
	 * @return void
	 */
	public function initializeShowAction() {

		$eventId = $this->getParametersSafely('event');
		$event = NULL;

		if ($eventId != NULL)
			$event = $this->eventRepository->findByUid($eventId);

		if ($event === NULL)
			$this->redirect('showNotFound');
	}

	/**
	 * action show
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $event
	 * @ignorevalidation $event
	 * @return void
	 */
	public function showAction(Tx_WoehrlSeminare_Domain_Model_Event $event = NULL) {

		if ($event !== NULL) {
			// fill registers to be used in ts
			$cObj = t3lib_div::makeInstance('tslib_cObj');
			$cObj->LOAD_REGISTER(
				array(
					'eventPageTitle' => Tx_Extbase_Utility_Localization::translate('tx_woehrlseminare_domain_model_event', 'woehrl_seminare') . ': "' . $event->getTitle() . '" - ' . strftime('%a, %x %H:%M', $event->getStartDateTime()->getTimeStamp()),
				), 'LOAD_REGISTER');
		}

		$this->view->assign('event', $event);
	}

	/**
	 * action showNotfound
	 *
	 * @return void
	 */
	public function showNotFoundAction() {

	}

	/**
	 * action new
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $newEvent
	 * @ignorevalidation $newEvent
	 * @return void
	 */
	public function newAction(Tx_WoehrlSeminare_Domain_Model_Event $newEvent = NULL) {
			$this->view->assign('newEvent', $newEvent);
	}

	/**
	 * action create
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $newEvent
	 * @return void
	 */
	public function createAction(Tx_WoehrlSeminare_Domain_Model_Event $newEvent) {

		TYPO3\CMS\Extbase\Utility\debuggerUtility::var_dump($newEvent);
		die;
		$this->eventRepository->add($newEvent);


		$this->flashMessageContainer->add('Your new Event was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $event
	 * @ignorevalidation $event
	 * @return void
	 */
	public function editAction(Tx_WoehrlSeminare_Domain_Model_Event $event) {
		$this->view->assign('event', $event);
	}

	/**
	 * action update
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $event
	 * @return void
	 */
	public function updateAction(Tx_WoehrlSeminare_Domain_Model_Event $event) {
		$this->eventRepository->update($event);
		$this->flashMessageContainer->add('Your Event was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $event
	 * @return void
	 */
	public function deleteAction(Tx_WoehrlSeminare_Domain_Model_Event $event) {
		$this->eventRepository->remove($event);
		$this->flashMessageContainer->add('Your Event was removed.');
		$this->redirect('list');
	}

	/**
	 * action listOwn
	 *
	 * @return void
	 */
	public function listOwnAction() {

		// + the user is logged in
		// + the username == customerid
		$subscribers = $this->subscriberRepository->findAllByFeuser();
		$events = $this->eventRepository->findAllBySubscriber($subscribers);

		$this->view->assign('subscribers', $subscribers);
		$this->view->assign('events', $events);
	}

	/**
	 * action beList
	 *
	 * @return void
	 */
	public function beListAction() {

		// get data from BE session
		$sessionData = $GLOBALS['BE_USER']->getSessionData('tx_woehrlseminare');
		// get search parameters from BE user configuration
		$ucData = $GLOBALS['BE_USER']->uc['moduleData']['woehrlseminare'];



		// -----------------------------------------
		// get search parameters from POST variables
		// -----------------------------------------
		$searchParameter = $this->getParametersSafely('searchParameter');
		if (is_array($searchParameter)) {
			$ucData['searchParameter'] = $searchParameter;
			$sessionData['selectedStartDateStamp'] = $searchParameter['selectedStartDateStamp'];
			$GLOBALS['BE_USER']->uc['moduleData']['woehrlseminare'] = $ucData;
			$GLOBALS['BE_USER']->writeUC($GLOBALS['BE_USER']->uc);
			// save session data
			$GLOBALS['BE_USER']->setAndSaveSessionData('tx_woehrlseminare', $sessionData);
		} else {
			// no POST vars --> take BE user configuration
			$searchParameter = $ucData['searchParameter'];
		}

		// set the startDateStamp
		// startDateStamp is saved in session data NOT in user data
		if (empty($selectedStartDateStamp)) {
			if (!empty($sessionData['selectedStartDateStamp']))
				$selectedStartDateStamp = $sessionData['selectedStartDateStamp'];
			else
				$selectedStartDateStamp = date('d-m-Y');
		}

		// get the categories
		$categories = $this->categoryRepository->findAllTree();
		// get all contacts
		$contacts = $this->contactRepository->findAllSorted();

		// check which categories have been selected
		if (is_array($searchParameter['selectedCategories'])) {
			$this->view->assign('selectedCategories', $searchParameter['selectedCategories']);
		}
		else {
			// if no category selection in user settings present --> look for the root categories
			if (! is_array($searchParameter['category']))
				foreach ($categories as $uid => $category)
					$searchParameter['category'][$uid] = $uid;
			$this->view->assign('categoriesSelected', $searchParameter['category']);
		}

		// check which contacts have been selected
		if (is_array($searchParameter['selectedContacts'])) {
			$this->view->assign('selectedContacts', $searchParameter['selectedContacts']);
		}
		else {
			// if no contacts selection in user settings present --> look for the root categories
			if (! is_array($searchParameter['contacts']))
				foreach ($contacts as $uid => $contact)
					$searchParameter['contacts'][$uid] = $contact->getUid();
			$this->view->assign('contactsSelected', $searchParameter['contacts']);
		}
		$this->view->assign('selectedStartDateStamp', $selectedStartDateStamp);
	//~ t3lib_utility_Debug::debug($searchParameter['contacts'], 'selectedStartDateStamp... ');

		// get the events to show
		if (is_array($searchParameter['category']))
			$events = $this->eventRepository->findAllByCategoriesAndDate($searchParameter['category'], strtotime($selectedStartDateStamp), $searchParameter['searchString'], $searchParameter['contacts']);

		$this->view->assign('searchString', $searchParameter['searchString']);
		$this->view->assign('categories', $categories);
		$this->view->assign('events', $events);
		$this->view->assign('contacts', $contacts);

	}

	/**
	 * action beCopy
	 *
	 * @param Tx_WoehrlSeminare_Domain_Model_Event $event
	 * @ignorevalidation $event
	 * @return void
	 */
	public function beCopyAction($event) {

		$availableProperties = Tx_Extbase_Reflection_ObjectAccess::getGettablePropertyNames($event);
		$newEvent =  $this->objectManager->create('Tx_WoehrlSeminare_Domain_Model_Event');

		foreach ($availableProperties as $propertyName) {
			if (Tx_Extbase_Reflection_ObjectAccess::isPropertySettable($newEvent, $propertyName)
				&& !in_array($propertyName, array('uid','pid','subscribers', 'cancelled', 'subEndDateTime','subEndDateInfoSent','categories', 'discipline'))) {

				$propertyValue = Tx_Extbase_Reflection_ObjectAccess::getProperty($event, $propertyName);
				Tx_Extbase_Reflection_ObjectAccess::setProperty($newEvent, $propertyName, $propertyValue);
			}
		}

		foreach ($event->getCategories() as $cat) {
			$newEvent->addCategory($cat);
		}

		foreach ($event->getDiscipline() as $discipline) {
			$newEvent->addDiscipline($discipline);
		}

		if ($event->getGeniusBar())
			$newEvent->setTitle('Wissensbar ' . $newEvent->getContact()->getName());
		else
			$newEvent->setTitle($newEvent->getTitle());

		$newEvent->setHidden(TRUE);

		$this->eventRepository->add($newEvent);

		$this->flashMessageContainer->add('Die Veranstaltung '.$newEvent->getTitle().' wurde kopiert.');
		$this->redirect('beList');
	}

	/**
	 * action listMonth
	 *
	 * @return void
	 */
	public function listMonthAction() {

		if (!empty($this->settings['categorySelection'])) {
			$categoriesIds = t3lib_div::intExplode(',', $this->settings['categorySelection'], TRUE);

			if ($this->settings['categorySelectionRecursive']) {
				// add somehow the other categories...
				foreach ($categoriesIds as $category) {
					$foundRecusiveCategories = $this->categoryRepository->findAllChildCategories($category);
					if (count($foundRecusiveCategories) > 0)
						$categoriesIds = array_merge($foundRecusiveCategories, $categoriesIds);
				}
			}
			$this->settings['categoryList'] = $categoriesIds;
			$categories = $this->categoryRepository->findAllByUidsTree($this->settings['categoryList']);
		}

		if (!empty($this->settings['disciplineSelection'])) {
			$disciplineIds = t3lib_div::intExplode(',', $this->settings['disciplineSelection'], TRUE);

			if ($this->settings['disciplineSelectionRecursive']) {
				// add somehow the other categories...
				foreach ($disciplineIds as $discipline) {
					$foundRecusiveDisciplines = $this->disciplineRepository->findAllChildDisciplines($discipline);
					if (count($foundRecusiveDisciplines) > 0)
						$disciplineIds = array_merge($foundRecusiveDisciplines, $disciplineIds);
				}
			}
			$this->settings['disciplineList'] = $disciplineIds;
			$disciplines = $this->disciplineRepository->findAllByUidsTree($this->settings['disciplineList']);
		}

		$this->view->assign('categories', $categories);
		$this->view->assign('disciplines', $disciplines);
		$this->view->assign('categoriesIds', explode(',', $this->settings['categorySelection']));
		$this->view->assign('disciplinesIds', explode(',', $this->settings['disciplineSelection']));
	}


	/**
	 * action errorAction
	 *
	 * @return void
	 */
	public function errorAction() {

	}


	/**
	 * action ajax
	 *
	 * EXPERIMENTAL!!
	 *
	 * @return void
	 */
	public function ajaxAction() {

		//~ $events = $this->eventRepository->findAllByCategoriesAndDateInterval(t3lib_div::intExplode(',', $_GET['categories'], TRUE), $_GET['start'], $_GET['stop']);

		$events = $this->eventRepository->findAllBySettings(array('categoryList' => t3lib_div::intExplode(',', $_GET['categories'], TRUE),
			'disciplineList' => t3lib_div::intExplode(',', $_GET['disciplines'], TRUE),
			'startTimestamp' => $_GET['start'],
			'stopTimestamp' => $_GET['stop'],
			'showPastEvents' => TRUE)
		);

		$cObj = $this->configurationManager->getContentObject();
		foreach ($events as $event) {

			$foundevent = array();

			$foundevent['id'] = $event->getUid();
			$foundevent['title'] = $event->getTitle();
			$foundevent['teaser'] = $event->getTeaser();
			$foundevent['start'] = $event->getStartDateTime()->format('Y-m-d H:i:s');
			foreach ($event->getCategories() as $cat) {
				$foundevent['className'] .= ' woehrlseminare-category-' . $cat->getUid();
			}

			//~ $foundevent['className'] = 'woehrlseminare-category-' . $event->getCategories(); // $_GET['categories'];
			if ($event->getEndDateTime() instanceof DateTime)
				$foundevent['end'] = $event->getEndDateTime()->format('Y-m-d H:i:s');

			$conf = array(
				// Link to current page
				'parameter' => $_GET['detailPid'],
				// Set additional parameters
				'additionalParams' => '&type=0&tx_woehrlseminare_eventlist%5Bevent%5D='.$event->getUid().'&tx_woehrlseminare_eventlist%5Baction%5D=show',
				// We must add cHash because we use parameters
				'useCacheHash' => 1,
				// We want link only
				'returnLast' => 'url',
			);
			$url = $cObj->typoLink('', $conf);
			//~
			$foundevent['url'] = $url;

			if ($event->getAllDay())
				$foundevent['allDay'] = true;
			else
				$foundevent['allDay'] = false;

			// how many free places are available?
			$freePlaces = ($event->getMaxSubscriber() - $this->subscriberRepository->countAllByEvent($event));
			if ($freePlaces <= 0)
				$foundevent['freePlaces'] = 0;
			else if ($freePlaces == 1)
				$foundevent['freePlaces'] = Tx_Extbase_Utility_Localization::translate('tx_woehrlseminare_domain_model_event.oneFreePlace', 'woehrl_seminare');
			else
				$foundevent['freePlaces'] = ($event->getMaxSubscriber() - $this->subscriberRepository->countAllByEvent($event)) . ' ' . Tx_Extbase_Utility_Localization::translate('tx_woehrlseminare_domain_model_event.freeplaces', 'woehrl_seminare');

			// set special css class if subscription is NOT possible
			$noSubscription = FALSE;
			// limit reached already --> overbooked
			if ($this->subscriberRepository->countAllByEvent($event) >= $event->getMaxSubscriber()) {
				$noSubscription = TRUE;
			}
			// event is cancelled
			if ($event->getCancelled()) {
				$noSubscription = TRUE;
			}
			// deadline reached....
			if (is_object($event->getSubEndDateTime())) {
				if ($event->getSubEndDateTime()->getTimestamp() < time()) {
					$noSubscription = TRUE;
				}
			}
			if ($noSubscription) {
				$foundevent['className'] .= ' no_subscription';
			}

			$jsonevent[] = $foundevent;
		}
		return json_encode($jsonevent);
	}

}

?>
