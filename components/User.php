<?php

/**
* User Class
* Contains function related to users
* @author Mihai Ionut Vilcu (ionutvmi@gmail.com)
* 11 - May - 2013
* 
*/

class User {

	/**
	 * Stores the object of the mysql class
	 * @var object 
	*/
	var $db; 
	/**
	 * Stores the users details encoded with htmlentities()
	 * @var object
	*/
	var $filter;
	/**
	 * stores the user data without any filter
	 * @var object
	*/
	var $data;
	/**
	 * contains the group details about the current user
	 * @var object
	 */


	function __construct($db) {
		$this->db = $db;
		$this->data = new stdClass();
		$this->filter = array();


		if($this->islg()){ // set some vars
			$this->data = $this->grabData($_SESSION['user']);
			 

		} else {
			//var_dump("I am a fool");
			// we set some default values
			// by doing this we won't have to do an extra check to display user or `guest` on the site
			$this->filter = new stdClass();
			$this->data = new stdClass();
			$this->filter->username = "Guest";
			$this->data->userid = 0;


		}


	}
	/**
	 * Checks if user is logged in
	 * @return bool
	*/
	function islg() {
		if(isset($_SESSION['user']))
			return true;
		return false;
	}
	
	
	
	
	/**
	 * grabs the data about the user
	 * @param  integer $userid the id to grab data for
	 * @return object         data about the specified id
	 */
	function grabData($userid) {
		$sql="SELECT * FROM `smp_users` WHERE `userid` = $userid";
		//var_dump($sql);
		$result=$this->db->query($sql);
		
			if($result) $fetched = $result->fetch(PDO::FETCH_ASSOC)  ;
		//var_dump($fetched);
		return $fetched;
	}
	
	
	/**
	 * logges out the current user
	 * @return void 
	 */
	public static function logout() {
		global $set;
		session_unset('user');
		
		setcookie("user", 0, time() - 3600 * 24 * 30); // delete
		setcookie("key",  0, time() - 3600 * 24 * 30); // delete
	}


}



