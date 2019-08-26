<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');


/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */



class PagesController extends AppController {

	public $name = 'Pages';
	public $uses = array("DynamicPage");
	var $components = array('Cookie',"MailChimp" /*, "Captcha"*/);


	function beforefilter(){

		parent::beforefilter();
		if($this->action == 'display'){
			// print_r('test');exit;


		}
	}
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */




	public function display($langParam="") {
		$this->layout="home";
		if($langParam != ""){
	 		if($langParam == "en" || $langParam == "ar"){
		 		$lang = $langParam;
		 		$this->set_locale($lang);
	 		}
	 	}
	 	if($this->here == "/"){
	 		$locale = $this->request->params["locale"];
	 		$lang = $this->request->params["lang"];
	 	}

		$locale=$this->params['locale'];


		//get home banner
		$this->loadModel("Banner");
		$home_banners=$this->Banner->get_home_banners($locale);
		$this->set("home_banners",$home_banners);
		//print_r($home_banners);exit;



		//get the our business categories
		$this->loadModel("DynamicPage");
		$home_our_business=$this->DynamicPage->get_home_our_business($locale);
		$this->set("home_our_business",$home_our_business);



		//home other right category
		$home_other_category=$this->Banner->get_home_other_category($locale);
		$this->set("home_other_category",$home_other_category);



		//get home latest news
		$home_latest_news=$this->DynamicPage->get_home_latest_news($locale);
		$this->set("home_latest_news",$home_latest_news);


		//home middle banners
		$home_middle_banners=$this->Banner->get_home_middle_banner($locale);
		$this->set("home_middle_banners",$home_middle_banners);


	}


	function home($langParam=""){
		//
		//print_r($langParam);exit;
		if($langParam != ""){
	 		if($langParam == "en" || $langParam == "ar"){
		 		$lang = $langParam;
		 		$this->set_locale($lang);
	 		}

	 	}

	 	if($this->here == "/home"){

	 		$locale = $this->request->params["locale"];
	 		$lang = $this->request->params["lang"];
	 		$this->redirect("/$lang/home");
	 		exit;
	 	}

		$locale=$this->params['locale'];

	}

	// function search_content(){
		// $controllerName = $this->controllerName;
		// $modelName = $this->modelName;
//
//
		// $locale = $this->params["locale"];
		// $lang = $this->request->params["lang"];
//
		// $this->$modelName->locale=$locale;
		// $this->set('locale',$locale);
		// $this->set('lang',$lang);
	// }
//




	function __buildSearchWhereClause($keyword,$fieldArray,$style='exact',$conj='OR',$segment=true,$staticWhere=''){
		switch ($style){
			case 'exact':
			$wildCardStart="";
			$wildCardEnd="";
			break;
			case 'start':
			$wildCardStart="";
			$wildCardEnd="*";
			break;
			case 'partial':
			$wildCardStart="*";
			$wildCardEnd="*";
			break;
			default:
			$wildCardStart="";
			$wildCardEnd="";
			break;
		}

		$clause="";

			$clause.="(";
			foreach ($fieldArray as $fieldExt){

				$fieldExplode=explode("|",$fieldExt);
				if(is_array($fieldArray)){
					$tableName=$fieldExplode[0];
					$fieldName=$fieldExplode[1];
					$field="$tableName.$fieldName";
				}
				else{
					$field="$fieldExt";
				}

				if($clause!="(")
					$clause.=" $conj ";
				$clause.="match($field) against ('$wildCardStart$keyword$wildCardEnd' IN BOOLEAN MODE )";



			}


			$clause.=")";

		if(!empty($staticWhere)){
			$clause="($clause) $staticWhere";
		}


		return $clause;
	}



	function getPageNumber($id, $rowsPerPage  ,$category_id , $section_id) {
	 	$controllerName = $this->controllerName;
		$modelName = "Shop";
		$this->loadModel($modelName);




		//$cuurent_date=date("Y")."-01-01";
		$order =array("$modelName.position" => 'ASC',"$modelName.id" => 'DESC');
		if($category_id == 0){

			$cond=array("$modelName.section_id"=>$section_id);

		}else{
			$cond=array("Shop.visible"=>1,"$modelName.category_id"=>$category_id , "$modelName.section_id"=>$section_id);

		}


		//print_r($cond);exit;
	    $result = $this->$modelName->find('list',array('order'=>$order,'conditions'=>$cond)); // id => name
	 	//print_r($result);exit;

	    $resultIDs = array_keys($result); // position - 1 => id

	    $resultPositions = array_flip($resultIDs); // id => position - 1

	  //  print_r($resultPositions);exit;
	    $position = $resultPositions[$id] + 1; // Find the row number of the record

	    $page = ceil($position / $rowsPerPage); // Find the page of that row number

	    return $page;
	  }

	function shop_search($search_text=0){
		$locale = $this->params["locale"];
		$lang = $this->request->params["lang"];

		$is_search_by_alpha = 0;
		$this->set("is_search_by_alpha",$is_search_by_alpha);

		$is_ajax=false;
		if($this->RequestHandler->isAjax()){
			$is_ajax=true;
		}
		$is_search_by_alpha=0;

		$search_by_category=0;

		$modelName='Shop';
		$this->loadModel("$modelName");


		//print_R($this->request->data);exit;


		if(isset($this->request->data) && !empty($this->request->data)){
			$search_by_category=1;
			$locale = $this->params["locale"];

			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));


			$search_text='';
			$search_text=$this->request->data['Page']['search_text'];
			$selection=$this->request->data['Page']['store_category_id'];

			$type='';
			$value='';
			if(!empty($selection)){
				$selection=split("_", $selection);


				$type=$selection[0];
				$value=$selection[1];
			}



			$search_cond='';
			if(isset($search_text) && !empty($search_text)){

				//$search_cond="($modelName.title like '%$search_text%' or $modelName.text like '%$search_text%')";
				$search_cond=$this->__buildSearchWhereClause($search_text,array("I18n__title|content","I18n__text|content"));

			}

			//print_R($search_cond);exit;
			$category_name='';
			$category_id=0;
			if($type == 's'){ //section
				$cond = array("$modelName.section_id"=>$value , $search_cond);
				$selected_category_id=$value;
			}
			elseif($type == 'c'){ //category
				$cond = array("$modelName.category_id"=>$value , "$modelName.visible"=>1  ,$search_cond );
				$this->loadModel("Category");
				$selected_category_id=$value;

				$category_name=$this->Category->find("first",array("conditions"=>array("Category.id"=>$value),'contain'=>false , 'fields'=>array("Category.title")));

				$category_name=$category_name['Category']['title'];
			}else{
				$cond = array($search_cond);
			}



			$fields = array("$modelName.id","$modelName.title", "$modelName.text","$modelName.section_id" ,"$modelName.category_id");
			$this->$modelName->locale=$locale;

			//print_r($cond);exit;
			$shops_l=$this->Shop->find('all' , array('conditions'=>$cond   , 'contain'=>false ,'fields'=>array("Shop.id", "Shop.title" ,"Shop.text") ));
			$shop_ids=array();
			foreach($shops_l as $s){
				$s_id=$s['Shop']['id'];
				array_push($shop_ids ,  $s_id);
			}
			$shop_ids=implode(',', $shop_ids);



