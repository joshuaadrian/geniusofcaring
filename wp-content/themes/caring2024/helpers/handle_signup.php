<?php
require_once('/nas/content/live/geniusofcaring/wp-load.php'); 
session_start();

if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');
require_once(get_stylesheet_directory() . '/class/Emailformat.php');

	function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
		$user = new WP_User( $user_id );

		$user_login = stripslashes( $user->user_login );
		$user_email = stripslashes( $user->user_email );

		$message  = sprintf( __('New user registration on %s:'), get_option('blogname') ) . "\r\n\r\n";
		$message .= sprintf( __('Username: %s'), $user_login ) . "\r\n\r\n";
		$message .= sprintf( __('E-mail: %s'), $user_email ) . "\r\n";

		@wp_mail(
			get_option('admin_email'),
			sprintf(__('[%s] New User Registration'), get_option('blogname') ),
			$message
		);

		if ( empty( $plaintext_pass ) )
			return;
		
        $message = '<h1>Thank you for joining The Genius of Caring!</h1>';
        $message.= '<p>Your username is: ' . $user_login . '</p>';
        $message.= '<p>Your temporary password is: ' . $plaintext_pass . '</p>';
        $message.= '<p>Now that you&rsquo;re a member of The Genius of Caring, you&rsquo;re part of our community engagement initiative. Together, we&rsquo;re supporting caregivers and providing students, healthcare professionals and the public with a glimpse into the world of Alzheimer&rsquo;s and other related illnesses.</p>';
        $message.= '<h2>Will you share your story with us?</h2>';
        $message.= '<p>You probably signed up because you have firsthand experience with Alzheimer&rsquo;s or another caregiving-intensive disease. Sharing your unique perspective can be tremendously helpful for others struggling to manage a diagnosis or adjust to the caregiving process. If you&rsquo;re comfortable contributing, we want to hear from you.</p>';
        $message.= '<p><a href="http://geniusofcaring.wpengine.com/login">Share My Story Now</a></p>';
        $message.= '<h2>Are you a professional caregiver, MD or scholar?</h2>';
        $message.= '<p>If you&rsquo;re interested in contributing your insight or knowledge to our educational materials or site content, we would love to connect with you.</p>';
        $message.= '<p>Sincerely,</p>';
        $message.= '<p>The GoC Team</p>';        
		$Emailformat = new Emailformat();
		$Emailformat->create_cta('mailto:banker@geniusofmarian.com','Contact Us');
		$Emailformat->create_message('Thank you for joining the Genius of Caring.',$message);
		$headers = 'Sender: Genius of Caring <noreply@geniusofcaring.com>' . "\r\n";
		$headers .= 'From: Genius of Caring <noreply@geniusofcaring.com>' . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
		mail($user_email,'Welcome to The Genius of Caring',$Emailformat->message, $headers);
	}
    
    $email_address = $_POST['email_address'];
    $User = new User; 
    $User->useSession();
    if($User->registerUser($email_address)){
		$User->setPublic();
	}else {
		echo'Error';
	}
    
