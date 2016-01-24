<?
#################################################################################
#
# SSO Connector for eu_sso extensions
# Author:	Norman Seibert
#
# Based on:
#
# WebGrab Version 1.0
# Autor:	Michael Brauchl
# Datum:  31.12.2001
# Lizenz: GPL
#
#################################################################################

define('SERVERVARS_FILE','c:/cache.php');
define('KEY_FILE','c:/owa_key.php');

# called by shutdown function
function _SaveServerVars($name='varArr') {

	global $$name;

	$array = $$name;
	if (empty($array['save'])) return false;
	
	$d = date('Y-m-d H:i:s');
	$s = "<?php\n/* SERVER VARS START $d */\n\nglobal \$$name;\n\n";

	foreach($array as $k => $v) {
		if ($k == 'save') continue;
		if (is_string($v)) {
			$v = str_replace("'","\\'",$v);
			$s .= "\$\{$name}['$k'] = '$v';\n";	
		} else if (is_bool($v)) {	
			$v = ($v)? 'true' : 'false';
			$s .= "\$\{$name}['$k'] = $v;\n";
		} else if (is_numeric($v)) {
			$s .= "\$\{$name}['$k'] = $v;\n";
		} elseif (!is_null($v)) {
			$v =  str_replace("'","\\'",serialize($v));
			$s .= "\$\{$name}['$k'] = unserialize('$v');\n";	
		}
	}
	
	$s .= "\n\$\{$name}['save']=0; ".
	"# set this to 1 to save server vars\n/* SERVER VARS END */\n?>";
	
	$f = fopen(SERVERVARS_FILE,'w');
	if ($f === false) {
		trigger_error("Unable to create server vars");
		return;
	}

	if ( strtoupper(substr(PHP_OS, 0, 3)) == 'WIN' || flock($f,LOCK_EX))
		$rez = fwrite($f,$s);
	fclose($f);
	
	$array['save'] = false;

	if ($rez == -1) {
		trigger_error("Unable to save server vars");
	}
}

/* Try loading once */
@include(SERVERVARS_FILE);
@include(KEY_FILE);

/* if include failed, give some time to allow writing of other process to complete */
register_shutdown_function('_SaveServerVars');

/* 
	Test if file is being written to, as $SERVER['save'] is saved last.
	So if we are still writing, $varArr['save'] would not have been saved yet.
*/
$INCLUDE_SERVERVARS_COUNT = 200;
while (!isset($varArr['save']) && --$INCLUDE_SERVERVARS_COUNT) {
	@include(APPVARS_FILE);
}


### Ein Formular zum Server senden ##############################################
#
# Diese Funktion sendet die Daten, die zuerst an das Skript WebGrab gepostet
# wurden an den Server. Es wird dabei ein Browser und die Funktion POST
# simuliert.
#
#################################################################################

function PostToHost( $host, $path, $referer, $data_to_send) {
	global $http_header;
    
	$cRetVal = "";
	
	if ($path[0] != '/') $path = '/'.$path;

	// Die Session initialisieren
	$ch = curl_init ();
	//Session Optionen setzen
	curl_setopt ($ch, CURLOPT_URL, $host.$path);
	curl_setopt($ch, CURLOPT_POST,1);
	//echo $data_to_send; die();
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_send);
	curl_setopt ($ch, CURLOPT_HEADER, 1);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_REFERER, $referer);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	//Ausführen der Aktionen
	$cRetVal = curl_exec ($ch);
	curl_close ($ch);

	$TempVal = explode("\r\n\r\n", $cRetVal);
	$http_header = $TempVal[0]."\r\n\r\n".$TempVal[1];
	$chunked_content = trim(str_replace($http_header,'',$cRetVal));
	
	$cRetVal=$chunked_content;	
	return $cRetVal;
}

function _srand() {
    static $initialized;

    if (empty($initialized)) {
        mt_srand((double)microtime() * 1000000);
        $initialized = true;
    }
}

function decrypt($key, $ciphertext) {
	static $mcrypt_deinit;
	if (extension_loaded('mcrypt')) {
	    _srand();
	    $td = @mcrypt_module_open(MCRYPT_GOST, '', MCRYPT_MODE_ECB, '');
	    if ($td) {
	        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	        @mcrypt_generic_init($td, $key, $iv);
			
	        $decrypted_data = mdecrypt_generic($td, $ciphertext);
	
	        if (!isset($mcrypt_deinit)) {
	            $mcrypt_deinit = function_exists('mcrypt_generic_deinit');
	        }
	
	        if ($mcrypt_deinit) {
	            mcrypt_generic_deinit($td);
	        } else {
	            mcrypt_generic_end($td);
	        }
	
	        // Strip padding characters.
	        return rtrim($decrypted_data, "\0");
	    }
	}
}

#################################################################################
### Start der Hauptroutine ######################################################
#################################################################################

// timeout between session start (background) and and foreground call in seconds
$timeout = 2;

unset ($url);
unset ($http_header);

