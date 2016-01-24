<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, WÖHRL Akademie
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
 * Check if given link is local or not
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <f:if condition="<se:link.islocal link='{event.location.link}' />">
 * </code>
 * <output>
 * 1
 * </output>
 *
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @api
 */
//use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class Tx_WoehrlSeminare_ViewHelpers_Condition_MonatAusgebenViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

    /**
     * Checks of Monat
     *
     * @param string $monat
     * @return string
     * @author Alexander Fuchs <alexander.fuchs@woehrl.de>
     */
    public function render($monat) {

        switch($monat){

            case '09': $mon = 'September';
                break;
            case '10': $mon = 'Oktober';
                break;
            case '11': $mon = 'November';
                break;
            case '12': $mon = 'Dezember';
                break;

        }



        return ($mon);

    }
}
?>