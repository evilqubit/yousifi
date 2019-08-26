<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $uses=array();
	var $helpers = array('Session','Html','Form','Js','GetArrayFormat','Time',"Text");
	var $components=array('Access','Session','Email', 'RequestHandler','StringManipulation' ,'Cookie' ,"NumbersFormat");
	
	

	
	function admin_beforeFilter(){
		
		ini_set('upload_max_filesize','64M');
		
		$level = $this->Session->read('Admin.level');
		$this->set('level', $level);
		$this->set('adminid',$this->Session->read('Admin.id'));
		$this->get_languages();
	}
	
	function beforefilter(){
		// create a new cURL resource
		

		//curl_exec('http://hbku.ndp.net/Pages/clear_all_cache');
		//$page = curl_exec("http://hbku.ndp.net/Pages/clear_all_cache");
		
		if((!isset($this->request->params["isAjax"]) || (isset($this->request->params["isAjax"]) && $this->request->params["isAjax"] == 0)) && (!empty($this->request->params["admin"]))){
			
			//print_R('testttt');exit;	
			
			if(!$this->Access->check($this->name, $this->action, $this->Session->read('Admin.level'))){
				$this->Session->setFlash('Invalid request!', null, null, 'err');
//				echo $this->request->params["controller"]." ".$this->request->params["action"];exit;
				$this->redirect('/administrators/logout/');
				exit;
			}else{
				
			
		
				$this->admin_beforeFilter();
				
				
				$this->set('adminname',$this->Session->read('Admin.admin_name'));

				$this->layout="admin/default";
				
			}
			$this->layout="admin/default";
			$this->get_languages();
			$this->set("level",1);
		}else{
			
			if(!isset($this->request->params['admin'])){
				
				
				$this->get_locale();
				
				if(isset($this->request->params["isAjax"]) && $this->request->params["isAjax"] == 0){
					$this->set("is_ajax",true);
					
					$this->layout="ajax";
				}else{
					
					
						
					//print_r($this->request->params['locale']);exit;
					$locale=$this->request->params['locale'];
					//print_r($locale);exit;
					$this->set("is_ajax",false);
					
					
					
					//get social media links
					$this->loadModel("SocialMedia");
					$social_media_links=$this->SocialMedia->getSocialMediaLinks();
					$this->set('social_media_links',$social_media_links);
					
					
					//get the default seo 
					$this->loadModel("SeoManagement");
				 	$seoData = $this->SeoManagement->get_defaults($locale);
				 	$this->set("seoData",$seoData);
					//print_R($seoData);exit;
					
					
					
					//get footer details
					$this->loadModel("DynamicPage");
					$footer_details=$this->DynamicPage->get_section_details("contact",$locale);
					$this->set("footer_details",$footer_details);
					//print_r($footer_details);exit;
				}
			}
		}
	}
	
	function get_languages(){
		$cacheId = "all_languages";
		if (($languages = Cache::read($cacheId)) === false) {
			$this->loadModel("Language");
			$languages=$this->Language->find('all');
			Cache::write($cacheId, $languages);
		}
		
		//print_r($languages);exit;
		$this->set("languages",$languages);
	}

	function get_locale() {
		
		$cookie_prefix = Configure::read("Cookie_prefix");
		if (!isset($this -> request -> params['lang'])) {
			
			if(isset($this->params["pass"][0]) && in_array($this->params["pass"][0],array("en","ar"))){
				$locale = $this->params["locale"];
				$this -> request -> params['lang'] = $this->params["pass"][0];
			}else{
				if ($this -> Session -> check("$cookie_prefix.language")) {
					$lang = $this -> Session -> read("$cookie_prefix.language");
					if (!$lang)
						$this -> request -> params['lang'] = "en";
					else
						$this -> request -> params['lang'] = $lang;
				} else {
					if (isset($_COOKIE["{$cookie_prefix}_language"])) {
						$this -> request -> params['lang'] = $_COOKIE["{$cookie_prefix}_language"];
					} else
						$this -> request -> params['lang'] = "en";
				}
			}
		}
		
		
		

		if (!in_array($this -> request -> params['lang'], array("ar", "en"))) {
			$this -> request -> params['lang'] = "en";
		}

		$this -> Session -> write("$cookie_prefix.language", $this -> request -> params['lang']);
		setcookie("{$cookie_prefix}_language", $this -> request -> params['lang'], time() + 2592000, '/');

		/////////Here we get the locale of the selected language////////////
		$lang = $this -> request -> params['lang'];
		$this -> set("lang", $lang);

		App::import('I18n', 'i18n');
		$I18n = &I18n::getInstance();
		$I18n -> l10n -> get($lang);
		foreach (Configure::read('Config.languages') as $lang => $locale) {
			if ($lang == $this -> request -> params['lang'])
				$this -> request -> params['locale'] = $locale['locale'];
		}
		Configure::write("Config.language", $this -> request -> params['locale']);
		$this -> set("locale", $this -> request -> params['locale']);

	}
	
	function set_locale($lang="en"){
		//print_r($lang);exit;
		if($lang == "en")
			$locale = "eng";
		else $locale = "ara";
		
		$cookie_prefix = Configure::Read("COOKIE_PREFIX");
		
		$this->params['lang'] = $lang;
		$this->params['locale'] = $locale;
		
		//print_r( $locale);exit;
		$this->Session->write("$cookie_prefix.language",$this->params['lang']);
		//print_r( $this->Session->read("$cookie_prefix"));exit;
		setcookie("{$cookie_prefix}_language",$this->params['lang'],time()+2592000,'/');
		/////////Here we get the locale of the selected language////////////
		
		//print_r($this->request->params['lang']);exit;
		$lang = $this->params['lang'];
		$this->set("lang",$lang);
		
	 	App::uses('I18n', 'I18n');

 	
//		App::import('Core', 'i18n');
		$I18n =& I18n::getInstance();
		$I18n->l10n->get($lang);
		
		foreach (Configure::read('Config.languages') as $lang => $locale) {
			
			if($lang == $this->params['lang'])
			$this->params['locale'] = $locale['locale'];
			//print_r( $this->params['lang']." --");
		}
		// print_r($lang);
		// print_r($this->params['locale']);exit;
		
		$this->set("locale",$this->params['locale']);

	}

	function saveSlug($modelName){
		$cacheId = "all_languages";
		if (($languages = Cache::read($cacheId)) === false) {
			$languages=$this->Language->find('all');
			Cache::write($cacheId, $languages);
		}

		foreach ($languages as $language){
			$code=$language['Language']['locale'];
			if(isset($this->request->data["$modelName"]["slug"]["$code"])){
				$slug=$this->request->data["$modelName"]["slug"]["$code"];
				$slug=strtolower(addslashes(preg_replace("/ /","-",htmlspecialchars($slug))));
				$slug=strtolower(addslashes(preg_replace("/'/","-",htmlspecialchars($slug))));
				$this->request->data["$modelName"]["slug"]["$code"]=$slug;
			}
			if(isset($this->request->data["$modelName"]["short"]["$code"])){
				$short=$this->request->data["$modelName"]["short"]["$code"];
				$short=htmlentities(strip_tags(str_ireplace("<br/>","\n",htmlspecialchars($short))));
				$this->request->data["$modelName"]["short"]["$code"]=$short;
			}
		}

	}


	
	function get_user_country() {
		
//		$_SERVER['REMOTE_ADDR'] = "85.112.95.25";
		$query="SELECT * FROM ip2nation WHERE ip < INET_ATON('{$_SERVER['REMOTE_ADDR']}') ORDER BY ip DESC LIMIT 0,1";
				
		
		$this->loadModel("Ip2nation");
		$res = $this->Ip2nation->query($query);
		
		
		
		if(isset($res[0]["ip2nation"]["ip"])){
			$countryCode = $res[0]["ip2nation"]["country"];
		}
		
		$this->loadModel("Country");
		$userCountryId = $this->Country->getCountryByCode($countryCode);
		return $userCountryId;
				
		
		return 0;
	}
	
	
	function authenticate_user($loginRequired = 1){
		$userInfo = $this->Session->read(Configure::read("User_Session_Name"));
	
		if(!$userInfo && $loginRequired ==1){
			$this->Session->setFlash(__("please_login",true),"err_msg");
			$currLocation = $this->here;
			
			if(!$this->RequestHandler->isAjax()){
				$this->redirect("/?page=$currLocation");
				exit;
			}else{
				exit;
			}
			
		}else{
			$this->set("UserInfo",$userInfo);
			$this->set("UserId",$userInfo["User"]["id"]);
		}
	}
	
	
	function sendEmail($to,$subject, $template, $data,$reply_to = "",$from_email = ""){
		$no_reply = Configure::read("BASE_NOREPLY_EMAIL");
		
		
		if(empty($reply_to))
			$reply_to = Configure::read("BASE_NOREPLY_EMAIL");
			
		if(empty($from_email))
			$from_email = $no_reply;
		
			
		
		
			
		$email_prefix = Configure::read("EMAIL_SUBJECT_PREFIX");
	
		$this->Email->from=$email_prefix."<$from_email>";
		$this->Email->to=$to;
	
		$this->Email->subject = $email_prefix.' | '.$subject;
		$this->Email->sendAs = 'both';
		
		$this->Email->replyTo=$reply_to;
		$this->Email->template = $template;///////////////
		$this->set('data',$data);
		
		
		if($this->Email->send()){
			
			$this->Email->reset();
			return 1;
		}else return 0;
	}
	
	
	/*Find data with all translations given an id and an array of conditions*/
	function findAllTranslations($modelName,$id=null,$conditions=array(),$fields=array(),$bindedModels=array()){
		$this->loadModel($modelName);
		$contain = array();
		if (isset($this->$modelName->actsAs['Translate'])){
			$translatableFields = $this->$modelName->actsAs['Translate'];
			foreach ($translatableFields as $translatableField){
				$this->$modelName->unbindTranslation(array($translatableField=>$translatableField.'Translation'));
				$this->$modelName->bindTranslation(array($translatableField=>$translatableField.'Translation'));
				$contain += array($translatableField.'Translation'=>array('fields'=>array($translatableField.'Translation.locale',$translatableField.'Translation.content')));
			}
		}
		
		if (!is_null($id)){
			$conditions += array("$modelName.id"=>$id);
			$find = "first";
		}
		else{
			$find = "all";
		}
		
		foreach ($bindedModels as $bindedModel){
			$contain += array($bindedModel=>array('fields'=>array("$bindedModel.id")));
		}
		
		$result = $this->$modelName->find($find,array('conditions'=>$conditions,'fields'=>$fields,'contain'=>$contain));
		if (isset($translatableFields)){
			if (!is_null($id)){
				foreach ($translatableFields as $translatableField){
					$result[$modelName][$translatableField] = array();
					if (isset($result[$translatableField.'Translation'])){
						foreach ($result[$translatableField.'Translation'] as $fieldTranslation){
							$locale = $fieldTranslation['locale'];
							$content = $fieldTranslation['content'];
							$result[$modelName][$translatableField][$locale] = $content;
						}
						unset($result[$translatableField.'Translation']);
					}
				}
			}
			else{
				foreach ($translatableFields as $translatableField){
					foreach ($result as $i_r=>$res){
						$result[$i_r][$modelName][$translatableField] = array();
						if (isset($res[$translatableField.'Translation'])){
							foreach ($res[$translatableField.'Translation'] as $fieldTranslation){
								$locale = $fieldTranslation['locale'];
								$content = $fieldTranslation['content'];
								$result[$i_r][$modelName][$translatableField][$locale] = $content;
							}
							unset($result[$i_r][$translatableField.'Translation']);
						}
					}
				}
			}
		}
		
		//Find result for binded Models
		foreach ($bindedModels as $bindedModel){
//			foreach ($result[$bindedModel] as $resultBindedModel){
				$bindedModelId = $result[$bindedModel]['id'];
				unset($result[$bindedModel]);
//				$bindedResult = $this->findAllTranslations($bindedModel,$bindedModelId);
//				if(!isset($result[$bindedModel]) || empty($result[$bindedModel])){
//					$result[$bindedModel] = array(0=>$bindedResult[$bindedModel]);
//				}
//				else{
//					
//				}
				$result += $this->findAllTranslations($bindedModel,$bindedModelId);
//			}
		}
		
		return $result;
	}
	
	function get_all_locales_multiple($conditions,$model_name,$locales,$fields=array(),$common_fields=array(),$related_tables=null){
			$result_array=array();
			
			foreach ($locales as $locale){
				
				if($model_name == "Image"){
					$order = array("Image.position"=>"ASC","Image.id"=>"ASC");
				}
				else{
					$order = array();
				}
				$this->$model_name->locale=$locale;
				$get_fields=$this->$model_name->find('all',array("conditions"=>$conditions,"order"=>$order));
				
				if(!empty($get_fields)){
					$count = 0;
					foreach ($get_fields as $get_fields){
						foreach ($get_fields[$model_name] as $field=>$value){
		
							if(!empty($fields)){
								if(in_array("$field",$fields)){
									$result_array[$count][$model_name]["$field"]["$locale"]=$get_fields[$model_name][$field];
									unset($get_fields[$model_name][$field]);
								}else{
									$result_array[$count][$model_name]["$field"]=$get_fields[$model_name][$field];
									unset($get_fields[$model_name][$field]);
								}
							}else{
									$result_array[$count][$model_name]["$field"]=$get_fields[$model_name][$field];
									unset($get_fields[$model_name][$field]);
								}
						}
						$count++;
					}
				}
			}
			
			////////////////////////////////////////////////1//
			if($related_tables!=null){
				foreach ($related_tables as $related_table){
					$foreign_key=$related_table["foreign_key"];
					$model=$related_table["table"];
					foreach ($locales as $locale){
						$this->$model->locale=$locale;
						$model_translate=$model."I18n";
						if(isset($related_table["ordering"]))
						$ordering=$related_table["ordering"];
						else $ordering="";
						$this->$model_translate->displayField="field";
						$get_all_fields=$this->$model->find('all',array('callbacks'=>false,"conditions"=>array("$model.$foreign_key"=>$id),"order"=>"$ordering"));
						foreach ($related_table["fields"] as $field){
							$i=0;
							foreach ($get_all_fields as $get_fields){
	
								$result_array[$model][$i]["$field"]["$locale"]=$get_fields[$model][$field];
	
								unset($get_fields[$model][$field]);
								$i++;
							}
						}
						foreach ($related_table["common_fields"] as $field){
							$i=0;
							foreach ($get_all_fields as $get_fields){
								$result_array[$model][$i]["$field"]=$get_fields[$model][$field];
								$i++;
							}
							unset($get_fields[$model][$field]);
						}
					}
				}
			}
			
			return $result_array;
	}
	
	function fillEmptyMetaFields($modelName){
		$locales = Configure::read("LOCALES");
		foreach ($locales as $locale){
			if(isset($this->request->data["$modelName"]["title"][$locale])){
				if(empty($this->request->data["SeoManagement"]["title"][$locale])){
					if(!empty($this->request->data["$modelName"]["title"][$locale]))
					$this->request->data["SeoManagement"]["title"][$locale] = $this->request->data["$modelName"]["title"][$locale];
				}
			}
			
			$desc = "";
			if(isset($this->request->data["$modelName"]["short"][$locale])){
				$desc = $this->request->data["$modelName"]["short"][$locale];
			}elseif(isset($this->request->data["$modelName"]["text"][$locale]))
				$desc = strip_tags($this->request->data["$modelName"]["text"][$locale]);
			
			if(empty($this->request->data["SeoManagement"]["description"][$locale])){
				$this->request->data["SeoManagement"]["description"][$locale] = $desc;
			}
			
			if(empty($this->request->data["SeoManagement"]["keywords"][$locale])){
				$keywords = "";
				
				if(isset($this->request->data["$modelName"]["title"][$locale]) && !empty($this->request->data["$modelName"]["title"][$locale]) ){
					
					$keywords .= $this->request->data["$modelName"]["title"][$locale].",";
					
				}
				
				$this->request->data["SeoManagement"]["keywords"][$locale] = $keywords;
			}
			
			if(empty($this->request->data["SeoManagement"]["slug"][$locale]) && isset($this->request->data[$modelName]["title"][$locale])){
				$this->request->data["SeoManagement"]["slug"][$locale] = $this->request->data[$modelName]["title"][$locale];
			}
			
			
			if(isset($this->request->data["SeoManagement"]["slug"]["$locale"]))
				$this->request->data["SeoManagement"]["slug"]["$locale"] = $this->StringManipulation->slug($this->request->data["SeoManagement"]["slug"]["$locale"]);
				
			
		}
			
		
	}
	function get_all_locales($conditions,$model_name,$locales,$fields=array(),$common_fields=array(),$related_tables=null){
		$result_array=array();

		$defaultLocale = $this->$model_name->locale;
		
		foreach ($locales as $locale){
		
			$this->$model_name->locale=$locale;
			$get_fields=$this->$model_name->find('first',array("contain"=>false,"conditions"=>$conditions));
			
			if(!empty($get_fields)){
				
				foreach ($get_fields[$model_name] as $field=>$value){

					if(!empty($fields)){
						
						if(in_array("$field",$fields)){
						
							$result_array[$model_name]["$field"]["$locale"]=$get_fields[$model_name][$field];
							unset($get_fields[$model_name][$field]);
						}else{
							$result_array[$model_name]["$field"]=$get_fields[$model_name][$field];
							unset($get_fields[$model_name][$field]);
						}
					}else{
							$result_array[$model_name]["$field"]=$get_fields[$model_name][$field];
							unset($get_fields[$model_name][$field]);
						}
				}
				
			}
		
			
		}
		
		$this->$model_name->locale = $defaultLocale;
		////////////////////////////////////////////////1//
		if($related_tables!=null){
			
			foreach ($related_tables as $related_table){
				$foreign_key=$related_table["foreign_key"];
				$model=$related_table["table"];
				foreach ($locales as $locale){
					$this->$model->locale=$locale;
					$model_translate=$model."I18n";
					if(isset($related_table["ordering"]))
					$ordering=$related_table["ordering"];
					else $ordering="";
					$this->$model_translate->displayField="field";
					$get_all_fields=$this->$model->find('all',array("conditions"=>array("$model.$foreign_key"=>$id),"order"=>"$ordering"));
					foreach ($related_table["fields"] as $field){
						$i=0;
						foreach ($get_all_fields as $get_fields){

							$result_array[$model][$i]["$field"]["$locale"]=$get_fields[$model][$field];

							unset($get_fields[$model][$field]);
							$i++;
						}
					}
					foreach ($related_table["common_fields"] as $field){
						$i=0;
						foreach ($get_all_fields as $get_fields){
							$result_array[$model][$i]["$field"]=$get_fields[$model][$field];
							$i++;
						}
						unset($get_fields[$model][$field]);
					}
				}
			}
		}
		
		return $result_array;
	}
}
