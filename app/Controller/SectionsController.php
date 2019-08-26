<?php 
App::uses('Sanitize', 'Utility');
class SectionsController extends AppController{
	public $name = "Sections";
	public $uses = array("Section");
	public $components = array("FileUpload","StringManipulation" ,"RequestHandler","NumbersFormat");
	public $helpers = array("Paginator",'NumbersFormat');
	public $modelName = "Section";
	public $controllerName = "Sections";
	var $userFilesFolder = "sections";
	
	
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(empty($this->request->params["admin"])){
			
//			$this->layout='default';

			
		}else{
			
			$page_title="Sections";
			$page_sub_title="Sections";
				
			$menuFlag=11;
			$menuSectionId='employee';
			
			
			$this->set("menuFlag",$menuFlag);
			$this->set("menuSectionId",$menuSectionId);
			
			$this->set("page_title",$page_title);
			$this->set("page_sub_title",$page_sub_title);
		}
	}
	
	
	
		//// size of images for media section
	function set_media_preferred_size($type='default'){		
		$media_preferred_size='';		
		if($type == 'default'){
			//$media_preferred_size='227 x 129 px';
			$media_preferred_size='730 x 532 px';
		}
		$this->set(compact('media_preferred_size'));
	}	
	
	
	
	function set_page_title($section=null , $type='section'){
		$menuSectionId='';
		
		switch ($section){
			case 'shop':{
				
					$page_title="Shop";
					$page_sub_title="Shop";
					$menuSectionId="shop";
					$menuFlag=20;
				
				}
				break;	
			case 'dine':{
				
					$page_title="Dine";
					$page_sub_title="Dine";
					$menuSectionId="dine";
					$menuFlag=20;
				
				}
				break;		
				
			case 'entertain':{
				
					$page_title="Entertain";
					$page_sub_title="Entertain";
					$menuSectionId="entertain";
					$menuFlag=20;
				
				}
				break;		
			
			case 'home_opening_hours':{
				
					$page_title="Home Opening hours";
					$page_sub_title="Home Opening hours";
					$menuSectionId="header";
					$menuFlag=20;
				
				}
				break;			
			
			case 'overview':{
				
					$page_title="Overview";
					$page_sub_title="Overview";
					$menuSectionId="overview";
					$menuFlag=20;
				
				}
				break;
				
			case 'opening_hours':{
					
					
					if($type == 'section'){
						$page_title="Opening hours Section details";
						$page_sub_title="Opening hours Section details";
						$menuSectionId="overview";
						$menuFlag=20;
					}else{
						$page_title="Opening hours";
						$page_sub_title="Opening hours";
						$menuSectionId="overview";
						$menuFlag=20;
					}	
					
				
				}
				break;	
				
				
			case 'articles':{
					
					
					if($type == 'section'){
						$page_title="Articles Section details";
						$page_sub_title="Articles Section details";
						$menuSectionId="articles";
						$menuFlag=20;
					}else{
						$page_title="Articles";
						$page_sub_title="Articles";
						$menuSectionId="articles";
						$menuFlag=20;
					}	
					
				
				}
				break;	
				
			case 'videos':{
					
					
					if($type == 'section'){
						$page_title="Videos Section details";
						$page_sub_title="Videos Section details";
						$menuSectionId="articles";
						$menuFlag=20;
					}else{
						$page_title="Videos";
						$page_sub_title="Videos";
						$menuSectionId="articles";
						$menuFlag=20;
					}	
					
				
				}
				break;	
				
				
			case 'careers':{
					
					
					$page_title="Careers Section details";
					$page_sub_title="Careers Section details";
					$menuSectionId="careers";
					$menuFlag=20;
				
				
				}
				break;	
			
			case 'services':{
					
					
					$page_title="services Section details";
					$page_sub_title="services Section details";
					$menuSectionId="services";
					$menuFlag=20;
				
				
				}
				break;	
			
			case 'get_here':{
					
					if($type == 'section'){
						$page_title="How To Get Here Section details";
						$page_sub_title="How To Get Here Section details";
						$menuSectionId="get_here";
						$menuFlag=20;
					}else{
						$page_title="How To Get Here Attributes";
						$page_sub_title="How To Get Here Attributes";
						$menuSectionId="get_here";
						$menuFlag=20;
					}	
					
				
				}
				break;	
			
			
			case 'terms_conditions':{
					$page_title="terms and conditions Section details";
					$page_sub_title="terms and conditions Section details";
					$menuSectionId="terms_conditions";
					$menuFlag=20;
				}
				break;	
			
			
			case 'privacy':{
					$page_title="privacy Section details";
					$page_sub_title="privacy Section details";
					$menuSectionId="privacy";
					$menuFlag=20;
				}
				break;	
			
			
			case 'sitemap':{
					$page_title="sitemap Section details";
					$page_sub_title="sitemap Section details";
					$menuSectionId="sitemap";
					$menuFlag=20;
				}
				break;	
			
			
			case 'contact':{
					$page_title="contact Section details";
					$page_sub_title="contact Section details";
					$menuSectionId="contact";
					$menuFlag=20;
				}
				break;	
			
			
			case 'store_locator':{
					$page_title="store locator Section details";
					$page_sub_title="store locator Section details";
					$menuSectionId="store_locator";
					$menuFlag=20;
				}
				break;	
			
			
			
			
			
			}
		
		
		$this->set("menuFlag",$menuFlag);
		
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuSectionId",$menuSectionId);
		
		
	}
	
	function set_preferred_size($section , $is_video=0){
		
		$preferred_size='';
		if($section == 'opening_hours'){
			$preferred_size='227 x 129 px';
		}
		
		
		if($section == 'articles'){
			if($is_video == 0){
				$preferred_size='480 x 350 px';
			}else{
				$preferred_size='355 x 197 px';
			}
			
		}
		
		if($section == 'videos'){
			if($is_video == 0){
				$preferred_size='480 x 350 px';
			}else{
				
				
				$preferred_size='480 x 267 px';
			}
			
		}
		if($section == 'get_here'){
			$preferred_size='43 x 43 px';
		}
		
		return $preferred_size;
	}	
	
	function get_image_resizes($section="news" , $is_video=0){
		$userFilesFolder=$this->userFilesFolder;
		switch ($section){
			case "opening_hours":
			
				$thumbWidth = "227";
				$thumbHeight = "129";
			
				
				$previewWidth = "227";
				$previewHeight = "129";
				
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
				
			case "articles":
				
				
				if($is_video == 0){
					$thumbWidth = "227";
					$thumbHeight = "129";
					
					$previewWidth = "480";
					$previewHeight = "350";
					
					
					$resizes = array(
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
								);
				}else{
					$thumbWidth = "227";
					$thumbHeight = "129";
				
					
					$previewWidth = "355";
					$previewHeight = "197";
					
					
					$resizes = array(
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
								);
				}
				
				break;	
				
			case "videos":
				
				
				if($is_video == 0){
					$thumbWidth = "227";
					$thumbHeight = "129";
					
					$previewWidth = "480";
					$previewHeight = "350";
					
					
					$resizes = array(
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
								);
				}else{
					$thumbWidth = "227";
					$thumbHeight = "129";
				
					
					$previewWidth = "480";
					$previewHeight = "267";
					
					
					$resizes = array(
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
									array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
								);
				}
				
				break;	
				
			case "get_here":
			
				$thumbWidth = "43";
				$thumbHeight = "43";
			
				
				// $previewWidth = "480";
				// $previewHeight = "350";
				
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								//array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
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
				$this->request->data["$modelName"]['internal_title']["$locale"]='';
			}
			
			if(!isset($this->request->data["$modelName"]['text_1']["$locale"])){
				$this->request->data["$modelName"]['text_1']["$locale"]='';
			}
			
			if(!isset($this->request->data["$modelName"]['text_2']["$locale"])){
				$this->request->data["$modelName"]['text_2']["$locale"]='';
			}
			if(!isset($this->request->data["$modelName"]['text_3']["$locale"])){
				$this->request->data["$modelName"]['text_3']["$locale"]='';
			}
			
			if(!isset($this->request->data["$modelName"]['image']["$locale"])){
				$this->request->data["$modelName"]['image']["$locale"]='';
			}
			
			if(!isset($this->request->data["$modelName"]['file']["$locale"])){
				$this->request->data["$modelName"]['file']["$locale"]='';
			}
			
			
			
		}
	}

	

	
	function admin_edit_section($section){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->loadModel("SeoManagement");
		
		$this->set("section",$section);
		
		
		//print_R($this->template);exit;
		
		$userFilesFolder=$this->userFilesFolder;
		$this->set("userFilesFolder",$userFilesFolder);
		$locales = Configure::read("LOCALES");
	
		
		$this->set_page_title($section , 'section');
		
		$get_data =  $this->get_all_locales(array("$modelName.section"=>$section,"$modelName.section_id"=>0),"$modelName",Configure::read('LOCALES'),array("title","internal_title","text_1",'text_2','text_3' ,'image','file'),array("SeoManagement"));
		
		
		
		
		$this->set("preferred_size",$this->set_preferred_size($section));
		
		
		if(empty($get_data)){
			$data["$modelName"]['id']=0;
			$data["$modelName"]['section']=$section;
			
			
			$unique_salt=Configure::read('Security.salt');
			$hashed_id=md5($unique_salt. time());
			$this->request->data["$modelName"]['hashed_id']=$hashed_id;
		
			
			
			$this->fill_empty_fields();
			
			
			
			$this->$modelName->create();
			$this->$modelName->saveAll($data);
			
			$get_data =  $this->get_all_locales(array("$modelName.section"=>$section ,"$modelName.section_id"=>0),"$modelName",Configure::read('LOCALES'),array("title","internal_title","text_1",'text_2','text_3' ,'image'),array("SeoManagement"));
			
		}
		
		
		
		$id=$get_data["$modelName"]['id'];
		$hashed_id=$get_data["$modelName"]['hashed_id'];
		$this->set("hashed_id",$hashed_id);
		
		$this->set('id',$id);
		
		if (empty($this->request->data)){
			$this->request->data = $get_data;
			//print_R($this->request->data);exit;
			
			$seoData = $this->get_all_locales(array("SeoManagement.model_name"=>"$modelName","SeoManagement.field_id"=>$id),"SeoManagement",Configure::read('LOCALES'),array("slug","prepend_title","append_title","title","keywords","description"));
			//print_r($seoData);exit;
			if(!empty($seoData))
			$this->request->data["SeoManagement"] = $seoData["SeoManagement"];
			
			
			$this->loadModel("Image");
			
			//$chosen_images=$this->Image->find("all",array("conditions"=>array("Image.module_name"=>"Section","Image.module_id"=>$id)));
			
			$chosen_images= $this->get_all_locales_multiple(array("Image.module_name"=>"Section","Image.module_id"=>$id),"Image",Configure::read('LOCALES'),array("title" ,"caption"));
			$this->set("chosen_images",$chosen_images);
			//print_R($chosen_images);exit;
		}
		else{
				
				//print_r($this->request->data);exit;
				$this->request->data["$modelName"]['id']=$id;
			
				if(isset($this->request->data["Image"])){
					$images=$this->request->data["Image"];
					unset($this->request->data["Image"]);
				}	
				
				
				//print_r($this->request->data);exit;			
				$this->fillEmptyMetaFields($modelName);
				//print_r($this->request->data);exit;
				if ($this->$modelName->saveAll($this->request->data)){
				
				
				
				///////////// udate images
					$id = $this->$modelName->id;
					$this->loadModel("Image");
					
					// updating the media items with the hashed id
					if(isset( $images ) && !empty($images)){
						
						foreach($images as $img){
							$img_d['Image']['id']=$img['id'];
							$img_d['Image']['module_id']=$id;
							$img_d['Image']['title']=$img['title'];
							$img_d['Image']['caption']=$img['caption'];
							$img_d['Image']['url']=$img['url'];
							$img_d['Image']['hashed_id']=$this->request->data["$modelName"]['hashed_id'];
							//print_r($img_d);exit;
							$this->Image->saveAll($img_d);
						}	
					}
					
						
					
					
					/** save relations **/	
						
					//if the user didnt change any related items 
					// if(isset($pagesRelations)){
						// $this->request->data["PagesRelation"] = $pagesRelations;
// 					
						// $modelId = $this->$modelName->id;
						// //$this->DynamicPage->id=$modelId;
						// $relationsCount = 0;
						// $this->loadModel("PagesRelation");
// 						
						// //print_r($pagesRelations);exit;
						// if(isset($pagesRelations)){
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'HeaderCommunicationBanner' ));
						// }else{
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));
						// }
