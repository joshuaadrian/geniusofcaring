<?php

 // Should store all messages in db to check for problems/spam/abuse
require_once('/nas/content/live/geniusofcaring/wp-load.php'); 
session_start();

if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');
require_once(get_stylesheet_directory() . '/class/Emailformat.php');


$User = new User();
$User->useSession();
if($User->user_id != ''){
	$message = $_POST['your_message'];
	$sent_by_id = $User->user_id;
	$sent_by_name = $User->user_name;
	$sent_by_email = $User->get_user_email_address();

	$send_to_id = $_POST['send_to_id'];
	$User_to = new User($send_to_id);
	$send_to_name = $User_to->user_name;
	$send_to_email = $User_to->get_user_email_address();

	$subject = 'Genius of Caring - New Private Message';

	function set_html_content_type() {
		return 'text/html';
	}
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );

	$headers = 'Sender: Genius of Caring <noreply@geniusofcaring.com>' . "\r\n";
	$headers .= 'From: ' . $sent_by_name . ' via Genius of Caring <' . $sent_by_email . '>' . "\r\n";
	$headers .= 'Reply-To: ' . $sent_by_name . ' <' . $sent_by_email . '>' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
	$Emailformat = new Emailformat();
	$Emailformat->create_cta('mailto:' . $sent_by_email,'Reply');
	$Emailformat->create_message('A user from Genius of Caring.com has sent you the private message below. If you reply to this message, the user will be given your email address for future correspondence. ' . $sent_by_name . ' (' . $sent_by_email . ')',$message);
	$message = $Emailformat->message;

	if(mail( $send_to_email, $subject, $message, $headers )){
        echo'true';
    } else {
        echo'false';
    }
	print_r($headers);
} else {
    echo'permission denied';
}
//endif


