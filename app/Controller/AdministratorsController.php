<?php 
require_once(ROOT.'/app/Vendor/Analytics/gapi.php');
class AdministratorsController extends AppController
{
	var $name = "Administrators";
	var $helpers = array();
	var $components = array();
	var $uses=array('Administrator');


//	function beforefilter(){
//		if(!$this->RequestHandler->isAjax() && (isset($this->request->params['admin']) && $this->request->params['admin'])){
//			if(!$this->Access->check($this->name, $this->action, $this->Session->read('Admin.level'))){
//				$this->Session->setFlash('Invalid request!', null, null, 'err');
//				$this->redirect('/administrators/logout/');
//				exit;
//			}
//			else{
//				$this->admin_beforeFilter();
//				$this->set('adminname',$this->Session->read('Admin.admin_name'));
//				$this->layout="admin/default";
//			}
//		}
//	}
	
	function admin_index() {
		$this->layout='admin/default';
		 
		
	}

	function admin_editpassword()
	{
		$this->layout='admin/default';
		$adminname= $this->Session->read('Admin.admin_name');
		$arr= $this->Administrator->findByUsername($adminname);
		$id=$arr['Administrator']['id'];
		if(empty($this->request->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid administrator.', null, null, 'err');
				$this->redirect('/admin/administrators/');
				exit;
			}
			$this->request->data = $this->Administrator->read(null, $id);
		} else {
			
			$entered_pass=md5($this->request->data['Administrator']['password']);
			$count=$this->Administrator->find('count',array('conditions'=>array('username'=>$adminname,'password'=>$entered_pass)));
			
			if($count > 0){
				
				if($this->request->data['Administrator']['newpassword']!=""){
					if($this->request->data['Administrator']['newpassword']==$this->request->data['Administrator']['confirmpassword']){
					$this->request->data['Administrator']['password'] =$this->request->data['Administrator']['newpassword'];
					$this->Administrator->id=$id;
					$this->request->data['Administrator']['id']=$id;
					$this->request->data['Administrator']['password']=md5($this->request->data['Administrator']['password']);
					$this->Administrator->set($this->request->data);
					if($this->Administrator->save($this->request->data)) {
						$this->Session->setFlash('The Password has been changed.', null, null, 'succ');
						$this->redirect('/admin/administrators/');
						exit;
					}
				}else $this->Session->setFlash('The password and its confirmation do not match', null, null, 'err');
				}
			}
			else{
					$this->Session->setFlash("Incorrect Old Password","admin/admin_succ");
					$this->redirect("/admin/Administrators/editpassword/");
					exit;
					
				// $this->Session->setFlash('Incorrect Old Password.', null, null, 'err');
				// $this->redirect('/admin/Administrators/editpassword/');
				
			}
		}
	}

	function login(){
		
		$this->layout='admin/login';
		
		
		$ip=$_SERVER['REMOTE_ADDR'];
		if ($this->request->data){
			
			$date=date('mY');
			$username=$this->request->data['Administrator']['username'];
			
			$results = $this->Administrator->findByUsername($username);
			
			if ($results && $results['Administrator']['password'] == md5($this->request->data['Administrator']['password'])){
				//print_r($this->request->data);exit;
				$loginMessage="Login successfull using username: '$username' from IP: $ip";

				$this->log($loginMessage, "logins/$date/logs");
				$this->Session->write('Admin.admin_name', $this->request->data['Administrator']['username']);
				$this->Session->write('Admin.level', $results['Administrator']['level']);
				$this->redirect('/admin/Administrators/dashboard/');
			}
			else {
				
				$loginMessage="Login unsuccessfull using username: '$username' from IP: $ip";
				$this->log($loginMessage, "logins/$date/logs");
				// $this->Session->setFlash('Wrong username/password. Please try again. ',null,null, 'err');
				// $this->redirect('/administrators/login/');
// 				
				$this->Session->setFlash("Wrong username/password. Please try again. ","admin/admin_login_error");
				$this->redirect("/administrators/login/");
				exit;
		}
		}
	}

	function logout(){
		$this->Session->destroy();
		$this->Session->setFlash('You are logged out! ',null,null, 'succ');
		$this->redirect('/administrators/login');
	}










	function admin_dashboard(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		
		$this->loadModel("Setting");
		$settings=$this->Setting->getSocialMediaLinks();
		
		$this->set("settings",$settings);
		//print_r($settings);exit;
		
		
	}
	
	
// 	///////////////////////////////// end of admin functions ///////////////////////////////
	
	
	
	/// used to get google anylatics
	
	public function admin_getstats(){
	
		// $siteStats = Cache::read('siteStats', 'stat');		
		$siteStats = '';
		if(empty($siteStats)){
			$this->loadModel("Setting");
			$settings=$this->Setting->getSocialMediaLinks();
				
				
			
			
			// $username = "themall.ganalytics@gmail.com";
			// $password = "TheM4ll@G4";
			// $reportId = "99611474";
			
				
			$username = $settings['Setting']['googleUsername'];
			$password = $settings['Setting']['googlePassword'];
			$reportId = $settings['Setting']['googleReportId'];
// 			
// 			
			
			if(!empty($username) and !empty($password) and !empty($reportId) ){
				
				
				$ga = new gapi($username,$password);
				//print_R($ga);exit;
				
				$ga->requestReportData($reportId,array('year','month','day'),array('pageviews','visits'),array('year','month'));
	
				$results = $ga->getResults();
				$pageviews = $ga->getPageviews();
				$visits = $ga->getVisits();
	
				$siteStats['results'] = $results;
				$siteStats['pageviews'] = $pageviews; 
				$siteStats['visits'] = $visits;
				
				//print_r($siteStats);exit;
				//Cache::write('siteStats',$siteStats,'stat');
	
				$this->set(compact('results','pageviews','visits'));
	
			}else{
				
				echo "<div class='alert' >Please provide the correct google analytics credentials in the <a href='/admin/configs/modify#google'>configuration section</a></div>";
				exit;
				
			}
		}
		else{
		
				$results = $siteStats['results'] ;
				$pageviews =$siteStats['pageviews'] ; 
				$visits = $siteStats['visits'];
				$this->set(compact('results','pageviews','visits'));
			
		}

	}
	





}