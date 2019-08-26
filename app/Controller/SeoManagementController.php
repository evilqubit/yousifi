<?php
App::import('Sanitize');
class SeoManagementController extends AppController
{
	var $name = "SeoManagement";
	var $helpers = array('Html','Form','Js');
	var $components = array('Access','RequestHandler','StringManipulation');
	var $uses=array('SeoManagement');
	var $modelName="SeoManagement";
	var $controllerName="seo_management";
	var $sectionName="seo_management";
	var $sectionTitle="SEO Default Values";
	//////////////////////////////////ADMIN INTERFACE//////////////////////////////////////////////////////////

	function beforefilter(){
		parent::beforefilter();
		if(!isset($this->request->params['admin'])){
			
		}else{
			$this->set('page_title',"SEO Management");
			$this->set("menuFlag",1);
		}
	}
	
	function admin_index(){
		
		$modelName="SeoManagement";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;

		$this->set('modelName', $modelName);
		$this->set('controllerName', $controllerName);
		$adminConfigArray=array("modelName"=>$modelName,"controllerName"=>$controllerName,"sectionName"=>$sectionName,"menuFlag"=>$controllerName);
		$this->set('adminConfigArray', $adminConfigArray);
		$this->set('page_subtitle', "List SEO Default Values");

		$data=$this->$modelName->find('first',array("conditions"=>array("SeoManagement.id"=>1)));
		$this->set('data', $data);

		
	}
	
	function admin_edit($id=null){
		
		$modelName="SeoManagement";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;
		$this->set('modelName', $modelName);
		$this->set('controllerName', $controllerName);
		$adminConfigArray=array("modelName"=>$modelName,"controllerName"=>$controllerName,"sectionName"=>$sectionName,"menuFlag"=>$controllerName);
		$this->set('adminConfigArray', $adminConfigArray);
		$locales = Configure::read("LOCALES");
		
		if(!empty($this->request->data)){
			
			//
			$this->request->data["$modelName"]["id"]=1;
			foreach ($locales as $locale){
				$this->request->data["$modelName"]["slug"]["$locale"] = $this->StringManipulation->slug($this->data["$modelName"]["title"]["$locale"]);
			}
			
			//print_R($this->request->data);exit;
			
			if($this->$modelName->saveAll($this->request->data)){
	
				$this->Session->setFlash("Data saved successfully","admin/admin_succ");
				$this->redirect("/admin/$controllerName/edit");
				exit;
			}
		}else{
			$this->request->data=$this->get_all_locales(array("$modelName.id"=>1),"$modelName",Configure::read('LOCALES'),array('slug', 'prepend_title','append_title','title','keywords','description'));
			//print_r($this->request->data);exit;
		}
		
		$this->set("page_title",$this->sectionTitle);
		$this->set("page_subtitle","Edit ".$this->sectionTitle);
	}

	function get_selected_slug($modelName2,$fieldId,$locale = "eng"){
		$modelName="SeoManagement";
		$controllerName=$this->controllerName;
		$modelName2 = ucwords($modelName2);
		echo $this->$modelName->get_slug($modelName2,$fieldId,$locale);
		exit;
	}
}
?>