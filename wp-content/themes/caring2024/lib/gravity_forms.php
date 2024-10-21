<?php

// Make sure no default Gravity Forms Styles are loaded
function dequeue_gf_stylesheets() {
  wp_dequeue_style( 'gforms_reset_css' );
  wp_dequeue_style( 'gforms_datepicker_css' );
  wp_dequeue_style( 'gforms_formsmain_css' );
  wp_dequeue_style( 'gforms_ready_class_css' );
  wp_dequeue_style( 'gforms_browsers_css' );
}
add_action( 'gform_enqueue_scripts_1', 'dequeue_gf_stylesheets', 11 );

// Make sure Gravity Forms scripts are loaded in the footer
add_filter("gform_init_scripts_footer", "__return_true");

// Change Gravity Forms submit from input to button for styling purposes
function form_submit_button( $button, $form ) {
  $array = array();
  preg_match( '/value=\'([^\']*)\'/i', $button, $array ) ;

  return "<button class='button gform_button' id='gform_submit_button_{$form['id']}'><span>{$array[1]}</span><svg viewBox='0 0 37.52 65.15'><polygon points='4.95 65.15 0 60.2 27.62 32.57 0 4.95 4.95 0 37.52 32.57 4.95 65.15'/></svg></button>";
}
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
