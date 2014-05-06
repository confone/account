<?php
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

$PNG_WEB_DIR = 'temp/';

include "qrlib.php";

$filename = $PNG_TEMP_DIR.'test.png';

$errorCorrectionLevel = 'L';
if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H'))) {
	$errorCorrectionLevel = $_REQUEST['level'];
}

$matrixPointSize = 4;
if (isset($_REQUEST['size'])) {
	$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
}

$filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);

header('Content-Type: image/png');
readfile($PNG_WEB_DIR.basename($filename));
?>