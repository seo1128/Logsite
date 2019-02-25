<?php

define('FILE', dirname(__FILE__));

$email = htmlspecialchars($_GET['email']);


if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
	file_put_contents(FILE.'/emails.txt', $email."\n", FILE_APPEND);

	$response['type'] = 'success';
	$response['text'] = 'You have successfully subscribed to newsletter';
} else {
	$response['type'] = 'error';
	$response['text'] = 'Your e-mail is not valid';
}

echo json_encode($response);