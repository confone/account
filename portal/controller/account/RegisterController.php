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

		    	if (!empty($recaptcha_private_key) && !$resp->is_valid) {
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

		$user = User::register($email, $name, $password, $cpassword);

		if (isset($user)) {
            if (param('keep_login')) {
				$token = $user->generateRememberMeToken();
	           	if (isset($token)) {
	           		setcookie(ASession::$COOKIE_TOKEN, $token, time()+2628000, '/', 'account.confone.com', false, true);
	           	}
            }

			global $_ASESSION;
            $_ASESSION->set(ASession::$ACTIVATION, $user->getId());
            $this->createProfileImage($user);
			$activationToken = $user->generateAccountActivationToken();
			EmailUtil::sendActivationEmail($user->getEmail(), $user->getName(), $user->getId(), $activationToken);
			$this->redirect('/pending');
		}
	}

	private function createProfileImage(&$user) {
		global $profile_image_dir;
		
		include "../util/qrcode.php";

		$filename = Utility::randomString(10).'_'.$user->getId();

		$errorCorrectionLevel = 'L';
		$matrixPointSize = 4;

		$png = QRcode::png($user->getName(), $profile_image_dir.$filename, $errorCorrectionLevel, $matrixPointSize, 2);

		$user->setProfilePic($filename);
		$user->persist();
	}

	protected function checkLogin() {
		return false;
	}
}
?>