			if(!empty($shop_ids)){
			$this->paginate = array(
				'fields' => $fields,
				'limit' => 50,

				'order' => array("$modelName.title" => 'ASC'),
				'conditions' => array("Shop.id IN ($shop_ids)" , "Shop.visible"=>1),
				'contain'=>false
			);

			$data = $this->paginate($modelName);
			}else{
				$data='';
			}
			//print_R($data);exit;

			if(!empty($data)){
				foreach($data as $key=>$d){
					$section_id=$d['Shop']['section_id'];
					$category_id=$d['Shop']['category_id'];
					$shop_id=$d['Shop']['id'];



					if($section_id == 3){
						$page_number=$this->getPageNumber($shop_id, 9  ,$category_id , $section_id);
						$url="/$lang/Sections/entertain/page:$page_number?shop_id=$shop_id";
						$data["$key"]['Shop']['url']=$url;
					}else{
						$page_number=$this->getPageNumber($shop_id, 9  ,$category_id , $section_id);
						$url="/$lang/Sections/index/$category_id/page:$page_number?shop_id=$shop_id";
						$data["$key"]['Shop']['url']=$url;
					}

				}
			}

			//print_R($selected_category_id);exit;

			// entertain shop url , $url="/$lang/Sections/entertain/?shop_id=$shop_id";
			// other shop url $url="/$lang/Sections/index/$category_id/?shop_id=$shop_id";
			$this->set(compact('search_text','data','category_name' ,'selected_category_id','type'));

		}elseif( $search_text != '0'){
			//print_R($search_text);exit;
			$is_search_by_alpha=1;
			$this->set("is_search_by_alpha",$is_search_by_alpha);
			$search_cond='';
			$shop_ids=array();
			if(isset($search_text) && !empty($search_text)){
				//$search_cond="($modelName.title like '$search_text%')";

				$search_cond=$this->__buildSearchWhereClause($search_text,array("I18n__title|content") , "start");
			}

			if($search_text == 1){
				$search_cond='';
			}else{
				$this->$modelName->locale=$locale;
				//print_R($search_cond);exit;

				$shops_l=$this->Shop->find('all' , array('conditions'=>array($search_cond) , 'fields'=>array("Shop.id" , 'Shop.title')   ));
				//print_R($shops_l);exit;

				if(!empty($shops_l)){
					foreach($shops_l as $s){
						$s_id=$s['Shop']['id'];
						array_push($shop_ids ,  $s_id);
					}
					$shop_ids=implode(',', $shop_ids);
				}
				//print_R($shop_ids);exit;
			}


			$this->$modelName->locale=$locale;
			if(empty($shop_ids)){
				$cond = array("$modelName.visible"=>1 ,"Shop.id"=>0  );
			}else{
				$cond = array("$modelName.visible"=>1 ,"Shop.id IN ($shop_ids)" );
			}

			if($search_text ==1 ){
				$cond = array("$modelName.visible"=>1  );
			}



			$fields = array("$modelName.id","$modelName.title", "$modelName.text","$modelName.section_id" ,"$modelName.category_id");

			$this->paginate = array(
				'fields' => $fields,
				'limit' => 50,
				'order' => array("$modelName.title" => 'ASC'),
				'conditions' => $cond,
				'contain'=>false
			);

			$data = $this->paginate($modelName);

			if(!empty($data)){
				foreach($data as $key=>$d){
					$section_id=$d['Shop']['section_id'];
					$category_id=$d['Shop']['category_id'];
					$shop_id=$d['Shop']['id'];
					if($section_id == 3){
						$page_number=$this->getPageNumber($shop_id, 9  ,$category_id , $section_id);
						$url="/$lang/Sections/entertain/page:$page_number?shop_id=$shop_id";
						$data["$key"]['Shop']['url']=$url;
					}else{
						$page_number=$this->getPageNumber($shop_id, 9  ,$category_id , $section_id);
						$url="/$lang/Sections/index/$category_id/page:$page_number?shop_id=$shop_id";
						$data["$key"]['Shop']['url']=$url;
					}
				}
			}
			$this->set(compact('search_text','data'));
		}

		//print_r($data);exit;
		$this->set(compact("search_by_category" ,'is_ajax'));
	}



	public function search(){
		$locale = $this->params["locale"];
		$is_search_by_alpha = 1;
		$lang = $this->request->params["lang"];

		$this->set("is_search_by_alpha",$is_search_by_alpha);

		if(isset($this->request->data) && !empty($this->request->data)){
			$locale = $this->params["locale"];

			$no_text=0;
			$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));

			$search_text=$this->request->data['Page']['search_text'];
			$this->set("search_text",$search_text);

			$searchable_models = array(
				0=>array("modelName"=>"Section","fields"=>array("title","internal_title","text_1")),
				1=>array("modelName"=>"Job","fields"=>array("title","text")),
				2=>array("modelName"=>"Service","fields"=>array("title","text")),
				3=>array("modelName"=>"Category","fields"=>array("title")),
				4=>array("modelName"=>"Shop","fields"=>array("title",'text'))

			);




			if(empty($this->request->data['Page']["search_text"])){
				$no_text=1;
			}




			//print_R($searchable_models);exit;

			if($no_text == 0){
				foreach ($searchable_models as $model){
					$modelName = $model["modelName"];
					$this->loadModel("$modelName");
					$this->$modelName->locale = $locale;
					$full_text_condition = "MATCH(";
					$fields_count = 0;
					$fields_max = count($model["fields"]);
					$fields_string = array();
					foreach ($model["fields"] as $field){
						$fields_count++;
	//					$fields_string .= "$modelName.$field";
						array_push($fields_string , "I18n__$field|content" );
						//$fields_string = "I18n__$field|content";


						//if($fields_count != $fields_max) $fields_string .= ",";
					}

					//$fields_string .= ", $modelName.section";

					//$fields_string=implode(',', $fields_string);
					//print_R($fields_string);exit;

					if(!empty($this->request->data['Page']["search_text"])){
						//$full_text_condition .= $fields_string;

						$full_text_condition=$this->__buildSearchWhereClause($this->request->data['Page']["search_text"],$fields_string);

						//$full_text_condition .= ")AGAINST('{$this->request->data['Page']["search_text"]}' IN BOOLEAN MODE)";
						//$fields_string .= ", $modelName.id";
					}else{
						$full_text_condition='';
					}

					//print_r($full_text_condition);exit;


					//print_R($full_text_condition);exit;
					$contain = array('SeoManagement'=>array('fields'=>array("id","slug")));
					$contain = $this->$modelName->generateContainableTranslations($modelName,$contain,$locale);


					///////	sections
					if( $modelName =="Section" ){
						$cond=array(
						"$modelName.section IN ('overview' , 'get_here' , 'opening_hours' , 'articles', 'videos' , 'contact' , 'terms_conditions' ,'privacy' )",
						    $full_text_condition,"$modelName.visible"=>1 , "$modelName.section_id > 0");

						$model_result["$modelName"] = $this->$modelName->find("all",array("conditions"=>$cond ,
						"order"=>array("position"=>"ASC"),"recursive"=>0,
						"fields"=>array("$modelName.id","$modelName.section" ,"$modelName.section_id","$modelName.title","$modelName.internal_title" ,"$modelName.text_1","$modelName.text_2" ,"$modelName.text_3")
						,"contain"=>$contain
						));




						$f=Array('0' => 'I18n__title|content','1' => 'I18n__internal_title|content');

						$search_text_new='';
						if($locale == 'eng'){
							$search_text=$this->request->data['Page']["search_text"];

							$Vacancies='vacancies';
							$cv='Upload your CV';

							if($search_text == $Vacancies){
								$search_text_new='careers';
							}elseif($search_text == $cv){
								$search_text_new='careers';
							}else{
								$search_text_new=$search_text;
							}

						}else{
							$search_text=$this->request->data['Page']["search_text"];

							$Vacancies="\xD8\xA7\xD9\x84\xD9\x88\xD8\xB8\xD8\xA7\xD8\xA6\xD9\x81";
							$cv="\xD8\xAA\xD8\xAD\xD9\x85\xD9\x8A\xD9\x84\x20\xD8\xB3\xD9\x8A\xD8\xB1\xD8\xAA\xD9\x83\x20\xD8\xA7\xD9\x84\xD8\xB0\xD8\xA7\xD8\xAA\xD9\x8A\xD8\xA9";

							if($search_text == $Vacancies){
								$search_text_new=$Vacancies;
							}elseif($search_text == $cv){
								$search_text_new=$Vacancies;
							}else{
								$search_text_new=$search_text;
							}



						}

						$full_text_condition=$this->__buildSearchWhereClause($search_text_new,$f);
						$sections=array('shop','dine','entertain','overview','opening_hours','articles','videos','services','get_here','store_locator','careers'
						,'sitemap','contact','terms_conditions','privacy');




						$cond=array(
						"$modelName.section IN ('shop','dine','entertain','overview','careers' ,'opening_hours','articles','videos','services','get_here','store_locator','sitemap','contact','terms_conditions','privacy')",
						    $full_text_condition,"$modelName.visible"=>1 ,"$modelName.section_id"=>0 );


						//print_r($cond);exit;



						$model_result["main_sections"] = $this->$modelName->find("all",array("conditions"=>$cond ,
						"order"=>array("position"=>"ASC"),"recursive"=>0,
						"fields"=>array("$modelName.id","$modelName.section" ,"$modelName.section_id","$modelName.title","$modelName.internal_title" ,"$modelName.text_1","$modelName.text_2" ,"$modelName.text_3")
						,"contain"=>$contain
						));

					}


					///////	jobs
					if( $modelName =="Job"){

						$cond=array($full_text_condition,"$modelName.visible"=>1);
						$model_result["$modelName"] = $this->$modelName->find("all",array("conditions"=>$cond ,
						"order"=>array("position"=>"ASC"),"recursive"=>0,
						"fields"=>array("$modelName.id","$modelName.title" ,"$modelName.text")
						,"contain"=>false
						));


						//print_r($model_result);exit;
					}


					///////	services
					if( $modelName =="Service"){

						$cond=array($full_text_condition,"$modelName.visible"=>1);
						//print_r($cond);exit;
						$model_result["$modelName"] = $this->$modelName->find("all",array("conditions"=>$cond ,
						"order"=>array("position"=>"ASC"),"recursive"=>0,
						"fields"=>array("$modelName.id","$modelName.title" ,"$modelName.text")
						,"contain"=>false
						));

						//print_r($model_result);exit;
					}


					///////	category
					if( $modelName =="Category"){

						$cond=array($full_text_condition,"$modelName.visible"=>1);
						//print_r($cond);exit;
						$model_result["$modelName"] = $this->$modelName->find("all",array("conditions"=>$cond ,
						"order"=>array("position"=>"ASC"),"recursive"=>0,
						"fields"=>array("$modelName.id","$modelName.title" )
						,"contain"=>false
						));

						//print_r($model_result);exit;
					}


					if( $modelName =="Shop" ){


						$cond=array('AND'=>array($full_text_condition,"$modelName.visible"=>1 ));

						//print_R($cond);exit;
						$d = $this->$modelName->find("all",array("conditions"=>$cond ,
						"order"=>array("$modelName.title"=>"ASC"),"recursive"=>0,
						"fields"=>array("$modelName.id","$modelName.category_id","$modelName.section_id","$modelName.title" ,"$modelName.text")
						,"contain"=>$contain
						));

						//print_R($d);exit;
						foreach($d as $key=>$cont){
							$section_id=$cont['Shop']['section_id'];
							$category_id=$cont['Shop']['category_id'];
							$shop_id=$cont['Shop']['id'];



							if($section_id == 3){
								$page_number=$this->getPageNumber($shop_id, 9  ,$category_id , $section_id);
								$url="/$lang/Sections/entertain/page:$page_number?shop_id=$shop_id";
								$d["$key"]['Shop']['url']=$url;
							}else{
								$page_number=$this->getPageNumber($shop_id, 9  ,$category_id , $section_id);
								$url="/$lang/Sections/index/$category_id/page:$page_number?shop_id=$shop_id";
								$d["$key"]['Shop']['url']=$url;
							}

						}

						$model_result["$modelName"]=$d;
						//$page_number=$this->getPageNumber($shop_id, 9  ,$category_id , $section_id);


					}

				}


			}else{
				$model_result='';

			}


			//print_r($model_result);exit;
			$this->set("search_result",$model_result);
			$this->set("searchable_models",$searchable_models);
			$this->set("keyword",$this->request->data['Page']["search_text"]);

		}
		else {

			$this->redirect("/");
		}
	}


