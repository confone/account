<?php
class ActivationController extends ViewController {

	protected function control() {
		$uid = param('sid');
		$token = param('token');

		if (empty($uid) || empty($token)) {
			$this->redirect('/login');
		}

		$user = new User($uid);

		if ($user->activate($token)) {
			global $_ASESSION;
			$_ASESSION->set(ASession::$ACTIVATION, null);
			$message = 'Your account has been activated successfully. Please sign in now!';
			$this->redirect('/login?msg='.urlencode($message));
		} else {
			if ($user->isActive()) {
				$error = 'Your account is already activated, please <a href="/login">Sign in</a>';
			} else {
				$error = 'Your account cannot be activated now, please try again later.';
			}
		}

		$this->render( array(
			'title' => 'Account Activation | Confone',
			'view' => 'account/activation.php',
			'error' => isset($error) ? $error :  null
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>