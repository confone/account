<?php
class ResetPasswordController extends ViewController {

	protected function control() {
		$uid = param('sid');
		$token = param('token');
		$passwd = param('password');

		if (empty($uid) || empty($token)) {
			$this->redirect('/forget');
		}

		if (isset($passwd)) {
			$cpasswd = param('cpassword');
			if ($passwd==$cpasswd) {
				$user = new User($uid);
				if ($user->hasResetPasswordToken($token)) {
					$user->setPassword($passwd);
					if ($user->persist()) {
						global $_ASESSION;
						$_ASESSION->set(ASession::$RESETPASSWD, null);
						$message = 'Your password has been reset successfully. Please sign in now!';
						$this->redirect('/login?msg='.urlencode($message));
					} else {
						$error = 'System temporarily not available!';
					}
				} else {
					// TODO: invalid reset password token.
				}
			} else {
				$error = 'Password and Confirm Password does not match.';
			}
		}

		$this->render( array(
			'title' => 'Reset Password | Confone',
			'view' => 'account/reset-password.php',
			'uid' => $uid,
			'token' => $token,
			'error' => isset($error) ? $error : null
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>