<?php
class ContactDepartment extends AppModel{
	public $name = 'ContactDepartment';
	public $useTable = 'contact_departments';
	public $actsAs = array("Translate"=>array("title"));
	public $translateModel = "ContactDepartmentI18n";
	public $translateTable = "contact_departments_i18n";
	public $locale = "eng";
	public $cache_folder = "contact_departments";
	
	public function getContactReasonsList($locale = "eng"){
 		$cache_folder = $this->cache_folder;
		$name = $this->name;
		$modelName=$name;
		$cacheId = "{$locale}_contact_reasons";
		if(($reasons = Cache::read($cacheId,$modelName)) === false){
			$this->locale = $locale;
 			$reasons = $this->find('list', array(
 			'order'=>array("$name.position"=>"ASC", "$name.id"=>'DESC'),
 			'fields'=>array("$name.id","$name.title") ,'conditions'=>array("$name.visible"=>1)));
 			
 			Cache::write($cacheId, $reasons, $modelName);
		}
 		return $reasons;
 	}
	
	function afterSave(){

		Cache::clearGroup("$this->cache_folder");
	}
	
	function afterDelete(){
		Cache::clearGroup("$this->cache_folder");
	}
}