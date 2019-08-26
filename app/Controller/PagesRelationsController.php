<?php 
App::uses('Sanitize', 'Utility');
class PagesRelationsController extends AppController{
	public $name = "PagesRelations";
	public $components = array("FileUpload","StringManipulation" ,"RequestHandler");
	public $helpers = array("NumbersFormat","Paginator");
	public $modelName = "PagesRelation";
	public $controllerName = "PagesRelations";
	
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(empty($this->request->params["admin"])){
			
//			$this->layout='default';

			
		}else{
			$this->set("menuFlag",0);	
			$this->set("menuSectionId","main_news_event_menu");
			
			
			
		}
	}
	
	
	function set_page_title($section=null){
		$menuSectionId='';
		//print_r($section);exit;
		switch ($section){
			case 'about_hbku':{
					$page_title="About HBKU";
					$page_sub_title="About HBKU";
					$menuSectionId="about_menu";
					$menuFlag=2;
				
				}
				break;	
			case 'colleges':{
					$page_title="About Colleges";
					$page_sub_title="About Colleges";
					$menuSectionId="colleges_menu";
					$menuFlag=8;
				
				}
				break;	
			
			
			case 'admissions_aid':{
					$page_title="Admissions & Aid";
					$page_sub_title="Admissions & Aid";
					$menuSectionId="admissions_aid_menu";
					$menuFlag=9;
				
				}
				break;	
			case 'campus_life':{
					$page_title="Campus Life";
					$page_sub_title="Campus Life";
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
					$page_sub_title="Institutes Center";
						
					$menuFlag=12;
					$menuSectionId='institutes_centers_menu';
				
				}
				break;
				
			case 'special_programs':{
					$page_title="Institutes Center";
					$page_sub_title="Institutes Center";
						
					$menuFlag=13;
					$menuSectionId='special_programs_menu';
				
				}
				break;
				
					
			}
		
		$this->set("menuFlag",$menuFlag);
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuSectionId",$menuSectionId);
		
	}
	function admin_index($sourceModel, $source_id,$list_all = 0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		$this->set('source_id',$source_id);
		$this->set('sourceModel',$sourceModel);
		$this->loadModel("Image");
		$this->loadModel("Video");
		if($sourceModel == "DynamicPage"){
			$this->loadModel("DynamicPage");
			$section=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.id'=>$source_id)));
			$this->set_page_title($section['DynamicPage']['section']);
		}elseif($sourceModel == "News"){
			// $this->loadModel("News");
			// $section=$this->News->find('first',array("conditions"=>array('News.id'=>$source_id)));
			$this->set_page_title('news');
		}
		
		
		$joins = array(
			array('table' => 'images',
				'alias' => 'Image',
				'type' => 'left',
				'conditions' => array(
					'Image.id = PagesRelation.related_id'
					
					
					
				)
			)
			,
			array('table' => 'videos',
				'alias' => 'Video',
				'type' => 'left',
				'conditions' => array(
					'Video.id = PagesRelation.related_id'
					
				)
			)
		);
		

		$cond = array("OR"=>array(array("PagesRelation.related_model"=>'Video'),array("PagesRelation.related_model"=>'Image')) ,'PagesRelation.source_model' => "$sourceModel",'PagesRelation.source_id' => "$source_id");
		//print_r($cond);exit;
		$fields = array("Image.image","Image.title","Video.image" ,"Video.title" ,"$modelName.*");
		
		if ($list_all == 0){
			$this->paginate = array(
				'fields' => $fields,
				'limit' => 10,
				'order' => array("$modelName.position" => 'ASC',"$modelName.date" => 'DESC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false,
				'joins'=>$joins
			);
		}
		else{
			$this->paginate = array(
				'fields' => $fields,
				'order' => array("$modelName.position" => 'ASC',"$modelName.date" => 'DESC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false,
				'joins'=>$joins
			);
		}
		
		$data = $this->paginate($modelName);
		//print_r($data);exit;
		$this->set('data', $data);
	}
	
	
	function admin_index_by_section($sourceModel, $section,$list_all = 0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		$this->set('section',$section);
		$this->set('sourceModel',$sourceModel);
		$this->loadModel("Image");
		$this->loadModel("Video");
		if($sourceModel == "DynamicPage"){
			$this->loadModel("DynamicPage");
			$related_page=$this->DynamicPage->find('first',array("conditions"=>array('DynamicPage.section'=>$section,'DynamicPage.intro_page'=>1)));
			$this->set_page_title($related_page['DynamicPage']['section']);
			$id=$related_page["DynamicPage"]['id'];
		}
		
		
		$joins = array(
			array('table' => 'images',
				'alias' => 'Image',
				'type' => 'left',
				'conditions' => array(
					'Image.id = PagesRelation.related_id'
					
					
					
				)
			)
			,
			array('table' => 'videos',
				'alias' => 'Video',
				'type' => 'left',
				'conditions' => array(
					'Video.id = PagesRelation.related_id'
					
				)
			)
		);
		

		$cond = array("OR"=>array(array("PagesRelation.related_model"=>'Video'),array("PagesRelation.related_model"=>'Image')) ,'PagesRelation.source_model' => "$sourceModel",'PagesRelation.source_id' => "$id");
		//print_r($cond);exit;
		$fields = array("Image.image","Image.title","Video.image" ,"Video.title" ,"$modelName.*");
		
		if ($list_all == 0){
			$this->paginate = array(
				'fields' => $fields,
				'limit' => 10,
				'order' => array("$modelName.position" => 'ASC',"$modelName.date" => 'DESC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false,
				'joins'=>$joins
			);
		}
		else{
			$this->paginate = array(
				'fields' => $fields,
				'order' => array("$modelName.position" => 'ASC',"$modelName.date" => 'DESC',"$modelName.id" => 'DESC'),
				'conditions' => $cond,
				'contain'=>false,
				'joins'=>$joins
			);
		}
		
		$data = $this->paginate($modelName);
		//print_r($data);exit;
		$this->set('data', $data);
	}

	function admin_delete($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$folder_name="news";
		
		$id = (int)$id;
		$get_data = $this->$modelName->find("first",array('callbacks'=>false,"conditions"=>array("$modelName.id"=>$id)));
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
	
			
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