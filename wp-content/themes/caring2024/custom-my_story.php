<?php
/**
* Template Name: My Story    
*/
    session_start();
    get_header();
    if(is_user_logged_in()){
        if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
        if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
        if ( !class_exists('Prompts') ) : require_once(get_stylesheet_directory() . '/class/Prompts.php'); endif;

        $User = new User();
        $User->useDb();
        $user_id = $User->user_id;
        $User->get_profile();
        $user_image = $User->user_photo;
        $user_type = $User->user_type;
		$details_complete = true;
        if($user_image == '/wp-content/themes/caring2024/images/defaults/profile.png'){
			$details_complete = false;
            $user_image = '/wp-content/themes/caring2024/images/profile_add_image_bttn.png';
        }
		if($User->user_bio=='' || $User->user_name==''){
			$details_complete = false;
		}
        $user__head_image = $User->user_photo;
        if($User->user_photo == '/wp-content/themes/caring2024/images/profile_add_image_bttn.png' || $User->user_photo == '/wp-content/themes/caring2024/images/defaults/profile.png' || $User->user_photo == ''){
            $user__head_image = '/wp-content/themes/caring2024/images/defaults/profile.png';
        }

        echo'
            <div class="modal">
                <article>
					<div class="progress_bar">
						<div class="progress"></div><div class="progress_tooltip">You have filled out <span>2/16</span> story panels.</div>
					</div>
					<section class="user_info">
						<img src="' . $user__head_image . '">
						<h1>' . $User->user_name . '<br><span>' . $User->user_type;
		echo'</span></h1>
					</section>
					<a class="button view_my_story" href="http://geniusofcaring.wpengine.com/care-gallery/' . $User->user_url . '">View my Story</a>
					<a class="lock ';
		if($User->getPrivacy()=='Public'){
			echo'unlocked';
		} else {
			echo'locked';
		}
					echo'" href="/settings">Unlocked</a>
						<div class="slider_wrapper">
                        <ul class="story_slider">
                            <li class="user_details active';
		if($details_complete){
			echo' complete';
		}
							echo'" data-user_id="' . $user_id . '">
                                <div class="croppit" id="crop-profile"></div>
                                <img src="' . $user_image . '">
                                <form enctype="multipart/form-data">
									<h1>Name</h1>
                                    <input type="text" class="name" name="user_name" value="' . $User->user_name . '">
                                    <select name="user_type" class="user_type">
                                        <option value="I am...">I am...</option>
                                        <option value="I am living with Alzheimer\'s/dementia"';
                                    if($user_type=='I am living with Alzheimer\'s/dementia')echo' selected="selected"';
        echo'
                                        >I am living with Alzheimer\'s/dementia</option>
                                        <option value="I am a caregiver"';
                                    if($user_type=='I am a caregiver')echo' selected="selected"';
        echo'
                                        >I am a caregiver</option>
                                        <option value="I am family"';
                                    if($user_type=='I am family')echo' selected="selected"';
        echo'
                                        >I am family</option>
                                        <option value="I am a friend"';
                                    if($user_type=='I am a friend')echo' selected="selected"';
        echo'
                                        >I am a friend</option>
                                    </select>
									<h1>Tell the community who you are</h1>
                                    <textarea>' . $User->user_bio . '</textarea>
									<h1>Website URL</h1>
                                    <input type="text" class="website_url" name="website_url" value="' . ($User->user_website_url != '' ? $User->user_website_url : 'Website URL...') . '">
                                </form>
                                <button>Save</button>
                                <span class="saved">Save Complete</span>
                            </li>';
        $Prompts = new Prompts;
        $answers = $Prompts->get_prompts($user_id);
        foreach($answers as $this_field_id=>$answer){ //need to loop the questions and show answers if exist here
            $content_id = $answer->content_id;
            $field_content = $answer->field_content;
            $photo = $answer->photo;
            $class = 'field_' . $this_field_id;
            $first = false;
            $prompt = $answer->prompt;
            $additional = $answer->additional;
			if($photo != '' && $additional != ''){
				$class .= ' complete';
			}
            $dropdown = '';
            if($this_field_id == 1){
                $dropdown = '
                    <select>
                        <option data-field_id="1" data-content_id="' . $content_id . '">Please Choose</option>
                        <option data-field_id="1" data-content_id="' . $content_id . '"';
                        if($field_content=='I am living with Alzheimer\'s/dementia'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>I am living with Alzheimer\'s/dementia</option>
                        <option data-field_id="1" data-content_id="' . $content_id . '"';
                        if($field_content=='I am a caregiver'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>I am a caregiver</option>
                        <option data-field_id="1" data-content_id="' . $content_id . '"';
                        if($field_content=='I am family'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>I am family</option>
                        <option data-field_id="1" data-content_id="' . $content_id . '"';
                        if($field_content=='I am a friend'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>I am a friend</option>
                    </select>';
            }
            if($this_field_id == 2){
                $dropdown = '
                    <select>
                        <option data-field_id="2" data-content_id="' . $content_id . '">Please Choose</option>
                        <option data-field_id="2" data-content_id="' . $content_id . '"';
                        if($field_content=='Yes'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>Yes</option>
                        <option data-field_id="2" data-content_id="' . $content_id . '"';
                        if($field_content=='No'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>No</option>
                        <option data-field_id="2" data-content_id="' . $content_id . '"';
                        if($field_content=='I don\'t know'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>I don\'t know</option>
                    </select>';
            }
            if($this_field_id == 3){
                $dropdown = '
                    <select>
                        <option data-field_id="3" data-content_id="' . $content_id . '">Please Choose</option>
                        <option data-field_id="3" data-content_id="' . $content_id . '"';
                        if($field_content=='Parent'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>Parent</option>
                        <option data-field_id="3" data-content_id="' . $content_id . '"';
                        if($field_content=='Sibling'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>Sibling</option>
                        <option data-field_id="3" data-content_id="' . $content_id . '"';
                        if($field_content=='Partner'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>Partner</option>
                        <option data-field_id="3" data-content_id="' . $content_id . '"';
                        if($field_content=='Friend'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>Friend</option>
                        <option data-field_id="3" data-content_id="' . $content_id . '"';
                        if($field_content=='Extended Family'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>Extended Family</option>
                        <option data-field_id="3" data-content_id="' . $content_id . '"';
                        if($field_content=='Myself'){
                            $dropdown .= ' selected="selected"';
                        }
                $dropdown .= '>Myself</option>
                    </select>';
            }
            echo'
                        <li class="' . $class . '" data-field_id="' . $this_field_id . '" data-user_id="' . $user_id . '" data-content_id="' . $content_id . '">
                        <div class="croppit" id="crop-' . $this_field_id . '"><p>Click the Upload Icon to change the photo.</p><span>Compatible image formats: JPG, GIF or PNG. <br>For best results, image size should be 600x400 pixels.<br>Larger images will be cropped.</span></p></div>';
            if($photo!=''){
                echo'
                            <img src="' . $photo . '">';
            }
            echo'
                            <form enctype="multipart/form-data">
                                <h1>' . $prompt . '</h1>' . $dropdown;
			if($this_field_id == 1 || $this_field_id == 2 || $this_field_id == 3){
			echo'
								<h1>Share More...</h1>';
			}
			echo'
                                <textarea>' . $additional . '</textarea>
                            </form>
                            <button>Save</button>
                            <span class="saved">Save Complete</span>
                        </li>';
        }
        echo'
                    </ul>
                    <div class="slider_controls"><span class="prev"></span><span class="next"></span></div>
                    </div>
                </article>
            </div>
            <section class="help_content">
                <p>When you share your stories, photos and experiences, you&rsquo;re adding a valuable perspective to our community archive.</p>
                <p></p>
                <p> Your story is divided into individual chapters based upon a series of prompts. Here, you will be able to expand on your answers and add photos to better tell your story. </p>
                <p></p>
                <p>Please remember to hit the red &ldquo;Save&rdquo; button after each change that you make before advancing to the next chapter.</p>
                <p></p>
                <p>Once you have added your story, be sure to explore the other stories in the Care Gallery.</p>
                <p>The Care Gallery offers a unique glimpse into the caregiving experience, creating an intimate portrait of a community connected through compassion. </p>
                <p></p>
                <p>Thank you for joining us.</p>            
                <button>Continue</button>
            </section>';
    } else {
        echo'
			<script>
				window.location = "http://geniusofcaring.wpengine.com/login";
			</script>';
    }
    
    get_footer();
 ?> 
