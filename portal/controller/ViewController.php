<?php
abstract class ViewController {

	protected function render($params) {
		foreach ($params as $key=>$val) {
			${$key} = $val;
		}

		if (file_exists('view/'.$view)) {
			include 'view/'.$view;
		} else {
			throw new Exception('View does not exist.');
		}
	}

	protected function redirect($url) {
		header('Location: '.$url);
		exit;
	}

	public function execute() {
		if ($this->checkLogin()) {
			global $_ASESSION, $_URI;
			if (!$_ASESSION->exist(ASession::$AUTHINDEX)) {
				$this->redirect('login?redirect_uri='.$_URI);
			}
		}

		$this->control();
	}

	protected function checkLogin() {
		return true;
	}

	abstract protected function control();
}
?>