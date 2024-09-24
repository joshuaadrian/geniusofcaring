<?php
/**
* Template Name: Care Gallery    
*/

    get_header();
        if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
        require_once(get_stylesheet_directory() . '/class/User.php');
        require_once(get_stylesheet_directory() . '/class/Prompts.php');
    

    $Prompts = new Prompts();
    $answers = $Prompts->get_answers(100,0);  
    $prompt_titles = $Prompts->get_prompt_titles();
    if(!get_query_var('user_url')){ 
        echo'
        <article class="full">
            <ul class="filter">
                <li class="switch">Filter: <span class="filter_text">View All Stories</span> <form method="post" action="/user-search"><input type="text" name="user_search" placeholder="Member Search"></form></li>
                <li data-filter="*">View All Stories</li>';
        foreach( $prompt_titles as $field_id=>$prompt){
            if(14 <= $field_id && $field_id <= 16 )continue; //skip additional from filter
            echo'
                <li data-filter=".field_' . $field_id . '">' . $prompt . '</li>';
        }
        echo'
            </ul>
            <ul class="gallery">';
        foreach($answers as $answer){
            $user_id = $answer->user_id;
            $field_id = $answer->field_id;
            $content_id = $answer->content_id;
            $field_content = $answer->field_content;
            $additional = $answer->additional;
            // $photo = str_replace('.jpeg','_thumb.jpeg',$answer->photo);
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
                $photo = '/wp-content/themes/caring/images/defaults/story_images/Untitled-' . $field_id . '-' . $img_version . '.jpg';
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
        echo'
            </ul>
        </article>
        <section class="soundcloud_player">
            <div class="iframe">
                <iframe width="100%" height="350" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/147277442&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
            </div>
            <button class="soundcloud_button">Sound</button>
        </section>';
    } else {

        $user_url = get_query_var('user_url');
        $User = new User($user_url);
		if(!$User->valid){
			die('Error: User not found');
		}
        $answers = $User->get_answers();
        $user_id = $User->user_id;
        $User->get_profile();
        $user_image = $User->user_photo;
        if($user_image == '/wp-content/themes/caring/images/profile_add_image_bttn.png' || $user_image == '/wp-content/themes/caring/images/defaults/profile.png' || $user_image == ''){
            $user_image = '/wp-content/themes/caring/images/defaults/user_icon.png';
        }

        echo'
            <div class="modal">
                <article>';
        $public_password = $_POST['public_password'];
        if($User->getPrivacy()=='Public' || $public_password == $User->get_public_password()){
            echo'
                        <section class="user_info">
                            <img src="' . $User->user_photo . '">
                            <h1>' . $User->user_name . '<br><span></span>';
			if(is_user_logged_in()){
				echo'<span class="email_user">Send ' . $User->user_name . ' a private message</span>';
			}
			echo'</h1>
                        </section>
						<button class="share_story button">Share Story</button>
						<button class="sign_guestbook button">Sign Guestbook</button>
                        <div class="slider_wrapper">
                        <ul class="story_slider">
                            <li class="user_details active" data-user_id="' . $user_id . '">
                                <img src="' . $user_image . '">
                                <div>
                                    <h1>Bio</h1>
                                    <p>' . $User->user_bio . '</p>';
            if($User->user_website_url!=''){
                echo'
                                    <h1>Website URL</h1>
                                    <p><a href="http://' . $User->user_website_url . '" target="_blank">' . $User->user_website_url . '</a></p>';
            }
            echo'
                                </div>
                            </li>';
            foreach($answers as $this_field_id=>$answer){ 
                $content_id = $answer->content_id;
                $field_content = $answer->field_content;
                $photo = $answer->photo;
                $additional = $answer->additional;
                $class = 'field_' . $this_field_id;
                $prompt = $Prompts->get_prompt_title($this_field_id); 
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
	            $photo = '/wp-content/themes/caring/images/defaults/story_images/Untitled-' . $this_field_id . '-' . $img_version . '.jpg';
                }
                echo'
                            <li class="' . $class . '" data-field_id="' . $this_field_id . '" data-user_id="' . $user_id . '" data-content_id="' . $content_id . '">
                                <img src="' . $photo . '">
                                <h1>' . $prompt . '</h1>
                                <p>' . $field_content . ' - ' . $additional . '</p>
                            </li>';
            }
            echo'
                        </ul>
                        <div class="slider_controls"><span class="prev"></span><span class="next"></span></div>
                        </div>
                        <section class="guestbook">';
    include('/nas/content/live/geniusofcaring/wp-content/themes/caring/comments.php');
    echo'           
                        </section>
                    </article>
                <a href="/care-gallery" class="close">Care Gallery</a>
                </div>
	<div class="share_story_modal">
        <a href="#" class="close">Close</a>
		<div class="inner">
			<h1>Share ' . $User->user_name . '&rsquo;s story</h1>
			<span class="user_url">http://geniusofcaring.wpengine.com/care-gallery/' . $User->user_url . '</span>
            <div class="addthis_sharing_toolbox" data-url="http://geniusofcaring.wpengine.com/care-gallery/' . $User->user_id . '" data-title="' . $User->user_name . ' on Genius of Caring"></div>
		</div>
	</div>
	<div class="email_user_modal">
        <a href="#" class="close">Close</a>
		<form>
			<h1>Send a Private Message</h1>
			<p>Enter your message in the form below and it will be sent to the member&rsquo;s email inbox. Your email address will be provided to them.</p>
			<label for="your_message">Message</label>
			<textarea name="your_message" id="your_message"></textarea>
			<input type="submit" value="submit" class="button">
		</form>
    </div>
    <script>
        story_slider();
    </script>';
        } else {
            echo'
                <section class="password_protected">
                    <p>This Page is Password Protected. Please enter the password to view</p>
                    <form method="post">
                        <label for="public_password">Password:</label>
                        <input type="text" name="public_password" id="public_password">
                        <input type="submit" value="continue" class="button">';
            if($public_password!=''){
                    echo'<p>Incorrect Password. Please Try Again</p>';
            }
            echo'
                    </form>
                </section>';
        
        }
    }
    get_footer();

 ?>
