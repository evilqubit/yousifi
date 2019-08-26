<?php 
class Banner extends AppModel {
	var $name = "Banner";
	var $useTable = 'banners';
	public $actsAs = array("Containable","Translate"=>array("title",'text','image' ,'url'));
	//
	public $translateModel = "BannerI18n";
	public $translateTable = "banners_i18n";
	
	var $cacheFolder = "banners";
	
	
	 public $hasOne = array(
    			//'PagesRelation'=>array("foreignKey"=>"related_id","join"=>"INNER","conditions"=>array("PagesRelation.related_model"=>"Background")
    //)
	);
	
	var $belongsTo = array(
		//'Section'=>array('className'=>'Section','foreignKey'=> 'section_id'),
		//'Album'=>array('className'=>'Album','foreignKey'=> 'album_id'),	
	);
	
	
	function get_home_banners($locale = 'ara'){
		$modelName = $this->name;
		$cacheId = "get_home_banners_$locale";
		if(($data = Cache::read($cacheId,$modelName)) === false){
			$this->locale=$locale;
			$data=$this->find('all',
			
			array("conditions"=>array("$modelName.visible"=>1 , "$modelName.section"=>'home'),
			"fields"=>array("$modelName.id","$modelName.title","$modelName.text","$modelName.image","$modelName.url"),
			"order"=>array("$modelName.position"=>"ASC","$modelName.id"=>"DESC"),
			'contain'=>false,
			));
			

			//Cache::write($cacheId, $data, $modelName);
		}
		return $data;
	}
	
	
	
	
	function get_home_other_category($locale){
		$modelName = $this->name;
		$cacheId = "get_home_other_category_{$locale}";
		
		if((($data = Cache::read($cacheId,"$modelName")) === false)){
			
			// $contain = array(
			// "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));
// 			
			//$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
			$this->locale = $locale;
		
			$data = $this->find('all' ,array("fields"=>array("$modelName.id","$modelName.title","$modelName.url","$modelName.image" ,"$modelName.text"), 
			'contain'=>false , 'conditions'=>array("$modelName.section"=>'categories' , "$modelName.visible"=>1 ),'order' => array("$modelName.position"=> 'ASC', "$modelName.id DESC")));
			
			//Cache::write($cacheId, $data,"$modelName");
		}
		
		//print_r($data);exit;	
 		return $data;
 	}
 	
	
	function get_home_middle_banner($locale){
		$modelName = $this->name;
		$cacheId = "get_home_middle_banner_{$locale}";
		
		if((($data = Cache::read($cacheId,"$modelName")) === false)){
			
			// $contain = array(
			// "SeoManagement"=>array("fields"=>array("SeoManagement.id","SeoManagement.slug")));
// 			
			//$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
			$this->locale = $locale;
		
			$data = $this->find('all' ,array(
			'limit'=>4,
			"fields"=>array("$modelName.id","$modelName.title","$modelName.url","$modelName.image" ), 
			'contain'=>false , 'conditions'=>array("$modelName.section"=>'middle' , "$modelName.visible"=>1 ),'order' => array("$modelName.position"=> 'ASC', "$modelName.id DESC")));
			
			//Cache::write($cacheId, $data,"$modelName");
		}
		
		//print_r($data);exit;	
 		return $data;
 	}
 	
	
	function get_first_banners_of_selected_section($section,$locale = 'ara'){
		$modelName = $this->name;
		$cacheId = "get_first_banners_of_selected_section_{$section}_$locale";
		if(($data = Cache::read($cacheId,$modelName)) === false){
			$this->locale=$locale;
			$data=$this->find('first',
			
			array("conditions"=>array("$modelName.visible"=>1 , "$modelName.section"=>"$section"),
			"fields"=>array("$modelName.*"),
			"order"=>array("$modelName.position"=>"ASC","$modelName.id"=>"DESC"),
			'contain'=>false,
			));

			Cache::write($cacheId, $data, $modelName);
		}
		return $data;
	}
	
	
	function get_home_right_banners($locale = 'ara'){
		$modelName = $this->name;
		$cacheId = "get_home_right_banners_$locale";
		if(($data = Cache::read($cacheId,$modelName)) === false){
			$this->locale=$locale;
			$data=$this->find('all',
			
			array("conditions"=>array("$modelName.visible"=>1 , "$modelName.section"=>"home_right_b"),
			"fields"=>array("$modelName.*"),
			"order"=>array("$modelName.position"=>"ASC","$modelName.id"=>"DESC"),
			'contain'=>false,
			));

			Cache::write($cacheId, $data, $modelName);
		}
		return $data;
	}
	
	
	
	function afterSave(){
		Cache::clearGroup($this->cacheFolder);
	}
	
	function afterDelete(){
		Cache::clearGroup($this->cacheFolder);
	}
	
}
?>