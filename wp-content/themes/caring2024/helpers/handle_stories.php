<?php

require_once('/nas/content/live/geniusofcaring/wp-load.php');
session_start();
if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');



    
    $field_id = $_POST['field_id'];
    $field_content = $_POST['field_content']; 
    $content_id = $_POST['content_id'];
    $User = new User; 
    $User->useSession();
    if($content_id!=''){
        $User->udpateField($field_id,$field_content,$content_id);
    } else {
        $User->addField($field_id,$field_content);
    }
    