<?php
class LoginController extends ViewController {

	protected function control() {
		$username = param('username');
		$password = param('password');

		$this->render( array(
			'view' => 'account/login.php',
			'username' => $username,
			'password' => $password
		));
	}
}
?>