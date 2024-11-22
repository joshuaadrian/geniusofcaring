<header class="banner">

  <div class="navbar navbar-expand-xl">

    <a aria-label="<?= get_bloginfo('name'); ?>" class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
      <img src="<?= get_stylesheet_directory_uri(); ?>/dist/images/logo.png" alt="<?= get_bloginfo('name'); ?>">
    </a>

    <?php if (has_nav_menu('primary_navigation')) : ?>

    <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation">

      <svg role="img" width="100" height="100" viewBox="0 0 100 100">
        <title>Toggle navigation</title>
        <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
        <path class="line line2" d="M 20,50 H 80" />
        <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
      </svg>

    </button>

    <nav class="navbar--container" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

      <?php

      wp_nav_menu([
        'theme_location'  => 'primary_navigation',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 3,
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'nav',
        'link_before'     => '<span>',
        'link_after'      => '</span>',
        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
        'walker'          => new wp_bootstrap_navwalker()
      ]);

      ?>

      <ul class="nav nav-support">
        <li class="nav-button">
          <a href="">Support</a>
        </li>
      </ul>

    </nav>

    <?php endif; ?>



  </div>

</header>


