<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "ig_ldap_sso_auth".
 *
 * Auto generated 11-08-2015 16:47
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'LDAP / SSO Authentication',
	'description' => 'This extension provides LDAP support for TYPO3 by delegating the authentication of frontend and/or backend users to the centrally-managed directory of your organization. It fully supports OpenLDAP, Active Directory and Novell eDirectory and is capable of connecting securely to the authentication server using either TLS or SSL (ldaps://).
In case of use in an intranet environment, this extension is a perfect match since it natively brings Single Sign-On (SSO) capability to TYPO3 without any complex configuration.',
	'category' => 'services',
	'version' => '3.0.1',
	'state' => 'stable',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Xavier Perseguers',
	'author_email' => 'xavier@causal.ch',
	'author_company' => '',
	'constraints' => 
	array (
		'depends' => 
		array (
			'typo3' => '6.2.0-7.99.99',
			'php' => '5.3.3-5.6.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

