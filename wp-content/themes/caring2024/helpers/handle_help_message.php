<?php
require_once('/nas/content/live/geniusofcaring/wp-load.php'); 
session_start();


	$message = $_POST['your_message'];
	$sent_by_email = $_POST['your_email'];

	$subject = 'Genius of Caring - New Help Message';

	function set_html_content_type() {
		return 'text/html';
	}
	add_filter( 'wp_mail_content_type', 'set_html_content_type' );

	$headers[] = 'Sender: Genius of Caring <noreply@geniusofcaring.com>';
	$headers[] = 'From: Website Visitor via Genius of Caring <' . $sent_by_email . '>';
	$headers[] = 'Reply-To: ' . $sent_by_email;
    
    $message = '<h1>New Help Message from: ' . $sent_by_email . '</h1><br><br>' . $message;

	if(wp_mail( 'support@geniusofcaring.com', $subject, $message, $headers )){
        echo'true';
    } else {
        echo'false';
    }


