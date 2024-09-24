<?php

require_once('/nas/content/live/geniusofcaring/wp-load.php'); 
if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');

$User = new User();
$User->useSession();
$user_id = $User->user_id;
$wp_user_id = $User->get_wp_user_id($user_id);
$new_password = $_POST['new_password'];
wp_set_password( $new_password, $wp_user_id );



    