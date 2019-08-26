<?php 
App::uses('Sanitize', 'Utility');
class ImagesController extends AppController {
	var $name = "Images";
	var $uses = array("Image");
	var $components = array("FileUpload");
	var $helpers = array("NumbersFormat","Paginator");
	var $controllerName = "Images";
	var $modelName = "Image";
	var $userFilesFolder = "images";
	
	
	
	
	function beforefilter(){
		parent::beforefilter();
		if(!isset($this->request->params['admin'])){
			
		}else{
			
	
		}
	}
	
	function get_section_folder($section=null){
		switch ($section){
			case "default":
				
				break;
				
			case "articles":
				$folder="sections";
				
				break;
					
		}
		
		return $folder;
	}
	
	function set_page_title($section=null , $type='section'){
		$menuSectionId='';
		
		switch ($section){
				
			case 'articles':{
				$page_title="Articles Images";
				$page_sub_title="Articles Images";
				$menuSectionId="articles";
				$menuFlag=20;
				}	
		
				break;	
				
			case 'shop':{
				$page_title="Shop Images";
				$page_sub_title="Shop Images";
				$menuSectionId="shop";
				$menuFlag=20;
				}	
		
				break;	
				
				
			case 'dine':{
				$page_title="Dine Images";
				$page_sub_title="Dine Images";
				$menuSectionId="dine";
				$menuFlag=20;
				}	
		
				break;	
				
				
			case 'entertain':{
				$page_title="entertain Images";
				$page_sub_title="entertain Images";
				$menuSectionId="entertain";
				$menuFlag=20;
				}	
		
				break;	
			case 'videos':{
					
				$page_title="videos Images";
				$page_sub_title="videos Images";
				$menuSectionId="articles";
				$menuFlag=20;
				
				}
				break;	
		
			}
		
		
		
		
		
		$this->set("menuFlag",$menuFlag);
		
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuSectionId",$menuSectionId);
		
		
	}
	
	function set_preferred_size($section){
		
		$preferred_size='';
			
		if($section == 'articles'){
			$preferred_size='730 x 532 px';
		}
		
		
		if($section == 'shop'){
			$preferred_size='730 x 532 px';
		}
		if($section == 'dine'){
			$preferred_size='730 x 532 px';
		}
		if($section == 'entertain'){
			$preferred_size='730 x 532 px';
		}
		
		
		return $preferred_size;
	}	
	