private function __checkRecaptchaResponse($response){
        // verifying the response is done through a request to this URL
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        // The API request has three parameters (last one is optional)
        $data = array('secret' => Configure::read('recaptchaSecretKey'),
            'response' => $response,
            'remoteip' => $_SERVER['REMOTE_ADDR']);

        $http = new HttpSocket();
        $var = $http->post($url, $data);

        $var = json_decode($var['body']);
        return $var->success;
    }

	function register_newsletter(){
		$modelName="Newsletter";
		$apikey = Configure::read("MailChimp_API_Key");
		$listId = Configure::read("MailChimp_List_Id");



		/////////////////// save newsletter
		// $host=Configure::read('NEWSLETTER_URL');	////////without http
		// $port=80;
		// $path=Configure::read('NEWSLETTER_REGISTRATION_PATH');////////the action name and parameters
		// //$str contains the variables that sould be passed to the newsletter
	    // $str = urlencode("fname").'='.urlencode($this->request->data["newsletter"]['name']).'&';
		// $str = urlencode("email").'='.urlencode($this->request->data["newsletter"]['email']).'&';
		// $str .= urlencode("type").'=0&';
		// $str .= urlencode("redirectback").'='.Configure::read('WEBSITE_LOCATION');



		$this->request->data = Sanitize::clean($this->request->data, array('encode' => false));


		// if (!$this->Captcha->validate()) {
  //       	 if(!$this->RequestHandler->isAjax()){
  //                   $this->Session->setFlash(__('visual_code',true),null,null,"err");
  //                   $this->redirect('/Contacts/contact_us');
  //                   exit;
  //               }else{
  //                   // echo __("visual_code",true);
  //                   echo 5 ;
  //                   exit;
  //               }
  //               $err=1;
  //       }
		if(! $this->__checkRecaptchaResponse($this->request->data['g-recaptcha-response'])){
			echo 0;
                // $this->Session->setFlash(__('visual_code',true),null,null,"err");
                // $this->redirect('/');
                exit;
		}



		//print_r($this->request->data);exit;

		$api = $this->MailChimp->MCAPI($apikey);


		$userEmail = $this->request->data["newsletter"]['email'];

		//if($this->request->data[$modelName]['subscribe'] == 1){

			$merge_vars = array(
					'FNAME'=>$this->request->data["newsletter"]['name']
					//'LNAME'=>$this->request->data[$modelName]['lname']
			 );


			// By default this sends a confirmation email - you will not see new members
			// until the link contained in it is clicked!
			$retval = $this->MailChimp->listSubscribe( $listId, $userEmail, $merge_vars );



			//print_R($this->MailChimp->errorCode);exit;
			if ($this->MailChimp->errorCode){
				//print_R($api->errorCode);exit;
				//print_r($this->MailChimp->errorCode);exit;
				//echo __("newsletter_msg_2",true);

				//if()
				$error_code=$this->MailChimp->errorCode;
				//print_R($error_code);exit;
				if($error_code == 214){
					echo 2;exit;
				}elseif($error_code == 502){
					echo 1;exit;
				}

				// echo "Unable to load listSubscribe()!\n";
				// echo "\tCode=".$api->errorCode."\n";
				// echo "\tMsg=".$api->errorMessage."\n";
			} else {
			    //echo __("newsletter_msg_10",true);
				echo 10;exit;

			exit;
		}


		//$fp = fsockopen($host,$port);

		// if(!$fp){
			// die($_err.$errstr.$errno);
			// echo "An error occured, please try again later.";exit;
			// $err=1;
		// }else {
			// fputs($fp, "POST $path HTTP/1.1\r\n");
			// fputs($fp, "Host: $host\r\n");
			// fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
			// fputs($fp, "Content-length: ".strlen($str)."\r\n");
			// fputs($fp, "Connection: close\r\n\r\n");
			// fputs($fp, $str."\r\n\r\n");


			// $d='';
			// while(!feof($fp)){
				// $d .= fgets($fp,4096);
			// }
//
			// $matchArray=explode("newsletter_msg=2",$d);
			// if(sizeof($matchArray)>1){
				// echo __('email_exists',true);exit;
				// $err=1;
			// }else{
				// echo __('email_saved',true);;exit;
			// }
			/////////////////// save newsletter   ////////////////////

		//}
		exit;
	}








