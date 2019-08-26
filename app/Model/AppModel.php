<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');
App::uses('HttpSocket', 'Network/Http');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	//default language
	var $locale='eng';
	var $defaultLocale='eng';
	public $aliasesUsed = array("SubPage"=>"DynamicPage");
	
	
	// function afterSave(){		
		// $HttpSocket = new HttpSocket();
		// // string query
		// $site=Configure::read('WEBSITE_URL');
		// //print_r("$site/Pages/clear_all_cache");exit;
		// $results = $HttpSocket->get("$site/Pages/clear_all_cache", 'q=cakephp');
	// }
// 	
	// function afterDelete(){
		// $HttpSocket = new HttpSocket();
		// // string query
		// $site=Configure::read('WEBSITE_URL');
		// //print_r("$site/Pages/clear_all_cache");exit;
		// $results = $HttpSocket->get("$site/Pages/clear_all_cache", 'q=cakephp');
	// }
	
	function beforeSave(){
		$modelName = $this->name;
		
		
		if(isset($this->data[$modelName]["id"])){
			$action = "edit";
			$rowId = $this->data[$modelName]["id"];
		}else{
			$action = "add";
			
			if(isset($this->_schema["position"])){				
				$tableName = $this->table;
				$sql = "update $tableName set position=position+1;";
				$this->query($sql);
			}
			
		}
		
	}
	


	public function afterFind($data,$manualFlag = 0){
		
		$modelName = $this->name;
		$firstEntryKey = key($data);
//		if($modelName == "DynamicPage"){
//			echo "<pre>";
//			print_r($data);
//			echo "</pre>";
//		}

		if($this->locale == $this->defaultLocale ){
			return $data; 
		}
		
		
//		echo "$modelName<pre>";
//		print_r($data);
//		echo "</pre><br/>";
//		



		//find all
		if(is_numeric($firstEntryKey)){
			
			foreach ($data as $entryIndex=>$entry){
//				echo "$modelName 1<pre>";
//						print_r($entry);
//						echo "</pre>";
				//for has one
				if(isset($entry[$modelName."I18n"])){
					foreach ($entry[$modelName."I18n"] as $i18nEntry){
						if(!empty($i18nEntry["content"])){
							$data[$entryIndex][$modelName][$i18nEntry["field"]] = $i18nEntry["content"];
						}else{
							$data[$entryIndex][$modelName][$i18nEntry["field"]] = $entry[$i18nEntry["field"]];
						}
						
					}
					unset($data[$entryIndex][$modelName."I18n"]);
					
				}
				else{		
					if(!empty($entry)){
						
						foreach ($entry as $entryModelName=>$entryData){
							// SeoManagement
							if(isset($entryData[$entryModelName."I18n"])){
								foreach ($entryData[$entryModelName."I18n"] as $i18nHasManyEntry=>$i18nData){
									if(!empty($i18nData["content"]))
										$data[$entryIndex][$entryModelName][$i18nData["field"]] = $i18nData["content"];
									else{
										$data[$entryIndex][$entryModelName][$i18nData["field"]] = $entryData[$i18nData["field"]];
									}
								}
								unset($data[$entryIndex][$entryModelName][$entryModelName."I18n"]);
								
							}else{
								if(isset($entry[$entryModelName][0])){
									foreach ($entry[$entryModelName] as $subLevelEntryModel=>$subLevelEntry){
										foreach ($subLevelEntry as $subModel=>$subModelData){
											
											if(App::import('Model', $subModel)){
												if(isset($subModelData[$subModel."I18n"]) && is_array($subModelData[$subModel."I18n"])){
													foreach ($subModelData[$subModel."I18n"] as $i18nHasManyEntry=>$i18nData){
//														if(!empty($i18nData["content"])){
															$data[$entryIndex][$entryModelName][$subLevelEntryModel][$subModel][$i18nData["field"]] = $i18nData["content"];
//														}else{
//															$data[$entryIndex][$entryModelName][$subLevelEntryModel][$subModel][$i18nData["field"]] = $i18nData[$i18nData["field"]];
//														}
													}
													
													unset($data[$entryIndex][$entryModelName][$subLevelEntryModel][$subModel][$subModel."I18n"]);
												}else{
													//$subModel is the $subLevelEntryModelI18n
//													echo "$subModel<pre>";
//													print_r($subModelData);
//													echo "</pre><br/><br/>";
													
													if(!empty($subModelData) && is_array($subModelData)){
														foreach ($subModelData as $i18nHasManyEntry=>$i18nData){
//															if(!empty($i18nData["content"])){
																$data[$entryIndex][$entryModelName][$subLevelEntryModel][$i18nData["field"]] = $i18nData["content"];
//															}else{
//																$data[$entryIndex][$entryModelName][$subLevelEntryModel][$i18nData["field"]] = $i18nData[$i18nData["field"]];
//															}
														}
														
														unset($data[$entryIndex][$entryModelName][$subLevelEntryModel][$subModel]);
													}
												}
//												echo "<pre>";
//												print_r($data);
//												echo "</pre><br/><br/>";
//												exit;
												
											}
										}
									}
								}
								
										
//								$modelObj = ClassRegistry::init($entryModelName);
								
//								if($modelObj){
//									$modelObjData = $modelObj->afterFind($entryData,1);
									
//									echo "$entryModelName<pre>";
//									print_r($entryData);
//									echo "</pre>";
									
//									$data[$entryIndex][$entryModelName] = $modelObjData;
									
//									echo "<pre>";
//									print_r($modelObjData);
//									echo "</pre>";
									
//									echo "$entryModelName<pre>";
//									print_r($modelObjData);
//									echo "</pre>";exit;
//								}
											
											
//								if(isset($entry[0])){
//									foreach ($entry as $subEntryIndex=>$subEntryData) {
//										if(isset($subEntryData[$entryModelName."I18n"])){
//											foreach ($subEntryData[$entryModelName."I18n"] as $i18nHasManyEntry=>$i18nData){
//													$data[$entryIndex][$entryModelName][$i18nData["field"]] = $i18nData["content"];
//											}
//											
//											unset($data[$entryIndex][$subEntryIndex][$entryModelName."I18n"]);
//										}else{
//											echo "here";exit;
//											$modelObj = App::import('Model', $subEntryIndex);
//											$modelObjData = $modelObj->afterFind();
//											$data[$entryIndex][$subEntryIndex] = $modelObjData;
//											
//											echo "<pre>";
//											print_r($modelObjData);
//											echo "</pre>";exit;
//											
//										}
//									}
//								}
							}
						
							}
//						if(isset($entry[$entryModelName."I18n"])){
//							foreach ($entry[$entryModelName."I18n"] as $i18nHasManyEntry=>$i18nData){
//									if(isset($i18nData[$entryModelName."I18n"])){
//										foreach ($i18nData[$entryModelName."I18n"] as $i18nEntry){
//											$data[$entryIndex][$entryModelName][$i18nHasManyEntry][$i18nEntry["field"]] = $i18nEntry["content"];
//										}
//									}
//									
//									unset($data[$entryIndex][$entryModelName][$i18nHasManyEntry]);
//							}
//						}
					}
					
				}
				// if has many, the fix will be at the last level of the original modelname
//				if(isset($entry[0])){
//					
//					
//					foreach ($entry as $entryIndex2=>$entrySub){
//						foreach ($entrySub[$modelName."I18n"] as $i18nEntry){
//							$data[$entryIndex][$i18nEntry["field"]] = $i18nEntry["content"];
//						}
//					}
//					unset($data[$entryIndex][$modelName."I18n"]);
//				}
//				else{
//					echo "2<br/>";
//					if(isset($entry[0])){
//						echo "in";
//						foreach ($entry as $entryIndex=>$entryData){
//							if(isset($entryData[$modelName."I18n"])){
//								foreach ($entry[$modelName."I18n"] as $i18nEntry){
//									$entry[$entryIndex][$i18nEntry["field"]] = $i18nEntry["content"];
//								}
//								unset($entry[$entryIndex][$modelName."I18n"]);
//							}
//						}
//					}
//				}
			}
		}else{
			
			// find first
			if(isset($data[$modelName."I18n"])){
			
			
				foreach ($data[$modelName."I18n"] as $i18nEntry){
					if(!empty($i18nEntry["content"])){
						$data[$i18nEntry["field"]] = $i18nEntry["content"];
					}
				}
				unset($data[$modelName."I18n"]);
			}
		}
		
//		echo $modelName."<br/>";
//		if($modelName == "DynamicPage"){
//			echo "<pre>";
//			print_r($data);
//			echo "</pre>";exit;
//		}exit;


		
	 	return $data;
	}
	
	function beforeFind(){
		
		$modelName = $this->name;
		$modelI18nName = $modelName."I18n";
		

		//unbind if query is not from association
		$this->unbindModel(array("hasMany"=>array($modelI18nName)));
		
	}
	
	function generateContainableTranslations($model,$contain,$locale){
		//contain the i18n with the same fields
	
		$containGlobalSettings = array("fields","order","limit","conditions");
		
		if($locale != $this->defaultLocale && !empty($contain)){
			foreach ($contain as $containModel=>$containSettings){
				
				$containModelI18nFieldsCond = "1=1";
				
				
				/*Contain array may have 2 structures
				*	array[0] = "Seomanagement",
				*	array[1] = "Album",
				*   -----	OR	-------
				* 	array["SeoManagement"] = array("fields"=>array())
				* 	array["Album"] = array("fields"=>array())
				*/
				$fieldsList = "";
				if(!is_numeric($containModel)){
				
//					if(isset($this->aliasesUsed[$containModel])){
////						$containModel = $this->aliasesUsed[$containModel];
//						$containModelI18n = $this->aliasesUsed[$containModel]."I18n";
//					}else{
						$containModelI18n = $containModel."I18n";
//					}
//					echo "<pre>";
//					print_r($contain);
//					echo "</pre>";exit;


					if(!App::import('Model', $containModelI18n)){
						continue;
					}
					
					
					if(is_array($contain[$containModel])){
						if(isset($contain[$containModel]["fields"]) && !empty($contain[$containModel]["fields"])){
							$fieldsList = "";
							foreach ($contain[$containModel]["fields"] as $field){
								
								//check if fields is in $modelName.field format
								$fieldArray = explode(".",$field);
								if(isset($fieldArray[1])) $field = $fieldArray[1];
								
								if(!empty($fieldsList)) $fieldsList .= ",";
								
								$fieldsList .= "'$field'";
								
								
							}
							
							
						}
						foreach ($contain[$containModel] as $containIndex=>$containData)
						{
							if(!in_array($containIndex,$containGlobalSettings)){
									//second Level Contain
									
									$containLevel2Model = $containIndex;
									$containLevel2ModelI18n = $containLevel2Model."I18n";
									
									
//									echo "$containModel $containIndex<pre>";
//										print_r($contain[$containModel]);
//										echo "</pre>";
//										exit;

									$fieldsList2 = "";
									if(isset($containData["fields"])){
										
										foreach ($containData["fields"] as $field){
									
											//check if fields is in $modelName.field format
											$fieldArray = explode(".",$field);
											if(isset($fieldArray[1])) $field = $fieldArray[1];
											
											if(!empty($fieldsList2)) $fieldsList2 .= ",";
											
											$fieldsList2 .= "'$field'";
											
										}
									}
							
									$containLevel2ModelI18nFields = $fieldsList2;

									$contain[$containModel][$containIndex][$containLevel2ModelI18n] = array("conditions"=>array("$containLevel2ModelI18n.locale"=>$locale,"$containLevel2ModelI18n.field in ($fieldsList2)"));
									
									
									
							}
							
						}
					}
					
					if(!empty($fieldsList)){
						$containModelI18nFieldsCond = "$containModelI18n.field in ($fieldsList)";
					}
				}else{
					$containModel = $containSettings;
					$containModelI18n = $containModel."I18n";
				}
				
				if(!isset($this->hasMany["$containModelI18n"])){
					$containModelObj = ClassRegistry::init($containModel);
					$containModelObj->bindModel(array("hasMany"=>array("$containModelI18n"=>array("foreignKey"=>"foreign_key"))),false);
				}
					$contain[$containModel][$containModelI18n] = array("conditions"=>array("$containModelI18n.locale"=>$locale,$containModelI18nFieldsCond));
			}
		}
		
//		echo "<pre>";
//		print_r($contain);
//		echo "</pre>";
//		exit;
//		
		
		return $contain;
	}
	
	
}