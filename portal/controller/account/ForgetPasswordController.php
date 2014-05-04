<?php
class ForgetPasswordController extends ViewController {

	protected function control() {

		$email = param('email');

		global $recaptcha_private_key;
        if (!empty($recaptcha_private_key)) {
			include '../util/recaptchalib.php';
		}

		if (isset($email)) {
			$user = User::getUserByEmail($email);

			if (isset($user)) {
				if (!empty($recaptcha_private_key)) {
			 	 	$resp = recaptcha_check_answer( $recaptcha_private_key, 
							    					Utility::getClientIp(), 
							    					param('recaptcha_challenge_field'), 
							    					param('recaptcha_response_field') );
				}

		    	if (!empty($recaptcha_private_key) && !$resp->is_valid) {
            		$error = 'Invalid ReCAPTCHA, please try again.';
		    	} else {
		    		global $_ASESSION;
		    		$_ASESSION->set(ASession::$RESETPASSWD, $user->getId());

					$token = $user->generateResetPasswordToken();
					EmailUtil::sendForgetPasswordEmail($email, $user->getName(), $user->getId(), $token);

					$this->redirect('/reset-email');
		    	}
			} else {
            	$error = 'Email does not exist. <a href="register">Sign up now.</a>';
			}
		}

		$this->render( array(
			'title' => 'Forget Password | Confone',
			'view' => 'account/forgot.php',
			'error' => isset($error) ? $error : null
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>