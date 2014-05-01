<?php
class Utility {

    public static function getRawRequestData() {
        return file_get_contents('php://input');
    }

    public static function getJsonRequestData() {
        $rawData = file_get_contents('php://input');
        return json_decode($rawData, TRUE);
    }

    public static function getClientIp() {
        $head = apache_request_headers();
        $ip = (isset($head['CONFONE_FORWARDED_IP']) ? $head['CONFONE_FORWARDED_IP'] : '');

        if (empty($ip)) { 
            $ip = (isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '');
        }
        if (empty($ip)) { 
            $ip = (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '');
        }
        if (empty($ip)) {
            $ip = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
        }

        return $ip;
    }

    public static function generateAccountToken($mid='') {
    	$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, rand(8, 10));
    	$token.= '.'.$mid.'.';
    	$token.= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, rand(7, 10));

    	return $token;
    }

    public static function generateActivationToken() {
    	$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
    	$token.= substr(md5(rand(0, 1000).date('Y-m-d H:i:s')), 0, 32);

    	return $token;
    }

    public static function generateResetPasswordToken() {
    	$token = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 32);
    	$token.= substr(md5(rand(0, 1000).date('Y-m-d H:i:s')), 0, 32);

    	return $token;
    }

	public static function hashString($str) {
		return abs(crc32($str));
	}

	public static function saltString($str, $length=5) {
		$salt = substr(md5(rand(0, 1000).date('Y-m-d H:i:s')), 0, $length);
		$str = substr($str, $length);

		return $salt.$str;
	}

	public static function compareSaltedString($str1, $str2, $length, $front=true) {
		$len1 = strlen($str1);
		$len2 = strlen($str2);

		if ($len1==$len2) {
			if ($front) {
				$salt1 = substr($str1, $length);
				$salt2 = substr($str2, $length);
			} else {
				$length = $length*-1;
				$salt1 = substr($str1, 0, $length);
				$salt2 = substr($str2, 0, $length);
			}

			return $salt1==$salt2;
		}

		return false;
	}
}
?>