<?php
App::uses('Sanitize', 'Utility');
class JobsController extends AppController{

	public $name = "Jobs";
	public $uses = array("Job");
	public $components = array("FileUpload","StringManipulation" ,"RequestHandler","Email","Captcha",);
	public $helpers = array("NumbersFormat","Paginator");
	public $modelName = "Job";
	public $controllerName = "Jobs";
	public $userFilesFolder = "applied_job";

	function beforeFilter(){
		parent::beforeFilter();

		if(empty($this->request->params["admin"])){

//			$this->layout='default';


		}else{
			$this->set("menuFlag",5);



		}
	}

	function set_page_title($section=null){
		$menuSectionId='';
		switch ($section){
			case 'jobs':{

					$page_title="Jobs";
					$page_sub_title="Jobs";
					$menuSectionId="careers";

					$menuFlag=14;
				}
				break;
			}

		$this->set("menuFlag",$menuFlag);
		$this->set("page_title",$page_title);
		$this->set("page_sub_title",$page_sub_title);
		$this->set("menuSectionId",$menuSectionId);

	}

	function admin_add(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set("controllerName",$controllerName);
		$this->set("modelName",$modelName);
		$this->set_page_title('jobs');

		if (!empty($this->request->data)){

			if(empty($this->request->data[$modelName]["title"]["eng"]) ){

					$this->Session->setFlash("Please insert data for both languages","admin/admin_succ");

			}else{

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

	}


	function admin_order_all_entries(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);

		$all_data=$this->$modelName->find("list",array( 'fields'=>array("id") ,'order'=>array("$modelName.title"=>"ASC") , 'contain'=>false));

		$index=0;
		foreach($all_data as $id){
			$query="UPDATE `themall_db`.`jobs` SET `position`=$index WHERE  `id`=$id;";
			$index++;
			$this->$modelName->query($query);
		}

		$this->Session->setFlash("Order Changed successfully for all entries","admin/admin_succ");
		$this->redirect("/admin/$controllerName/index/");
		exit;

	}


	function admin_index($list_all = 0){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set_page_title('jobs');
		$this->set('list_all',$list_all);


		$search_cond="";
		if(isset($_GET['s'])){
			$search_phrase=$_GET['s'];
			//print_r($search_phrase);exit;
			$search_phrase = Sanitize::clean($search_phrase, array('encode' => false));
			$search_cond="($modelName.title like '%$search_phrase%')";

			$this->set('search_phrase',$search_phrase);
		}


		$cond = array($search_cond );


		if ($list_all == 0){
			$this->paginate = array(
				'conditions'=>$cond,
				'fields' => array("$modelName.id","$modelName.title","$modelName.visible","$modelName.modified"),
				'limit' => 10,
				'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
			);
		}else{
			$this->paginate = array(
					'conditions'=>$cond,
				'fields' => array("$modelName.id","$modelName.title","$modelName.visible","$modelName.modified"),
				'order' => array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC'),
			);
		}
		// print_r($modelName);exit;
		$data = $this->paginate($modelName);

		$this->set('data', $data);
	}

	function admin_edit($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$this->set('modelName',$modelName);
		$this->set('controllerName',$controllerName);
		$this->set_page_title('jobs');
		$id = (int)$id;
		$this->set('id',$id);
		$get_data = $this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$id)));
		if($id==null || !is_numeric($id) || empty($get_data)){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/$controllerName/index");
			exit;
		}

		if (empty($this->request->data)){
			$this->request->data = $this->get_all_locales(array("$modelName.id"=>$id),$modelName,Configure::read('LOCALES'),array('title','text'),array());
		}
		else{
				$this->request->data[$modelName]['id'] = $id;
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

	function admin_delete($id){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;

		$id = (int)$id;
		$get_data = $this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$id)));
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

	function admin_cvs($job_id=0){
			$modelName="AppliedCv";
			$controllerName=$this->controllerName;
			$this->set("modelName",$modelName);
			$this->set("controllerName",$controllerName);
			$this->set('page_subtitle', "List Applied Cvs");
			$this->request->data["$modelName"]["job_id"]=$job_id;
			$this->set_page_title('jobs');

			$this->set("job_id",$job_id);
			$search_cond="";
			if(isset($_GET['s'])){
				$search_phrase=$_GET['s'];
				$search_cond="($modelName.full_name like '%$search_phrase%')";

				$this->set('search_phrase',$search_phrase);
			}


			// $d=$this->Job->find("first",array("condtions"=>array("Job.id"=>"general")));
			// $job_id=$d['Job']['id'];

			//get the countries list
			$this->loadModel("Country");
			$country_list=$this->Country->getList('eng');
			$this->set("country_list",$country_list);


			$cond=array("$modelName.job_id"=>$job_id,$search_cond);






			$this->paginate=array('fields' => array("$modelName.*"),
				'limit' => 10,
				'order' => array(
				"$modelName.id" => 'DESC'
				),
				"conditions"=>$cond
			);
			$this->loadModel("$modelName");
			$data = $this->paginate($modelName);
			//print_R($data);exit;

			$this->set('data', $data);
			if($job_id!=0){
				$get_job=$this->Job->find("first",array("conditions"=>array("Job.id"=>$job_id),"fields"=>array("Job.title")));
				$this->set("job_sectionTitle","List CVs for ".$get_job["Job"]["title"]);
				$this->set("job_id",$job_id);
				$this->set("jobs",$get_job);
			}else{
				$this->set("job_sectionTitle","List All CVs");
			}
	}

	function admin_delete_cv($id=null){
		$modelName="AppliedCv";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;
		$userFilesFolder=$this->userFilesFolder;
		$this->loadModel("$modelName");
		$this->set('id',$id);
			////////Validating Id////////////
			if($id==null || !is_numeric($id) || ($this->$modelName->find('count',array("conditions"=>array("$modelName.id"=>$id))))<1){
				$this->Session->setFlash("Invalid Request");
				$this->redirect("/admin/$controllerName");
				exit;
			}
			$find=$this->$modelName->find('first',array('conditions'=>array("$modelName.id"=>$id)));

				$file=$find[$modelName]['cv'];
				if(isset($file) && !empty($file)){
					if(file_exists(APP."webroot/files/$userFilesFolder/files/$file")){
						unlink(APP."webroot/files/$userFilesFolder/files/$file");
					}
				}


				if($this->$modelName->delete($id)){
					if(!($this->RequestHandler->isAjax())){
						$this->Session->setFlash("Entry deleted successfully");
						$this->redirect("/admin/cvs");
						exit;
					}
					exit;
				}else{
					if(!($this->RequestHandler->isAjax())){
						$this->Session->setFlash("An error occured, please try again");
						$this->redirect("/admin/cvs");
						exit;
					}
					echo 1;exit;
				}
	}
	function admin_delall_cvs(){
		$modelName="AppliedCv";
		$controllerName=$this->controllerName;
		$sectionName=$this->sectionName;
		$userFilesFolder=$this->userFilesFolder;
		foreach ($this->data["$model"] as $d=>$val){
			$find=$this->$modelName->find('first',array('conditions'=>array("$modelName.id"=>$id),"fields"=>array("$modelName.cv")));
			$file=$find[$modelName]['cv'];
			if(file_exists(APP."webroot/files/$userFilesFolder/$file")){
				unlink(APP."webroot/files/$userFilesFolder/$file");
			}
			$this->$modelName->id=$val;
			$this->$modelName->delete($val,true);
		}
		$this->Session->setFlash("Entries deleted successfully");
		$this->redirect("/admin/cvs");
		exit;
	}
	function admin_view($id=null){
		$modelName="AppliedCv";
		$controllerName=$this->controllerName;
		$this->set("modelName",$modelName);
		$this->set("controllerName",$controllerName);
		$this->set_page_title('jobs');
		$this->set('page_title', "View Cv");
		$this->set('id',$id);
		$locale="eng";



		$this->loadModel("JobPosition");
		$job_position=$this->JobPosition->getList($locale);
		$this->set("job_position",$job_position);


		$this->loadModel("Country");
		$country_list=$this->Country->getList('eng');
		$this->set("country_list",$country_list);


		$this->loadModel('AppliedCv');
		////////Validating Id////////////
		if($id==null || !is_numeric($id) || ($this->$modelName->find('count',array("conditions"=>array("$modelName.id"=>$id))))<1){
			$this->Session->setFlash("Invalid Request");
			$this->redirect("/admin/cvs");
			exit;
		}
		$get_data=$this->$modelName->findById($id);




		$this->request->data=$get_data;
		//get the countries list


		if(isset($this->request->data["$modelName"]['nationality_country_id']) && !empty($this->request->data["$modelName"]['nationality_country_id'])){

			$nationality_country_id=$this->request->data["$modelName"]['nationality_country_id'];
			$this->request->data["$modelName"]['nationality_country']=$country_list[$nationality_country_id];
		}

		 if(isset($this->request->data["$modelName"]['residence_country_id']) && !empty($this->request->data["$modelName"]['residence_country_id'])){

			$residence_country_id=$this->request->data["$modelName"]['residence_country_id'];
			$this->request->data["$modelName"]['residence_country']=$country_list[$residence_country_id];
		}


		$this->set("data",$get_data);
	}
	// function admin_download($id=null){
		// $modelName="AppliedCv";
		// $userFilesFolder=$this->userFilesFolder;
		// $this->loadModel("$modelName");
		// $get_data=$this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$id),"fields"=>array("$modelName.cv","$modelName.first_name","$modelName.last_name")));
		// if(!empty($get_data)){
			// $file_name=$get_data[$modelName]['cv'];
			// $target_path = APP."webroot/files/$userFilesFolder/";
