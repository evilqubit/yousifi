<?php 
App::uses('Sanitize', 'Utility');
class ContactDepartmentsController extends AppController {
	public $name = "ContactDepartments";
	public $uses = array("ContactDepartment");
	public $components = array("FileUpload","StringManipulation" ,"RequestHandler");
	public $controllerName = "ContactDepartments";
	public $modelName = "ContactDepartment";
	
	
	
	function beforefilter(){
		
		parent::beforefilter();
		if(!isset($this->request->params['admin'])){
			
		}else{
			
			$menuSectionId="general_menu";
			$this->set("menuFlag",7);
			$this->set("menuSectionId",$menuSectionId);
		}
	}
	
	function setPageTitle(){
		
		$page_title="Contact Departments";
		$page_sub_title="Contact Department";
		
		$menuSectionId="contact";
		
		$menuFlag=14;
		
		
		$this->set("menuFlag",$menuFlag);
		$this->set("menuSectionId",$menuSectionId);
		
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		
	}
	
	function admin_add(){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		
		$this->set("modelName",$modelName);
		$this->set("controllerName",$controllerName);
		$this->setPageTitle();
		
		if (!empty($this->request->data)){
			//print_r($this->request->data);exit;
			$this->$modelName->create();
			if ($this->$modelName->saveAll($this->request->data)){
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
	
	function admin_index($list_all = 0){
		
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set('list_all',$list_all);
		$this->setPageTitle();
		
		$cond = array();
		$fields = array("$modelName.id","$modelName.title" ,"$modelName.modified" ,"$modelName.visible");
		
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
	
	public function admin_edit($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		
		$this->set("modelName",$modelName);
		$this->set("controllerName",$controllerName);
		$this->setPageTitle();
		$this->set("id",$id);
		////////Validating Id////////////
	    if($id==null || !is_numeric($id)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		
		if (empty($this->request->data)){
			$this->data = $this->get_all_locales(array("$modelName.id"=>$id),$modelName,Configure::read('LOCALES'),array('title'));
		}
		else{
			$this->request->data["$modelName"]['id']=$id;
			if ($this->$modelName->saveAll($this->request->data)){
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
		
		////////Validating Id////////////
		if($id==null || !is_numeric($id)){
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
}