//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 	//////////////////////////////////////////////////////  			 Mobile API 		//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




	///// home header comunication banners
	// function home_banners($section='header'){
		// //header , mobile_banners
		// $locale=$this->params['locale'];
		// if($section == 'header'){
//
//
			// $this->loadModel("Banner");
			// $banners=$this->Banner->getHeaderCommunicationBanners($section,$locale);
//
			// $data='';
			// if(!empty($banners)){
				// $index=0;
				// foreach($banners as $d){
					// $id=$d['Banner']['id'];
					// $image=$d['Banner']['image'];
					// $url_1=$d['Banner']['url_1'];
					// $title=$d['Banner']['title'];
					// $text=$d['Banner']['text'];
//
//
					// $pattern="/\/app\/webroot/";
					// $root=Configure::read('WEBSITE_URL');
					// $replacement="$root";
//
					// $text=preg_replace($pattern,$replacement, $text);
					// $text= html_entity_decode(($text), ENT_QUOTES, 'UTF-8');
//
					// $title=preg_replace($pattern,$replacement, $title);
					// $title= html_entity_decode(($title), ENT_QUOTES, 'UTF-8');
//
//
//
					// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
//
					// $preview=$WEBSITE_URL."/files/banners/preview/$image";
					// $original=$WEBSITE_URL."/files/banners/original/$image";
//
					// $temp_data['image']['758x405']=$preview;
					// $temp_data['image']['original']=$original;
//
//
					// $data["$index"]['id']=$id;
					// $data["$index"]['url']=$url_1;
					// $data["$index"]['title']=$title;
					// $data["$index"]['text']=$text;
					// $data["$index"]['image']=$temp_data['image'];
//
//
					// $index++;
				// }
				// }
			// }else{
//
				// $this->loadModel("Banner");
				// $banners=$this->Banner->getMobileBanners($locale);
//
//
				// $data='';
				// if(!empty($banners)){
					// $index=0;
					// foreach($banners as $d){
						// $id=$d['Banner']['id'];
						// $image=$d['Banner']['image'];
						// $title=$d['Banner']['title'];
						// $type=$d['Banner']['type'];
						// $shop_main_category=$d['Banner']['shop_main_category'];
						// $shop_sub_category=$d['Banner']['shop_sub_category'];
						// $shop_id=$d['Banner']['shop_id'];
//
						// if($type == 1){
							// $type='Dynamic';
						// }else{
							// $type='Static';
						// }
//
//
						// $pattern="/\/app\/webroot/";
						// $root=Configure::read('WEBSITE_URL');
						// $replacement="$root";
//
						// $title=preg_replace($pattern,$replacement, $title);
						// $title= html_entity_decode(($title), ENT_QUOTES, 'UTF-8');
//
						// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
//
						// $preview=$WEBSITE_URL."/files/banners/preview/$image";
						// $original=$WEBSITE_URL."/files/banners/original/$image";
//
						// $temp_data['image']['540x540']=$preview;
						// $temp_data['image']['original']=$original;
//
//
						// $data["$index"]['id']=$id;
//
						// $data["$index"]['title']=$title;
						// $data["$index"]['type']=$type;
						// $data["$index"]['shop_main_category']=$shop_main_category;
						// $data["$index"]['shop_sub_category']=$shop_sub_category;
						// $data["$index"]['shop_id']=$shop_id;
//
						// $data["$index"]['image']=$temp_data['image'];
//
//
						// $index++;
					// }
					// }
			// }
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($data)));exit;
//
//
	// }
//
//
//
//
	// //get list of branchs
	// function get_branch_list(){
//
		// $this->loadModel("Branch");
		// $locale=$this->params['locale'];
		// $branch_list=$this->Branch->getBranches($locale);
//
		// $index=0;
		// foreach($branch_list as $branch_id=>$branch){
			// $data["$index"]['id']=$branch_id;
			// $data["$index"]['title']=$branch;
			// $index++;
		// }
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($data)));exit;
//
	// }
//
	// //get the main category , or sub categories details with filter
	// function get_categories($section_id =0 ){
//
		// $locale=$this->params['locale'];
		// $this->loadModel("Section");
		// $this->loadModel("Category");
		// $this->loadModel("Filter");
//
		// if($section_id == 0 ){
