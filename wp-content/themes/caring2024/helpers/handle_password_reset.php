<?php

function generateRandomString($length = 10) {
    $characters = '23456789abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

require_once('/nas/content/live/geniusofcaring/wp-load.php'); 
require_once(get_stylesheet_directory() . '/class/Emailformat.php');




    $email_address = $_POST['email_address'];
    $user = get_user_by( 'email', $email_address );
    $random_password = generateRandomString();
    wp_set_password( $random_password, $user->ID );
    $message = '<p>Your password has been reset.</p>';
    $message.= '<p>Your new password is: ' . $random_password . '</p>';
		$Emailformat = new Emailformat();
		$Emailformat->create_cta('http://geniusofcaring.wpengine.com/login','Log In');
		$Emailformat->create_message('The Genius of Caring - Password Reset',$message);
		$headers = 'Sender: Genius of Caring <noreply@geniusofcaring.com>' . "\r\n";
		$headers .= 'From: Genius of Caring <noreply@geniusofcaring.com>' . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
		mail($email_address,'The Genius of Caring - Password Reset',$Emailformat->message, $headers);
