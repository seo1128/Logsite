<?php

define('FILE', dirname(__FILE__));

$contact_email = "demo_creatorica@meethemes.com"; // Your email

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

$response = array();

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$response['errors'][] = 'Your e-mail is not valid';
}
if(empty($message)) {
	$response['errors'][] = 'Enter your message';
}

if(empty($response['errors'])) {
	$message = '<html><head><title>'.$subject.'</title></head><body>'.$message.'</body></html>';

	$headers  = 'MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8'."\r\n";

	$headers .= 'To: '.$contact_email."\r\n";
	$headers .= 'From: '.(!empty($name) ? $name.' <'.$email.'>' : $email)."\r\n";

	mail($contact_email, $subject, $message, $headers);

	$response['success'] = 'E-mail successfully sent!';
}

echo json_encode($response);