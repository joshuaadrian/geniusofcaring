<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  add_theme_support('editor-styles');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Refesrence/register_nav_menus
  register_nav_menus([
    'primary_navigation' => 'Primary Navigation',
    'media_navigation' => 'Media Navigation',
    'footer_explore_navigation'  => 'Footer Explore Navigation',
    'footer_resources_navigation'  => 'Footer Resources Navigation',
    'social_navigation'  => 'Social Navigation'
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_image_size( 'square', '1000', '1000', true );
  add_image_size( 'xlarge', '1600', '9999' );
  add_image_size( 'xxlarge', '2400', '9999' );

  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\\disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', __NAMESPACE__ . '\\disable_emojis_remove_dns_prefetch', 10, 2 );

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  // add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  add_theme_support( 'editor-color-palette', [
    [
      'name' => 'White',
      'slug' => 'white',
      'color' => '#ffffff'
    ],
    [
      'name' => 'gray-100',
      'slug' => 'gray-100',
      'color' => '#f0f0f1'
    ],
    [
      'name' => 'gray-200',
      'slug' => 'gray-200',
      'color' => '#e3eaee'
    ],
    [
      'name' => 'gray-500',
      'slug' => 'gray-500',
      'color' => '#3f464c'
    ],
    [
      'name' => 'gray-700',
      'slug' => 'gray-700',
      'color' => '#1a1d1f'
    ],
    [
      'name' => 'yellow-400',
      'slug' => 'yellow-400',
      'color' => '#f0b42d'
    ],
    [
      'name' => 'blue-400',
      'slug' => 'blue-400',
      'color' => '#2c3da0'
    ],
    [
      'name' => 'blue-500',
      'slug' => 'blue-500',
      'color' => '#20295a'
    ],
    [
      'name' => 'blue-700',
      'slug' => 'blue-700',
      'color' => '#181f45'
    ],
    [
      'name' => 'Black',
      'slug' => 'black',
      'color' => '#000000'
    ]
  ]);

  add_theme_support( 'disable-custom-colors' );

  add_theme_support( 'editor-gradient-presets', [
		[
			'name'     => 'Blue 700 to Blue 400',
			'gradient' => 'linear-gradient(135deg, #181f45 0%, #2c3da0 100%)',
			'slug'     => 'blue-700-to-blue-400',
		],
  ]);

  add_theme_support( 'disable-custom-gradients' );

}

add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

function google_analytics_snippet() {

  ?>

  <?php

}

add_action('wp_head', __NAMESPACE__ . '\\google_analytics_snippet',1);

function google_tag_manager_snippet() {

  ?>

  <?php

}

add_action('wp_body_open', __NAMESPACE__ . '\\google_tag_manager_snippet');

function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}

function load_custom_wp_admin_style() {

  $get_assets = file_get_contents( get_template_directory() . '/dist/mix-manifest.json' );
  $assets     = json_decode( $get_assets, true );

  wp_register_style( 'crux/admin-css', get_template_directory_uri() . '/dist' . $assets['/styles/admin.css'], false, '1.0.0' );
  wp_enqueue_style( 'crux/admin-css' );

  // wp_register_script('admin/js', get_template_directory_uri() . '/dist' . $assets['/scripts/admin.js'], ['jquery'], '1.0.0', true);
  // wp_localize_script('admin/js', 'localized_object', array(
  //   'ajax_url'       => admin_url( 'admin-ajax.php' ),
  //   'nonce'          => wp_create_nonce( 'crm-ajax-nonce' ),
  // ));
  // wp_enqueue_script( 'admin/js' );


}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\load_custom_wp_admin_style' );

function my_guten_enqueue() {

  $get_assets = file_get_contents( get_template_directory() . '/dist/mix-manifest.json' );
  $assets     = json_decode( $get_assets, true );

  wp_enqueue_script(
    'guten/js',
    get_template_directory_uri() . '/dist' . $assets['/scripts/admin.js'],
    ['jquery', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' ],
  );

}

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\my_guten_enqueue' );

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', __NAMESPACE__ . '\\cc_mime_types');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {

  $get_assets = file_get_contents( get_template_directory() . '/dist/mix-manifest.json' );
  $assets     = json_decode( $get_assets, true );

  wp_enqueue_style('app/css', get_template_directory_uri() . '/dist' . $assets['/styles/app.css'], false, null);

  if ( !is_admin() ) {

    wp_register_script('app/crx', get_template_directory_uri() . '/dist' . $assets['/scripts/app.js'], ['jquery'], null, true);

    wp_localize_script('app/crx', 'localized_object', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'nonce'    => wp_create_nonce( 'crm-ajax-nonce' )
    ));

    wp_enqueue_script( 'app/crx' );

  }

}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 99999);


function block_gutenberg_scripts() {

  wp_enqueue_script(
    'block-editor',
    get_stylesheet_directory_uri() . '/assets/scripts/editor.js',
    array( 'wp-blocks', 'wp-dom' ),
    null,
    true
  );

  wp_enqueue_style(
    'editor/css',
    get_template_directory_uri() . '/dist/styles/editor.css',
    false,
    null
  );

}

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\block_gutenberg_scripts' );
