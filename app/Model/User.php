<?php
class User extends AppModel
{
	var $name = 'User';
	var $actsAs = array('Containable');
	
	function check_duplicates($field,$value,$cond = " 1=1"){
		$duplicateCount = $this->find("count",array("conditions"=>array("User.$field"=>$value,$cond)));
		
		if($duplicateCount > 0)
			return 1;
		else return 0;
	}
	

	
	function check_if_fb_id_exists($fbId){
		$this->contain();
		$getUser = $this->find("first",array("fields"=>array("User.id"),"conditions"=>array("User.facebook_id"=>$fbId)));
		if(!empty($getUser)){
			$userId = $getUser["User"]["id"];
		}else $userId = 0;
		
		return $userId;
		
	}
	
	function check_if_fb_email_exists($fbEmail,$fbId){
		$this->contain();
		$getUser = $this->find("first",array("fields"=>array("User.id"),"conditions"=>array("User.facebook_id >= 0","User.email"=>$fbEmail)));
		if(!empty($getUser)){
			$userId = $getUser["User"]["id"];
		}else $userId = 0;
		
		return $userId;
		
	}
}
?>