<?php

class Story {

	public $user_id;
    public $user_story;

    public $user_name;
    public $user_photo;
    public $user_bio;
    public $user_type;
    public $user_herefor;
    public $user_url;
    public $user_website_url;
    public $featured;
    public $featured_name;
    public $featured_photo;
    public $featured_answer;

    function __construct($user_id){
        $this->user_id = $user_id;
        $this->get_user_info();
    }

    private function get_user_info(){
        $Database = new Database;
        $db = $Database->db;
        $statement = $db->prepare('select * from goc_users where user_id = :user_id');
        $statement->execute(array(
            ':user_id' => $this->user_id
        ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        $this->user_photo = $results['photo'];
        if($this->user_photo==''){
            $this->user_photo = '/wp-content/themes/caring/images/defaults/profile.png';
        }
        $this->user_name = $results['name'];
        $this->user_type = $results['user_type'];
        $this->user_bio = $results['bio'];
        $this->user_url = $results['user_url'];
        $this->user_website_url = $results['website_url'];
        if($this->user_url==''){
            $this->user_url = $this->user_id;
        }
        $this->featured = $results['featured'];
        $this->featured_name = $results['featured_name'];
        $this->featured_photo = $results['featured_photo'];
        $this->featured_answer = $results['featured_answer'];
    }

    public function get_story() {
        $Database = new Database;
        $db = $Database->db;
        $user_id = $this->user_id;
        $statement = $db->prepare('select * from goc_stories where user_id = :user_id');
        $statement->execute(array(
            ':user_id' => $user_id
        ));
        $answers = array();
        while($results = $statement->fetch(PDO::FETCH_ASSOC)) {
            //could do each field id programatically with prompt title?
            //could also make list of featured stories in this object in this loop
            //all sorts of filtering could be created here or processed after
            $field_id = $results['field_id'];
            /*if ($field_id == 14 || $field_id == 15 || $field_id == 16) {
                // continue; these fields are discontinued but I don't like this solution
            }*/
            if ($field_id == 1) {
                //set bio type from prompt answer
                $this->user_type = $results['field_content'];
            }
            if ($field_id == 3) {
                //set bio herefor from prompt answer
                $this->user_herefor = $results['field_content'];
            }
            $answer = new stdClass();
            $answer->field_content = $results['field_content'];
            $answer->content_id = $results['content_id'];
            $answer->photo = $results['photo'];
            $answer->additional = $results['additional'];
            $answer->field_id = $results['field_id'];
            if ($answer->photo == '') {
                $portrait_default_selector = substr($user_id, -1); //get last digit of user_id
                $img_version = '0';
                if ($portrait_default_selector == 2 || $portrait_default_selector == 3) {
                    $img_version = '1';
                } elseif ($portrait_default_selector == 4 || $portrait_default_selector == 5) {
                    $img_version = '2';
                } elseif ($portrait_default_selector == 6 || $portrait_default_selector == 7) {
                    $img_version = '3';
                } elseif ($portrait_default_selector == 8 || $portrait_default_selector == 9) {
                    $img_version = '4';
                }
                $answer->photo = '/wp-content/themes/caring/images/defaults/story_images/Untitled-' . $field_id . '-' . $img_version . '.jpg';
            }
            $answers[] = $answer;
        }
        ksort($answers);
        $this->user_story = $answers;
        return $this->user_story;
    }

}