//
			// $data=$this->Section->find("all", array("conditions"=>array("Section.section IN ('shopping','cafes_and_restaurants','entertainment')") , 'contain'=>false));
			// $index=0;
			// foreach($data as $n){
//
				// $id=$n['Section']['id'];
				// $title=$n['Section']['internal_title'];
//
				// $temp_data[$index]['id']=$id;
				// $temp_data[$index]['title']=$title;
				// $index++;
			// }
//
//
		// }elseif($section_id > 0){
//
//
			// $data=$this->Category->GetCategoryListOfSelectedSection($section_id , $locale);
//
			// $index=0;
			// foreach($data as $n){
//
				// $category_id=$n['Category']['id'];
//
//
//
//
				// $id=$n['Category']['id'];
				// $title=$n['Category']['title'];
//
				// $temp_data[$index]['id']=$id;
				// $temp_data[$index]['title']=$title;
				// $temp_data[$index]['section_id']=$section_id;
				// $temp_data[$index]['parent_id']=0;
//
//
				// $index++;
				// $filter_list='';
				// $filter_list=$this->Filter->getFilterOfSelectedCategory($section_id , $category_id , $locale);
//
				// if(!empty($filter_list)){
					// foreach($filter_list as $f){
						// $id=$f['Filter']['id'];
						// $title=$f['Filter']['title'];
//
						// $temp_data[$index]['id']=$id;
						// $temp_data[$index]['title']=$title;
						// $temp_data[$index]['section_id']=$section_id;
						// $temp_data[$index]['parent_id']=$category_id;
						// $index++;
					// }
				// }
			// }
//
//
			// if($section_id == 6){
//
				// $beauty_data='';
				// if($section_id == 6){
					// $beauty_data=$this->Category->GetCategoryListOfSelectedSection(8 , $locale);
				// }
//
//
//
				// if(!empty($beauty_data)){
					// foreach($beauty_data as $n){
//
						// $category_id=$n['Category']['id'];
//
						// $id=$n['Category']['id'];
						// $title=$n['Category']['title'];
//
						// $temp_data[$index]['id']=$id;
						// $temp_data[$index]['title']=$title;
						// $temp_data[$index]['section_id']=8;
						// $temp_data[$index]['parent_id']=0;
//
//
						// $index++;
						// $filter_list='';
						// $filter_list=$this->Filter->getFilterOfSelectedCategory(8 , $category_id , $locale);
//
						// if(!empty($filter_list)){
							// foreach($filter_list as $f){
								// $id=$f['Filter']['id'];
								// $title=$f['Filter']['title'];
//
								// $temp_data[$index]['id']=$id;
								// $temp_data[$index]['title']=$title;
								// $temp_data[$index]['section_id']=8;
								// $temp_data[$index]['parent_id']=$category_id;
								// $index++;
							// }
						// }
					// }
				// }
			// }
		// }
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
	// }
//
//
//
	// //get the shops list of selected category
	// function get_shops_of_selected_category($section_id=0 ,  $category_id = 0 , $branch_id=0,  $filter_id=0){
		// $f='';
		// $filter_search='';
		// if(isset($filter_id)  && $filter_id != 0){
//
			// $this->loadModel("PagesRelation");
			// $f=$this->PagesRelation->find("list",array(
			// 'fields'=>array("PagesRelation.source_id"),
			// "conditions"=>array("PagesRelation.related_id"=>$filter_id, 'PagesRelation.related_model'=>'Filter',"PagesRelation.source_model"=>'Shop')));
//
			// $first_set='';
			// $filter_search='';
			// if(!empty($f)){
				// $first_set=implode(',', $f);
				// $filter_search=array("Shop.id IN ($first_set)");
			// }
		// }
//
		// if($branch_id == 0){
			// $cond=array ("AND"=>array(
			 // array("Shop.category_id"=>$category_id) ,array("Shop.section_id"=>$section_id) , $filter_search )
			// );
		// }else{
			// $cond=array ("AND"=>array(
			// array("Shop.branches like '%$branch_id%'"),
			 // array("Shop.category_id"=>$category_id) ,array("Shop.section_id"=>$section_id) , $filter_search )
			// );
		// }
//
//
		// //get shop details
		// $this->loadModel("Shop");
		// $data=$this->Shop->find("all",array(
		// 'contain'=>array("Category"=>array("fields"=>array("Category.title"))),
		// 'order' => array("Shop.position" => 'ASC',"Shop.id" => 'DESC'),
		// 'fields'=>array(
//
		// "Shop.id","Shop.title" , "Shop.category_id", "Shop.section_id"),
		// "conditions"=>$cond
		// ));
//
//
		// $index=0;
		// $temp_data='';
		// foreach($data as $d){
			// $id=$d['Shop']['id'];
			// $title=$d['Shop']['title'];
			// $category_id=$d['Shop']['category_id'];
			// $section_id=$d['Shop']['section_id'];
			// $category_name=$d['Category']['title'];
//
//
			// $temp_data[$index]['id']=$id;
			// $temp_data[$index]['title']=$title;
			// $temp_data[$index]['category_id']=$category_id;
			// $temp_data[$index]['section_id']=$section_id;
			// $temp_data[$index]['category_name']=$category_name;
			// $index++;
		// }
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
	// }
//
//
	// //get selected shop details
	// function get_shop_details($shop_id = 0){
		// $locale=$this->params['locale'];
		// $this->loadModel("Shop");
//
		// $d=$this->Shop->getMobileShopOfSelectedId($shop_id , $locale);
//
		// $id=$d['Shop']['id'];
		// $title=$d['Shop']['title'];
		// $mobile_available=$d['Shop']['mobile_available'];
//
		// $phone_location_1=$d['Shop']['phone_location_1'];
		// $phone_number_1=$d['Shop']['phone_number_1'];
//
		// $phone_location_2=$d['Shop']['phone_location_2'];
		// $phone_number_2=$d['Shop']['phone_number_2'];
//
		// $phone_location_3=$d['Shop']['phone_location_3'];
		// $phone_number_3=$d['Shop']['phone_number_3'];
//
//
		// $text=$d['Shop']['text'];
		// $logo=$d['Shop']['image_1'];
		// $image=$d['Shop']['image_4'];
//
//
		// $pattern="/\/app\/webroot/";
		// $root=Configure::read('WEBSITE_URL');
		// $replacement="$root";
//
		// $title=preg_replace($pattern,$replacement, $title);
		// $title= html_entity_decode(($title), ENT_QUOTES, 'UTF-8');
//
		// $text=preg_replace($pattern,$replacement, $text);
		// $text= html_entity_decode(($text), ENT_QUOTES, 'UTF-8');
//
		// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
		// $temp_data['id']=$id;
		// $temp_data['title']=$title;
		// $temp_data['text']=$text;
//
//
//
		// $mobile_available=preg_replace($pattern,$replacement, $mobile_available);
		// $mobile_available= html_entity_decode(($mobile_available), ENT_QUOTES, 'UTF-8');
//
		// $temp_data['mobile_available']=$mobile_available;
//
		// $temp_data['phone_location_1']=$phone_location_1;
		// $temp_data['phone_number_1']=$phone_number_1;
