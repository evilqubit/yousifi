<?php 
class Job extends AppModel {
	var $name = "Job";
	var $useTable = 'jobs';
	var $actsAs = array("Containable","Translate"=>array("title","text"));
	var $translateModel = "JobI18n";
	var $translateTable = "jobs_i18n";
	var $locale = "eng";
	var $cacheFolder = "jobs";
	
	function getAllJobs($locale = "eng"){
		$modelName='Job';
		
		$cacheId = "getAllJobs_$locale";

		if(($data = Cache::read($cacheId,$modelName)) === false){
			
			$this->locale = $locale;
			$data = $this->find("all",array("contain"=>false,
			'fields'=>array("$modelName.id","$modelName.title","$modelName.text"),
			"conditions"=>array("Job.visible"=>1 ),
			 "order"=>array("Job.position"=>"ASC","Job.id"=>"DESC")));
			
			Cache::write($cacheId, $data, $modelName);
		}
		
		return $data;
	}
	
	function getAllJobsList($locale = "eng"){
		$modelName='Job';
		
		$cacheId = "getAllJobsList_$locale";

		if(($data = Cache::read($cacheId,$modelName)) === false){
			
			$this->locale = $locale;
			$data = $this->find("all",array("contain"=>false,
			'fields'=>array("$modelName.id","$modelName.title","$modelName.text"),
			"conditions"=>array("Job.visible"=>1),
			 "order"=>array("Job.position"=>"ASC","Job.id"=>"DESC")));
			
			Cache::write($cacheId, $data, $modelName);
		}
		
		return $data;
	}
	
	function get_selected_job_details($id,$locale = "eng"){
		$modelName='Job';
		
		$cacheId = "jget_selected_job_details_$locale";

		if(($data = Cache::read($cacheId,$modelName)) === false){
			
			$this->locale = $locale;
			$data = $this->find("first",array("contain"=>array(),"conditions"=>array("Job.id"=>$id ,'Job.type'=>'default'),
			 "order"=>array("Job.position"=>"ASC","Job.id"=>"DESC")));
			
			Cache::write($cacheId, $data, $modelName);
		}
		
		return $data;
	}
	
	function get_general_job_details($locale = "eng"){
		$modelName='Job';
		
		$cacheId = "get_general_job_details_$locale";

		if(($data = Cache::read($cacheId,$modelName)) === false){
			
			$this->locale = $locale;
			$data = $this->find("first",array("contain"=>array(),"conditions"=>array("Job.type"=>'general'),
			 "order"=>array("Job.position"=>"ASC","Job.id"=>"DESC")));
			
			Cache::write($cacheId, $data, $modelName);
		}
		
		return $data;
	}
	
	function afterSave(){
		Cache::clearGroup("$this->cacheFolder");
		
	}
	
	function afterDelete(){
		Cache::clearGroup("$this->cacheFolder");
	}
	
}
?>