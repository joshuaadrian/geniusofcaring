<?php
/**
* Template Name: PamEd
*/
    session_start();
    get_header();

        
    //Chapter 1
        $content_id = '';
        $field_content = '';
        // if($answers[1]->field_content != ''){
        //     $content_id = $answers[1]->content_id;
        //     $field_content = $answers[1]->field_content;
        // }
        echo'
        <section class="video_container hd_on">
            <video id="Chapter_One_Video"  autoplay="true" preload="auto" class="active">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/1/Chapter_1_-_am_a_Caregiver_(1).webm">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/1/Chapter_1_-_am_a_Caregiver_(1).mp4">
            </video>
            <video id="Chapter_Two_Video" preload="none">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/2/Chapter_2_-_The_Beginning_(2).webm">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/2/Chapter_2_-_The_Beginning_(2).mp4">
            </video>
            <video id="Chapter_Three_Video" preload="none">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/3/Chapter_3_-_Interdependence.webm">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/3/Chapter_3_-_Interdependence.mp4">
            </video>
            <video id="Chapter_Four_Video" preload="none">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/4/Chapter_4_-_Loss_and_Grief.webm">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/4/Chapter_4_-_Loss_and_Grief.mp4">
            </video>
            <video id="Chapter_Five_Video" preload="none">
                <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/5/Chapter_5_-_Inspiration.webm">
                <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/PamAndEd/5/Chapter_5_-_Inspiration.mp4">
            </video>
            <div class="bottom_overlay">
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
            </div>
            <span class="chapter_display"><span class="chapter_1"><span></span></span><span class="chapter_2"><span></span></span><span class="chapter_3"><span></span></span><span class="chapter_4"><span></span></span><span class="chapter_5"><span></span></span></span>
        </section>
        <section class="full response response_one">
            <section class="overlay prompt">
                <fieldset>
                 <p>Which of these best describes you?</p>
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
                <fieldset>
                <p>If your loved one was experiencing signs of dementia, would you keep it a secret?</p>
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
                <fieldset>
                <p>Who are you here for?</p>
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
            <fieldset>
                <p>What do you miss most?</p>
                <textarea data-field_id="4" data-content_id="' . $content_id . '">' . $additional . '</textarea>
                <button>Continue</button>
                </fieldset>
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
get_footer();

 ?>
