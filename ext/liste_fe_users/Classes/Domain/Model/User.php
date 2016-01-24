<?php
namespace Woehrl\ListeFeUsers\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf WÖHRL AG
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
 * User
 */
class User extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    /**
     * @return \DateTime
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * @param \DateTime $crdate
     */
    public function setCrdate($crdate)
    {
        $this->crdate = $crdate;
    }

    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @param \DateTime $tstamp
     */
    public function setTstamp($tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * @return boolean
     */
    public function isDisable()
    {
        return $this->disable;
    }

    /**
     * @param boolean $disable
     */
    public function setDisable($disable)
    {
        $this->disable = $disable;
    }

    /**
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * crdate
     *
     * @var \DateTime
     */
    protected $crdate;

    /**
     * tstamp
     *
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * disable
     *
     * @var \bool
     */
    protected $disable;

    /**
     * gender
     *
     * @var \integer
     */
    protected $gender;


}