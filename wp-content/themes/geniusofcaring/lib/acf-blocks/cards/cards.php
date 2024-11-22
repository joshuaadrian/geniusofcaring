<?php

/**
 * cards Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'cards-block-' . $block['id'];

if( !empty($block['anchor']) ) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'cards-block';

if( !empty($block['className']) ) {
  $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
  $className .= ' align' . $block['align'];
}

$title   = get_field('title');
$content = get_field('content');
$counter = 1;
$cards   = '';

if ( have_rows('cards') ) :

  while ( have_rows('cards') ) : the_row();

    $image = get_sub_field('image');
    $icon = get_sub_field('icon');
    $title = get_sub_field('title');
    $copy  = get_sub_field('copy');
    $link  = get_sub_field('link');

    if ( !empty($link) ) :

      $a_href       = $link['url'];
      $a_title      = $link['title'];
      $a_target     = !empty( $link['target'] ) ? $link['target'] : '_self';
      $attributes   = [];
      $attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
      $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
      $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
      $attributes   = implode( ' ', $attributes );
      $link         = '<p class="card--link"><a ' . $attributes . '>'.$a_title.'</a></p>';

    endif;

    $cards .= '<div class="card inview fadeinup">';

      $cards .= '<div class="card--inner">';

        $cards .= $image ? '<div class="card--image"><div class="card--image--inner" style="background-image:url('.$image['sizes']['large'].')"></div></div>' : '';

        $cards .= $icon ? '<img class="card--icon" src="'.$icon['sizes']['large'].'" alt="'.$title.'" />' : '';

        $cards .= $link;

        $cards .= '<div class="card--content">';

          $cards .= '<h4>';
            //$cards .= '<small>0'.$counter.'</small>';
            $cards .= '<span>'.$title.'</span>';
          $cards .= '</h4>';

          $cards .= wpautop($copy);

          

        $cards .= '</div>';

      $cards .= '</div>';

    $cards .= '</div>';

    $counter = $counter + 1;

  endwhile;

endif;

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="cards--grid">
    <?= $cards; ?>
  </div>

</div>
