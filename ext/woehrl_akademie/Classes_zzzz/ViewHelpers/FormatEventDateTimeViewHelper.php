<?php
namespace Woehrl\WoehrlAkademie\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class FormatEventDateTimeViewHelper	extends AbstractViewHelper {

	/**
	 * @param \DateTime $start
	 * @param \DateTime $stop
	 * @return \string
	 */
	public function render($start, $stop=NULL) {
		if($stop === NULL) {
			$content = $start->format('d.m.Y H:i:s');
		} else {
			if($start->format('Y-m-d') === $stop->format('Y-m-d')) {

				$content = $start->format('d.m.Y') .
					' ' . $start->format('H:i');


				if($start->format('H:i') !== $stop->format('H:i')) {
					$content .= ' - ' . $stop->format('H:i');
					$content .= ' <small>(' . $start->diff($stop)->format('%h:%I') . ' hours)</small>';
				}

			} else {
				$content = $start->format('d.m.Y H:i:s') . ' - ' .  $stop->format('d.m.Y H:i:s');
			}
		}
		return $content;
	}

}