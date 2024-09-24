<?php
/*
 * The main template file.
 */
    get_header();
    the_post();
?>
    <article class="full">
        <div class="inner">
            <?php the_content(); ?>
        </div>
    </article>
<?php
    get_footer();
?>
