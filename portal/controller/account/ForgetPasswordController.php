<?php
class ForgetPasswordController extends ViewController {
	
	protected function control() {


		$this->render( array(
			'view' => 'account/forgot.php'
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>