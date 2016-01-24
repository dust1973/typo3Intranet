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
 * ViewHelper to render inlineJS in <head> section of website
 *
 * @package TYPO3
 * @subpackage T3S\Newsslider\
 */
class Tx_Newsslider_ViewHelpers_InlineJsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Renders InlineJs
	 *
	 * @param integer $contentObjectUid
	 * @return void
	*/
	public function render( $contentObjectUid ) {

    $settings = $this->templateVariableContainer->get('settings');

    $name=' JavaScript for News-Slider CE-'.$contentObjectUid.' ';
    $queryNoConflict = $settings['jqueryNoConflict'] ? 'jQuery.noConflict()' : 'jQuery';
    $compress = $settings['compressJS'] ? 'TRUE' : 'FALSE';

    switch ( $this->controllerContext->getRequest()->getControllerActionName() ) {
      case 'jslidernews':
        // script-options
        $options = 'sliderId:'.$contentObjectUid.',';
        if ( $settings['jslidernews']['style'] == 1 || $settings['jslidernews']['style'] == 4 ) {
          $options .= $settings['jslidernews']['verticalNav'] == 0 ? 'navPosition:\'horizontal\',' : '';
        }
        $options .= $settings['jslidernews']['direction'] ? 'direction:\'opacity\',' : '';
        $options .= $settings['jslidernews']['event'] ? 'navigatorEvent:\'mouseover\',' : '';
        $options .= $settings['jslidernews']['interval'] == 4000 ? '' : 'interval:'.intval($settings['jslidernews']['interval']).',';
        $options .= $settings['jslidernews']['auto'] ? '' : 'auto:false,';
        $options .= $settings['jslidernews']['maxItemDisplay'] == 3 ? '' : 'maxItemDisplay:'.intval($settings['jslidernews']['maxItemDisplay']).',';
        $options .= $settings['jslidernews']['navHeight'] == 100 || $settings['jslidernews']['navHeight'] == 0 ? '' : 'navigatorHeight:'.intval($settings['jslidernews']['navHeight']).',';
        $options .= $settings['jslidernews']['navWidth'] == 300 || $settings['jslidernews']['navWidth'] == 0 ? '' : 'navigatorWidth:'.intval($settings['jslidernews']['navWidth']).',';
        $options .= $settings['jslidernews']['duration'] == 600 ? '' : 'duration:'.intval($settings['jslidernews']['duration']).',';
        $options .= $settings['jslidernews']['easing'] == 'easeInOutQuad' ? '' : 'easing:\''.$settings['jslidernews']['easing'].'\',';
        $options .= $settings['jslidernews']['pause'] == 1 && $settings['jslidernews']['auto'] ? 'pauseOnMouseOver:true,' : '';
        $options .= $settings['jslidernews']['pause'] == 2 && $settings['jslidernews']['auto'] ? 'pauseButton:true,' : '';
        $options .= $settings['jslidernews']['progressbar'] && $settings['jslidernews']['auto'] ? 'progressBar:true,' : '';
        $options .= 'mainWidth:'.intval($settings['jslidernews']['width']);

        // fire jQuery
        if ( $settings['jslidernews']['style'] == 1 || $settings['jslidernews']['style'] == 5 ) {
          $fire = 'var buttons={previous:jQuery(\'#lofslidecontent'.$contentObjectUid.' .lof-previous\'), next:jQuery(\'#lofslidecontent'
          	.$contentObjectUid.' .lof-next\') }; jQueryobj = jQuery(\'#lofslidecontent'.$contentObjectUid.'\').lofJSidernews( {buttons:buttons,';
        } else {
          $fire = 'jQuery(\'#lofslidecontent'.$contentObjectUid.'\').lofJSidernews( {';
        }
        $inlineJS = $queryNoConflict.'(function(){'.$fire.$options.'});});';
      break;
      case 'flexslider':
        // script-options
		# 8 = 2*4 .flexslider border
		$itemWidth = intval(round(($settings['flexslider']['width']-8-($settings['flexslider']['thumbnumber']*
			$settings['flexslider']['itemMargin']-$settings['flexslider']['itemMargin']))/$settings['flexslider']['thumbnumber']));
		$carousel = '';

		if ($settings['flexslider']['style'] == 2) {

        	$options  = 'controlNav:\'thumbnails\',';

		} else {

        	$options  = $settings['flexslider']['controlNav'] ? '' : 'controlNav:false,';

		}

		if ($settings['flexslider']['style'] == 3) {

			$carousel_options = 'animation:\'slide\',';
			$carousel_options .= 'controlNav:false,';
			$carousel_options .= 'animationLoop:false,';
			$carousel_options .= 'slideshow:false,';
			$carousel_options .= 'itemWidth:'.$itemWidth.',';
			$carousel_options .= 'itemMargin:'.$settings['flexslider']['itemMargin'].',';
			$carousel_options .= 'asNavFor:\'#flexslider_'.$contentObjectUid.'\'';
			$carousel = 'jQuery(\'#carousel_'.$contentObjectUid.'\').flexslider({'.$carousel_options.'});';

			$options  = 'controlNav:false,';
        	$options .= 'slideshow:false,';
			$options .= 'animationLoop:false,';
        	$options .= 'sync:\'#carousel_'.$contentObjectUid.'\',';
			$options .= $settings['flexslider']['animation'] == 'fade' ? '' : 'animation:\'slide\',';

		} else {

        	$options .= $settings['flexslider']['slideshow'] ? '' : 'slideshow:false,';

			if ($settings['flexslider']['style'] == 4) {


		        $options .= 'animationLoop:false,';
				$options .= 'animation:\'slide\',';
		        $options .= 'itemWidth:'.$itemWidth.',';
		        $options .= 'itemMargin:'.$settings['flexslider']['itemMargin'].',';

			} else {


				if ($settings['flexslider']['style'] == 5) {

			        $options .= 'animationLoop:false,';
			        $options .= 'animation:\'slide\',';
			        $options .= 'itemWidth:'.$itemWidth.',';
			        $options .= 'itemMargin:'.$settings['flexslider']['itemMargin'].',';
			        $options .= 'minItems:'.intval($settings['flexslider']['minItems']).',';
			        $options .= 'maxItems:'.intval($settings['flexslider']['maxItems']).',';

				} else {

			        $options .= $settings['flexslider']['animationLoop'] == 'true' ? '' : 'animationLoop:false,';
			        $options .= $settings['flexslider']['animation'] == 'fade' ? '' : 'animation:\'slide\',';

				}
			}
		}

        $options .= $settings['flexslider']['startAt'] == 0 				? '' : 'startAt:'.intval($settings['flexslider']['startAt']).',';
        $options .= $settings['flexslider']['slideshowSpeed'] == 7000 		? '' : 'slideshowSpeed:'.intval($settings['flexslider']['slideshowSpeed']).',';
        $options .= $settings['flexslider']['animationSpeed'] == 600 		? '' : 'animationSpeed:'.intval($settings['flexslider']['animationSpeed']).',';
        $options .= $settings['flexslider']['pauseOnAction'] == 'true' 		? '' : 'pauseOnAction:false,';
        $options .= $settings['flexslider']['pauseOnHover'] == 'false' 		? '' : 'pauseOnHover:true,';
        $options .= $settings['flexslider']['useCSS'] == 'true' 			? '' : 'useCSS:false,';
        $options .= $settings['flexslider']['touch'] == 'true' 				? '' : 'touch:false,';
        $options .= $settings['flexslider']['easing'] == 'swing' 			? '' : 'easing:\''.$settings['flexslider']['easing'].'\',';
        $options .= $settings['flexslider']['direction'] == 'horizontal'	? '' : 'direction:\'vertical\',';
        $options .= $settings['flexslider']['reverse'] == 'false' 			? '' : 'reverse:true,';
        $options .= $settings['flexslider']['smoothHeight'] == 'false' 		? '' : 'smoothHeight:true,';
        $options .= $settings['flexslider']['initDelay'] == 0 				? '' : 'initDelay:'.intval($settings['flexslider']['initDelay']).',';
        $options .= $settings['flexslider']['randomize'] == 'false' 		? '' : 'randomize:true,';
        $options .= $settings['flexslider']['video'] == 'false' 			? '' : 'video:true,';
        $options .= $settings['flexslider']['prevText'] == 'Previous' 		? '' : 'prevText:\''.$settings['flexslider']['prevText'].'\',';
        $options .= $settings['flexslider']['nextText'] == 'Next' 			? '' : 'nextText:\''.$settings['flexslider']['nextText'].'\',';
        $options .= $settings['flexslider']['keyboard'] == 'true' 			? '' : 'keyboard:false,';
        $options .= $settings['flexslider']['multipleKeyboard'] == 'false' 	? '' : 'multipleKeyboard:true,';
        $options .= $settings['flexslider']['mousewheel'] == 'false' 		? '' : 'mousewheel:true,';
        $options .= $settings['flexslider']['pausePlay'] == 'false' 		? '' : 'pausePlay:true,';
        $options .= $settings['flexslider']['pauseText'] == 'Pause' 		? '' : 'pauseText:\''.$settings['flexslider']['pauseText'].'\',';
        $options .= $settings['flexslider']['playText'] == 'Play' 			? '' : 'playText:\''.$settings['flexslider']['playText'].'\',';
        $options .= $settings['flexslider']['move'] == 0 					? '' : 'move:'.intval($settings['flexslider']['move']).',';
        $options .= $settings['flexslider']['directionNav'] 				? 'directionNav:true' : 'directionNav:false';

        $inlineJS = $queryNoConflict.'(function(){
        jQuery(\'#flexslider_'.$contentObjectUid.'\').flexslider({'.$options.'});
        '.$carousel.'
        });';

      break;
      case 'nivoslider':
        // script-options
        $options = $settings['nivoslider']['controlNav'] ? '' : 'controlNav:false,';
        $options .= $settings['nivoslider']['manualAdvance'] ? '' : 'manualAdvance:true,';
        $options .= $settings['nivoslider']['effect'] == 'random' ? '' : 'effect:\''.$settings['nivoslider']['effect'].'\',';
        $options .= $settings['nivoslider']['slices'] == 15 ? '' : 'slices:'.$settings['nivoslider']['slices'].',';
        $options .= $settings['nivoslider']['boxCols'] == 8 ? '' : 'boxCols:'.$settings['nivoslider']['boxCols'].',';
        $options .= $settings['nivoslider']['boxRows'] == 4 ? '' : 'boxRows:'.$settings['nivoslider']['boxRows'].',';
        $options .= $settings['nivoslider']['animSpeed'] == 500 ? '' : 'animSpeed:'.$settings['nivoslider']['animSpeed'].',';
        $options .= $settings['nivoslider']['pauseTime'] == 3000 ? '' : 'pauseTime:'.$settings['nivoslider']['pauseTime'].',';
        $options .= $settings['nivoslider']['startSlide'] == 0 ? '' : 'startSlide:'.$settings['nivoslider']['startSlide'].',';
        $options .= $settings['nivoslider']['pauseOnHover'] == 'true' ? '' : 'pauseOnHover:false,';
        $options .= $settings['nivoslider']['randomStart'] == 'false' ? '' : 'randomStart:true,';
        $options .= $settings['nivoslider']['prevText'] == 'Prev' ? '' : 'prevText:\''.$settings['nivoslider']['prevText'].'\',';
        $options .= $settings['nivoslider']['nextText'] == 'Next' ? '' : 'nextText:\''.$settings['nivoslider']['nextText'].'\',';
        $options .= $settings['nivoslider']['directionNav'] ? 'directionNav:true' : 'directionNav:false';

        $inlineJS =  $queryNoConflict.'(window).load(function(){
        jQuery(\'#slider_'.$contentObjectUid.'\').nivoSlider({'.$options.'});
        });';

      break;

    }

    if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('vhs')) {
      $asset = Tx_Vhs_Asset::getInstance();
      $asset->setType('js');
      $asset->setName($name);
      $asset->setContent($inlineJS);
      $asset->finalize();

    } else {

      if ($settings['moveInlineJsFromHeaderToFooter'] ) {
        $GLOBALS['TSFE']->getPageRenderer()->addJsFooterInlineCode($name,$inlineJS,$compress);
      } else {
        $GLOBALS['TSFE']->getPageRenderer()->addJsInlineCode($name,$inlineJS,$compress);
      }
    }
	}
}
?>