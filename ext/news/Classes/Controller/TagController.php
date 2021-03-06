<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Tag controller
 */
class Tx_News_Controller_TagController extends Tx_News_Controller_NewsController {

	const SIGNAL_TAG_LIST_ACTION = 'listAction';

	/**
	 * @var Tx_News_Domain_Repository_TagRepository
	 */
	protected $tagRepository;

	/**
	 * Inject a tag repository to enable DI
	 *
	 * @param Tx_News_Domain_Repository_TagRepository $tagRepository
	 * @return void
	 */
	public function injectTagRepository(Tx_News_Domain_Repository_TagRepository $tagRepository) {
		$this->tagRepository = $tagRepository;
	}

	/**
	 * List categories
	 *
	 * @param array $overwriteDemand
	 * @return void
	 */
	public function listAction(array $overwriteDemand = NULL) {
		// Default value is wrong for tags
		if ($this->settings['orderBy'] === 'datetime') {
			unset($this->settings['orderBy']);
		}

		$demand = $this->createDemandObjectFromSettings($this->settings);

		if ($this->settings['disableOverrideDemand'] != 1 && $overwriteDemand !== NULL) {
			$demand = $this->overwriteDemandObject($demand, $overwriteDemand);
		}

		$assignedValues = array(
			'tags' => $this->tagRepository->findDemanded($demand),
			'overwriteDemand' => $overwriteDemand,
			'demand' => $demand,
		);

		$this->emitActionSignal('TagController', self::SIGNAL_TAG_LIST_ACTION, $assignedValues);
		$this->view->assignMultiple($assignedValues);
	}

}
