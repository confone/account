<?php
class ActivationController extends ViewController {

	protected function control() {
		$uid = param('sid');
		$token = param('token');

		$user = new User($uid);
		$success = $user->activate($token);

		$this->render( array(
			'title' => 'Account Activation | Confone',
			'view' => 'account/activation.php'
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>