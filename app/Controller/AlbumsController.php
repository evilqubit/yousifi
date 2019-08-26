<?php 
App::uses('Sanitize', 'Utility');
class AlbumsController extends AppController{
	public $name = "Albums";
	public $uses = array("Album");
	public $components = array("FileUpload","StringManipulation" ,"RequestHandler");
	public $helpers = array("NumbersFormat","Paginator");
	public $modelName = "Album";
	public $controllerName = "Albums";
	public $userFilesFolder='albums';
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(empty($this->request->params["admin"])){
			
			
			
		}else{
			
			if($this->Session->read("Admin.level") != 1){
				$this->Session->setFlash("You don't have enought permissions to access this page","admin/admin_err");
				$this->redirect("/admin/Administrators/index");
				exit;
			}
			
			$this->set("menuFlag",4);
			
		}
	}
	
	
	function set_page_title($section=null){
		$menuSectionId='';
		switch ($section){
			case 'home':{
					$page_title="Home Albums";
					$page_sub_title="Home Albums";
					$menuSectionId="general_menu";
					$menuFlag=20;
				
				}
				break;	
			case 'default':{
					$page_title="Albums";
					$page_sub_title="Albums";
					$menuSectionId="general_menu";
					$menuFlag=4;
				
				}
				break;	

				
			}
		
		$this->set("menuFlag",$menuFlag);
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuSectionId",$menuSectionId);
		
	}


	function get_image_resizes($section="news"){
		$userFilesFolder=$this->userFilesFolder;
		switch ($section){
			case "default":
			
				$thumbWidth = "198";
				$thumbHeight = "198";
				
				
				$previewWidth = "980";
				$previewHeight = "230";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
			
		}
		
		return $resizes;
	}
	
	function admin_add($type='default'){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set("folderName","albums");
		$this->set("type",$type);
		$this->set_page_title($type);
		$userFilesFolder=$this->userFilesFolder;
		
		//print_r($this->request->data);exit;
		if (!empty($this->request->data)){
			
				/////////////////////// cover image /////////////////////////////////////
				if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
				
					$resizes = $this->get_image_resizes('default');
					
					$this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
					$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
					if(!$retArray['error']){
						$this->request->data["$modelName"]['image']=$retArray['fileName'];
					}else{
						
						$fileError=$retArray['errorMsg'];
						$this->request->data["$modelName"]['image']='';
						$this->Session->setFlash($fileError);
						$error=1;
					}
				}else{
					$this->request->data["$modelName"]['image']='';
				}
			  ///////////////     end of cover image /////////////////////////
				
					
				$this->$modelName->create();
				$this->fillEmptyMetaFields($modelName);
				
				$this->request->data["$modelName"]['type']=$type;
				
				
				if ($this->$modelName->saveAll($this->request->data)){
					//print_r($this->request->data);exit;
					// $options["modelName"] = $modelName;
					// $options["field_id"] = $this->$modelName->id;
					// $options["folder_name"] = "albums";
					// $options["sizes"]["thumbWidth"] = 120;
					// $options["sizes"]["thumbHeight"] = 68;
					// $options["sizes"]["previewWidth"] = 717;
					// $options["sizes"]["previewHeight"] = 406;
// 					
					// App::import('Controller','Images');
					// $imagesController = new ImagesController;
					// $imagesController->constructClasses();
					// $imagesController->_save_images($this->request->data, $options);
					
					/*SEO MANAGEMENT*/
					//$this->save_seo($modelName);
					/*END SEO MANAGEMENT*/
					$id=$this->$modelName->id;
					$this->Session->setFlash("Item Added Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/edit/$id");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
	}
	
	function admin_index($type='default',$list_all = 0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		$this->set("type",$type);
		$this->set_page_title($type);
		
		$cond = array("$modelName.type"=>$type);
		$fields = array("$modelName.id","$modelName.title","$modelName.modified" ,"$modelName.visible");
		
		if ($list_all == 0){
			$this->paginate = array(
				'fields' => $fields,
				'limit' => 10,
				'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false
			);
		}
		else{
			$this->paginate = array(
				'fields' => $fields,
				'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false
			);
		}
		
		$data = $this->paginate($modelName);
		//print_r($data);exit;
		$this->set('data', $data);
	}
	
	function admin_edit($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set("folderName","albums");
		$this->loadModel("SeoManagement");
		$this->loadModel("Image");
		$userFilesFolder=$this->userFilesFolder;
		$this->set("userFilesFolder",$userFilesFolder);
		
		
		
		$id = (int)$id;
		$this->set('id',$id);
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		$type=$get_data["$modelName"]['type'];
		$this->set("album_type","$type");
		$this->set("type","$type");
		$this->set_page_title($type);
		
		
		
		if($type == 'default'){
			$preferred_size='449 X 314';
			
		}else{
			// $preferred_size='1330 x 313';
			$preferred_size='600 x 417';
			
		}
		
		
		
		$this->set("preferred_size","$preferred_size");
		
		
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		
		if (empty($this->request->data)){
			
			//$this->request->data = $this->findAllTranslations($modelName,$id,array(),array('title' , 'show_on_ui'),array('SeoManagement'));
			$this->request->data = $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title"));
			$seoData = $this->get_all_locales(array("SeoManagement.model_name"=>"$modelName","SeoManagement.field_id"=>$id),"SeoManagement",Configure::read('LOCALES'),array("slug","prepend_title","append_title","title","keywords","description"));
			if(!empty($seoData))
			$this->request->data["SeoManagement"] = $seoData["SeoManagement"];
			//$chosen_images=$this->findAllTranslations('Image',null,array("Image.album_id"=>$id),array("title","caption" ,"image"),array());
			$chosen_images= $this->get_all_locales_multiple(array("Image.album_id"=>$id),"Image",Configure::read('LOCALES'),array("title" ,"caption"));
			// /print_r($chosen_images);exit;
			$this->set("chosen_images",$chosen_images);	
		}
		else{
			//print_r($this->request->data);exit;
				
				
				/////////////////////// cover image /////////////////////////////////////
				if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
				
					$resizes = $this->get_image_resizes('default');
					
					$this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
					$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
					if(!$retArray['error']){
						$this->request->data["$modelName"]['image']=$retArray['fileName'];
					}else{
						
						$fileError=$retArray['errorMsg'];
						$this->request->data["$modelName"]['image']='';
						$this->Session->setFlash($fileError);
						$error=1;
					}
				}else{
					unset($this->request->data["$modelName"]['image']);
				}
			  ///////////////     end of cover image /////////////////////////
			  	
			  
			  	foreach($this->request->data["Image"] as $key=>$img){
			  		
			  			if(isset($img['home_page']) &&  $img['home_page']== 1){
			  				$this->request->data['Image'][$key]['home_page']=1;
			  			}else{
			  				$this->request->data['Image'][$key]['home_page']=0;
			  			}
			  		
			  	}
				//print_r($this->request->data);exit;
				$this->request->data["$modelName"]['id']=$id;
				$this->fillEmptyMetaFields($modelName);
				if ($this->$modelName->saveAll($this->request->data)){
					
					// $options["modelName"] = $modelName;
					// $options["field_id"] = $id;
					// $options["folder_name"] = "albums";
					// $options["sizes"]["thumbWidth"] = 120;
					// $options["sizes"]["thumbHeight"] = 68;
					// $options["sizes"]["previewWidth"] = 717;
					// $options["sizes"]["previewHeight"] = 406;
// 					
					// App::import('Controller','Images');
					// $imagesController = new ImagesController;
					// $imagesController->constructClasses();
					// $imagesController->_save_images($this->request->data, $options);
					
					/*SEO MANAGEMENT*/
					//$this->save_seo($modelName);
					/*END SEO MANAGEMENT*/
			
					$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index/$type");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
	}
	
	function admin_delete($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$folder_name="albums";
		
		$id = (int)$id;
		$get_data = $this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$id),'callbacks'=>false));
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		
		//remove the images files from the server
		App::import('Controller','Images');
		$imagesController = new ImagesController;
		$imagesController->constructClasses();
		$imagesController->admin_delete_related_images($id, $folder_name);
			
		$this->$modelName->id = $id;
		if ($this->$modelName->delete($id)){
			$this->Session->setFlash("Item Deleted Successfully","admin/admin_succ");
			$this->redirect("/admin/$controllerName/index");
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
			if(!$this->RequestHandler->isAjax()){
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
		echo 1;exit;
		
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
	
	function admin_order_images($albumId=null){
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;
		$this->loadModel("Image");

		$this->set("page_title","Album");
		$this->set("page_subtitle","Images");
		$this->set("modelName",$modelName);
		
		$this->set("controllerName",$controllerName);
		$this->set("folderName","albums");
		
		if($albumId==null || !is_numeric($albumId)){
			if(!$this->RequestHandler->isAjax()){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("/admin/$controllerName/index");
			}
			exit;
		}
		$photos=$this->Image->find('all',array('callbacks'=>false,"conditions"=>array("Image.album_id"=>$albumId ),'order'=>array("Image.position"=>"ASC")));
		//print_r($photos);exit;
		$this->set("data",$photos);
	}
	
	function admin_images_ajax_order(){
		$this->loadModel("Image");
		
		$error_flag=0;
		
		foreach ($_GET['row'] as $position => $item) {
			$this->Image->id=$item;
			if($this->Image->saveField('position',$position))
				$error_flag=1;
			else $error_flag=0;
		}
		
		if($error_flag==1)
			echo "<div class='highlight_msg'>The order has been changed successfully</div>";
		exit;
	}
	
	
	// function get_image_resizes($section="about"){
		// switch ($section){
			// case "about":
				// $thumbWidth = "180";
				// $thumbHeight = "90";
// 				
				// $previewWidth = "540";
				// $previewHeight = "270";
// 				
				// $resizes = array(
								// array('folder'=>WWW_ROOT."/files/dynamic_pages/images/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
								// array('folder'=>WWW_ROOT."/files/dynamic_pages/images/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							// );
				// break;
			// default: 
				// $thumbWidth = "180";
				// $thumbHeight = "90";
// 				
				// $previewWidth = "540";
				// $previewHeight = "270";
// 				
				// $resizes = array(
								// array('folder'=>WWW_ROOT."/files/dynamic_pages/images/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
								// array('folder'=>WWW_ROOT."/files/dynamic_pages/images/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							// );
// 							
				// break;
		// }
// 		
		// return $resizes;
	// }
	
	
	

}
?>