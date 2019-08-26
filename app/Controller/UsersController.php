<?php
App::uses('Sanitize', 'Utility');
class UsersController extends AppController
{
	var $name = "Users";
	var $helpers = array('Text','Time','GetArrayFormat','Arabic');
	var $components = array('FileUpload',"Cookie","Email","Captcha");
	var $uses=array("User");
	var $modelName="User";
	var $controllerName="users";
	var $sectionName="users";
	var $pageTitle='Users';

	function beforeFilter(){

		parent::beforefilter();
		if(!isset($this->params['admin'])){
			if(!in_array($this->action,array("register","confirm","loginUser","logout","fb_login","login","forgot_pwd","newsletter","change_pwd","update_users_from_csv"))){
				$this->authenticate_user();
			}else{
			}

		}else{
			$this->set('page_title',"Users");
			$this->set("menuFlag",3);
		}
	}



	
	function set_page_title($section=null ){
		$menuSectionId='';
		//print_r($section);exit;
		switch ($section){
			case 'default':{
					$page_title="Users";
					$page_sub_title="User";
					$menuSectionId="hbku_employee_menu";
					$menuFlag=21;
				
				}
				break;	
	
					
			}
		
		$this->set("menuFlag",$menuFlag);
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuSectionId",$menuSectionId);
		
	}
	
	
	

	function admin_index($type=null){
		$modelName="User";
		$controllerName="users";
		
		
		$this->set("modelName",$modelName);
		$this->set("controllerName",$controllerName);
		
		$this->set_page_title('default');
		$search_cond="";
			if(isset($_GET['s'])){
				$search_phrase=$_GET['s'];
				$search_cond="($modelName.name like '%$search_phrase%' or $modelName.email like '%$search_phrase%' or )";
	
				$this->set('search_phrase',$search_phrase);
			}
			
			

		$cond = array($search_cond ,  "$modelName.type"=>$type);

		$this->paginate=array(
			'limit' => 20,
			'order' => array("$modelName.id" => 'DESC'),
			'conditions'=>$cond,
		);

		$data = $this->paginate("$modelName");
		$this->set('data', $data);
		print_R($data);exit;
		// $this->loadModel("Country");
		// $country_list = $this->Country->find("list");
		// $this->set("country_list",$country_list);
	}
	
	function admin_add(){
		$modelName = $this->modelName;
		$controllerName = $this->controllerName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		
		$this->set_page_title('default');
		
		$error=0;
		$locales = Configure::read("LOCALES");
		
		
		
// 		
		// if($user_type == 'client'){
			// //get group name
			// $this->loadModel("Group");
			// $group_list=$this->Group->getGroupListOfSelectedAccount($account_id);
			// $this->set("group_list",$group_list);	
		// }elseif($user_type=='cm'){
			// //get group name
			// $this->loadModel("Account");
			// $account_list=$this->Account->getAccountsList();
			// $this->set("account_list",$account_list);	
		// }
		
		
		//print_r($group_list);exit;
		//print_r($this->request->data);exit;
		if (!empty($this->request->data)){
		
				$email=$this->request->data['User']["email"];
				
				$email_duplicate=$this->$modelName->check_duplicates('email',$email);
				
				
				
				if($email_duplicate == 1){
					$this->Session->setFlash("User Email already exist , please try another email","admin/admin_err");
					// $this->redirect("/admin/Users/index/$account_id/$user_type");
					// exit;
					$error=1;
				}
				
				if($error == 0){
					$this->$modelName->create();
					// $this->request->data["$modelName"]['account_id']=$account_id;
					$this->request->data["User"]["real_password"]=$this->request->data["User"]["password"];
					$this->request->data["User"]["password"] = md5($this->request->data["User"]["password"]);
					
					
					// if($user_type == 'client'){
						// if(isset($this->request->data["group"])){
							// $groups=$this->request->data["group"];
							// $index=1;
// 							
							// foreach($groups as $key=>$g){
								// $user_group["$index"]['id'] = 0;
								// $user_group["$index"]['group_id'] = $key;
// 								
								// $index++;
							// }
// 			
							// $this->request->data["Group"]=$user_group;
						// }
					// }elseif($user_type == 'cm'){
						// if(isset($this->request->data["account"])){	
							// $account=$this->request->data["account"];
							// $index=1;
							// foreach($account as $key=>$a){
								// $user_account["$index"]['id'] = 0;
								// $user_account["$index"]['account_id'] = $key;
// 								
								// $index++;
							// }
							// $this->request->data["Account"]=$user_account;
						// }
					// }
					
					
					//$this->request->data['User']['user_type']=$user_type;
					if ($this->$modelName->saveAll($this->request->data)){
						$id=$this->$modelName->id;
						
						//$groups=$this->request->data["group"];
						//save relation Users and group
						//$this->loadModel("UsersGroup");
						
						// $index=1;
						// foreach($groups as $key=>$g){
	// 						
	// 						
							// $user_group["$index"]['UsersGroup']['id'] = 0;
							// $user_group["$index"]['UsersGroup']['user_id'] = $id;
							// $user_group["$index"]['UsersGroup']['group_id'] = $key;
	// 						
							// $index++;
						// }
						//print_r($user_group);exit;
						
						//$this->UsersGroup->saveAll($user_group);
						
						
						
						
						//send email to user
						$emailSubject =__("login Account",true);
						$template = "user_created";
		
						$emailFrom = Configure::Read("BASE_NOREPLY_EMAIL");
						$emailReplyTo = Configure::Read("BASE_NOREPLY_EMAIL");
		
		
						$userEmail = $this->request->data["User"]["email"];
						/* --send email to user ---- */
						$this->sendEmail($userEmail,$emailSubject,$template,$this->request->data,$emailReplyTo,$emailFrom);
						
						
						$this->Session->setFlash("Item Added Successfully","admin/admin_succ");
						$this->redirect("/admin/$controllerName/index/");
						exit;
					}
					else {
						$this->Session->setFlash("Item could not be saved. Please try again later.","admin/admin_err");
						exit;
					}
		}
		}
			 //$this->buildBreadCrumb($account_id,'add', 'Add User',$user_type);
	}

