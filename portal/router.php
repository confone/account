<?php
include 'config/config.inc';
include '../dao/config/config.inc';

$uri = rtrim(ltrim($_SERVER['REQUEST_URI'], '/'), '/');

$_ASESSION = ASession::instance();
$_TITLE = 'Confone | Welcome';

date_default_timezone_set('America/Vancouver');
header('X-Powered-By: Confone Inc.');

global $access_on;
if ($access_on!=0) { Logger::access($uri); }

// if $uri is set add .php ot its end for include as file name
//
if (!empty($uri)) {
    $gets = explode('?', $uri, 2);

    if (count($gets)>1) {
	    $getParams = explode('&', $gets[1]);
	    foreach ($getParams as $getParam) {
	        $pair = explode('=', $getParam, 2);
	        if (sizeof($pair)==2) {
	            $_GET[$pair[0]] = urlencode($pair[1]);
	        }
	    }

	    $uri = $gets[0];
    }
}

if (is_dir($uri)) {
	if (file_exists($uri.'/index.php')) {
		include $uri.'/index.php';
	} else {
		header('HTTP/1.0 404 Not Found');
		include 'include/404.php';
	}
} else if (file_exists($uri.'.php')) {
	include $uri;
} else if (empty($uri) || $uri=='index') {
	include 'account/login.php';
} else {
	header('HTTP/1.0 404 Not Found');
	include 'include/404.php';
}

function param($key) {
	if (isset($_POST[$key])) {
		return $_POST[$key];
	} else if (isset($_GET[$key])) {
		return urldecode($_GET[$key]);
	} else {
		return null;
	}
}
?>