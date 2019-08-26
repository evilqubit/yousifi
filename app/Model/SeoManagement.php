<?php
class SeoManagement extends AppModel{
	var $name = 'SeoManagement';
	var $actsAs = array('Translate' => array('title','keywords','description','slug'));
	var $translateModel = 'SeoManagementI18n';
	var $translateTable = 'seo_managements_i18n';
	
		
	function saveSeo($data){
		$existing_seo = $this->find("count",array("conditions"=>array("SeoManagement.model_name"=>$data["SeoManagement"]["model_name"],"SeoManagement.field_id"=>$data["SeoManagement"]["field_id"])));
		if ($existing_seo>0){
			$this->id=$existing_seo['SeoManagement']['id'];
		}
		
		if($this->save($data)){
			$modelName = strtolower($data["SeoManagement"]["model_name"]);
			$fieldId = $data["SeoManagement"]["field_id"];
			$cacheId = "seo_management_{$modelName}_{$fieldId}";
		}
	}
	
	function get_defaults($locale = "ara"){
		$cacheId = "seo_management_$locale";

		if(($get_defaults = Cache::read($cacheId,'SeoManagement')) === false){
			$cond=array();

			$this->locale=$locale;
			$get_defaults=$this->find('first',array("conditions"=>array("SeoManagement.id"=>1)));

			Cache::write($cacheId, $get_defaults,'SeoManagement');
		}
		return $get_defaults;
		
	}
	
	function get_seo($modelName,$fieldId,$locale = "ara"){
		
		$cacheId = "seo_management{$modelName}_{$fieldId}_$locale";

		if(($get_defaults = Cache::read($cacheId,'SeoManagement')) === false){

			$cond=array();

			$this->locale=$locale;
			$get_defaults=$this->find('first',array("conditions"=>array("SeoManagement.model_name"=>$modelName,"SeoManagement.field_id"=>$fieldId)));


			if(empty($get_defaults)){
				$this->locale=$locale;
				$get_defaults=$this->find('first',array("conditions"=>array("SeoManagement.id"=>1)));
			}
			Cache::write($cacheId, $get_defaults,'SeoManagement');
		}
		return $get_defaults;
		
	}
	function get_slug($modelName,$fieldId,$locale = "ara"){
		
		$cacheId = "seo_management_slug_{$modelName}_{$fieldId}_$locale";

		if(($get_defaults = Cache::read($cacheId,'SeoManagement')) === false){

			$cond=array();

			$this->locale=$locale;
			$get_defaults=$this->find('first',array("conditions"=>array("SeoManagement.model_name"=>$modelName,"SeoManagement.field_id"=>$fieldId)));


			if(empty($get_defaults)){
				$this->locale=$locale;
				$get_defaults=$this->find('first',array("conditions"=>array("SeoManagement.id"=>1)));
			}
			Cache::write($cacheId, $get_defaults,'SeoManagement');
		}
		return $get_defaults['SeoManagement']['slug'];
		
	}
	
	
	function get_slug_about_us($locale = "ara"){
		
		$cacheId = "get_slug_about_us_$locale";

		if(($sections = Cache::read($cacheId,'SeoManagement')) === false){
					
				
			$newModelObj = ClassRegistry::init("Section");
			$newModelObj->locale = $locale;
			$newModelData = $newModelObj->find('all',array("contain"=>false,"fields"=>array("Section.id","Section.section"),"conditions"=>array('Section.section_id'=>0, "Section.section IN ('opening_hours' , 'overview', 'careers','articles','videos')")));
			
			$this->locale=$locale;
			
				
			$sections=array();
			foreach($newModelData as $sec){
				$section=$sec['Section']['section'];
				
				$section_id=$sec['Section']['id'];
				$get_defaults=$this->find('first',array(  
				
				"conditions"=>array("SeoManagement.model_name"=>"Section","SeoManagement.field_id"=>$section_id)
				,'fields'=>array("SeoManagement.slug")));
				
				
				$sections["$section"]=$get_defaults;
				
			}
			
			
			
			Cache::write($cacheId, $sections,'SeoManagement');
		}
		return $sections;
		
	}
	
	function beforeSave(){
		
		if (isset($this->data["SeoManagement"]["slug"])){
			$this->data["SeoManagement"]["slug"] = preg_replace("/[^a-zA-Z0-9-]/","",$this->data["SeoManagement"]["slug"]);
		}
		
		return $this->data;
	}
	
	
	function afterSave(){		
		Cache::clearGroup("dynamic_pages");
		Cache::clearGroup("seo_management");
	}
	
	function afterDelete(){
		Cache::clearGroup('seo_management');
	}
	
	
	
	
}
?>