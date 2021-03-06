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
 * Add newsslider extension to the wizard in page module
 *
 * @package TYPO3
 * @subpackage tx_newsslider
 */
class tx_newsslider_wizicon {

  /**
   * Processing the wizard items array
   *
   * @param array $wizardItems The wizard items
   * @return array Modified array with wizard items
   */
  function proc($wizardItems)     {
    $wizardItems['plugins_tx_newsslider'] = array(
      'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('newsslider') . 'Resources/Public/Icons/user_defined.gif',
      'title' => 'News slider',
      'description' => '3 jQuery slider-plugins for versatile news extension (news).',
      'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=newsslider_pi1'
    );
  
    return $wizardItems;
  }
}
?>