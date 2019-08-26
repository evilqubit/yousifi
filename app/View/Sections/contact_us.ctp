


<style>
	.customError .error {
		position: absolute;
		top: 38px;
	}
</style>


<div class="floatClass textArea">
	<?php 
	$title=$section_details["Section"]['internal_title'];
	$text=$section_details["Section"]['text_1'];
	
	$x_coordinate=$section_details["Section"]['x_coordinate'];
	$y_coordinate=$section_details["Section"]['y_coordinate'];
	
	?>
	
	<div class="floatClass PageTitle"><?=strtoupper($title)?></div>
	<div class="floatClass contactUsTextContainer">		
		<div class="floatClass contactTextSide"><?=$text?></div>
		
		<div class="floatClass contactUsFormContainer">
			
			<?php 
			
			$inquiry = __("inquiry",true)."*";
			$subject = __("subject",true)."*";
			$name = __("name",true)."*";
			$email = __("email",true)."*";		
			$company = __("company",true);
			$telephone = __("telephone",true);		
			$message = __("message",true)."*";
			
			
				
			
			$inquiry_id = "inquiry_id";
			$subject_id = "subject_id";
			$name_id = "name_id";
			$email_id = "email_id";
			$company_id = "company_id";
			$telephone_id = "telephone_id";
			$message_id = "message_id";
			
			
		?>
		
		
		<div class="floatClass careerFormTitle"><?=__("contact_form_title",true)?></div>
		
		
		<div class=" floatClass">
				
				
				<?php echo $this->form->create('Contact',array("url"=>array("controller"=>"Contacts","action"=>"save_contact"),"id"=>"contactForm")); ?>
				
				<!-- inquiry -->
				<div class="job_row_container  customError floatClass" id="mainJobList">
					<?php echo $this->form->input('Contact.contact_department_id',array("class"=>"required contactInput dropdwon_list defaultInvalid","label"=>false,"escape"=>false,
					'options'=>$contact_inquiries_list,
					'empty'=>$inquiry,
					'id'=>"inquiries_list")); ?>
				</div>
					
				<!-- subject -->
				<div class="job_row_container floatClass">
					<?php echo $this->form->input('Contact.subject',array("class"=>"required  contactInput  defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>$subject_id ,
						 "onfocus"=>"change_default('$subject_id','$subject',this.value,false);",
						 "onblur"=>"change_default('$subject_id','$subject',this.value,true);",
						 "value"=>$subject
					
					)); ?>
				</div>
					
				<!-- full name -->
				<div class="job_row_container floatClass">
					<?php echo $this->form->input('Contact.name',array("class"=>"required  contactInput  defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>$name_id ,
						 "onfocus"=>"change_default('$name_id','$name',this.value,false);",
						 "onblur"=>"change_default('$name_id','$name',this.value,true);",
						 "value"=>$name
					
					)); ?>
				</div>
				
				
				<!-- email -->
				<div class="job_row_container  floatClass">
					<div ><?php echo $this->form->input('Contact.email',array("class"=>"required email contactInput defaultInvalid","label"=>false,"escape"=>false
					,'id'=>$email_id ,
					 "onfocus"=>"change_default('$email_id','$email',this.value,false);",
					 "onblur"=>"change_default('$email_id','$email',this.value,true);",
					 "value"=>$email				
					)); ?></div>
				</div>
				
				
				<!-- company -->
				<div class="job_row_container  floatClass">
					<div ><?php echo $this->form->input('Contact.company',array("class"=>"contactInput","label"=>false,"escape"=>false
					,'id'=>$company_id ,
					 "onfocus"=>"change_default('$company_id','$company',this.value,false);",
					 "onblur"=>"change_default('$company_id','$company',this.value,true);",
					 "value"=>$company				
					)); ?></div>
				</div>
				
				
				<!-- phone -->
				<div class="job_row_container floatClass">
					<?php echo $this->form->input('Contact.phone',array("class"=>"  numberEvent contactInput  number1","label"=>false,"escape"=>false
					 ,'id'=>$telephone_id ,
						 "onfocus"=>"change_default('$telephone_id','$telephone',this.value,false);",
						 "onblur"=>"change_default('$telephone_id','$telephone',this.value,true);",
						 "value"=>$telephone
					
					)); ?>
				</div>
				
				
				
				
				<!-- message -->
				<div class="job_row_container floatClass">
					<?php echo $this->form->input('Contact.message',array("class"=>"required  contactMessageInput  defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>$message_id ,
						 "onfocus"=>"change_default('$message_id','$message',this.value,false);",
						 "onblur"=>"change_default('$message_id','$message',this.value,true);",
						 "value"=>$message
					
					)); ?>
				</div>
				
				
				<div class="jobFieldContainer floatClass jobRecaptchaContainer" id="job_recaptcha_container">
				<!--			/// recaptcha -->
				<?php 							
					echo $this->element("recaptcha",array("className"=>"contactInput required",'width'=>"480px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#dddddd'));				
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
			
		</div>
	</div>
	
	
	
	

 </div>

<div class="floatClass locateHereText"><?=__("located_here",true)?></div>
<div class="contact_us_map" id="get_here_map"></div>

<script type="text/javascript">



	function validation(){
		
		
		
		
		
		
			
		var text='<?=__('This field is required',true)?>';
		jQuery.validator.addMethod("defaultInvalid", function(value, element) {				
			return value != element.defaultValue;
		}, text );
		
		
		
		company_value=$("#company_id").val();
		phone_value=$("#telephone_id").val();
		
		
		<?php if($lang == 'en'){
	 		?>
	 		default_company_text='<?=$company?>';
	 		default_telephone_text='<?=$telephone?>';
	 		<?php 
	 	}else{
	 		?>
	 		default_company_text='\u0627\u0644\u0634\u0651\u0631\u0643\u0629';
	 		default_telephone_text='\u0627\u0644\u0647\u0627\u062A\u0641';
	 		
	 		<?php 
	 	} ?>
		
		// alert(company_value);
		// alert(default_company_text);
		// if(company_value == default_company_text){
			// alert('udpate');
			// $("#company_id").val("test");
		// }
// 		
		// if(phone_value == default_telephone_text){
			// $("#telephone_id").val("test");
		// }
		
		
		
		
		return $('#contactForm').valid();
	}
	
	
	function number_validate(){
			var text1='<?=__('Enter A valid number',true)?>';
			jQuery.validator.addMethod("number2", function(value, element) {
				console.log(element);
				//alert(value);
				if(value == "<?=$telephone?>" ){
					
					return true;
				}else{
					return this.optional(element) ||  /^[0-9]+$/.test(value)
				}
			  
			}, text1);
			 
			// alert($('#contactForm').valid());
			// return $('#contactForm').valid();
		}
		
		
	$(document).ready(function(){
		
		$("#inquiries_list").customSelect();
		loadScript();
		
		
		var options = {
					beforeSubmit: function(){
						$(".jobFormSubmit").hide();
						$(".careerAjaxLoader").show();
						var valid = validation();
						 
						var  nu=number_validate();
						
						
							if (valid == 1){
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
						  break;
						case 4:
						  msg='<?=__('valid_email',true);?>'
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
							$('#contactForm').clearForm();
							$('#contactForm').resetForm();
							
						}else{
							
						}
						
						// $('#msg').html(msg);
						// $('#msg').show();
// 						
						Recaptcha.reload();
						
						//reload_captcha('captcha_contact_form');
						
						
						
					}
				};
					$('#contactForm').ajaxForm(options);
			 		$("#contactForm").addClass('requiredField');
			 		
			 		
			 		
			 		
			 		
		
	});
	  
	function loadScript() {
	  var script = document.createElement("script");
	  script.type = "text/javascript";
	  script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
	  document.body.appendChild(script);
	  
	}
	
	function initialize() {
	  var myLatlng = new google.maps.LatLng(<?php echo $x_coordinate; ?>,<?php echo $y_coordinate; ?>);
	  var myOptions = {
	    zoom: 8,
	    center: myLatlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  var map = new google.maps.Map(document.getElementById("get_here_map"), myOptions);
	 // Creating a marker and positioning it on the map
		var marker = new google.maps.Marker({
		  position: new google.maps.LatLng(<?php echo $x_coordinate; ?>,<?php echo $y_coordinate; ?>),
		  map: map
		});
		
	
	}

</script>
