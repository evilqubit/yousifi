<?php 
App::uses('Sanitize', 'Utility');
class BannersController extends AppController {
	var $name = "Banners";
	var $uses = array("Banner");
	var $components = array("FileUpload","StringManipulation");
	var $helpers = array("Paginator");
	
	var $controllerName = "Banners";
	var $modelName = "Banner";
	var $userFilesFolder = "banners";
	
	function beforefilter(){
		parent::beforefilter();
		if(!isset($this->request->params['admin'])){
			
		}else{
			
	
		}
	}
	
	
	function beforeRender(){		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);		
		$page_number=1;		
		if(isset($this->params['paging'][$modelName]['page'])){
			$page_number=$this->params['paging'][$modelName]['page'];
		}		
		$this->set("page_number",$page_number);		
	}
	function set_page_title($modelName=null,$section = 0){
		$menuSectionId='';	
		switch ($modelName){

			case 'home':
			{
				$page_title="Home Header Banner";
				$page_sub_title="Home Header Banner";
					
				$menuFlag=1;
				$menuSectionId='header';
				break;
			}
			
			case 'middle':
			{
				$page_title="Home Middle Banner";
				$page_sub_title="Home Middle Banner";
					
				$menuFlag=1;
				$menuSectionId='header';
				break;
			}
			
			case 'best_seller':
			{
				$page_title="Best Seller Banner";
				$page_sub_title="Best Seller Banner";
					
				$menuFlag=1;
				$menuSectionId='header';
				break;
			}
			
			
			case 'sister_companies':
			{
				$page_title="Sister Companies Banner";
				$page_sub_title="Sister Companies Banner";
					
				$menuFlag=1;
				$menuSectionId='header';
				break;
			}
			
			case 'about_us':
			{
				$page_title="About us Banner";
				$page_sub_title="About us Banner";
					
				$menuFlag=1;
				$menuSectionId='about_us';
				break;
			}
			case 'our_business':
			{
				$page_title="Our Business Banner";
				$page_sub_title="Our Business Banner";
					
				$menuFlag=1;
				$menuSectionId='our_business';
				break;
			}
			
			case 'our_brands':
			{
				$page_title="Our Brands Banner";
				$page_sub_title="Our Brands Banner";
					
				$menuFlag=1;
				$menuSectionId='our_brands';
				break;
			}
			
			case 'news_events':
			{
				$page_title="News & Events Banner";
				$page_sub_title="News & Events Banner";
					
				$menuFlag=1;
				$menuSectionId='news_events';
				break;
			}
			
			case 'careers':
			{
				$page_title="Careers Banner";
				$page_sub_title="Careers Banner";
					
				$menuFlag=1;
				$menuSectionId='careers';
				break;
			}
			case 'contact':
			{
				$page_title="Contact Banner";
				$page_sub_title="Contact Banner";
					
				$menuFlag=1;
				$menuSectionId='contact';
				break;
			}
			
			case 'categories':
			{
				$page_title="Right Side Banner";
				$page_sub_title="Right Side Banner";
					
				$menuFlag=1;
				$menuSectionId='header';
				break;
			}
			
			
			
			
					
		}
		
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuFlag",$menuFlag);
		$this->set("menuSectionId",$menuSectionId);
	}
	
	function set_preferred_size($section){
		
		$preferred_size='';
		if($section == 'home'){
			$preferred_size='2000 x 500 px';
		}
		
		if($section == 'middle'){
			$preferred_size='287 x 144 px';
		}
		
		if($section == 'best_seller'){
			$preferred_size='298 x 202 px';
		}

		if($section == 'sister_companies'){
			$preferred_size='130 x 66 px';
		}
		
		if($section == 'about_us'){
			$preferred_size='2000 x 300 px';
		}
		
		if($section == 'our_business'){
			$preferred_size='2000 x 300 px';
		}
		
		if($section == 'our_brands'){
			$preferred_size='2000 x 300 px';
		}
		
		if($section == 'news_events'){
			$preferred_size='2000 x 300 px';
		}
		if($section == 'careers'){
			$preferred_size='2000 x 300 px';
		}
		
		if($section == 'contact'){
			$preferred_size='2000 x 300 px';
		}
		
		if($section == 'categories'){
			$preferred_size='80 x 40 px';
		}
		
		
		
		return $preferred_size;
	}
		
	
	function get_image_resizes($section="general" , $side=null){
		$userFilesFolder=$this->userFilesFolder;
		switch ($section){
					
				
	
		
	
			case "home":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "500";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
			
			case "middle":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
			
			case "best_seller":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
			
			
			case "sister_companies":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
			
			case "about_us":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
				
			case "our_business":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
				
			
			case "our_brands":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
				
			case "news_events":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
				
			case "careers":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;		
			case "contact":
				$thumbWidth = "198";
				$thumbHeight = "198";
			
				
				$previewWidth = "2000";
				$previewHeight = "645";
				
				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),								
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;	
				
			
			case "categories":
				$thumbWidth = "80";
				$thumbHeight = "40";
			
				
				$previewWidth = "200";
				$previewHeight = "100";
				
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
			
			
			if(!isset($this->request->data["$modelName"]['text']["$locale"])){
				$this->request->data["$modelName"]['text']["$locale"]='';
			}
			
			if(!isset($this->request->data["$modelName"]['url']["$locale"])){
				$this->request->data["$modelName"]['url']["$locale"]='';
			}			
		}
	}
	
	
	
	

	function admin_add($section){
		$locales = Configure::read("LOCALES");
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$userFilesFolder = $this->userFilesFolder;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('userFilesFolder',$userFilesFolder);
		$this->set_page_title("$section");
		$this->set("section",$section);
		
		
		
		
		
		$this->set("preferred_size",$this->set_preferred_size("$section"));
		
		
		if (!empty($this->request->data)){
			//print_R($this->request->data);exit;
			$error=0;
			
			
			
			
			
			
						
			/*IMAGE*/
			
	
				
			if(!empty($this->request->data[$modelName]['image']['name'])){
				
				$sizes=$this->get_image_resizes("$section");
				
				//print_r($sizes);exit;
				$this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
				$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$sizes,'randomName'=>false));
				if(!$retArray['error']){
					$this->request->data["$modelName"]['image']=$retArray['fileName'];
					$image_both=1;
				}else{
					$imageError=$retArray['errorMsg'];
					$this->request->data["$modelName"]['image']='';
					$this->Session->setFlash($imageError);
					$error=1;
				}
			}else{
				$this->request->data["$modelName"]['image']='';
			}
			
			
			
			
			
			if($error==0){
				//print_R($this->request->data);exit;
				
				$this->request->data["$modelName"]['section']=$section;
				
				$this->fill_empty_fields();
				
				if ($this->$modelName->saveAll($this->request->data)){
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
	}
	
	function admin_index($section,$list_all = 0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		$this->set_page_title("$section");
		
		$this->set("section",$section);
		
		
		
		
		$search_cond="";
		if(isset($_GET['s'])){
			$search_phrase=$_GET['s'];
			//print_r($search_phrase);exit;
			$search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
			$search_cond="($modelName.title like '%$search_phrase%')";

			$this->set('search_phrase',$search_phrase);
		}
			
			
			
		
		$cond = array("$modelName.section"=>$section ,$search_cond);
		// print_r($cond);exit;
		if ($list_all == 0){
			$this->paginate = array(
				'fields' => array("$modelName.id","$modelName.title","$modelName.image","$modelName.section","$modelName.visible","$modelName.modified"),
				'limit' => 20,
				'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false
			);
		}
		else{
			$this->paginate = array(
				'fields' => array("$modelName.id","$modelName.title","$modelName.image","$modelName.section","$modelName.visible","$modelName.modified"),
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
	
	function admin_edit($id){ 
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$userFilesFolder = $this->userFilesFolder;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('userFilesFolder',$userFilesFolder);
		
		
		$id = (int)$id;
		$this->set('id',$id);
		$get_data =  $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title",'text','url'),array());
		$section=$get_data["$modelName"]['section'];
		
		
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
			
			if(!empty($this->request->data[$modelName]['image']['name'])){
				
				$sizes=$this->get_image_resizes("$section");
				
				//print_r($sizes);exit;
				$this->request->data[$modelName]['image']['name']=preg_replace("/[^A-Za-z0-9_\.]/","",$this->request->data[$modelName]['image']['name']);
				$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]['image'],WWW_ROOT."/files/$userFilesFolder/original",'image',array('resize'=>true,'resizeOptions'=>$sizes,'randomName'=>false));
				if(!$retArray['error']){
					$this->request->data["$modelName"]['image']=$retArray['fileName'];
					$image_both=1;
				}else{
					$imageError=$retArray['errorMsg'];
					$this->request->data["$modelName"]['image']='';
					$this->Session->setFlash($imageError);
					$error=1;
				}
			}else{
				unset($this->request->data["$modelName"]['image']);
			}
			
			if($error==0){
				$this->request->data[$modelName]['id'] = $id;
					
				if ($this->$modelName->saveAll($this->request->data)){
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
	}
	
	function admin_delete($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$userFilesFolder = $this->userFilesFolder;
		
		$id = (int)$id;
		
		$get_data =  $this->get_all_locales(array("$modelName.id"=>$id),"$modelName",Configure::read('LOCALES'),array("title",'text','image','url'),array());
		
		$section=$get_data["$modelName"]['section'];
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
			$this->redirect("/admin/$controllerName/index/$section");
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
		$paginator_limit=$this->paginator_limit;
		
		$current_page_number=$this->params['named']['page'];
		
		$counter=($paginator_limit*$current_page_number) - $paginator_limit;
		
		foreach ($_GET['row'] as $position => $item) {
			
			$this->$modelName->id=$item;
			$position=$counter+$position;
			if($this->$modelName->saveField('position',$position))
			$error_flag=1;
			else $error_flag=0;
		}

		if($error_flag==1)
		echo "<div class='highlight_msg'>The order has been changed successfully</div>";
		exit;
	}	
	// function admin_backgrounds_edit($relatedModel = "ShoesBag",$section='header'){
// 
		// $modelName = $this->modelName;
		// $controllerName = $this->controllerName;
		// $this->set("modelName",$modelName);
		// $this->set("controllerName",$controllerName);
		// $this->set("relatedModel",$relatedModel);
// 		
		// $this->set("section",$section);
		// $this->set_page_title("$relatedModel",$section);
// 		
		// $get_data = $this->$modelName->find("all",array("contain"=>false,"conditions"=>array()));
		// //print_r($get_data);exit;
		// if(empty($get_data)){
			// $this->Session->setFlash("Invalid Request");
			// $this->redirect("/admin/$controllerName/edit/");
			// exit;
		// }
// 		
		// //$this->set_page_flags($section);
		// //print_r($this->request->data);exit;
		// if($relatedModel == 'DynamicPage'){
			// $this->loadModel("DynamicPage");
// 			
			// if($section != 'home_page'){
				// //$dynamic_pages_record=$this->DynamicPage->find("first",array("conditions"=>array('DynamicPage.parent_id'=>0,"DynamicPage.section"=>$section) ,'recursive'=>-1));
// 			
				// // if(empty($dynamic_pages_record)){
					// // $this->Session->setFlash("No records for this section has been created yet");
					// // $this->redirect("/admin/administrators/index/");
					// // exit;
				// // }
// 				
				// // $relatedId=$dynamic_pages_record['DynamicPage']['id'];
				// $relatedId=0;
// 				
			// }else{
				// $relatedId=0;
			// }
// 			
		// }elseif($relatedModel == 'News'){
			// // $this->loadModel("News");
			// // $News_pages_record=$this->News->find("first",array("conditions"=>array('News.parent_id'=>0,"DynamicPage.section"=>$section) ,'recursive'=>-1));
			// $relatedId=0;
		// }elseif($relatedModel == 'Contact'){
			// // $this->loadModel("News");
			// // $News_pages_record=$this->News->find("first",array("conditions"=>array('News.parent_id'=>0,"DynamicPage.section"=>$section) ,'recursive'=>-1));
			// $relatedId=0;
		// }
// 		
// 		
		// if(empty($this->request->data)){
			// $this->set('data',$get_data);
// 
// 
			// $this->loadModel("PagesRelation");
			// $relations = $this->PagesRelation->find("list",array('callbacks'=>false,
			// "fields"=>array("PagesRelation.source_id","PagesRelation.source_model"),
			// "conditions"=>array("PagesRelation.source_model"=>"$modelName","PagesRelation.related_model"=>"$relatedModel","PagesRelation.section"=>"$section")));
			// $this->set("pagesRelations",$relations);
// 			
			// //print_r($relations);exit;
		// }
		// else{
			// //print_r($this->request->data);exit;
// 			
// 
			// $this->loadModel("PagesRelation");
			// $this->PagesRelation->deleteAll(array("PagesRelation.related_model"=>"$relatedModel","PagesRelation.section"=>$section));
			// Cache::clearGroup('backgrounds');
// 			
// 			
				// // if ($this->$modelName->saveAll($this->request->data)){
// 
					// /** save relations **/
					// $modelId = $this->$modelName->id;
					// $relationsCount = 0;
// 					
					// if(isset($this->request->data["PagesRelation"]) && !empty($this->request->data["PagesRelation"])){
						// foreach ($this->request->data["PagesRelation"] as $relationModel=>$relationModelEntries){
							// foreach ($relationModelEntries as $relationEntry){
								// $data["PagesRelation"][$relationsCount]["id"] = 0;
								// $data["PagesRelation"][$relationsCount]["source_model"] = $modelName;
								// $data["PagesRelation"][$relationsCount]["source_id"] = $relationEntry;
								// $data["PagesRelation"][$relationsCount]["related_model"] = $relatedModel;
								// $data["PagesRelation"][$relationsCount]["related_id"] = $relatedId;
								// $data["PagesRelation"][$relationsCount]["section"] = $section;
// 								
								// $relationsCount++;
							// }
						// }
// 
						// //print_r($data);exit;
						// if($this->PagesRelation->saveAll($data["PagesRelation"])){
							// $this->Session->setFlash("Page Saved Successfully","admin/admin_succ");
							// $this->redirect("/admin/$controllerName/backgrounds_edit/$relatedModel/$section");
							// exit;
						// }else{
								// $this->Session->setFlash("Page could not be saved. Please try again later.","admin/admin_err");
								// exit;
							// }
// 						
// 						
					 // }
					// else{
						// $this->Session->setFlash("Page Saved Successfully","admin/admin_succ");
						// $this->redirect("/admin/$controllerName/backgrounds_edit/$relatedModel/$relatedId/$section");
						// exit;
					// }
		// }
	// }
// 
// 	
// 	
// 	
// 	
// 	
// 	
	// function open_video($id){
		// $controllerName = $this->controllerName;
		// $modelName = $this->modelName;
		// $SeoManagement="SeoManagement";
		// $locale=$this->params['locale'];
		// $this->$modelName->locale=$locale;
// 		
		// $lang=$this->request->params['lang'];		
		// $this->$modelName->locale = "$locale";
// 		
		// $data=$this->$modelName->find("first",array('contain'=>false, 'conditions'=>array("$modelName.id"=> $id)));
// 		
// 		
		// $this->set("data",$data);
	// }

}
?>