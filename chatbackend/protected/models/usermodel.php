<?php 
class usermodel extends CActiveRecord {
	var $connection;
	var $myFriends;
	var $myNumber;
	var $user_pk;
	var $device_id;
	//Constructor
	public function __construct(){
		$this->connection=Yii::app()->db;
	}
	
	//private functions
	function getMyFriends() {
		$sql = "SELECT friend_number FROM friends where my_number =".$this->myNumber;
		$command = $this->connection->createCommand($sql);
		$command->setFetchMode(PDO::FETCH_OBJ);
		//var_dump($sql);
		$rows = $command->queryAll();
		return  $rows;
	}
	
	function getDeviceId($number){
		$sql = "SELECT user_pk, device_id FROM user AS u JOIN user_details AS ud ON u.user_pk = ud.user_fk  where u.contact_number =".$number;
		$command = $this->connection->createCommand($sql);
		$command->setFetchMode(PDO::FETCH_OBJ);
		//var_dump($sql);
		$rows = $command->queryRow();
		return $rows->device_id;
	}
	function checkIsFriend( $friendNumber) {
		$myFriends = $this->getMyFriends($this->myNumber);
		foreach($myFriends as $myFriend){
			if($friendNumber === $myFriend){
				return true;
			} else 	{
				return false;
			}
		}
	}
	function addAsFriend($friendNumber){
		$sql = "INSERT INTO friends (my_number, friend_number) VALUES(".$this->myNumber.", ".$friendNumber.")";
				$command=$this->connection->createCommand($sql);
				$rows=$command->execute();
	}
	
	//public functions
	//Function to creat a user
	public function createUser($username, $number, $deviceid) {
		$last_insert_id;
		$sqlInsertUser = "INSERT INTO user (username,contact_number) VALUES ('".$username."','".$number."')";
		
		$commandInsertUser = $this->connection->createCommand($sqlInsertUser);
		
		//var_dump($sqldelete);
		if($commandInsertUser->execute()>0){
			$last_insert_id = Yii::app()->db->lastInsertID;
			$sqlInsertDetail = "INSERT INTO user_details (user_fk,device_id) VALUES ('".$last_insert_id."','".$number."')";
			$commandInsertDetail = $this->connection->createCommand($sqlInsertDetail);
			if($commandInsertDetail->execute()> 0) {
				return $last_insert_id;
			}
		} else {
			return false;
		}
	}
	
	public function syncContact($myNumber, $contacts){
		$this->myNumber = $myNumber;
		$this->getDeviceId($this->myNumber);
		foreach($contacts as $contact){
			if(!$this->checkIsFriend($this->myNumber, $contact)){
				$this->addAsFriend($contact);
			}
		}
		$finalFriends = $this->getMyFriends($this->myNumber);
		return $finalFriends;
	}
	public function sendMessage($to, $from, $msg){
		$dev_id = $this->getDeviceId($to);
		$sql = "INSERT INTO messages (`to`, `from`, `msg`, `to_device_id`) VALUES ('".$to."','".$from."', '".$msg."','".$dev_id."')";
		$command=$this->connection->createCommand($sql);
		$rows = $command->execute();
		return $rows;
	}
}
