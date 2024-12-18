<?php
/**
* Template Name: Home Page
*/

get_header();

?>
    <article class="full intro">
        <img src="/wp-content/themes/caring2024/images/GOC_large_logo.png">
        <button>Explore</button>
        <div class="welcome_text">
        <div>
            <p>Welcome to The Genius of Caring, a story-sharing community made up of family caregivers, friends and those whose lives have been touched by Alzheimer&rsquo;s and other caregiving-intensive diseases.</p>
            <p>We invite you to view our caregiver video portraits. While engaging with the content, you will be prompted to share how Alzheimer&rsquo;s has touched your life. You will also have the opportunity to share your stories, photos and experiences and add them to our community archive.</p>
            <a class="button" href="/portraits">Continue</a>
        </div>        
        </div>        
    </article>
<?php 


    echo '
            </ul>
        </article>
        <section class="soundcloud_player">
            <div class="iframe">
                <iframe width="100%" height="350" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/147277442&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
            </div>
            <button class="soundcloud_button">Sound</button>
        </section>';
		
    get_footer();

 ?>
