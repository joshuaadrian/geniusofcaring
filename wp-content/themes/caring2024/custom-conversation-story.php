<?php
/**
* Template Name: Conversations-story    
*/
 if(is_user_logged_in()){
        if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
        if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
        $User = new User; 
        $User->useSession();
        $User->get_profile();
        $user_logged_in = 'logged_in';
    }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <script type="text/javascript" src="//use.typekit.net/sxn8ywk.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <script src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/isotope.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/croppic/js/croppic.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/js/croppic/css/croppic.css">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-17269802-3', 'auto');
      ga('require', 'displayfeatures');
      ga('send', 'pageview');

    </script>
<?php wp_head(); ?>
<meta name="msvalidate.01" content="EC4DD5658BB975D1BE34F195BA1C5BDF" />
</head>

<body <?php body_class(); ?>>
    <header class="page_header full">
        <a href="/" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/GOC_logo.png" alt="The Genius of Caring" title="The Genius of Caring"></a>
        <nav class="primary_nav">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?>
        </nav>
        <nav class="secondary_nav">
<?php
    if(is_user_logged_in()){
        $user__head_image = $User->user_photo;
        if($User->user_photo == '/wp-content/themes/caring/images/profile_add_image_bttn.png' || $User->user_photo == '/wp-content/themes/caring/images/defaults/profile.png' || $User->user_photo == ''){
            $user__head_image = '/wp-content/themes/caring/images/defaults/profile.png';
        }
    
        echo'
            <a href="/my-story" title="Add to your story"><img src="' . $user__head_image . '"></a>
            <a class="gear" href="/settings" title="Edit Settings">Edit Settings</a>
            <span class="social_button" title="Share The Genius of Caring">Share The Genius of Caring</span>';
    } else {
        echo'
            <a class="login" href="/login">Login</a>
            <a class="signup" href="/sign-up">Sign Up</a>
            <span class="social_button" title="Share The Genius of Caring">Share The Genius of Caring</span>';
    }
?>    
        </nav>
    </header>
<?php    
    the_post();
?>
    <article class="full">
        <section class="intro_masthead">
            <div class="inner">
                <img src="/wp-content/themes/caring/images/Story_title.png" alt="Genius of Caring Conversations">
                <iframe src="https://player.vimeo.com/video/135098494?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <p>Why do we tell stories? Stories have been with us since the beginning of our history as people. We speak them to our children, we recall them as we age. We use them to bridge divides, to establish commonality, to illustrate lessons. Stories ground us in the beauty and pain of the human experience. Stories can help us heal.</p>
            </div>
        </section>
        <div class="inner">
            <h1>Reading List</h1>
            <p>Have a look at some of our guest posts below discussing this month’s topic: <br><strong>The Power of a Story</strong>.</p>
            <div class="reading_list" style="background:url(/wp-content/themes/caring/images/note_blog_thumb.jpg) no-repeat top left;">
                <div>
                    <p><a href="http://geniusofcaring.wpengine.com/posts/hello-i-must-be-going-by-michaele-oleary-reiff">Hello I Must Be Going by Michaele O'Leary-Reiff</a>
                    <br>Little did I know then, the dark truth hidden in those seemingly light-hearted words; the man I would eventually marry would be taken from me all too soon by the ravages of Alzheimer’s disease.
                    <br><a href="http://geniusofcaring.wpengine.com/posts/hello-i-must-be-going-by-michaele-oleary-reiff">Continue Reading</a></p>
                </div>
            </div>
            <div class="reading_list" style="background:url(/wp-content/themes/caring/images/hindsight_blog_thumb.jpg) no-repeat top left;">
                <div>
                    <p><a href="http://geniusofcaring.wpengine.com/posts/alzheimers-2020-hindsight-by-jane-gayer">Alzheimer's: 20/20 Hindsight by Jane Gayer</a>
                    <br>It’s easy to be knowledgeable about events after they happened, but sometimes very difficult to catch things as they unfold.  I guess that’s where the old axiom about 20/20 hindsight comes from.
                    <br><a href="http://geniusofcaring.wpengine.com/posts/alzheimers-2020-hindsight-by-jane-gayer">Continue Reading</a></p>
                    </div>
            </div>
            <div class="reading_list" style="background:url(/wp-content/themes/caring/images/pushingback_blog_thumb.jpg); no-repeat top left">
                <div>
                    <p><a href="http://geniusofcaring.wpengine.com/posts/coming-out-pushing-back-against-alzheimers-part-1-by-joan-brunwasser">Coming Out & Pushing Back Against Alzheimer's Part 1, by Joan Brunwasser</a>
                    <br>Participating in these various ways helped us to feel that we were pushing back at the disease rather than just letting it push us around.  Throughout coping with the disease, Bernie maintained his pleasant personality.
                    <br><a href="http://geniusofcaring.wpengine.com/posts/coming-out-pushing-back-against-alzheimers-part-1-by-joan-brunwasser">Continue Reading</a></p>
                </div>
            </div>
            <h1>Share Your Story</h1>
            <p>Do you have personal experience with this conversation topic, or with Alzheimer’s in general? We’d love for you to experience the interactive documentary starting with Pam and Ed’s Portrait.</p>
            <a class="button" onClick="ga('send', 'event', 'share_your_story', 'buttonclick', 'alzheimers_story_page', 1);" href="/portraits/pam-ed">Share Your Story</a>
            <h1>Order the Genius of Marian</h1>
            <div class="preorder">
                <div>
                    <h1>Hello from the Genius of Caring.</h1>
                    <p>Did you know we made a documentary film?<br>The Genius of Marian follows the journey of Pam and Ed as they navigate the process of Alzheimer’s together. </p>
                    <p><a href="https://goo.gl/h00lq7">Buy Now on iTunes</a></p>
                    <p><a href="http://geniusofmarian.com">Visit the Website</a></p>
                    <a href="https://goo.gl/h00lq7"><img src="/wp-content/themes/caring/images/GOM_itunes.png"></a>                    
                </div>
            </div>
            <h1>Continue the Conversation</h1>
            <p>Follow us on social media where we’re having an ongoing discussion about this topic. Learn what others think and share your point of view. Use the hashtags #geniusofcaring & #story.</p>
            <a class="twitter_icon" onClick="ga('send', 'event', 'social', 'buttonclick', 'twitter', 1);" href="https://twitter.com/geniusofmarian">Twitter</a>
            <a class="facebook_icon" onClick="ga('send', 'event', 'social', 'buttonclick', 'facebook', 1);" href="https://www.facebook.com/TheGeniusOfMarian">Facebook</a>
            <p>&nbsp;</p>
            <h1>Sign the Guestbook</h1>
            <div class="fb-comments" data-href="<?php the_permalink() ?>" data-numposts="5"></div>
        </div>
    </article>
    <div class="preorder_modal">
        <div class="preorder_content">
            <h1>Did you know we made a documentary film?</h1>
            <p>The Genius of Marian follows the journey of Pam and Ed as they navigate the process of Alzheimer’s together.</p>
            <p><a href="https://goo.gl/h00lq7">Order on iTunes</a></p>
            <p><a href="http://geniusofmarian.com">Visit the Website</a></p>
            <p class="impact">Available now.</p>
            <a href="https://goo.gl/h00lq7"><img src="/wp-content/themes/caring/images/pre_order_itunes_bttn.png"></a>
        </div>
        <span class="close">Close</span>
    </div>
<?php
    get_footer();
?>
