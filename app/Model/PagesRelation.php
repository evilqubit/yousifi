<?php
class PagesRelation extends AppModel
{
	
	public $name = 'PagesRelation';
	public $useTable = 'pages_relations';
	public $actsAs = array("Containable");
	public $cacheFolder = "pages_relations";
	public $locale = "eng";

	 public $belongsTo = array(
    			"Image"=>array('className' => 'Image','foreignKey' => 'related_id','dependent'=> true)
    				
    );
	
	
	function getHomeNewsEvent($locale = 'ara'){
		
		$modelName = $this->name;
		
		$cacheId = "{$locale}_home_news";

		if((($page = Cache::read($cacheId,"$modelName")) === false)){
			$this->locale = $locale;
			//"SeoManagement"
			$contain = array();
			//$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
			
			$fields=array("News.id","News.title","News.short","News.date","News.home_image",
						  "Event.id","Event.title","Event.short","Event.date","Event.home_image" , "NewsEvent.section","SeoManagement.slug" );
				
				
			// $this->loadModel("News");		  
			// $this->News->bindModel(
				        // array('hasOne' => array(
// 				        		
								// "SeoManagement"=>array('className' => 'SeoManagement'),
				            // )
				        // )
				    // );
					
			$joins = array(
			
					
					array('table' => 'news',
						'alias' => 'News',
						'type' => 'left',
						'conditions' => array(
							'News.id = NewsEvent.news_id',
							'NewsEvent.section' => 'news'
						)
					)
					,
					array('table' => 'events',
						'alias' => 'Event',
						'type' => 'left',
						'conditions' => array(
							'Event.id = NewsEvent.event_id',
							'NewsEvent.section' => 'event'
						)
					),
					array('table' => 'seo_managements',
						'alias' => 'SeoManagement',
						'type' => 'left',
						'conditions' => array(
							'OR'=>array(
								array(
								"SeoManagement.model_name" =>'News',
								
								'SeoManagement.field_id = News.id' ,
								),
								
								array(
								"SeoManagement.model_name" =>'Event',
								
								'SeoManagement.field_id = Event.id',)
								)
							
						)
					)
					
				);
 			$page = $this->find('all', 
 				array(
 					"conditions"=>array(),
 					'fields'=>$fields,
 					
 					"contain"=>$contain,
 					'order' => array("$modelName.position" => 'ASC',"$modelName.date" => 'DESC',"$modelName.id" => 'DESC'),
 					'joins'=>$joins
 					)
 			);
 			
 			Cache::write($cacheId, $page,"$modelName");
		}
		
 		return $page;
 	}
	
	
	//used 
	function getImagesVideos($locale = "eng",$page_id = 0,$pageModelName = "DynamicPage"){
		
		$modelName = $this->name;
		
		$cacheId = "{$locale}_images_videos_{$page_id}_$pageModelName";

		if((($page = Cache::read($cacheId,"$modelName")) === false)){
			$this->locale = $locale;
			//"SeoManagement"
			$contain = array();
			//$contain = $this->generateContainableTranslations($modelName,$contain,$locale);
			
			$fields=array("Image.id","Image.title","Image.image",
						  "Video.id","Video.title","Video.video","Video.video_url","Video.type","Video.image" , "PagesRelation.*" );
				
				
			// $this->loadModel("News");		  
			// $this->News->bindModel(
				        // array('hasOne' => array(
// 				        		
								// "SeoManagement"=>array('className' => 'SeoManagement'),
				            // )
				        // )
				    // );
					
			$joins = array(

					array('table' => 'images',
						'alias' => 'Image',
						'type' => 'left',
						'conditions' => array(
							'Image.id = PagesRelation.related_id',
							'PagesRelation.related_model' => 'Image'
						)
					)
					,
					array('table' => 'videos',
						'alias' => 'Video',
						'type' => 'left',
						'conditions' => array(
							'Video.id = PagesRelation.related_id',
							'PagesRelation.related_model' => 'Video'
						)
					)
					
				);
 			$page = $this->find('all', 
 				array(
 					"conditions"=>array("$modelName.source_id"=>"$page_id","$modelName.source_model"=>"$pageModelName" ,
 					"OR"=>array(array("$modelName.related_model"=>"Image"),array("$modelName.related_model"=>"Video"))),
 					'fields'=>$fields,
 					
 					"contain"=>$contain,
 					'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
 					'joins'=>$joins
 					)
 			);
 			
 			Cache::write($cacheId, $page,"$modelName");
		}
		
 		return $page;
 	}
	
	

 	

}
?>