// 						
						// if(isset($this->request->data["PagesRelation"]) && !empty($this->request->data["PagesRelation"])){
							// foreach ($this->request->data["PagesRelation"] as $relationModel=>$relationModelEntries){
// 								
								// foreach ($relationModelEntries as $relationEntry){
									// $data["PagesRelation"][$relationsCount]["id"] = 0;
									// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
									// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
									// $data["PagesRelation"][$relationsCount]["related_model"] = $relationModel;
									// $data["PagesRelation"][$relationsCount]["related_id"] = $relationEntry;
// 
									// $relationsCount++;
// 								
							// }
						// }
						// //print_r($data);exit;
						// if(isset($data)){
							// $this->PagesRelation->saveAll($data["PagesRelation"]);
						// }
// 						
					// }
					// }else{
						// $modelId = $this->$modelName->id;
						// //$this->DynamicPage->id=$modelId;
						// $this->loadModel('PagesRelation');
// 					
					// //print_r($this->request->data);exit;
						// if(isset($this->request->data["$modelName"]['has_communication_banner']) && $this->request->data["$modelName"]['has_communication_banner'] == 0 ){
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'HeaderCommunicationBanner' ));
						// }
					// }
					
					
					/////////////////////////////////////////////////	
					
					
					
					$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/edit_section/$section");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
	}
	
	
	
	function admin_upload_section_images($section , $type=1){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->loadModel("SeoManagement");
		
		$image_types=$this->image_types;
		$this->set("image_types",$image_types);
		
		$this->set("type",$type);
		
		$this->set("templates",$this->template);
		
		$userFilesFolder=$this->userFilesFolder;
		$this->set("userFilesFolder",$userFilesFolder);
		$locales = Configure::read("LOCALES");
	
		
		$this->set_page_title($section);
		
		//$get_data =  $this->get_all_locales(array("$modelName.section"=>$section),"$modelName",Configure::read('LOCALES'),array("title","internal_title","text_1",'text_2','text_3'),array("SeoManagement"));
		$get_data=$this->$modelName->find("first",array("conditions"=>array("$modelName.section"=>$section)));
		//print_R($get_data);exit;
		
		
		$this->set('section',$section);
		
		$preferred_size='';
		if($type == 1){
			$preferred_size='319 x 239 px';
			
		}elseif($type == 2){
			$preferred_size='335 x 717 px';

		}
		
		
		if($section == 'careers'){
			$preferred_size='654 x 717 px';
		}
		
		$this->set("preferred_size",$preferred_size);
		
		
	
		//print_R($get_data);exit;
		$id=$get_data["$modelName"]['id'];
		$hashed_id=$get_data["$modelName"]['hashed_id'];
		$this->set("hashed_id",$hashed_id);
		
		$this->set('id',$id);
		
		if (empty($this->request->data)){
			$this->request->data = $get_data;
			
			$this->loadModel("Image");
			
			//$chosen_images=$this->Image->find("all",array("conditions"=>array("Image.module_name"=>"Section","Image.module_id"=>$id)));
			
			$chosen_images= $this->get_all_locales_multiple(array("Image.module_name"=>"Section","Image.type"=>$type,"Image.module_id"=>$id),"Image",Configure::read('LOCALES'),array("title" ,"caption"));
			$this->set("chosen_images",$chosen_images);
			//print_R($chosen_images);exit;
		}
		else{
				
				//print_r($this->request->data);exit;
				//$this->request->data["$modelName"]['id']=$id;
			
				if(isset($this->request->data["Image"])){
					$images=$this->request->data["Image"];
					unset($this->request->data["Image"]);
				}	
				
				
				
				if (true){
				
				
				
				///////////// udate images
					$id = $get_data["$modelName"]['id'];
					$this->loadModel("Image");
					
					// updating the media items with the hashed id
					if(isset( $images ) && !empty($images)){
						
						foreach($images as $img){
							$img_d['Image']['id']=$img['id'];
							$img_d['Image']['module_id']=$id;
							$img_d['Image']['title']=$img['title'];
							$img_d['Image']['caption']=$img['caption'];
							$img_d['Image']['url']=$img['url'];
							$img_d['Image']['hashed_id']=$get_data["$modelName"]['hashed_id'];
							//print_r($img_d);exit;
							$this->Image->saveAll($img_d);
						}	
					}
					
						
					
					
					/** save relations **/	
						
					//if the user didnt change any related items 
					// if(isset($pagesRelations)){
						// $this->request->data["PagesRelation"] = $pagesRelations;
// 					
						// $modelId = $this->$modelName->id;
						// //$this->DynamicPage->id=$modelId;
						// $relationsCount = 0;
						// $this->loadModel("PagesRelation");
// 						
						// //print_r($pagesRelations);exit;
						// if(isset($pagesRelations)){
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'HeaderCommunicationBanner' ));
						// }else{
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));
						// }
// 						
						// if(isset($this->request->data["PagesRelation"]) && !empty($this->request->data["PagesRelation"])){
							// foreach ($this->request->data["PagesRelation"] as $relationModel=>$relationModelEntries){
// 								
								// foreach ($relationModelEntries as $relationEntry){
									// $data["PagesRelation"][$relationsCount]["id"] = 0;
									// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
									// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
									// $data["PagesRelation"][$relationsCount]["related_model"] = $relationModel;
									// $data["PagesRelation"][$relationsCount]["related_id"] = $relationEntry;
// 
									// $relationsCount++;
// 								
							// }
						// }
						// //print_r($data);exit;
						// if(isset($data)){
							// $this->PagesRelation->saveAll($data["PagesRelation"]);
						// }
// 						
					// }
					// }else{
						// $modelId = $this->$modelName->id;
						// //$this->DynamicPage->id=$modelId;
						// $this->loadModel('PagesRelation');
