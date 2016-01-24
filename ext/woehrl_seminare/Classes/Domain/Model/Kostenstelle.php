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
 *
 *
 * @package woehrl_seminare
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_WoehrlSeminare_Domain_Model_Kostenstelle extends TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * editcode of the Kostenstelle
	 *
	 * @var string
	 */
	protected $editcode;

	/**
	 * @return string
	 */
	public function getEditcode()
	{
		return $this->editcode;
	}

	/**
	 * @param string $editcode
	 */
	public function setEditcode($editcode)
	{
		$this->editcode = $editcode;
	}

	/**
	 * @return string
	 */
	public function getHaus()
	{
		return $this->haus;
	}

	/**
	 * @param string $haus
	 */
	public function setHaus($haus)
	{
		$this->haus = $haus;
	}

	/**
	 * @return string
	 */
	public function getKostenstelle()
	{
		return $this->kostenstelle;
	}

	/**
	 * @param string $kostenstelle
	 */
	public function setKostenstelle($kostenstelle)
	{
		$this->kostenstelle = $kostenstelle;
	}

	/**
	 * @return string
	 */
	public function getPreis()
	{
		return $this->preis;
	}

	/**
	 * @param string $preis
	 */
	public function setPreis($preis)
	{
		$this->preis = $preis;
	}



	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getVorname()
	{
		return $this->vorname;
	}

	/**
	 * @param string $vorname
	 */
	public function setVorname($vorname)
	{
		$this->vorname = $vorname;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * haus of the Kostenstelle
	 *
	 * @var string
	 */
	protected $haus;

	/**
	 * kostenstelle of the Kostenstelle
	 *
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
	 * @param string $eventtitle
	 */
	public function setEventtitle($eventtitle)
	{
		$this->eventtitle = $eventtitle;
	}

	/**
	 * eventtitle of the Kostenstelle
	 *
	 * @var string
	 */
	protected $eventtitle;

	/**
	 * @return boolean
	 */
	public function isHidden()
	{
		return $this->hidden;
	}

	/**
	 * @param boolean $hidden
	 */
	public function setHidden($hidden)
	{
		$this->hidden = $hidden;
	}

	/**
	 * hidden
	 *
	 * @var boolean
	 */
	protected $hidden = FALSE;


}
?>