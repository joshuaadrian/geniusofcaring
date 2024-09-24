<?php

require_once('/nas/content/live/geniusofcaring/wp-load.php'); 
if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');

$User = new User();
$User->useSession();

$user_url = $_POST['seturl'];

if($User->get_user_id_from_user_url($user_url)){
    //url already exists
    echo'Error-1';
} else {
    echo $User->set_user_url($user_url);
}

    