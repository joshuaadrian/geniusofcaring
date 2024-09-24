<?php
/**
* Template Name: Home Page
*/

    get_header();
    if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
    if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
    if ( !class_exists('Prompts') ) : require_once(get_stylesheet_directory() . '/class/Prompts.php'); endif;

  
if(!is_user_logged_in()){
?>
    <article class="full intro">
        <img src="/wp-content/themes/caring/images/GOC_large_logo.png">
        <button>Explore</button>
        <div class="welcome_text">
        <div>
            <p>Welcome to The Genius of Caring, a story-sharing community made up of family caregivers, friends and those whose lives have been touched by Alzheimer&rsquo;s and other caregiving-intensive diseases.</p>
            <p>We invite you to view our caregiver video portraits. While engaging with the content, you will be prompted to share how Alzheimer&rsquo;s has touched your life. You will also have the opportunity to share your stories, photos and experiences and add them to our community archive.</p>
            <a class="button" href="/portraits">Continue</a>
        </div>        
        </div>        
    </article>
<?php }else{

    require_once(get_stylesheet_directory() . '/class/StoryCollection.php');
    require_once(get_stylesheet_directory() . '/class/StoryCollectionF.php');
    require_once(get_stylesheet_directory() . '/class/Story.php');



    $StoryCollectionF = new StoryCollectionF();
    $StoryCollection = new StoryCollection(100, 0);
    $StoriesF = $StoryCollectionF->get_stories();
    $Stories = $StoryCollection->get_stories();
    $prompt_titles = $StoryCollectionF->get_filters();


    echo '
        <article class="full">
            <div class="featured_carousel">
                <ul class="featured_carousel_list">';
//feature carousel here
    $featuredids = array();
    $good_answers = array();
    $n=0;
    foreach ($StoriesF as $story) {
        $n++;
        $user_id = $story->user_id;
        if (in_array($user_id, $featuredids)) {
            continue;
        }
        $featured = $story->featured;
        $user_url = $story->user_url;
        $answers = $story->user_story;
        if ($featured) {
            $featuredids[] = $user_id;
            $good_answer['field_id'] = '';
            $good_answer['content_id'] = '';
            $good_answer['answer'] = $story->featured_answer;
            $good_answer['user_id'] = $user_id;
            $good_answer['user_url'] = $story->user_url;
            $good_answer['photo'] = $story->featured_photo;
            $good_answer['class'] = 'featured';
            $good_answer['prompt'] = 'Featured Story: <br>' . $story->featured_name;
            if($n==1){
                $good_answer['class'] = 'featured active';
            }
            $good_answers[] = $good_answer;
        }
    }
    foreach($good_answers as $answer){
        echo '
            <li class="' . $answer['class'] . '" data-field_id="' . $answer['field_id'] . '" data-user_id="' . $answer['user_id'] . '" data-content_id="' . $answer['content_id'] . '" style="background-image:url(\'' . $answer['photo'] . '\');">
                <a href="/care-gallery/' . $answer['user_url'] . '" class="main_link">
                    <div>
                        <h1>' . $answer['prompt'] . '</h1>
                        <p>' . $answer['answer'] . '</p>
                        <button>View Story</button>
                    </div>
                </a>
            </li>';
    }


    echo'
                </ul>

            </div>';

    echo'
            <ul class="filter">
                <li class="switch">Filter: <span class="filter_text">View All Stories</span> <form method="post" action="/user-search"><input type="text" name="user_search" placeholder="Member Search"></form></li>
                <li data-filter="*">View All Stories</li>';
    foreach ($prompt_titles as $field_id => $prompt) {
        echo '
                <li data-filter=".field_' . $field_id . '">' . $prompt . '</li>';
    }
    echo '
            </ul>
            <ul class="gallery">';
    foreach ($Stories as $story) {
        $good_answers = array();
        $user_id = $story->user_id;
        $featured = $story->featured;
        if (!$featured) {
            $user_url = $story->user_url;
            $answers = $story->user_story;
            foreach ($answers as $answer) {
                //get rid of not as good answers
                if (strlen($answer->additional) <= 5) {
                    continue;
                }

                $good_answer['field_id'] = $answer->field_id;
                $good_answer['content_id'] = $answer->content_id;
                $good_answer['field_content'] = $answer->field_content;
                $good_answer['additional'] = $answer->additional;
                $good_answer['photo'] = $answer->photo;
                $good_answer['class'] = 'gallerysizer field_' . $answer->field_id;
                $good_answer['prompt'] = $StoryCollection->get_prompt_short($answer->field_id);
                //answer cleanup
                $prefix = ' - ';
                if (substr($good_answer['additional'], 0, strlen($prefix)) == $prefix) {
                    $good_answer['additional'] = substr($good_answer['additional'], strlen($prefix));
                }
                $good_answer['answer'] = $good_answer['field_content'] . '<br><br>' . $good_answer['additional'];
                if ($good_answer['field_content'] == '' || $good_answer['additional'] == $good_answer['field_content']) {
                    $good_answer['answer'] = $good_answer['additional'];
                }
                $good_answers[] = $good_answer;
            }
        }
        foreach($good_answers as $answer){
            echo '
            <li class="isosizing ' . $answer['class'] . '" data-field_id="' . $answer['field_id'] . '" data-user_id="' . $user_id . '" data-content_id="' . $answer['content_id'] . '" style="background-image:url(\'' . $answer['photo'] . '\');">
                <a href="/care-gallery/' . $user_url . '">
                    <div>
                        <h1>' . $answer['prompt'] . '</h1>
                        <p>' . $answer['answer'] . '</p>
                    </div>
                </a>
            </li>';
        }
    }


    echo '
            </ul>
        </article>
        <section class="soundcloud_player">
            <div class="iframe">
                <iframe width="100%" height="350" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/147277442&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
            </div>
            <button class="soundcloud_button">Sound</button>
        </section>';
		}
    get_footer();

 ?>
