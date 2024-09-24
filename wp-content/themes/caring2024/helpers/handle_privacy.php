<?php

require_once('/nas/content/live/geniusofcaring/wp-load.php');
if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');

$User = new User();
$User->useSession();

$public_password = $_POST['public_password'];

echo $User->set_public_password($public_password);


    