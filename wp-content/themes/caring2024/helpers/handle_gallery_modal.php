<?php
if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/User.php');
require_once(get_stylesheet_directory() . '/class/Prompts.php');
require_once('/nas/content/live/geniusofcaring/wp-load.php'); 

$user_id = $_POST['user_id'];
$field_id = $_POST['field_id'];
$User = new User($user_id);
$answers = $User->get_answers();
$Prompts = new Prompts();
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
                            <li class="user_details" data-user_id="' . $user_id . '">
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
                if($field_id==$this_field_id){
                    $class .= ' active';
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
<script type="text/javascript"> 
var addthis_config = {
     data_track_clickback: false 
} 
</script> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54e22b945b4c2b8a" async="async"></script>
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
