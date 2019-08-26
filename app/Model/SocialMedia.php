<?php 
class SocialMedia extends AppModel {
	
	public $name = 'SocialMedia';
	public $useTable = 'social_medias';
	public $actsAs = array("Containable");
	public $cacheFolder = "social_media";
	public $locale = "eng";
	
	
	
	public function getSocialMediaLinks(){
		$data = $this->find("first");
		//print_r($data);exit;
		return $data;
	}
	
	
	
	
	
	
}
?>