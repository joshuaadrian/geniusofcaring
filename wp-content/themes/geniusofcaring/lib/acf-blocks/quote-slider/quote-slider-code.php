<?php
if ( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6446a9da76c36',
	'title' => 'Quote Slider',
	'fields' => array(
		array(
			'key' => 'field_6446aacef8b1b',
			'label' => 'Slides',
			'name' => 'slides',
			'aria-label' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'pagination' => 0,
			'min' => 0,
			'max' => 0,
			'collapsed' => '',
			'button_label' => 'Add Row',
			'rows_per_page' => 20,
			'sub_fields' => array(
				array(
					'key' => 'field_6446aad7f8b1c',
					'label' => 'Quote',
					'name' => 'quote',
					'aria-label' => '',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'rows' => '',
					'placeholder' => '',
					'new_lines' => '',
					'parent_repeater' => 'field_6446aacef8b1b',
				),
				array(
					'key' => 'field_6446aaddf8b1d',
					'label' => 'Citee Name',
					'name' => 'citee_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_6446aacef8b1b',
				),
				array(
					'key' => 'field_6446aaddf8b1z',
					'label' => 'Citee Title',
					'name' => 'citee_title',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'parent_repeater' => 'field_6446aacef8b1b',
				),
				array(
					'key' => 'field_6446aae1f8b1e',
					'label' => 'Citee Image',
					'name' => 'citee_image',
					'aria-label' => '',
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
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
					'preview_size' => 'medium',
					'parent_repeater' => 'field_6446aacef8b1b',
				),
			),
		),
		array(
			'key' => 'field_6446aacef8b1z',
			'label' => 'Style',
			'name' => 'style',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'has-no-style' => 'No Style',
				'has-gray-waves-style' => 'Gray Waves Background',
				'has-white-waves-style' => 'White Waves Background'
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'default_value' => 'has-no-style',
			'layout' => 'vertical',
			'return_format' => 'value',
			'save_other_choice' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/quote-slider',
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
	'show_in_rest' => 0,
));

endif;

