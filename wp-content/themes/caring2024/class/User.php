<?php

if ( !class_exists('User') ) :

class User {

    public $user_id;
    public $user_name;
    public $user_photo;
    public $user_bio;
    public $user_type;
    public $user_herefor;
    public $user_url;
    public $user_website_url;
	public $valid;

    function __construct($user_id=null){
        if($user_id!=null){
            if(ctype_digit($user_id)){
                $this->user_id = $user_id;
            } else {
                $this->user_id = $this->get_user_id_from_user_url($user_id);
				$this->valid = true;
            }
			$this->set_valid();
        }
    }
	
	private function set_valid(){
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select * from goc_users where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $this->user_id
                                ));
		if ($statement->rowCount() > 0) {
			$this->valid = true;
		} else {
			$this->valid = false;
		}		
	}
	
	public function get_user_email_address(){
		$WP_User = get_userdata($this->get_wp_user_id($this->user_id));
		return $WP_User->user_email;
	}
    
    public function get_user_id_from_user_url($user_url){
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select user_id from goc_users where user_url = :user_url');
        $statement->execute(array(
                                ':user_url' => $user_url
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return $results['user_id'];
    }
    
    public function get_user_url_from_user_id($user_id){
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select user_url from goc_users where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $user_id
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return $results['user_url'];
    }
    
    public function set_user_url($user_url){
        $Database = new Database;
        $db = $Database->db;
        $insert = $db->prepare('update goc_users set user_url = :user_url where user_id = :user_id');
        $insert->bindParam(':user_url', $user_url);
        $insert->bindParam(':user_id', $this->user_id);
        if($insert->execute()){
            return 'Success';
        } else {
            return 'Error';
        }
    }
    
    public function useSession(){
        if($_SESSION['user_id'] != ''){
            $this->user_id = $_SESSION['user_id'];
        } else {
            if(is_user_logged_in()){
                $wp_user = wp_get_current_user();
                $wp_user_id = $wp_user->ID;
                $this->user_id = $this->get_user_id($wp_user_id);
                $_SESSION['user_id'] = $this->user_id;
            }
        }
		$this->set_valid();
   }
    
    public function useDb(){
        if(is_user_logged_in()){
            $wp_user = wp_get_current_user();
            $wp_user_id = $wp_user->ID;
            $this->user_id = $this->get_user_id($wp_user_id);
            $_SESSION['user_id'] = $this->user_id;
        }
		$this->set_valid();
   }
    
    public function get_user_id($wp_user_id){
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select user_id from goc_users where wp_user_id = :wp_user_id');
        $statement->execute(array(
                                ':wp_user_id' => $wp_user_id
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return $results['user_id'];
    }

    public function get_wp_user_id($user_id){
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select wp_user_id from goc_users where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $user_id
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        $wp_user_id = $results['wp_user_id'];
        return $wp_user_id;
    }

    public function get_profile(){
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select * from goc_users where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $this->user_id
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        $this->user_photo = $results['photo'];
        if($this->user_photo==''){
            $this->user_photo = '/wp-content/themes/caring2024/images/defaults/profile.png';
        }
        $this->user_name = $results['name'];
        $this->user_type = $results['user_type'];
        $this->user_bio = $results['bio'];
        //i think this needs to be a new query from the here_for prompt
        $this->user_herefor = $results['here_for'];
        $this->user_url = $results['user_url'];
        $this->user_website_url = $results['website_url'];
        if($this->user_url==''){
            $this->user_url = $this->user_id;
        }
        
    }

    public function createUser(){
        $Database = new Database;
        $db = $Database->db;
        $status = 'new';
        $insert = $db->prepare('insert into goc_users (status) values (:status)');
        $insert->bindParam(':status', $status);
        $insert->execute(); 
        $this->user_id = $db->lastInsertId();
        $_SESSION['user_id'] = $this->user_id;
    }
    
    public function registerUser($email_address){
        $response = register_new_user($email_address, $email_address);
        if ( is_wp_error($response) ) {
            return false;
        } else {
            require_once(get_stylesheet_directory() . '/class/MCAPI.class.php');
            $MCapi = new MCAPI('6656c308e023e9c369be85375c77c1d1-us7');
            $list_id = "dedc02c661";
            $merge_vars = array(
                            $email_type='html',
                            $double_optin=false,
            );
            $MCapi->listSubscribe($list_id, $email_address, $merge_vars);
            $this->linkUser($response);
			return true;
        }
    }
    
    public function linkUser($wp_user_id){
        if($this->user_id == ''){
            $this->createUser();
        }
        $Database = new Database;
        $db = $Database->db;
        $status = 'linked';
        $insert = $db->prepare('update goc_users set status = :status, wp_user_id = :wp_user_id where user_id = :user_id');
        $insert->bindParam(':status', $status);
        $insert->bindParam(':wp_user_id', $wp_user_id);
        $insert->bindParam(':user_id', $this->user_id);
        $insert->execute();
        wp_set_auth_cookie( $wp_user_id, 'true' );
    }

    public function addField($field_id,$field_content){
        if($this->user_id == '') {
            $this->createUser();
        }
        $Database = new Database;
        $db = $Database->db;
        if($field_id=='4'){
            $insert = $db->prepare('insert into goc_stories (user_id, field_id, additional) values (:user_id, :field_id, :field_content)');
        }else{
            $insert = $db->prepare('insert into goc_stories (user_id, field_id, field_content) values (:user_id, :field_id, :field_content)');
        }
        $insert->bindParam(':field_content', $field_content);
        $insert->bindParam(':user_id', $this->user_id);
        $insert->bindParam(':field_id', $field_id);
        $insert->bindParam(':field_content', $field_content);
        $insert->execute(); 
    }

    public function udpateField($field_id,$field_content,$content_id){
        $Database = new Database;
        $db = $Database->db;
        $insert = $db->prepare('update goc_stories set field_content = :field_content where field_id = :field_id and user_id = :user_id');
        $insert->bindParam(':user_id', $this->user_id);
        $insert->bindParam(':field_id', $field_id);
        $insert->bindParam(':field_content', $field_content);
        $insert->execute(); 
    }

    public function addField_addtl($field_id,$field_content,$additional, $photo=null){
        $public = 'public';
        $Database = new Database;
        $db = $Database->db;
        $insert = $db->prepare('insert into goc_stories (user_id, field_id, field_content, additional, photo, public) values (:user_id, :field_id, :field_content, :additional, :photo, :public)');
        $insert->bindParam(':user_id', $this->user_id);
        $insert->bindParam(':field_id', $field_id);
        $insert->bindParam(':field_content', $field_content);
        $insert->bindParam(':additional', $additional);
        $insert->bindParam(':photo', $photo);
        $insert->bindParam(':public', $public);
        $insert->execute(); 
    }
    
    public function handle_additional_info($field_id,$field_content,$additional, $photo=null){
        $Database = new Database;
        $db = $Database->db;
        $statement = $db->prepare('select * from goc_stories where user_id = :user_id and field_id = :field_id');
        $statement->execute(array(
                                ':user_id' => $this->user_id,
                                ':field_id' => $field_id
                                ));
        if ($statement->rowCount() > 0) {
            $this->udpateField_addtl($field_id,$field_content,$additional, $photo);
        } else {
            $this->addField_addtl($field_id,$field_content,$additional, $photo);
        }        
    }

    public function udpateField_addtl($field_id,$field_content,$additional, $photo=null){
        $public = 'public'; //CHECK THIS OUT - Should be dependent on user settings
        $Database = new Database;
        $db = $Database->db;
        $insert = $db->prepare('update goc_stories set field_content = :field_content, additional = :additional, photo = :photo, public = :public where field_id = :field_id and user_id = :user_id');
        $insert->bindParam(':photo', $photo);
        $insert->bindParam(':public', $public);
        $insert->bindParam(':field_id', $field_id);
        $insert->bindParam(':user_id', $this->user_id);
        $insert->bindParam(':field_content', $field_content);
        $insert->bindParam(':additional', $additional);
        $insert->execute(); 
    }

    public function udpateProfile($name,$user_type,$bio, $photo=null, $website_url=null){
        $user_id = $this->user_id; 
        $Database = new Database;
        $db = $Database->db;
        $website_url = str_replace('https://','',$website_url);
        $website_url = str_replace('http://','',$website_url);
        $insert = $db->prepare('update goc_users set photo = :photo, name = :name, user_type = :user_type, bio = :bio, website_url = :website_url where user_id = :user_id');
        $insert->bindParam(':photo', $photo);
        $insert->bindParam(':name', $name);
        $insert->bindParam(':user_id', $this->user_id);
        $insert->bindParam(':user_type', $user_type);
        $insert->bindParam(':bio', $bio);
        $insert->bindParam(':website_url', $website_url);
        $insert->execute(); 
    }

    public function setPublic(){
        $Database = new Database;
        $db = $Database->db;
        $public = 'public';
        $insert = $db->prepare('update goc_stories set public = :public where user_id = :user_id');
        $insert->bindParam(':public', $public);
        $insert->bindParam(':user_id', $this->user_id);
        $insert->execute(); 
    }

    public function setPrivate(){
        $Database = new Database;
        $db = $Database->db;
        $public = 'private';
        $insert = $db->prepare('update goc_stories set public = :public where user_id = :user_id');
        $insert->bindParam(':public', $public);
        $insert->bindParam(':user_id', $this->user_id);
        $insert->execute(); 
    }

    public function get_profile_image(){
        return '/wp-content/themes/caring2024/images/defaults/profile.jpg';
    }

    public function get_answers(){
         
        $Database = new Database;
        $db = $Database->db;
        $statement = $db->prepare('select * from goc_stories where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $this->user_id
                                ));
        $answers = array();
        while($results = $statement->fetch(PDO::FETCH_ASSOC)):
            $answer = array();
            $field_id = $results['field_id'];
            if($field_id == 14 || $field_id == 15 || $field_id == 16 ){
                continue;
            }
            $answer = new stdClass();
            $answer->photo = $results['photo'];
            $answer->field_content = $results['field_content'];
            $answer->additional = $results['additional'];
            $answer->content_id = $results['content_id'];
            $answers[$field_id] = $answer;
        endwhile;
        return $answers;
    }
    
    public function getPrivacy(){
        $user_id = $this->user_id;
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select public_password from goc_users where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $user_id
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        if($results['public_password'] !=''){
            return 'Private';
        }else{
            return 'Public';
        }
    }
    
    public function get_public_password(){
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select public_password from goc_users where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $this->user_id
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return $results['public_password'];
    }
    
    public function set_public_password($public_password){
        $Database = new Database;
        $db = $Database->db;
        $insert = $db->prepare('update goc_users set public_password = :public_password where user_id = :user_id');
        $insert->bindParam(':public_password', $public_password);
        $insert->bindParam(':user_id', $this->user_id);
        if($insert->execute()){
            return 'Success';
        } else {
            return 'Error';
        }
        if($public_password!==''){
            $this->setPrivate();
        } else {
            $this->setPublic();
        }
    }
    
    public function getPublicPassword() {
        $user_id = $this->user_id;
        $Database = new Database; 
        $db = $Database->db;
        $statement = $db->prepare('select public_password from goc_users where user_id = :user_id');
        $statement->execute(array(
                                ':user_id' => $user_id
                                ));
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return $results['public_password'];
    }
}

endif;