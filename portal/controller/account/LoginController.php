<?php
class LoginController extends ViewController {

	protected function control() {
		$this->loginRedirect();

		include '../util/recaptchalib.php';
		global $_ASESSION, $recaptcha_private_key;

		$loginCount = $this->initLoginCount();

		$username = param('username');
		$password = param('password');
		if (!empty($username)) {

		    if ($loginCount>=3) {
		    	$resp = recaptcha_check_answer( $recaptcha_private_key, 
						    					Utility::getClientIp(), 
						    					param('recaptcha_challenge_field'), 
						    					param('recaptcha_response_field') );
		    	if (!$resp->is_valid) {
            		$error = 'Invalid ReCAPTCHA input, please try again.';
        		} else {
		    		$this->login($username, $password, $loginCount);
		        }
		    } else {
		    	$this->login($username, $password, $loginCount);
		    }
		}

		$redirect_uri = param('redirect_uri');

		$this->render( array(
			'view' => 'account/login.php',
			'title' => 'Login | Confone',
			'recaptcha' => $loginCount>=3,
			'redirect_uri' => empty($redirect_uri) ? '/profile' : $redirect_uri,
			'error' => isset($error) ? $error : null
		));
	}

	private function initLoginCount() {
		global $_ASESSION;

		if (!$_ASESSION->exist('login_count')) {
		    $_ASESSION->set('login_count', 0);
		    $loginCount = 0;
		} else {
			$loginCount = $_ASESSION->get('login_count');
		}

		return $loginCount;
	}

	private function login($username, $password, $loginCount) {
		global $_ASESSION;

        $userId = UserDao::authenticate($username, $password);
        if ($userId) {
            $_ASESSION->set('login_count', 0);
            $_ASESSION->set(ASession::$AUTHINDEX, $userId);
            $this->redirect(param('redirect_uri'));
        } else {
            $error = 'Invalid username/password combination.';
            $_ASESSION->set('login_count', $loginCount+1);
            Logger::warn('Login attemp: '.$username.':'.$password.' failed!');
        }
	}

	protected function checkLogin() {
		return false;
	}
}
?>