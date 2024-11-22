<div class="masthead is-short-height">

  <div class="masthead--image" style="background-image:url(<?= get_stylesheet_directory_uri(); ?>/dist/images/background-navigation.jpg);background-size:cover;background-position-x:center;background-position-y:center;"></div>
  
  <div class="masthead--container">

    <div class="masthead--content" style="width:100%;align-content:center;align-items:center;justify-content:left;"><div class="masthead--content-inner"><h1 class="masthead--title h1 is-secondary-before" style="color:#ffffff;text-align:left;"><span>Search</span></h1></div></div>
  </div>
  
</div>

<div class="search--content">

	<div class="wp-block-group">

		<div class="wp-block-group__inner-container">


			<h1 class="search--title">Search Results for &ldquo;<strong><?= get_search_query(); ?></strong>&rdquo;</h1>

		</div>

	</div>

	<div class="wp-block-group narrower has-background has-gray-150-background-color">

		<div class="wp-block-group__inner-container">

			<?php

			if ( !have_posts() ) :

				echo '<div class="search--no-results">';
					echo '<h2>Sorry, no results were found.</h2>';
					// echo '<div class="wp-block-button aligncenter is-style-outline">';
					// echo '<a class="wp-block-button__link has-orange-400-color has-orange-400-background-color has-text-color has-background" href="/"><span>Back to Home</span></a>';
					// echo '</div>';
				echo '</div>';
			
			else :
			
				get_template_part('templates/content', 'search');
		
				echo '<div class="search--pagination">';
					the_posts_navigation();
				echo '</div>';

			endif;

			?>

		</div>

	</div>

</div>