<?php

Class Prompts {

    function get_prompt_title($field_id){
    
        switch($field_id){
                case 1:
                    $prompt = 'Which of these best describes you?';
                    break;
                case 2:
                    $prompt = 'If your loved one was experiencing signs of dementia, would you keep it a secret?';
                    break;
                case 3:
                    $prompt = 'Who are you here for?';
                    break;
                case 4:
                    $prompt = 'The thing I miss most is...';
                    break;
                case 5:
                    $prompt = 'I first began to worry when...';
                    break;
                case 6:
                    $prompt = 'The hardest part of my today was...';
                    break;
                case 7:
                    $prompt = 'The best part of my day today was...';
                    break;
                case 8:
                    $prompt = 'I didn\'t consider myself a caregiver until I had to...';
                    break;
                case 9:
                    $prompt = 'I have found the most support from...';
                    break;
                case 10:
                    $prompt = 'I have felt most abandoned by...';
                    break;
                case 11:
                    $prompt = 'The thing that would surprise most people about my day is...';
                    break;
                case 12:
                    $prompt = 'The funniest thing that has happened was...';
                    break;
                case 13:
                    $prompt = 'The gift of being a caregiver is...';
                    break;
                default:
                    $prompt = '';
        }
        return $prompt;

    }
    function get_prompt_titles(){
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
        //$prompt[14] = 'Additional Text #1';
        //$prompt[15] = 'Additional Text #2';
        //$prompt[16] = 'Additional Text #3';
        //$prompt[21] = 'Where do you live? <br>Drag the marker to your hometown.';
        $prompt[22] = 'The biggest change I have had to make...';

        return $prompt;

    }
    
    function get_prompts($user_id) {
        $Database = new Database;
        $db = $Database->db;
        $statement = $db->prepare('select * from goc_stories where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $user_id
                                ));
        $answers = array();
        while($results = $statement->fetch(PDO::FETCH_ASSOC)):
            $answer = array();
            $field_id = $results['field_id'];
            if($field_id == 14 || $field_id == 15 || $field_id == 16 ){
                continue;
            }
            $answer = new stdClass();
            $answer->field_content = $results['field_content'];
            $answer->content_id = $results['content_id'];
            $answer->photo = $results['photo'];
            $answer->additional = $results['additional'];
            $answer->prompt = $this->get_prompt_title($field_id);
            $answers[$field_id] = $answer;
        endwhile; // this can't be right.
        foreach($this->get_prompt_titles() as $field_id=>$prompt_text){
            if(!$answers[$field_id]) $answers[$field_id] = new stdClass();
            $answers[$field_id]->prompt = $prompt_text;
        }
        ksort($answers);
        return $answers;
    
    }

    function get_answers($limit=null,$offset=null) {
        $Database = new Database;
        $db = $Database->db;
        $public = 'public';
        if($offset!==null){
            if(!$limit){
                $limit = 100;
            }
            $statement = $db->prepare('select * from goc_stories where public = :public order by content_id desc limit ' . $offset . ',' . $limit );
        } else {
            $statement = $db->prepare('select * from goc_stories where public = :public order by content_id desc');
        }
        $statement->execute(array(
                                ':public' => $public
                                ));
        $answers = array();
        while($results = $statement->fetch(PDO::FETCH_OBJ)):
            $answers[] = $results; 
        endwhile;
		shuffle($answers);
        return $answers;
    
    }

}
