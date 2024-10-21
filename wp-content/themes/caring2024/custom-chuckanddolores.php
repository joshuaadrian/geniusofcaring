<?php
/**
* Template Name: Chuck and Dolores
*/
    session_start();
    get_header();
        
    //Chapter 1
    $content_id = '';

?>

<section class="video_container hd_on">

    <!-- Chapter One -->
    <div id="Chapter_One_Video" style="height:calc(100vh - 80px);position: relative;"><div style="position:absolute;inset:0;background:black;max-height: 100%;max-width:100%;"><iframe src="https://player.vimeo.com/video/954064994?h=9595ab0dd9&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Chuck &amp; Dolores"></iframe></div></div><script src="https://player.vimeo.com/api/player.js"></script>

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