//
			// $full_path = $target_path.$file_name;
//
			// $file_type=filetype($full_path);
			// $display_name=$get_data[$modelName]["first_name"]."_".$get_data[$modelName]['last_name']."_cv.";
//
			// $name1=explode(".",$file_name);
			// $ext= $name1[1];
			// $display_name=$display_name.$ext;
			// $display_name=str_ireplace(" ","",$display_name);
//
			// header('Content-Type: '.$file_type);
			// header('Content-Disposition: attachment; filename="'.$display_name.'"');
			// print file_get_contents($full_path);
			// exit;
		// }
	// }


	function admin_download($id=null , $file_type){
		$modelName="AppliedCv";
		$userFilesFolder=$this->userFilesFolder;
		$this->loadModel("$modelName");
		$get_data=$this->$modelName->find("first",array("conditions"=>array("$modelName.id"=>$id),"fields"=>array("$modelName.*")));
		if(!empty($get_data)){
			$file_name=$get_data[$modelName]["$file_type"];

			if($file_type == 'cv' || $file_type == 'portfolio'){
				$target_path = APP."webroot/files/$userFilesFolder/files/";
			}else{
				$target_path = APP."webroot/files/$userFilesFolder/";
			}


			$full_path = $target_path.$file_name;

			$file_type=filetype($full_path);

			//$display_name=$get_data[$modelName]["name"].".";

			$name1=explode(".",$file_name);
			$ext= $name1[1];
			$display_name=$name1[0].".".$ext;
			$display_name=str_ireplace(" ","",$display_name);


			header('Content-Type: '.$file_type);
			header('Content-Disposition: attachment; filename="'.$display_name.'"');
			print file_get_contents($full_path);
			exit;
		}
	}


	//////////////////////// end of admin interface  		//////////////////////////////////


	function index(){
		$controllerName = $this->controllerName;
		$modelName = $this->modelName;
		$SeoManagement="SeoManagement";
		$locale = $this->request->params['locale'];
		$lang = $this->request->params['lang'];

		if($this->RequestHandler->isAjax()){
			// $this->layout = "default_ajax";
			$this->layout = "ajax";
		}
		else{
			$this->layout = "default";
		}


		$this->loadModel("DynamicPage");
		$data=$this->DynamicPage->getJobDetails($locale);
		$seoData['SeoManagement']=$data['SeoManagement'];
		//print_r($data);exit;

		$section='job';
		//get background
		// $this->loadModel("Background");
		// $back_ground=$this->Background->getSectionBackgrounds('DynamicPage',$section);


		$jobs = $this->$modelName->getAllJobs($locale);

		// /print_r($jobs);exit;
		$this->set(compact("jobs","data","back_ground","modelName","seoData"));


	}


	function get_image_resizes($section="general" , $side=null){
		$userFilesFolder=$this->userFilesFolder;
		switch ($section){





			case "home":
				$thumbWidth = "198";
				$thumbHeight = "198";

				$resizes = array(
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/thumb","width"=>$thumbWidth,"height"=>$thumbHeight,'force'=>false),
								array('folder'=>WWW_ROOT."/files/$userFilesFolder/preview","width"=>$previewWidth,"height"=>$previewHeight,'force'=>false),
							);
				break;
		}

	}


	 function EncodeMime($Text, $Delimiter)
	{
	    $Text = utf8_decode($Text);
	    $Len  = strlen($Text);
	    $Out  = "";
	    for ($i=0; $i<$Len; $i++)
	    {
	        $Chr = substr($Text, $i, 1);
	        $Asc = ord($Chr);

	        if ($Asc > 0x255) // Unicode not allowed
	        {
	            $Out .= "?";
	        }
	        else if ($Chr == " " || $Chr == $Delimiter || $Asc > 127)
	        {
	            $Out .= $Delimiter . strtoupper(bin2hex($Chr));
	        }
	        else $Out .= $Chr;
	    }
	    return $Out;
	}



	function upload_cv(){
		// debug($this->request->data);die;
		$modelName="AppliedCv";
		$userFilesFolder=$this->userFilesFolder;
		$this->loadModel($modelName);
		$locale=$this->params['locale'];
		if(!empty($this->request->data)){

			$job_id=0;
			if(isset($this->request->data[$modelName]['job_id'])){
				$job_id=$this->request->data[$modelName]['job_id'];

				$job_details=$this->Job->find("first",array("conditions"=>array("Job.id"=>$job_id)));
			}


			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));


			// $tele=$this->request->data['AppliedCv']['phone'];
			// if($locale == 'eng'){
				// $default_phone='Telephone';
			// }else{
				// $default_phone="\xD8\xA7\xD9\x84\xD9\x87\xD8\xA7\xD8\xAA\xD9\x81";
			// }
