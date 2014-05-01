<?php
class ActivationController extends ViewController {

	protected function control() {
		$uid = param('sid');
		$token = param('token');

		$user = new User($uid);
		$success = $user->activate($token);

		if (!$success) {
			if ($user->isActive()) {
				$error = 'Your account is already activated, please <a href="/login">Sign in</a>';
			} else {
				$error = 'Your account cannot be activated now, please try again later.';
			}
		}

		$this->render( array(
			'title' => 'Account Activation | Confone',
			'view' => 'account/activation.php',
			'success' => $success,
			'error' => isset($error) ? $error :  null
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>