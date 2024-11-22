<?php

        if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
        require_once(get_stylesheet_directory() . '/class/Prompts.php');
    

    $Prompts = new Prompts();
    $limit = $_POST['limit'];
    $page = $_POST['page'];
    if($page == 0){
        $offset = 0;
    } else {
        $offset = 100 + ( ( $page - 1 ) * $limit );
    }
    $answers = $Prompts->get_answers($limit,$offset);  
    
        foreach($answers as $answer){
            $user_id = $answer->user_id;
            $field_id = $answer->field_id;
            $content_id = $answer->content_id;
            $field_content = $answer->field_content;
            $additional = $answer->additional;
            //$photo = str_replace('.jpeg','_thumb.jpeg',$answer->photo);
            $photo = $answer->photo;
            $class = 'field_' . $field_id;
            $prompt = $Prompts->get_prompt_title($field_id);
            $portrait_default_selector = substr($user_id,-1); //get last digit of user_id
            if( $portrait_default_selector == 0 || $portrait_default_selector == 1 ){
		$img_version = '0';
            }elseif( $portrait_default_selector == 2 || $portrait_default_selector == 3 ) {
		$img_version = '1';
            }elseif( $portrait_default_selector == 4 || $portrait_default_selector == 5 ) {
		$img_version = '2';
            }elseif( $portrait_default_selector == 6 || $portrait_default_selector == 7 ) {
		$img_version = '3';
            }elseif( $portrait_default_selector == 8 || $portrait_default_selector == 9 ) {
		$img_version = '4';
            }
            if($photo==''){
                $photo = '/wp-content/themes/caring2024/images/defaults/story_images/Untitled-' . $field_id . '-' . $img_version . '.jpg';
            }
            echo'
                <li class="isosizing ' . $class . '" data-field_id="' . $field_id . '" data-user_id="' . $user_id . '" data-content_id="' . $content_id . '" style="background-image:url(' . $photo . ');">
                    <a href="/care-gallery/' . $user_id . '">
                        <div>
                            <h1>' . $prompt . '</h1>
                            <p>' . $field_content . ' - ' . $additional . '</p>
                        </div>
                    </a>
                </li>';
        }
    
