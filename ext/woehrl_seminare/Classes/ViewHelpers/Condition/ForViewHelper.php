<?php

class Tx_WoehrlSeminare_ViewHelpers_Condition_ForViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
    /**
     * @param integer $start
     * @param integer $until
     * @param string $as
     * @param array $array
     * @param string $arrayValue
     *
     * @return string
     */
    public function render($start,$until,$as = null,$array = null,$arrayValue = null) {
        //$returnValue = 'Bewertung: ';
        $returnValue='&nbsp;&nbsp;';
        for($i = (int)$start;$i<(int)$until;$i++) {
            $returnValue .='<span class="glyphicon glyphicon-star" style="color: #f6a828;line-height:24px;"></span>&nbsp; ';
        }
        $until = 5- $until;
        for($i = (int)$start;$i<(int)$until;$i++) {
            $returnValue .='<span class="glyphicon glyphicon-star" style="color:#fed22f;line-height:24px;"></span> ';
        }
        //TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($returnValue);
        return $returnValue;
    }


} 