<?php 
App::uses('Sanitize', 'Utility');
class EventsController extends AppController{
	public $name = "Events";
	public $uses = array("Event");
	public $components = array("FileUpload","StringManipulation" ,"RequestHandler","NumbersFormat");
	public $helpers = array("Paginator");
	public $modelName = "Event";
	public $controllerName = "Events";
	var $userFilesFolder = "events";
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(empty($this->request->params["admin"])){
			
//			$this->layout='default';

			
		}else{
			
			$page_title="Event";
			$page_sub_title="Event";
				
			$menuFlag=11;
			$menuSectionId='events';
			
			
			$this->set("menuFlag",$menuFlag);
			$this->set("menuSectionId",$menuSectionId);
			
			$this->set("page_title",$page_title);
			$this->set("page_sub_title",$page_sub_title);
		}
	}
	
	

	
	function get_image_resizes($section="news"){
		$userFilesFolder=$this->userFilesFolder;
		switch ($section){
			case "event":
			
				$thumbWidth = "149";
				$thumbHeight = "99";
				
				// $listWidth = "309";
				// $listHeight = "205";
				
				$previewWidth = "350";
				$previewHeight = "233";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
								//array('folder'=>WWW_ROOT."/files/$userFilesFolder/list","width"=>$listWidth,"height"=>$listHeight,'force'=>false),
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
			
			
		}
		
		return $resizes;
	}
	
	function admin_index($list_all = 0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		
		$search_cond="";
		if(isset($_GET['s'])){
			$search_phrase=$_GET['s'];
			//print_r($search_phrase);exit;
			$search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
			$search_cond="($modelName.title like '%$search_phrase%')";

			$this->set('search_phrase',$search_phrase);
		}
			
		
		$cond = array("$search_cond");
		
		$fields = array("$modelName.id","$modelName.title","$modelName.modified" ,"$modelName.visible" , "$modelName.start_date");
		
		if ($list_all == 0){
			$this->paginate = array(
				'fields' => $fields,
				'limit' => 10,
				'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
				'conditions' => $cond,
				'contain'=>false
			);
		}
		else{
			$this->paginate = array(
				'fields' => $fields,
				'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
				'conditions' => $cond,
				'contain'=>false
			);
		}
				
		$data = $this->paginate($modelName);		
		$this->set('data', $data);
	}
	
	function admin_add(){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		$locales = Configure::read("LOCALES");
		$userFilesFolder = $this->userFilesFolder;
		$this->set("userFilesFolder",$userFilesFolder);
		$preferred_size='350 x 233 px';
		$this->set("preferred_size",$preferred_size);
	
		// $server_videos_list=$this->get_videos_list();
		// $this->set("server_videos_list",$server_videos_list);
// 		
		// $albums_list = $this->get_photo_album_list();
		// $this->set("albums_list",$albums_list);
		
		//print_r($this->request->data);exit;
		if (!empty($this->request->data)){
			//print_r($this->request->data);exit;
				/////////////////////// cover image /////////////////////////////////////
				if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
				
					$resizes = $this->get_image_resizes('event');
					
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
				// if(isset($this->request->data["PagesRelation"])){
					// $pagesRelations=$this->request->data["PagesRelation"];
					// unset($this->request->data["PagesRelation"]);
				// }
				
				if ($this->$modelName->saveAll($this->request->data)){
					$id=$this->$modelName->id;
					
					
					$send_notification=$this->request->data["$modelName"]['push_notification'];
					
					if($send_notification == 1){
						
						//send notification
					}
					
					
					
					/** save relations **/	
					// if(isset($pagesRelations))
						// $this->request->data["PagesRelation"] = $pagesRelations;
// 					
// 					
// 					
					// $modelId = $this->$modelName->id;
					// $relationsCount = 0;
					// $this->loadModel("PagesRelation");
// 					
					// // if(isset($pagesRelations)){
						// // if(!empty($this->request->data["$modelName"]['albums_images'])){
							// // //"OR"=>array(array("PagesRelation.related_model"=>'Image'),array("PagesRelation.related_model"=>'Album'))
							// // $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));	
						// // }else{
							// // $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Video' ));
						// // }
					// // }else{
						// // $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId ));
					// // }
// 					
// 					
// 
// 					
					// if(isset($this->request->data["PagesRelation"]) && !empty($this->request->data["PagesRelation"])){
						// foreach ($this->request->data["PagesRelation"] as $relationModel=>$relationModelEntries){
// 							
							// if($relationModel == "Album"){
// 
								// $albumImages = json_decode($this->request->data["$modelName"]["albums_images"],true);
								// // print_r($albumImages);exit;
								// if(!empty($albumImages)){
									// foreach ($albumImages as $albumId=>$albumArray){
										// $data["PagesRelation"][$relationsCount]["id"] = 0;
										// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
										// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
										// $data["PagesRelation"][$relationsCount]["related_model"] = "Album";
										// $data["PagesRelation"][$relationsCount]["related_id"] = $albumId;
// 
										// $relationsCount++;
// 
										// foreach ($albumArray as $imageId){
											// $data["PagesRelation"][$relationsCount]["id"] = 0;
											// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
											// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
											// $data["PagesRelation"][$relationsCount]["related_model"] = "Image";
											// $data["PagesRelation"][$relationsCount]["related_id"] = $imageId;
// 
											// $relationsCount++;
										// }
									// }
								// }
								// //continue;
							// }else{
								// foreach ($relationModelEntries as $relationEntry){
									// $data["PagesRelation"][$relationsCount]["id"] = 0;
									// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
									// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
									// $data["PagesRelation"][$relationsCount]["related_model"] = $relationModel;
									// $data["PagesRelation"][$relationsCount]["related_id"] = $relationEntry;
// 
// 
// 
									// $relationsCount++;
								// }
							// }
						// }
						// //print_r($data);exit;
						// if(isset($data)){
							// $this->PagesRelation->saveAll($data["PagesRelation"]);
						// }
// 						
					// }
					/*//////////		 end of saving relation 	///////////////////*/
			
				
					$this->Session->setFlash("Item Added Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index");
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
		$this->set("userFilesFolder",$userFilesFolder);
		$preferred_size='350 x 233 px';
		$this->set("preferred_size",$preferred_size);
	
		
		$id = (int)$id;
		$this->set('id',$id);
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		//print_r($get_data);exit;
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		
		if (empty($this->request->data)){
			$this->request->data = $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title","short","text"));
		

			$seoData = $this->get_all_locales(array("SeoManagement.model_name"=>"$modelName","SeoManagement.field_id"=>$id),"SeoManagement",Configure::read('LOCALES'),array("slug","prepend_title","append_title","title","keywords","description"));
			if(!empty($seoData))
			$this->request->data["SeoManagement"] = $seoData["SeoManagement"];
			
			
		}
		else{
			
			
			//print_r($this->request->data);exit;
				///////   cover image start ////////////////////////////////////////////////
				if (isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"]["name"])){
				
					$resizes = $this->get_image_resizes('event');
					
					$this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
					$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$resizes,'randomName'=>false));
					if(!$retArray['error']){
						$this->request->data["$modelName"]['image']=$retArray['fileName'];
					}else{
						
						$fileError=$retArray['errorMsg'];
						unset($this->request->data["$modelName"]['image']);
						$this->request->data["$modelName"]['image']=$get_data["$modelName"]['image'];
						$this->Session->setFlash($fileError);
						$error=1;
					}
				}else{
					unset($this->request->data["$modelName"]['image']);
					
				}
				
				
				
				
				
				
				////////////// cover image end ////////////////////////////////////////
				
				
				
				
				$this->request->data["$modelName"]['id']=$id;
				// if(isset($this->request->data["PagesRelation"])){
					// $pagesRelations=$this->request->data["PagesRelation"];
					// unset($this->request->data["PagesRelation"]);
				// }
				
				//print_r($this->request->data);exit;	
				$this->fillEmptyMetaFields($modelName);
				if ($this->$modelName->saveAll($this->request->data)){
					
					
					
					$send_notification=$this->request->data["$modelName"]['push_notification'];
					
					if($send_notification == 1){
						
						//send notification
					}
					
					
					
					/** save relations **/	
					// if(isset($pagesRelations)){
						// $this->request->data["PagesRelation"] = $pagesRelations;
// 					
// 					
// 					
					// $modelId = $this->$modelName->id;
					// $relationsCount = 0;
					// $this->loadModel("PagesRelation");
// 					
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
// 					
// 					
// 
// 					
					// if(isset($this->request->data["PagesRelation"]) && !empty($this->request->data["PagesRelation"])){
						// foreach ($this->request->data["PagesRelation"] as $relationModel=>$relationModelEntries){
// 							
							// if($relationModel == "Album"){
// 
								// $albumImages = json_decode($this->request->data["$modelName"]["albums_images"],true);
								// // print_r($albumImages);exit;
								// if(!empty($albumImages)){
									// foreach ($albumImages as $albumId=>$albumArray){
										// $data["PagesRelation"][$relationsCount]["id"] = 0;
										// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
										// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
										// $data["PagesRelation"][$relationsCount]["related_model"] = "Album";
										// $data["PagesRelation"][$relationsCount]["related_id"] = $albumId;
// 
										// $relationsCount++;
// 
										// foreach ($albumArray as $imageId){
											// $data["PagesRelation"][$relationsCount]["id"] = 0;
											// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
											// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
											// $data["PagesRelation"][$relationsCount]["related_model"] = "Image";
											// $data["PagesRelation"][$relationsCount]["related_id"] = $imageId;
// 
											// $relationsCount++;
										// }
									// }
								// }
								// //continue;
							// }else{
								// foreach ($relationModelEntries as $relationEntry){
									// $data["PagesRelation"][$relationsCount]["id"] = 0;
									// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
									// $data["PagesRelation"][$relationsCount]["source_id"] = $modelId;
									// $data["PagesRelation"][$relationsCount]["related_model"] = $relationModel;
									// $data["PagesRelation"][$relationsCount]["related_id"] = $relationEntry;
// 
// 
// 
									// $relationsCount++;
								// }
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
						// $this->$modelName->id=$modelId;
						// $this->loadModel('PagesRelation');
						// if(isset($this->request->data["$modelName"]['has_image']) && $this->request->data["$modelName"]['has_image'] == 0 ){
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Image' ));
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Album' ));	
						// }
// 						
// 						
						// if(isset($this->request->data["$modelName"]['has_video']) && $this->request->data["$modelName"]['has_video'] == 0 ){
							// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$modelId,"PagesRelation.related_model"=>'Video' ));
						// }
					// }
					/*//////////		 end of saving relation 	///////////////////*/
					
					$this->Session->setFlash("Item Edited Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/index");
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
				$this->redirect("/admin/$controllerName/index");
				exit;
			}else{
				echo "Invalid Request";
				exit;
			}
		}
	
		// $this->loadModel("PagesRelation");
// 				
		// $this->PagesRelation->deleteAll(array("PagesRelation.source_model"=>"$modelName","PagesRelation.source_id"=>$id));	
		$this->$modelName->id = $id;
		if ($this->$modelName->delete($id)){
			$image_name=$get_data["$modelName"]['image'];
			
			
			
			
			
			$thumb_location=WWW_ROOT."/files/$userFilesFolder/thumb/$image_name";
			$preview_location=WWW_ROOT."/files/$userFilesFolder/preview/$image_name";
			$original_location=WWW_ROOT."/files/$userFilesFolder/original/$image_name";
			
			if(file_exists($thumb_location))
			unlink($thumb_location);
			if(file_exists($preview_location))
			unlink($preview_location);
			if(file_exists($original_location))
			unlink($original_location);
			// if(file_exists($list_location))
			// unlink($list_location);
			
			
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
	function index(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;

		$this->$modelName->locale = "$locale";

	
		$contain = array("SeoManagement"=>array("fields"=>array("id","slug")));
		$contain = $this->$modelName->generateContainableTranslations($modelName,$contain,$locale);
		
		$this->$modelName->locale = $locale;
		$this->paginate = array(
			'fields' => array("News.id","News.title","News.date","News.short","News.image", "News.fb_like"),
			'limit' => 9,
			
			'order' => array("$modelName.position" => 'ASC' , "$modelName.id"=>'DESC'),
			'conditions' => array("News.visible"=>1),
			'contain'=>$contain
		);
		$data = $this->paginate($modelName);
		
		$this->loadModel("Background");
		$back_ground=$this->Background->getSectionBackgrounds('News','news');
		$this->set('back_ground',$back_ground);
		//print_r($back_ground);exit;
		
		$this->set(compact("data","settings","modelName","locale"));
		
	}
	
	function view_news($id=null,$page_id=0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale=$this->params['locale'];
		$lang=$this->params['lang'];
		$this->$modelName->locale=$locale;
		$is_ajax=false;
		$image_id=0;
		$userFilesFolder=$this->userFilesFolder;
		
		if($id==null || !is_numeric($id)){
			if(!$this->RequestHandler->isAjax()){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("$controllerName/index");
			}
			exit;
		}
		
		
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('is_ajax',$is_ajax);
		$this->set('id',$id);
	
	
		
		$NewsDetails = $this->$modelName->getPageDetails($locale ,$id);
		//print_r($NewsDetails);exit;
		$seoData["SeoManagement"] = $NewsDetails["SeoManagement"];
		
		//get images and videos 
		$this->loadModel("PagesRelation");
		
		$images_videos=$this->PagesRelation->getImagesVideos($locale,$id,"News");
		
		//print_r($images_videos);exit;
		
		$this->set("NewsDetails",$NewsDetails);
		$this->set("seoData",$seoData);
		$this->set("locale",$locale);
		$this->set("userFilesFolder",$userFilesFolder);
		$this->set("images_videos",$images_videos);
		
		
		$backUrl="/$lang/$controllerName/index/page:$page_id";
		$this->set("backUrl",$backUrl);
		
		/////////////////////////			facebook seo part		//////////////////////	
		$image_position=0;
		$root=Configure::read('WEBSITE_URL');
		
		$pageTitle_Fb='';
		if(!empty($NewsDetails['News']['title'])){
			$pageTitle_Fb = $NewsDetails['News']['title'];
		}
		
		////////////////// image   //////////////////
		if(isset($this->request->query) && !empty($this->request->query['image_id'])){

			$image_id=$this->request->query['image_id'];
			$this->loadModel('Image');

			// $image_position=$this->Image->query("SET @rowRank = 0;
								// SELECT ImageOffset.rowRank
								// FROM
								// (
								// SELECT *, (@rowRank := @rowRank + 1) as rowRank
								// FROM images
								// ORDER BY position ASC
								// ) AS ImageOffset
								// WHERE ImageOffset.id = '$image_id'");
// 			
			// $image_position=$image_position+1;
			
			
			$root=Configure::read('WEBSITE_URL');											
			$data=$this->Image->getImage($locale ,$image_id);
			$albumId=$data['Image']["field_id"];
			$foldersRange = Configure::read("FoldersRange");
			$folder_range_name = "group".floor($albumId / $foldersRange);
			$folderName = "albums/$folder_range_name/$albumId";
			
			$this->set("pageTitle_Fb",$pageTitle_Fb);
		
			$this->set("pageImg_Fb","$root/files/$folderName/thumb/".$data['Image']["image"]);
			
			$this->set('pageUrl_Fb', "$root/News/view_news/$id?image_id=$image_id");
		}
		////////////////////////////////////////////////////////////////////////////////
		////////// video   ////////////////////////////
		
		$this->loadModel("Background");
		$back_ground=$this->Background->getSectionBackgrounds('News','news');
		$this->set('back_ground',$back_ground);
		
		
		//end facebook
		
		
		//$this->set("image_id",$image_id);
		
	}
	
	function get_social_media($EventId,$image_id){
		$root=Configure::read('WEBSITE_URL');
		$this->set('page_url',"$root/News/view_news/$EventId?image_id=$image_id");
	}

	
	function list_social_media($id  , $page_id=0 ,  $fb_like=0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		
		$lang=$this->params['lang'];
		$url="/$lang/$modelName/view_news/$id/$page_id";
		$this->set('url',"$url");
		
		$data=$this->$modelName->find('first',array('conditions'=>array("$modelName.id"=>$id)));
		$this->set('data',$data);
		$this->set('modelName',$modelName);
		$this->set('fb_like',"$fb_like");
	}
	
	
	function get_news_date(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$locale=$this->params['locale'];
		
		$data=$this->$modelName->getNewsDate($locale);
		$years_list=array();
		foreach($data as $year){
			$parts = explode('-', "$year");
			$years_list["$parts[0]"]=$parts[0]; 
			
		}
		
		
		$month_list=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12');
		
		
		foreach($month_list as $key=>$month){
			$month_name=$this->NumbersFormat->get_month_name($month,$locale , array('month_format'=>'long') );
			//print_r($month_name);exit;
			$month_list["$key"]=$month_name;
		}
		
		
		$this->set('years_list',$years_list);
		$this->set('month_list',$month_list);
		//print_r($years_list);exit;
		
	}

}
?>