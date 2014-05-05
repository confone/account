<?php
class PendingController extends ViewController {

	protected function control() {
		global $_ASESSION;

		if ($_ASESSION->exist(ASession::$ACTIVATION)) {
			$userId = $_ASESSION->get(ASession::$ACTIVATION);
			$user = new User($userId);
		} else {
			$this->redirect('/login');
		}

		$display = array();
		$display['title'] = 'Account Activation Pending';
		$display['send_to'] = 'An activation email has been sent to ';
		$display['click_link'] = ', please click on the activation link in your email to activate your account.';
		$display['not_receive'] = 'Have not received an activation email yet?';
		$display['send_again'] = 'Click HERE to send again';

		$this->render( array(
			'view' => 'account/pending.php',
			'user' => $user,
			'display' => $display
		));
	}

	protected function checkLogin() {
		return false;
	}
}
?>