<?php 
class SocialMediasController extends AppController {
	var $name = 'SocialMedias';
	var $uses = array('SocialMedia');
	
	
	var $controllerName = "SocialMedias";
	var $modelName = "SocialMedia";
	
	function beforefilter(){
		parent::beforefilter();
		if(!isset($this->params['admin'])){
			
		}else{
			
			$page_title="Social Media channels";
			$page_sub_title="Social Media channels";
				
			$menuFlag=11;
			$menuSectionId='general';
			
			
			$this->set("menuFlag",$menuFlag);
			$this->set("menuSectionId",$menuSectionId);
			
			$this->set("page_title",$page_title);
			$this->set("page_sub_title",$page_sub_title);
		}
	}
	
		
	
	
	
		
	function admin_edit($id=null){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		if (empty($this->request->data)){
			
			$data = $this->$modelName->find("first");
			
			$this->request->data=$data;
			
			$this->set('id',$data["$modelName"]['id']);
			//print_r($this->data);exit;
		}
		elseif($id != null || is_numeric($id) && !empty($id)){
			
			
			$this->$modelName->id=$id;
			if ($this->$modelName->save($this->request->data)){
					$this->Session->setFlash("Links Modified Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/edit/$id");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
		
		
		
		
		
	

	}
	function admin_shop_online($id=null){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		
		$page_title="Shop Online Link";
			$page_sub_title="Shop Online Link";
				
			$menuFlag=11;
			$menuSectionId='general';
			
			
			$this->set("menuFlag",$menuFlag);
			$this->set("menuSectionId",$menuSectionId);
			
			$this->set("page_title",$page_title);
			$this->set("page_sub_title",$page_sub_title);
			
			
		if (empty($this->request->data)){
			
			$data = $this->$modelName->find("first");
			
			$this->request->data=$data;
			
			$this->set('id',$data["$modelName"]['id']);
			//print_r($this->data);exit;
		}
		elseif($id != null || is_numeric($id) && !empty($id)){
			
			
			$this->$modelName->id=$id;
			if ($this->$modelName->save($this->request->data)){
					$this->Session->setFlash("Links Modified Successfully","admin/admin_succ");
					$this->redirect("/admin/$controllerName/shop_online/$id");
					exit;
				}
				else {
					$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
					exit;
				}
		}
		
		
		
		
		
	

	}
	
}
?>