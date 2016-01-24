<?php
namespace Woehrl\WoehrlBudgetbuersicht\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alex Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * Haus
 */
class Haus extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * kostenstelle
	 * 
	 * @var string
	 */
	protected $kostenstelle = '';

	/**
	 * budgetKst
	 * 
	 * @var string
	 */
	protected $budgetKst = '';

	/**
	 * Returns the kostenstelle
	 * 
	 * @return string $kostenstelle
	 */
	public function getKostenstelle() {
		return $this->kostenstelle;
	}

	/**
	 * Sets the kostenstelle
	 * 
	 * @param string $kostenstelle
	 * @return void
	 */
	public function setKostenstelle($kostenstelle) {
		$this->kostenstelle = $kostenstelle;
	}

	/**
	 * Returns the budgetKst
	 * 
	 * @return string $budgetKst
	 */
	public function getBudgetKst() {
		return $this->budgetKst;
	}

	/**
	 * Sets the budgetKst
	 * 
	 * @param string $budgetKst
	 * @return void
	 */
	public function setBudgetKst($budgetKst) {
		$this->budgetKst = $budgetKst;
	}

}