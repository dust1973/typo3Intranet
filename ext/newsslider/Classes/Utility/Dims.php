<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Helmut Hackbarth <info@t3solution.de>
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
 * Get the dimensions for jslidernews jquery plugin
 *  
 * @package TYPO3
 * @subpackage T3S\Newsslider\ 
 */
class Tx_Newsslider_Utility_Dims {

	/**
	 * Get the dims
	 *
   * @param array $s  settings
	 * @return array $s
	*/
	public static function getDims( $s ) {

      // size of the slider
    $s['width'] = $s['width'] ? $s['width'] : 700;
    $s['height'] = $s['height'] ? $s['height'] : 300;
    // size of the image (you have to modify your css if change this settings)
    $s['imgWidth'] = $s['imgWidth'] ? $s['imgWidth'] : $s['width'];
    $s['imgHeight'] = $s['imgHeight'] ? $s['imgHeight'] : $s['height'];
    // maxItemDisplay in the navigator
    $s['maxItemDisplay'] = $s['maxItemDisplay'] ? $s['maxItemDisplay'] : 3;

    switch ($s['style']) {
      case '1' :
        // size of the thumbnails
        $s['thumbProportion'] = $s['thumbProportion'] ? $s['thumbProportion'] : 10;
        $s['thumbWidth'] = intval($s['width'] / $s['thumbProportion']);
        $s['thumbHeight'] = intval($s['height'] / $s['thumbProportion']);
        // size of the navigator
        $s['navWidth'] = $s['verticalNav'] ? $s['thumbWidth'] + 10 : $s['thumbWidth'] + 10;
        $s['navHeight'] = $s['verticalNav'] ? $s['thumbHeight'] + 9 : $s['thumbHeight']  + 6;
        // 0 makes no sense here
        $s['navThumb'] = 1;
      break;
      
      case '2' :
      case '3' :
        // ( padding: 2x 15px ) + ( marginTop: 2px ) = 32
        $s['innerNavSelectorCssFixHeight'] = $s['innerNavSelectorCssFixHeight'] ? $s['innerNavSelectorCssFixHeight'] : 32;
        // ( padding: 2x 3px ) + ( border: 2x 1px ) = 8
        $s['thumbCssFixHeight'] = $s['thumbCssFixHeight'] ? $s['thumbCssFixHeight'] : 8;
        $totalCssFixHeight = $s['innerNavSelectorCssFixHeight'] + $s['thumbCssFixHeight'];
        // compute navHeight and check height
        $s['navHeight'] = intval(($s['height'] / $s['maxItemDisplay']));
        $s['height'] = $s['navHeight'] * $s['maxItemDisplay'];
        // compute navWidth
        $s['navWidth'] = $s['navWidth'] ? $s['navWidth'] : 300;
        // show thumbnails in navigation
        $s['navThumb'] = $s['navThumb'] ? 1 : 0;
        // compute thumbWidth and thumbHeight 
        $s['thumbWidth'] = $s['thumbWidth'] ? $s['thumbWidth'] : ($s['navHeight'] - $totalCssFixHeight);
        $s['thumbHeight'] = $s['thumbHeight'] ? $s['thumbHeight'] : ($s['navHeight'] - $totalCssFixHeight);
        // compute the innerNavSelectorHeight
        $s['innerNavSelectorHeight'] = $s['navHeight'] - $s['innerNavSelectorCssFixHeight'];
        // compute the alphaHeight - marginTop 2px + 2x 2px border = 6
        $s['alphaHeight'] = $s['navHeight'] - 6;
      break;

      case '4' :
        // size of the navigator
        $s['navWidth'] = $s['navWidth'] ? $s['navWidth'] : 25;
        $s['navHeight'] = $s['navHeight'] ? $s['navHeight'] : 15;
        // 1 makes no sense here
        $s['navThumb'] = 0;
      break;
      
      case '5' :
        // 1 makes no sense here
        $s['navThumb'] = 0;
      break;
    }

		return $s;
	}



}

?>