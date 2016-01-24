<?php
namespace Woehrl\WoehrlSeminare\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ViewHelper
 *
 * @author Alexander Fuchs alexander.fuchs@woehrl.de
 */
class NachMonatenSortierenViewHelper extends AbstractViewHelper{

    /**
     *
     * @var Tx_WoehrlSeminare_Domain_Repository_EventRepository
     * @return string $content HTML code
     */
    public function render($event) {


        $content = 'Test';
        return ($content);
    }
}