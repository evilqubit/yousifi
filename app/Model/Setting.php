<?php 
class Setting extends AppModel {
	
	public $name = 'Setting';
	public $useTable = 'settings';
	public $actsAs = array("Containable");
	public $cacheFolder = "settings";
	public $locale = "eng";
	
	
	
	public function getSocialMediaLinks(){
		$data = $this->find("first");
		return $data;
	}
	
	
	
	
	
	
}
?>