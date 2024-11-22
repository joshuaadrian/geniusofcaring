<?php

// https://neliosoftware.com/blog/sort-posts-within-wordpress-taxonomy/
// https://github.com/davilera/taxonomy-sorter-example

// ===================
//  SORTING FRONTEND
// ===================

function crx_sort_team_in_topic( $orderby, $query ) {
  if ( crx_is_team_tax_query( $query ) ) :
    global $wpdb;
    $orderby = "{$wpdb->term_relationships}.term_order ASC";
  elseif (  crx_is_leadership_tax_query( $query ) ) :
    global $wpdb;
    $orderby = "{$wpdb->term_relationships}.term_order ASC";
  endif;
  return $orderby;
}
add_filter( 'posts_orderby', 'crx_sort_team_in_topic', 99, 2 );

function order_team_by_term( $orderby ) {
  global $wpdb;
  return "{$wpdb->term_relationships}.term_order ASC";
}

function crx_is_team_tax_query( $query ) {
  if ( $query->get("post_type") !== "team" ) return;
  if ( empty( $query->tax_query ) ) return;
  if ( empty( $query->tax_query->queries ) ) return;
  return in_array(
    $query->tax_query->queries[0]['taxonomy'],
    [ 'team_roles' ],
    true
  );
}

function crx_is_leadership_tax_query( $query ) {
  if ( $query->get("post_type") !== "leadership" ) return;
  if ( empty( $query->tax_query ) ) return;
  if ( empty( $query->tax_query->queries ) ) return;
  return in_array(
    $query->tax_query->queries[0]['taxonomy'],
    [ 'leadership_roles' ],
    true
  );
}

// ===================
//  SORTING ADMIN UI
// ===================

function crx_add_sorting_page() {

  add_submenu_page(
    'edit.php?post_type=team',
    'Sort',
    'Sort',
    'edit_others_posts',
    'crx-help-team-sorter',
    'crx_render_team_sorter'
  );

  add_submenu_page(
    'edit.php?post_type=leadership',
    'Sort',
    'Sort',
    'edit_others_posts',
    'crx-help-leadership-sorter',
    'crx_render_leadership_sorter'
  );

}
add_action( 'admin_menu', 'crx_add_sorting_page' );

function crx_render_leadership_sorter() {

  printf(
    '<div class="wrap"><h1>%s</h1>',
    __( 'Sort team', 'crx' )
  );

  $terms = get_terms( 'leadership_roles' );
  crx_render_select( $terms );
  foreach ( $terms as $term ) {
    crx_render_leadership_in_term( 'leadership', 'leadership_roles', $term );
  }

  crx_render_leadership_script();

  echo '</div>';

}

function crx_render_team_sorter() {

  printf(
    '<div class="wrap"><h1>%s</h1>',
    __( 'Sort team', 'crx' )
  );

  $terms = get_terms( 'team_roles' );
  crx_render_select( $terms );
  foreach ( $terms as $term ) {
    crx_render_team_in_term( 'team', 'team_roles', $term );
  }

  crx_render_script();

  echo '</div>';
}

function crx_render_select( $terms ) {
  echo '<select id="topic">';

  foreach ( $terms as $term ) {

    if ( $_GET['post_type'] == 'team' ) :
      if ( $term->slug == 'investment-banking' || $term->slug == 'corporate-leadership' ) : continue; endif;
    endif;

    printf(
      '<option value="%s">%s</option>',
      esc_attr( $term->slug ),
      esc_html( $term->name )
    );
  }
  echo '</select>';
}

function crx_render_leadership_in_term( $type, $taxonomy, $term ) {
  $style = 'max-width: 50em; padding: 1em; background: white; margin: 1em 0; display: none;';
  printf(
    '<div id="%s" class="leadership-set" style="%s">',
    esc_attr( "{$term->slug}-leadership" ),
    esc_attr( $style )
);

  $query = new WP_Query(
    array(
      'post_type'      => $type,
      'posts_per_page' => -1,
      'tax_query'      => array(
        array(
          'taxonomy' => $taxonomy,
          'field'    => 'term_id',
          'terms'    => $term->term_id,
          'orderby'  => 'term_order',
        ),
      ),
    )
  );

  printf(
    '<div class="sorted-leadership-in-%d sortable">',
    $term->term_id
  );
  $style = 'background: #fafafc; border-left: 0.5em solid #0073aa; padding: 0.5em; margin-bottom: 0.5em; cursor: pointer; user-select: none;';
  while ( $query->have_posts() ) {
    $query->the_post();
    global $post;
    printf(
      '<div class="leadership" style="%s" data-leadership-id="%d">%s</div>',
      esc_attr( $style ),
      $post->ID,
      esc_html( $post->post_title )
    );
  }//end foreach
  echo '</div>';

  echo '<div style="text-align: right; padding-top: 1em;">';
  printf(
    '<input class="button save-leadership-order" type="button" data-term-id="%d" data-term-name="%s" value="%s" />',
    $term->term_id,
    esc_attr( $term->name ),
    esc_attr( "Save {$term->name}" )
  );
  echo '</div>';

  echo '</div>';
}

