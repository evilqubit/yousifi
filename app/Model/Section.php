<?php
class Section extends AppModel{
	public $name = 'Section';
	public $useTable = 'sections';
	public $actsAs = array("Containable","Translate"=>array("title","internal_title","text_1",'text_2','text_3' ,'image','file'));
	//
	public $translateModel = "SectionI18n";
	public $translateTable = "sections_i18n";
	public $cacheFolder = "sections";
	public $locale = "eng";
	
	public $template_list=array("1"=>"Template 1","2"=>"Template 2");
	
//	public $validate = array("title","short","text");

    
   public $hasOne = array(
    			"SeoManagement"=>array('className' => 'SeoManagement','foreignKey' => 'field_id','dependent'=> true,"conditions"=>array("SeoManagement.model_name"=>'Section'))    			
    );
	
	
	
	public $hasMany = array(
		'Category' => array('className' => 'Category','foreignKey' => 'section_id','dependent'=> true),
		'Shop' => array('className' => 'Shop','foreignKey' => 'section_id','dependent'=> true),
		//'PagesRelation'=>array('className' => 'PagesRelation' ,"foreignKey"=>"source_id","conditions"=>array("PagesRelation.related_model"=>"DynamicPage"))
						   
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
	
	
	
	
	function get_main_sections($locale){
		$modelName = $this->name;
			
			$cacheId = "get_main_sections_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement" );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('all', 
	 				array(
	 					"fields"=>array("$modelName.id", "$modelName.title", "$modelName.section","$modelName.color"  ,"SeoManagement.*"),
	 					"conditions"=>array("$modelName.section IN ('shop','dine','entertain')"),
	 					//"order"=>array("$modelName.homepage"=>'DESC',"$modelName.date"=>'DESC'),
	 					//"limit"=>6,
	 					"contain"=>$contain
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	}
	
	
	function get_main_sections_with_category($locale){
		$modelName = $this->name;
			
			$cacheId = "get_main_sections_with_category_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array('SeoManagement' , "Category"=>array( "fields"=>array("Category.id","Category.title")) , "Shop"=>array("fields"=>array("Shop.id","Shop.title","Shop.category_id")) );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('all', 
	 				array(
	 					"fields"=>array("$modelName.id", "$modelName.title", "$modelName.section","$modelName.color",'SeoManagement.slug'  ),
	 					"conditions"=>array("$modelName.section IN ('shop','dine','entertain')"),
	 					//"order"=>array("$modelName.homepage"=>'DESC',"$modelName.date"=>'DESC'),
	 					//"limit"=>6,
	 					"contain"=>$contain
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
			//print_R($page);exit;
	 		return $page;
	}
	
	
	function get_article_date_category_list($locale){
		$modelName = $this->name;			
		$cacheId = "get_article_date_category_list_{$locale}";

		if((($categoris = Cache::read($cacheId,"$modelName")) === false)){
			$this->locale = $locale;

			// $contain = array("SeoManagement" );
			// $contain = $this->generateContainableTranslations($modelName,$contain,$locale);
			//"$modelName.position"=>'ASC',
 			$page = $this->find('list', 
 				array(
 					"fields"=>array("$modelName.id", "$modelName.date"),
 					"conditions"=>array("$modelName.section"=>"articles","$modelName.visible"=>1,"$modelName.section_id >"=>0),
 					"order"=>array("$modelName.date"=>'DESC',"$modelName.id"=>'DESC'),
 					//"limit"=>6,
 					"contain"=>false
 					)
 			);
 			
 			$categoris=array();
 			foreach($page as $p){
 				$date=explode('-', $p);
				$year=$date[0];
				$month=$date[1];
				$month=ltrim($month ,0);
				$categoris["$year"][$month]=$month;
 			}
 			//print_r($categoris);exit;
 			//Cache::write($cacheId, $categoris,"$modelName");
		}
		
 		return $categoris;
	}
	
	
	function get_section_details($section, $locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "get_section_details_{$section}_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement" );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('first', 
	 				array(
	 					"fields"=>array("$modelName.*" ,"SeoManagement.*"),
	 					"conditions"=>array("$modelName.section"=>$section,"$modelName.section_id"=>0),
	 					//"order"=>array("$modelName.homepage"=>'DESC',"$modelName.date"=>'DESC'),
	 					//"limit"=>6,
	 					"contain"=>$contain
	 					)
	 			);	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}			
	 		return $page;
	 	}
	
	function get_list_of_selectes_section($section, $locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "get_list_of_selectes_section_{$section}_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement" );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('all', 
	 				array(
	 				
	 					"fields"=>array("$modelName.id","$modelName.section_id","$modelName.section","$modelName.title","$modelName.internal_title","$modelName.text_1",
						"$modelName.text_2","$modelName.text_3","$modelName.image","$modelName.color","$modelName.text_color","$modelName.video_type",
						"$modelName.youtube","$modelName.youtube_image","$modelName.youtube_image","$modelName.file","$modelName.x_coordinate","$modelName.y_coordinate","$modelName.date"
						),
	 					"conditions"=>array("$modelName.section"=>$section ,"$modelName.section_id >"=>0,"$modelName.visible"=>1),
	 					"order"=>array("$modelName.position"=>'ASC',"$modelName.id"=>'DESC'),
	 					//"limit"=>6,
	 					"contain"=>false
	 					)
	 			);	 			
	 		Cache::write($cacheId, $page,"$modelName");
			}			
	 		return $page;
	 	}
		function get_section_by_id_details($section_id, $locale = 'eng'){
			
			$modelName = $this->name;
			
			$cacheId = "get_section_by_id_details_{$section_id}_{$locale}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement" );
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				//"$modelName.position"=>'ASC',
	 			$page = $this->find('first', 
	 				array(
	 					"fields"=>array("$modelName.*" ,"SeoManagement.*"),
	 					"conditions"=>array("$modelName.id"=>$section_id),
	 					//"order"=>array("$modelName.homepage"=>'DESC',"$modelName.date"=>'DESC'),
	 					//"limit"=>6,
	 					"contain"=>$contain
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
		function getPageDetails($locale = 'eng' , $id){
			
			$modelName = $this->name;
			
			$cacheId = "{$locale}_news_details_{$id}";
	
			if((($page = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement");
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				
	 			$page = $this->find('first', 
	 				array(
	 					//"fields"=>array("$modelName.id","$modelName.title","$modelName.text","$modelName.date","$modelName.image","$modelName.fb_like"),
	 					"conditions"=>array("$modelName.visible"=>1,"$modelName.id"=>$id),
	 					"order"=>array(),
	 					"contain"=>$contain
	 					)
	 			);
	 			
	 			Cache::write($cacheId, $page,"$modelName");
			}
			
	 		return $page;
	 	}
	
	
	
	function getSectionSlugs($locale = 'eng' ){
			
			$modelName = $this->name;
			
			$cacheId = "{$locale}_getSectionSlugs";
	
			if((($slugs = Cache::read($cacheId,"$modelName")) === false)){
				$this->locale = $locale;
	
				$contain = array("SeoManagement"=>array('fields'=>array("SeoManagement.slug")));
				$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
				
				$sections="'shop','dine', 'entertain' , 'overview', 'services', 'store_locator','get_here' ,'privacy' ,'terms_conditions' ,'sitemap','contact'";
				
	 			$page = $this->find('all', 
	 				array(
	 					"fields"=>array("$modelName.id","$modelName.section"),
	 					"conditions"=>array("$modelName.section_id"=>0,"$modelName.section IN ($sections)"),
	 					"order"=>array(),
	 					"contain"=>$contain
	 					)
	 			);
	 			
				
				$slugs=array();
				foreach($page  as $s){
					$section=$s['Section']['section'];
					$slug=$s['SeoManagement']['slug'];
					$slugs[$section]=$slug;
				}
				
	 			Cache::write($cacheId, $slugs,"$modelName");
			}
			
	 		return $slugs;
	 	}
	
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