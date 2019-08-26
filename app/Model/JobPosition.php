<?php 
class JobPosition extends AppModel {
	var $name = "JobPosition";
	var $useTable = 'job_positions';
	var $actsAs = array("Containable");
	var $cacheFolder = "job_positions";
	
	
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
		
		$cacheId = "JobPosition_list_$locale";
		
		if(($countries = Cache::read($cacheId,"$modelName")) === false){
			
			if($locale == "eng"){
				$fields = array("JobPosition.id","JobPosition.title");
				$order=array("JobPosition.title"=>'ASC');
			}else{
				$fields = array("JobPosition.id","JobPosition.title_ar");
				$order=array("JobPosition.title_ar"=>'ASC');
			}
				
			
			
			$countries = $this->find("list",array(
			'order'=>$order,
			"fields"=>$fields
			));
		
		
			//Cache::write($cacheId, $countries, $modelName);
		}
		
		return $countries;
		
	}
	
	function afterSave(){
		Cache::clearGroup("job_positions");
	}
	
	function afterDelete(){
		Cache::clearGroup('job_positions');
	}
}
?>