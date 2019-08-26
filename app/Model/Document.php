<?php
class Document extends AppModel{
	public $name = 'Document';
	public $useTable = 'documents';
	public $actsAs = array("Containable","Translate"=>array("title","document","download_title"));
	public $translateModel = "DocumentI18n";
	public $translateTable = "documents_i18n";
	public $cacheFolder = "documents";
	public $locale = "eng";
	
//	public $validate = array("title","short","text");

    
   // public $hasOne = array(
    			// "SeoManagement"=>array('className' => 'SeoManagement','foreignKey' => 'field_id','dependent'=> true,"conditions"=>array("SeoManagement.model_name"=>"News")),
    			// 'PagesRelation'=>array("foreignKey"=>"related_id","join"=>"INNER","conditions"=>array("PagesRelation.related_model"=>"News")	
    // ));
// 		
	// var $belongsTo = array(
	// 'Video'=>array('className'=>'Video','foreignKey'=> 'video_id'),
	// 'Album'=>array('className'=>'Album','foreignKey'=> 'album_id'),
// 	
	// );
// 		
	
	


	function getAllRelatedDocuments($locale = 'eng',$page_id=null){
			
			$modelName = $this->name;
			
			$cacheId = "{$locale}_{$page_id}_all_related_documents";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array();
				//$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				
	 			$page = $this->find('all', 
	 				array(
	 					"conditions"=>array("$modelName.dynamic_pages_id"=>$page_id,"$modelName.visible"=>1),
	 					//"contain"=>$contain
	 					'order'=>array("$modelName.position"=>'ASC',"$modelName.created"=>'DESC')
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	function getAllRelatedDocumentsForRelatedPages($locale = 'eng',$page_id=null){
		
		$modelName = $this->name;
		
		$cacheId = "{$locale}_{$page_id}_getAllRelatedDocumentsForRelatedPages";

		if((($page = Cache::read($cacheId,"$modelName")) === false)){
			$this->locale = $locale;

			$contain = array();
			//$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
			
 			$page = $this->find('all', 
 				array(
 					"conditions"=>array("$modelName.dynamic_pages_id"=>0,"$modelName.related_page_id"=>$page_id,"$modelName.visible"=>1),
 					//"contain"=>$contain
 					'order'=>array("$modelName.position"=>'ASC',"$modelName.created"=>'DESC')
 					)
 			);
 			
 			Cache::write($cacheId, $page,"$modelName");
		}
		
 		return $page;
 	}
	function getAllRelatedDocumentsForSelectedType($locale = 'eng',$page_id=null , $type){
			
			$modelName = $this->name;
			
			$cacheId = "{$locale}_{$page_id}_all_related_documents_for_selected_type_{$type}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array();
				//$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				
	 			$page = $this->find('all', 
	 				array(
	 					"conditions"=>array("$modelName.dynamic_pages_id"=>$page_id,"$modelName.visible"=>1 ,"$modelName.type"=>$type),
	 					'order'=>array("$modelName.position"=>'ASC',"$modelName.created"=>'DESC')
	 					//"contain"=>$contain
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}

	
	function afterSave(){
		Cache::clearGroup("$this->cacheFolder");
		
	}
	
	function afterDelete(){
		Cache::clearGroup("$this->cacheFolder");
	}
 	
}