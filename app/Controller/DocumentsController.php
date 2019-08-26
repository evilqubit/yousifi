<?php 
App::uses('Sanitize', 'Utility');
class DocumentsController extends AppController{
	public $name = "Documents";
	public $uses = array("Document");
	public $components = array("FileUpload","StringManipulation" ,"RequestHandler","NumbersFormat");
	public $helpers = array("Paginator");
	public $modelName = "Document";
	public $controllerName = "Documents";
	var $userFilesFolder = "documents";
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(empty($this->request->params["admin"])){
			
//			$this->layout='default';

			
		}else{
			
			// $page_title="News";
			// $page_sub_title="News";
// 				
			// $menuFlag=11;
			// $menuSectionId='news_events_menu';
// 			
// 			
			// $this->set("menuFlag",$menuFlag);
			// $this->set("menuSectionId",$menuSectionId);
// 			
			// $this->set("page_title",$page_title);
			// $this->set("page_sub_title",$page_sub_title);
		}
	}
	
	
	function set_page_title($section=null , $type=0){
		$menuSectionId='';
		//print_r($section);exit;
		switch ($section){
			case 'about_hbku':{
					$page_title="About HBKU";
					$page_sub_title="About HBKU Document";
					$menuSectionId="about_menu";
					$menuFlag=2;
				
				}
				break;	
			case 'colleges':{
					$page_title="About Colleges";
					$page_sub_title="About Colleges Document";
					$menuSectionId="colleges_menu";
					$menuFlag=8;
				
				}
				break;	
			
			
			case 'admissions_aid':{
					$page_title="Admissions & Aid";
					$page_sub_title="Admissions & Aid Document";
					$menuSectionId="admissions_aid_menu";
					$menuFlag=9;
				
				}
				break;	
			case 'campus_life':{
					$page_title="Campus Life";
					$page_sub_title="Campus Life Document";
					$menuSectionId="campus_life_menu";
					$menuFlag=10;
				
				}
				break;	
			case 'news':{
					$page_title="News";
					$page_sub_title="News";
						
					$menuFlag=11;
					$menuSectionId='news_events_menu';
				
				}
				break;
			case 'institutes_centers':{
					$page_title="Institutes Center";
					$page_sub_title="Institutes Center Document";
						
					$menuFlag=12;
					$menuSectionId='institutes_centers_menu';
				
				}
				break;
				
			case 'special_programs':{
					$page_title="Institutes Center";
					$page_sub_title="Institutes Center Document";
						
					$menuFlag=13;
					$menuSectionId='special_programs_menu';
				
				}
				break;
				
			case 'executive_master':{
					if($type == 'informative_files'){
							$page_title="Informative Files";
							$page_sub_title="Informative Files";
								
							$menuFlag=16;
							$menuSectionId='executive_master_menu';
						
					}else{
							$page_title="Application Files";
							$page_sub_title="Application Files";
								
							$menuFlag=17;
							$menuSectionId='executive_master_menu';
					}
				
					
				
				}
				break;
			case 'related_pages':{
					
					$page_title="Related Pages";
					$page_sub_title="Related Page";
						
					$menuSectionId="colleges_menu";
					$menuFlag=18;
					
				}
				break;
				
			case 'hbku_employee':{
					
					$page_title="HBKU Employee files";
					$page_sub_title="HBKU Employee files";
						
					$menuSectionId="hbku_employee_menu";
					$menuFlag=19;
					
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
			case "news":
			
				$thumbWidth = "198";
				$thumbHeight = "198";
				
				$listWidth = "309";
				$listHeight = "205";
				
				$previewWidth = "482";
				$previewHeight = "320";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/list","width"=>$listWidth,"height"=>$listHeight,'force'=>false),
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
			
		}
		
		return $resizes;
	}
	
	function admin_index($source_id ,$list_all = 0 , $related_pages=0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		$this->set('source_id',$source_id);
		
		$this->loadModel("DynamicPage");
		
		
		
		
		
		$fields = array("$modelName.id","$modelName.title" ,"$modelName.modified" ,"$modelName.visible");
		
		
		
		if($related_pages == 0){
			$section=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.id'=>$source_id)));
			//print_r($section['DynamicPage']['section']);exit;
			$this->set_page_title($section['DynamicPage']['section']);
			//print_r($section['DynamicPage']['section']);exit;
			$related_pages=0;
			$cond = array("$modelName.dynamic_pages_id"=>$source_id);
		}else{
			
			$this->set_page_title("related_pages");
			$related_pages=1;
			$cond = array("$modelName.related_page_id"=>$source_id);
			//print_r($section['DynamicPage']['section']);exit;
		}
		
		$this->set("related_pages",$related_pages);
		
			
		
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
		
		$this->set('data', $data);
	}
	function admin_index_2($section=0,$type=0 ,$list_all = 0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		$this->set('section',$section);
		$this->set('type',$type);
		
		$this->loadModel("DynamicPage");
		
		
		$s_id=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.section'=>$section)));
		$source_id = $s_id["DynamicPage"]['id'];
		
		
		$cond = array("$modelName.dynamic_pages_id"=>$source_id,"$modelName.type"=>$type);
		$fields = array("$modelName.id","$modelName.title" ,"$modelName.modified" ,"$modelName.visible");
		
		
		$this->set_page_title($section,$type);
		
	
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
		
		$this->set('data', $data);
	}
	function admin_add($source_id,$related_pages=0){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		$locales = Configure::read("LOCALES");
		$userFilesFolder = $this->userFilesFolder;
		
		$this->set("source_id","$source_id");
		
		// $server_videos_list=$this->get_videos_list();
		// $this->set("server_videos_list",$server_videos_list);
// 		
		// $albums_list = $this->get_photo_album_list();
		// $this->set("albums_list",$albums_list);
		
		//print_r($this->request->data);exit;
		
		$this->loadModel("DynamicPage");
		// $section=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.id'=>$source_id)));
		// $this->set_page_title($section['DynamicPage']['section']);
		
		
		if($related_pages == 0){
			$section=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.id'=>$source_id)));
			//print_r($section['DynamicPage']['section']);exit;
			$this->set_page_title($section['DynamicPage']['section']);
			//print_r($section['DynamicPage']['section']);exit;
			$related_pages=0;
		}else{
			
			$this->set_page_title("related_pages");
			$related_pages=1;
			//print_r($section['DynamicPage']['section']);exit;
		}
		
		$this->set("related_pages",$related_pages);
		
		
		if (!empty($this->request->data)){
				/*////////////////// 				Upload document 		///////////////////////////// 	**/
				$cacheId = "all_languages";
				if (($languages = Cache::read($cacheId)) === false) {
					$this->loadModel("Language");
					$languages=$this->Language->find('all',array('callbacks'=>false));
					Cache::write($cacheId, $languages);
				}
	
				foreach ($languages as $lang){
					$locale = $lang["Language"]["locale"];
	
					if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale])){
						if(!empty($this->request->data[$modelName]['document'][$locale]['name'])){
							
							$this->request->data[$modelName]['document'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['document'][$locale]['name']);
							$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder",'document',array('extensions'=>array('doc', 'docx', 'pdf'),'randomName'=>false));
							if(!$fileArray['error']){
								$this->request->data["$modelName"]['document'][$locale]=$fileArray['fileName'];
							}else{
								$fileError=$fileArray['errorMsg'];
								$this->request->data["$modelName"]['document'][$locale]='';
								$this->Session->setFlash($fileError);
								$error=1;
							}
						}else{
							$this->request->data["$modelName"]['document'][$locale]='';
						}
					}else{
						$this->request->data["$modelName"]['document'][$locale]='';
					}
				}
				/*////////////////// 			end of Upload document 		///////////////////////////// 	**/
					
				
			
			
					
				$this->$modelName->create();
				
				
				if($related_pages == 0){
					$this->request->data["$modelName"]['dynamic_pages_id']=$source_id;
				
				}else{
					$this->request->data["$modelName"]['dynamic_pages_id']=0;
					$this->request->data["$modelName"]['related_page_id']=$source_id;
				
				}
				if ($this->$modelName->saveAll($this->request->data)){
					$id=$this->$modelName->id;
				
					$this->Session->setFlash("Item Added Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index/$source_id/0/$related_pages");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
	}
	
	function admin_add_2($section=0,$type=0){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		$locales = Configure::read("LOCALES");
		$userFilesFolder = $this->userFilesFolder;
		
		$this->set('section',$section);
		$this->set('type',$type);
		
		$this->loadModel("DynamicPage");
		
		
		$s_id=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.section'=>$section)));
		$source_id = $s_id["DynamicPage"]['id'];
		
		
		$cond = array("$modelName.dynamic_pages_id"=>$source_id,"$modelName.type"=>$type);
		$fields = array("$modelName.id","$modelName.title" ,"$modelName.modified" ,"$modelName.visible");
		
		// $server_videos_list=$this->get_videos_list();
		// $this->set("server_videos_list",$server_videos_list);
// 		
		// $albums_list = $this->get_photo_album_list();
		// $this->set("albums_list",$albums_list);
		
		//print_r($this->request->data);exit;
		
		
		// $section=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.id'=>$source_id)));
		$this->set_page_title($section,$type);
		
		if (!empty($this->request->data)){
				/*////////////////// 				Upload document 		///////////////////////////// 	**/
				$cacheId = "all_languages";
				if (($languages = Cache::read($cacheId)) === false) {
					$this->loadModel("Language");
					$languages=$this->Language->find('all',array('callbacks'=>false));
					Cache::write($cacheId, $languages);
				}
	
				foreach ($languages as $lang){
					$locale = $lang["Language"]["locale"];
					
					
					
					
					
					if($section == 'hbku_employee'){
						$file_type=$this->request->data["$modelName"]['file_type'];
						
						if($file_type == 'file' ){
							if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale])){
								if(!empty($this->request->data[$modelName]['document'][$locale]['name'])){
									
									$this->request->data[$modelName]['document'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['document'][$locale]['name']);
									$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder",'document',array('extensions'=>array('ppt','pptx','xls','xlsx','doc', 'docx', 'pdf'),'randomName'=>false));
									if(!$fileArray['error']){
										$this->request->data["$modelName"]['document'][$locale]=$fileArray['fileName'];
									}else{
										$fileError=$fileArray['errorMsg'];
										$this->request->data["$modelName"]['document'][$locale]='';
										$this->Session->setFlash($fileError);
										$error=1;
									}
								}else{
									$this->request->data["$modelName"]['document'][$locale]='';
								}
							}else{
								$this->request->data["$modelName"]['document'][$locale]='';
							}
						}else{
							
							
							if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale]["name"])){
					
								$this->request->data[$modelName]["document"][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]["document"][$locale]['name']);
								$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder/images",'image',array('resize'=>false,'resizeOptions'=>'','randomName'=>false));
								if(!$retArray['error']){
									$this->request->data["$modelName"]["document"][$locale]=$retArray['fileName'];
								}else{
				
									$fileError=$retArray['errorMsg'];
									$this->request->data["$modelName"]["document"][$locale]='';
									$this->Session->setFlash($fileError);
									$error=1;
								}
							}else{
								$this->request->data["$modelName"]["document"][$locale]='';
							}						
						}
						
					}else{
					
					
					
					
	
					if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale])){
						if(!empty($this->request->data[$modelName]['document'][$locale]['name'])){
							
							
							$this->request->data[$modelName]['document'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['document'][$locale]['name']);
							$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder",'document',array('extensions'=>array('doc', 'docx', 'pdf'),'randomName'=>false));
							if(!$fileArray['error']){
								$this->request->data["$modelName"]['document'][$locale]=$fileArray['fileName'];
							}else{
								$fileError=$fileArray['errorMsg'];
								$this->request->data["$modelName"]['document'][$locale]='';
								$this->Session->setFlash($fileError);
								$error=1;
							}
						}else{
							$this->request->data["$modelName"]['document'][$locale]='';
						}
					}else{
						$this->request->data["$modelName"]['document'][$locale]='';
					}
				}
				
				/*////////////////// 			end of Upload document 		///////////////////////////// 	**/
				}	
				
			
			
					
				$this->$modelName->create();
				$this->request->data["$modelName"]['dynamic_pages_id']=$source_id;
				$this->request->data["$modelName"]['type']=$type;
				
				if ($this->$modelName->saveAll($this->request->data)){
					$id=$this->$modelName->id;
				
					$this->Session->setFlash("Item Added Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index_2/$section/$type");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
	}

	function admin_edit_2($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
	
		$locales = Configure::read("LOCALES");
		$userFilesFolder = $this->userFilesFolder;
		$this->set("userFilesFolder","$userFilesFolder");
		
		
		
		
		$id = (int)$id;
		$this->set('id',$id);
		$get_data =$this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","document","download_title"));
		$type=$get_data["$modelName"]['type'];
		$source_id=$get_data["$modelName"]['dynamic_pages_id'];
		$type=$get_data["$modelName"]['type'];
		$this->loadModel("DynamicPage");
		$sec=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.id'=>$source_id)));
		
		$section=$sec['DynamicPage']['section'];
		
		$this->set_page_title($sec['DynamicPage']['section'],$type);
		$this->set("source_id","$source_id");
		$this->set("section",$section);
		
		//print_r($get_data);exit;
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		
		if (empty($this->request->data)){
			$this->request->data = $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","document","download_title"));			
		}
		else{
				//print_r($this->request->data);exit;
			
				//////////////////     save document 		////////////////////////
				$cacheId = "all_languages";
				if (($languages = Cache::read($cacheId)) === false) {
					$this->loadModel("Language");
					$languages=$this->Language->find('all',array('callbacks'=>false));
					Cache::write($cacheId, $languages);
				}
	
				foreach ($languages as $lang){
					$locale = $lang["Language"]["locale"];
					
					
					
					
					if($section == 'hbku_employee'){
						$file_type=$this->request->data["$modelName"]['file_type'];
						
						
						if($file_type == 'file' ){
							if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale])){
								if(!empty($this->request->data[$modelName]['document'][$locale]['name'])){
									
									$this->request->data[$modelName]['document'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['document'][$locale]['name']);
									$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder",'document',array('extensions'=>array('ppt','pptx','xls','xlsx','doc', 'docx', 'pdf'),'randomName'=>false));
									if(!$fileArray['error']){
										$this->request->data["$modelName"]['document'][$locale]=$fileArray['fileName'];
									}else{
										$fileError=$fileArray['errorMsg'];
										$this->request->data["$modelName"]['document'][$locale]='';
										$this->Session->setFlash($fileError);
										$error=1;
									}
								}else{
									unset($this->request->data["$modelName"]['document'][$locale]);
									$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
								}
							}else{
								unset($this->request->data["$modelName"]['document'][$locale]);
								$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
							}
							
						}else{
							
							
							if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale]["name"])){
					
								$this->request->data[$modelName]["document"][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]["document"][$locale]['name']);
								$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder/images",'image',array('resize'=>false,'resizeOptions'=>'','randomName'=>false));
								
								if(!$retArray['error']){
									$this->request->data["$modelName"]["document"][$locale]=$retArray['fileName'];
								}else{
				
									$fileError=$retArray['errorMsg'];
									$this->request->data["$modelName"]["document"][$locale]='';
									$this->Session->setFlash($fileError);
									$error=1;
								}
							}else{
								unset($this->request->data["$modelName"]['document'][$locale]);
								$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
							}						
						}
						
					}else{ 
	
					if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale])){
						if(!empty($this->request->data[$modelName]['document'][$locale]['name'])){
							$this->request->data[$modelName]['document'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['document'][$locale]['name']);
							$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder",'document',array('extensions'=>array('doc', 'docx', 'pdf'),'randomName'=>false));
							if(!$fileArray['error']){
								$this->request->data["$modelName"]['document'][$locale]=$fileArray['fileName'];
							}else{
								$fileError=$fileArray['errorMsg'];
								$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
								$this->Session->setFlash($fileError);
								$error=1;
							}
						}else{
							unset($this->request->data["$modelName"]['document'][$locale]);
							$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
						}
					}else{
						unset($this->request->data["$modelName"]['document'][$locale]);
						$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
					}
				}

				}
				////////////////////			end of saving document 			//////////////////////////
				$this->request->data["$modelName"]['id']=$id;
				$this->request->data["$modelName"]['dynamic_pages_id']=$source_id;
				
				$this->request->data["$modelName"]['type']=$type;
				
				if ($this->$modelName->saveAll($this->request->data)){
					
					
					$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index_2/{$section}/$type");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
	}
	function admin_edit($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
	
		$locales = Configure::read("LOCALES");
		$userFilesFolder = $this->userFilesFolder;
		$this->set("userFilesFolder","$userFilesFolder");
		
		
		
		
		$id = (int)$id;
		$this->set('id',$id);
		$get_data =$this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","document","download_title" ));
		
	
		$related_pages=$get_data["$modelName"]['related_page_id'];
		
		if($related_pages == 0){
			$source_id=$get_data["$modelName"]['dynamic_pages_id'];
			$this->loadModel("DynamicPage");
			$section=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.id'=>$source_id)));
			$this->set_page_title($section['DynamicPage']['section']);
		}else{
			$source_id=$get_data["$modelName"]['related_page_id'];
			
			$this->set_page_title('related_pages');
		}
		
		$this->set("source_id","$source_id");
		
		
		//print_r($get_data);exit;
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		
		if (empty($this->request->data)){
			$this->request->data = $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","document","download_title"));			
		}
		else{
				//////////////////     save document 		////////////////////////
				$cacheId = "all_languages";
				if (($languages = Cache::read($cacheId)) === false) {
					$this->loadModel("Language");
					$languages=$this->Language->find('all',array('callbacks'=>false));
					Cache::write($cacheId, $languages);
				}
	
				foreach ($languages as $lang){
					$locale = $lang["Language"]["locale"];
	
					if (isset($this->request->data[$modelName]["document"][$locale]) && !empty($this->request->data[$modelName]["document"][$locale])){
						if(!empty($this->request->data[$modelName]['document'][$locale]['name'])){
							$this->request->data[$modelName]['document'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['document'][$locale]['name']);
							$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["document"][$locale],WWW_ROOT."/files/$userFilesFolder",'document',array('extensions'=>array('doc', 'docx', 'pdf'),'randomName'=>false));
							if(!$fileArray['error']){
								$this->request->data["$modelName"]['document'][$locale]=$fileArray['fileName'];
							}else{
								$fileError=$fileArray['errorMsg'];
								$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
								$this->Session->setFlash($fileError);
								$error=1;
							}
						}else{
							unset($this->request->data["$modelName"]['document'][$locale]);
							$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
						}
					}else{
						unset($this->request->data["$modelName"]['document'][$locale]);
						$this->request->data["$modelName"]['document'][$locale]=$get_data["$modelName"]['document'][$locale];
					}
				}
				////////////////////			end of saving document 			//////////////////////////
				$this->request->data["$modelName"]['id']=$id;
				
				//$this->request->data["$modelName"]['dynamic_pages_id']=$source_id;
				
				if ($this->$modelName->saveAll($this->request->data)){
					
					
					
					$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
					
					$this->redirect("/admin/$controllerName/index/$source_id/0/$related_pages");
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
		$userFilesFolder=$this->userFilesFolder;
		
		$id = (int)$id;
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		if($id==null || !is_numeric($id) || empty($get_data)){
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("/admin/administrators");
				exit;
			}else{
				echo "Invalid Request";
				exit;
			}
		}

		$this->$modelName->id = $id;
		if ($this->$modelName->delete($id)){
			$document_name=$get_data["$modelName"]['document'];
			
			
			
			
			$document_location=WWW_ROOT."/files/$userFilesFolder/$document_name";
			
			
			if(file_exists($document_location))
			unlink($document_location);
			
			
			
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Item Deleted Successfully","admin/admin_succ");
				$this->redirect("/admin/administrators");
				exit;
			}else{
				echo 1;
				exit;
			}
		}
		else {
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Item could not be deleted. Please try again later.","admin/admin_err");
				$this->redirect("/admin/administrators");
				exit;
			}else{
				echo "Item could not be deleted. Please try again later.";
				exit;
			}
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
	

// 	///////////////////////////////// end of admin functions ///////////////////////////////


	
	

}
?>