//
		// $temp_data['phone_location_2']=$phone_location_2;
		// $temp_data['phone_number_2']=$phone_number_2;
//
		// $temp_data['phone_location_3']=$phone_location_1;
		// $temp_data['phone_number_3']=$phone_number_3;
//
//
		// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
		// if(!empty($logo)){
			// $preview=$WEBSITE_URL."/files/shops/preview/$logo";
			// $original=$WEBSITE_URL."/files/shops/original/$logo";
			// $temp_data['logo']['314x219']=$preview;
			// $temp_data['logo']['original']=$original;
		// }
//
//
//
		// if(!empty($image)){
			// $preview=$WEBSITE_URL."/files/shops/preview/$image";
			// $original=$WEBSITE_URL."/files/shops/original/$image";
			// $temp_data['image']['648x624']=$preview;
			// $temp_data['image']['original']=$original;
		// }
//
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
//
	// }
//
//
//
//
	// function about_section(){
		// $locale=$this->params['locale'];
		// $this->loadModel("Section");
//
		// $section='about';
//
		// $section_details=$this->Section->get_section_details($section , $locale);
		// $section_id=$section_details['Section']['id'];
//
//
		// $this->loadModel("Image");
		// $images_small_list=$this->Image->get_mobile_related_images_of_selected_type("Section",$section_id , 1 , $locale);
//
//
//
//
		// $id=$section_details['Section']['id'];
		// $title=$section_details['Section']['internal_title'];
		// $text1=$section_details['Section']['text_1'];
		// $text2=$section_details['Section']['text_2'];
		// $text3=$section_details['Section']['text_3'];
//
		// $pattern="/\/app\/webroot/";
		// $root=Configure::read('WEBSITE_URL');
		// $replacement="$root";
//
//
		// $text1=preg_replace($pattern,$replacement, $text1);
		// $text1= html_entity_decode(($text1), ENT_QUOTES, 'UTF-8');
//
		// $text2=preg_replace($pattern,$replacement, $text2);
		// $text2= html_entity_decode(($text2), ENT_QUOTES, 'UTF-8');
//
//
		// $text3=preg_replace($pattern,$replacement, $text3);
		// $text3= html_entity_decode(($text3), ENT_QUOTES, 'UTF-8');
//
//
		// $data['title']=$title;
		// $data['text_1']=$text1;
		// $data['text_2']=$text2;
		// $data['text_3']=$text3;
//
		// $WEBSITE_URL=Configure::read('WEBSITE_URL');
		// if(!empty($images_small_list)){
			// $index=0;
			// foreach($images_small_list as $im){
				// $image=$im['Image']['image'];
//
				// $preview=$WEBSITE_URL."/files/sections/preview/$image";
				// $original=$WEBSITE_URL."/files/sections/original/$image";
//
				// $data['image'][$index]['319x239']=$preview;
				// $data['image'][$index]['original']=$original;
//
				// $index++;
			// }
		// }
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($data)));exit;
	// }
//
//
//
//
	// //function to fer all featured movies
	// function get_featured_movies(){
		// $this->loadModel("Cinema");
		// $locale=$this->params['locale'];
		// $movie_rating=array("1"=>"G","2"=>'PG','3'=>'PG-13'  ,'4'=>'R' , '5'=>'NC-17' );
//
		// $d=$this->Cinema->get_featured_movie($locale);
//
		// $title=$d['Cinema']['image_1'];
		// $vip=$d['Cinema']['vip'];
		// $d_3d=$d['Cinema']['3d'];
		// $rating_id=$d['Cinema']['rating_id'];
		// $image=$d['Cinema']['image_1'];
//
		// $ShowTime=$d['ShowTime'];
//
		// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
		// $preview=$WEBSITE_URL."/files/cinemas/preview/$image";
		// $original=$WEBSITE_URL."/files/cinemas/original/$image";
//
//
//
		// $data['title']=$title;
		// $data['vip']=$vip;
		// $data['3d']=$d_3d;
		// $data['rating']=$movie_rating[$rating_id];
//
		// $data['image']['442x663']=$preview;
		// $data['image']['original']=$original;
//
		// $index=0;
		// foreach($ShowTime as $t){
			// $time["$index"]['date']=$t['date'];
			// $time["$index"]['time']=$t['time'];
//
			// $index++;
		// }
//
		// $data['show_time']=$time;
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($data)));exit;
	// }
//
//
//
//
//
	// function cinema(){
		// $this->loadModel("Cinema");
		// $this->loadModel("Category");
		// $locale=$this->params['locale'];
//
//
		// $categories= $this->Category->GetCategoryListOfSelectedSectionId(19,$locale );
//
		// //print_r($categories);exit;
		// $cat_index=0;
		// foreach($categories as $cat_id=>$cat){
//
			// $movies=$this->Cinema->get_movies_of_selected_category($cat_id, $locale);
			// $index=0;
//
			// $temp_data[$cat_index]['category']['id']=$cat_id;
			// $temp_data[$cat_index]['category']['title']=$cat;
//
//
			// $index=0;
			// foreach($movies as $n){
//
				// $id=$n['Cinema']['id'];
				// $title=$n['Cinema']['title'];
				// $image=$n['Cinema']['image_1'];
//
				// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
				// $preview=$WEBSITE_URL."/files/cinemas/preview/$image";
				// $original=$WEBSITE_URL."/files/cinemas/original/$image";
//
//
				// $temp_data[$cat_index]["movies"][$index]['title']=$title;
//
				// $temp_data[$cat_index]["movies"][$index]['image']['442x663']=$preview;
				// $temp_data[$cat_index]["movies"][$index]['image']['original']=$original;
//
				// $index++;
			// }
//
//
			// $cat_index++;
		// }
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
	// }
//
//
	// // get kids zone section
	// function kids_zone($shop_id=0){
		// $locale=$this->params['locale'];
		// $this->loadModel("Section");
//
		// $section='kids_zone';
//
		// if($shop_id == 0){
//
			// $section_details=$this->Section->get_section_details($section , $locale);
			// $section_id=$section_details['Section']['id'];
			// $category_id=0;
			// $this->loadModel("Shop");
			// $shop_details_list=$this->Shop->getShopsDetailsByCategoryIdSectionId($category_id , $section_id , $locale);
//
			// $index=0;
			// foreach($shop_details_list as $shop){
				// $id=$shop['Shop']['id'];
				// $title=$shop['Shop']['title'];
				// $image=$shop['Shop']['image_4'];
//
//
				// $temp_data[$index]['id']=$id;
				// $temp_data[$index]['title']=$title;
				// $temp_data[$index]['section_id']=$section_id;
//
				// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
				// $preview=$WEBSITE_URL."/files/shops/preview/$image";
				// $original=$WEBSITE_URL."/files/shops/original/$image";
//
				// $temp_data[$index]['image']['648x642']=$preview;
				// $temp_data[$index]['image']['original']=$original;
//
				// $index++;
//
			// }
//
		// }else{
//
			// $this->loadModel("Shop");
			// $d=$this->Shop->getMobileShopOfSelectedId($shop_id , $locale);
