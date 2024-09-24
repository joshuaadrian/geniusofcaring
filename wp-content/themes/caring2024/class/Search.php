<?php

class Search {

    public $user_search;
    public $results;

    function user_search($user_search){
		$this->user_search = $user_search;
		$this->results = array();
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select * from goc_users where name like :user_search');
        $statement->execute(array(
                                ':user_search' => '%' . $user_search . '%'
                                ));
        while($results = $statement->fetch(PDO::FETCH_ASSOC)){
			$this->results[] = $results;
		}
        return $this->results;
    }

}