function crx_render_team_in_term( $type, $taxonomy, $term ) {
  $style = 'max-width: 50em; padding: 1em; background: white; margin: 1em 0; display: none;';
  printf(
    '<div id="%s" class="team-set" style="%s">',
    esc_attr( "{$term->slug}-team" ),
    esc_attr( $style )
);

  $query = new WP_Query(
    array(
      'post_type'      => $type,
      'posts_per_page' => -1,
      'tax_query'      => array(
        array(
          'taxonomy' => $taxonomy,
          'field'    => 'term_id',
          'terms'    => $term->term_id,
          'orderby'  => 'term_order',
        ),
      ),
    )
  );

  printf(
    '<div class="sorted-team-in-%d sortable">',
    $term->term_id
  );
  $style = 'background: #fafafc; border-left: 0.5em solid #0073aa; padding: 0.5em; margin-bottom: 0.5em; cursor: pointer; user-select: none;';
  while ( $query->have_posts() ) {
    $query->the_post();
    global $post;
    printf(
      '<div class="team" style="%s" data-team-id="%d">%s</div>',
      esc_attr( $style ),
      $post->ID,
      esc_html( $post->post_title )
    );
  }//end foreach
  echo '</div>';

  echo '<div style="text-align: right; padding-top: 1em;">';
  printf(
    '<input class="button save-team-order" type="button" data-term-id="%d" data-term-name="%s" value="%s" />',
    $term->term_id,
    esc_attr( $term->name ),
    esc_attr( "Save {$term->name}" )
  );
  echo '</div>';

  echo '</div>';
}

function crx_render_leadership_script() { ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
( function() {

  const select = document.getElementById( 'topic' );
  const leadershipSets = [ ...document.querySelectorAll( '.leadership-set' ) ];
  select.addEventListener( 'change', () => {
    leadershipSets.forEach( ( set ) => set.style.display = 'none' );
    document.getElementById( `${ select.value }-leadership` ).style.display = 'block';
  } );

  document.querySelector( '.leadership-set' ).style.display = 'block';

  $( '.sortable' ).sortable();

  [ ...document.querySelectorAll( '.button.save-leadership-order' ) ].forEach( ( button ) => {
    button.addEventListener( 'click', () => {
      const termId = button.getAttribute( 'data-term-id' );
      const termName = button.getAttribute( 'data-term-name' );

      button.value = <?php echo wp_json_encode( "Saving %s..." ); ?>.replace( '%s', termName );
      button.disabled = true;

      const sortedleadershipIds = [ ...document.querySelectorAll( `.sorted-leadership-in-${ termId } .leadership` ) ].map( ( el ) => el.getAttribute( 'data-leadership-id' ) );
      $.ajax( {
        url: ajaxurl,
        method: 'POST',
        data: {
          action: 'crx_save_tax_sorting',
          ids: sortedleadershipIds,
          termId,
        },
      } ).always( () => {
        button.value = <?php echo wp_json_encode( "Save %s" ); ?>.replace( '%s', termName );
        button.disabled = false;
      } );
    } );
  } );
} )();
</script>
<?php
}

function crx_render_script() { ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
( function() {

  const select = document.getElementById( 'topic' );
  const teamSets = [ ...document.querySelectorAll( '.team-set' ) ];
  select.addEventListener( 'change', () => {
    teamSets.forEach( ( set ) => set.style.display = 'none' );
    document.getElementById( `${ select.value }-team` ).style.display = 'block';
  } );

  document.querySelector( '.team-set' ).style.display = 'block';

  $( '.sortable' ).sortable();

  [ ...document.querySelectorAll( '.button.save-team-order' ) ].forEach( ( button ) => {
    button.addEventListener( 'click', () => {
      const termId = button.getAttribute( 'data-term-id' );
      const termName = button.getAttribute( 'data-term-name' );

      button.value = <?php echo wp_json_encode( "Saving %s..." ); ?>.replace( '%s', termName );
      button.disabled = true;

      const sortedteamIds = [ ...document.querySelectorAll( `.sorted-team-in-${ termId } .team` ) ].map( ( el ) => el.getAttribute( 'data-team-id' ) );
      $.ajax( {
        url: ajaxurl,
        method: 'POST',
        data: {
          action: 'crx_save_tax_sorting',
          ids: sortedteamIds,
          termId,
        },
      } ).always( () => {
        button.value = <?php echo wp_json_encode( "Save %s" ); ?>.replace( '%s', termName );
        button.disabled = false;
      } );
    } );
  } );
} )();
</script>
<?php
}

function crx_save_tax_sorting() {
  $team_ids = isset( $_POST['ids'] ) ? $_POST['ids'] : [];
  if ( ! is_array( $team_ids ) ) {
    echo -1;
    wp_die();
  }//end if
  $team_ids = array_values( array_map( 'absint', $team_ids ) );

  $term_id = absint( $_POST['termId'] );
  if ( ! $term_id ) {
    echo -2;
    wp_die();
  }//end if

  global $wpdb;
  foreach ( $team_ids as $order => $team ) {
    ++$order;
    // update doesn't work if posts are not in category
    // $wpdb->update(
    //   $wpdb->term_relationships,
    //   array( 'term_order' => $order ),
    //   array(
    //     'object_id'        => $team,
    //     'term_taxonomy_id' => $term_id,
    //   )
    // );

    $wpdb->replace(
      $wpdb->term_relationships,
      array(
        'object_id'        => $team,
        'term_taxonomy_id' => $term_id,
        'term_order' => $order
      )
    );

  } //end foreach
  echo 0;
  wp_die();
}
add_action( 'wp_ajax_crx_save_tax_sorting', 'crx_save_tax_sorting' );
