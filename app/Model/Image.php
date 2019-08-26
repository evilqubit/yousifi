<?php 
class Image extends AppModel {
	var $name = "Image";
	var $useTable = 'images';
	var $actsAs = array("Containable","Translate"=>array("title","caption" ,"image"));
	var $translateModel = "ImageI18n";
	var $translateTable = "images_i18n";
	var $locale = "eng";
	var $cacheFolder = "images";
	
	
	 public $hasOne = array(
    			'PagesRelation'=>array("foreignKey"=>"related_id","join"=>"INNER","conditions"=>array("PagesRelation.related_model"=>"Image")
    ));
    
	function getPageRelations($locale = "eng",$page_id = 0,$pageModelName = "DynamicPage"){
 		
		$modelName = $this->name;
		
		$cacheId = "{$locale}_page_{$page_id}_{$modelName}relations";

		if((($relations = Cache::read($cacheId,"PagesRelation")) === false)){
			$this->locale = $locale;
			
			$contain = array("PagesRelation"=>array("conditions"=>array("PagesRelation.source_model"=>"$pageModelName","PagesRelation.source_id"=>$page_id,"PagesRelation.related_model"=>"$modelName")));
			$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
			
 			$relations = $this->find("all",array("contain"=>$contain,"conditions"=>array("PagesRelation.id > 0")));
 		
 			Cache::write($cacheId, $relations,"PagesRelation");	
		}
		
		return $relations;
 	}
 	
 	
 	function getAlbumImages($albumId,$locale){
 		$modelName = $this->name;
 		
 		$cacheId = "{$locale}_album_{$albumId}_images";

		if((($images = Cache::read($cacheId,"Images")) === false)){
			$this->locale = $locale;
			
			$contain = false;
			
 			$images = $this->find('all', 
 				array(
 					"conditions"=>array("$modelName.album_id"=>$albumId),
 					"contain"=>$contain,
 					"order"=>array("$modelName.position"=>"ASC","$modelName.id"=>"DESC")
 					)
 			);
 			
 			Cache::write($cacheId, $images,'Images');
		}
		
		return $images;
 	}
	
	 function get_related_images($module_name,$module_id,$locale){
 		$modelName = $this->name;
 		
 		$cacheId = "get_related_images_{$module_name}_{$module_id}_{$locale}";
		
		if((($images = Cache::read($cacheId,"Images")) === false)){
			$this->locale = $locale;
			
			$contain = false;
			
 			$images = $this->find('all', 
 				array(
 					'fields'=>array('Image.title','Image.id','Image.image','Image.url'),
 					'order'=>array("$modelName.position"=>"ASC","$modelName.id"=>'DESC'),
 					"conditions"=>array("$modelName.module_name"=>$module_name,"$modelName.module_id"=>$module_id,"$modelName.visible"=>1),
 					)
 			); 			
 			Cache::write($cacheId, $images,'Images');
		}
				
		return $images;
 	}
 	
	 function get_related_images_of_selected_type($module_name,$module_id  , $type , $limit,$locale){
 		$modelName = $this->name;
 		
 		$cacheId = "get_related_images_of_selected_type_{$module_name}_{$module_id}_{$type}_{$limit}_{$locale}";
		
		if((($images = Cache::read($cacheId,"Images")) === false)){
			$this->locale = $locale;
			
			$contain = false;
			
 			$images = $this->find('all', 
 				array(
 					'fields'=>array('Image.title','Image.id','Image.image','Image.url'),
 					// 'order'=>array("$modelName.position"=>"ASC","$modelName.id"=>'DESC'),
 					'order' => 'rand()',
 					'limit'=>$limit,
 					"conditions"=>array("$modelName.module_name"=>$module_name,"$modelName.module_id"=>$module_id,"$modelName.type"=>$type),
 					)
 			); 			
 			Cache::write($cacheId, $images,'Images');
		}
				
		return $images;
 	}
 	
 	
 	 function get_mobile_related_images_of_selected_type($module_name,$module_id  , $type ,$locale){
 		$modelName = $this->name;
 		
 		$cacheId = "get_mobile_related_images_of_selected_type_{$module_name}_{$module_id}_{$type}_{$locale}";
		
		
		if((($images = Cache::read($cacheId,"Images")) === false)){
			$this->locale = $locale;
			
			$contain = false;
			
 			$images = $this->find('all', 
 				array(
 					'fields'=>array('Image.title','Image.id','Image.image','Image.url'),
 					// 'order'=>array("$modelName.position"=>"ASC","$modelName.id"=>'DESC'),
 					'order' => 'rand()',
 					
 					"conditions"=>array("$modelName.module_name"=>$module_name,"$modelName.module_id"=>$module_id,"$modelName.type"=>$type),
 					)
 			); 			
 			Cache::write($cacheId, $images,'Images');
		}
				
		return $images;
 	}


 	
 	function afterSave(){
		Cache::clearGroup("albums");
		Cache::clearGroup("pages_relations");
	}
	
	function afterDelete(){
		Cache::clearGroup('albums');
		Cache::clearGroup("pages_relations");
	}
	
	// function getHomeImages($locale="eng"){
		// Cache::set(array('path' => CACHE.$this->cacheFolder));
		// $cacheId = "home_images_$locale";
// 
		// if(($data = Cache::read($cacheId)) === false){
// 			
			// $this->locale = $locale;
			// $data = $this->find("all",array("conditions"=>array("Image.visible"=>1,"Image.homepage"=>1),"contain"=>false,"order"=>array("Image.position"=>"ASC","Image.id"=>"DESC")));
// 			
			// Cache::write($cacheId, $data);
		// }
// 		
		// return $data;
	// }
}
?>