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
 * Repository for tt_content objects
 *
 * @package TYPO3
 * @subpackage tx_news
 * @author Juerg Langhard <langhard@greenbanana.ch>
 */
class Tx_News_Domain_Repository_TtContentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $objectType = 'Tx_News_Domain_Model_TtContent';
}