	function admin_activate($userId =0){
		if($this->RequestHandler->isAjax()){
			$this->layout='';
		}
		$modelName="User";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;

		////////Validating Id////////////
		if($userId==null || !is_numeric($userId)){
			$this->Session->setFlash("Invalid Request","admin/admin_err");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}


		$userInfo = $this->$modelName->find("first",array("contain"=>false,"conditions"=>array("$modelName.id"=>$userId),"fields"=>array("$modelName.id")));

		if($userId > 0){
			$this->$modelName->id=$userId;
			if($userId > 0){
				$this->$modelName->saveField("approved",1);
			}
		}

		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash("Status Changed successfully","admin/admin_succ");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		echo 1;
		exit;


	}

	function admin_deactivate($userId =0){
		$modelName="User";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;

		if($this->RequestHandler->isAjax()){
			$this->layout='';
		}

		////////Validating Id////////////
		if($userId==null || !is_numeric($userId)){
			$this->Session->setFlash("Invalid Request","admin/admin_err");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}


		$userInfo = $this->$modelName->find("first",array("contain"=>array(),"conditions"=>array("$modelName.id"=>$userId),"fields"=>array("$modelName.id")));

		if($userId > 0){
			$this->$modelName->id=$userId;

			if($userId > 0){
				$this->$modelName->saveField("approved",0);
			}
		}

		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash("Status Changed successfully","admin/admin_succ");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}
		echo 1;
		exit;

	}

	function admin_edit($userId){
		$modelName="User";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;

		$this->set_page_title('default');
		$this->set("modelName",$modelName);
		$this->set("controllerName",$controllerName);
		$this->set("sectionName",$sectionName);
		$this->set("userId",$userId);

		$getUser = $this->User->find("first",array("conditions"=>array("User.id"=>$userId)));

		$userId = $getUser["User"]["id"];
		
		// $this->loadModel("Country");
		// $country_list = $this->Country->find("list");
		// $this->set("country_list",$country_list);

		if(empty($this->request->data)){
			$this->request->data = $getUser;
			//$this->request->data["User"] = $getUser["User"];

		}else{
			
			
			$email=$this->request->data['User']["email"];
				
			$email_duplicate=$this->$modelName->check_duplicates('email',$email);
			
			
			
			if($email_duplicate == 1 && ($getUser['User']['email'] !=$email  )){
				$this->Session->setFlash("User Email already exist , please try another email","admin/admin_err");
				// $this->redirect("/admin/Users/index/$account_id/$user_type");
				// exit;
				$error=1;
			}
				
				
			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));

			$name = $this->request->data["User"]["name"];
			// $lname = $this->request->data["User"]["lname"];
			// $phone = $this->request->data["User"]["phone"];

			$error = 0;
			if(empty($name) ){
				$error = 1;
				$this->Session->setFlash(__("fill_all_fields",true),"admin/admin_err");
			}

			if(!empty($this->request->data["User"]["new_password"])){
				$new_pass=$this->request->data["User"]["new_password"];
				$rep_pass=$this->request->data["User"]["repeat_password"];
				
				if($new_pass  !=  $rep_pass){
					$this->Session->setFlash("Password Doesn’ts match","admin/admin_err");
					$this->redirect("/admin/Users/add");
					exit;
					$error=1;
				}
				
				$this->request->data["User"]["password"] = md5($this->request->data["User"]["new_password"]);

				//send email to user
				$emailSubject =__("password_changed_by_admin",true);
				$template = "pwd_changed_by_admin";

				$emailFrom = Configure::Read("BASE_NOREPLY_EMAIL");
				$emailReplyTo = Configure::Read("BASE_NOREPLY_EMAIL");


				$userEmail = $this->request->data["User"]["email"];
				/* --send email to user ---- */
				//$this->sendEmail($userEmail,$emailSubject,$template,$this->request->data,$emailReplyTo,$emailFrom);

			}

			if($error == 0){
				$this->request->data["User"]["id"] = $userId;
				// Save Profile
				if($userId > 0){
					if($this->User->save($this->request->data)){

						$this->Session->setFlash("User Edited Successfully","admin/admin_succ");
						$this->redirect("/admin/users/index");
						exit;
					}
				}
			}
		}
	}

	function admin_delete($userId=null){
		if($this->RequestHandler->isAjax()){
			$this->layout='';
		}
		$modelName="User";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;

		$get_data=$this->User->find('first',array('contain'=>array(),"conditions"=>array("User.id"=>$userId)));
		////////Validating Id////////////
		if($userId==null || !is_numeric($userId) || (empty($get_data))){
			if(!($this->RequestHandler->isAjax())){
				$this->Session->setFlash("Invalid Request","admin/admin_err");
				$this->redirect("/admin/$controllerName");
				exit;
			}

			echo "Invalid Request";
			exit;
		}

		$this->User->delete($userId,true);


		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash($this->pageTitle." deleted successfully","admin/admin_succ");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}

		exit;
	}

	//////////////////////////////////

	function fb_login($fbCheckedFlag = 0){
		require_once('facebook/facebook.php');

		$lang = $this->params["lang"];
		$this->loadModel("User");

		// Create our Application instance (replace this with your appId and secret).
		$facebook = new Facebook(array(
		'appId' => Configure::read("fbAppId"),
		'secret' => Configure::read("fbAppSecret"),
		'cookie' => Configure::read("fbAppSecret"),
//		'status' => true,
		));
		
		
//		if($fbCheckedFlag == 0){
//			$loginUrl = $facebook->getLoginUrl();
//			$this->set("loginUrl",$loginUrl);
//			return true;
//		}

		//initialize error variable
		$error = 0;

		// Get User ID
		$user = $facebook->getUser();
//		$loginUrl = $facebook->getLoginUrl();


		// We may or may not have this data based on whether the user is logged in.
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.

		if (!empty($user)) {
			try {
				// Proceed knowing you have a logged in user who's authenticated.
				$user_profile = $facebook->api('/me');
				$this->set("fbUserProfile",$user_profile);

			} catch (FacebookApiException $e) {
				//		    error_log($e);
				$user = null;
			}
		}

		// Login or logout url will be needed depending on current user state.
		if ($user && !empty($user)) {

			
			$fbId = $user_profile["id"];

			$userId = $this->User->check_if_fb_id_exists($fbId);

			
//			if($userId > 0 || $fbCheckedFlag ==1 ){
			if($fbCheckedFlag ==1 ){
				$email = isset($user_profile["email"]) ? $user_profile["email"] : '';

//				if($userId == 0){
//					$userId = $this->User->check_if_fb_email_exists($email,$fbId);
//					//				 to correct the old incorrect ids
//					if($userId > 0){
//						$fbData["User"]["id"] = $userId;
//						$fbData["User"]["facebook_id"] = $fbId;
//
//						$this->User->save($fbData);
//					}
//				}



				$fname = $user_profile["first_name"];
				$lname = $user_profile["last_name"];

				if(isset($user_profile["hometown"]["name"])){
					$country = $user_profile["hometown"]["name"];

					if(!empty($country)){
						$countryArray = explode(", ",$country);
						$countryName = '';
						if(sizeof($countryArray) > 1)
						$countryName = $countryArray[1];

						$this->loadModel("Country");
						$country_id = $this->Country->getCountryId($countryName);

						$userData["User"]["country_id"] = $country_id;
					}
				}


				$now = time();

				// when checking the session automatically in the users/login we dont want to login any user from fb,
				// just the ones that previously intended to login from fb
				//			if(($fromLoginFt == 0 || $userId > 0) && !empty($name)){
				if(!empty($email)){

					$error = 0;
					$logoutUrl = $facebook->getLogoutUrl();

					$userData["User"]["id"] = $userId;
					$userData["User"]["facebook_id"] = $fbId;
					$userData["User"]["fname"] = $fname;
					$userData["User"]["lname"] = $lname;
					$userData["User"]["dob"] = $user_profile["birthday"];

					$userData["User"]["ip"] = $_SERVER["REMOTE_ADDR"];
					$userData["User"]["last_login"] = $now;
					$userData["User"]["last_activity"] = $now;


					$newUser = 0;


					if($userId == 0 && $error == 0){
						if($fbCheckedFlag == 0){
//							if the user is logged in throught fb but never logged in to the site, he shouldn't be set as logged in user

//							$loginUrl = $facebook->getLoginUrl();
//							$this->set("loginUrl",$loginUrl);
							$error = 1;
						}

						$newUser = 1;

						$userData["User"]["email"] = $email;
						$userData["User"]["facebook_id"] = $fbId;
						$userData["User"]["confirmed"] = 1;
						$userData["User"]["approved"] = 1;

					}

					$this->User->id = $userId;

					if($error == 0){
						/* --check for duplicate emails ---- */
						$checkDuplicate = $this->User->check_duplicates("email",$email,"User.id != $userId");
						if($checkDuplicate == 1){
							$error = 1;
							$this->Session->setFlash(__("duplicate_fb_emails",true),"err_msg");

							$facebook->destroySession();

						}else
						{
							if($this->User->save($userData["User"])){

								$userId = $this->User->id;

								$userData["User"]["id"] = $userId;

								$userData = $this->User->read();
								$userData["logoutUrl"] = $logoutUrl;

								$this->Session->write(Configure::read("User_Session_Name"), $userData);

								if($newUser == 1){
//									$this->redirect("/pages/rules");
									$this->redirect("/");
									exit;
								}

							}
						}

						$this->set("logoutUrl",$logoutUrl);

					}else{
					
						//new user, never logged in
//						$loginUrl = $facebook->getLoginUrl();
//						$this->set("loginUrl",$loginUrl);
					}

				}


				if($error == 0){
					
					$this->loadModel("GeneralSettings");
					$websitePhase = $this->GeneralSettings->getPhase();
					$websitePhase = $websitePhase["GeneralSettings"]["value"];
			
					if($websitePhase != "voting_phase"){
						$this->redirect("/$lang/pages/home/1");
					}else{
						$this->redirect("/$lang/videos/vote");
					}
				
//					$this->redirect("/pages/home/1");
					exit;
				}

			}else {
				
				if($fbCheckedFlag == 1 && $userId == 0){
//					$userId = $this->User->check_if_fb_email_exists($email,$fbId);
//					//				 to correct the old incorrect ids
//					if($userId > 0){
//						$fbData["User"]["id"] = $userId;
//						$fbData["User"]["facebook_id"] = $fbId;
//
//						$this->User->save($fbData);
//					}
					
//					echo "$fbCheckedFlag $userId over here";
				exit;
				return true;
				}
				
				
			
				//new user, never logged in
//				$loginUrl = $facebook->getLoginUrl();
//				$this->set("loginUrl",$loginUrl);
			}

		} else {
			
			$this->redirect("/");
			exit;
//			$loginUrl = $facebook->getLoginUrl();
//			$this->set("loginUrl",$loginUrl);

			//		  if($fromJs){
			//		 	 $this->redirect("/users/login/");
			//			exit;
			//		  }
		}
	
	}

	function register(){
		exit;
		$locale = $this->params["locale"];
		
		$this->loadModel("Country");
		$countries = $this->Country->getList($locale);
		$this->set("countries",$countries);
			
		if(empty($this->request->data)){
			
			
		}else{
		
			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));

			
			$fname = $this->request->data["User"]["fname"];
			$lname = $this->request->data["User"]["lname"];
			$email = $this->request->data["User"]["email"];
			$password = $this->request->data["User"]["password"];
			$confirm_password = $this->request->data["User"]["confirm_password"];
			
			$phone = $this->request->data["User"]["phone"];
			$this->request->data["User"]["password"] = md5($password);
			$this->request->data["User"]["ip"] = $_SERVER["REMOTE_ADDR"];
			$this->request->data["User"]["approved"] = 1;
			
			
		
			$dobMonth = $this->request->data["User"]["month"];
			$dobDay = $this->request->data["User"]["day"];
			$dobYear = $this->request->data["User"]["year"];
			if(!empty($dobMonth) && !empty($dobDay) && !empty($dobYear)){
				if(checkdate($dobMonth,$dobDay,$dobYear)){
					$dob = mktime(0,0,0,$dobMonth,$dobDay,$dobYear);
					
					$this->request->data["User"]["dob"] = $dob;
				}
			}

			$error = 0;
			if(empty($fname) || empty($lname) || empty($email) || empty($password) || empty($confirm_password)){
				$error = 1;
				if($this->RequestHandler->isAjax()){
					echo __("fill_all_fields",true);
					exit;
				}
				$this->Session->setFlash(__("fill_all_fields",true),"err_msg");
			}else
			/* --check for confirm password ---- */
			if($password != $confirm_password){
				$error = 1;
				if($this->RequestHandler->isAjax()){
					echo __("incorrect_pwds",true);
					exit;
				}
				$this->Session->setFlash(__("incorrect_pwds",true),"err_msg");
			}
			else{
				/* --check for duplicate emails ---- */
				$checkDuplicate = $this->User->check_duplicates("email",$email);
				if($checkDuplicate == 1){
					$error = 1;
					if($this->RequestHandler->isAjax()){
						echo __("duplicate_emails",true);
						exit;
					}
					$this->Session->setFlash(__("duplicate_emails",true),"err_msg");
				}
			}
			
				
			if (!$this->Captcha->validate()) {
				if(!$this->RequestHandler->isAjax()){
					$this->Session->setFlash(__("incorrect_code",true),"err_msg");
				}
				else{
					echo __("incorrect_code",true);
					exit;
				}
				$error=1;
			}

				if($error == 0){
	
				// Save Profile
				if($this->User->save($this->request->data)){
	
					// Send email
					$userId=$this->User->id;
					$code=md5('d#npf4oVyll!-n8uyd'.$userId.'Ikl*hbj%kl');
					$this->request->data["User"]["id"]=$userId;
					$this->request->data["User"]["code"]=$code;
					$emailSubject =__("confirm_registration_email",true);
					$template = "registration";
	
					$emailFrom = Configure::read("BASE_NOREPLY_EMAIL");
					$emailReplyTo = Configure::read("BASE_NOREPLY_EMAIL");
					
					/* --send email to user ---- */
					$this->sendEmail($email,$emailSubject,$template,$this->request->data["User"],$emailReplyTo,$emailFrom);
	
	
					if($this->RequestHandler->isAjax()){
						echo 1;
					}else{
						$this->Session->setFlash(__("registration_successful",true),"succ_msg");
						$this->redirect("/");
					}
					exit;
	
				}
	
			}
		}
	}
	
	function confirm($userId=null,$conf_code=null){
		$code=md5('d#npf4oVyll!-n8uyd'.$userId.'Ikl*hbj%kl');
		if($conf_code==$code){
			$this->User->contain(array());
			$getUser = $this->User->find('first',array('conditions'=>array("User.id"=>$userId)));

			if(empty($getUser)){
				$this->Session->setFlash(__("invalid_request",true),"err_msg");
				$this->redirect("/");
				exit;
			}
			if($getUser["User"]["confirmed"] == 0){

				$email = $getUser["User"]["email"];

				$this->request->data["User"]["id"] = $userId;
				$this->request->data["User"]["confirmed"] = 1;
				$this->User->id = $userId;
				if($userId > 0)
				$this->User->save($this->request->data);
				

				$userPassword = $getUser["User"]["password"];
				$codedPwd = md5('4AncyjVd8&d*'.$userPassword.'56VN9@');
				$this->loginUser($userId,$codedPwd);
			
				$this->Session->setFlash(__("account_confirmed",true),"succ_msg");
				$this->redirect("/");
				exit;
			}

			if($getUser["User"]["confirmed"] == 1){
				$this->Session->setFlash(__("account_already_confirmed",true),"err_msg");
				$this->redirect("/");
				exit;
			}


		}else{
			$this->Session->setFlash(__("invalid_request",true),"err_msg");
			$this->redirect("/");
			exit;
		}
	}
	
	function loginUser($userId = 0, $pwdCode=""){
		$this->User->contain();
		$getUser = $this->User->find('first',array('conditions'=>array("User.id"=>$userId)));
		
		if(!empty($getUser)){
			$userPassword = $getUser["User"]["password"];
			$codedPwd = md5('4AncyjVd8&d*'.$userPassword.'56VN9@');

			if($pwdCode == $codedPwd){
				
				$now = time();
				$ip = $_SERVER["REMOTE_ADDR"];

				$data = $getUser;
				$data["User"]["last_login"] = $now;
				//$data["User"]["ip"] = $ip;

				if(!empty($getUser))
					$this->User->save($data);
				
				$this->Session->write(Configure::read("User_Session_Name"), $data);
			}
		}
	}
	
	function logout(){

		$userInfo = $this->Session->read(Configure::read("User_Session_Name"));
		
		if($userInfo){
			$userId = $userInfo["User"]["id"];
		}


		$this->Session->delete(Configure::read("User_Session_Name"));
		setcookie ('Azyaa_Mode_Cookie', "", time() - 3600);
		

		$this->Session->setFlash(__('successfull_logout',true),'succ_msg');
		$this->redirect("/");
		exit;

	}
	
	function login(){
		$this->layout="users_login";
		$lang=$this->params['lang'];
		$userInfo = $this->Session->read(Configure::read("User_Session_Name"));
		
		if(!empty($userInfo)){
				$this->redirect("/");
				exit;
		}
		
		if(isset($_GET["page"]))
			$redirectLoc = $_GET["page"];
		else 	$redirectLoc = "";
		$this->set("redirectLoc",$redirectLoc);
		
		
		if(!empty($this->request->data)){
			
			
			if(isset($_GET["page"]))
			$redirectLoc = $_GET["page"];
			else 	$redirectLoc = "";

			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));

			$email=$this->request->data["User"]['email'];
			$password=md5($this->request->data["User"]['password']);

			$this->request->data["User"]['password']=$password;
			
			$getUser = $this->User->find('first',array('contain'=>false,'conditions'=>array("User.email"=>$email,"User.password"=>$password)));
			
			if(empty($getUser)){
				$this->Session->setFlash(__('wrong_username_password',true),'err_msg');
				$this->redirect("/");
				exit;
			}else{
				
				$userId = $getUser["User"]["id"];
				$codedPwd = md5('4AncyjVd8&d*'.$password.'56VN9@');
				
				$this->loginUser($userId,$codedPwd); 
				
				//$redirectLoc = $this->request->data["User"]["redirectLoc"];
				
				if(!empty($redirectLoc))
					$this->redirect($redirectLoc);
				else $this->redirect("/$lang/DynamicPages/employee");
				exit;
			}
		}
	}
	
	function edit_profile(){
		exit;
		
		$userInfo = $this->Session->read(Configure::read("User_Session_Name"));
		$userId = $userInfo["User"]["id"];
		$locale = $this->params["locale"];

		$this->loadModel("Country");
		$countries = $this->Country->getList($locale);
		$this->set("countries",$countries);

		if(empty($this->request->data)){
			$this->request->data = $userInfo;
			
			$dob = $this->request->data["User"]["dob"];
			if(!empty($dob)){
				$this->request->data["User"]["month"] = date("m",$dob);
				$this->request->data["User"]["day"] = date("d",$dob);
				$this->request->data["User"]["year"] = date("Y",$dob);
			}
			
			
			
		}else{

			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false,'backslash'=>false));

			$fname = $this->request->data["User"]["fname"];
			$lname = $this->request->data["User"]["lname"];
			$this->request->data["User"]["email"] = $userInfo["User"]["email"];
			$country_id = $this->request->data["User"]["country_id"];
			$phone = $this->request->data["User"]["phone"];
			
			
			$dobMonth = $this->request->data["User"]["month"];
			$dobDay = $this->request->data["User"]["day"];
			$dobYear = $this->request->data["User"]["year"];
			if(checkdate($dobMonth,$dobDay,$dobYear)){
				$dob = mktime(0,0,0,$dobMonth,$dobDay,$dobYear);
				
				$this->request->data["User"]["dob"] = $dob;
			}

			$error = 0;

				if(empty($fname) || empty($lname) || empty($country_id)){
					$error = 1;
					if($this->RequestHandler->isAjax()){
						echo __("fill_all_fields",true);
						exit;
					}else{
						$this->Session->setFlash(__("fill_all_fields",true),"err_msg");
					}
				}
			

			if($error == 0){
				$this->request->data["User"]["id"] = $userId;
				// Save Profile
				if($userId > 0){
					if($this->User->save($this->request->data)){

						$sessionData["User"] = array_merge($userInfo["User"],$this->request->data["User"]);

						$this->Session->write(Configure::read("User_Session_Name"), $sessionData);

					}
				}

				$this->Session->setFlash(__("profile_edited",true),"succ_msg");
				$this->redirect("/");
				exit;
			}
		}
		
	}
	
	function edit_password(){
		$userInfo = $this->Session->read(Configure::read("User_Session_Name"));
		$userId = $userInfo["User"]["id"];
		$userRealPassword = $userInfo["User"]["password"];
		$locale = $this->params["locale"];

		if(empty($this->request->data)){

		}else{

			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));

			$error = 0;

			$oldPwd = $this->request->data["User"]["old_password"];
			$newPwd = $this->request->data["User"]["new_password"];
			$confirmPwd = $this->request->data["User"]["confirm_password"];


			if(md5($oldPwd) != $userRealPassword){
				$this->Session->setFlash(__("incorrect_old_password",true),"err_msg");
				$error = 1;
			}
			if($newPwd != $confirmPwd){
				$this->Session->setFlash(__("passwords_not_match",true),"err_msg");
				$error = 1;
			}

			if(strlen($newPwd) < 6){
				$this->Session->setFlash(__("short_password",true),"err_msg");
				$error = 1;
			}


			$this->request->data["User"]["id"] = $userId;
			$this->request->data["User"]["password"] = md5($newPwd);

			// Save Profile
			if($userId > 0 && $error == 0){
				if($this->User->save($this->request->data)){

					$sessionData["User"] = array_merge($userInfo["User"],$this->request->data["User"]);

					$this->Session->write(Configure::read("User_Session_Name"), $sessionData);
					
					$this->Session->setFlash(__("password_changed_successfully",true),"err_msg");
					$this->redirect("/");
					exit;
					
				}
			}
			
			
		}

	}
	
	function newsletter(){
		$modelName  = "Newsletter";
		
		if(!empty($this->request->data)){
			/////////////////// save newsletter
			$host=Configure::read('NEWSLETTER_URL');	////////without http
			$port=80;
			$path=Configure::read('NEWSLETTER_REGISTRATION_PATH');////////the action name and parameters
			//$str contains the variables that sould be passed to the newsletter
	
			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));
	
			$this->request->data[$modelName]['fname']=addslashes(strip_tags($this->request->data[$modelName]['fname']));
			$this->request->data[$modelName]['lname']=addslashes(strip_tags($this->request->data[$modelName]['lname']));
			$this->request->data[$modelName]['email']=addslashes(strip_tags($this->request->data[$modelName]['email']));
	//		$this->request->data[$modelName]['country']=addslashes(strip_tags($this->request->data[$modelName]['country']));
			
	
		$apikey = Configure::read("MailChimp_API_Key");
		$listId = Configure::read("MailChimp_List_Id");
		$api = $this->MailChimp->MCAPI($apikey);
		$userEmail = $this->request->data[$modelName]['email'];
		
		if($this->request->data[$modelName]['subscribe'] == 1){
			
			$merge_vars = array(
					'FNAME'=>$this->request->data[$modelName]['fname'], 
					'LNAME'=>$this->request->data[$modelName]['lname']
			 );
			
			
			// By default this sends a confirmation email - you will not see new members
			// until the link contained in it is clicked!
			$retval = $this->MailChimp->listSubscribe( $listId, $userEmail, $merge_vars );
			
			if ($this->MailChimp->errorCode){
				echo __("newsletter_not_successful",true);
	//			echo "Unable to load listSubscribe()!\n";
	//			echo "\tCode=".$api->errorCode."\n";
	//			echo "\tMsg=".$api->errorMessage."\n";
			} else {
			    echo __("newsletter_successful",true);
			}
		}else{

			$retval = $this->MailChimp->listUnsubscribe( $listId,$userEmail);
			if ($this->MailChimp->errorCode){
				echo __("newsletter_not_successful",true);
			} else {
			    echo __("newsletter_unsbuscribed",true);
			}
			
		}

	
			exit;
		}
	}
	
	function forgot_pwd(){

		if(!empty($this->request->data)){

			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));

			$email=$this->request->data['Forgot']['email'];
			if($email!=""){

				$this->User->contain();
				$getUser = $this->User->find('first',array('conditions'=>array("User.email"=>$email)));

				if(!empty($getUser)){
					$userId=$getUser['User']['id'];

					// Send email
					$code=md5('d#npf4oVyll!-n8uyd'.$userId.'Ikl*hbj%kl');
					$this->request->data = $getUser;
					$this->request->data["User"]["code"]=$code;
					$emailSubject =__("forgot_pwd",true);
					$template = "change_pwd_request";

					/* --send email to user ---- */
					$this->sendEmail($email,$emailSubject,$template,$this->request->data["User"]);


					$this->Session->setFlash(__("change_pwd_email_sent",true),"succ_msg");
					$this->redirect("/users/login");
					exit;
				}else{
					$this->Session->setFlash(__("invalid_request",true),"err_msg");
					$this->redirect("/users/login");
					exit;
				}
			}else{
				$this->Session->setFlash(__("fill_all_fields",true),"err_msg");
				$this->redirect("/users/login");
				exit;
			}
		}
	}
	
	function change_pwd($userId=null,$conf_code=null){
		$code=md5('d#npf4oVyll!-n8uyd'.$userId.'Ikl*hbj%kl');
		if($conf_code==$code){
			$arrayOfLetters = Array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
			srand ((float) microtime() * 10000000);
			$password = "";
			for ($i = 0 ; $i < 8; $i++){
				$randomNumber = rand(0,51);
				$password .= $arrayOfLetters[$randomNumber];
			}

			$this->User->contain();
			$getUser = $this->User->find('first',array('conditions'=>array("User.id"=>$userId)));

			if($getUser["User"]["facebook_id"] > 0){
				$this->Session->setFlash("You are logged in from facebook","succ_msg");
				$this->redirect("/");
				exit;
			}
			if(!empty($getUser)){
				$getUser ["User"]["password"] = md5($password);

				if($userId > 0){
					$this->User->id=$userId;
					$this->User->saveField("password",md5($password));
				}

				// Send email
				$this->request->data = $getUser;
				$email = $getUser["User"]["email"];
				$this->request->data["User"]["password"]=$password;
				$emailSubject ="Your password has been reset";
				$template = "change_pwd";

				/* --send email to user ---- */
				$this->sendEmail($email,$emailSubject,$template,$this->request->data["User"]);

				$msg_content=__("flash_msg_pwd_changed",true);
				$this->Session->setFlash($msg_content,'succ_msg');
				$this->redirect("/users/login");
				exit;
			}
		}else{
			$this->Session->setFlash(__('invalid_request',true),'err_msg');
		}

		$this->redirect("/users/login");
		exit;
	}




	function update_users_from_csv(){
		$row = 1;
		//print_r('test');exit;
		// art_1.csv 1
		// art_2.csv
		// art_3.csv
		// bus_1.csv 3
		// bus_2.csv
		// education.csv 5
		// eng_1.csv   6
		// eng_2.csv
		// eng_3.csv
		// Mbr.csv 4
		// sciences_1.csv 2
		// sciences_2.csv
		// sciences_3.csv
		// sciences_4.csv
		
		
		exit;
		
		if (($handle = fopen("files/Book1.csv", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        $num = count($data);
				//print_r($data);exit;
		        echo "<p> $num fields in line $row: <br /></p>\n";
		        //Guide2014
		        //print_r($row);exit;
				if($row > 1){
					
					$user["User"]['email']=$data[0];
					$user["User"]['password']=md5('Guide2014');
					
					
					// $course_code=$courses["Course"]['code'];
					// $course_id=$this->Course->find("first",array("conditions"=>array("Course.code"=>$course_code)));
// 					
					// //print_r($data[9]);
// 					
					// $courses["Course"]['id']=$course_id['Course']['id'];
// 					
					// $pattern = '/[^a-zA-Z0-9\’ ]/';
					// $replacement="'";
						
					// $cacheId = "all_languages";
					// if (($languages = Cache::read($cacheId)) === false){
						// $this->loadModel("Language");
						// $languages=$this->Language->find('all',array('callbacks'=>false));
						// Cache::write($cacheId, $languages);
					// }
// 		
					// foreach ($languages as $lang){
						// $locale = $lang["Language"]["locale"];
// 						
						// // $courses["Course"]['title']["$locale"]=preg_replace($pattern, $replacement, $data[2]);
						// // $courses["Course"]['semester']["$locale"]=preg_replace($pattern, $replacement, $data[8]);						
						// // $courses["Course"]['text']["$locale"]=preg_replace($pattern, $replacement, $data[9]);
// 						
						// $courses["Course"]['title']["$locale"]=$data[2];
						// $courses["Course"]['semester']["$locale"]=$data[8];						
						// $courses["Course"]['text']["$locale"]=$data[9];
// 						
						// // $courses["Course"]['title']["$locale"]= str_replace("’","\'",$data[2]);
						// // $courses["Course"]['semester']["$locale"]= str_replace("’","\'",$data[8]); 					
						// // $courses["Course"]['text']["$locale"]= str_replace("’","\'",$data[9]); 					
					// }
					
					
					
					
					
					
					$modelName = $this->modelName;
					$controllerName = $this->controllerName;
					
					if(!empty($user)){
						//$this->$modelName->id=$course_id['Course']['id'];
					//	print_r($courses);
						$this->$modelName->saveAll($user);
					}
					
				}
				
				
				$row++;
		        // for ($c=0; $c < $num; $c++) {
		            // echo $data[$c] . "<br />\n";
		        // }
		    }
		    fclose($handle);
		}
		
		
		exit;
		
		//print_r($courses);exit;
		
	}



	
//	function accept_rules(){
//		$this->authenticate_user(1);
//		$userInfo = $this->Session->read(Configure::read("User_Session_Name"));
//		$userId = $userInfo["User"]["id"];
//		
////		$code = md5("0n%c3pt*{$userInfo}Upl0a4th903c");
//		
//		if(!empty($this->request->data)){
//			if($this->request->data["Rules"]["accept"] == 1){
//				$this->redirect("/videos/upload_video");
//				exit;
//			}else{
//				$this->redirect("/");
//				exit;
//			}
//		}
//	}
	
}
?>