// 					
					// //print_r($this->request->data);exit;
						// if(isset($this->request->data["$modelName"]['has_communication_banner']) && $this->request->data["$modelName"]['has_communication_banner'] == 0 ){
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'HeaderCommunicationBanner' ));
						// }
					// }
					
					
					/////////////////////////////////////////////////	
					
					
					
					$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/upload_section_images/$section/$type");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
	}



	
	function admin_index($section,$list_all = 0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		
		if($section != null){
			
		}else{
			$this->Session->setFlash("invalide path","admin/admin_error");
			$this->redirect("/admin/$controllerName/administrators");
			exit;
		}
		
		$this->set_page_title($section , 'list');
		
		$this->set("section",$section);
		
		$d=$this->$modelName->find("first",array("conditions"=>array("$modelName.section"=>$section , "$modelName.section_id"=>0) ,'contain'=>false));
		$section_id=$d["$modelName"]['id'];
		
		
		
		$search_cond="";
		if(isset($_GET['s'])){
			$search_phrase=$_GET['s'];
			//print_r($search_phrase);exit;
			$search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
			$search_cond="($modelName.title like '%$search_phrase%')";

			$this->set('search_phrase',$search_phrase);
		}
		
		
		$cond = array("$modelName.section_id"=>$section_id , $search_cond);
		$fields = array("$modelName.id","$modelName.title","$modelName.date" ,"$modelName.modified" ,"$modelName.visible");
		
		
		
		if ($list_all == 0){
			$this->paginate = array(
				'fields' => $fields,
				'limit' => 20,
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
	
	function admin_add($section=null){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		$locales = Configure::read("LOCALES");
		$userFilesFolder = $this->userFilesFolder;
		$this->set('userFilesFolder',$userFilesFolder);
		$this->set_page_title($section , 'list');
		$this->set("section",$section);
		
		
		$this->set_media_preferred_size("default");
		
		$d=$this->$modelName->find("first",array("conditions"=>array("$modelName.section"=>$section , "$modelName.section_id"=>0) ,'contain'=>false));
		$section_id=$d["$modelName"]['id'];
		
		//print_r($section);exit;
		$this->set("preferred_size" , $this->set_preferred_size($section));
		$this->set("video_preferred_size" , $this->set_preferred_size($section,1));
		
		// $server_videos_list=$this->get_videos_list();
		// $this->set("server_videos_list",$server_videos_list);
// 		
		// $albums_list = $this->get_photo_album_list();
		// $this->set("albums_list",$albums_list);
		
	
		if(empty($this->request->data)){						
			$hashed_id = md5('unique_salt' . time());
			$this->set("hashed_id",$hashed_id);
			
		}	
		
		
		if (!empty($this->request->data)){
			
			
			
			
			
			
			
			
				/////////////////////// cover image /////////////////////////////////////
				// if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
// 				
					// $resizes = $this->get_image_resizes("$section");
// 					
					// $this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
					// $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
					// if(!$retArray['error']){
						// $this->request->data["$modelName"]['image']=$retArray['fileName'];
					// }else{
// 						
						// $fileError=$retArray['errorMsg'];
						// $this->request->data["$modelName"]['image']='';
						// $this->Session->setFlash($fileError);
						// $error=1;
					// }
				// }else{
					// $this->request->data["$modelName"]['image']='';
				// }
				
				
				
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
				if(isset($this->request->data["$modelName"]['image'])){
					foreach($this->request->data["$modelName"]['image'] as $key=>$im){
						if(!empty($this->request->data["$modelName"]['image']["$key"])){
							$main_image_name=$this->request->data["$modelName"]['image']["$key"];
						}else{
							$this->request->data["$modelName"]['image']["$key"]=$main_image_name;
						}
					}
				}
				
			  ///////////////     end of cover image /////////////////////////
			////////////////////////////	document /////////////////////////////
			
			$cacheId = "all_languages";
			if (($languages = Cache::read($cacheId)) === false) {
				$this->loadModel("Language");
				$languages=$this->Language->find('all',array('callbacks'=>false));
				Cache::write($cacheId, $languages);
			}
			$file_both=0;
			foreach ($languages as $lang){
				$locale = $lang["Language"]["locale"];

				if (isset($this->request->data[$modelName]["file"][$locale]['name']) && !empty($this->request->data[$modelName]["file"][$locale]['name'])){
					if(!empty($this->request->data[$modelName]['file'][$locale]['name'])){
						
						$this->request->data[$modelName]['file'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['file'][$locale]['name']);
						$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["file"][$locale],WWW_ROOT."/files/$userFilesFolder/document",'document',array('extensions'=>array('doc', 'docx', 'pdf'),'randomName'=>false));
						if(!$fileArray['error']){
							$this->request->data["$modelName"]['file'][$locale]=$fileArray['fileName'];
							$file_both=1;
						}else{
							$fileError=$fileArray['errorMsg'];
							$this->request->data["$modelName"]['file'][$locale]='';
							$this->Session->setFlash($fileError);
							$error=1;
						}
					}else{
						$this->request->data["$modelName"]['file'][$locale]='';
					}
				}else{
					$this->request->data["$modelName"]['file'][$locale]='';
				}
			}
			
			if($file_both == 0){
				unset($this->request->data["$modelName"]['file']);
			} 
			$main_document_name='';
			if(isset($this->request->data["$modelName"]['file'])){
				foreach($this->request->data["$modelName"]['file'] as $key=>$im){
					if(!empty($this->request->data["$modelName"]['file']["$key"])){
						$main_document_name=$this->request->data["$modelName"]['file']["$key"];
					}else{
						$this->request->data["$modelName"]['file']["$key"]=$main_document_name;
					}
				}	
			}
			
			
			if(isset($this->request->data["$modelName"]['video_type'])){
				$video_type=$this->request->data["$modelName"]['video_type'];
				$youtube_image=$this->request->data["$modelName"]['youtube_image'];
				if(($video_type == 0) || (($video_type == 1) && ($youtube_image == 0)) ){
					
					if (isset($this->request->data[$modelName]["video_image"]) && !empty($this->request->data[$modelName]["video_image"]["name"])){
						
						$resizes = $this->get_image_resizes("$section");
						
						$this->request->data[$modelName]['video_image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['video_image']['name']);
						$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['video_image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
						if(!$retArray['error']){
							$this->request->data["$modelName"]['video_image']=$retArray['fileName'];
						}else{
							
							$fileError=$retArray['errorMsg'];
							$this->request->data["$modelName"]['video_image']='';
							$this->Session->setFlash($fileError);
							$error=1;
						}
					}else{
						$this->request->data["$modelName"]['video_image']='';
					}
				}else{
					$this->request->data["$modelName"]['video_image']='';
				}
			}
			
			
			
			
				if(isset($this->request->data["$modelName"]['video']) && !empty($this->request->data["$modelName"]['video'])){
				
					////////////////// video file start ////////////////////////
					
					
					if($section == 'articles'){
						$preview="355x197";
					}else{
						$preview="480x267";
					}
					
					if(!empty($this->request->data["$modelName"]['video']['name'])){
							$videoArgs=array(
							'randomName'=>false,
							'keepOriginal'=>true,
							'convert'=>true,
							'ffmpeg'=>array(
							'ffmpegPath'=>'/usr/bin',
							'audioSamplingFrequency'=>'22050',
							'audioBitRate'=>'128k',
							'videoAspectRatio'=>'4:3',
							'videoBitRate'=>'64k',
							'fps'=>'24',
							'videoDimensions'=>'852x474',
							'audioChannels'=>'1',
							'snapshotSeekTime'=>'00:00:01',
							'snapshotSize'=>array( 
									'thumb'=> '114x80',
									'preview'=> $preview
									)
							),
							'extensions' => array('mpeg', 'wmv', 'flv', 'mpg','3gp','mov','avi','mp4'),
							'flvFolder' => WWW_ROOT . "files/$userFilesFolder/video/flv",
							'snapshot' => true,
							'snapshotFolder' =>array(
								'thumb'=> WWW_ROOT . "files/$userFilesFolder/thumb",
								'preview'=> WWW_ROOT . "files/$userFilesFolder/preview"
							),
							'snapshotResize' => false
							);
											
						$video = $this->FileUpload->uploadFile($this->request->data["$modelName"]['video'], WWW_ROOT."files/$userFilesFolder/video/original", 'video', $videoArgs);
						// print_r($video['error']);exit;
						if(!$video['error']){
							$this->request->data["$modelName"]['video'] = $video['flvName'];
							//if(empty($this->request->data[$modelName]['video_snapshot']['name'])){
								if(!isset($this->request->data["$modelName"]['video_image']) || empty($this->request->data["$modelName"]['video_image'])){
									$this->request->data["$modelName"]['video_image'] = $video['snapshotName'];
								}
								
								
								// unset($this->request->data['Video']['video_url']);
								// unset($this->request->data['Video']['video_server']);
							//}
						}
						else{
							$videoError=$video['errorMsg'];
							
							
							$this->Session->setFlash($videoError,null,null,'err');
							$error=1;
						}
					}else{
						$this->request->data["$modelName"]['video']='';
					}
			}


			///////////////////////////////////////////////////////////////////////////////////////
				
			$this->$modelName->create();
			$this->fillEmptyMetaFields($modelName);
			if(isset($this->request->data["PagesRelation"])){
				$pagesRelations=$this->request->data["PagesRelation"];
				unset($this->request->data["PagesRelation"]);
			}
			
				
				
			$this->fill_empty_fields();
			
			$this->request->data["$modelName"]['section_id']=$section_id;
			$this->request->data["$modelName"]['section']=$section;
			
			
			// if(isset($this->request->data["Image"])){
					// $images=$this->request->data["Image"];
					// unset($this->request->data["Image"]);
				// }	
			
			
			
			if ($this->$modelName->saveAll($this->request->data)){
				$id=$this->$modelName->id;
				
				
				
				///////////// udate images
				$id = $this->$modelName->id;
				
				$modelId=$this->$modelName->id;
					
					
					
				//////////////////////		 media section 	///////////////////////////////////////
				$hashed_id= $this->request->data["$modelName"]['hashed_id'];					
				$this->loadModel("Media");
				// updating the media items with the hashed id
				$this->Media->updateAll(
					array( 'Media.module_id' => $modelId ,'Media.module'=>'"Section"'),   //fields to update
					array( 'Media.hashed_id' => $hashed_id )  //condition
				);
				//////////////////////		 end of media section 	///////////////////////////////////////
					
					
					
					
					
				// $this->loadModel("Image");
// 				
				// // updating the media items with the hashed id
				// if(isset( $images ) && !empty($images)){
// 					
					// foreach($images as $img){
						// $img_d['Image']['id']=$img['id'];
						// $img_d['Image']['module_id']=$id;
						// $img_d['Image']['title']=$img['title'];
						// $img_d['Image']['caption']=$img['caption'];
						// $img_d['Image']['url']=$img['url'];
						// $img_d['Image']['hashed_id']=$this->request->data["$modelName"]['hashed_id'];
						// //print_r($img_d);exit;
						// $this->Image->saveAll($img_d);
					// }	
				// }
					
					
					
				/** save relations **/	
				if(isset($pagesRelations))
					$this->request->data["PagesRelation"] = $pagesRelations;
				
				
				
				$modelId = $this->$modelName->id;
				$relationsCount = 0;
				$this->loadModel("PagesRelation");
				
				// if(isset($pagesRelations)){
					// if(!empty($this->request->data["$modelName"]['albums_images'])){
						// //"OR"=>array(array("PagesRelation.related_model"=>'Image'),array("PagesRelation.related_model"=>'Album'))
						// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));	
					// }else{
						// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Video' ));
					// }
				// }else{
					// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));
				// }
				
				

				
				if(isset($this->request->data["PagesRelation"]) && !empty($this->request->data["PagesRelation"])){
					foreach ($this->request->data["PagesRelation"] as $relationModel=>$relationModelEntries){
						
						if($relationModel == "Album"){

							$albumImages = json_decode($this->request->data["$modelName"]["albums_images"],true);
							// print_r($albumImages);exit;
							if(!empty($albumImages)){
								foreach ($albumImages as $albumId=>$albumArray){
									$data["PagesRelation"][$relationsCount]["id"] = 0;
									$data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
									$data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
									$data["PagesRelation"][$relationsCount]["related_model"] = "Album";
									$data["PagesRelation"][$relationsCount]["related_id"] = $albumId;

									$relationsCount++;

									foreach ($albumArray as $imageId){
										$data["PagesRelation"][$relationsCount]["id"] = 0;
										$data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
										$data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
										$data["PagesRelation"][$relationsCount]["related_model"] = "Image";
										$data["PagesRelation"][$relationsCount]["related_id"] = $imageId;

										$relationsCount++;
									}
								}
							}
							//continue;
						}else{
							foreach ($relationModelEntries as $relationEntry){
								$data["PagesRelation"][$relationsCount]["id"] = 0;
								$data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
								$data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
								$data["PagesRelation"][$relationsCount]["related_model"] = $relationModel;
								$data["PagesRelation"][$relationsCount]["related_id"] = $relationEntry;



								$relationsCount++;
							}
						}
					}
					//print_r($data);exit;
					if(isset($data)){
						$this->PagesRelation->saveAll($data["PagesRelation"]);
					}
					
				}
				/*//////////		 end of saving relation 	///////////////////*/
		
			
				$this->Session->setFlash("Item Added Successfully","admin/admin_succ");
				$this->redirect("/admin/$controllerName/index/$section");
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
		
		$this->loadModel("SeoManagement");
		$locales = Configure::read("LOCALES");
		$userFilesFolder = $this->userFilesFolder;
		$this->set("userFilesFolder","$userFilesFolder");
		
		
		$this->set_media_preferred_size("default");
		
		$id = (int)$id;
		$this->set('id',$id);
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		//print_r($get_data);exit
		$hashed_id=$get_data["$modelName"]['hashed_id'];
		$section=$get_data["$modelName"]['section'];
		$this->set_page_title($section , 'list');
		$this->set("section",$section);
		
		$this->set("preferred_size" , $this->set_preferred_size($section));
		$this->set("video_preferred_size" , $this->set_preferred_size($section,1));
		
		
		// if($id==null || !is_numeric($id) || empty($get_data)){
			// $this->Session->setFlash("Invalid Request");
			// $this->redirect("/admin/$controllerName/index");
			// exit;
		// }
// 		
		if (empty($this->request->data)){
					
			$hashed_id=$get_data["$modelName"]['hashed_id'];
			if(empty($hashed_id)){
				$hashed_id = md5('unique_salt' . time());
				
			}
			$this->set("hashed_id",$hashed_id);
			
			
				
			
			$this->request->data = $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","internal_title","text_1",'text_2','text_3' ,'image','file'));
				
			$seoData = $this->get_all_locales(array("SeoManagement.model_name"=>"$modelName","SeoManagement.field_id"=>$id),"SeoManagement",Configure::read('LOCALES'),array("slug","prepend_title","append_title","title","keywords","description"));
			if(!empty($seoData))
			$this->request->data["SeoManagement"] = $seoData["SeoManagement"];
			
			
			$this->loadModel("Image");
			
			//$chosen_images=$this->Image->find("all",array("conditions"=>array("Image.module_name"=>"Section","Image.module_id"=>$id)));
			
			// $chosen_images= $this->get_all_locales_multiple(array("Image.module_name"=>"Section","Image.module_id"=>$id),"Image",Configure::read('LOCALES'),array("title" ,"caption"));
			// $this->set("chosen_images",$chosen_images);
			
			
			$this->loadModel("Media");
			
			$MediaData =$this->Media->find("all",array("conditions"=>array("Media.module"=>"$modelName","Media.module_id"=>$id)));					
			$this->request->data["Media"]=$MediaData;
			
			//print_R($chosen_images);exit;
			
		}
		else{
			
			$this->fill_empty_fields();
			//print_r($this->request->data);exit;
				///////   cover image start ////////////////////////////////////////////////
				// if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
// 				
					// $resizes = $this->get_image_resizes("$section");
// 					
					// $this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
					// $retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
					// if(!$retArray['error']){
						// $this->request->data["$modelName"]['image']=$retArray['fileName'];
					// }else{
// 						
						// $fileError=$retArray['errorMsg'];
						// unset($this->request->data["$modelName"]['image']);
						// $this->request->data["$modelName"]['image']=$get_data["$modelName"]['image'];
						// $this->Session->setFlash($fileError);
						// $error=1;
					// }
				// }else{
					// unset($this->request->data["$modelName"]['image']);
// 					
				// }
				
				
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
						unset($this->request->data["$modelName"]['image'][$locale]);
					}
				}

				if($image_both == 0){
					unset($this->request->data["$modelName"]['image']);
				}
				
				//print_r($this->request->data);exit;
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
				
				////////////// cover image end ////////////////////////////////////////
				
				////////////////////////////	document /////////////////////////////
			$cacheId = "all_languages";
			if (($languages = Cache::read($cacheId)) === false) {
				$this->loadModel("Language");
				$languages=$this->Language->find('all',array('callbacks'=>false));
				Cache::write($cacheId, $languages);
			}
			
			$file_both=0;
			foreach ($languages as $lang){
				$locale = $lang["Language"]["locale"];

				if (isset($this->request->data[$modelName]["file"][$locale]['name']) && !empty($this->request->data[$modelName]["file"][$locale]['name'])){
					if(!empty($this->request->data[$modelName]['file'][$locale]['name'])){
						
						$this->request->data[$modelName]['file'][$locale]['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['file'][$locale]['name']);
						$fileArray = $this->FileUpload->uploadFile($this->request->data[$modelName]["file"][$locale],WWW_ROOT."/files/$userFilesFolder/document",'document',array('extensions'=>array('doc', 'docx', 'pdf'),'randomName'=>false));
						if(!$fileArray['error']){
							$this->request->data["$modelName"]['file'][$locale]=$fileArray['fileName'];
							$file_both=1;
						}else{
							$fileError=$fileArray['errorMsg'];
							$this->request->data["$modelName"]['file'][$locale]='';
							$this->Session->setFlash($fileError);
							$error=1;
						}
					}else{
						$this->request->data["$modelName"]['file'][$locale]='';
					}
				}else{
					$this->request->data["$modelName"]['file'][$locale]='';
				}
			}
			
			
			if($file_both == 0){
				unset($this->request->data["$modelName"]['file']);
			}
			
			if(isset($this->request->data["$modelName"]['file']) && !empty($this->request->data["$modelName"]['file'])){
				$main_document_name='';
				foreach($this->request->data["$modelName"]['file'] as $key=>$im){
					if(!empty($this->request->data["$modelName"]['file']["$key"])){
						$main_document_name=$this->request->data["$modelName"]['file']["$key"];
					}else{
						$this->request->data["$modelName"]['file']["$key"]=$main_document_name;
					}
				}
			}else{
				unset($this->request->data["$modelName"]['file']);
			}
				
				
			if(isset($this->request->data["$modelName"]['video_type'])){	
				$video_type=$this->request->data["$modelName"]['video_type'];
				$youtube_image=$this->request->data["$modelName"]['youtube_image'];
				if(($video_type == 0) || (($video_type == 1) && ($youtube_image == 0)) ){	
				
					if (isset($this->request->data[$modelName]["video_image"]) && !empty($this->request->data[$modelName]["video_image"]["name"])){
						
						$resizes = $this->get_image_resizes("$section");
						
						$this->request->data[$modelName]['video_image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['video_image']['name']);
						$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['video_image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
						if(!$retArray['error']){
							$this->request->data["$modelName"]['video_image']=$retArray['fileName'];
						}else{
							
							$fileError=$retArray['errorMsg'];
							$this->request->data["$modelName"]['video_image']='';
							$this->Session->setFlash($fileError);
							$error=1;
						}
					}else{
						unset($this->request->data["$modelName"]['video_image']);
					}
				}else{
					unset($this->request->data["$modelName"]['video_image']);
				}
			}	
				
				
			if(isset($this->request->data["$modelName"]['video']) && !empty($this->request->data["$modelName"]['video'])){
					
					////////////////// video file start ////////////////////////
					if($section == 'articles'){
						$preview="355x197";
					}else{
						$preview="480x267";
					}
					
					if(!empty($this->request->data["$modelName"]['video']['name'])){
							$videoArgs=array(
							'randomName'=>false,
							'keepOriginal'=>true,
							'convert'=>true,
							'ffmpeg'=>array(
							'ffmpegPath'=>'/usr/bin',
							'audioSamplingFrequency'=>'22050',
							'audioBitRate'=>'128k',
							'videoAspectRatio'=>'4:3',
							'videoBitRate'=>'64k',
							'fps'=>'24',
							'videoDimensions'=>'852x474',
							'audioChannels'=>'1',
							'snapshotSeekTime'=>'00:00:01',
							'snapshotSize'=>array( 
									'thumb'=> '114x80',
									'preview'=> $preview
									)
							),
							'extensions' => array('mpeg', 'wmv', 'flv', 'mpg','3gp','mov','avi','mp4'),
							'flvFolder' => WWW_ROOT . "files/$userFilesFolder/video/flv",
							'snapshot' => true,
							'snapshotFolder' =>array(
								'thumb'=> WWW_ROOT . "files/$userFilesFolder/thumb",
								'preview'=> WWW_ROOT . "files/$userFilesFolder/preview"
							),
							'snapshotResize' => false
							);
											
						$video = $this->FileUpload->uploadFile($this->request->data["$modelName"]['video'], WWW_ROOT."files/$userFilesFolder/video/original", 'video', $videoArgs);
						// print_r($video['error']);exit;
						if(!$video['error']){
							$this->request->data["$modelName"]['video'] = $video['flvName'];
							//if(empty($this->request->data[$modelName]['video_snapshot']['name'])){
								$this->request->data["$modelName"]['video_image'] = $video['snapshotName'];
								
								// unset($this->request->data['Video']['video_url']);
								// unset($this->request->data['Video']['video_server']);
							//}
						}
						else{
							$videoError=$video['errorMsg'];
							
							
							$this->Session->setFlash($videoError,null,null,'err');
							$error=1;
						}
					}else{
						unset($this->request->data["$modelName"]['video']);
					}
				}	
				
				
				
			$this->request->data["$modelName"]['id']=$id;
			if(isset($this->request->data["PagesRelation"])){
				$pagesRelations=$this->request->data["PagesRelation"];
				unset($this->request->data["PagesRelation"]);
			}
			
			if(isset($this->request->data["Image"])){
				$images=$this->request->data["Image"];
				unset($this->request->data["Image"]);
			}	
			
			
			$this->fillEmptyMetaFields($modelName);
			
			if ($this->$modelName->saveAll($this->request->data)){
				$id=$this->$modelName->id;
				
				///////////// udate images
				$id = $this->$modelName->id;
				
				
				
				$modelId = $this->$modelName->id;
					///////////////////// 	media section 		////////////////////////////
					$hashed_id= $this->request->data["$modelName"]['hashed_id'];					
					$this->loadModel("Media");
					// updating the media items with the hashed id
					$this->Media->updateAll(
						array( 'Media.module_id' => $modelId ,'Media.module'=>'"Section"'),   //fields to update
						array( 'Media.hashed_id' => $hashed_id )  //condition
					);
					
					/*//////////		 end of saving media 	///////////////////*/
					
					
					
					
				//$this->loadModel("Image");
				
				// updating the media items with the hashed id
				// if(isset( $images ) && !empty($images)){
// 					
					// foreach($images as $img){
						// $img_d['Image']['id']=$img['id'];
						// $img_d['Image']['module_id']=$id;
						// $img_d['Image']['title']=$img['title'];
						// $img_d['Image']['caption']=$img['caption'];
						// $img_d['Image']['url']=$img['url'];
						// $img_d['Image']['hashed_id']=$hashed_id;
						// //print_r($img_d);exit;
						// $this->Image->saveAll($img_d);
					// }	
				// }
					
					
					
					
				
				/** save relations **/	
				if(isset($pagesRelations)){
					$this->request->data["PagesRelation"] = $pagesRelations;
				
				
				
				$modelId = $this->$modelName->id;
				$relationsCount = 0;
				$this->loadModel("PagesRelation");
				
				if(isset($pagesRelations)){
					if(!empty($this->request->data["$modelName"]['albums_images'])){
						//"OR"=>array(array("PagesRelation.related_model"=>'Image'),array("PagesRelation.related_model"=>'Album'))
						$this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));	
					}else{
						$this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Video' ));
					}
				}else{
					$this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));
				}
				
				

				
				if(isset($this->request->data["PagesRelation"]) && !empty($this->request->data["PagesRelation"])){
					foreach ($this->request->data["PagesRelation"] as $relationModel=>$relationModelEntries){
						
						if($relationModel == "Album"){

							$albumImages = json_decode($this->request->data["$modelName"]["albums_images"],true);
							// print_r($albumImages);exit;
							if(!empty($albumImages)){
								foreach ($albumImages as $albumId=>$albumArray){
									$data["PagesRelation"][$relationsCount]["id"] = 0;
									$data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
									$data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
									$data["PagesRelation"][$relationsCount]["related_model"] = "Album";
									$data["PagesRelation"][$relationsCount]["related_id"] = $albumId;

									$relationsCount++;

									foreach ($albumArray as $imageId){
										$data["PagesRelation"][$relationsCount]["id"] = 0;
										$data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
										$data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
										$data["PagesRelation"][$relationsCount]["related_model"] = "Image";
										$data["PagesRelation"][$relationsCount]["related_id"] = $imageId;

										$relationsCount++;
									}
								}
							}
							//continue;
						}else{
							foreach ($relationModelEntries as $relationEntry){
								$data["PagesRelation"][$relationsCount]["id"] = 0;
								$data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
								$data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
								$data["PagesRelation"][$relationsCount]["related_model"] = $relationModel;
								$data["PagesRelation"][$relationsCount]["related_id"] = $relationEntry;



								$relationsCount++;
							}
						}
					}
					//print_r($data);exit;
					if(isset($data)){
						$this->PagesRelation->saveAll($data["PagesRelation"]);
					}
					
				}
				}else{
					$modelId = $this->$modelName->id;
					$this->$modelName->id=$modelId;
					$this->loadModel('PagesRelation');
					if(isset($this->request->data["$modelName"]['has_image']) && $this->request->data["$modelName"]['has_image'] == 0 ){
						$this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Image' ));
						$this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Album' ));	
					}
					
					
					if(isset($this->request->data["$modelName"]['has_video']) && $this->request->data["$modelName"]['has_video'] == 0 ){
						$this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Video' ));
					}
				}
				/*//////////		 end of saving relation 	///////////////////*/
				
				$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
				$this->redirect("/admin/$controllerName/index/$section");
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
		
		$get_data =  $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title",'text_1','text_2','text_3','image'),array());
		$section=$get_data["$modelName"]['section'];
		
		if($id==null || !is_numeric($id) || empty($get_data)){
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("/admin/$controllerName/index");
				exit;
			}else{
				echo "Invalid Request";
				exit;
			}
		}
	
		//$this->loadModel("PagesRelation");
				
		//$this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$id));	
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
			
			
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Item Deleted Successfully","admin/admin_succ");
				$this->redirect("/admin/$controllerName/index");
				exit;
			}else{
				echo 1;
				exit;
			}
		}
		else {
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Item could not be deleted. Please try again later.","admin/admin_err");
				$this->redirect("/admin/$controllerName/index");
				exit;
			}else{
				echo "Item could not be deleted. Please try again later.";
				exit;
			}
		}
	}
	
	
	function admin_delete_image($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$userFilesFolder=$this->userFilesFolder;
		
		$id = (int)$id;
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		if($id==null || !is_numeric($id) || empty($get_data)){
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("/admin/$controllerName/index");
				exit;
			}else{
				echo "Invalid Request";
				exit;
			}
		}
	
		$this->$modelName->id=$id;
		$this->$modelName->saveField("image",'');
		
			$image_name=$get_data["$modelName"]['image'];
			
			
			
			
			$list_location=WWW_ROOT."/files/$userFilesFolder/list/$image_name";
			$thumb_location=WWW_ROOT."/files/$userFilesFolder/thumb/$image_name";
			$preview_location=WWW_ROOT."/files/$userFilesFolder/preview/$image_name";
			$original_location=WWW_ROOT."/files/$userFilesFolder/original/$image_name";
			
			if(file_exists($thumb_location))
			unlink($thumb_location);
			if(file_exists($preview_location))
			unlink($preview_location);
			if(file_exists($original_location))
			unlink($original_location);
			if(file_exists($list_location))
			unlink($list_location);
			
			
			if(!isset($this->request->params["isAjax"])){
				$this->Session->setFlash("Item Deleted Successfully","admin/admin_succ");
				$this->redirect("/admin/$controllerName/index");
				exit;
			}else{
				echo 1;
				exit;
			}
		
	
		if(!isset($this->request->params["isAjax"])){
			$this->Session->setFlash("Item could not be deleted. Please try again later.","admin/admin_err");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}else{
			echo "Item could not be deleted. Please try again later.";
			exit;
		}
		
	}
	function admin_show_on_homepage($id=null){
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
		
		$data=$this->$modelName->find('first',array('conditions'=>array("$modelName.id"=>$id)));
		$homepage=$data["$modelName"]['homepage'];
		//print_r($data);exit;
		if($homepage == 1){
			$status=0;
		}elseif($homepage == 0){
			$status=1;
		}
		
		$this->$modelName->id=$id;
		$this->$modelName->saveField("homepage",$status);
		
		
		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash("Status Changed successfully");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		echo 1;exit;
		
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
	
	function admin_display_related_pages($currPageId = 0){
		$modelName = $this->modelName;
		$this->layout = "";
		//print_r($currPageId);exit;
		
		$otherRelatedModels = array("Album"=>array("sectionName"=>"Photo Albums"),"Video"=>array("sectionName"=>"Videos"));

		$parentsList = $this->$modelName->getParentsList($currPageId,$otherRelatedModels);
		//print_r($parentsList);exit;
	
		
		$this->set("parentsList",$parentsList);
		$this->set("otherRelatedModels",$otherRelatedModels);
		

		$this->loadModel("PagesRelation");
		$relations = $this->PagesRelation->find("list",array("fields"=>array("PagesRelation.related_model","PagesRelation.id","PagesRelation.related_id"),"conditions"=>array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$currPageId,"PagesRelation.related_model != 'image'")));
		$imagesRelations = $this->PagesRelation->find("list",array("fields"=>array("PagesRelation.related_id","PagesRelation.related_id"),"conditions"=>array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$currPageId,"PagesRelation.related_model"=>'image')));
		$this->set("pagesRelations",$relations);
		$this->set("imagesRelations",$imagesRelations);
		//print_r($relations);exit;
		

	}
