<?php

/**
 * buttons-block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'buttons-block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'buttons-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$link_ia = get_field('link_ia');
$link_ib = get_field('link_ib');

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

  <div class="buttons-block--inner">

    <div class="buttons-button">
      <a href="<?= $link_ia['url']; ?>"><span class="buttons-button--prefix">IA</span> <span class="buttons-button--text">Capital<br>Corporation I—A</span></a>
    </div>

    <div class="buttons-button">
      <a href="<?= $link_ib['url']; ?>"><span class="buttons-button--prefix">IB</span> <span class="buttons-button--text">Capital<br>Corporation I—B</span></a>
    </div>

  </div>

</div>
