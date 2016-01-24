<?php

$extensionPath = t3lib_extMgm::extPath('woehrl_sso_intranet');

$autoload = array(
	'Sv1'	=>	$extensionPath . 'Classes/Service/Sv1.php',
);

return $autoload;
?>