// 	///////////////////////////////// end of admin functions ///////////////////////////////
	
	
	function overview(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		
		$section='overview';
		
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		 
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("about_us" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
			
		$this->set(compact("seoData",'section_details','section_banner','is_ajax','section_slugs'));		
	}
	
	
	function opening_hours(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='opening_hours';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("about_us" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		$opening_hours_list=$this->Section->get_list_of_selectes_section("$section" , $locale);
		//print_r($opening_hours_list);exit;
			
		$this->set(compact("seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'opening_hours_list'));		
	}
	
	
	function services(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='services';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		$this->loadModel("Service");
		$services_list=$this->Service->get_all_services($locale);
		
			
		$this->set(compact("seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'services_list'));		
	}

	function privacy(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='privacy';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
			
		$this->set(compact("seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'services_list'));		
	}
	function terms_conditions(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='terms_conditions';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
			
		$this->set(compact("seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'services_list'));		
	}

	function get_here(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='get_here';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		$data_list=$this->Section->get_list_of_selectes_section($section , $locale);
			
		$this->set(compact("seoData",'data_list', 'section_details','section_banner','is_ajax' ,'section_slugs' ,'services_list'));		
	}


	function contact_us(){
		
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='contact';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		//get contact inquiry
		$this->loadModel("ContactDepartment");
		$contact_inquiries_list=$this->ContactDepartment->getContactReasonsList($locale);
	//print_r($contact_inquiries_list);exit;
		
		$this->set(compact("seoData" ,"contact_inquiries_list",'data_list', 'section_details','section_banner','is_ajax' ,'section_slugs' ,'services_list'));		
	}
	
	function articles( $selected_year=0 , $selected_month=0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		
		
		$about_ajax=false;		
		if(isset($_GET['about'])){
			if(!empty($_GET['about'])){
				$about_ajax=true;
				$is_ajax=false;
			}
		}
		
		$this->set("about_ajax",$about_ajax);
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='articles';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("about_us" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		if(isset($this->params['named']["page"])){
			$page = $this->params['named']["page"];
			
		}
		else{
			$page = 1;
		}
		
		
		//get the category date of articles
		$category_list=$this->$modelName->get_article_date_category_list($locale);
		
		//print_r($category_list);exit;
		
		$category_search='';
		if($selected_year != 0 && $selected_month != 0){
			
			$start_date="$selected_year-$selected_month-01";
			$end_date="$selected_year-$selected_month-31";
			$category_search=array("$modelName.date >="=>$start_date , "$modelName.date <="=>$end_date);
		}elseif(!empty($category_list)){
			
			reset($category_list);
			$selected_year = key($category_list);	
			//print_r($year);exit;
			$latest_date=$category_list[$selected_year];
			reset($latest_date);
			$selected_month = key($latest_date);
			
			$start_date="$selected_year-$selected_month-01";
			$end_date="$selected_year-$selected_month-31";
			$category_search=array("$modelName.date >="=>$start_date , "$modelName.date <="=>$end_date);
			
			$selected_year = 0;
			$selected_month = 0;
		}
		
		
		
		$cond=array("$modelName.visible"=>1 , "$modelName.section"=>"$section" ,"$modelName.section_id >"=>0 , $category_search); 
		
		$contain = array("SeoManagement"=>array("fields"=>array("id","slug")));
		$contain = $this->$modelName->generateContainableTranslations($modelName,$contain,$locale);
		
		$this->$modelName->locale = $locale;
		$this->paginate = array(
			'fields' => array("$modelName.id","$modelName.title","$modelName.image","$modelName.file","$modelName.date"),
			'limit' => 4,
			'page'=>$page,
			'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
			'conditions' => $cond,
			'contain'=>$contain
		);
		$data = $this->paginate($modelName);
		
		//print_R($data);exit;
		
		
			
		$this->set(compact("data", "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list','selected_year','selected_month' ,'modelName'));		
	}
	
	
	
	
	function videos(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='videos';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("about_us" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		if(isset($this->params['named']["page"])){
			$page = $this->params['named']["page"];			
		}
		else{
			$page = 1;
		}
		
		
		$selected_video_id=0;
		if(isset($_GET['video_id']) && is_numeric($_GET['video_id']) && !empty($_GET['video_id'])){
			$selected_video_id=$_GET['video_id'];
			$page=$this->getVideoPageNumber($selected_video_id , 4);	
		}
		$this->set('selected_video_id',$selected_video_id);
		
		
		$cond=array("$modelName.visible"=>1 , "$modelName.section"=>"$section" ,"$modelName.section_id >"=>0); 
		
		$contain = array("SeoManagement"=>array("fields"=>array("id","slug")));
		$contain = $this->$modelName->generateContainableTranslations($modelName,$contain,$locale);
		
		$this->$modelName->locale = $locale;
		$this->paginate = array(
			'fields' => array("$modelName.id","$modelName.title","$modelName.image","$modelName.text_1","$modelName.video","$modelName.video_type","$modelName.youtube","$modelName.youtube_image","$modelName.video_image"),
			'limit' => 4,
			'page'=>$page,
			'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
			'conditions' => $cond,
			'contain'=>$contain
		);
		$data = $this->paginate($modelName);
		
		//print_R($data);exit;
		
		
			
		$this->set(compact("data", 'page', "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list','selected_year','selected_month' ,'modelName'));		
	}
	
	
	function getVideoPageNumber($id, $rowsPerPage ) {

		
	 	$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		
		$order= array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC');
		$cond=array("$modelName.visible"=>1 , "$modelName.section"=>"videos" ,"$modelName.section_id >"=>0); 
		
		
	    $result = $this->$modelName->find('list',array('order'=>$order,'conditions'=>$cond)); // id => name
	 	
	 	
	    $resultIDs = array_keys($result); // position - 1 => id
	    
	    $resultPositions = array_flip($resultIDs); // id => position - 1
	    
	    $position = $resultPositions[$id] + 1; // Find the row number of the record
	    
	    $page = ceil($position / $rowsPerPage); // Find the page of that row number
	   	
	    return $page;
	  }
	
	
	function article_details( $id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		$lang=$this->request->params['lang'];
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='articles';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("about_us" , $locale);
		
		$data=$this->$modelName->get_section_by_id_details($id , $locale);
		
		
		//get all related images
		// $this->loadModel("Image");
		// $related_image=$this->Image->get_related_images("Section", $id,$locale);
		
		$this->loadModel("Media");
		$related_image= $this->Media->get_related_images("Section", $id,$locale);
		
		//print_R($related_image);exit;
		
		$seoData["SeoManagement"] = $data["SeoManagement"];	
		
		$date=$data["$modelName"]['date'];
		$date=split('-', $date);
		$year=$date['0'];
		$month=$date['1'];
		
		$page = $this->getPageNumber($id,4 , $section , $year , $month);
		$back_url="/$lang/Sections/articles/$year/$month/page:$page";
		
		$this->set(compact("related_image", "data", 'back_url', "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list','year','month' ,'modelName'));		
	}
	function getPageNumber($id, $rowsPerPage, $section ,$year ,$month  ) {

		
	 	$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->loadModel($modelName);
		
		
		$start_date="$year-$month-01";
		$end_date="$year-$month-31";
			
		$order =array("$modelName.position"=>"ASC" , "$modelName.id" => 'DESC');
		$category_search=array("$modelName.date >="=>$start_date , "$modelName.date <="=>$end_date);
			
		$cond=array("$modelName.visible"=>1 , "$modelName.section"=>"$section" ,"$modelName.section_id >"=>0 , $category_search); 
		
		
	    $result = $this->$modelName->find('list',array('order'=>$order,'conditions'=>$cond)); // id => name
	 	
	 	
	    $resultIDs = array_keys($result); // position - 1 => id
	    
	    $resultPositions = array_flip($resultIDs); // id => position - 1
	    
	    $position = $resultPositions[$id] + 1; // Find the row number of the record
	    
	    $page = ceil($position / $rowsPerPage); // Find the page of that row number
	   	
	    return $page;
	  }
	
	
	function download_file($id , $location=0){
		
		if($id!=null && is_numeric($id)){
			$controllerName = $this->controllerName;
			$modelName = $this->modelName;	
			
			$locale=$this->params['locale'];
			$lang=$this->params['lang'];
			
			$this->$modelName->locale = $locale;
			$get_data=$this->$modelName->find('first',array("contain"=>false,"fields"=>array("$modelName.id","$modelName.file"),"conditions"=>array("$modelName.id"=>$id)));
			//print_r($get_data);exit;
			if(!empty($get_data)){
				$name=$get_data["$modelName"]['file'];
				$target_path = WWW_ROOT."files/sections/document/";
				$full_path = $target_path.$name;

				$type=filetype($full_path);
				
				if($location  == 0){
					header('Content-Type: '.$type);
					header('Content-Disposition: attachment; filename="'.$name.'"' , false);
				}else{
					header('Content-type: application/pdf');
					header('Content-Disposition: inline; filename="' . $name . '"');
					header('Content-Transfer-Encoding: binary');
					header('Content-Length: ' . filesize($full_path));
					header('Accept-Ranges: bytes');
					
					@readfile($full_path);
					
					exit();
				}
				
				print file_get_contents($full_path);
				exit;
			}
		}
		exit;
	}
	

	
	
	// function update_career(){
		// $this->loadModel("JobPosition");
// 		
		// $j=$this->JobPosition->find("all");
		// foreach($j as $d){
			// $id=$d['JobPosition']['id'];
			// $title=$d['JobPosition']['title'];
			// $ar_title=$d['JobPosition']['title_ar'];
// 			
			// $title=trim($title);
			// $ar_title=trim($ar_title);
// 			
			// $data['JobPosition']['id']=$id;
			// $data['JobPosition']['title']=$title;
			// $data['JobPosition']['title_ar']=$ar_title;
// 			
			// //print_R($data);exit;
			// $this->JobPosition->saveAll($data);
// 			
		// }
		// echo "done";
		// exit;
	// }
	
	function vacancies(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		$lang=$this->request->params['lang'];
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		//print_r($this->params);exit;
		
		$career_ajax=false;		
		if(isset($this->params['named']['page'])){			
				$career_ajax=true;
				$is_ajax=false;					
		}
		$this->set('career_ajax',$career_ajax);
		
		
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='careers';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("about_us" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);	
	//	print_R($section_details);exit;
		
		
		if($locale == 'eng'){
			
			$Vacancies='vacancies';
			//$cv='Upload your CV';
			
		}else{
			
			
			$Vacancies="\xD8\xA7\xD9\x84\xD9\x88\xD8\xB8\xD8\xA7\xD8\xA6\xD9\x81";
			//$cv="\xD8\xAA\xD8\xAD\xD9\x85\xD9\x8A\xD9\x84\x20\xD8\xB3\xD9\x8A\xD8\xB1\xD8\xAA\xD9\x83\x20\xD8\xA7\xD9\x84\xD8\xB0\xD8\xA7\xD8\xAA\xD9\x8A\xD8\xA9";
		}
		$section_details["SeoManagement"]['title']=$Vacancies;
		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		
		//get positions
		$this->loadModel("JobPosition");
		$job_position=$this->JobPosition->getList($locale);
		//$job_position_list=$this->JobPosition->find('all',array("order"=>array("JobPosition.title_ar"=>'ASC')));
		
		
		//print_r($job_position_list);exit;
		
		$this->set("job_position",$job_position);
		//print_r($job_position);exit;
		
		
		//get jobs
		$this->loadModel("Job");
		//$job_details_list=$this->Job->getAllJobs("$locale");
		
		
		if(isset($this->params['named']["page"])){
			$page = $this->params['named']["page"];			
		}
		else{
			$page = 1;
		}
		
		
		
		
		if($locale  == 'en'){
			$order=array("Job.position" => 'ASC' , "Job.id"=>'DESC');
		}else{
			
			$this->loadModel('JobI18n');
		
			$order=array("I18n__title.content"=>'ASC');
			$joins= array(
		     array('table' => 'jobs_i18n',
		        'alias' => 'JobI18n',
		        'type' => 'INNER',
		        'conditions' => array(
		            'JobI18n.foreign_key= Job.id',
		            'JobI18n.locale'=>$locale		            
		        )		       
			 ));
		 
		 	$this->Job->locale=$locale;
			$data=$this->Job->find("all"  ,array( 
			'fields' => array("Job.id" , 'Job.title'),
			'contain'=>false , 
			'joins'=>$joins , 
			'page'=>$page , 
			'limit' => 10,
			'conditions'=>array("Job.visible"=>1), 
			'order'=>$order));
			
			
			
			if(!empty($data)){
				$id_ar=array();
				foreach($data  as $d){
					$j_id=$d['Job']['id'];
					array_push($id_ar , $j_id);
				}
				
				
				
				$order_id=implode(',', $id_ar);
				$order="FIELD(Job.id, $order_id)";
			}else{
				$order='';
			}
			
		}
		
		
		
		$this->Job->locale = $locale;
		$this->paginate = array(
			'fields' => array("Job.id","Job.title","Job.text"),
			'limit' => 10,			
			'order' => $order,
			'conditions' => array("Job.visible"=>1),
			'contain'=>false
		);
		$job_details_list = $this->paginate('Job');
		//print_r($job_details_list);exit;
		
		
		$job_list=$this->Job->getAllJobsList($locale);
		
		//print_r($job_list);exit;
		
		//get countries
		$this->loadModel("Country");
		$country_list=$this->Country->getList($locale);
		
		
		
		$selected_job_id=0;
		if(isset($_GET['job_id']) && is_numeric($_GET['job_id']) && !empty($_GET['job_id'])){
			$selected_job_id=$_GET['job_id'];			
		}
		
		
		$this->set('selected_job_id',$selected_job_id);
		
		$this->set(compact("country_list" ,"job_list","job_details_list" ,"data", 'back_url', "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list' ,'modelName'));		
	}
	
	
	function upload_your_cv(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		$lang=$this->request->params['lang'];
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		//print_r($this->params);exit;
		
		$career_ajax=false;		
		if(isset($this->params['named']['page'])){			
				$career_ajax=true;
				$is_ajax=false;					
		}
		$this->set('career_ajax',$career_ajax);
		
		
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='careers';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("about_us" , $locale);
		
		$section_details=$this->$modelName->get_section_details($section , $locale);	
		
		if($locale == 'eng'){
			
			//$Vacancies='vacancies';
			$cv='Upload your CV';
			
		}else{
			
			
			//$Vacancies="\xD8\xA7\xD9\x84\xD9\x88\xD8\xB8\xD8\xA7\xD8\xA6\xD9\x81";
			$cv="\xD8\xAA\xD8\xAD\xD9\x85\xD9\x8A\xD9\x84\x20\xD8\xB3\xD9\x8A\xD8\xB1\xD8\xAA\xD9\x83\x20\xD8\xA7\xD9\x84\xD8\xB0\xD8\xA7\xD8\xAA\xD9\x8A\xD8\xA9";
		}
		$section_details["SeoManagement"]['title']=$cv;
		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		
		//get positions
		$this->loadModel("JobPosition");
		$job_position=$this->JobPosition->getList($locale);
		//$job_position_list=$this->JobPosition->find('all',array("order"=>array("JobPosition.title_ar"=>'ASC')));
		
		
		//print_r($job_position_list);exit;
		
		$this->set("job_position",$job_position);
		//print_r($job_position);exit;
		
		
		//get jobs
		$this->loadModel("Job");
		//$job_details_list=$this->Job->getAllJobs("$locale");
		
		
		// if(isset($this->params['named']["page"])){
			// $page = $this->params['named']["page"];			
		// }
		// else{
			// $page = 1;
		// }
// 		
// 		
// 		
// 		
		// if($locale  == 'en'){
			// $order=array("Job.position" => 'ASC' , "Job.id"=>'DESC');
		// }else{
// 			
			// $this->loadModel('JobI18n');
// 		
			// $order=array("I18n__title.content"=>'ASC');
			// $joins= array(
		     // array('table' => 'jobs_i18n',
		        // 'alias' => 'JobI18n',
		        // 'type' => 'INNER',
		        // 'conditions' => array(
		            // 'JobI18n.foreign_key= Job.id',
		            // 'JobI18n.locale'=>$locale		            
		        // )		       
			 // ));
// 		 
		 	// $this->Job->locale=$locale;
			// $data=$this->Job->find("all"  ,array( 
			// 'fields' => array("Job.id" , 'Job.title'),
			// 'contain'=>false , 
			// 'joins'=>$joins , 
			// 'page'=>$page , 
			// 'limit' => 10,
			// 'conditions'=>array("Job.visible"=>1), 
			// 'order'=>$order));
// 			
			// $id_ar=array();
			// foreach($data  as $d){
				// $j_id=$d['Job']['id'];
				// array_push($id_ar , $j_id);
			// }
// 			
// 			
// 			
			// $order_id=implode(',', $id_ar);
			// $order="FIELD(Job.id, $order_id)";
		// }
// 		
// 		
// 		
		// $this->Job->locale = $locale;
		// $this->paginate = array(
			// 'fields' => array("Job.id","Job.title","Job.text"),
			// 'limit' => 10,			
			// 'order' => $order,
			// 'conditions' => array("Job.visible"=>1),
			// 'contain'=>false
		// );
		// $job_details_list = $this->paginate('Job');
		//print_r($job_details_list);exit;
		
		
		$job_list=$this->Job->getAllJobsList($locale);
		
		//print_r($job_list);exit;
		
		//get countries
		$this->loadModel("Country");
		$country_list=$this->Country->getList($locale);
		
		
		
		$selected_job_id=0;
		if(isset($_GET['job_id']) && is_numeric($_GET['job_id']) && !empty($_GET['job_id'])){
			$selected_job_id=$_GET['job_id'];			
		}
		$this->set('selected_job_id',$selected_job_id);
		
		$this->set(compact("country_list" ,"job_list","job_details_list" ,"data", 'back_url', "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list' ,'modelName'));		
	}
	
	
	
	function store_locator($selected_floor_id=0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		$lang=$this->request->params['lang'];
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
		
		$section='store_locator';
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		
		$section_details=$this->$modelName->get_section_details($section , $locale);	
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		
		$this->loadModel("Map");
		$floor_list=$this->Map->get_maps($locale);
		
		if($selected_floor_id == 0 && !empty($floor_list)){
			$selected_floor_id=$floor_list[0]['Map']['id'];
		}
		//print_r($floor_list);exit;
		
		$this->loadModel("MapLocator");
		$map_locator=$this->MapLocator->get_shops($locale);
		
		   
		
		$this->set(compact('map_locator',  "data", 'floor_list', 'selected_floor_id', "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list' ,'modelName'));		
	}
	
	
	
	function categories($section=null){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		$section_id=$section_details["Section"]['id'];
		
		if(isset($this->params['named']["page"])){
			$page = $this->params['named']["page"];			
		}
		else{
			$page = 1;
		}
		
		
		
	
		
		
		$this->loadModel("Category");		
		$cond=array("Category.visible"=>1 , "Category.section_id"=>"$section_id"); 
		
		
				 
		//print_r($joins);exit;		 
		$contain = array("SeoManagement"=>array("fields"=>array("id","slug")));
		$contain = $this->Category->generateContainableTranslations("Category",$contain,$locale);
		
		
		//print_r($d);exit;
		
		//$this->Category->unbindModel(array('hasMany' => array('CategoryI18n')));
		
		
		if($locale  == 'en'){
			$order=array("Category.position" => 'ASC' , "Category.id"=>'DESC');
		}else{
			
			$this->loadModel('CategoryI18n');
		
			$order=array("CategoryI18n.content"=>'ASC');
			$joins= array(
		     array('table' => 'categories_i18n',
		        'alias' => 'CategoryI18n',
		        'type' => 'INNER',
		        'conditions' => array(
		            'CategoryI18n.foreign_key= Category.id',
		            'CategoryI18n.locale'=>$locale		            
		        )		       
			 ));
		 
			$data=$this->Category->find("list"  ,array( 
			'fields' => array("Category.id","Category.id"),
			'contain'=>false , 
			'joins'=>$joins , 
			'page'=>$page , 
			'limit' => 100,
			'conditions'=>$cond, 
			'order'=>$order));
			
			
			$order_id=implode(',', $data);
			$order="FIELD(Category.id, $order_id)";
		}
		
		//print_R($order);exit;
		
		
		$this->Category->locale = $locale;
		$this->paginate = array(
			'fields' => array("Category.id","Category.title","Category.image"),
			'limit' => 200,
			//'joins'=>$joins,
			'page'=>$page,
			'order'=>$order,
			//'order' => array("Category.position" => 'ASC' , "Category.id"=>'DESC'),
			//'order'=>array("I18n__title.content"=>'ASC'),
			'conditions' => $cond,
			
			'contain'=>$contain
		);
		
		$data = $this->paginate("Category");
		//print_r($data);exit;
		
		$this->set(compact("data", "page", "section", "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list','selected_year','selected_month' ,'modelName'));			
	}
	
	
	
	function entertain(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		$section='entertain';
		
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		
		$section_id=$section_details["Section"]['id'];
		
		if(isset($this->params['named']["page"])){
			$page = $this->params['named']["page"];			
		}
		else{
			$page = 1;
		}
		
		
		
		$selected_shop_id=0;
		if(isset($_GET['shop_id']) && is_numeric($_GET['shop_id']) && !empty($_GET['shop_id'])){
			$selected_shop_id=$_GET['shop_id'];
			$page=$this->getShopPageNumber($selected_shop_id , 6, 0 ,$section_id);	
		}
		$this->set('selected_shop_id',$selected_shop_id);
	
		
		$this->loadModel("Shop");
		$this->Shop->locale=$locale;	
		$cond=array("Shop.visible"=>1, "Shop.category_id"=>0 , "Shop.section_id"=>"$section_id"); 
		
		$contain = array("SeoManagement"=>array("fields"=>array("id","slug")));
		$contain = $this->$modelName->generateContainableTranslations("Shop",$contain,$locale);
		
		$this->$modelName->locale = $locale;
		$this->paginate = array(
			'fields' => array("Shop.id","Shop.title","Shop.image_1"),
			'limit' => 6,
			'page'=>$page,
			'order' => array("Shop.position" => 'ASC' , "Shop.id"=>'DESC'),
			'conditions' => $cond,
			'contain'=>$contain
		);
		$data = $this->paginate("Shop");
			
		
					
		$this->set(compact("data", "page", "section", "seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list','selected_year','selected_month' ,'modelName'));
		
				
	}
	
	
	function ara_fill_first_letter(){
		$this->loadModel("ShopI18n");
		$brands = $this->ShopI18n->find("all",array("conditions"=>array("ShopI18n.field"=>"title","ShopI18n.locale"=>"ara"),"limit"=>300));
		
//		echo sizeof($brands);
		$this->loadModel("Shop");
		$data = array();
		$i = 0;
		foreach ($brands as $entry){
			$brandId = $entry["ShopI18n"]["foreign_key"];
			$brandTitle = $entry["ShopI18n"]["content"];
			$locale = $entry["ShopI18n"]["locale"];
		
			$firstLetter = mb_substr(trim($brandTitle),0,1);
			
			//if($locale == "ara"){
				$this->Shop->id = $brandId;
				$this->Shop->saveField("first_letter",$firstLetter);
			//}
			
			
				// $data["ShopI18n"][$i]["locale"] = $locale;
				// $data["ShopI18n"][$i]["model"] = "Shop";
				// $data["ShopI18n"][$i]["foreign_key"] = "$brandId";
				// $data["ShopI18n"][$i]["field"] = "first_letter";
				// $data["ShopI18n"][$i]["content"] = "$firstLetter";
				// $i++;
			
		}
		
		
		//$this->ShopI18n->saveAll($data["ShopI18n"]);
		
		echo "done";
		exit;
	}	
	
	function fill_first_letter(){
		$this->loadModel("ShopI18n");
		$brands = $this->ShopI18n->find("all",array("conditions"=>array("ShopI18n.field"=>"title"),"limit"=>300));
		exit;
//		echo sizeof($brands);
		$this->loadModel("Shop");
		$data = array();
		$i = 0;
		foreach ($brands as $entry){
			$brandId = $entry["ShopI18n"]["foreign_key"];
			$brandTitle = $entry["ShopI18n"]["content"];
			$locale = $entry["ShopI18n"]["locale"];
		
			$firstLetter = mb_substr(trim($brandTitle),0,1);
			
			if($locale == "ara"){
				$this->Shop->id = $brandId;
				$this->Shop->saveField("first_letter",$firstLetter);
			}
			
			
				$data["ShopI18n"][$i]["locale"] = $locale;
				$data["ShopI18n"][$i]["model"] = "Shop";
				$data["ShopI18n"][$i]["foreign_key"] = "$brandId";
				$data["ShopI18n"][$i]["field"] = "first_letter";
				$data["ShopI18n"][$i]["content"] = "$firstLetter";
				$i++;
			
		}
		
		
		$this->ShopI18n->saveAll($data["ShopI18n"]);
		
		echo "done";
		exit;
	}
	
	function index($selected_category_id=0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		
		
				
		//get selected category details
		$this->loadModel("Category");
		$category_details=$this->Category->GetCategoryDetails($selected_category_id ,$locale);
		$seoData["SeoManagement"] = $category_details["SeoManagement"];
		$section_id=$category_details["Category"]['section_id'];
		
		
		//get section details 
		$section_details=$this->$modelName->get_section_by_id_details($section_id , $locale);
		
		$section=$section_details['Section']['section'];
		
		
		$this->set("menu_section",$section);
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
			
		//get category list  
		$this->loadModel("Category");
		$category_list=$this->Category->GetCategoryListOfSelectedSection($section_id , $locale);
		
		//print_r($category_list);exit;
		
		if(isset($this->params['named']["page"])){
			$page = $this->params['named']["page"];			
		}
		else{
			$page = 1;
		}
		
		$selected_shop_id=0;
		if(isset($_GET['shop_id']) && is_numeric($_GET['shop_id']) && !empty($_GET['shop_id'])){
			$selected_shop_id=$_GET['shop_id'];			
			$page=$this->getShopPageNumber($selected_shop_id , 6, $selected_category_id ,$section_id);			
		}
		
		$cond=array("Shop.visible"=>1, "Shop.category_id"=>"$selected_category_id" , "Shop.section_id"=>"$section_id"); 
		
		if($locale  == 'eng'){
			$order=array("Shop.position" => 'ASC' , "Shop.id"=>'DESC');
		}else{
			
			$this->loadModel('ShopI18n');
		
			//$this->ShopI18n->locale=$locale;			
			// $order=array("I18n__first_letter.content"=>'ASC');
			// $joins= array(
		     // array('table' => 'shops_i18n',
		        // 'alias' => 'ShopI18n',
		        // 'type' => 'INNER',
		        // 'conditions' => array(
		            // 'ShopI18n.foreign_key = Shop.id'		            	           
		        // )		       
			 // ));
// 		 
		 	$this->loadModel("Shop");
			// $this->Shop->locale=$locale;
			
			$data=	$this->Shop->get_ordered_shop($locale , $selected_category_id , $section_id);
			//print_R($data);exit;
			
		 	
			// $data=$this->Shop->find("all"  ,array(			
			// //'fields' => array("Shop.id" , 'Shop.title'),
			// 'contain'=>false , 
			// 'joins'=>$joins , 
			// //'page'=>$page , 
			// 'limit' => 9,
			// //'conditions'=>$cond, 
			// 'order'=>$order
			// ));
			
			//print_R($data);exit;
			
			if(!empty($data)){
				$id_ar=array();
				foreach($data  as $d){
					$j_id=$d['Shop']['id'];
					array_push($id_ar , $j_id);
				}
				
				$order_id=implode(',', $id_ar);
				$order="FIELD(Shop.id, $order_id)";
			}else{$order='';}
			
			
			
			//$order=array("I18n__title.content"=>'ASC');
		}
		
		
			
		$this->loadModel("Shop");
		$this->Shop->locale = $locale;
		
		//$data=$this->Shop->find("all",array("conditions"=>$cond , 'order'=>$order));
		//print_R($data);exit;
		
		//print_r($order);exit;
	
		
		
		$contain = array("SeoManagement");
		$contain = $this->Shop->generateContainableTranslations("Shop",$contain,$locale);
		
		$this->$modelName->locale = $locale;
		$this->paginate = array(
			//'fields' => array("Shop.id","Shop.title","Shop.image_1"),
			'limit' => 9,
			'page'=>$page,
			'order' => $order,
			'conditions' => $cond,
			'contain'=>$contain
		);
		$data = $this->paginate("Shop");	
		//print_R($data);exit;
		
		$this->set(compact("data" ,'page' ,"section" , "category_list" ,'selected_shop_id' ,'selected_category_id' ,"seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'category_list','selected_year','selected_month' ,'modelName'));		
		
	}



	function getShopPageNumber($id, $rowsPerPage, $selected_category_id ,$section_id  ) {

		
	 	$controllerName = $this->controllerName;
		
		$this->loadModel("Shop");
		$order= array("Shop.position" => 'ASC' , "Shop.id"=>'DESC');
		
		$cond=array("Shop.visible"=>1, "Shop.category_id"=>"$selected_category_id" , "Shop.section_id"=>"$section_id"); 
		
	    $result = $this->Shop->find('list',array('order'=>$order,'conditions'=>$cond)); // id => name
	 	
	 	
	    $resultIDs = array_keys($result); // position - 1 => id
	    
	    $resultPositions = array_flip($resultIDs); // id => position - 1
	    
	    $position = $resultPositions[$id] + 1; // Find the row number of the record
	    
	    $page = ceil($position / $rowsPerPage); // Find the page of that row number
	   	
	    return $page;
	  }
	function open_video($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		
		$lang=$this->request->params['lang'];		
		$this->$modelName->locale = "$locale";
		
		$data=$this->$modelName->get_section_by_id_details($id , $locale);
		
		$this->set("data",$data);
		
		
		$section='videos';
		
		$section_details=$this->$modelName->get_section_details($section , $locale);		
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		
		$this->set("seoData",$seoData);
	}






	
	function sitemap(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		
		$this->$modelName->locale = "$locale";
		
		$section='sitemap';
		
		
		//get section banner 
		$this->loadModel("Banner");
		$section_banner=$this->Banner->get_first_banners_of_selected_section("$section" , $locale);
		
		
		
		$section_details=$this->$modelName->get_section_details($section , $locale);
				
		$seoData["SeoManagement"] = $section_details["SeoManagement"];	
		//print_r($section_details);exit;
		
		//get the main section
		$this->loadModel("Section");
		$main_sections_list=$this->Section->get_main_sections_with_category($locale);
		
		// /print_r($main_sections_list);exit;
		
		//get slug of selected sections;
		$this->loadModel("SeoManagement");
		$section_slugs=$this->SeoManagement->get_slug_about_us($locale);
			
		
		$this->set(compact("data",'section_slugs' ,'main_sections_list' ,"seoData",'section_details','section_banner','is_ajax' ,'section_slugs' ,'modelName'));		
		
	}



	//script to add title2 
	function updatedI18(){
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
			
			$this->$modelName->locale=$locale;
			$data=$this->$modelName->find('all', array('contain'=>false , 'conditions'=>array("$modelName.section IN ('articles','videos')")));
			
			foreach($data as $dat){
				
				$id=$dat["Section"]['id'];
				$this->loadModel("SectionI18n");
				
				$files=$this->SectionI18n->find("first",array("conditions"=>array("SectionI18n.foreign_key"=>$id ,"SectionI18n.field"=>'file')));
				//print_R($files);exit;
				if(empty($files)){
					$dynamicData["SectionI18n"]['foreign_key']=$dat["Section"]['id'];
					$dynamicData["SectionI18n"]['model']='Section';
					$dynamicData["SectionI18n"]['locale']=$locale;
					$dynamicData["SectionI18n"]['field']='file';
					$dynamicData["SectionI18n"]['content']='';
	
					$this->SectionI18n->create();	
					$this->SectionI18n->saveAll($dynamicData);
				}
			}
		}
		
		echo "done";
		exit;
			
			
	}
	
	
}
?>