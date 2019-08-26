<?php
class Media extends AppModel{
	public $name = 'Media';
	public $useTable = 'media';
	
	public $actsAs = array("Containable");
	
	// public $translateModel = "MediaI18n";
	// public $translateTable = "media_i18n";
	public $cacheFolder = "media";
	public $locale = "eng";
	
	
	public $displayField = 'title';


  //Images Default
    public $image_folder_name = '/files/media/images';
    public $audio_folder_name = "/files/media/audio";
	public $video_folder_name = "/files/media/videos";
	public $doc_folder_name = "/files/media/docs";
							                
  //Video Default 

		
	    	
	  
	
// public function __construct($id = false, $table = null, $ds = null) {
//     
    // parent::__construct($id, $table, $ds);
//     
    // $this->cover_resize_options = array(
											// 'Thumb'=>array('folder'=>WWW_ROOT.$this->cover_folder_name."/thumb",'width'=>200,'height'=>200,'force'=>false),
											// 'Preview'=>array('folder'=>WWW_ROOT.$this->cover_folder_name."/preview",'width'=>600,'height'=>600,'force'=>false),
							                // );
// 							                
	// $this->image_resize_options = array(
											// 'Thumb'=>array('folder'=>WWW_ROOT.$this->image_folder_name."/thumb",'width'=>200,'height'=>200,'force'=>false),
											// 'Preview'=>array('folder'=>WWW_ROOT.$this->image_folder_name."/preview",'width'=>600,'height'=>600,'force'=>false),
							                // );	
// 							                	
// 					
// 					
// 					
	// }
		


	
public function beforeDelete($cascade = true) {

	// $error = 1;
    // $media = $this->findById($this->id);
//      
    // if($media['Media']['type'] == 'image'){
// 						
		  // $file = WWW_ROOT.$media['Media']['dir']."/".$media['Media']['imagename'];
// 		   
		  // if(!unlink($file)){$error = 0;}
// 
// 		    
		  // foreach($this->image_resize_options as $resize){
// 		    
		    	// $file = $resize['folder']."/".$media['Media']['imagename'];
				// if(!unlink($file)){$error = 0;}
		     // }
// 						
	// }
// 					   
// 					   	
// if($media['Media']['type'] == 'video'){
// 	
			// $files=array();
// 			
			// if(isset($media['Media']['videoUrl'])){
// 			    
			    // $file = WWW_ROOT.$media['Media']['videoUrl'];
			    // if(!unlink($file)){$error = 0;}
		    // }
		    // if(isset($media['Media']['imagename'])){
// 	                  
// 	                  
// 	                  
	                   // foreach($this->cover_resize_options as $resize){
// 						    
						    	// $file = $resize['folder']."/".$media['Media']['imagename'];
// 						    
								// if(!unlink($file)){$error = 0;}
						    						   // }
// 	
// 	
	// } 
// }
// 
	// if($media['Media']['type'] == 'doc'){
// 	
// 			
// 			
// 			    
		    // $files['doc'] = WWW_ROOT.$media['Media']['docUrl'];
// 		   
// 		  
// 		   
		   // foreach($files as $file){if(!unlink($file)){ $error = 0; }}
// }
	// if($media['Media']['type'] == 'audio'){
// 	
// 			
// 			
// 			    
		    // $files['doc'] = WWW_ROOT.$media['Media']['audioUrl'];
// 		   
// 		  
// 		   
		   // foreach($files as $file){if(!unlink($file)){ $error = 0; }}
// }
// 
// 
// return $error;
       
}	
	
	
	 function get_related_images($module_name,$module_id,$locale){
 		$modelName = $this->name;
 		
 		$cacheId = "get_related_images_{$module_name}_{$module_id}_{$locale}";
		
		if((($images = Cache::read($cacheId,"Images")) === false)){
			$this->locale = $locale;
			
			$contain = false;
			
 			$images = $this->find('all', 
 				array(
 					'fields'=>array('Media.title','Media.id','Media.imagename'),
 					'order'=>array("$modelName.position"=>"ASC","$modelName.id"=>'DESC'),
 					"conditions"=>array("$modelName.module"=>$module_name,"$modelName.module_id"=>$module_id),
 					)
 			); 	
			
			$data='';
			foreach($images as $index=>$im){
				$data[$index]['Image']['id']=$im['Media']['id'];
				$data[$index]['Image']['title']=$im['Media']['title'];
				$data[$index]['Image']['image']=$im['Media']['imagename'];
			}
					
 			//Cache::write($cacheId, $images,'Images');
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