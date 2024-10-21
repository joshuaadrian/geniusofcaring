<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

function loop_mods( $query ) {

  if ( is_admin() || !$query->is_main_query() ) return;

  if (
    ( $query->is_main_query() )
    && !empty($query->query['post_type'])
    && ( $query->query['post_type'] == 'transactions' )
  ) :
    $query->set( 'posts_per_page', 10 );
    // $query->set( 'paged', false );
    $query->set( 'order', 'DESC' );
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'meta_data_announcement_date' );
  endif;

  if ( is_admin()
    || ! $query->is_main_query() 
    || empty( get_query_var( 'post_type' ) )
    || 'transactions' !== get_query_var( 'post_type' ) )
  {
    return;
  }

  if ( ! empty( get_query_var( 'year_filter' ) ) ) {
    set_query_var( 'year', get_query_var( 'year_filter' ) );
  }

  return $query;

}

add_action( 'pre_get_posts', __NAMESPACE__ . '\\loop_mods' );

add_filter( 'render_block', function($block_content, $block) {

    // Only add a class to Core List blocks
    if('core/button' === $block['blockName']) {
      $start_span    = substr(strrchr($block_content, '">'),2);
      $block_content = str_replace($start_span,'<span>'.$start_span,$block_content);
      $block_content = str_replace('</a>','</span></a>',$block_content);
    }

    return $block_content;

}, 10, 2);

// Create a URL for filtering press releases by year.
function transactions_rewrite_rules() {
  add_rewrite_rule(
    'transactions/([0-9]{4})/?$',
    array(
      'year_filter' => '$matches[1]',
      'post_type'   => 'transactions',
    ),
    'top'
  );
}
add_action( 'init', __NAMESPACE__ . '\\transactions_rewrite_rules', 11, 0 );

function register_year_filter_query_var( $vars ) {
  $vars[] = 'year_filter';
  return $vars;
}
add_filter( 'query_vars', __NAMESPACE__ . '\\register_year_filter_query_var' );

function head_inserts() {

  ?>

<!-- Twitter conversion tracking base code -->
<script>
!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
twq('config','ompm6');
</script>
<!-- End Twitter conversion tracking base code -->

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1010778587338811');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1010778587338811&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

  <?php

}

add_action( 'wp_head', __NAMESPACE__ . '\\head_inserts' );

function footer_inserts() {

  ?>

<!-- LinkedIn Pixel Code -->
<script type="text/javascript">
_linkedin_partner_id = "6178810";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(l) {
if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
window.lintrk.q=[]}
var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})(window.lintrk);
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=6178810&fmt=gif" />
</noscript>
<!-- End LinkedIn Pixel Code -->

  <?php

}

add_action( 'wp_footer', __NAMESPACE__ . '\\footer_inserts' );

function my_current_month_selector( $link_html ) {

  if ( is_year() ) :

    $current_year = get_the_date("Y");

    if ( preg_match('/'.$current_year.'/i', $link_html ) ) :
      $link_html = preg_replace('/<li>/i', '<li class="current-year">', $link_html );
    endif;

  endif;

  return $link_html;

}

add_filter( 'get_archives_link', __NAMESPACE__ . '\\my_current_month_selector' );

// Allow VCF uploads to media library
function enable_vcard_upload( $mime_types ){
  $mime_types['vcf'] = 'text/x-vcard';
  return $mime_types;
}
add_filter('upload_mimes', __NAMESPACE__ . '\\enable_vcard_upload' );

/**
 * Add <body> classes
 */
function body_class($classes) {

  $post = get_post();
  $fixed_nav   = true;

  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  if ( !empty($post) && !empty($post->post_content) && has_blocks( $post->post_content ) ) {

    $blocks = parse_blocks( $post->post_content );

    if ( $blocks[0]['blockName'] !== 'acf/masthead' ) {
      $classes[] = 'no-masthead';
    }

  }

  if ( $fixed_nav ) :
    $classes[] = 'fixed-nav';
  endif;

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;

}

add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function my_excerpts_length( $length ) {
  return 30;
}

add_filter( 'excerpt_length', __NAMESPACE__ . '\\my_excerpts_length' );

function excerpt_more() {

  global $post;

  $id        = $post->ID;
  $target    = "_self";
  $link      = get_permalink( get_the_ID() );
  $link_text = 'Read More';

  if ( class_exists('acf') ) :

    if ( get_field('pdf', $id) ) :

      $link      = get_field('pdf', $id);
      $link      = $link['url'];
      $target    = "_blank";

    endif;

    if ( get_field('external_url', $id) ) :

      $link      = get_field('external_url', $id);
      $target    = "_blank";

    endif;

  endif;

  return '&hellip; <a href="'.$link.'" target="'.$target.'">' . $link_text . '</a>';

}

add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

// http://php.net/manual/en/function.date.php
function date_shortcode_function( $atts ) {
  $a = shortcode_atts( array(
    'format' => 'Y'
  ), $atts );
  return date( $a['format'] );
}

add_shortcode('date', __NAMESPACE__ . '\\date_shortcode_function');
