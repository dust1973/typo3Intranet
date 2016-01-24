<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Helmut Hackbarth <typo3@t3solution.de>
*  All rights reserved
*  Based on tx_news by Georg Ringer <typo3@ringerge.org>
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
 * ViewHelper to include a css/js file
 *
 * @package TYPO3
 * @subpackage T3S\Newsslider\
 */
class Tx_Newsslider_ViewHelpers_IncludeFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Include a CSS/JS file
	 *
	 * @param string $path Path to the CSS/JS file which should be included
	 * @param boolean $compress Define if file should be compressed
	 * @return void
	 */
	public function render($path, $compress=FALSE ) {


    $settings = $this->templateVariableContainer->get('settings');

		$path = $GLOBALS['TSFE']->tmpl->getFileName($path);


			// JS
		if (strtolower(substr($path, -3)) === '.js') {

      if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('vhs')) {
          // VHS Asset
        Tx_Vhs_Asset::createFromFile($path);

      } else {

        $compress = $settings['compressJS'] ? 'TRUE' : 'FALSE';

        if ($settings['moveJsFromHeaderToFooter']) {
          $GLOBALS['TSFE']->getPageRenderer()->addJsFooterFile($path, NULL, $compress);
        } else {
          $GLOBALS['TSFE']->getPageRenderer()->addJsFile($path, NULL, $compress);
        }

      }
		  // CSS
		} elseif (strtolower(substr($path, -4)) === '.css') {

			$compress = $settings['compressCSS'] ? 'TRUE' : 'FALSE';

			$GLOBALS['TSFE']->getPageRenderer()->addCssFile($path, 'stylesheet', 'all', '', $compress);
		}
	}
}
?>