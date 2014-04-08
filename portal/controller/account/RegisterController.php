<?php
class RegisterController extends ViewController {

	protected function control() {
		$this->loginRedirect();

		include '../util/recaptchalib.php';
		global $recaptcha_private_key;

		$email = param('email');
		if (!empty($email)) {
		  	$resp = recaptcha_check_answer( $recaptcha_private_key, 
					    					Utility::getClientIp(), 
					    					param('recaptcha_challenge_field'), 
					    					param('recaptcha_response_field') );
		    if (!$resp->is_valid) {
            	$error = 'Invalid ReCAPTCHA input, please try again.';
        	} else {
		    	$error = $this->register( $email, 
		    							  param('username'), 
		    							  param('password'), 
		    							  param('cpassword') );
		    }
		}

		$this->render( array(
			'view'  => 'account/register.php',
			'error' => isset($error) ? $error : null
		));
	}

	private function register($email, $name, $password, $cpassword) {
		if ($password!=$cpassword) {
			return 'mismatch passwords';
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
			$this->redirect('/profile?msg=welcom');
		}
	}

	protected function checkLogin() {
		return false;
	}
}
?>