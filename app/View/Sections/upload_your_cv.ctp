<?php 

if($is_ajax == false){
	
	
	if($career_ajax == false){
		echo $this->element("/header/about_us_menu");	
	}
	
	if($career_ajax == false){
		
		echo "<div id='about_sections'>";	
	}	
	
	
}
 ?>

<style>
	.customError .error {
		position: absolute;
		top: 39px;
	}
	.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {
		color: transparent;
	}
	
	#address_id {
		margin-bottom: 0px !important;
	}
	
</style>

<?php if($career_ajax == false){ ?>
		
		
		
	<div class="floatClass textArea  addTopSpace addBottomSpace" id="FilterContent">
	<?php 	
	$text=$section_details["Section"]['text_1'];
	?>
	<div class="floatClass textArea"><?=$text?></div>
	<?php 
	$floatClass='floatClass';
	$margin='';
	if(empty($job_details_list)){
		$floatClass='';
		$margin='0 auto';
		}?>
	<div style="margin: <?=$margin?>" class="<?=$floatClass?> careerFormContainer" >
	
	<?php 
		
		$fname = __("full_name",true)."*";
		$email = __("email",true)."*";
		$account_manager = __("acccount_manager",true);
		$telephone = (__("career_telephone",true));
		$nationality = __("nationality",true)."*";
		$gender = __("gender",true);
		$country_of_residence = __("country_of_residence",true)."*";
		$address = __("address",true)."*";
		$dob = __("dob",true)."*";
		$position_best_describes_your_experience = __("position_best_describes_your_experience",true)."*";
		$total_years_of_experience = __("total_years_of_experience",true)."*";
		$retal_fashion_experience = __("retal_fashion_experience",true)."*";
		$upload_cv = __("upload_cv",true)."*";
		$upload_recent_photo = __("upload_recent_photo",true)."*";
		$upload_passport_copy = __("upload_passport_copy",true)."*";
		$upload_portfolio_supporting_docs = __("upload_portfolio_supporting_docs",true);
			
		
		$fname_id = "fname_id";
		$email_id = "email_id";
		$account_manager_id = "account_manager_id";
		$telephone_id = "telephone_id";
		$nationality_id = "nationality_id";
		$gender_id = "gender_id";
		$country_of_residence_id = "country_of_residence_id";
		$address_id = "address_id";
		$dob_id = "dob_id";
		$position_best_describes_your_experience_id = "position_best_describes_your_experience_id";
		$total_years_of_experience_id = "total_years_of_experience_id";
		$retal_fashion_experience_id = "retal_fashion_experience_id";
		$upload_cv_id = "upload_cv_id";
		$upload_recent_photo_id = "upload_recent_photo_id";
		$upload_passport_copy_id = "upload_passport_copy_id";
		$upload_portfolio_supporting_docs_id = "upload_portfolio_supporting_docs_id";
		
	?>
	
	
	<div class="floatClass careerFormTitle"><?=__("career_form_title",true)?></div>
	
	
	<div class=" floatClass">
			
			
			<?php echo $this->form->create('Jobs',array("url"=>array("controller"=>"Jobs","action"=>"upload_cv"),"id"=>"jobForm")); ?>
			
			<!-- full name -->
			<div class="job_row_container floatClass">
				<?php echo $this->form->input('AppliedCv.full_name',array("class"=>"required  jobInput  defaultInvalid domain","label"=>false,"escape"=>false
				 ,'id'=>$fname_id ,
					 "onfocus"=>"change_default('$fname_id','$fname',this.value,false);",
					 "onblur"=>"change_default('$fname_id','$fname',this.value,true);",
					 "value"=>$fname
				
				)); ?>
			</div>
			
			
			<!-- email -->
			<div class="job_row_container  floatClass">
				<div ><?php echo $this->form->input('AppliedCv.email',array("class"=>"required email jobInput defaultInvalid","label"=>false,"escape"=>false
				,'id'=>$email_id ,
				 "onfocus"=>"change_default('$email_id','$email',this.value,false);",
				 "onblur"=>"change_default('$email_id','$email',this.value,true);",
				 "value"=>$email				
				)); ?></div>
			</div>
			
			
			<!-- <?php if(isset($job_list) && !empty($job_list)){ ?>
				
				<div class="job_row_container  floatClass" id="mainJobList">
					<?php echo $this->form->input('AppliedCv.job_id',array("class"=>"required jobInput dropdwon_list defaultInvalid","label"=>false,"escape"=>false,
					'options'=>$job_list,
					'id'=>"job_list")); ?>
				</div>
			<?php } ?> -->
			
			<!-- phone -->
			<div class="job_row_container floatClass">
				<?php echo $this->form->input('AppliedCv.phone',array("class"=>"jobInput number1 numberEvent","label"=>false,"escape"=>false
				 ,'id'=>$telephone_id ,
					 "onfocus"=>"change_default('$telephone_id','$telephone',this.value,false);",
					 "onblur"=>"change_default('$telephone_id','$telephone',this.value,true);",
					 "value"=>$telephone
				
				)); ?>
				<div class="floatClass phone_note"><?=__("phone_note",true)?></div>
			</div>
			
			<!-- nationality_country_id -->
			<div class="job_row_container  floatClass customError">
				<div ><?php echo $this->form->input('AppliedCv.nationality_country_id',array("class"=>"required dropdwon_list jobInput2  nationality_country_id","label"=>false,"escape"=>false,
				'options'=>$country_list,
				'empty'=>$nationality,
				'id'=>"nationality_country_id")); ?></div>
			</div>
			
			
			
			<!-- gender -->
			<div class="job_row_container  floatClass">
				<div class="floatClass gender_title"><?=__("gender",true)?></div>
				<div class="floatRevClass" style="position: relative;" ><?php
				
				$gender_list=array("Male"=>__("Male",true),'Female'=>__("Female",true));
				 echo $this->form->input('AppliedCv.gender',array("class"=>"required gender_dropdwon_list genderJobInput defaultInvalid","label"=>false,"escape"=>false,
				'options'=>$gender_list,
				'id'=>"gender")); ?></div>
			</div>
			
			
			<!-- residence_country_id -->
			<div class="job_row_container  customError floatClass">
				<div ><?php echo $this->form->input('AppliedCv.residence_country_id',array("class"=>"required dropdwon_list jobInput2 residence_country_id","label"=>false,"escape"=>false,
				'options'=>$country_list,
				'empty'=>$country_of_residence,
				'id'=>"residence_country_id")); ?></div>
			</div>
			
			
			<!-- Address -->
			<div class="job_row_container floatClass">
				<?php echo $this->form->input('AppliedCv.address',array("class"=>"required  jobInput textArea  defaultInvalid","label"=>false,"escape"=>false
				 ,'id'=>$address_id ,
					 "onfocus"=>"change_default('$address_id','$address',this.value,false);",
					 "onblur"=>"change_default('$address_id','$address',this.value,true);",
					 "value"=>$address
				
				)); ?>
			</div>
			
			 
			<!-- date of birth -->
			<div class="job_row_container floatClass">
				<?php echo $this->form->input('AppliedCv.dob',array('type'=>'text', "class"=>"required numberEvent defaultInvalid  jobInput ","label"=>false,"escape"=>false
				 ,'id'=>$dob_id ,
					 "onfocus"=>"change_default('$dob_id','$dob',this.value,false);",
					 "onblur"=>"change_default('$dob_id','$dob',this.value,true);",
					 "value"=>$dob
				
				)); ?>
			</div>
			
			
			
			<!-- position -->
			<div class="job_row_container  customError floatClass">
				<div ><?php echo $this->form->input('AppliedCv.position',array("class"=>"required dropdwon_list jobInput2 defaultInvalid position","label"=>false,"escape"=>false,
				'options'=>$job_position,
				'empty'=>$position_best_describes_your_experience,
				'id'=>"position_country_id")); ?></div>
			</div>
			
			
			
			<!--total years of experiance -->
			<div class="job_row_container floatClass">
				<?php echo $this->form->input('AppliedCv.experience',array("class"=>"required  numberEvent number1  jobInput  defaultInvalid","label"=>false,"escape"=>false
				 ,'id'=>$total_years_of_experience_id ,
					 "onfocus"=>"change_default('$total_years_of_experience_id','$total_years_of_experience',this.value,false);",
					 "onblur"=>"change_default('$total_years_of_experience_id','$total_years_of_experience',this.value,true);",
					 "value"=>$total_years_of_experience
				
				)); ?>
			</div>
			
			
			<!--Retail/Fashion experience* -->
			<div class="job_row_container floatClass">
				<div class="floatClass gender_title"><?=$retal_fashion_experience?></div>
				<div class="floatClass job_form_radio">
					<input class="job_form_radio_title" type="radio" name="data[AppliedCv][retail_experience]" value="1"><?=__("Yes",true)?>
					<input class="job_form_radio_title" type="radio" checked="checked" name="data[AppliedCv][retail_experience]" value="0"><?=__("No",true)?>
				</div>
				
			</div>
			
			
			<!-- cv  -->
			<div class="job_cv_container floatClass">
				<div class="fileUploadType"><?=__("PDF",true)?></div>
				<div class="hidden_file_job_details floatClass">
					<?php
					echo $this->form->input('AppliedCv.cv',array('type'=>'file',"label"=>false,'class'=>'transparent  required','id'=>"Applied_cv","size"=>34,"onchange"=>"file_chosen(this, 'cv')"));?>
				</div>					
				<div class="floatClass fileJobInput" id="fileField_cv" onclick="$('#Applied_cv').click();"><?="$upload_cv"?></div>
				<div class="floatClass fileBrowsBtn" onclick="$('#Applied_cv').click();"><?=__('upload',true)?></div>
				<!-- <div class="floatClass" style="position:relative; width:120px; height: 20px; margin-left: 0px;  margin-top:-7px; font-family: Arial; color: #686868; font-size: 13px;">.doc , .docx, .pdf</div>	 -->				
			
			
			</div>
			
			<!-- $upload_recent_photo  -->
			<div class="job_cv_container floatClass">
				<div class="fileUploadType fileUploadPngType"><?=__("PNG/JPEG",true)?></div>
				<div class="hidden_file_job_details floatClass">
					<?php
					echo $this->form->input('AppliedCv.photo',array('type'=>'file',"label"=>false,'class'=>'transparent  required','id'=>"Applied_photo","size"=>34,"onchange"=>"file_chosen(this, 'photo')"));?>
				</div>					
				<div class="floatClass fileJobInput" id="fileField_photo" onclick="$('#Applied_photo').click();"><?="$upload_recent_photo"?></div>
				<div class="floatClass fileBrowsBtn" onclick="$('#Applied_photo').click();"><?=__('upload',true)?></div>
				<!-- <div class="floatClass" style="position:relative; width:120px; height: 20px; margin-left: 0px;  margin-top:-7px; font-family: Arial; color: #686868; font-size: 13px;">.doc , .docx, .pdf</div>	 -->				
			</div>
			
			
			<!-- $upload_passport_copy  -->
			<div class="job_cv_container floatClass">
				<div class="fileUploadType fileUploadPngType"><?=__("PNG/JPEG",true)?></div>
				<div class="hidden_file_job_details floatClass">
					<?php
					echo $this->form->input('AppliedCv.passport',array('type'=>'file',"label"=>false,'class'=>'transparent  required','id'=>"Applied_passport_copy","size"=>34,"onchange"=>"file_chosen(this, 'passport_copy')"));?>
				</div>					
				<div class="floatClass fileJobInput" id="fileField_passport_copy" onclick="$('#Applied_passport_copy').click();"><?="$upload_passport_copy"?></div>
				<div class="floatClass fileBrowsBtn" onclick="$('#Applied_passport_copy').click();"><?=__('upload',true)?></div>
				<!-- <div class="floatClass" style="position:relative; width:120px; height: 20px; margin-left: 0px;  margin-top:-7px; font-family: Arial; color: #686868; font-size: 13px;">.doc , .docx, .pdf</div>	 -->				
			</div>
			
			<!-- $upload_portfolio_supporting_docs  -->
			<div class="job_cv_container floatClass">
				<div class="fileUploadType"><?=__("PDF",true)?></div>
				<div class="hidden_file_job_details floatClass">
					<?php
					echo $this->form->input('AppliedCv.portfolio',array('type'=>'file',"label"=>false,'class'=>'transparent ','id'=>"Applied_supporting_docs","size"=>34,"onchange"=>"file_chosen(this, 'supporting_docs')"));?>
				</div>					
				<div class="floatClass fileJobInput" id="fileField_supporting_docs" onclick="$('#Applied_supporting_docs').click();"><?="$upload_portfolio_supporting_docs"?></div>
				<div class="floatClass fileBrowsBtn" onclick="$('#Applied_supporting_docs').click();"><?=__('upload',true)?></div>
				<!-- <div class="floatClass" style="position:relative; width:120px; height: 20px; margin-left: 0px;  margin-top:-7px; font-family: Arial; color: #686868; font-size: 13px;">.doc , .docx, .pdf</div>	 -->				
			</div>
			
	
			
			<div class="jobFieldContainer floatClass jobRecaptchaContainer" id="job_recaptcha_container">
			<!--			/// recaptcha -->
			
			<?php 
				 
				if ($is_ajax){
					echo $this->element("recaptcha_ajax",array("className"=>"jobInput  required",'width'=>"480px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#dddddd'));					
				}
				else{
					echo $this->element("recaptcha",array("className"=>"jobInput  required",'width'=>"480px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#dddddd'));				}
				?>
				
				
			<?php
			
				
			 							
								
			?>
			</div>
	
			
			
			<div class="job_details floatClass" style="border: none;">
				<div class="jobFormSubmit floatClass" >
					<input type="submit" value="<?=strtoupper(__('submit',true))?>" class="formSubmitBtn">
				</div>
				
				<div class="floatClass careerAjaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
				
			</div>
			<div id="msg" class="FormStatus" onclick="$('#msg').fadeOut();" style="display:none;"></div>
			
			<?php echo $this->form->end(); ?>
		</div>
	
		<?php
	 	$date_format='';
		
		if($locale == 'eng'){
			$date_format='yy-mm-dd';
			$defaultYear = (date("Y") - 18).'-01-01';
		}else{
			$date_format='dd-mm-yy';
			$defaultYear = '-01-01'.(date("Y") - 18);
		}
	 	 ?>
	 	
		<script type="text/javascript">
		function validation(){
			
			var text='<?=__('This field is required',true)?>';
			jQuery.validator.addMethod("defaultInvalid", function(value, element) {				
				return value != element.defaultValue;
			}, text );
			
			return $('#jobForm').valid();
		}
		
		
		function text_validate(){
			var text1='<?=__('Enter A valid name',true)?>';
//			jQuery.validator.addMethod("domain", function(value, element) {
//			  return this.optional(element) ||  /^[A-Za-z]+$/.test(value)
//			}, text1);
			
			return $('#jobForm').valid();
		}
 
 
 
 
		
		$(document).ready(function() {
			
			$("#dob_id").datepicker({yearRange: "-80:-15",  defaultDate: '<?php echo $defaultYear;?>',changeYear: true, dateFormat: '<?=$date_format?>'});
			
				var options = {
					beforeSubmit: function(){
						$(".jobFormSubmit").hide();
						$(".careerAjaxLoader").show();
						var valid = validation();
						var text = text_validate();
						
						
						tele=$("#telephone_id").val();
						tele_default_val='<?=$telephone?>';
						// console.log(tele);
						// console.log(tele_default_val);
						if(tele == tele_default_val){
							
							$("#telephone_id").val('');
						}
						
						
							if (valid == 1 && text == 1){
								return true;
							}
							else{
								
								$(".jobFormSubmit").show();
								$(".careerAjaxLoader").hide();
								return false;
							} 
							
					},
					resetForm: false,
					success:function(data){
						
						
						$(".jobFormSubmit").show();
						$(".careerAjaxLoader").hide();
						
						
						var msg='';
		
						data=parseInt(data);
						
						switch(data)
						{
						case 1:
						  msg='<?=__("visual_code",true);?>'
						  break;
						case 2:
						  msg='<?=__('required_fields',true);?>'
						  break;
						case 3:
						  msg='<?=__("email_sent",true);?>'
						  $('#jobForm')[0].reset();
						  break;
						case 4:
						  msg='<?=__('valid_email',true);?>'
						  break;
						 case 5:
						  msg='<?=__('invalid_cv',true);?>';
						  break;
						  case 6:
						  msg='<?=__('invalid_photo',true);?>';
						  break;
						   case 7:
						  msg='<?=__('invalid_passport',true);?>';
						  break;
						   case 8:
						  msg='<?=__('invalid_portfolio',true);?>';
						  break;
						  
						  
						default:
						  break
						}
						
						
						$('#my_popup').popup({
							  onopen: function() {
							  	var m="<button class='my_popup_close privacyClose'></button><div class='alertMsg'>"+msg+"</div>";
							  $('#my_popup_content').html(m);
							  }
						});
						
						$('#my_popup').popup('show');
						
						
						if(data == 3){							
							$('#jobForm').clearForm();
							$('#jobForm').resetForm();
							
							$("#fileField_cv").html('<?="$upload_cv"?>');
							$("#fileField_photo").html('<?="$upload_recent_photo"?>');
							$("#fileField_passport_copy").html('<?="$upload_passport_copy"?>');
							$("#fileField_supporting_docs").html('<?="$upload_portfolio_supporting_docs"?>');
							
							$(".nationality_country_id .customSelectInner").html('<?="$nationality"?>');
							
							$(".residence_country_id .customSelectInner").html('<?="$country_of_residence"?>');
							
							$(".position .customSelectInner").html('<?="$position_best_describes_your_experience"?>');
							

						}else{
							
						}
						
						// $('#msg').html(msg);
						// $('#msg').show();
						
						Recaptcha.reload();
						
						//reload_captcha('captcha_contact_form');
						
						
						
					}
				};
					$('#jobForm').ajaxForm(options);
			 		$("#jobForm").addClass('requiredField');
		});	
		</script>






	</div>
	
		
	 

	
	
		
	<?php if($career_ajax == false){ ?>
	</div>	
	</div>	
	<?php } ?>




<script type="text/javascript">
	$(document).ready(function(){
		
		$("#job_list").customSelect();
		$("#nationality_country_id").customSelect();
		$("#gender").customSelect();
		$("#residence_country_id").customSelect();
		
		
		$("#position_country_id").customSelect();
		
		
	});
</script>

<?php } ?>
