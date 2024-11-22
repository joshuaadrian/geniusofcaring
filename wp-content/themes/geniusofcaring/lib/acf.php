<?php

namespace Crux\Blocks;

use Crux\Blocks;

if ( class_exists('acf') ) {

  add_action( 'acf/input/admin_footer', __NAMESPACE__ . '\\gutenberg_sections_register_acf_color_palette' );
  add_filter('_wp_post_revision_fields', __NAMESPACE__ . '\\add_field_debug_preview');
  add_action( 'edit_form_after_title', __NAMESPACE__ . '\\add_input_debug_preview' );
  add_filter( 'acf/settings/save_json', __NAMESPACE__ . '\\my_acf_json_save_point' );
  add_filter('acf/settings/load_json', __NAMESPACE__ . '\\my_acf_json_load_point');

  initiate_blocks();

  add_action( 'init', __NAMESPACE__ . '\\my_register_acf_v6_blocks' );

}

function my_register_acf_v6_blocks() {

  $dir    = get_stylesheet_directory()."/lib/custom-blocks";
  $blocks = glob( $dir . '/*/block.json' );

  if ( !empty( $blocks ) ) : foreach ( $blocks as $block ) :

    register_block_type( $block );

  endforeach; endif;

}
 
function my_acf_json_save_point( $path ) {
  $path = get_stylesheet_directory() . '/lib/acf-json';
  return $path;
}

function my_acf_json_load_point( $paths ) {
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/lib/acf-json';
  return $paths;  
}

function add_field_debug_preview($fields){
   $fields["debug_preview"] = "debug_preview";
   return $fields;
}

function add_input_debug_preview() {
   echo '<input type="hidden" name="debug_preview" value="debug_preview">';
}

function gutenberg_sections_register_acf_color_palette() {

  $color_palette = output_the_colors();

  if ( !$color_palette ) return;

  ?>
  <script type="text/javascript">
      (function( $ ) {
          acf.add_filter( 'color_picker_args', function( args, $field ){

              // add the hexadecimal codes here for the colors you want to appear as swatches
              args.palettes = <?php echo $color_palette; ?>

              // return colors
              return args;

          });
      })(jQuery);
  </script>
  <?php

}

function output_the_colors() {

  // get the colors
  $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

  // bail if there aren't any colors found
  if ( !$color_palette )
  return;

  // output begins
  ob_start();

  // output the names in a string
  echo '[';
  foreach ( $color_palette as $color ) {
    echo "'" . $color['color'] . "', ";
  }
  echo ']';

  return ob_get_clean();

}

function initiate_blocks() {

  $dir    = get_stylesheet_directory()."/lib/acf-blocks";
  $blocks = glob( $dir . '/*/*.php' );

  if ( !empty( $blocks ) ) : foreach ( $blocks as $block ) :

    $slug = basename($block,'.php');
    $name = ucwords($slug);

    if ( strpos($slug,'code') === false) :

      $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.67 54.67">
          <g  data-name="Layer 2">
            <g id="Layer_1-2" data-name="Layer 1">
              <path fill="#1e1e1e" d="M9.29,9.29V45.38H45.38V9.29ZM28.15,32.52l3.21-3.21L35,33l-6.86,6.86L15.66,27.34,28.15,14.85,35,21.72l-3.65,3.65-3.21-3.21L23,27.34Z"/>
              <g>
                <polygon fill="#888888" points="46.15 49.67 5 49.67 5 8.53 0 3.53 0 54.67 51.15 54.67 46.15 49.67"/>
                <polygon fill="#777777" points="8.86 5 49.67 5 49.67 45.82 54.67 50.82 54.67 0 3.86 0 8.86 5"/>
              </g>
            </g>
          </g>
        </svg>';

      $args = [
        'name'              => $slug,
        'title'             => __($name),
        'description'       => __('A custom '.$name.' block.'),
        'render_template'   => $block,
        'category'          => 'crux',
        'icon'              => $icon,
        'keywords'          => array( $name, 'crux' ),
      ];

      acf_register_block_type($args);

    else :

      require_once($block);

    endif;

  endforeach; endif;

}

add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'crux',
                'title' => 'Crux',
            ),
        )
    );
}, 10, 2 );

if( function_exists('acf_add_options_page') ) :

  acf_add_options_page(array(
    'page_title'  => 'Disclaimer',
    'menu_title'  => 'Disclaimer',
    'menu_slug'   => 'disclaimer-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));

  acf_add_local_field_group(array(
    'key' => 'group_5c59d7848f92e',
    'title' => 'Disclaimer Settings',
    'fields' => array(
      array(
        'key' => 'field_5c59d78e6d7b5',
        'label' => 'Disclaimer Type',
        'name' => 'disclaimer_type',
        'type' => 'select',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => array(
            'none' => 'None',
            'popup' => 'Pop Up',
            'interstitial' => 'Interstitial',
            'nav_banner' => 'Nav Banner',
            'footer_banner' => 'Footer Banner',
            'footer' => 'Footer',
          ),
          'default_value' => array(
          ),
          'allow_null' => 0,
          'multiple' => 0,
          'ui' => 0,
          'return_format' => 'value',
          'ajax' => 0,
          'placeholder' => '',
        ),
        array(
          'key' => 'field_5c59d996a2404',
          'label' => 'Disclaimer Page',
          'name' => 'disclaimer_page',
          'type' => 'post_object',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'post_type' => array(
            0 => 'page',
          ),
          'taxonomy' => '',
          'allow_null' => 0,
          'multiple' => 0,
          'return_format' => 'object',
          'ui' => 1,
        ),
        array(
          'key' => 'field_5c59db4570104',
          'label' => 'Button Text',
          'name' => 'button_text',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => 'Enter Site',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
        ),
        array(
          'key' => 'field_5c59db1a70102',
          'label' => 'Button Color',
          'name' => 'button_color',
          'type' => 'color_picker',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '#000000',
        ),
        array(
          'key' => 'field_5c59db3a70103',
          'label' => 'Button Text Color',
          'name' => 'button_text_color',
          'type' => 'color_picker',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
        ),
        array(
          'key' => 'field_5c59db58f0180',
          'label' => 'Background Color',
          'name' => 'background_color',
          'type' => 'color_picker',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
        ),
        array(
          'key' => 'field_5c59db77f0181',
          'label' => 'Text Color',
          'name' => 'text_color',
          'type' => 'color_picker',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '#000000',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'options_page',
            'operator' => '==',
            'value' => 'disclaimer-settings',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
    ));

endif;

