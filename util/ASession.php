<?php
class ASession {

    public static $AUTHINDEX = 'auth_index';
	public static $SESSION_KEY = 'CONFONESESSIONID';
	public static $COOKIE_TOKEN = 'CONFONECTOKEN';

	private $sessionId = null;
	private $sessionCache = null;

	private static $ASESSION = null;


	public static function instance() {
		if (!isset(self::$ASESSION)) {
			self::$ASESSION = new ASession();
		}

		return self::$ASESSION;
	}

	private function __construct() {
		$this->sessionCache = CacheUtil::getInstance();

		if (isset($_COOKIE[self::$SESSION_KEY])) {
			$this->sessionId = $_COOKIE[self::$SESSION_KEY];
		} else {
			global $component_name;

			$time = md5(microtime());
			$rand = md5(rand(0, 10000));
			$this->sessionId = $component_name.substr($rand, 0, 5).substr($time, -10, 10);

			while ($this->sessionCache->get($this->sessionId)) {
				usleep(rand(100, 1000));

				$time = md5(microtime());
				$rand = md5(rand(0, 10000));
				$this->sessionId = $component_name.substr($rand, 0, 5).substr($time, -10, 10);
			}

			setcookie(self::$SESSION_KEY, $this->sessionId, 0, '/', 'confone.com', false, true);
		}
	}

	public function set($key, $value) {
		$session = $this->sessionCache->get($this->sessionId);
		if (!$session) {
			$session = array();
		}
		$session[$key] = $value;
		global $session_expires_in;
		$this->sessionCache->set($this->sessionId, $session, $session_expires_in);
	}

	public function get($key) {
		global $session_expires_in;
		$session = $this->sessionCache->get($this->sessionId);
		$this->sessionCache->set($this->sessionId, $session, $session_expires_in);
		if (isset($session[$key])) {
			return $session[$key];
		} else {
			return null;
		}
	}

	public function exist($key) {
		global $session_expires_in;
		$session = $this->sessionCache->get($this->sessionId);
		$this->sessionCache->set($this->sessionId, $session, $session_expires_in);
		return isset($session[$key]);
	}

	public function destroy() {
		$this->sessionCache->delete($this->sessionId);
		setcookie(ASession::$SESSION_KEY, $this->sessionId, time()-3600, '/', 'confone.com', false, true);
	}
}
?>