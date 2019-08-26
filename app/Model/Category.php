<?php
class Category extends AppModel{
	public $name = 'Category';
	public $useTable = 'categories';
	public $actsAs = array("Containable","Translate"=>array("title"));
	//
	public $translateModel = "CategoryI18n";
	public $translateTable = "categories_i18n";
	public $cacheFolder = "categories";
	public $locale = "eng";
	
//	public $validate = array("title","short","text");

    
   public $hasOne = array(
    	"SeoManagement"=>array('className' => 'SeoManagement','foreignKey' => 'field_id','dependent'=> true,"conditions"=>array("SeoManagement.model_name"=>'Category'))
    			
    );
// 		
	var $belongsTo = array(
		//'DynamicPage'=>array('className'=>'DynamicPage','foreignKey'=> 'category_id'),
		//'Album'=>array('className'=>'Album','foreignKey'=> 'album_id'),
	
	);
	
	
	
	public $hasMany = array(
		'DynamicPage' => array('className' => 'DynamicPage','foreignKey' => 'category_id','dependent'=> true),
	// 'MapLocator'=>array('className'=>'MapLocator','foreignKey'=>'category_id','dependent'=>true)				   
	);	
		
	
	


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
	
	
	
	
	function get_home_categories($locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "get_home_categories_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
				
				
				$newModelObj = ClassRegistry::init("Section");
				$newModelObj->locale = $locale;
				$newModelData = $newModelObj->find('first',array("contain"=>false,"fields"=>array("Section.id","Section.title","Section.color"),"conditions"=>array("Section.section"=>'entertain')));
				
				
				//print_r($newModelData);exit;
				
				$passedCategs = array();
				
				$order='';
				$i18_order='';
				$joins='';
				if($locale == 'en'){
					$order=array("Section.id"=>'ASC' , "$modelName.position"=>'ASC',"$modelName.id"=>'DESC');
				}else{
					$i18_order=array("I18n__title.content"=>'ASC');
					$joins= array(
				     array('table' => 'categories_i18n',
				        'alias' => 'CategoryI18n',
				        'type' => 'INNER',
				        'conditions' => array(
				            'CategoryI18n.foreign_key= Category.id',
				            'CategoryI18n.locale'=>$locale
				            
				        ),
				        'order'=>$i18_order
		   			 ));
				 	$order=array("I18n__title.content"=>'ASC');
				}
				
				
			 
				
				
				
				$contain = array('Section'=>array("fields"=>array("Section.title" , "Section.color")));
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				
	 			$d = $this->find('all', 
	 				array(
	 					'joins'=>$joins,
	 					"fields"=>array("DISTINCT  $modelName.id","$modelName.title","$modelName.section_id" ),
	 					
	 					//"conditions"=>array("$modelName.visible"=>1 , "$modelName.section_id"=>1),
	 					"order"=>$order,
	 					// "limit"=>6,
	 					"contain"=>$contain
	 					)
	 			);
	 		
	 		
	 			//print_R($d);exit;
	 			
	 			$index=0;
	 			foreach($d as $data){
	 				$section_id=$data['Section']['id'];
					$section_title=$data['Section']['title'];
					$page[$section_id]['section']['id']=$section_id;
					$page[$section_id]['section']['title']=$section_title;
					$page[$section_id]['section']['color']=$data['Section']['color'];;
					
//					if(!isset($page[$section_id]))
//						$page[$section_id]['categories']["$index"]=$data['Category'];
						
					if(!isset($passedCategs[$data['Category']["id"]])){
						$page[$section_id]['categories']["$index"]=$data['Category'];
						$passedCategs[$data['Category']["id"]] = $data['Category']["id"];
					}
					
					$index++;
	 			}
				
				
				
				$contain = array('Section'=>array("fields"=>array("Section.title" , "Section.color")));
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				
	 			$d = $this->find('all', 
	 				array(
	 				'join'=>$joins,
	 					"fields"=>array("$modelName.id","$modelName.title","$modelName.section_id" ),
	 					
	 					"conditions"=>array("$modelName.visible"=>1 , "$modelName.section_id"=>2),
	 					"order"=>$order,
	 					// "limit"=>6,
	 					"contain"=>$contain
	 					)
	 			);
	 		
	 			//print_R($d);exit;
	 			
	 			
	 			foreach($d as $data){
	 				$section_id=$data['Section']['id'];
					$section_title=$data['Section']['title'];
					$page[$section_id]['section']['id']=$section_id;
					$page[$section_id]['section']['title']=$section_title;
					$page[$section_id]['section']['color']=$data['Section']['color'];;
					
					if(!isset($passedCategs[$data['Category']["id"]])){
						$page[$section_id]['categories']["$index"]=$data['Category'];
						$passedCategs[$data['Category']["id"]] = $data['Category']["id"];
					}
					
					$index++;
	 			}
				
					
//	 			echo "<pre>";
//	 		print_r($page);
//	 		echo "</pre>";exit;
//	 			
				
				$page[3]['section']=$newModelData['Section'];
	 			
	 			//Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	
	
	function GetCategoryListOfSelectedSection($section_id, $locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "GetCategoryListOfSelectedSection_new_{$section_id}_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement" ,'Section' );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
				
				
				$order='';
				$i18_order='';
				$joins='';
				if($locale == 'en'){
					$order=array("$modelName.position"=>'ASC',"$modelName.id"=>'DESC');
				}else{
					$i18_order=array("I18n__title.content"=>'ASC');
					$joins= array(
				     array('table' => 'categories_i18n',
				        'alias' => 'CategoryI18n',
				        'type' => 'INNER',
				        'conditions' => array(
				            'CategoryI18n.foreign_key= Category.id',
				            'CategoryI18n.locale'=>$locale
				            
				        ),
				        'order'=>$i18_order
		   			 ));
				 	$order=array("I18n__title.content"=>'ASC');
				}
				
				
				
				
	 			$page = $this->find('all', 
	 				array(
	 					"fields"=>array("$modelName.id","$modelName.title","$modelName.image","$modelName.section_id","SeoManagement.slug" ,'Section.section'   ),
	 					
						'joins'=>$joins,						
	 					"conditions"=>array("$modelName.visible"=>1 , "$modelName.section_id"=>$section_id),
	 					"order"=>$order,
	 					// "limit"=>6,
	 					"contain"=>$contain
	 					)
	 			);
	 			
				//print_r($page);exit;
				
	 			//Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	
	
	
	function GetCategoryListOfSelectedSectionId($section_id, $locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "GetCategoryListOfSelectedSectionId_{$section_id}_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement" ,'Section' );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('list', 
	 				array(
	 					"fields"=>array("$modelName.id","$modelName.title"),
	 					
	 					"conditions"=>array("$modelName.visible"=>1 , "$modelName.section_id"=>$section_id),
	 					"order"=>array("$modelName.position"=>'ASC',"$modelName.id"=>'DESC'),
	 					// "limit"=>6,
	 					"contain"=>false
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	function GetCategoryDetails($id, $locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "GetCategoryDetails_{$id}_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement" );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('first', 
	 				array(
	 					"fields"=>array("$modelName.id","$modelName.title","$modelName.image","$modelName.section_id","SeoManagement.*"    ),
	 					
	 					"conditions"=>array("$modelName.id"=>$id),
	 					//"order"=>array("$modelName.position"=>'ASC',"$modelName.id"=>'DESC'),
	 					// "limit"=>6,
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
		Cache::clearGroup("dynamic_pages");
		
	}
	
	function afterDelete(){
		Cache::clearGroup("$this->cacheFolder");
		Cache::clearGroup("dynamic_pages");
	}
 	
}