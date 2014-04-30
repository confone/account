<?php
class ForgetPasswordController extends ViewController {

	protected function control() {


		$this->render( array(
			'title' => 'Forget Password | Confone',
			'view' => 'account/forgot.php'
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>