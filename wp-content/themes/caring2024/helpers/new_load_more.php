<?php

if ( !class_exists('Database') ) : require_once(get_stylesheet_directory() . '/class/Db.php'); endif;
if ( !class_exists('User') ) : require_once(get_stylesheet_directory() . '/class/User.php'); endif;
require_once(get_stylesheet_directory() . '/class/StoryCollection.php');
require_once(get_stylesheet_directory() . '/class/Story.php');

$limit = $_POST['limit'];
$page = $_POST['page'];
if ($page == 0) {
    $offset = 0;
} else {
    $offset = 10 + (($page - 1) * $limit);
}
$StoryCollection = new StoryCollection($limit, $offset);
$Stories = $StoryCollection->get_stories();
$prompt_titles = $StoryCollection->get_filters();
foreach ($Stories as $story) {
    $user_id = $story->user_id;
    $featured = $story->featured;
    if (!$featured) {
        $user_url = $story->user_url;
        $answers = $story->user_story;
        $good_answers = array();
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
            $good_answer['class'] = 'field_' . $answer->field_id;
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
    foreach ($good_answers as $answer) {
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

