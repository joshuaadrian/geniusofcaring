<?php
/**
 * The main template file for the Blog Page.
 */

get_header();
while(have_posts()):
    the_post(); ?>
    <article class="full">
        <div class="inner">
            <a class="header" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title('<h1>', '</h1>'); ?></a>
            <span class="the_date"><?php the_time('F j, Y'); ?></span>
            <?php the_excerpt(); ?>
        </div>
    </article>

<?php 
    endwhile;
    get_footer(); ?>