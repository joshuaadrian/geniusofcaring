<?php
/*
 * The main template file for blog posts.
 */
    get_header();
    the_post();
?>
    <article class="full">
        <div class="inner">
            <?php the_title('<h1>', '</h1>'); ?>
            <span class="the_date"><?php the_time('F j, Y'); ?></span>
            <?php the_content(); ?>
            <div class="fb-comments" data-href="<?php the_permalink() ?>" data-numposts="5"></div>
            <script type="text/javascript">
                FB.XFBML.parse();
            </script>

        </div>
    </article>
<?php
    get_footer();
?>
