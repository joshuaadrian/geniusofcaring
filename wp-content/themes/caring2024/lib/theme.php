<?php

// Programmatically define SearchWP license key.
add_filter( 'searchwp\license\key', function( $key ) {
  return '0748408f72415c5a884019d2a27da214';
} );

if( function_exists('acf_add_options_page') ) :

  // acf_add_options_page(array(
  //   'page_title'  => 'Theme Panel',
  //   'menu_title'  => 'Theme',
  //   'menu_slug'   => 'theme-settings',
  //   'capability'  => 'edit_posts',
  //   'redirect'    => false
  // ));

  // acf_add_options_page([
  //   'page_title'  => 'Cookie Panel',
  //   'menu_title'  => 'Cookie Notice',
  //   'menu_slug'   => 'cookie-notice-options',
  //   'capability'  => 'manage_options',
  //   'redirect'    => false
  // ]);

  // acf_add_options_page(array(
  //   'page_title'  => 'Disclaimer Panel',
  //   'menu_title'  => 'Disclaimer',
  //   'menu_slug'   => 'disclaimer-settings',
  //   'capability'  => 'edit_posts',
  //   'redirect'    => false
  // ));
  
endif;

if ( function_exists('acf_add_local_field_group') ) :

  acf_add_local_field_group(array(
    'key' => 'group_5cc88ad4ccf6c',
    'title' => 'Theme',
    'fields' => array(
      array(
        'key' => 'field_5cc88b544fbc1',
        'label' => 'Global',
        'name' => 'global',
        'type' => 'group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layout' => 'block',
        'sub_fields' => array(
          array(
            'key' => 'field_5cc88b634fbc2',
            'label' => 'Primary Color',
            'name' => 'primary_color',
            'type' => 'color_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#054ae7',
          ),
          array(
            'key' => 'field_5cc88b6d4fbc3',
            'label' => 'Secondary Color',
            'name' => 'secondary_color',
            'type' => 'color_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#375087',
          ),
          array(
            'key' => 'field_5cc88b734fbc2',
            'label' => 'Base Font Color',
            'name' => 'base_font_color',
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
            'key' => 'field_5cc98babcb0e2',
            'label' => 'Base Font Size',
            'name' => 'base_font_size',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => 18,
            'placeholder' => '',
            'prepend' => '',
            'append' => 'px',
            'min' => 10,
            'max' => 24,
            'step' => 1,
          ),
        ),
      ),
      array(
        'key' => 'field_5cc88ae684c29',
        'label' => 'Header',
        'name' => 'header',
        'type' => 'group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layout' => 'block',
        'sub_fields' => array(
          array(
            'key' => 'field_5cc88b1284c2a',
            'label' => 'Logo',
            'name' => 'logo',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_5cc88b1a84c2b',
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
            'default_value' => '#ffffff',
          ),
          array(
            'key' => 'field_5cc88b2d84c2c',
            'label' => 'Link Colors',
            'name' => 'link_colors',
            'type' => 'color_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#054ae7',
          ),
          array(
            'key' => 'field_5cc88b3b84c2d',
            'label' => 'Link Hover Color',
            'name' => 'link_hover_color',
            'type' => 'color_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#375087',
          ),
          array(
            'key' => 'field_5c59d88e6d7b5',
            'label' => 'Navigation Type',
            'name' => 'navigation_type',
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
              'links'       => 'Links',
              'slideInLeft' => 'Slide In Left',
              'overlay'     => 'Overlay'
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
        ),
      ),
      array(
        'key' => 'field_5cc88b83cb0de',
        'label' => 'Footer',
        'name' => 'footer',
        'type' => 'group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'layout' => 'block',
        'sub_fields' => array(
          array(
            'key' => 'field_5cc88b8bcb0df',
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
            'default_value' => '#333333',
          ),
          array(
            'key' => 'field_5cc88b94cb0e0',
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
            'default_value' => '#cccccc',
          ),
          array(
            'key' => 'field_5cc88b9dcb0e1',
            'label' => 'Link Color',
            'name' => 'link_color',
            'type' => 'color_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '#dddddd',
          ),
          array(
            'key' => 'field_5cc88babcb0e2',
            'label' => 'Font Size',
            'name' => 'font_size',
            'type' => 'number',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => 14,
            'placeholder' => '',
            'prepend' => '',
            'append' => 'px',
            'min' => 10,
            'max' => 24,
            'step' => 1,
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'theme-settings',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
  ));

  acf_add_local_field_group(array (
    'key'    => 'group_5bc8a05d9c00e',
    'title'  => 'Cookie Notice Settings',
    'fields' => array (
      array (
        'key'               => 'field_5bc8a0de8e767',
        'label'             => 'Position',
        'name'              => 'position',
        'type'              => 'select',
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => array (
          'width' => '',
          'class' => '',
          'id'    => '',
        ),
        'choices' => array (
          'false'        => 'None',
          'above-nav'    => 'Above Nav',
          'fixed-top'    => 'Fixed Top',
          'above-footer' => 'Above Footer',
          'fixed-bottom' => 'Fixed Bottom',
        ),
        'default_value' => array (
          0 => 'false',
        ),
        'allow_null'  => 0,
        'multiple'    => 0,
        'ui'          => 0,
        'ajax'        => 0,
        'placeholder' => '',
        'disabled'    => 0,
        'readonly'    => 0,
      ),
      array (
        'key'               => 'field_5bc8a2058e768',
        'label'             => 'Copy',
        'name'              => 'copy',
        'type'              => 'wysiwyg',
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => array (
          'width' => '',
          'class' => '',
          'id'    => '',
        ),
        'default_value' => '',
        'tabs'          => 'all',
        'toolbar'       => 'basic',
        'media_upload'  => 0,
      ),
      array (
        'key'               => 'field_5bc8a29b8e76c',
        'label'             => 'Copy Color',
        'name'              => 'copy_color',
        'type'              => 'color_picker',
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => array (
          'width' => '',
          'class' => '',
          'id'    => '',
        ),
        'default_value' => '',
      ),
      array (
        'key' => 'field_5bc8a2278e769',
        'label' => 'Button Text',
        'name' => 'button_text',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
      ),
      array (
        'key' => 'field_5bc8a22f8e76a',
        'label' => 'Button Color',
        'name' => 'button_color',
        'type' => 'color_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
      ),
      array (
        'key' => 'field_5bc8e471e23fc',
        'label' => 'Button Text Color',
        'name' => 'button_text_color',
        'type' => 'color_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
      ),
      array (
        'key' => 'field_5bc8a2568e76b',
        'label' => 'Background Color',
        'name' => 'background_color',
        'type' => 'color_picker',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
      ),
      array (
        'key' => 'field_5bc8a2e4c350b',
        'label' => 'Euro IPs Only?',
        'name' => 'euro_ips_only',
        'type' => 'checkbox',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'choices' => array (
          'yes' => 'Yes',
        ),
        'default_value' => array (
        ),
        'layout' => 'vertical',
        'toggle' => 0,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'cookie-notice-options',
        ),
      ),
    ),
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => 1,
    'description'           => '',
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

function resizeLogo($origHeight,$origWidth,$maxHeight = 80,$maxWidth = 460) {

	$widthRatio = $maxWidth / $origWidth;
	$heightRatio = $maxHeight / $origHeight;

	// Ratio used for calculating new image dimensions.
	$ratio = min($widthRatio, $heightRatio);

	// Calculate new image dimensions.
	$newWidth  = (int)$origWidth  * $ratio;
	$newHeight = (int)$origHeight * $ratio;

	return 'height:'.$newHeight.'px !important;width:'.$newWidth.'px !important;';

}

function theme_css() {

	// Global
	if( have_rows('global','option') ) :
		while( have_rows('global','option') ) : the_row();
			$primary_color   = get_sub_field('primary_color');
			$secondary_color = get_sub_field('secondary_color');
			$base_font_color = get_sub_field('base_font_color');
			$base_font_size  = get_sub_field('base_font_size');
		endwhile;
	endif;

	//Header
	if( have_rows('header','option') ) :
		while( have_rows('header','option') ) : the_row();
			$logo             = get_sub_field('logo');
			$header_background_color = get_sub_field('background_color');
			$link_color       = get_sub_field('link_color');
			$link_hover_color = get_sub_field('link_hover_color');
		endwhile;
	endif;

	//Footer
	if( have_rows('footer','option') ) :
		while( have_rows('footer','option') ) : the_row();
			$footer_background_color = get_sub_field('background_color');
			$footer_text_color       = get_sub_field('text_color');
			$footer_link_color       = get_sub_field('link_color');
			$footer_font_size        = get_sub_field('font_size');
		endwhile;
	endif;

	$css = '<style>';

    	$css .= 'body {';
    		$css .= $base_font_size ? 'font-size:'.$base_font_size.' !important;' : '';
    		$css .= $base_font_color ? 'color:'.$base_font_color.' !important;' : '';
    	$css .= '}';

    	$css .= '.navbar-brand {';
			$css .= $logo ? resizeLogo( $logo['height'],$logo['width'] ) : '';
			$css .= $logo ? 'background-image:url('.$logo['url'].') !important;' : '';
    	$css .= '}';

    	$css .= '@media (min-width: 768px){.banner.scrolled .navbar-brand {';
    		$css .= $logo ? resizeLogo( $logo['height'],$logo['width'],'60' ) : '';
    	$css .= '}}';

    	/* Global Styles */
    	$css .= '.btn {';
			$css .= $primary_color ? 'background-color:'.$primary_color.' !important;' : '';
    	$css .= '}';

    	$css .= '.btn:hover,.btn:focus,.btn:active {';
    		$css .= $secondary_color ? 'background-color:'.$secondary_color.' !important;' : '';
    	$css .= '}';

		/* Header Styles */
		$css .= '.banner {';
			$css .= $header_background_color ? 'background-color:'.$header_background_color.' !important;' : '';
		$css .= '}';

		/* Footer Styles */
        $css .= '.footer {';
            $css .= $footer_background_color ? 'background-color:'.$footer_background_color. ' !important;' : '';
            $css .= $footer_font_size ? 'font-size:'.$footer_font_size.' !important;' : '';
    		$css .= $footer_text_color ? 'color:'.$footer_text_color.' !important;' : '';
        $css .= '}';

        $css .= '.footer a {';
        	$css .= $footer_link_color ? 'color:'.$footer_link_color.' !important;' : '';
        $css .= '}';

    $css .= '</style>';

    echo $css;

}

if ( function_exists('get_field') ) :

	//add_action('wp_head', 'theme_css');

endif;
