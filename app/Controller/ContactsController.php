<?php
App::uses('Sanitize', 'Utility');
class ContactsController extends AppController {
	var $name = "Contacts";
	var $uses = array("Contact","ContactCategory");
	var $components = array("Captcha", "Email");
	var $helpers = array("Paginator");

	var $controllerName = "contacts";
	var $modelName = "Contact";
	var $userFilesFolder = "contacts";

	function beforefilter(){
		parent::beforefilter();
		if(!isset($this->request->params['admin'])){

		}else{

			$menuSectionId="general_menu";
			$this->set("menuFlag",7);
			$this->set("menuSectionId",$menuSectionId);
		}
	}

	function set_page_title($section=null){
		$menuSectionId='';
		switch ($section){
			case 'default':{

					$page_title="Contact us";
					$page_sub_title="Contact us";
					$menuSectionId="contact";

					$menuFlag=14;
				}
				break;
			}

		$this->set("menuFlag",$menuFlag);
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuSectionId",$menuSectionId);

	}

	public function admin_read($id)
    {
        $modelName = $this->modelName;
        $controllerName = $this->controllerName;
        ////////Validating Id////////////
        if ($id == null || !is_numeric($id)) {
            if (!$this->RequestHandler->isAjax()) {
                $this->Session->setFlash("Invalid Request");
                $this->redirect("/admin/$controllerName/index");
            }
            exit;
        }

        $this->$modelName->id = $id;
        $this->$modelName->saveField("read_flag", 1);

        if (!($this->RequestHandler->isAjax())) {
            $this->Session->setFlash("Status Changed successfully");
            $this->redirect("/admin/$controllerName/index");
            exit;
        }
        echo 1;
        exit;

    }

	function admin_index(){
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;

		$this->loadModel($modelName);

		$this->set("modelName",$modelName);
		$this->set("controllerName",$controllerName);
		$this->set_page_title("default");
		////////Getting the Data////////////


		$search_cond="";
		if(isset($_GET['s'])){
			$search_phrase=$_GET['s'];
			//or $modelName.subject like '%$search_phrase%'
			$search_cond="($modelName.name like '%$search_phrase%' or $modelName.email like '%$search_phrase%'  )";

			$this->set('search_phrase',$search_phrase);
		}


		$cond=array($search_cond);

		$this->paginate=array(
		'limit' => 20,
		'order' => array("$modelName.id" => 'DESC'),
		'conditions'=>$cond
		);

		$data = $this->paginate("$modelName");
		//print_r($data);exit;
		$this->set('data', $data);


	}

	function admin_delete($id=null){
		if($this->RequestHandler->isAjax()){
			$this->layout='';
		}
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;

		$this->loadModel($modelName);

		////////Validating Id////////////
		if($id==null || !is_numeric($id)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName");
			exit;
		}

		$this->$modelName->id=$id;
		$this->$modelName->delete($id,true);


		if(!($this->RequestHandler->isAjax())){
			$this->Session->setFlash("Contact Form deleted successfully");
			$this->redirect("/admin/$controllerName");
			exit;
		}
		exit;
	}

	function admin_view($id=null){
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;

		$this->set("modelName",$modelName);
		$this->set("controllerName",$controllerName);

		$this->set_page_title("default");


		$this->layout="admin/empty";

		////////Validating Id////////////
		if($id==null || !is_numeric($id)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName");
			exit;
		}

		$this->request->data=$this->$modelName->find('first',array("conditions"=>array("$modelName.id"=>$id)  , 'contain'=>array("ContactDepartment")));


		if($this->request->data[$modelName]["read_flag"]==0){
			$this->$modelName->id=$id;
			$this->$modelName->saveField("read_flag",1);
		}

	}
	/////////////////////////////////////// end of admin interface ///////////////////

	function index(){
		$modelName=$this->modelName;
		$controllerName=$this->controllerName;
		$cond='';
		$locale = $this->request->params['locale'];
		$this->loadModel('SeoManagement');

		$pageTitle=__('Contact Us',true);
		$this->set('pageTitle',$pageTitle);

		$this->loadModel("DynamicPage");
		$data=$this->DynamicPage->getContactsDetails($locale);

		$seoData['SeoManagement']=$data['SeoManagement'];
		if(!($this->RequestHandler->isAjax())){

			// $this->loadModel('HeaderCommunicationBanner');
			// $HeaderCommunicationBanner=$this->HeaderCommunicationBanner->getSectionHeaderCommunicationBanners('contacts',0,$locale);
			// $this->set('HeaderCommunicationBanner',$HeaderCommunicationBanner);

			//get background
			$this->loadModel("Background");
			$back_ground=$this->Background->getSectionBackgrounds('Contact','contact');
			$this->set('back_ground',$back_ground);
			//print_r($back_ground);exit;
		}

		$this->loadModel("ContactDepartment");
		$contant_departments=$this->ContactDepartment->getContactReasonsList($locale);

		$this->set(compact(array("data","modelName","seoData","contant_departments")));

	}

	function save_contact(){

		$modelName=$this->modelName;
		$locale=$this->params['locale'];

		if(!empty($this->request->data)){
			//print_r($this->request->data);exit;

			//print_R($this->request->data);exit;
			$err=0;

			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));

