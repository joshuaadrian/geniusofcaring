<?php

require __DIR__ . '/lib/security/vendor/autoload.php';

$goc_includes = [
    'lib/security/csp-headers.php',
];

foreach ($goc_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// remove Extraneious WordPress headers
        //remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        //remove_action('wp_head', 'index_rel_link');
        //remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        //remove_action('wp_head', 'start_post_rel_link', 10, 0);
        //remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        remove_action('wp_head', 'noindex', 1);

// remove WordPress version from RSS feeds
        function no_generator() { return ''; }
        add_filter('the_generator', '_no_generator');
        if (!is_admin()) {
           wp_deregister_script('l10n');
        }

// register Nav
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation' ),
	) );

// Add support for Featured Images
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'work-thumb', 100,100 ); //300 pixels wide (and unlimited height)
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

function genius_set_content_type() {
	return 'text/html';
}
function genius_set_mail_from( $original_email_address ){
	return 'email@geniusofcaring.com';
}
function genius_set_mail_from_name( $original_email_from ){
	return 'Genius of Caring';
}

add_filter('wp_mail_from', 'genius_set_mail_from');
add_filter('wp_mail_from_name', 'genius_set_mail_from_name');
add_filter('wp_mail_content_type', 'genius_set_content_type');


add_filter('admin_init', 'genius_general_settings_register_fields');
function genius_general_settings_register_fields(){
    register_setting('general', 'twitter_url', 'esc_attr');
    register_setting('general', 'facebook_url', 'esc_attr');
    add_settings_field('twitter_url', '<label for="twitter_url">'.__('Twitter URL' , 'twitter_url' ).'</label>' , 'genius_general_twitter_fields_html', 'general');
    add_settings_field('facebook_url', '<label for="facebook_url">'.__('Facebook URL' , 'facebook_url' ).'</label>' , 'genius_general_facebook_fields_html', 'general');
}
function genius_general_twitter_fields_html(){
    $value = get_option( 'twitter_url', '' );
    echo '<input type="text" id="twitter_url" name="twitter_url" value="' . $value . '" />';
}
function genius_general_facebook_fields_html(){
    $value = get_option( 'facebook_url', '' );
    echo '<input type="text" id="facebook_url" name="facebook_url" value="' . $value . '" />';
}

add_filter('show_admin_bar', '__return_false');


// redirects all instances of wp-login.php to my story page
function change_login_redirect($redirect_to, $request_redirect_to, $user) {
$wp_user_id = $user->ID;

    return '/my-story';
}
add_filter('login_redirect','change_login_redirect', 10, 3);

$_POST   = stripslashes_deep($_POST);


function custom_rewrite( $wp_rewrite ) {
    $feed_rules = array(
        'care-gallery/(.+)'  =>  'index.php?page_id=12&user_url=' . $wp_rewrite->preg_index(1),
    );
    $wp_rewrite->rules = $feed_rules + $wp_rewrite->rules;
}

function custom_wp_querystring() {
    add_rewrite_tag('%user_url%','([^&]+)');
}

add_action( 'init', 'custom_wp_querystring');
add_filter( 'generate_rewrite_rules', 'custom_rewrite' );


add_shortcode( 'set_user_url', 'genius_set_user_url' );
function genius_set_user_url( $atts, $content = null ) {
    if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
    $User = new User();
    $User->useSession();
    $user_id = $User->user_id;
    $user_url = $User->get_user_url_from_user_id($user_id);
    if($user_url!=''){
        return '
            <p>Your permanent Care Gallery URL is: <a href="http://www.geniusofcaring.wpengine.com/care-gallery/' . $user_url . '">www.geniusofcaring.wpengine.com/care-gallery/' . $user_url . '</a><p>';
    } else {
        return '
            <p>You can create your own unique URL for your personal story here.  This will make it easy to find your page publically and to share your story page with friends and family.</p>
            <p>An example is:  www.geniusofcaring.wpengine.com/YourNameHere</p>
            <label for="seturl">Enter your desired page name below.</label><input type="text" name="seturl" id="seturl">
            <p>Keep in mind, that once you&rsquo;ve set the URL it cannot be changed.</p>
            <button>Save URL</button>';
    }
}

add_shortcode( 'set_privacy_settings', 'genius_set_privacy_settings' );
function genius_set_privacy_settings( $atts, $content = null ) {
    /*
    if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
    require_once(get_stylesheet_directory() . '/class/User.php');
    $User = new User();
    $User->useSession();
    $privacy_setting = $User->getPrivacy();
    if($privacy_setting=='Public'){
        $to_return = '
            <p>We understand that details of your personal story may be sensitive in nature. By default, all stories are made public, but you may choose to make your story visible only to those you give permission to. You may adjust these settings below. If you create a sharing password, make sure it is different from your login password.<p>
            <input type="radio" name="privacy_radio" id="public_radio" checked="checked"><label for="public_radio">Anyone can view my story.</label><br>
            <input type="radio" name="privacy_radio" id="private_radio"><label for="private_radio">Only those with a password can view my story.</label>
            <br>
            <label for="public_password" style="display:none;">Password:</label><input type="text" name="public_password" id="public_password" style="display:none;">
            <button>Save Settings</button>';
    } else {
        $public_password = $User->getPublicPassword();
        $to_return = '
            <p>We understand that details of your personal story may be sensitive in nature. By default, all stories are made public, but you may choose to make your story visible only to those you give permission to. You may adjust these settings below. If you create a sharing password, make sure it is different from your login password.<p>
            <input type="radio" name="privacy_radio" id="public_radio"><label for="public_radio">Anyone can view my story.</label><br>
            <input type="radio" name="privacy_radio" id="private_radio" checked="checked"><label for="private_radio">Only those with a password can view my story.</label>
            <br>
            <label for="public_password">Password:</label><input type="text" name="public_password" id="public_password" value="' . $public_password . '">
            <button>Save Settings</button>';
    }
    return $to_return;*/
    return '';
}

