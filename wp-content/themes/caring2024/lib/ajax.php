<?php

function get_media_form() {

	if ( ! wp_verify_nonce( $_POST['nonce'], 'crm-ajax-nonce' ) ) :
		echo json_encode(['Busted'], JSON_FORCE_OBJECT, 9999);
		wp_die();
	endif;

	$result   = ['media' => ''];
	$offset   = ( $_POST['paged'] - 1 ) * 10;
	$year     = $_POST['year'];
	$category = $_POST['cat'];
	$count = 0;

	error_log(var_export($_POST,true));

	$date_query = [];
	
	$posts_query_args = [
		'posts_per_page' => 20,
		'offset'         => $offset,
		'orderby'        => 'post_date',
		'order'          => 'DESC',
	];

	if ( !empty($year) ) :

		$date_query = [
	  	'year' => intval( str_replace('/', '', parse_url($year, PHP_URL_PATH) ) ),
	  ];

	  $posts_query_args['date_query'] = [ $date_query ];

	endif;

	if ( !empty($category) ) :

	  $post_taxonomy_args[] = [
	    'taxonomy' => 'category',
	    'terms'    => [$category],
	    'field'    => 'slug'
	  ];

	  $posts_query_args['tax_query'] = $post_taxonomy_args;

	endif;

	error_log(var_export($posts_query_args,true));

	$posts_query = new WP_Query( $posts_query_args );

	if ( $posts_query->have_posts() ) :

		while ( $posts_query->have_posts() ) :

  		$posts_query->the_post();

			$id            = get_the_id();
      $title         = get_the_title();
      $item_classes  = '';
      $item_tags     = $posts_query->post_name;
      $item_id       = 'post--item-' . $id;

      $link          = get_permalink($id);
      $link_target   = "_self";

      $pdf = get_field('pdf',$id);
      $external_url = get_field('external_url',$id);

      if ( !empty( $pdf ) ) :
        $link = $pdf['url'];
        $link_target   = "_blank";
      endif;

      if ( !empty( $external_url ) ) :
        $link = $external_url;
        $link_target   = "_blank";
      endif;

      $categories_arr = [];
		  $categories = get_terms([
		    'taxonomy'   => 'category',
		    'hide_empty' => true,
		  ]);

		  if ( !is_wp_error($categories) ) : foreach ($categories as $category) :
		    $item_classes .= ' ' . $category->slug;
		    $categories_arr[] = $category->name;
		  endforeach; endif;

      $result['media'] .= '<div id="'. $item_id.'" class="media--article '. $item_classes.'" data-searchtags="'. $item_tags.'">';

        $result['media'] .= '<div class="media--article--meta"><p>';
          $result['media'] .= '<span>'. get_the_date('F j, Y') . '</span>';
          // if ( !empty($categories_arr) ) :
          // 	$result['media'] .= '<li>' . implode(', ',$categories_arr) . '</li>';
         	// endif;
        $result['media'] .= '</p></div>';

        $result['media'] .= '<div class="media--article--content">';

        $result['media'] .= '<p class="media--article--title">';
        	$result['media'] .= '<a href="'.$link.'" target="'.$link_target.'">';
          	$result['media'] .= $title;
          $result['media'] .= '</a>';
        $result['media'] .= '</p>';

        $result['media'] .= '</div>';

      $result['media'] .= '</div>';

			$count = $count + 1;

		endwhile;

	endif;

	$result['displaying'] = intval( $count );
	$result['max_count']  = intval( $posts_query->found_posts );
	$result['max_pages']  = intval( $posts_query->max_num_pages );
	$result['cur_page']   = intval( $_POST['paged'] );

	$page_links        = '<span>'.$result['cur_page'].'</span>';
	$page_link_counter = 1;
	$i                 = $result['cur_page'] + 1;

	while ( $i < $result['max_pages'] ):
		
		if ( ( $page_link_counter + 5 ) >= $result['max_pages'] || $page_link_counter > 5 ) break;

		$page_links .= '<a href="#" data-offset="'.$i.'">'.$i.'</a>';
		$i++;
		$page_link_counter++;

	endwhile;

	$result['page_links'] = $page_links;

	//error_log(var_export(json_encode($result, JSON_FORCE_OBJECT, 9999),true));
  //echo json_encode($result, JSON_FORCE_OBJECT, 9999);
	echo json_encode($result);
  wp_die();

}

add_action( 'wp_ajax_nopriv_get_media_form', 'get_media_form' );
add_action( 'wp_ajax_get_media_form', 'get_media_form' );