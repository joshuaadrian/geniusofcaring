<?php

require_once('/nas/content/live/geniusofcaring/wp-load.php');
session_start();
if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');



    $is_profile = $_POST['is_profile'];
    if($is_profile){
        $photo = $_POST['photo'];
        $name = $_POST['name'];
        $user_type = $_POST['user_type'];
        $bio = $_POST['bio'];
        $website_url = $_POST['website_url'];
        $User = new User; 
        $User->useSession();
        $User->udpateProfile($name,$user_type, $bio,$photo,$website_url);
    }else{
        $field_id = $_POST['field_id'];
        $field_content = $_POST['field_content'];
        $additional = $_POST['additional'];
        $photo = $_POST['photo'];
        $content_id = $_POST['content_id'];
        $User = new User; 
        $User->useSession();
        $User->handle_additional_info($field_id,$field_content,$additional, $photo);
    }
    