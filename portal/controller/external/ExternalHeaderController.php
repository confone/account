<?php
class ExternalHeaderController extends ViewController {

	protected function control() {
		header('Content-Type: application/javascript');
		header('Cache-Control: no-cache');

		$content = 'var temp = 4;';
		echo $content;
	}

	protected function checkLogin() {
		return false;
	}
}
?>