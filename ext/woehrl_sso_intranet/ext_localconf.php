<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

// Configuration of authentication service.
$EXT_CONFIG = unserialize($TYPO3_CONF_VARS['EXT']['extConf']['woehrl_sso_intranet']);

// SSO configuration

if($EXT_CONFIG['enableFetchUserIfNoSession']){
	$TYPO3_CONF_VARS['SVCONF']['auth']['setup']['FE_fetchUserIfNoSession'] = 1;
}
else{
	$TYPO3_CONF_VARS['SVCONF']['auth']['setup']['FE_alwaysFetchUser'] = 1;
}


require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Service/Sv1.php');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService
	($_EXTKEY,  'auth' /* sv type */,  'Sv1' /* sv key */,
		array(
			'title' => 'SSO Intranet Login',
			'description' => 'SSO Authentication service',
			'subtype' => 'getUserFE,authUserFE',
			'available' => TRUE,
			'priority' => 70,
			'quality' => 70,
			'os' => '',
			'exec' => '',
			'classFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Service/Sv1.php',
			'className' => 'Woehrl\WoehrlSsoIntranet\Service\Sv1',
		)
	);

?>