//
//
			// $id=$d['Shop']['id'];
			// $title=$d['Shop']['title'];
			// $mobile_available=$d['Shop']['mobile_available'];
//
			// $phone_location_1=$d['Shop']['phone_location_1'];
			// $phone_number_1=$d['Shop']['phone_number_1'];
//
			// $phone_location_2=$d['Shop']['phone_location_2'];
			// $phone_number_2=$d['Shop']['phone_number_2'];
//
			// $phone_location_3=$d['Shop']['phone_location_3'];
			// $phone_number_3=$d['Shop']['phone_number_3'];
//
//
			// $text=$d['Shop']['text'];
			// $logo=$d['Shop']['image_1'];
			// $image=$d['Shop']['image_4'];
//
//
			// $pattern="/\/app\/webroot/";
			// $root=Configure::read('WEBSITE_URL');
			// $replacement="$root";
//
			// $title=preg_replace($pattern,$replacement, $title);
			// $title= html_entity_decode(($title), ENT_QUOTES, 'UTF-8');
//
			// $text=preg_replace($pattern,$replacement, $text);
			// $text= html_entity_decode(($text), ENT_QUOTES, 'UTF-8');
//
			// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
			// $temp_data['id']=$id;
			// $temp_data['title']=$title;
			// $temp_data['text']=$text;
//
//
//
			// $mobile_available=preg_replace($pattern,$replacement, $mobile_available);
			// $mobile_available= html_entity_decode(($mobile_available), ENT_QUOTES, 'UTF-8');
//
			// $temp_data['mobile_available']=$mobile_available;
//
			// $temp_data['phone_location_1']=$phone_location_1;
			// $temp_data['phone_number_1']=$phone_number_1;
//
			// $temp_data['phone_location_2']=$phone_location_2;
			// $temp_data['phone_number_2']=$phone_number_2;
//
			// $temp_data['phone_location_3']=$phone_location_1;
			// $temp_data['phone_number_3']=$phone_number_3;
//
//
			// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
			// if(!empty($logo)){
				// $preview=$WEBSITE_URL."/files/shops/preview/$logo";
				// $original=$WEBSITE_URL."/files/shops/original/$logo";
				// $temp_data['logo']['314x219']=$preview;
				// $temp_data['logo']['original']=$original;
			// }
//
//
//
			// if(!empty($image)){
				// $preview=$WEBSITE_URL."/files/shops/preview/$image";
				// $original=$WEBSITE_URL."/files/shops/original/$image";
				// $temp_data['image']['648x624']=$preview;
				// $temp_data['image']['original']=$original;
			// }
		// }
//
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
	// }
//
//
//
//
//
	// //get list of events
	// function get_events($event_id=0){
//
		// $locale=$this->params['locale'];
//
//
		// if($event_id == 0){
//
			// $this->loadModel("Event");
			// $events=$this->Event->getAllEvents($locale);
//
//
			// $index=0;
			// foreach($events as $event){
				// $id=$event['Event']['id'];
				// $title=$event['Event']['title'];
				// $start_date=$event['Event']['start_date'];
				// $end_date=$event['Event']['end_date'];
//
				// $is_one_day=0;
				// $day='';
				// $start_day='';
				// $end_day='';
				// if($start_date == $end_date){
					// $is_one_day=1;
					// $s_day=split("-", $start_date);
					// $month=$s_day[1];
					// $day=$s_day[2];
				// }else{
					// $s_day=split("-", $start_date);
					// $month=$s_day[1];
					// $start_day=$s_day[2];
//
//
					// $e_day=split("-", $end_date);
					// $month=$e_day[1];
					// $end_day=$e_day[2];
				// }
//
				// $monthName = date('F', mktime(0, 0, 0, $month, 10)); // March
//
				// $temp_data[$index]['id']=$id;
				// $temp_data[$index]['title']=$title;
				// $temp_data[$index]['month_name']=$monthName;
				// $temp_data[$index]['is_it_one_day_event']=$is_one_day; // equal 1 if its one day event,
				// $temp_data[$index]['start_date']=$start_day;
				// $temp_data[$index]['end_date']=$end_day;
				// $temp_data[$index]['selected_day']=$day;
//
//
				// $index++;
//
			// }
//
//
		// }else{
			// $this->loadModel("Event");
			// $event=$this->Event->get_event_details($event_id, $locale);
//
			// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
//
			// $id=$event['Event']['id'];
			// $title=$event['Event']['title'];
			// $short=$event['Event']['short'];
			// $image=$event['Event']['image'];
			// $start_date=$event['Event']['start_date'];
			// $end_date=$event['Event']['end_date'];
//
//
			// $pattern="/\/app\/webroot/";
			// $root=Configure::read('WEBSITE_URL');
			// $replacement="$root";
//
			// $short=preg_replace($pattern,$replacement, $short);
			// $short= html_entity_decode(($short), ENT_QUOTES, 'UTF-8');
//
//
			// $is_one_day=0;
			// $day='';
			// $start_day='';
			// $end_day='';
			// if($start_date == $end_date){
				// $is_one_day=1;
				// $s_day=split("-", $start_date);
				// $month=$s_day[1];
				// $day=$s_day[2];
			// }else{
				// $s_day=split("-", $start_date);
				// $month=$s_day[1];
				// $start_day=$s_day[2];
//
//
				// $e_day=split("-", $end_date);
				// $month=$e_day[1];
				// $end_day=$e_day[2];
			// }
//
			// $monthName = date('F', mktime(0, 0, 0, $month, 10)); // March
//
			// $temp_data['id']=$id;
			// $temp_data['title']=$title;
			// $temp_data['short']=$short;
			// $temp_data['month_name']=$monthName;
			// $temp_data['is_it_one_day_event']=$is_one_day; // equal 1 if its one day event,
			// $temp_data['start_date']=$start_day;
			// $temp_data['end_date']=$end_day;
			// $temp_data['selected_day']=$day;
//
//
			// if(!empty($image)){
				// $preview=$WEBSITE_URL."/files/events/preview/$image";
				// $original=$WEBSITE_URL."/files/events/original/$image";
				// $temp_data['image']['350x233']=$preview;
				// $temp_data['image']['original']=$original;
			// }
//
		// }
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
//
	// }
//
	// //get the branches location
	// function get_locations(){
//
		// $locale=$this->params['locale'];
//
//
//
		// //get branches
		// $this->loadModel("Branch");
		// $branches=$this->Branch->get_all_branchs($locale);
//
		// //print_r($branches);exit;
//
		// $index=0;
		// foreach($branches as $branch){
			// $id=$branch['Branch']['id'];
			// $title=$branch['Branch']['title'];
			// $open_hours=$branch['Branch']['open_hours'];
			// $phone=$branch['Branch']['phone'];
			// $fax=$branch['Branch']['fax'];
			// $mobile=$branch['Branch']['mobile'];
			// $x_coordinate=$branch['Branch']['x_coordinate'];
			// $y_coordinate=$branch['Branch']['y_coordinate'];