if ($_GET['init']) {
	$querystring = decrypt($ssokey, base64_decode($_GET['init']));
	$arrparam = unserialize($querystring);
	$t3_sessionid = $arrparam['t3_sessionid'];
	while (list($k, $v) = each ($arrparam)) {
		if ($k != 't3_sessionid') {
			$varArr[$t3_sessionid.'_'.$k] = $v;
			$varArr['save'] = true;
		}
	}
	unset($arrparam);
} elseif ($_GET['call']) {
	$querystring = decrypt($ssokey, base64_decode($_GET['call']));
	$arrparam = unserialize($querystring);
	$t3_sessionid = $arrparam['t3_sessionid'];
	$userkey = decrypt($varArr[$t3_sessionid.'_key1'], $arrparam['userkey']);
	while (list($k, $v) = each ($varArr)) {
		if (strpos($k, $t3_sessionid) == 0) {
			$arrparam[substr($k, strlen($t3_sessionid)+1)] = $varArr[$k];
			$varArr[$k] = NULL;
		}
	}
	$arrparam[$arrparam['pwd_field']] = decrypt($userkey, $arrparam['pwd_content']);
	//if (time() - $arrparam['tstamp'] > $timeout) unset($arrparam);
	
	$varArr[$t3_sessionid.'_tstamp'] = NULL;
	
	//$varArr['save'] = true;
}

if (isset($arrparam) AND count($arrparam)>0) {

	if (isset($arrparam['webgrab_path']))
		$webgrab_path = urldecode($arrparam['webgrab_path']);
	else
		$webgrab_path = 'http://'.$SERVER_NAME.$REQUEST_URI;

	if (isset($arrparam['referer']))
		$referer = urldecode($arrparam['referer']);
	else
		$referer = '';
	
	preg_match_all("/http\:\/\/([^\?|\&|\/]*)/i", $webgrab_path, $temp);
	
	$url['host'] = $temp[1][0];
	$url['protocol'] = 'http';
	
	if (!$url['host']) {
		preg_match_all("/https\:\/\/([^\?|\&|\/]*)/i", $webgrab_path, $temp);
		$url['host'] = $temp[1][0];
		$url['protocol'] = 'https';
	}
	
	preg_match_all("/([a-zA-Z1234567890]+.[a-zA-Z1234567890]+)\/?$/i", $url['host'], $temp);
	$url['domain'] = $temp[1][0];

	preg_match_all("/".$url['protocol']."\:\/\/[^\?|\&|\/]*(\/[^\?|\&]*)/i", $webgrab_path, $temp);
	if (isset($temp[1][0]))
		$url['path'] = $temp[1][0];
	else
		$url['path'] = '/';
	
	preg_match_all("/".$url['protocol']."\:\/\/[^\?]*\?(.*)/i", $webgrab_path, $temp);
	if (isset($temp[1][0])) {
		$url['query'] = $temp[1][0];
		if ($url['query'][0] == '&')
			$url['query'] = substr($url['query'],1);
		$url['query']='?'.$url['query'];
	}

	reset($arrparam);
	
	$parms = '';
	while (list($k, $v) = each ($arrparam)) {
		if ($k == 'webgrab_path') continue;
		if ($k == 'referer') continue;
		if ($k == 'tstamp') continue;
		if ($k == 'key1') continue;
		if ($k == 'userkey') continue;
		if ($k == 't3_sessionid') continue;
		if ($k == 'pwd_field') continue;
		if ($k == 'pwd_content') continue;
		if (is_array($v)) {
			while (list($sk, $sv) = each ($v)) {
				if (strstr($sv,'&')) $sv=str_replace('&','%26',$sv);
				if (strstr($sv,'?')) $sv=str_replace('?','%3F',$sv);
				$parms.='&'.$k.'['.$sk.']='.stripslashes($sv);
			}
		} else {
			if (strstr($v,'&')) $v=str_replace('&','%26',$v);
			if (strstr($v,'?')) $v=str_replace('?','%3F',$v);
			$parms.='&'.$k.'='.$v;
		}
	}
	
	if (strtoupper(substr($url['path'],-4)) != '.HTM')
		$parms = substr($parms, 1);
	$webgrab_action = 'POST';

	$path = $url['path'];
	
	if(isset($url['query']) AND strlen($url['query'])>1)
		$path = $path.$url['query'];
	
	unset($content);
	unset($http_header);
	
	$content = PostToHost( $url['protocol'].'://'.$url['host'], $path, $referer, $parms );
	
	$all_headers = explode("\r\n",$http_header);
	
	foreach ($all_headers as $this_header) {
		if (stristr($this_header, 'Content-Length')) {
			//echo("Content-Length: ".strlen(trim($content))."\r\n");
			header("Content-Length: ".strlen(trim($content))."\r\n");
		} elseif (stristr($this_header, 'Location')) {
			//echo $this_header."\r\n";
			header($this_header."\r\n");
		} elseif (stristr($this_header, 'Set-Cookie')) {
			//echo $this_header."\r\n";
			header($this_header."\r\n", false);
		} elseif (stristr($this_header, 'HTTP')) {
			//echo $this_header."\r\n";
			header($this_header."\r\n");
		}
	}
	
	echo trim($content);
} else {
	echo "OK.";
}
?>
