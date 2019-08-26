<?php
class Event extends AppModel{
	public $name = 'Event';
	public $useTable = 'events';
	public $actsAs = array("Containable","Translate"=>array("title","short","text"));
	public $translateModel = "EventI18n";
	public $translateTable = "events_i18n";
	public $cacheFolder = "events";
	public $locale = "eng";
	
//	public $validate = array("title","short","text");

    
   public $hasOne = array(
    			"SeoManagement"=>array('className' => 'SeoManagement','foreignKey' => 'field_id','dependent'=> true,"conditions"=>array("SeoManagement.model_name"=>"Event")),
    			//'PagesRelation'=>array("foreignKey"=>"related_id","join"=>"INNER","conditions"=>array("PagesRelation.related_model"=>"News")	
    //)
	);
// 		
	// var $belongsTo = array(
	// 'Video'=>array('className'=>'Video','foreignKey'=> 'video_id'),
	// 'Album'=>array('className'=>'Album','foreignKey'=> 'album_id'),
// 	
	// );
// 		
	
	


	// function getAllPage($locale = 'ara',$page_id=null){
// 			
			// $modelName = $this->name;
// 			
			// $cacheId = "{$locale}_{$page_id}_all_page";
// 	
			// if((($page = Cache::read($cacheId,"News")) === false)){
				// $this->locale = $locale;
// 	
				// $contain = array("SeoManagement");
				// $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
// 				
	 			// $page = $this->find('all', 
	 				// array(
	 					// "conditions"=>array("$modelName.id <> "=>$page_id,"$modelName.visible"=>1),
	 					// "contain"=>$contain
	 					// )
	 			// );
// 	 			
	 			// Cache::write($cacheId, $page,'News');
			// }
// 			
	 		// return $page;
	 	// }
	
	function getHomeEvent($locale = 'eng' , $limit=1){
			
			$modelName = $this->name;
			
			$cacheId = "{$locale}_getHomeEvent_{$limit}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement");
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('all', 
	 				array(
	 					"fields"=>array("$modelName.id","$modelName.title","$modelName.short","$modelName.start_date","$modelName.end_date", "SeoManagement.slug" ),
	 					"conditions"=>array("$modelName.visible"=>1),
	 					// "order"=>array("$modelName.start_date"=>'DESC',"$modelName.id"=>'DESC'),
	 					'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
	 					"limit"=>$limit,
	 					"contain"=>$contain
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	
	
		function get_event_details($event_id,$locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "{$locale}_get_event_details_{$event_id}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				// $contain = array("SeoManagement");
				// $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('first', 
	 				array(
	 					"fields"=>array("$modelName.id","$modelName.title","$modelName.short","$modelName.start_date","$modelName.end_date","$modelName.image" ),
	 					"conditions"=>array("$modelName.visible"=>1),
	 					// "order"=>array("$modelName.start_date"=>'DESC',"$modelName.id"=>'DESC'),
	 					// 'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
	 					// "limit"=>$limit,
	 					"contain"=>false
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	
	function getAllEvents($locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "{$locale}_getAllEvents";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement");
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('all', 
	 				array(
	 					"fields"=>array("$modelName.id","$modelName.title","$modelName.short","$modelName.image","$modelName.start_date","$modelName.end_date", "SeoManagement.slug" ),
	 					"conditions"=>array("$modelName.visible"=>1),
	 					// "order"=>array("$modelName.start_date"=>'DESC',"$modelName.id"=>'DESC'),
	 					'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
	 					
	 					"contain"=>$contain
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	
		// function getPageDetails($locale = 'eng' , $id){
// 			
			// $modelName = $this->name;
// 			
			// $cacheId = "{$locale}_news_details_{$id}";
// 	
			// if((($page = Cache::read($cacheId,"$modelName")) === false)){
				// $this->locale = $locale;
// 	
				// $contain = array("SeoManagement");
				// $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
// 				
	 			// $page = $this->find('first', 
	 				// array(
	 					// //"fields"=>array("$modelName.id","$modelName.title","$modelName.text","$modelName.date","$modelName.image","$modelName.fb_like"),
	 					// "conditions"=>array("$modelName.visible"=>1,"$modelName.id"=>$id),
	 					// "order"=>array(),
	 					// "contain"=>$contain
	 					// )
	 			// );
// 	 			
	 			// Cache::write($cacheId, $page,"$modelName");
			// }
// 			
	 		// return $page;
	 	// }
	
	// function getNewsDate($locale = 'eng'){
// 			
			// $modelName = $this->name;
// 			
			// $cacheId = "{$locale}_all_news_date";
// 	
			// if((($page = Cache::read($cacheId,"$modelName")) === false)){
				// $this->locale = $locale;
// 	
				// // $contain = array("SeoManagement");
				// // $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
// 				
	 			// $page = $this->find('list', 
	 				// array(
	 					// "fields"=>array("$modelName.id","$modelName.date"),
	 					// "conditions"=>array("$modelName.visible"=>1),
	 					// "order"=>array("$modelName.date"=>'DESC')
	 					// //"contain"=>$contain
	 					// )
	 			// );
// 	 			
	 			// Cache::write($cacheId, $page,"$modelName");
			// }
// 			
	 		// return $page;
	 	// }
	 	 /* Used in admin interface */
 	function getParentsList($currPageId = 0,$otherRelatedModels=array()){
 		$locale = $this->locale; 
 		$modelName = "News";
// 		$parentsList = $this->find("all",array("conditions"=>array("$modelName.id > 1","$modelName.parent_id"=>0,"$modelName.id != $currPageId"),"contain"=>array("SubPage"=>array("fields"=>array("SubPage.id","SubPage.title"),"conditions"=>array("SubPage.id != $currPageId"))),"fields"=>array("$modelName.id","$modelName.section","$modelName.title"),"order"=>array("$modelName.id"=>"ASC","$modelName.position"=>"ASC")));
			
 		$returnList = array();
// 		$returnList[$modelName] = $parentsList;

		
 		
 		if(!empty($otherRelatedModels)){
			foreach ($otherRelatedModels as $model=>$modelData) {
				$aliasModel = $model;
				
				// if($model == "Careers"){
					// continue;
				// }
				// if(!in_array($model,array("Banner","News","Event","Tender","SideBanner"))){
					// $modelCond = "$model.is_dynamic_page = 0";
				// }else{
					// $modelCond = "1=1";
// 					
					// if($model == "Banner"){
						// $modelCond = "$model.location = 'header'";
					// }
					// if($model == "SideBanner"){
						// $model = "Banner";
						// $modelCond = "$model.location != 'header'";
					// }
				// }
				$modelCond = "1=1";
				if($model == 'Album'){
					$modelCond=array("$model.type"=>'default');
				}
				
				$newModelObj = ClassRegistry::init($model);
				$newModelObj->locale = $locale;
				$newModelData = $newModelObj->find('list',array("contain"=>false,"fields"=>array("$model.id","$model.title"),"conditions"=>array($modelCond)));
				
				$returnList[$aliasModel] = $newModelData;
			}
		}
		
 		return $returnList;
 	}
	
	function afterSave(){
		Cache::clearGroup("$this->cacheFolder");
	}
	
	function afterDelete(){
		Cache::clearGroup("$this->cacheFolder");
	}
 	
}