	function get_image_resizes($section="news"){
		$userFilesFolder=$this->userFilesFolder;
		switch ($section){
			
				
			case "articles":
			
				$thumbWidth = "227";
				$thumbHeight = "129";
			
				
				$previewWidth = "730";
				$previewHeight = "532";
				
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;		
		
		case "shop":
			
				$thumbWidth = "227";
				$thumbHeight = "129";
				
				
				$previewWidth = "730";
				$previewHeight = "532";
				
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;		
		
		case "dine":
			
				$thumbWidth = "227";
				$thumbHeight = "129";
			
				
				$previewWidth = "730";
				$previewHeight = "532";
				
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;		
		
		case "entertain":
			
				$thumbWidth = "227";
				$thumbHeight = "129";
			
				
				$previewWidth = "730";
				$previewHeight = "532";
				
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
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
			
			if(!isset($this->request->data["$modelName"]['internal_title']["$locale"])){
				$this->request->data["$modelName"]['caption']["$locale"]='';
			}	
		}
	}

	
	
	
	function getPageNumber($id, $rowsPerPage ) {

		
	 	$controllerName = $this->controllerName;
		$modelName = "Section";
		$this->loadModel("$modelName");
		
		
		$get_section_id=$this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$id)));
		$section_id=$get_section_id["$modelName"]['section_id'];
		
		$order= array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC');
		$cond=array( "$modelName.section_id"=>$section_id); 
		
		
	    $result = $this->$modelName->find('list',array('order'=>$order,'conditions'=>$cond)); // id => name
	 	
	 	
	    $resultIDs = array_keys($result); // position - 1 => id
	    
	    $resultPositions = array_flip($resultIDs); // id => position - 1
	    
	    $position = $resultPositions[$id] + 1; // Find the row number of the record
	    
	    $page = ceil($position / $rowsPerPage); // Find the page of that row number
	   	
	    return $page;
	  }
	
	function getShopPageNumber($id, $rowsPerPage ) {

		
	 	$controllerName = $this->controllerName;
		$modelName = "Shop";
		$this->loadModel("$modelName");
		
		
		$get_section_id=$this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$id)));
		$section_id=$get_section_id["$modelName"]['section_id'];
		
		$order= array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC');
		$cond=array( "$modelName.section_id"=>$section_id); 
		
		
	    $result = $this->$modelName->find('list',array('order'=>$order,'conditions'=>$cond)); // id => name
	 	
	 	
	    $resultIDs = array_keys($result); // position - 1 => id
	    
	    $resultPositions = array_flip($resultIDs); // id => position - 1
	    
	    $position = $resultPositions[$id] + 1; // Find the row number of the record
	    
	    $page = ceil($position / $rowsPerPage); // Find the page of that row number
	   	
	    return $page;
	  }
	
		
	function admin_index($section,$module_name,$module_id,$list_all = 0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		
		$this->set_page_title("$section");
		
		$this->set("module_name",$module_name);
		$this->set("module_id",$module_id);
		$this->set("section",$section);
		
		
		$back_url='';
		
		if($section == 'articles'){
			$page=$this->getPageNumber($module_id , 20);
			$back_url="/admin/Sections/index/articles/page:$page";
		}elseif($section == 'shop' || $section == 'dine' || $section == 'entertain'){
			
			$page=$this->getShopPageNumber($module_id , 50);
			$back_url="/admin/Shops/index/$section/page:$page";
			
		}
		
		$this->set("back_url",$back_url);
		
		$cond = array("$modelName.module_name"=>$module_name , "$modelName.section"=>$section, "$modelName.module_id"=>$module_id);
		
		if ($list_all == 0){
			$this->paginate = array(
				'fields' => array("$modelName.id","$modelName.title","$modelName.image","$modelName.visible" , "$modelName.caption","$modelName.modified"),
				'limit' => 20,
				'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false
			);
		}
		else{
			$this->paginate = array(
				'fields' => array("$modelName.id","$modelName.title","$modelName.image","$modelName.visible" , "$modelName.caption","$modelName.modified"),
				'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false,
				"limit"=>1000
			);
		}
		$data = $this->paginate($modelName);
		//print_r($data);exit;
		$this->set('data', $data);
	}
	
	
	function admin_add($section,$module_name,$module_id){
		$locales = Configure::read("LOCALES");
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$userFilesFolder = $this->userFilesFolder;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('userFilesFolder',$userFilesFolder);
		
		$this->set_page_title("$section");
		$this->set("section",$section);
		$this->set("module_name",$module_name);
		$this->set("module_id",$module_id);
		
		
		$this->set("preferred_size",$this->set_preferred_size("$section"));
		
		
		if (!empty($this->request->data)){
			//print_R($this->request->data);exit;
			$error=0;
						
			/*IMAGE*/
			
			$cacheId = "all_languages";
			if (($languages = Cache::read($cacheId)) === false) {
				$this->loadModel("Language");
				$languages=$this->Language->find('all',array('callbacks'=>false));
				Cache::write($cacheId, $languages);
			}
			$image_both=0;
			foreach ($languages as $lang){
				$locale = $lang["Language"]["locale"];
				
				if(!empty($this->request->data[$modelName]['image'][$locale]['name'])){
					
					$sizes=$this->get_image_resizes("$section");
					
					//print_r($sizes);exit;
					$this->request->data[$modelName]['image'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image'][$locale]['name']);
					$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'][$locale],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$sizes,'randomName'=>false));
					if(!$retArray['error']){
						$this->request->data["$modelName"]['image'][$locale]=$retArray['fileName'];
						$image_both=1;
					}else{
						$imageError=$retArray['errorMsg'];
						$this->request->data["$modelName"]['image'][$locale]='';
						$this->Session->setFlash($imageError);
						$error=1;
					}
				}else{
					$this->request->data["$modelName"]['image'][$locale]='';
				}
			}
			
			if($image_both == 0){
				unset($this->request->data["$modelName"]['image']);
			}
			
			$main_image_name='';
			foreach($this->request->data["$modelName"]['image'] as $key=>$im){
				if(!empty($this->request->data["$modelName"]['image']["$key"])){
					$main_image_name=$this->request->data["$modelName"]['image']["$key"];
				}else{
					$this->request->data["$modelName"]['image']["$key"]=$main_image_name;
				}
			}

			
			
			
			
			if($error==0){
				//print_R($this->request->data);exit;
				
				$this->request->data["$modelName"]['section']=$section;
				$this->request->data["$modelName"]['module_name']=$module_name;
				$this->request->data["$modelName"]['module_id']=$module_id;
				
				$this->fill_empty_fields();
				
				if ($this->$modelName->saveAll($this->request->data)){
					$this->Session->setFlash("Item Added Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index/$section/$module_name/$module_id");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
			}
		}
	}

	
	function admin_edit($id){ 
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$userFilesFolder = $this->userFilesFolder;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('userFilesFolder',$userFilesFolder);
		
		
		$id = (int)$id;
		$this->set('id',$id);
		$get_data =  $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title",'text','image'),array());
		$section=$get_data["$modelName"]['section'];
		$module_name=$get_data["$modelName"]['module_name'];
		$module_id=$get_data["$modelName"]['module_id'];
		
		
		$this->set_page_title("$section");
		$this->set("section",$section);
		
					
		
		$this->set("preferred_size",$this->set_preferred_size("$section"));
		
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/administrators");
			exit;
		}
		
		if (empty($this->request->data)){
			$this->request->data = $get_data;			
		}
		else{
			$error=0;
		
			/*IMAGE*/
			
			$this->fill_empty_fields();
			
			$cacheId = "all_languages";
			if (($languages = Cache::read($cacheId)) === false) {
				$this->loadModel("Language");
				$languages=$this->Language->find('all',array('callbacks'=>false));
				Cache::write($cacheId, $languages);
			}
			
			$image_both=0;
			foreach ($languages as $lang){
				$locale = $lang["Language"]["locale"];
				
				if(!empty($this->request->data[$modelName]['image'][$locale]['name'])){
					
					$sizes=$this->get_image_resizes("$section");
					
					//print_r($sizes);exit;
					$this->request->data[$modelName]['image'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image'][$locale]['name']);
					$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'][$locale],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$sizes,'randomName'=>false));
					if(!$retArray['error']){
						$this->request->data["$modelName"]['image'][$locale]=$retArray['fileName'];
						$image_both=1;
					}else{
						$imageError=$retArray['errorMsg'];
						$this->request->data["$modelName"]['image'][$locale]='';
						$this->Session->setFlash($imageError);
						$error=1;
					}
				}else{
					$this->request->data["$modelName"]['image'][$locale]='';
				}
			}
			
			if($image_both == 0){
				unset($this->request->data["$modelName"]['image']);
			}
			
			if(isset($this->request->data["$modelName"]['image']) && !empty($this->request->data["$modelName"]['image'])){
					$main_image_name='';
					foreach($this->request->data["$modelName"]['image'] as $key=>$im){
						if(!empty($this->request->data["$modelName"]['image']["$key"])){
							$main_image_name=$this->request->data["$modelName"]['image']["$key"];
						}else{
							$this->request->data["$modelName"]['image']["$key"]=$main_image_name;
						}
					}
				}else{
					unset($this->request->data["$modelName"]['image']);
				}
			

			
			/*END IMAGE*/
			
			
			
			if($error==0){
				$this->request->data[$modelName]['id'] = $id;					
				if ($this->$modelName->saveAll($this->request->data)){
					$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index/$section/$module_name/$module_id");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
			}
		}
	}
	
	function admin_delete($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$userFilesFolder = $this->userFilesFolder;
		
		$id = (int)$id;
		
		$get_data =  $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title",'text','image'),array());
		$section=$get_data["$modelName"]['section'];
		$module_name=$get_data["$modelName"]['module_na'];
		$module_id=$get_data["$modelName"]['module_id'];
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		
		$this->$modelName->id = $id;
		if ($this->$modelName->delete($id)){
			
			$cacheId = "all_languages";
			if (($languages = Cache::read($cacheId)) === false) {
				$this->loadModel("Language");
				$languages=$this->Language->find('all',array('callbacks'=>false));
				Cache::write($cacheId, $languages);
			}
			
			
			foreach ($languages as $lang){
				$locale = $lang["Language"]["locale"];
			
				$image_name = $get_data[$modelName]["image"][$locale];
				$thumb_location=APP."/webroot/files/$userFilesFolder/thumb/$image_name";
				$preview_location=APP."/webroot/files/$userFilesFolder/preview/$image_name";
				
				$original_location=APP."/webroot/files/$userFilesFolder/original/$image_name";
				
				if(file_exists($thumb_location))
					unlink($thumb_location);
				
				if(file_exists($preview_location))
					unlink($preview_location);
					
				if(file_exists($original_location))
					unlink($original_location);
			}	
			
			
			
			
			
			$this->Session->setFlash("Item Deleted Successfully","admin/admin_succ");
			$this->redirect("/admin/$controllerName/index/$section/$module_name/$module_id");
			exit;
		}
		else {
			$this->Session->setFlash("Item could not be deleted. Please try again later.","admin/admin_err");
			exit;
		}
	}
	
	function admin_show($id=null){
		if($this->RequestHandler->isAjax()){
			$this->layout='';
		}
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;
		////////Validating Id////////////
		if($id==null || !is_numeric($id)){
			if(!$this->RequestHandler->isAjax()){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("/admin/$controllerName/index");
			}
			exit;
		}
		$this->$modelName->id=$id;
		$this->$modelName->saveField("visible",1);
		
		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash("Status Changed successfully");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		echo 1;exit;
	}
	
	function admin_hide($id=null){
		if($this->RequestHandler->isAjax()){
			$this->layout='';
		}
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;
		////////Validating Id////////////
		if($id==null || !is_numeric($id)){
			if($this->RequestHandler->isAjax()){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("/admin/$controllerName/index");
			}
			exit;
		}
		$this->$modelName->id=$id;
		$this->$modelName->saveField("visible",0);
		
		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash("Status Changed successfully");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		echo 1;
		exit;
	}
	
	function admin_ajax_order(){
		$modelName=$this->modelName;
		
		$error_flag=0;
		foreach ($_GET['row'] as $position => $item) {
			$this->$modelName->id=$item;
			if($this->$modelName->saveField('position',$position))
				$error_flag=1;
			else $error_flag=0;
		}
		
		if($error_flag==1)
			echo "<div class='highlight_msg'>The order has been changed successfully</div>";
		exit;
	}	

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




	
	
function admin_display_related_images($albumId){
		$this->layout = "";

		if(isset($_GET["chosenImages"]))
			$chosenImages = json_decode($_GET["chosenImages"],true);
		else $chosenImages = array();
		
		if(isset($_GET["alreadyRelatedImagesIds"]))
			$alreadyRelatedImagesIds = json_decode($_GET["alreadyRelatedImagesIds"],true);
		else $alreadyRelatedImagesIds = array();
		
		$this->loadModel("Album");
		$images = $this->Album->find("first",array('callbacks'=>false,"contain"=>array("Image"),"conditions"=>array("Album.id"=>$albumId)));
		$this->set("album",$images);
		$this->set("chosenImages",$chosenImages);
		
		$alreadyRelatedImagesIds = array_flip($alreadyRelatedImagesIds);
		$this->set("alreadyRelatedImagesIds",$alreadyRelatedImagesIds);
		
		
	}



	function admin_delete_section_image($id , $folder_name){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		
		$id = (int)$id;
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		if($id==null || !is_numeric($id)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}

		$image_name = $get_data["$modelName"]["image"];

		$this->$modelName->id = $id;
		if($this->$modelName->delete($id)){
			$thumb_location=WWW_ROOT."/files/$folder_name/thumb/$image_name";
			$preview_location=WWW_ROOT."/files/$folder_name/preview/$image_name";
			$original_location=WWW_ROOT."/files/$folder_name/original/$image_name";
			if(file_exists($thumb_location))
			unlink($thumb_location);
			if(file_exists($preview_location))
			unlink($preview_location);
			if(file_exists($original_location))
			unlink($original_location);
		}
		exit;
	}
	function admin_delete_related_images($album_id,$folder_name){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		
		$id = (int)$album_id;
		$get_data = $this->$modelName->find("all",array('callbacks'=>false,"conditions"=>array("$modelName.album_id"=>$id)));
		if($id==null || !is_numeric($id)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		// print_r($get_data);exit;
		
		foreach($get_data as $image){
			$image_name = $image["$modelName"]["image"];
			$id= $image["$modelName"]["id"];
			$this->$modelName->id = $id;
			if($this->$modelName->delete($id)){
				$thumb_location=WWW_ROOT."/files/$folder_name/thumb/$image_name";
				$preview_location=WWW_ROOT."/files/$folder_name/preview/$image_name";
				$original_location=WWW_ROOT."/files/$folder_name/original/$image_name";
				
				if(file_exists($thumb_location))
				unlink($thumb_location);
				if(file_exists($preview_location))
				unlink($preview_location);
				if(file_exists($original_location))
				unlink($original_location);
				
				
				
			//delete the relations 	
			$this->loadModel('PagesRelation');
			$data=$this->PagesRelation->find('all',array('conditions'=>array('PagesRelation.related_model'=>'Image','PagesRelation.related_id'=>$id)));
			
			//print_r($data);exit;
			foreach($data as $img){
				$record_id=$img["PagesRelation"]['id'];
				$source_id=$img["PagesRelation"]['source_id'];
				$source_model=$img["PagesRelation"]['source_model'];
				
				//print_r($record_id);exit;
				$this->PagesRelation->delete($record_id);
				
				
				$count_images=$this->PagesRelation->find('count',array(
				'conditions'=>array('PagesRelation.source_model'=>"$source_model",'PagesRelation.related_model'=>'Image' ,'PagesRelation.source_id'=>"$source_id")));
				//print_r($count_images);exit;
				if($count_images == 0){
					
					$album_record_id=$this->PagesRelation->find('first',array('conditions'=>array('PagesRelation.related_model'=>'Album','PagesRelation.source_id'=>"$source_id")));
					
					$this->PagesRelation->delete($album_record_id["PagesRelation"]['id']);
				}
				}
			}
		}
		//exit;
	}

	function upload_image($albumId,$album_type,$randString){
		if($randString != "kjd_kml819"){
			return false;
		}
		$this->layout = "";
		$this->admin_beforeFilter();

		$this->set("album_type",$album_type);
		$image = $_FILES['Filedata'];
		
		
		$data["Album"]["images"][0] = $image;
		$resizesArray=$this->get_image_resizes("$album_type");
		
		$folderName = "albums";
		$this->set("folderName",$folderName);
		
		if(!empty($image['name'])){
			$image['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$image['name']);

			$retArray=$this->FileUpload->uploadFile($image,WWW_ROOT."files/$folderName/original",'image',array('resize'=>true,'resizeOptions'=>$resizesArray,'randomName'=>false));

			if(!$retArray['error']){
				$this->request->data["Image"]['image']=$retArray['fileName'];
				if(empty($firstImage)){
					$firstImage = $retArray['fileName'];
				}
			}else{
				$imageError=$retArray['errorMsg'];
				$this->request->data["Image"]['image']='';
				$this->Session->setFlash($imageError);
				$error=1;
			}
			
		
			$this->request->data["Image"]['album_id']=$albumId;
			$this->request->data["Image"]['title']["eng"]="";
			$this->request->data["Image"]['home_page']=0;
			$this->request->data["Image"]['title']["ara"]="";
			$this->request->data["Image"]['caption']["eng"]="";
			$this->request->data["Image"]['caption']["ara"]="";
			$this->request->data["Image"]['url']="";

			
			
			$this->Image->saveAll($this->request->data);

			$imgId = $this->Image->id;
			$this->request->data["Image"]['id'] = $imgId;
			
		
			
		}


	}
	
	
	function section_upload_image($modelName=null ,$section=null,$type=1,$hashed_id=null){
		// if($randString != "kjd_kml819"){
			// return false;
		// }
		$this->layout = "";
		$this->admin_beforeFilter();
		
		// print_r("$modelName");
		// print_r("$section");
		// print_r($type);
		

		$this->set("modelName",$modelName);
		$this->set("section",$section);
		$this->set("type",$type);
		$this->set("hashed_id",$hashed_id);
		
		
		$image = $_FILES['Filedata'];
		
		//print_r("$section"." ".$type);exit;
		
		
		//$data["Album"]["images"][0] = $image;
		$resizesArray=$this->get_image_resizes("$section",$type);
		//print_R($resizesArray);exit;
		
		$folderName=$this->get_section_folder($section);
		$this->set("folderName",$folderName);
		if(!empty($image['name'])){
			$image['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$image['name']);

			$retArray=$this->FileUpload->uploadFile($image,WWW_ROOT."files/$folderName/original",'image',array('resize'=>true,'resizeOptions'=>$resizesArray,'randomName'=>false));

			if(!$retArray['error']){
				$this->request->data["Image"]['image']=$retArray['fileName'];
				if(empty($firstImage)){
					$firstImage = $retArray['fileName'];
				}
			}else{
				$imageError=$retArray['errorMsg'];
				$this->request->data["Image"]['image']='';
				$this->Session->setFlash($imageError);
				$error=1;
			}
			
		
			$this->request->data["Image"]['module_name']=$modelName;
			$this->request->data["Image"]['hashed_id']=$hashed_id;
			
			$this->request->data["Image"]['type']=$type;
			
			$cacheId = "all_languages";
			if (($languages = Cache::read($cacheId)) === false) {
				$this->loadModel("Language");
				$languages=$this->Language->find('all',array('callbacks'=>false));
				Cache::write($cacheId, $languages);
			}

			foreach ($languages as $lang){
				$locale = $lang["Language"]["locale"];
				
				$this->request->data["Image"]['title']["$locale"]="";
				$this->request->data["Image"]['caption']["$locale"]="";
			}
			
			
			$this->request->data["Image"]['url']="";

			
			
			$this->Image->saveAll($this->request->data);

			$imgId = $this->Image->id;
			$this->request->data["Image"]['id'] = $imgId;
		}


	}



	
	
	


	
	function admin_crop_update($sourceModel,$imgId ,$dim){
			$this->layout="";
			
			$modelName=$this->modelName;
			$controllerName=$this->controllerName;
			$this->loadModel("$sourceModel");
			$data = $this->$sourceModel->find('first',array('conditions'=>array("$sourceModel.id"=>$imgId)));
			//print_r($data);exit;
			$this->set('data',$data);
			$this->set('modelName',$modelName);
			$this->set('imgId',$imgId);
			$this->set('sourceModel',$sourceModel);
			
			
			if(isset($dim)){
				switch ($dim){
					case 'homeThumb':{
						$Width=198;
						$Height=198;
						// $image_folder="homeThumb";
						$desc='homeThumb';
						break;
					}
					
				}
			}
			
			if($sourceModel == 'News'){
				$userFilesFolder='news';
			}elseif($sourceModel == 'Events'){
				$userFilesFolder='events';
			}
						
			$this->set("Width",$Width);
			$this->set("Height",$Height);
			$this->set("userFilesFolder",$userFilesFolder);
			$this->set("description",$desc);
		}

	function admin_view_size($sourceModel,$imgId){
			
			$modelName=$this->modelName;
			$controllerName=$this->controllerName;
			
			$this->loadModel("$sourceModel");
			$data = $this->$sourceModel->find('first',array('conditions'=>array("$sourceModel.id"=>$imgId)));
			//print_r($data);exit;
			$this->set('data',$data);
			$this->set('modelName',$modelName);
			$this->set('imgId',$imgId);
			
			if($sourceModel == 'News'){
				$userFilesFolder='news';
			}elseif($sourceModel == 'Events'){
				$userFilesFolder='events';
			}
			
			$this->set('userFilesFolder',$userFilesFolder);
			$this->set('sourceModel',$sourceModel);
			
	}
	
	function admin_crop_image($sourceModel,$imgId ,$dim){

			$modelName=$this->modelName;
			$controllerName=$this->controllerName;
			$this->loadModel("$sourceModel");
			$data = $this->$sourceModel->find('first',array('conditions'=>array("$sourceModel.id"=>$imgId)));
			//print_r($data);exit;
			$this->set('data',$data);
			$this->set('modelName',$modelName);
			$this->set('imgId',$imgId);
			$this->set('sourceModel',$sourceModel);
			
			
			if(isset($dim)){
				switch ($dim){
					case 'homeThumb':{
						$Width=198;
						$Height=198;
						// $image_folder="homeThumb";
						
						break;
					}
					
				}
			}
			
			if($sourceModel == 'News'){
				$userFilesFolder='news';
			}elseif($sourceModel == 'Events'){
				$userFilesFolder='events';
			}
			
			$this->set("Width",$Width);
			$this->set("Height",$Height);
			$this->set("userFilesFolder",$userFilesFolder);
			$this->set("dim",$dim);
			
			
			
			//print_r($data);exit;
			if(!empty($this->request->data)){
			// print_r($imgId);
			// print_r($dim);
				//print_r($this->request->data);exit;
				
				$x1 = $this->request->data["Image"]["x1"];
				$y1 = $this->request->data["Image"]["y1"];
				$imageWidth = $this->request->data["Image"]["imageWidth"];
				$imageHeight = $this->request->data["Image"]["imageHeight"];
				$imageName = $data["$sourceModel"]["image"];
				//print_r($x1."--"); print_r($y1);
				$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
				//print_r($this->request->data);exit;
				
				$fileSource = WWW_ROOT."files/$userFilesFolder/list/$imageName";
				$fileDest = WWW_ROOT."files/$userFilesFolder/thumb/$imageName";
				// print_r($fileSource."-------------");
				// print_r($fileDest."-------------");exit;
				
				
				$imgMagickPath = Configure::read("IMAGEMAGIC");
				
				
				
				$command = $imgMagickPath."/convert \"$fileSource\" -crop {$imageWidth}x{$imageHeight}+$x1+$y1 $fileDest";
				//print_r($command);exit;
				@passthru($command); 
				
				echo 1;
				exit;
				
			}
	}






	function view_image($image_id ,$title){
		
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$folder_name="albums";
		$id = (int)$image_id;
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		//print_r($get_data);exit;
		
		// $this->loadModel("$model_name");
		// $data=$this->$model_name->find('first',array('conditions'=>array("$model_name.id"=>$model_id),'fields'=>array("$model_name.title"),'revursive'=>-1));
		// print_r($data);exit;
		$this->set(compact('get_data','title'));
		
		
	}
	
	
	function view_album_image($album_id , $image_id){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$folder_name="albums";
		$locale = $this->request->params["locale"];
		$this->loadModel("Album");
		$home_album_details=$this->Album->get_home_Album_images($album_id , "$locale");
		
		$this->set("image_id",$image_id);
		$this->set("home_album_details",$home_album_details);
		
		
	}
}
?>