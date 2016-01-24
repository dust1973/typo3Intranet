<?php
namespace Woehrl\WoehrlAkademie\Domain\Repository;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * The repository for Kurs
 */
class KursRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	
	/**
	 * Returns all objects of this repository.
	 *
	 * @param \Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorie
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|array
	 * @api
	 */
	public function findByKategorie(\Woehrl\WoehrlAkademie\Domain\Model\Kategorie $kategorie) {
		$query = $this->createQuery();
		$query->matching($query->contains('kategorien', $kategorie));
		$query->setOrderings(
			array(
				//'eventDateTimeStart' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
				'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
			)
		);
		//var_dump($query->getSource());

		return $query->execute();
	}

}
?>