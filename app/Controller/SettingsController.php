<?php 
class SettingsController extends AppController {
	var $name = 'Settings';
	var $uses = array('Setting');
	
	
	var $controllerName = "Settings";
	var $modelName = "Setting";
	
	
	
	
	function beforefilter(){
		
		
		parent::beforefilter();
		if(!isset($this->params['admin'])){
			
		}else{
			
			$page_title="Site Configuration";
			$page_sub_title="Site Configuration";
				
			$menuFlag=11;
			$menuSectionId='general';
			
			
			$this->set("menuFlag",$menuFlag);
			$this->set("menuSectionId",$menuSectionId);
			
			$this->set("page_title",$page_title);
			$this->set("page_sub_title",$page_sub_title);
		}
	}
	
		
	
	
	
	
	
	

    function admin_simple_encrypt($text)
    {
    	
		$salt = Configure::read('Security.salt');;	
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function admin_simple_decrypt($text)
    {
    	$salt = Configure::read('Security.salt');
		
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
	
	
	
	function admin_encrypt_data($data){
		
		foreach($data as $key=>$content){
			$data["$key"]=$this->admin_simple_encrypt($content);
		}
		
		return $data;
		
	}
	function admin_decrypt_data($data){
		
		foreach($data as $key=>$content){
			$data["$key"]=$this->admin_simple_decrypt($content);
		}
		
		return $data;
	}
	
	
		
	function admin_edit($id=null){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		if (empty($this->request->data)){
			
			$data = $this->$modelName->find("first");
			
			
			//$data["$modelName"]=$this->admin_decrypt_data($data["$modelName"]);			
			$this->request->data=$data;
			
			$this->set('id',$data["$modelName"]['id']);
			//print_r($this->data);exit;
		}
		elseif($id != null || is_numeric($id) && !empty($id)){			
			//$data["$modelName"]=$this->admin_encrypt_data($data["$modelName"]);	
			
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
	
}
?>