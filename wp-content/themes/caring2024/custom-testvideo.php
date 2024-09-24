<?php
/**
* Template Name: Portrait Test 
*/
    session_start();
    get_header();
    
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
            $content_id = $answers[1]->content_id; //this needs a new field id (17)
            $field_content = $answers[1]->field_content;
        }
        echo'
        <section class="video_container hd_on">
            <video id="Chapter_One_Video" preload="auto" class="active">
                <source type="video/mp4" src="/wp-content/themes/caring/video/kamaria_-_ch1_-_proxy.mp4">
                <source type="video/webm" src="/wp-content/themes/caring/video/kamaria_-_ch1_-_proxy.webm">
                <source type="video/m4v" src="/wp-content/themes/caring/video/kamaria_-_ch1_-_proxy.m4v">
            </video>
            <video id="Chapter_Two_Video" preload="none">
                <source type="video/mp4" src="/wp-content/themes/caring/video/kamaria_-_ch2_-_proxy.mp4">
                <source type="video/webm" src="/wp-content/themes/caring/video/kamaria_-_ch2_-_proxy.webm">
                <source type="video/m4v" src="/wp-content/themes/caring/video/kamaria_-_ch2_-_proxy.m4v">
            </video>
            <video id="Chapter_Three_Video" preload="none">
                <source type="video/mp4" src="/wp-content/themes/caring/video/kamaria_-_ch3_Interdependence-720_2500.mp4">
                <source type="video/webm" src="/wp-content/themes/caring/video/kamaria_-_ch3_Interdependence-720_2500.webm">
                <source type="video/m4v" src="/wp-content/themes/caring/video/kamaria_-_ch3_Interdependence-720_2500.m4v">
            </video>
            <video id="Chapter_Four_Video" preload="none">
                <source type="video/mp4" src="/wp-content/themes/caring/video/kamaria_-_ch4_Loss_and_Grief_-Genius_of_Caring_V1-720_2500.mp4">
                <source type="video/webm" src="/wp-content/themes/caring/video/kamaria_-_ch4_Loss_and_Grief_-Genius_of_Caring_V1-720_2500.webm">
                <source type="video/m4v" src="/wp-content/themes/caring/video/kamaria_-_ch4_Loss_and_Grief_-Genius_of_Caring_V1-720_2500.m4v">
            </video>
            <video id="Chapter_Five_Video" preload="none">
                <source type="video/mp4" src="/wp-content/themes/caring/video/kamaria_-_ch5_Inspiration-Genius_of_Caring_V1-720_2500.mp4">
                <source type="video/webm" src="/wp-content/themes/caring/video/kamaria_-_ch5_Inspiration-Genius_of_Caring_V1-720_2500.webm">
                <source type="video/m4v" src="/wp-content/themes/caring/video/kamaria_-_ch5_Inspiration-Genius_of_Caring_V1-720_2500.m4v">
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
                <p>Where do you live? Click on your hometown</p>
                <fieldset>
                    MAP GOES HERE AND BUTTON TRIGGERS UPDATE $field_content = location
                    <button data-field_id="1" data-content_id="' . $content_id . '"';
                    if($field_content=='I am living with Alzheimer\'s/dementia'){
                        echo' class="selected"';
                    }
                    echo'
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

    //Chapter 3
        $content_id = '';
        $field_content = 'The biggest change I have had to make......';
        if($answers[14]->field_content != ''){
            $content_id = $answers[18]->content_id;
            $field_content = $answers[18]->field_content;
            $additional = $answers[18]->additional;
        }
        echo'
        <section class="full response response_four">
            <section class="overlay prompt">
                <p>What do you miss most?</p>
                <textarea data-field_id="4" data-content_id="' . $content_id . '">' . $additional . '</textarea>
                <button>Continue</button>
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
                <p>Welcome to our story-sharing community made up of family caregivers, friends and those whose lives have been touched by Alzheimer&rsquo;s and other related dementias.</p>
                <p>Sign in to add your story to our Care Gallery community.</p>
                <p>An account page will be created for you where you can add your bio, a photo of yourself and the person you are here for, and continue to add to your story by responding further to the story prompts and questions.</p>
                <p>You will receive an email containing your password. If you do not see the email please check your junk mail folder.</p>
                <p></p>
                <input type="email" placeholder="Email..." class="email_address">
                <button>Sign Up</button>
                <p class="privacy"><a href="/privacy" target="_blank">View Privacy Policy</a></p>
            </section>
            <section class="overlay data">
                <a class="button" href="/my-story">My Story</a>
            </section>
        </section>';
    get_footer();

 ?>
