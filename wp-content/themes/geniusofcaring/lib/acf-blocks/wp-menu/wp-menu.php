<?php

/**
 * wp-menu Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'wp-menu-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-menu';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$menu      = get_field('menu') ?: '';
$depth     = get_field('depth') ?: 1;
$alignment = get_field('alignment') ?: 'is-flex-start';
$layout    = get_field('layout') ?: 'is-horizontal';

if ( !$menu ) return;

$menu = wp_nav_menu([
	'menu'            => $menu,
	'depth'           => $depth,
	'echo'            => false,
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	// 'link_before'     => '<span>',
	// 'link_after'      => '</span>',
	'menu_class'      => 'wp-menu--nav ' . $alignment . ' ' . $layout,
	'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
	'walker'          => new wp_bootstrap_navwalker()
]);

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<?= $menu; ?>

</div>
