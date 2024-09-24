<?php
/**
* Template Name: Conversations-secrecy  
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
                <img src="/wp-content/themes/caring/images/GOC_cons_logo.png" alt="Genius of Caring Conversations">
                <iframe src="https://player.vimeo.com/video/91466418?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                <p>Secrets. Everybody has at least one. Some are innocent, some heavy and dark. But what if somebody you loved – like your partner or parent - asked you to keep their diagnosis a secret? Balancing respect for privacy with the concerns of allowing someone to suffer in silence is a serious dilemma. How would a secret like this affect your relationship, your wellbeing and the wellbeing of the individual who has received the diagnosis or begun to experience symptoms? In the above video, Pam shares how she has been affected by the stigma around her diagnosis. Her closest friends also offer their perspectives. We invite you to watch the video, ponder this topic of secrecy and join our conversation.</p>
            </div>
        </section>
        <div class="inner">
            <h1>Articles About Secrecy</h1>
            <p>Some of our partners have offered their unique perspectives around the issue of secrecy. Read the following posts by 	Laurel Coleman, a geriatric physician on the Alzheimer's Advisory council, Bonnie Bigalke, a social worker with Alzheimer's Association MA/NH chapter and Dr. Brent Forester, with McLean Hospital, specializing in geriatric psychiatry.</p>
            <p><a href="http://geniusofcaring.wpengine.com/posts/secrecy-vs-privacy-the-danger-of-silence">Secrecy vs. Privacy: The Danger of Silence by Dr. Laurel Coleman</a></p>
            <p><a href="http://geniusofcaring.wpengine.com/posts/the-burden-of-secrecy-by-bonnie-bigalke">The Burden of Secrecy, by Bonnie Bigalke</a></p>
            <p><a href="http://geniusofcaring.wpengine.com/posts/caring-for-the-caregiver-part-1">Caring for the Caregiver: Part 1</a></p>
            <h1>Share Your Story</h1>
            <p>Do you have personal experience with this conversation topic, or with Alzheimer’s in general? We’d love for you to experience the interactive documentary starting with Pam and Ed’s Portrait.</p>
            <a class="button" onClick="ga('send', 'event', 'share_your_story', 'buttonclick', 'secrecy_page', 1);" href="/portraits/pam-ed">Share Your Story</a>
            <h1>Continue the Conversation</h1>
            <p>Follow us on social media where we’re having an ongoing discussion about this topic. Learn what others think and share your point of view. Use the hashtags #geniusofcaring & #secrecy.</p>
            <a class="twitter_icon" onClick="ga('send', 'event', 'social', 'buttonclick', 'twitter', 1);" href="https://twitter.com/geniusofmarian">Twitter</a>
            <a class="facebook_icon" onClick="ga('send', 'event', 'social', 'buttonclick', 'facebook', 1);" href="https://www.facebook.com/TheGeniusOfMarian">Facebook</a>
            <p>&nbsp;</p>
            <h1>Sign the Guestbook</h1>
            <div class="fb-comments" data-href="<?php the_permalink() ?>" data-numposts="5"></div>
        </div>
    </article>
<?php
    get_footer();
?>
