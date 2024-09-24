<?php
/**
* Template Name: Portrait   
*/
    session_start();
    get_header();
    
    if(!$post->post_parent){
        echo'
    <section class="full portraits">
        <video id="Portraits_Loop" loop="loop" preload="auto" autoplay="autoplay">
            <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.mp4">
            <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.webm">
            <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.m4v">
        </video>
        <section class="overlay prompt">
            <a href="/portraits/pam-ed"><img class="pam_and_ed" src="/wp-content/themes/caring/images/PamEd.jpg"></a>
            <a href="/portraits/kamaria"><img class="kamaria" src="/wp-content/themes/caring/images/Kamaria_portrait_tile.jpg"></a>
        </section>
    </section>
    ';

    echo'
    <section class="full portraits">
        <video id="Portraits_Loop" loop="loop" preload="auto" autoplay="autoplay">
            <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.mp4">
            <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.webm">
            <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.m4v">
        </video>
        <section class="overlay prompt">
            <a href="/portraits/pam-ed"><img class="pam_and_ed" src="/wp-content/themes/caring/images/PamEd.jpg"></a>
            <a href="/portraits/kamaria"><img class="kamaria" src="/wp-content/themes/caring/images/Kamaria_portrait_tile.jpg"></a>
        </section>
    </section>
    ';
    
    } else {
    
    
        if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
        if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;

        $User = new User; 
        $User->useSession();
        
        if($User->user_id!=''){
            $answers = $User->get_answers();
        } 
        
        
    //Chapter 1
        $content_id = '';
        $field_content = '';
        if($answers[1]->field_content != ''){
            $content_id = $answers[1]->content_id;
            $field_content = $answers[1]->field_content;
        }
        echo'
        <section class="video_container hd_on">
            <video id="Chapter_One_Video" preload="auto" class="active">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_1_I_am_a_Caregiver_720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_1_I_am_a_Caregiver_720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_1_I_am_a_Caregiver_720_2500.m4v">
            </video>
            <video id="Chapter_One_Video_SD" preload="auto" class="active">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_1_I_am_a_Caregiver-480_1600.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_1_I_am_a_Caregiver-480_1600.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_1_I_am_a_Caregiver-480_1600.m4v">
            </video>
            <video id="Chapter_One_Loop" loop="loop" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_1_loop_I_am_a_Caregiver-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_1_loop_I_am_a_Caregiver-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_1_loop_I_am_a_Caregiver-720_2500.m4v">
            </video>
            <video id="Chapter_Two_Video" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_2_The_Begining-Genius_of_Caring_V1-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_2_The_Begining-Genius_of_Caring_V1-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_2_The_Begining-Genius_of_Caring_V1-720_2500.m4v">
            </video>
            <video id="Chapter_Two_Video_SD" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_2_The_Begining-Genius_of_Caring_V1-480_1600.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_2_The_Begining-Genius_of_Caring_V1-480_1600.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_2_The_Begining-Genius_of_Caring_V1-480_1600.m4v">
            </video>
            <video id="Chapter_Two_Loop" loop="loop" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_2_loop_The_Beginning-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_2_loop_The_Beginning-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_2_loop_The_Beginning-720_2500.m4v">
            </video>
            <video id="Chapter_Three_Video" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_3_Interdependence-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_3_Interdependence-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_3_Interdependence-720_2500.m4v">
            </video>
            <video id="Chapter_Three_Video_SD" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_3_Interdependence-480_1600.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_3_Interdependence-480_1600.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_3_Interdependence-480_1600.m4v">
            </video>
            <video id="Chapter_Three_Loop" loop="loop" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_3_loop_Interdependence-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_3_loop_Interdependence-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_3_loop_Interdependence-720_2500.m4v">
            </video>
            <video id="Chapter_Four_Video" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_4_Loss_and_Grief_-Genius_of_Caring_V1-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_4_Loss_and_Grief_-Genius_of_Caring_V1-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_4_Loss_and_Grief_-Genius_of_Caring_V1-720_2500.m4v">
            </video>
            <video id="Chapter_Four_Video_SD" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_4_Loss_and_Grief_-Genius_of_Caring_V1-480_1600.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_4_Loss_and_Grief_-Genius_of_Caring_V1-480_1600.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_4_Loss_and_Grief_-Genius_of_Caring_V1-480_1600.m4v">
            </video>
            <video id="Chapter_Four_Loop" loop="loop" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_4_loop_Loss_and_Grief-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_4_loop_Loss_and_Grief-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_4_loop_Loss_and_Grief-720_2500.m4v">
            </video>
            <video id="Chapter_Five_Video" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_5_Inspiration-Genius_of_Caring_V1-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_5_Inspiration-Genius_of_Caring_V1-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_5_Inspiration-Genius_of_Caring_V1-720_2500.m4v">
            </video>
            <video id="Chapter_Five_Video_SD" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_5_Inspiration-Genius_of_Caring_V1-480_1600.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_5_Inspiration-Genius_of_Caring_V1-480_1600.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/Chapter_5_Inspiration-Genius_of_Caring_V1-480_1600.m4v">
            </video>
            <video id="Chapter_Five_Loop" loop="loop" preload="none">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_5_loop_Inspiration-720_2500.mp4">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_5_loop_Inspiration-720_2500.webm">
                <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/Pam_and_Ed/loops/Chapter_5_loop_Inspiration-720_2500.m4v">
            </video>
            <div class="video_controls">
                <div class="seek_bar_container">
                    <div class="seek_bar"></div>
                </div>
                <span class="play_pause pause"></span>
                <span class="mute_button mute_off"></span>
                <div class="volume_container">
                    <div class="volume_slider"></div>
                </div>
                <span class="hd_sd hd_on"></span>
            </div>
            <nav class="chapters_nav">
                <ul>
                    <li class="heading">Chapters</li>
                    <li class="one active">Chapter One (1:02)</li>
                    <li class="two">Chapter Two (2:30)</li>
                    <li class="three">Chapter Three (2:08)</li>
                    <li class="four">Chapter Four (2:25)</li>
                    <li class="five">Chapter Five (1:07)</li>
                </ul>
            </nav>
            <span class="chapter_display"><span class="chapter_1"><span></span></span><span class="chapter_2"><span></span></span><span class="chapter_3"><span></span></span><span class="chapter_4"><span></span></span><span class="chapter_5"><span></span></span></span>
        </section>
        <section class="full response response_one">
            <section class="overlay prompt">
                <p>Which of these best describes you?</p>
                <fieldset>
                    <button data-field_id="1" data-content_id="' . $content_id . '"';
                    if($field_content=='I am living with Alzheimer\'s/dementia'){
                        echo' class="selected"';
                    }
                    echo'>I am living with Alzheimer\'s/dementia</button>
                    <button data-field_id="1" data-content_id="' . $content_id . '"';
                    if($field_content=='I am a caregiver'){
                        echo' class="selected"';
                    }
                    echo'>I am a caregiver</button>
                    <button data-field_id="1" data-content_id="' . $content_id . '"';
                    if($field_content=='I am family'){
                        echo' class="selected"';
                    }
                    echo'>I am family</button>
                    <button data-field_id="1" data-content_id="' . $content_id . '"';
                    if($field_content=='I am a friend'){
                        echo' class="selected"';
                    }
                    echo'>I am a friend</button>
                </fieldset>
                <button class="skip">Skip</button>
            </section>
            <section class="overlay data">
                <img class="data_slide" src="/wp-content/themes/caring/images/slide.png">
                <button>Continue</button>
            </section>
        </section>';

    //Chapter 2
        $content_id = '';
        $field_content = '';
        if($answers[2]->field_content != ''){
            $content_id = $answers[2]->content_id;
            $field_content = $answers[2]->field_content;
        }
        echo'
        <section class="full response response_two">
            <section class="overlay prompt">
                <p>If your loved one was experiencing signs of dementia, would you keep it a secret?</p>
                <fieldset>
                    <button data-field_id="2" data-content_id="' . $content_id . '"';
                    if($field_content=='Yes'){
                        echo' class="selected"';
                    }
                    echo'>Yes</button>
                    <button data-field_id="2" data-content_id="' . $content_id . '"';
                    if($field_content=='No'){
                        echo' class="selected"';
                    }
                    echo'>No</button>
                    <button data-field_id="2" data-content_id="' . $content_id . '"';
                    if($field_content=='I don\'t know'){
                        echo' class="selected"';
                    }
                    echo'>I don\'t know</button>
                </fieldset>
                <button class="skip">Skip</button>
            </section>
        </section>';

    //Chapter 3
        $content_id = '';
        $field_content = '';
        if($answers[3]->field_content != ''){
            $content_id = $answers[3]->content_id;
            $field_content = $answers[3]->field_content;
        }
        echo'
        <section class="full response response_three">
            <section class="overlay prompt">
                <p>Who are you here for?</p>
                <fieldset>
                    <button data-field_id="3" data-content_id="' . $content_id . '"';
                    if($field_content=='Parent'){
                        echo' class="selected"';
                    }
                    echo'>Parent</button>
                    <button data-field_id="3" data-content_id="' . $content_id . '"';
                    if($field_content=='Sibling'){
                        echo' class="selected"';
                    }
                    echo'>Sibling</button>
                    <button data-field_id="3" data-content_id="' . $content_id . '"';
                    if($field_content=='>Partner'){
                        echo' class="selected"';
                    }
                    echo'>Partner</button>
                    <button data-field_id="3" data-content_id="' . $content_id . '"';
                    if($field_content=='>Friend'){
                        echo' class="selected"';
                    }
                    echo'>Friend</button>
                    <button data-field_id="3" data-content_id="' . $content_id . '"';
                    if($field_content=='Extended Family'){
                        echo' class="selected"';
                    }
                    echo'>Extended Family</button>
                    <button data-field_id="3" data-content_id="' . $content_id . '"';
                    if($field_content=='Myself'){
                        echo' class="selected"';
                    }
                    echo'>Myself</button>
                </fieldset>
                <button class="skip">Skip</button>
            </section>
        </section>';

    //Chapter 4
        $content_id = '';
        $field_content = 'The thing I miss most is...';
        if($answers[4]->field_content != ''){
            $content_id = $answers[4]->content_id;
            $field_content = $answers[4]->field_content;
            $additional = $answers[4]->additional;
        }
        echo'
        <section class="full response response_four">
            <section class="overlay prompt">
                <p>What do you miss most?</p>
                <textarea data-field_id="4" data-content_id="' . $content_id . '">' . $additional . '</textarea>
                <button>Continue</button>
            </section>
        </section>';

    //Chapter 5
        echo'
        <section class="full response response_five">
            <section class="overlay prompt">
                <p>Would you like to share <em>your</em>​ story with us?</p>
                <p>Enter your email below to create a profile in our Care Gallery. You can add a picture and a little bit about yourself, then continue through the experience.</p>
                <p>Once you sign up you&rsquo;ll receive an email containing your password.</p>
               <p></p>
                <input type="email" placeholder="Email..." class="email_address">
                <button>Sign Up</button>
                <p class="privacy"><a href="/privacy" target="_blank">View Privacy Policy</a></p>
            </section>
            <section class="overlay data">
                <a class="button" href="/my-story">My Story</a>
            </section>
        </section>';
    }
    get_footer();

 ?>