//
//
//
			// $temp_data[$index]['id']=$id;
			// $temp_data[$index]['title']=$title;
			// $temp_data[$index]['open_hours']=$open_hours;
			// $temp_data[$index]['phone']=$phone;
			// $temp_data[$index]['fax']=$fax;
			// $temp_data[$index]['mobile']=$mobile;
			// $temp_data[$index]['x_coordinate']=$x_coordinate;
			// $temp_data[$index]['y_coordinate']=$y_coordinate;
//
//
			// $index++;
//
		// }
//
		// //print_r($temp_data);exit;
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
//
	// }
//
//
//
//
	// //get list of services
	// function get_services($service_id=0){
//
		// $locale=$this->params['locale'];
		// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
		// if($service_id == 0){
//
			// $this->loadModel("Service");
			// $services=$this->Service->get_all_mobile_services($locale);
//
//
//
			// $index=0;
			// foreach($services as $service){
				// $id=$service['Service']['id'];
				// $title=$service['Service']['title'];
				// $image=$service['Service']['mobile_image'];
//
//
//
//
				// $temp_data[$index]['id']=$id;
				// $temp_data[$index]['title']=$title;
//
//
				// if(!empty($image)){
					// $preview=$WEBSITE_URL."/files/services/preview/$image";
					// $original=$WEBSITE_URL."/files/services/original/$image";
					// $temp_data[$index]['image']['1080x540']=$preview;
					// $temp_data[$index]['image']['original']=$original;
				// }
//
//
				// $index++;
//
			// }
//
//
		// }else{
			// $this->loadModel("Service");
			// $service=$this->Service->get_service_details($service_id, $locale);
//
			// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
//
			// $id=$service['Service']['id'];
			// $title=$service['Service']['title'];
			// $image=$service['Service']['mobile_image'];
			// $text=$service['Service']['text'];
//
//
//
			// $pattern="/\/app\/webroot/";
			// $root=Configure::read('WEBSITE_URL');
			// $replacement="$root";
//
			// $text=preg_replace($pattern,$replacement, $text);
			// $text= html_entity_decode(($text), ENT_QUOTES, 'UTF-8');
//
//
			// $temp_data['id']=$id;
			// $temp_data['title']=$title;
			// $temp_data['text']=$text;
//
//
			// if(!empty($image)){
				// $preview=$WEBSITE_URL."/files/services/preview/$image";
				// $original=$WEBSITE_URL."/files/services/original/$image";
				// $temp_data['image']['1080x540']=$preview;
				// $temp_data['image']['original']=$original;
			// }
//
//
		// }
//
//
//
//
		// //print_r($temp_data);exit;
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
//
	// }
//
//
//
	// ///// get_promotion
	// function get_promotion(){
		// //header , mobile_banners
		// $locale=$this->params['locale'];
//
//
		// $this->loadModel("Promotion");
		// $promotion=$this->Promotion->getFirstPromotion($locale);
//
//
		// $data='';
		// if(!empty($promotion)){
//
				// $id=$promotion['Promotion']['id'];
				// $image=$promotion['Promotion']['image'];
				// $title=$promotion['Promotion']['title'];
//
				// $shop_main_category=$promotion['Promotion']['shop_main_category'];
				// $shop_sub_category=$promotion['Promotion']['shop_sub_category'];
				// $shop_id=$promotion['Promotion']['shop_id'];
//
//
//
				// $pattern="/\/app\/webroot/";
				// $root=Configure::read('WEBSITE_URL');
				// $replacement="$root";
//
				// $title=preg_replace($pattern,$replacement, $title);
				// $title= html_entity_decode(($title), ENT_QUOTES, 'UTF-8');
//
				// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
//
				// $preview=$WEBSITE_URL."/files/promotions/preview/$image";
				// $original=$WEBSITE_URL."/files/promotions/original/$image";
//
				// $temp_data['image']['720x1280']=$preview;
				// $temp_data['image']['original']=$original;
//
//
				// $data['id']=$id;
//
				// $data['title']=$title;
//
				// $data['shop_main_category']=$shop_main_category;
				// $data['shop_sub_category']=$shop_sub_category;
				// $data['shop_id']=$shop_id;
//
				// $data['image']=$temp_data['image'];
//
//
//
//
		// }
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($data)));exit;
//
//
	// }
//
//
//
	// //get highlights
	// function get_highlights($highlights_id=0){
//
		// $locale=$this->params['locale'];
		// $this->loadModel("Promotion");
		// //$branch_list=$this->Branch->get_branch_list('eng');
//
//
//
//
		// if($highlights_id  == 0){
			// $data=$this->Promotion->getAllHighlights($locale);
//
			// $index=0;
			// foreach($data as $d){
				// $id=$d['Promotion']['id'];
				// $title=$d['Promotion']['title'];
				// $image=$d['Promotion']['image'];
//
//
				// $temp_data[$index]['id']=$id;
				// $temp_data[$index]['title']=$title;
//
				// //$temp_data[$index]['shop_id']=$shop_id;
//
//
				// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
				// if(!empty($image)){
					// //image 1
					// $preview=$WEBSITE_URL."/files/promotions/preview/$image";
					// $original=$WEBSITE_URL."/files/promotions/original/$image";
					// $temp_data[$index]['image']['540x540']=$preview;
					// $temp_data[$index]['image']['original']=$original;
				// }
//
//
				// $index++;
			// }
//
		// }else{
			// $data=$this->Promotion->getSelectedHighlightsDetails($highlights_id,$locale);
//
//
			// $id=$data['Promotion']['id'];
			// $title=$data['Promotion']['title'];
			// $text=$data['Promotion']['text'];
			// $image=$data['Promotion']['image'];
//
			// //$temp_data[$index]['shop_id']=$shop_id;
			// $pattern="/\/app\/webroot/";
			// $root=Configure::read('WEBSITE_URL');
			// $replacement="$root";
//
//
			// $title=preg_replace($pattern,$replacement, $title);
			// $title= html_entity_decode(($title), ENT_QUOTES, 'UTF-8');
//
//
			// $text=preg_replace($pattern,$replacement, $text);
			// $text= html_entity_decode(($text), ENT_QUOTES, 'UTF-8');
//
//
			// $temp_data['id']=$id;
			// $temp_data['title']=$title;
			// $temp_data['text']=$text;
//
//
			// $WEBSITE_URL=Configure::read('WEBSITE_URL');
//
			// if(!empty($image)){
				// //image 1
				// $preview=$WEBSITE_URL."/files/promotions/preview/$image";
				// $original=$WEBSITE_URL."/files/promotions/original/$image";
				// $temp_data['image']['540x540']=$preview;
				// $temp_data['image']['original']=$original;
			// }
//
		// }
//
//
		// header('Content-Type: application/json' );
		// echo (str_replace('\/','/',json_encode($temp_data)));exit;
//
	// }


	function clear_all_cache($code){
		if($code=='jsdlkfhgso*8sdjf8*^YHW'){
			Configure::write('debug', 2);

		$cach_group=array('banners' , 'categories' , 'jobs' ,  'seo_management' , 'dynamic_pages' );


		 foreach( $cach_group as $g){
		 	Cache::clearGroup("$g");
		 }
		 echo "deleted done successfully";
		 exit;
		 return true;
	}}



}
