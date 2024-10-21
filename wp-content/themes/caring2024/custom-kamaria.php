<?php
/**
* Template Name: Kamaria
*/
    session_start();
    get_header();
        
        
    //Chapter 1
    $content_id = '';

?>

<section class="video_container hd_on">

    <!-- Chapter One -->
    <video id="Chapter_One_Video" playsinline="true" autoplay="true" preload="auto" class="active">
        <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/1/Kamaria_Ch01_TCLoops.webm">
        <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/1/Kamaria_Ch01_TCLoops.mp4">
    </video>

    <!-- Chapter One -->
    <video id="Chapter_Two_Video" preload="none">
        <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/2/Kamaria_Ch02_TCLoops.webm">
        <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/2/Kamaria_Ch02_TCLoops.mp4">
    </video>

    <!-- Chapter One -->
    <video id="Chapter_Three_Video" preload="none">
        <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/3/Kamaria_Ch03_TCLoops.webm">
        <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/3/Kamaria_Ch03_TCLoops.mp4">
    </video>

    <!-- Chapter One -->
    <video id="Chapter_Four_Video" preload="none">
        <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/4/TGC_Kamaria_Ch04_-_2016_04_21_H264.webm">
        <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/4/TGC_Kamaria_Ch04_-_2016_04_21_H264.mp4">
    </video>

    <!-- Chapter One -->
    <video id="Chapter_Five_Video" preload="none">
        <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/5/TGC_Kamaria_Ch05_-_2016_04_21_H264.webm">
        <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/Kamaria/5/TGC_Kamaria_Ch05_-_2016_04_21_H264.mp4">
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

    <span class="chapter_display">
        <span class="chapter_1">
            <span></span>
        </span>
        <span class="chapter_2">
            <span></span>
        </span>
        <span class="chapter_3">
            <span></span>
        </span>
        <span class="chapter_4">
            <span></span>
        </span>
        <span class="chapter_5">
            <span></span>
        </span>
    </span>

</section>

<section class="full response response_one">
    <section class="overlay prompt">
        <img class="data_slide" src="<?= get_stylesheet_directory_uri(); ?>/images/slide.png">
        <button>Continue</button>
    </section>
</section>

<section class="full response response_two">
    <section class="overlay prompt">
        <img class="data_slide" src="<?= get_stylesheet_directory_uri(); ?>/images/slide.png">
        <button>Continue</button>
    </section>
</section>

<section class="full response response_three">
    <section class="overlay prompt">
        <img class="data_slide" src="<?= get_stylesheet_directory_uri(); ?>/images/slide.png">
        <button>Continue</button>
    </section>
</section>

<section class="full response response_four">
    <section class="overlay prompt">
        <img class="data_slide" src="<?= get_stylesheet_directory_uri(); ?>/images/slide.png">
        <button>Continue</button>
    </section>
</section>

<section class="full response response_five">
    <section class="overlay prompt">
        <p>Welcome to our story-sharing community made up of family caregivers, friends and those whose lives have been touched by Alzheimer&rsquo;s and other related dementias.</p>
        <button>Continue</button>
    </section>
</section>

<?php get_footer(); ?>
