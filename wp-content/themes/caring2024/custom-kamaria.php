<?php
/**
* Template Name: Kamaria
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
        $maplocation = '{lat: 39, lng: -98}';
        if($answers[21]->field_content != ''){
            $content_id = $answers[21]->content_id;
            $field_content = $answers[21]->field_content;
            $maplocation = $field_content;
        }
        echo'
        <section class="video_container hd_on">
            <video id="Chapter_One_Video" preload="auto" class="active">
                <source type="video/webm" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/1/Kamaria_Ch01_TCLoops.webm">
                <source type="video/mp4" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/1/Kamaria_Ch01_TCLoops.mp4">
            </video>
            <video id="Chapter_Two_Video" preload="none">
                <source type="video/webm" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/2/Kamaria_Ch02_TCLoops.webm">
                <source type="video/mp4" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/2/Kamaria_Ch02_TCLoops.mp4">
            </video>
            <video id="Chapter_Three_Video" preload="none">
                <source type="video/webm" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/3/Kamaria_Ch03_TCLoops.webm">
                <source type="video/mp4" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/3/Kamaria_Ch03_TCLoops.mp4">
            </video>
            <video id="Chapter_Four_Video" preload="none">
                <source type="video/webm" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/4/TGC_Kamaria_Ch04_-_2016_04_21_H264.webm">
                <source type="video/mp4" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/4/TGC_Kamaria_Ch04_-_2016_04_21_H264.mp4">
            </video>
            <video id="Chapter_Five_Video" preload="none">
                <source type="video/webm" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/5/TGC_Kamaria_Ch05_-_2016_04_21_H264.webm">
                <source type="video/mp4" src="https://s3.amazonaws.com/weowntv.geniusofcaring/videos/Kamaria/5/TGC_Kamaria_Ch05_-_2016_04_21_H264.mp4">
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
                <p>Where do you live?</p>
                <fieldset>
                <div id="mapPicker" style="width: 900px; height: 400px;border-radius:4px;opacity:0.9;position:relative;">
                    <input id="searchTextField" type="text" size="50" style="position:absolute;top:0;left:0;z-index:9999;custom-kamaria.php">
                </div>
                <input type="hidden" id="mapButtonHiddenField" value="' . $field_content . '">
                    <button data-field_id="21" data-content_id="' . $content_id . '"';
                    echo'>Continue</button>
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
        <section class="full response response_two">
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
        $field_content = 'The biggest change I have had to make...';
        if($answers[22]->field_content != ''){
            $content_id = $answers[22]->content_id;
            $field_content = $answers[22]->field_content;
            $additional = $answers[22]->additional;
        }
        echo'
        <section class="full response response_three">
            <section class="overlay prompt">
                <p>The biggest change I have had to make...</p>
                <textarea data-field_id="22" data-content_id="' . $content_id . '">' . $additional . '</textarea>
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
?>

<script src="https://www.google.com/jsapi?key=AIzaSyDzBw_JyK6f08_TrmdBmhs8FtHdZS-zMFg"></script>
<script>
    google.load('maps', '3', {other_params:'libraries=places'});
</script>
<script src="/wp-content/themes/caring/js/locationpicker.jquery.js"></script>
<script>
    var input = document.getElementById('searchTextField');
    var options = {
        types: ['(cities)'],
    };
    autocomplete = new google.maps.places.Autocomplete(input, options);
    //            $('#mapButtonHiddenField').val('{latitude: ' + currentLocation.latitude + ', longitude: ' + currentLocation.longitude + '}');

    function initMap(){
        var mapDiv = document.getElementById('mapPicker');
        map = new google.maps.Map(mapDiv, {
            center: <?php echo $maplocation ?>,
            zoom: 4
        });

    }
</script>
<?php
get_footer();

 ?>
