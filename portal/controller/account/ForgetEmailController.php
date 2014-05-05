<?php
class ForgetEmailController extends ViewController {

	protected function control() {
		global $_ASESSION;

		if ($_ASESSION->exist(ASession::$RESETPASSWD)) {
			$userId = $_ASESSION->get(ASession::$RESETPASSWD);
			$user = new User($userId);

			$display = array();
			$display['title'] = 'Reset Password Email';
			$display['send_to'] = 'A reset password email has been sent to ';
			$display['click_link'] = ', please login in your email and click on the link to reset your password.';
			$display['not_receive'] = 'Have not received a reset password email yet?';
			$display['send_again'] = 'Click HERE to send again';

			$this->render( array(
				'title' => 'Email Sent | Confone',
				'view' => 'account/email-sent.php',
				'user' => $user,
				'display' => $display
			));
		} else {
			$this->redirect('/forget');
		}
	}

	protected function checkLogin() {
		return false;
	}
}
?>