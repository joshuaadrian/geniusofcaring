<?php
/**
* Template Name: Care Gallery Search    
*/

    get_header();
        if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
        if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
        require_once(get_stylesheet_directory() . '/class/Search.php');
    

    if($_POST['user_search'] == ''){ 
        echo'
        <article class="full">
            <div class="inner">
                <form method="post">
                    <input type="text" name="user_search" id="user_search" placeholder="Member Search">
                </form>
            </div>
        </article>'; 
    } else {
        echo'
        <article class="full">
            <div class="inner">
                <form method="post">
                    <label for="user_search">Search results for: <span>' . $_POST['user_search'] . '</span></label>
                    <input type="text" name="user_search" id="user_search" placeholder="Member Search">
                </form>
                <h1></h1>'; 
        $search_term = $_POST['user_search'];
		$Search = new Search;
		$results = $Search->user_search($search_term);
        $num_results = 0;
		foreach($results as $result){
			if($result['public_password'] != ''){
				continue;
			}
            $num_results++;
			$link = $result['user_id'];
			if($result['user_url']!='') {
				$link = $result['user_url'];
			}
            $user_image = $result['photo'];
            if($user_image == '/wp-content/themes/caring2024/images/profile_add_image_bttn.png' || $user_image == '/wp-content/themes/caring2024/images/defaults/profile.png' || $user_image == ''){
                $user_image = '/wp-content/themes/caring2024/images/defaults/user_icon.png';
            }
			echo'
                <div class="search-result">
					<a href="/care-gallery/' . $link . '">
						<img src="' . $user_image . '">
						<p>' . $result['name'] . '<br></p>
					</a>
				</div>';
		}
        if($num_results <= 0){
            echo'
                <div class="search-result">
                    <p>No results found. Please try again.</p>
                </div>';
        }
        echo'
            </div>
        </article>'; 
    }
    get_footer();

 ?>
