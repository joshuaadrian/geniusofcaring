<?php
/**
 * The Header for our theme.
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
	<script src="<?= get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
    <script src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!--     <script src="https://www.google.com/jsapi?key=AIzaSyDzBw_JyK6f08_TrmdBmhs8FtHdZS-zMFg"></script>
    <script>
        google.load('maps', '3', {other_params:'libraries=places'});
    </script> -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <script src="<?= get_template_directory_uri(); ?>/js/scripts.js" type="text/javascript"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/isotope.js" type="text/javascript"></script>
    <script src="<?= get_template_directory_uri(); ?>/js/croppic/js/croppic.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" media="all" href="<?= get_template_directory_uri(); ?>/js/croppic/css/croppic.css">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-17269802-3', 'auto');
      ga('require', 'displayfeatures');
      ga('send', 'pageview');

    </script>
<meta name="twitter:description" content="A story-sharing community for those caring for loved ones with Alzheimer&rsquo;s.">
<meta property="og:description" content="A story-sharing community for those caring for loved ones with Alzheimer&rsquo;s." /> 
<?php wp_head(); ?>
<meta name="msvalidate.01" content="EC4DD5658BB975D1BE34F195BA1C5BDF" />
</head>

<body <?php body_class(); ?>>
    <header class="page_header full">
        <a href="/" class="logo"><img src="<?= get_template_directory_uri(); ?>/images/GOC_logo.png" alt="The Genius of Caring" title="The Genius of Caring"></a>
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
            <a class="nav-button" href="https://www.globalgiving.org/projects/the-genius-of-caring/"><span>Support</span></a>
            <span class="social_button" title="Share The Genius of Caring">Share The Genius of Caring</span>
        </nav>
    </header>