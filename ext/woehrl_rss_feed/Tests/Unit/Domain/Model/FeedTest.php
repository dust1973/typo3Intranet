<?php

namespace WOEHRL\WoehrlRssFeed\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <Alexander.Fuchs@woehrl.de>, Rudolf WÖHRL AG
 *
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
 * Test case for class \WOEHRL\WoehrlRssFeed\Domain\Model\Feed.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Alexander Fuchs <Alexander.Fuchs@woehrl.de>
 */
class FeedTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WOEHRL\WoehrlRssFeed\Domain\Model\Feed
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WOEHRL\WoehrlRssFeed\Domain\Model\Feed();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function dummyTestToNotLeaveThisFileEmpty() {
		$this->markTestIncomplete();
	}
}
