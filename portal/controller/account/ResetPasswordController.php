<?php
class ResetPasswordController extends ViewController {

	protected function control() {

		$userId = param('sid');
		$token = param('token');
		$passwd = param('password');

		if (isset($passwd)) {
			$cpasswd = param('cpassword');
			if ($passwd==$cpasswd) {
				$user = new User($userId);
				if ($user->hasResetPasswordToken($token)) {
					$user->setPassword($passwd);
					if ($user->persist()) {
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
			'uid' => $userId,
			'token' => $token,
			'error' => isset($error) ? $error : null
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>