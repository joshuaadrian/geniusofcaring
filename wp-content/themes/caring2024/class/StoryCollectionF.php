<?php

class StoryCollectionF {

    private $userlist;
    private $story_array;

    function __construct(){
        $Database = new Database;
        $db = $Database->db;
        $statement = $db->prepare('select user_id FROM goc_users WHERE status = "linked"  AND featured = "1" ORDER BY "user_id" ASC');

        $statement->execute();
        $this->userlist = $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function get_filters(){
        $prompt[1] = 'Which of these best describes you?';
        $prompt[2] = 'If your loved one was experiencing signs of dementia, would you keep it a secret?';
        $prompt[3] = 'Who are you here for?';
        $prompt[4] = 'The thing I miss most is...';
        $prompt[5] = 'I first began to worry when...';
        $prompt[6] = 'The hardest part of my day today was...';
        $prompt[7] = 'The best part of my day today was...';
        $prompt[8] = 'I didn\'t consider myself a caregiver until I had to...';
        $prompt[9] = 'I have found the most support from...';
        $prompt[10] = 'I have felt most abandoned by...';
        $prompt[11] = 'The thing that would surprise most people about my day is...';
        $prompt[12] = 'The funniest thing that has happened was...';
        $prompt[13] = 'The gift of being a caregiver is...';
        $prompt[22] = 'The biggest change I have had to make...';
        return $prompt;
    }

    public function get_prompt_short($field_id){
        $prompt[1] = 'I am...';
        $prompt[2] = 'Would you keep it a secret?';
        $prompt[3] = 'I&rsquo;m here for...';
        $prompt[4] = 'I miss...';
        $prompt[5] = 'I first began to worry when...';
        $prompt[6] = 'The hardest part of my day today was...';
        $prompt[7] = 'The best part of my day today was...';
        $prompt[8] = 'I didn\'t consider myself a caregiver until I had to...';
        $prompt[9] = 'I have found the most support from...';
        $prompt[10] = 'I have felt most abandoned by...';
        $prompt[11] = 'The thing that would surprise most people about my day is...';
        $prompt[12] = 'The funniest thing that has happened was...';
        $prompt[13] = 'The gift of being a caregiver is...';
        $prompt[22] = 'The biggest change I have had to make...';
        return $prompt[$field_id];
    }

    public function get_stories(){

        foreach($this->userlist as $user_id){
            $this_story = new Story($user_id);
            $this_story->get_story();
            $this->story_array[] = $this_story;
        }
        return $this->story_array;
    }
}