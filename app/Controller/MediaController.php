<?php

class MediaController extends AppController {

	public $name = "Media";
	public $uses = array("Media");
	public $components = array("FileUpload");
	//uppublic $helpers = array('Youtube','Doc');
	public $modelName = "Media";
	public $controllerName = "Media";
	
	var $userFilesFolder = "images";
	function beforeFilter(){
		parent::beforeFilter();
		if(empty($this->request->params["admin"])){

		}else{
			
			
		}
	}
		
	
	
	
	

	
	// images resize according to the module name 
	function get_image_resizes($module="default" , $type='default'){
		$userFilesFolder=$this->userFilesFolder;
		
		switch ($module){
			case "Shop":
				$thumbWidth = "227";
				$thumbHeight = "151";

				$previewWidth = "730";
				$previewHeight = "532";
				
				
				
				
				$resizes = array(
				array('folder'=>WWW_ROOT."/files/images/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
				array('folder'=>WWW_ROOT."/files/images/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
				);
				break;	
				
				
			case "Section":
				$thumbWidth = "227";
				$thumbHeight = "151";

				$previewWidth = "730";
				$previewHeight = "532";
				
				$resizes = array(
				array('folder'=>WWW_ROOT."/files/images/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
				array('folder'=>WWW_ROOT."/files/images/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
				);
				break;					
		}
		
		return $resizes;
		
	}
	
	// video automatic image size 
	function get_video_image_resizes($module="default" , $type='default'){
		$userFilesFolder=$this->userFilesFolder;
		
		switch ($module){
			case "DynamicPage":
				
				$resizes = array('thumb'=>"227x151" , 'preview'=>"482x320");
				
				break;				
		}
		
		return $resizes;
		
	}
	
	function get_video_Dimensions($module="default" , $type='default'){
		switch ($module){
			case "DynamicPage":
				
				$Dimensions = "600x300";
				
				break;				
		}
		
		return $Dimensions;
	}
	
	// video uploaded image size
	function get_video_cover_image_resizes($module="default" , $type='default'){
		$userFilesFolder=$this->userFilesFolder;
		
		switch ($module){
			case "DynamicPage":
				$thumbWidth = "227";
				$thumbHeight = "151";

				$previewWidth = "482";
				$previewHeight = "320";
				
				$resizes = array(
				array('folder'=>WWW_ROOT."files/$userFilesFolder/videos/cover/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
				array('folder'=>WWW_ROOT."files/$userFilesFolder/videos/cover/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
				);
				break;				
		}
		
		return $resizes;
		
	}
	
		
		

	function fill_empty_fields(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		
		$cacheId = "all_languages";
		if (($languages = Cache::read($cacheId)) === false) {
			$this->loadModel("Language");
			$languages=$this->Language->find('all',array('callbacks'=>false));
			Cache::write($cacheId, $languages);
		}

		foreach ($languages as $lang){
			$locale = $lang["Language"]["locale"];
			
			if(!isset($this->request->data["$modelName"]['title']["$locale"])){
				$this->request->data["$modelName"]['title']["$locale"]='';
			}
		
			if(!isset($this->request->data["$modelName"]['caption']["$locale"])){
				$this->request->data["$modelName"]['caption']["$locale"]='';
			}			
		}
	}






/////START Images Functions////
																
																
																
		 	 	
public function imageupload($randString ){
	
	//print_R('testmedia');exit;
	//print_R($randString);exit;	
	// if($randString != "kjd_kml819"){
		// return false;
	// }
	$userFilesFolder=$this->userFilesFolder;
	$this->set("userFilesFolder",$userFilesFolder);
	$this->layout='ajax';	
	if ($this->request->is('post')) {
		
		 		       
		 if (!empty($_FILES)) {		 
			 $image = $_FILES['Filedata'];				
			
			
			$passed_module_name=$_POST['resizeModule'];
			$passed_module_type=$_POST['resizeType'];
			$passed_module_hashed_id=$_POST['hashed_id'];
			$userFilesFolder=$_POST['userFilesFolder'];
			$this->set("userFilesFolder",$userFilesFolder);
			
			
				
		  $image_resize_options=$this->get_image_resizes($passed_module_name, "$passed_module_type");			
		  //print_r($image_resize_options);exit;
		  
			//Upload & resize 
		  if(!empty($image['name'])){
										
				$image['name']=time().preg_replace("/[^A-Za-z0-9_\.]/","",$image['name']);
				$retArray=$this->FileUpload->uploadFile($image,WWW_ROOT."/files/$userFilesFolder/original",'image',
														array('resize'=>true,
															  'resizeOptions'=>$image_resize_options,
															  'randomName'=>false));
               //End Upload
               
       
	              //Saving To Db 
			    if(!$retArray['error']){
					$this->request->data["Media"]['type'] = 'image';
					$this->request->data["Media"]['hashed_id'] = $passed_module_hashed_id;
					$this->request->data["Media"]['imagename']= $image['name'];
					//$imageSave['Media']['dir'] = $this->image_folder_name;
					
					
					
					//$this->fill_empty_fields();
					$this->Media->create();
					$this->Media->saveAll($this->request->data);
					
					$uploadedImage= $this->Media->findById($this->Media->getInsertID());
					$this->set('image',$uploadedImage);
					}	
		        // end saving 			
                   // End If Not Empty Image Name
		         }
	            //End If File 
             }						
            // End If Post 
           }
}





// Function to crop and resize the video thumb
public function admin_cropimg(){
	
	$this->layout='ajax';
	$x1=$_POST['x'];
	$y1=$_POST['y'];
	$imageWidth=$_POST['w'];
	$imageHeight=$_POST['h'];
	$id = $_POST['id'];
	
	
	$img = $this->Media->findById($id);
	
	$previewPath = WWW_ROOT.$this->image_folder_name.'/preview/'.$img['Media']['imagename'];
	
	$imgMagickPath = Configure::read("IMAGEMAGIC");
				
				
		
	$command = $imgMagickPath."/convert \"$previewPath\" -crop {$imageWidth}x{$imageHeight}+$x1+$y1 $previewPath";
	@passthru($command); 
	
	
	
	
	foreach($this->image_resize_options as $resize){
	
	$fileSource = $previewPath;
	$fileDest = $resize['folder'].'/'.$img['Media']['imagename'];
	$defaultHeight = $resize['width'];
	$defaultWith = $resize['height'];
	
	
	$command = $imgMagickPath."/convert \"$fileSource\" -resize {$defaultWith}x{$defaultHeight} $fileDest";
    @passthru($command); 
    
    }	
	

	
	$this->set('image',$img);
	
	
	
}








//Function to edit the image title & Caption [Translatable]

public function admin_editmediainfo($id){
     $this->layout='ajax';
     $this->Media->id = $id;
    if (!$this->Media->exists()) {
        throw new NotFoundException(__('Invalid Media'));
    }
	    
   if ($this->request->is('post') or $this->request->is('put')) {
       // Saving Data
       $this->request->data["Media"]['id']=$id;
       if ($this->Media->saveAll($this->request->data)) {
                $this->Session->setFlash(__('Media info has been saved'),'flash_good');                   
            }             
       else {
                $this->Session->setFlash(__('Media info could not be saved. Please, try again.'),'flash_bad');
            } 
   }        
   else {   	
		$get_data =  $this->get_all_locales(array("Media.id"=>$id),"Media",Configure::read('LOCALES'),array("title","caption"),array());
        $this->request->data = $get_data;       
    }	
}




														////// END OF IMAGE FUNCTIONS ///////
														
														
														
														////// START VIDEO FUNCTIONS ///////


 
//Adding youtube video 
 
public function admin_youtubeupload(){
$this->layout='ajax';									
if($_POST['url']){ 					
    $url = $_POST['url'];
	$hashed_id = $_POST['hashed_id'];					
    // Check if the youtube url is valid using the youtube comp
	if($this->Youtube->check($url)){
					
			//parsing the youtube url to get the id 
			parse_str( parse_url( $url, PHP_URL_QUERY ), $returnArray);
			    

			// Start Saving 
			$saveYoutube['Media']['type']= 'video';
			$saveYoutube['Media']['subtype']= 'youtube';
			$saveYoutube['Media']['hashed_id'] = $hashed_id;
			$saveYoutube['Media']['youtubeUrl'] = $url;
			$saveYoutube['Media']['youtube_id'] = $returnArray['v'];  
			
			$controllerName = $this->controllerName;
			$modelName = $this->modelName;									
			$cacheId = "all_languages";
			if (($languages = Cache::read($cacheId)) === false) {
				$this->loadModel("Language");
				$languages=$this->Language->find('all',array('callbacks'=>false));
				Cache::write($cacheId, $languages);
			}							
			foreach ($languages as $lang){
				$locale = $lang["Language"]["locale"];									
				$saveYoutube['Media']['title']["$locale"]='';										
				$saveYoutube['Media']['caption']["$locale"]='';												
			}
									
									
			$this->Media->create();
			$this->Media->saveAll($saveYoutube);
			$id= $this->Media->getInsertID(); 
			$video = $this->Media->findById($id);
		
			$data['type']= 'youtube';
   
						$this->set('video',$video);
			$this->set('data',$data);
		
			// End Saving 
			
            }
						
		//end check post 				 			
		}
}
		   
	
		

//function to preview the youtube embed 
public function admin_previewYoutube(){

$this->layout='ajax';
$url = $_POST['url'];
$this->set('url',$url);

}
//// End Youtube Section//// 

//Start User Video Upload Section///

//video upload function 
public function videoupload($randString){
	
	if($randString != "kjd_kml819"){
		return false;
	}
	
	
	
	$userFilesFolder=$this->userFilesFolder;
	$this->set("userFilesFolder",$userFilesFolder);
	
	$this->layout='ajax';
	if($this->request->is('post')) {
	
	
	if($_POST['type']=='video'){
			
			
			if (!empty($_FILES)) {
			
				$video = $_FILES['Filedata'];
				
				if(!empty($video['name'])){
				        
					         
				    $passed_module_name=$_POST['resizeModule'];
					$passed_module_type=$_POST['resizeType'];
					$passed_module_hashed_id=$_POST['hashed_id'];
					$passed_module_type=$_POST['type'];
						
						
				  	$image_resize_options=$this->get_video_image_resizes($passed_module_name, "$passed_module_type");
					$videoDimensions=$this->get_video_Dimensions($passed_module_name, "$passed_module_type");		           
				     
					//print_R($image_resize_options);exit;
				                 
	                //Start Settings
					$video['name']=time().preg_replace("/[^A-Za-z0-9_\.]/","",$video['name']);
					$folder_name = WWW_ROOT."files/$userFilesFolder/videos/files/mp4/";
					$snapFolder = WWW_ROOT."files/$userFilesFolder/videos/cover";
					//End Settings 
					
					
						
					$videoArgs=array(
							'randomName'=>false,
							'keepOriginal'=>true,
							'convert'=>true,
							'extensions' => array('mpeg', 'wmv', 'flv', 'mpg','3gp','mov','avi','mp4'),
							'flvFolder' => $folder_name,
							'snapshot' => true,
							'snapshotFolder' =>array(
								'thumb'=> WWW_ROOT . "files/$userFilesFolder/videos/cover/thumb",
								'preview'=> WWW_ROOT . "files/$userFilesFolder/videos/cover/preview"
							),
							'snapshotResize' => false,
							
							'ffmpeg'=>array(
							'ffmpegPath'=>'/usr/bin',
							'audioSamplingFrequency'=>'22050',
							'audioBitRate'=>'128k',
							'videoAspectRatio'=>'4:3',
							'videoBitRate'=>'64k',
							'fps'=>'24',
							'videoDimensions'=>$videoDimensions,
							'audioChannels'=>'1',
							'snapshotSeekTime'=>'00:00:01',
							'snapshotSize'=>$image_resize_options,
							 
							));
							
							
											
					$retArray = $this->FileUpload->uploadFile($video, WWW_ROOT."files/$userFilesFolder/videos/files/original", 'video', $videoArgs);					
                    //End Upload
					
					//print_R($retArray);exit;

					//Saving data if upload true
						if(!$retArray['error']){
						            $folder_name = "/files/$userFilesFolder/videos/files/mp4/";
									$snapFolder = "/files/$userFilesFolder/videos/cover";
									$videoSave['Media']['type'] = 'video';
									$videoSave['Media']['imagename'] = $retArray['snapshotName'] ;
									$videoSave['Media']['dir'] = $snapFolder ;
									$videoSave['Media']['hashed_id'] = $_POST['hashed_id'];
									$videoSave['Media']['videoUrl'] = $folder_name."/".$retArray['fileName'];
									
									
									$controllerName = $this->controllerName;
									$modelName = $this->modelName;									
									$cacheId = "all_languages";
									if (($languages = Cache::read($cacheId)) === false) {
										$this->loadModel("Language");
										$languages=$this->Language->find('all',array('callbacks'=>false));
										Cache::write($cacheId, $languages);
									}							
									foreach ($languages as $lang){
										$locale = $lang["Language"]["locale"];									
										$videoSave['Media']['title']["$locale"]='';										
										$videoSave['Media']['caption']["$locale"]='';												
									}
		
		
									
									
									$this->Media->create();
									
									
									
									
									$this->Media->saveAll($videoSave);
									
									
									$video = $this->Media->findById($this->Media->getInsertID());
									
									$data['type']= 'video';
					               
					                $this->set('video',$video);
									$this->set('data',$data);
						}
						else{ 
						$data['id']=$retArray['errorMsg']; 
						$this->set('data',$data);	
						}
					//End Saving Data		
				}
		
	
      } 	 
    }
  }
}

													///////// End Video Section //////////
													

// Function to crop and resize the video thumb
public function admin_cropcover(){	
	
	$this->layout='ajax';
	$x1=$_POST['x'];
	$y1=$_POST['y'];
	$imageWidth=$_POST['w'];
	$imageHeight=$_POST['h'];
	$id = $_POST['id'];
	
	
	$video = $this->Media->findById($id);
	
	$previewPath = WWW_ROOT.$this->cover_folder_name.'/preview/'.$video['Media']['imagename'];
	
	$imgMagickPath = Configure::read("IMAGEMAGIC");
				
				
		
	$command = $imgMagickPath."/convert \"$previewPath\" -crop {$imageWidth}x{$imageHeight}+$x1+$y1 $previewPath";
	@passthru($command); 
	
	
	
	
	foreach($this->cover_resize_options as $resize){
	
	$fileSource = $previewPath;
	$fileDest = $resize['folder'].'/'.$video['Media']['imagename'];
	$defaultHeight = $resize['width'];
	$defaultWith = $resize['height'];
	
	
	$command = $imgMagickPath."/convert \"$fileSource\" -resize {$defaultWith}x{$defaultHeight} $fileDest";
    @passthru($command); 
    
    }	
	

	
	$this->set('video',$video);			
	
	
}


// Function to change the video cover 

public function editcover($randString){
	
	$userFilesFolder=$this->userFilesFolder;
	$this->set("userFilesFolder",$userFilesFolder);
	
	if($randString != "kjd_kml819"){
		return false;
	}
	
   $this->layout='ajax';

	
   if($_POST['video_id']){
	
	$id= $_POST['video_id'];
	$media = $this->Media->findById($id);
		
		if($media){
				
				
				$passed_module_name=$_POST['resizeModule'];
				$passed_module_type=$_POST['resizeType'];
				$passed_module_hashed_id=$_POST['hashed_id'];
				
					
					
			  	$image_resize_options=$this->get_video_cover_image_resizes($passed_module_name, "$passed_module_type");
					
					
				if($media['Media']['type'] == 'video'){
		
						if (!empty($_FILES)) {		 
						 	//settings
							$image = $_FILES['Filedata'];
							
							if($media['Media']['dir']){
								$folder_name = $media['Media']['dir'];   
							}else{
								$folder_name = "/files/$userFilesFolder/videos/cover/";
							}		
							
							// end settings	
					
							//upload & Resize 
							
							
							
							
							//Removing previous cover if already exists 
							if(!empty($image['name'])){								
									if($media['Media']['imagename']){							
									    //unlink(WWW_ROOT.$folder_name."/original/".$media['Media']['imagename']);
									
										foreach($image_resize_options as $resize){
									        	unlink($resize['folder']."/".$media['Media']['imagename']);
												}								
										//$image['name']= $media['Media']['imagename'];							
									}
									else{										
										$image['name']=time().preg_replace("/[^A-Za-z0-9_\.]/","",$image['name']);
										
									}
						//End Removing 
					
		               //Upload
								
								
							$retArray=$this->FileUpload->uploadFile($image,WWW_ROOT.$folder_name."/original",'image',
																	array('resize'=>true,
																		  'resizeOptions'=>$image_resize_options,
																		  'randomName'=>false));
		               //End Upload
		       
				              //saving to db 
						 if(!$retArray['error']){
								
							    $coverSave['Media']['id']= $id;
								$coverSave['Media']['imagename']= $retArray['fileName'];
								$coverSave['Media']['dir'] = $folder_name;
								
								//$this->Media->id = $id;
								$this->Media->saveAll($coverSave);
								
								$video = $this->Media->findById($id);
							
								$this->set('video',$video);
								}	
					        // end saving 			
		                        }
                               }	
		                      }	
		                     }
		                    }
		                   }




// Function to order the media gallery 
public function admin_reorder(){
			
	$order = json_decode($_POST['order'], true);
	
		
	foreach(array_values($order) as $key => $id){
		$this->Media->id    = $id;
		$this->Media->saveField('position', $key);
		$order[]='updating id '.$id.' with position '.$key;
	}
	
	
	$this->set('order',$order);
}
		



// Document Upload 
public function docupload($randString){
	
	$userFilesFolder=$this->userFilesFolder;
	$this->set("userFilesFolder",$userFilesFolder);
	
	if($randString != "kjd_kml819"){
		return false;
	}
	
	$this->layout='ajax';
	if (!empty($_FILES)) {
				$doc = $_FILES['Filedata'];
				if(!empty($doc['name'])){
				$db_name = $doc['name'];
				$doc['name']=  time().preg_replace("/[^A-Za-z0-9_\.]/","",$doc['name']);
				$folder_name = "/files/$userFilesFolder/docs";
				
				$retArray=$this->FileUpload->uploadFile($doc,WWW_ROOT.$folder_name,'doc');

                if(!$retArray['error']){
	              
	              $saveDoc['Media']['type'] = 'doc';
	              $saveDoc['Media']['hashed_id'] = $_POST['hashed_id']; 
	              $saveDoc['Media']['docName'] = $db_name;
	              $saveDoc['Media']['docUrl'] = $folder_name.'/'.$doc['name'];
	              
	              //Get File Size 
	              $saveDoc['Media']['filesize'] = CakeNumber::toReadableSize(filesize(WWW_ROOT.$saveDoc['Media']['docUrl']));
	             
	              
				    $controllerName = $this->controllerName;
					$modelName = $this->modelName;									
					$cacheId = "all_languages";
					if (($languages = Cache::read($cacheId)) === false) {
						$this->loadModel("Language");
						$languages=$this->Language->find('all',array('callbacks'=>false));
						Cache::write($cacheId, $languages);
					}							
					foreach ($languages as $lang){
						$locale = $lang["Language"]["locale"];									
						$saveDoc['Media']['title']["$locale"]='';										
						$saveDoc['Media']['caption']["$locale"]='';												
					}
	              
	              
	              
	              
	              $this->Media->create();
	              
	              $this->Media->saveAll($saveDoc);
	                
	              $doc = $this->Media->findById($this->Media->getInsertID());
	              
	              $this->set('doc',$doc);
	              
                }
				
				
	
	}
	
	
}

}


// Audio upload
public function admin_audioupload(){

	$this->layout='ajax';
	if (!empty($_FILES)) {
				$audio = $_FILES['Filedata'];
				if(!empty($audio['name'])){
				
				$db_name = $audio['name'];
				$audio['name']=  time().preg_replace("/[^A-Za-z0-9_\.]/","",$audio['name']);
				
				$folder_name = "media/audio";
				
				$retArray=$this->FileUpload->uploadFile($audio,WWW_ROOT.$folder_name,'audio');

                if(!$retArray['error']){
	              
	              $saveAudio['Media']['type'] = 'audio';
	              $saveAudio['Media']['hashed_id'] = $_POST['hashed_id']; 
	              $saveAudio['Media']['audioName'] = $db_name;
	              $saveAudio['Media']['audioUrl'] = $folder_name.'/'.$audio['name'];
	              
	              $this->Media->create();
	              
	              $this->Media->saveAll($saveAudio);
	                
	              $audio = $this->Media->findById($this->Media->getInsertID());
	              
	              $this->set('audio',$audio);
	              
                }
				
				
	
	}
	
	
}
}

public function admin_delete(){
	
	
		$this->layout='ajax';
			
		if ($this->request->is('post')) {			 
			 $return=0;
			 
			 $id = $_POST['id'];
			 
			 if($this->Media->delete($id)){$return=1;}
			 
			 
			 echo  $return;
			 // $this->set('return',$return);
			 exit;
			
			}
		
		exit;
// All files deletion is handled in the before delete function in the Modal 
			
}





function migrate_images(){
	
	
	
	$this->loadModel("Image");
	$data=$this->Image->find("all" ,array('contain'=>false, "fields"=>array("Image.id","Image.image","Image.module_name", 'Image.module_id', 'Image.position')));
	$new_data='';
	foreach($data as $index=>$d){
		$new_data[$index]['Media']['id']=0;
		$new_data[$index]['Media']['imagename']=$d['Image']['image'];
		$new_data[$index]['Media']['module']=$d['Image']['module_name'];
		$new_data[$index]['Media']['module_id']=$d['Image']['module_id'];
		$new_data[$index]['Media']['position']=$d['Image']['position'];
		
	}
	
	$this->Media->saveAll($new_data);
	
	print_r($new_data);exit;
	
	
	
}




}?>