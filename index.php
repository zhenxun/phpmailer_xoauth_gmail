<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require __DIR__ . '/vendor/autoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->AuthType = 'XOAUTH2';
$mail->isHTML(true);


$email = 'wzx@playsure.tw';
$clientId = '48386581440-nd591sr3bvbl9lp2h4ge98dersfdv71u.apps.googleusercontent.com';
$clientSecret = 'llpOd2J2CP7_cGF6yiUpC86C';
$refreshToken = '1/DGMaI8keqx6xbQEvhJm1P1A1L8pbhkLERL8733vOTXs';

$provider = new Google(
    [
        'clientId' => $clientId,
        'clientSecret' => $clientSecret,
    ]
);

$mail->setOAuth(
    new OAuth(
        [
            'provider' => $provider,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
            'refreshToken' => $refreshToken,
            'userName' => $email,
        ]
    )
);

//Set who the message is to be sent from
//For gmail, this generally needs to be the same as the user you logged in as
$mail->setFrom($email, 'First Last');

//Set who the message is to be sent to
$mail->addAddress('zhenxun9119@gmail.com', 'zhenxun');

//Set the subject line
$mail->Subject = 'PHPMailer GMail XOAUTH2 SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->CharSet = 'utf-8';
$mail->msgHTML(file_get_contents('contentsutf8.html'), __DIR__);

//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

// $mail->Subject = '測試';
		
// $body  = '<html><body>gmail api 測試</body></html>';

// $mail->Body = $body;

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>
