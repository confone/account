<?php
class RegisterController extends ViewController {

	protected function control() {
		$this->loginRedirect();

		global $recaptcha_private_key;
        if (!empty($recaptcha_private_key)) {
			include '../util/recaptchalib.php';
		}

		$email = param('email');
		if (!empty($email)) {
        	$username = param('username');
       		$password = param('password');
       		$cpassword = param('cpassword');

        	if (!empty($username) && !empty($password) && !empty($cpassword)) {
        		if (!empty($recaptcha_private_key)) {
			 	 	$resp = recaptcha_check_answer( $recaptcha_private_key, 
							    					Utility::getClientIp(), 
							    					param('recaptcha_challenge_field'), 
							    					param('recaptcha_response_field') );
        		}

		    	if (!empty($recaptcha_public_key) && !$resp->is_valid) {
            		$error = 'Invalid ReCAPTCHA, please try again.';
        		} else {
			    	$error = $this->register( $email, 
			    							  param('username'), 
			    							  param('password'), 
			    							  param('cpassword') );
		    	}
        	} else {
        		$error = 'Missing required information!';
       		}
		} else if (isset($email)) {
        	$error = 'Missing required information!';
		}

		$this->render( array(
			'view'  => 'account/register.php',
			'title' => 'Register | Confone',
			'email' => $email,
			'name' => param('username'),
			'error' => isset($error) ? $error : null
		));
	}

	private function register($email, $name, $password, $cpassword) {
		if ($password!=$cpassword) {
			return 'Passwords does NOT match!';
		}

		Logger::info('Registering user - '.$email.' '.$name.' '.$password.':'.$cpassword);

		$user = new UserDao();
		$user->setEmail($email);
		$user->setName($name);
		$user->setPassword(md5($password));
		$user->save();

		if ($user->isFromDatabase()) {
			global $_ASESSION;
            $_ASESSION->set(ASession::$AUTHINDEX, $user->getId());
            if (param('keep_login')) {
				$token = LookupRememberUserDao::createRememberDao($user->getId());
	           	if (isset($token)) {
	           		setcookie(ASession::$COOKIE_TOKEN, $token, time()+2628000, '/', 'account.confone.com', false, true);
	           	}
            }
			EmailUtil::sendActivationEmail($email, $name, Utility::generateActivationToken('.'.$user->getId().'.'));

			$this->redirect('/profile?msg=welcom');
		}
	}

	protected function checkLogin() {
		return false;
	}
}
?>