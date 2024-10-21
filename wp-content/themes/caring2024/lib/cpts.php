<?php

namespace Roots\Sage\CPTs;

use Roots\Sage\Setup;

add_action( 'init',  __NAMESPACE__ . '\\register_custom_post_types' );

function register_custom_post_types() {
  
  $taxonomy_args = [
    'label'        => 'Industries',
    'labels'       => [
      'name'          => 'Industries',
      'singular_name' => 'Industry',
      'all_items'     => 'All Industries',
      'edit_item'     => 'Edit Industry',
      'view_item'     => 'View Industry',
      'update_item'   => 'Update Industry',
      'add_new_item'  => 'Add New Industry',
      'new_item_name' => 'New Industry',
      'parent_item'   => 'Parent Industry',
      'search_items'  => 'Search Industries',
      'popular_items' => 'Most Used Industries',
      'not_found'     => 'No Industries found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'industries'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
    'show_in_rest'       => TRUE,
  ];

  $taxonomy_args2 = [
    'label'        => 'Titles',
    'labels'       => [
      'name'          => 'Titles',
      'singular_name' => 'Title',
      'all_items'     => 'All Titles',
      'edit_item'     => 'Edit Title',
      'view_item'     => 'View Title',
      'update_item'   => 'Update Title',
      'add_new_item'  => 'Add New Title',
      'new_item_name' => 'New Title',
      'parent_item'   => 'Parent Title',
      'search_items'  => 'Search Titles',
      'popular_items' => 'Most Used Titles',
      'not_found'     => 'No Titles found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'titles'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
  ];

  $taxonomy_args3 = [
    'label'        => 'Specialties',
    'labels'       => [
      'name'          => 'Specialties',
      'singular_name' => 'Specialty',
      'all_items'     => 'All Specialties',
      'edit_item'     => 'Edit Specialty',
      'view_item'     => 'View Specialty',
      'update_item'   => 'Update Specialty',
      'add_new_item'  => 'Add New Specialty',
      'new_item_name' => 'New Specialty',
      'parent_item'   => 'Parent Specialty',
      'search_items'  => 'Search Specialties',
      'popular_items' => 'Most Used Specialties',
      'not_found'     => 'No Specialties found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'specialties'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
  ];

  $taxonomy_args4 = [
    'label'        => 'Businesses',
    'labels'       => [
      'name'          => 'Businesses',
      'singular_name' => 'Business',
      'all_items'     => 'All Businesses',
      'edit_item'     => 'Edit Business',
      'view_item'     => 'View Business',
      'update_item'   => 'Update Business',
      'add_new_item'  => 'Add New Business',
      'new_item_name' => 'New Business',
      'parent_item'   => 'Parent Business',
      'search_items'  => 'Search Businesses',
      'popular_items' => 'Most Used Businesses',
      'not_found'     => 'No Businesses found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'businesses'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
  ];

  $taxonomy_args5 = [
    'label'        => 'Roles',
    'labels'       => [
      'name'          => 'Roles',
      'singular_name' => 'Role',
      'all_items'     => 'All Roles',
      'edit_item'     => 'Edit Role',
      'view_item'     => 'View Role',
      'update_item'   => 'Update Role',
      'add_new_item'  => 'Add New Role',
      'new_item_name' => 'New Role',
      'parent_item'   => 'Parent Role',
      'search_items'  => 'Search Roles',
      'popular_items' => 'Most Used Roles',
      'not_found'     => 'No Roles found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'roles'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
  ];

  $taxonomy_args6 = [
    'label'        => 'Networks',
    'labels'       => [
      'name'          => 'Networks',
      'singular_name' => 'Network',
      'all_items'     => 'All Networks',
      'edit_item'     => 'Edit Network',
      'view_item'     => 'View Network',
      'update_item'   => 'Update Network',
      'add_new_item'  => 'Add New Network',
      'new_item_name' => 'New Network',
      'parent_item'   => 'Parent Network',
      'search_items'  => 'Search Networks',
      'popular_items' => 'Most Used Networks',
      'not_found'     => 'No Networks found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'networks'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
  ];

  $taxonomy_args7 = [
    'label'        => 'Positions',
    'labels'       => [
      'name'          => 'Positions',
      'singular_name' => 'Position',
      'all_items'     => 'All Positions',
      'edit_item'     => 'Edit Position',
      'view_item'     => 'View Position',
      'update_item'   => 'Update Position',
      'add_new_item'  => 'Add New Position',
      'new_item_name' => 'New Position',
      'parent_item'   => 'Parent Position',
      'search_items'  => 'Search Positions',
      'popular_items' => 'Most Used Positions',
      'not_found'     => 'No Positions found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'positions'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
  ];

  $taxonomy_args8 = [
    'label'        => 'Locations',
    'labels'       => [
      'name'          => 'Locations',
      'singular_name' => 'Location',
      'all_items'     => 'All Locations',
      'edit_item'     => 'Edit Location',
      'view_item'     => 'View Location',
      'update_item'   => 'Update Location',
      'add_new_item'  => 'Add New Location',
      'new_item_name' => 'New Location',
      'parent_item'   => 'Parent Location',
      'search_items'  => 'Search Locations',
      'popular_items' => 'Most Used Locations',
      'not_found'     => 'No Locations found',
    ],
    'hierarchical'       => TRUE,
    'rewrite'            => ['slug' => 'locations'],
    'public'             => TRUE,
    'show_ui'            => TRUE,
    'show_in_nav_menus'  => TRUE,
    'show_tagcloud'      => FALSE,
    'show_in_quick_edit' => TRUE,
    'show_admin_column'  => TRUE,
  ];

  $cpt_args = [
    'label'  => 'Nominees',
    'labels' => [
      'name'          => 'Nominees',
      'singular_name' => 'Nominees',
      'menu_name'     => 'Nominees',
      'add_new_item'  => 'Add New Nominees',
      'edit_item'     => 'Edit Nominees',
      'view_item'     => 'View Nominees',
      'search_items'  => 'Search Nominees',
      'not_found'     => 'No Nominees Found',
    ],
    'description'         => 'nominees is managed within WordPress.',
    'public'              => TRUE,
    'exclude_from_search' => FALSE,
    'publicly_queryable'  => TRUE,
    'show_ui'             => TRUE,
    'show_in_nav_menus'   => TRUE,
    'show_in_menu'        => TRUE,
    'show_in_admin_bar'   => FALSE,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-businessman',
    'hierarchical'        => TRUE,
    'taxonomies'          => [],
    'has_archive'         => false,
    'rewrite'             => [ 'slug' => 'nominees' ],
    'can_export'          => TRUE,
    'supports'            => [ 'title','editor','revisions' ]
  ];

  //register_taxonomy( 'nominees_industries', 'nominees', $taxonomy_args );
  // register_taxonomy( 'nominees_titles', 'nominees', $taxonomy_args2 );
  // register_taxonomy( 'nominees_specialty', 'nominees', $taxonomy_args3 );
  // //register_taxonomy( 'nominees_businesses', 'nominees', $taxonomy_args4 );
  // register_taxonomy( 'nominees_roles', 'nominees', $taxonomy_args5 );
  // register_taxonomy( 'nominees_networks', 'nominees', $taxonomy_args6 );
  // register_taxonomy( 'nominees_positions', 'nominees', $taxonomy_args7 );
  // register_taxonomy( 'nominees_locations', 'nominees', $taxonomy_args8 );
  register_post_type( 'nominees', $cpt_args );

  $cpt_args = [
    'label'  => 'Podcasts',
    'labels' => [
      'name'          => 'Podcasts',
      'singular_name' => 'Podcasts',
      'menu_name'     => 'Podcasts',
      'add_new_item'  => 'Add New Podcasts',
      'edit_item'     => 'Edit Podcasts',
      'view_item'     => 'View Podcasts',
      'search_items'  => 'Search Podcasts',
      'not_found'     => 'No Podcasts Found',
    ],
    'description'         => 'Podcasts is managed within WordPress.',
    'public'              => TRUE,
    'exclude_from_search' => FALSE,
    'publicly_queryable'  => TRUE,
    'show_ui'             => TRUE,
    'show_in_nav_menus'   => TRUE,
    'show_in_menu'        => TRUE,
    'show_in_rest'        => TRUE,
    'show_in_admin_bar'   => FALSE,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-megaphone',
    'hierarchical'        => TRUE,
    'taxonomies'          => [],
    'has_archive'         => FALSE,
    'rewrite'             => [ 'slug' => 'podcast' ],
    'can_export'          => TRUE,
    'supports'            => [ 'title','editor','excerpt','thumbnail','revisions' ]
  ];

  register_post_type( 'podcasts', $cpt_args );

}
