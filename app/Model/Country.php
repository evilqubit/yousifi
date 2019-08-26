<?php 
class Country extends AppModel {
	var $name = "Country";
	var $useTable = 'countries';
	var $actsAs = array("Containable");
	var $cacheFolder = "countries";
	
	
	
	function getCountryByCode($code){
		$modelName = $this->name;

		$cacheId = "country_code_{$code}";

		if(($countryId = Cache::read($cacheId,"Country")) === false){
			
			$contain = false;
			$data = $this->find('first',array(
			"conditions"=>array("Country.name_code"=>$code),
			"contain"=>$contain
			)
			);
			
			if(!empty($data))
				$countryId = $data["Country"]["id"];
			else $countryId = 0;

		
			Cache::write($cacheId, $countryId, $modelName);
		}
		
		return $countryId;

	}
	
	function getList($locale){
		$modelName = $this->name;
		
		$cacheId = "countries_list_$locale";
		
		if(($countries = Cache::read($cacheId,"$modelName")) === false){
			
			if($locale == "eng")
				$fields = array("Country.id","Country.name");
			else $fields = array("Country.id","Country.name_ar");
			
			$countries = $this->find("list",array("fields"=>$fields));
		
		
			Cache::write($cacheId, $countries, $modelName);
		}
		
		return $countries;
		
	}
	
	function afterSave(){
		Cache::clearGroup("countries");
	}
	
	function afterDelete(){
		Cache::clearGroup('countries');
	}
}
?>