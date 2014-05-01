<?php
class EmailUtil {

    const MAIL_FROM_NAME = 'Confone Notification';
    const MAIL_FROM_EMAIL = 'non-reply@confone.com';
    const MANDRILL_KEY = '2BTjw7gutKe58cWGbbvmeA';
    const MANDRILL_URL = 'https://mandrillapp.com/api/1.0/messages/send.json';

    public static function sendActivationEmail($email, $name, $uid, $accountToken) {
    	global $base_host;

    	$to = array(array('email' => $email,'name' => $name, 'type' => 'to'));

    	$subject = 'Registration Confirmation - Activate Your Account';

    	$html ='
<html>
<body>
<a href="'.$base_host.'/activation?sid='.$uid.'&token='.$accountToken.'">activate your account</a>
</body>
</html>';

    	self::send($to, $subject, $html);
    }

    public static function sendForgetPasswordEmail($email, $name, $uid, $resetToken) {
    	global $base_host;

		$to = array(array('email' => $email,'name' => $name, 'type' => 'to'));

    	$subject = 'Forget Password - Reset Your Password';

    	$html ='
<html>
<body>
<a href="'.$base_host.'/reset-password?sid='.$uid.'&token='.$resetToken.'">reset your password</a>
</body>
</html>';

    	self::send($to, $subject, $html);
    }

    private static function send ( $to,
        						   $subject,
        						   $html,
        						   $from=EmailUtil::MAIL_FROM_EMAIL,
        						   $from_name=EmailUtil::MAIL_FROM_NAME ) {
		$body = array();
		$body['key'] = EmailUtil::MANDRILL_KEY;
		$body['headers'] = array('Reply-To' => $from);
        $body['message'] = array( 'to' => $to,
            					  'subject' => $subject,
            					  'html' => $html,
            					  'from_email' => $from,
            					  'from_name' => $from_name );

        $curl = curl_init(self::MANDRILL_URL);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        $response = curl_exec($curl);
        curl_close($curl);

        $respArr = json_decode($response, true);
        $respArr = reset($respArr);
        if ($respArr['status']!='sent') {
            if (is_array($to)) {
                $to = implode(', ', $to);
            }
            mail($to, $subject, $html, "From: {$from}\r\nContent-type: text/html\r\n");
        }

        Logger::info('Send email to '.json_encode($to).' ...');
        Logger::info('Mandrill response - '.$response);
    }
}
?>