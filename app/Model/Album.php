<?php
class Album extends AppModel{
	public $name = 'Album';
	public $useTable = 'albums';
	public $actsAs = array("Containable","Translate"=>array("title"));
	public $translateModel = "AlbumI18n";
	public $translateTable = "albums_i18n";
	public $cacheFolder = "albums";
	public $locale = "eng";
	
//	public $validate = array("title","short","text");

    
    var $hasOne = array("SeoManagement"=>array('className' => 'SeoManagement','foreignKey' => 'field_id','conditions'=>array('SeoManagement.model_name'=>'Album'),'dependent'=> true));
	var $hasMany = array(
		'Image'=>array('className'=>'Image','foreignKey'=>'album_id','conditions'=>array(),'dependent'=>true),
	);

	
	function album_details($albumId ,$locale){
		$cacheFolder = $this->cacheFolder;
		$name = $this->name;
		Cache::set(array('path' => CACHE."$cacheFolder"));
		$cacheId = "{$locale}_album_{$albumId}";
		
		if(($album_details = Cache::read($cacheId)) === false){
			$this->locale = $locale;
 			$album_details = $this->find('first', array("conditions"=>array("$name.id"=>$albumId )));
			
 			Cache::write($cacheId, $album_details);
		}	
 		return $album_details;	
	}
	

	
	function get_home_details($locale){
		$cacheFolder = $this->cacheFolder;
		$name = $this->name;
		Cache::set(array('path' => CACHE."$cacheFolder"));
		$cacheId = "{$locale}_get_home_details";
		
		if(($album_details = Cache::read($cacheId)) === false){
			$this->locale = $locale;
 			$album_details = $this->find('first', array(
 			'contain'=>array("Image"=>array('conditions'=>array("Image.home_page"=>1) , 'order'=>array("Image.created"=>"ASC") , 'limit'=>3)),
			
 			"conditions"=>array("$name.type"=>'home' ,"$name.visible"=>1  ) ,
			'order'=>array("$name.position"=>'ASC')
			));
			
			//print_r($album_details);exit;
 			Cache::write($cacheId, $album_details);
		}	
 		return $album_details;	
	}
	function get_home_Album_images($album_id,$locale){
		$cacheFolder = $this->cacheFolder;
		$name = $this->name;
		Cache::set(array('path' => CACHE."$cacheFolder"));
		$cacheId = "{$locale}_get_home_Album_images_{$album_id}";
		
		if(($album_details = Cache::read($cacheId)) === false){
			$this->locale = $locale;
 			$album_details = $this->find('first', array(
 			'contain'=>array("Image"=>array('order'=>array("Image.created"=>"ASC"))),
			
 			"conditions"=>array("$name.id"=>$album_id ,"$name.visible"=>1  ) ,
			'order'=>array("$name.position"=>'ASC')
			));
			
			//print_r($album_details);exit;
 			Cache::write($cacheId, $album_details);
		}	
 		return $album_details;	
	}
	
	function getPage($locale = 'eng', $page_id = 0){
		$cacheFolder = $this->cacheFolder;
		$name = $this->name;
		Cache::set(array('path' => CACHE."$cacheFolder"));
		$cacheId = "{$locale}_page_$page_id";

		if(($page = Cache::read($cacheId)) === false){
			$this->locale = $locale;
 			$page = $this->find('first', 
 				array(
 					"conditions"=>array("$name.id"=>$page_id,"$name.visible"=>1,"$name.visible_from <="=>date("Y-m-d"),"OR"=>array("$name.visible_to >="=>date("Y-m-d"),"$name.visible_to"=>NULL)),
 					"contain"=>array("Album"=>array("Image"),"SubPage","RelatedDynamicPage")
 					)
 			);
 			
 			Cache::write($cacheId, $page);
		}
 		return $page;
 	}
 	
 	function getAllPagesWithChildren($locale = 'eng'){
 		$cacheFolder = $this->cacheFolder;
 		$name = $this->name;
		Cache::set(array('path' => CACHE."$cacheFolder"));
		$cacheId = "{$locale}_all_pages_with_children";
		
		if(($all_pages = Cache::read($cacheId)) === false){
			$this->locale = $locale;
 			$all_pages = $this->find("threaded",array("contain"=>array("RelatedDynamicPage")));
 			
 			Cache::write($cacheId, $all_pages);
		}
 		return $all_pages;
 	}
 	function afterSave(){

		Cache::clearGroup("albums");
		Cache::clearGroup("relations");
	}
	
	function afterDelete(){

		Cache::clearGroup('albums');
	}
}