<?php
/**
* Template Name: Portrait   
*/

get_header();

?>

<section class="full portraits">
    <video id="Portraits_Loop" loop="loop" preload="auto"  autoplay muted>
        <source type="video/mp4" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.mp4">
        <source type="video/webm" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.webm">
        <source type="video/m4v" src="https://geniusofcaring.s3.amazonaws.com/video/portrait_page/loops/Portrait_Page-_Loop_of_island-720_2500.m4v">
    </video>
    <section class="overlay prompt">
        <a href="/portraits/kamaria"><img class="kamaria" src="<?= get_stylesheet_directory_uri(); ?>/images/Kamaria_portrait_tile.jpg"></a>
        <a href="/portraits/pam-ed"><img class="pam_and_ed" src="<?= get_stylesheet_directory_uri(); ?>/images/PamEd.jpg"></a>
        <a href="/portraits/chuck-and-dolores"><img class="chuckanddolores" src="<?= get_stylesheet_directory_uri(); ?>/images/chuck-and-dolores.jpg"></a>
    </section>
</section>

<?php get_footer(); ?>