			$this->request->data[$modelName]['id']=0;
			$this->request->data[$modelName]['name']=addslashes(strip_tags($this->request->data[$modelName]['name']));

			// $this->request->data[$modelName]['phone']=addslashes(strip_tags($this->request->data[$modelName]['phone']));
			$this->request->data[$modelName]['email']=addslashes(strip_tags($this->request->data[$modelName]['email']));
			$this->request->data[$modelName]['message']=str_ireplace("\\\\n","<br/>",addslashes(strip_tags($this->request->data[$modelName]['message'])));

			$regex = "^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^";
			if (!preg_match($regex, $this -> request -> data[$modelName]['email'])) {
				if (!$this -> RequestHandler -> isAjax()) {
					$this -> Session -> setFlash(__('valid_email', true));
					$this -> redirect('/pages/contact_us');
					exit ;
				} else {
					// echo __('required_fields',true);
					echo 4;
					exit ;
				}

				$err = 1;
			}

			// if (!$this->Captcha->validate()) {
   //          	 if(!$this->RequestHandler->isAjax()){
	  //                   $this->Session->setFlash(__('visual_code',true),null,null,"err");
	  //                   $this->redirect('/Contacts/contact_us');
	  //                   exit;
	  //               }else{
	  //                   // echo __("visual_code",true);
	  //                   echo 1 ;
	  //                   exit;
	  //               }
	  //               $err=1;
   //          }

			if(empty($this->request->data[$modelName]['name']) || empty($this->request->data[$modelName]['email']) || $this->request->data[$modelName]['name']==__('name',true) || $this->request->data[$modelName]['email'] == __('email',true)){
					if(!$this->RequestHandler->isAjax()){
					$this->Session->setFlash(__('required_fields',true));
					$this->redirect('/'. $this->request->params['locale'] . '/DynamicPages/contact_us/');
					exit;
					}
					else {
						// echo __('required_fields',true);
						echo 2;
						exit;
					}

				$err=1;
			}

			if($err==0){
				//print_r($this->request->data);exit;

				if($this->$modelName->save($this->request->data)){

					//send emial to user
					$no_reply=Configure::read("BASE_NOREPLY_EMAIL");
					$reply_to=Configure::read("BASE_ADMIN_EMAIL");
					$email_prefix=Configure::read("EMAIL_SUBJECT_PREFIX");
					$to=$this->request->data[$modelName]["email"];

					$this->Email->from=$email_prefix."<$no_reply>";
					$this->Email->to=$to;

					$subject='';
					$lang=$this -> request -> params['lang'] ;
					if($lang == 'en'){
						$subject='Thank you for contacting us';
					}else{
						$subject="\xD8\xB4\xD9\x83\xD8\xB1\xD8\xA7\xD9\x8B\x20\xD9\x84\xD8\xA7\xD8\xAA\xD8\xB5\xD8\xA7\xD9\x84\xD9\x83\x20\xD8\xA8\xD9\x86\xD8\xA7";
					}
					$this->Email->subject = $email_prefix.' | '.$subject;
					$this->Email->sendAs = 'both';

					$this->Email->replyTo=$reply_to;
					$this->Email->template = 'thank_you_contact';
					$this->set('data',$this->request->data["Contact"]);
					$this->Email->send();

					$admin_to=Configure::read("BASE_ADMIN_EMAIL");
					$this->loadModel("DynamicPage");
					$contact_notification_email=$this->DynamicPage->find('first',array("conditions"=>array("DynamicPage.section"=>'contact'),"fields"=>array("DynamicPage.email")));
					if(!empty($contact_notification_email)){
						if( !empty($contact_notification_email["DynamicPage"]["email"])){
							$admin_to= $contact_notification_email["DynamicPage"]["email"];
						}
					}

					$this->Email->from=$email_prefix."<$no_reply>";

					$this->Email->to = $admin_to;


					$no_reply=Configure::read("BASE_NOREPLY_EMAIL");
					// $reply_to=Configure::read("BASE_ADMIN_EMAIL");
					$reply_to=$admin_to;
					$email_prefix=Configure::read("EMAIL_SUBJECT_PREFIX");

					$to=$admin_to;

					$this->Email->from=$email_prefix."<$no_reply>";
					$this->Email->to=$to;

					$this->Email->subject = $email_prefix.' | Contact Form by ('.$this->request->data[$modelName]['name'].')';
					$this->Email->sendAs = 'both';

					$this->Email->replyTo=$reply_to;
					$this->Email->template = 'contact';
					$this->set('data',$this->request->data["Contact"]);
//					$this->Email->send();
//					$this->Email->reset();

					if($this->Email->send()){
						$this->Email->reset();
						if(!$this->RequestHandler->isAjax()){
							$this->Session->setFlash('The Email was Sent successfully.', 'succ_msg');
							// $this->redirect('/Contacts/contact_us');
							$this->redirect('/'.$this->params['lang'].'/DynamicPages/contact_us/');
						}
						else {
								// echo __("email_sent",true);
								echo 3;
								exit;
							}
					}else{
						if(!$this->RequestHandler->isAjax()){
							$this->Session->setFlash(__('valid_email',true));
							$this->redirect('/Contacts/contact_us');
							exit;
						}
						else{
							// echo __('valid_email',true);
							echo 4;
							exit;
						}
					}
				}
			}
		}
	}

}
?>