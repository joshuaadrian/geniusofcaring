<?php
/**
* Template Name: Conversations   
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
            <?php

            if ( has_nav_menu('primary') ) :

                wp_nav_menu([
                    'theme_location'  => 'primary',
                    'depth'           => 2,
                    'container'       => '',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'nav',
                    'link_before'     => '<span>',
                    'link_after'      => '</span>'
                ]);

            endif;

            ?>
        </nav>
        <nav class="secondary_nav">
<span class="social_button" title="Share The Genius of Caring">Share The Genius of Caring</span>
        </nav>
    </header>
<?php    
    the_post();
?>
    <article class="full">
        <section class="intro_masthead">
            <div class="inner">
                <img src="/wp-content/themes/caring2024/images/conversations_text.png" alt="Genius of Caring Conversations">
                <a class="block" href="/conversations/alzheimers-family">
                    <h1>Family</h1>
                    <p>As the holiday season draws near, we’re discussing the topic of family. Whether we’re related by blood or connected through shared experiences, ‘family’ are the people who support and love us. How has your family impacted your experience as a caregiver? How do family gatherings around the holiday season affect your loved one?<br><span class="link">Read More...</span></p>
                </a>
                <a class="block" href="/conversations/alzheimers-story">
                    <h1>Story</h1>
                    <p>Why do we tell stories? Stories have been with us since the beginning of our history as people. We speak them to our children, we recall them as we age. We use them to bridge divides, to establish commonality, to illustrate lessons. Stories ground us in the beauty and pain of the human experience. Stories can help us heal.<br><span class="link">Read More...</span></p>
                </a>
                <a class="block" href="/conversations/alzheimers-detection">
                    <h1>Detection</h1>
                    <p>Detection – Early detection enables us to seek not only treatment, but also support. The sooner we know, the sooner we can begin to manage what is happening. <br><span class="link">Read More...</span></p>
                </a>
                <a class="block" href="/conversations/alzheimers-support">
                    <h1>Support</h1>
                    <p>Support – As caregivers, providing support to our patient or loved one is integral to what we do. Caregivers need support as well. For many of us, it can be found in unexpected places. <br><span class="link">Read More...</span></p>
                </a>
                <a class="block" href="/conversations/alzheimers-secrecy">
                    <h1>Secrecy</h1>
                    <p>Everybody has at least one. Some are innocent, some heavy and dark. But what if somebody you loved – like your partner or parent - asked you to keep their diagnosis a secret? <br><span class="link">Read More...</span></p>
                </a>
            </div>
        </section>
   </article>
<?php
    get_footer();
?>
