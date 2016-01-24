<?php

namespace Woehrl\WoehrlSsoIntranet\Service;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf  W�HRL AG
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

if (version_compare(TYPO3_branch, '6.0', '<')) {
	require_once(t3lib_extMgm::extPath('sv') . 'class.tx_sv_auth.php');
}

/**
 * SSO authentication service.
 *
 * @author     Alexander Fuchs <alexander.fuchs@woehrl.de>, Rudolf  W�HRL AG
 * 
 */
class Sv1 extends \TYPO3\CMS\Sv\AuthenticationService { 

	// from tx_sv_authbase:
	// var $pObj; // Parent object
	// var $mode; // Subtype of the service which is used to call the service.
	// var $login=array(); // Submitted login form data
	// var $authInfo=array(); // Various data
	// var $db_user=array(); // User db table definition
	// var $db_groups=array(); // Usergroups db table definition
	// var $writeAttemptLog = false; // If the writelog() functions is called if a login-attempt has be tried without success
	// var $writeDevLog = false; // If the t3lib_div::devLog() function should be used
	
	
	var $prefixId = 'Sv1'; // Same as class name
	var $scriptRelPath = 'Classes/Service/Sv1.php'; // Path to this script relative to the extension dir.
	var $extKey = 'woehrl_sso_intranet'; // The extension key.
	
	

	 /**
	 * Initialization of the service 
	 *
	 * 
	 * @return int|True if available
	 */
	
	public function init() { 
		
		//\TYPO3\CMS\Core\Utility\DebugUtility::debugInPopUpWindow(parent::init(), 'true if the service available');
        //\TYPO3\CMS\Core\Utility\DebugUtility::debugInPopUpWindow($_SERVER, 'dbUserSetup');
		return parent::init();
	} 

	/**
	 * Authenticates a user 
	 *
	 * @param array $user Data of user.
	 * @return int|FALSE
	 * @return values:
	 * 200 - authenticated and no more checking needed - useful for IP checking without password
     * 100 - Just go on. User is not authenticated but there's still no reason to stop.
	 * false - this service was the right one to authenticate the user but it failed
     * true - this service was able to authenticate the user
	 */
	 
	public function authUser($user) {
		$OK = 100;

		if ($username = $this->getRemoteUserName())	{
			$dbUserSetup = $this->db_user;
			//\TYPO3\CMS\Core\Utility\DebugUtility::debugInPopUpWindow($dbUserSetup, 'dbUserSetup');
			if (!$dbUserSetup['checkPidList']) {
				$dbUserSetup['check_pid_clause'] = ' ';
			}
			$logonUser = $this->fetchUserRecord($username, '', $dbUserSetup);
			if ($user['username'] == $logonUser['username']) {
				$OK = 200;
			}
		}
		
		return $OK;
	}

	/**
	 * External authentication of login data
	 *
	 * @return    mixed    user array or false
	 */
	public function getUser() {
		$user = false;
		if ($username = $this->getRemoteUserName())	{
			$dbUserSetup = $this->db_user;
			if (!$dbUserSetup['checkPidList']) {
				$dbUserSetup['check_pid_clause'] = ' ';
			}
			$user = $this->fetchUserRecord($username, '', $dbUserSetup);
		}
		//\TYPO3\CMS\Core\Utility\DebugUtility::debugInPopUpWindow($user, 'user');
		return $user;
	}

	public function getRemoteUserName() {
	
	
		if (array_key_exists('REMOTE_USER', $_SERVER))	{
 			$username = $_SERVER['REMOTE_USER'];
			
 			if (array_key_exists('SERVER_SOFTWARE', $_SERVER)) {
 				$parts = explode('/', $_SERVER['SERVER_SOFTWARE']);
 				if (strcasecmp($parts[0], 'Microsoft-IIS') == 0) {
					if (!strstr($_SERVER['REMOTE_USER'], '\\')) {
				 		return false;
 				  }
					list($domain, $username) = 
						explode('\\', $_SERVER['REMOTE_USER']);
 				}else{
					list($domain, $username) = 
						explode('\\', $_SERVER['REMOTE_USER']);
				}
 			}
		
 			return $username;
 		}
		return false;
	}

}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/woehrl_sso_intranet/Classes/Service/Sv1.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/woehrl_sso_intranet/Classes/Service/Sv1.php']);
}