//
			// if($default_phone == $tele){
				// $this->request->data['AppliedCv']['phone']='';
			// }


			$err=0;
			if (!$this->Captcha->validate()) {
				if(!$this->RequestHandler->isAjax()){
	                    $this->Session->setFlash(__('Please enter the correct visual code',true),null,null,"err");
	                    $this->redirect('/jobs/');
	                    exit;
	                }else{
	                    // echo __('Please enter the correct visual code',true);
	                    echo "1";
	                    exit;
	                }
	                $err=1;
			}
			if(empty($this->request->data["$modelName"]["email"])){
				if(!$this->RequestHandler->isAjax()){
					$this->set("errorMsg","Please insert a valid email");
				}else{
					//$this->Session->setFlash('Please fill all required fields',null,null,'err');
					echo "2";exit;
					$this->redirect('/jobs');
				}
				$err=1;
			}

			/////	cv 		/////////



			if(isset($this->request->data[$modelName]["cv"]) && !empty($this->request->data[$modelName]["cv"])){

				$allowedExts = array("pdf", "doc", "docx");
				$extension = end(explode(".", $this->request->data[$modelName]["cv"]["name"]));
				if(!in_array($extension, $allowedExts)){
					echo 5;exit;
				}

				$retArray=$this->FileUpload->uploadFile($this->request->data[$modelName]["cv"],WWW_ROOT."/files/$userFilesFolder/files",'file',array('randomName'=>false,"extensions"=>"doc,docx,pdf"));

// echo 'before save';
				// debug($retArray);exit;
				if(!$retArray['error'])
				$this->request->data[$modelName]['cv']=$retArray['fileName'];
				else{
					$this->request->data[$modelName]['cv']="";
					$fileError=$retArray['errorMsg'];
					$this->Session->setFlash($fileError,null,null,'err');
					$this->redirect('/jobs');
					//              $this->set("errorMsg",$fileError);
					$err=1;
				}
			}

			if($err==0){

				$this->$modelName->create();
				//
				if($this->$modelName->save($this->request->data[$modelName])){
					// debug($this->$modelName->id);exit;

					//send emial to user
					$no_reply=Configure::read("BASE_NOREPLY_EMAIL");
					$reply_to=Configure::read("BASE_ADMIN_EMAIL");
					$email_prefix=Configure::read("EMAIL_SUBJECT_PREFIX");
					$to=$this->request->data[$modelName]["email"];



					$this->Email->from=$email_prefix."<$no_reply>";


					$this->Email->to=$to;


					$subject='';
					// $lang=$this -> request -> params['lang'] ;
					// if($lang == 'en'){
						$new_subject='Thank you for applying';


						$this->Email->subject = $new_subject;

						$this->Email->sendAs = 'both';

						$this->Email->replyTo=$reply_to;
						$this->Email->template = 'job_thank_you';

						$this->Email->send();
						$this->Email->reset();




					////////////////////






					$id=$this->$modelName->id;
					$this->request->data[$modelName]['id']=$id;

					$no_reply=Configure::read("BASE_NOREPLY_EMAIL");
					$reply_to=Configure::read("BASE_ADMIN_EMAIL");
					$email_prefix=Configure::read("EMAIL_SUBJECT_PREFIX");
					//$to=Configure::read("BASE_ADMIN_EMAIL");
					$admin_to=Configure::read("BASE_ADMIN_EMAIL");

					$this->loadModel("DynamicPage");
					$job_notification_email=$this->DynamicPage->find('first',array("conditions"=>array("DynamicPage.section"=>'careers'),"fields"=>array("DynamicPage.email")));
					if(!empty($job_notification_email)){
						if( !empty($job_notification_email["DynamicPage"]["email"])){
							$admin_to= $job_notification_email["DynamicPage"]["email"];
						}
					}

					$this->Email->from=$email_prefix."<$no_reply>";

					$this->Email->to = $admin_to;
					$this->Email->filePaths  = array(WWW_ROOT."/files/$userFilesFolder/");
					//$this->Email->attachments=array($this->request->data[$modelName]['first_name'].$this->request->data[$modelName]['last_name']."_cv.$file_extension"=>$this->request->data[$modelName]['cv']);

					$this->Email->subject = $email_prefix.' | New Job Form by ('.$this->data[$modelName]['first_name']." ".$this->data[$modelName]['last_name'].')';
					$this->Email->sendAs = 'both';

					$this->request->data['job_details']= $job_details['Job'];


					$this->Email->replyTo=$reply_to;
					$this->Email->template = 'job_submitted';
					$this->set('data',$this->request->data);
					$this->Email->send();
					$this->Email->reset();


				}
				else{
					print "An error occured!";exit;
				}

				if(!$this->RequestHandler->isAjax()){
					$this->Session->setFlash('Your job application is well received. Thank you.',null,null,'succ');
					$this->redirect('/jobs');
					exit;
				}else{
					//$this->Session->setFlash('Please fill all required fields',null,null,'err');
					echo "3";exit;
					$this->redirect('/jobs');
				}
				//print_R($this->request->data);exit;
			}
			else{


				if(!$this->RequestHandler->isAjax()){
					$this->Session->setFlash('An error occured while submitting the form. Please try again.',null,null,'err');
					$this->redirect('/jobs');
					exit;
				}else{
					//$this->Session->setFlash('Please fill all required fields',null,null,'err');
					echo "4";exit;
					$this->redirect('/jobs');
				}
			}
		}
	}
}
?>
