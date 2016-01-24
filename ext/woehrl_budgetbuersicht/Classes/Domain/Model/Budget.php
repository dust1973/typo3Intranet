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
class Budget extends  \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * uid
	 * @var int
	 * @validate NotEmpty
	 */
	protected $uid;

	/**
	 * @return int
	 */
	public function getUid()
	{
		return $this->uid;
	}

	/**
	 * @return int
	 */
	public function getPid()
	{
		return $this->pid;
	}
	/**
	 * pid
	 * @var int
	 * @validate NotEmpty
	 */
	protected $pid;


	/**
	 * haus
	 * @var string
	 */
	protected $haus;

	/**
	 * @return mixed
	 */
	public function getHaus()
	{
		return $this->haus;
	}

	/**
	 * @return mixed
	 */
	public function getKostenstelle()
	{
		return $this->kostenstelle;
	}

	/**
	 * kostenstelle
	 * @var string
	 */
	protected $kostenstelle;



	/**
	 * preis of the Kostenstelle
	 *
	 * @var string
	 */
	protected $preis;



	/**
	 * email of the Kostenstelle
	 *
	 * @var string
	 */
	protected $email;

	/**
	 * @return string
	 */
	public function getPreis()
	{
		return $this->preis;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return string
	 */
	public function getVorname()
	{
		return $this->vorname;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}



	/**
	 * vorname of the Kostenstelle
	 *
	 * @var string
	 */
	protected $vorname;

	/**
	 * name of the Kostenstelle
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * @return string
	 */
	public function getEventtitle()
	{
		return $this->eventtitle;
	}


	/**
	 * eventtitle of the Kostenstelle
	 *
	 * @var string
	 */
	protected $eventtitle;

}
?>