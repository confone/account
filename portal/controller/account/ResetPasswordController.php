<?php
class ResetPasswordController extends ViewController {

	protected function control() {

		$this->render( array(
			'title' => 'Reset Password | Confone',
			'view' => 'account/reset-password.php'
		));
	}
}
?>