<div class="contact_internal_container floatClass">
	
	<div class="floatClass contactUsTitle_logo"><?=strtoupper(__('Contact Us',true))?></div>
	<div style="clear: both">
		<div class="floatClass google_map">
			<div class="map" id="googleMapDiv" ></div>
		</div>
		<div class="floatClass contact_form">
				<div class="address_details floatClass">
					<?=$data["DynamicPage"]["text"]; ?>
				</div>
				
				<div class="floatClass contactSubTitle"><?=__('Send us your comments',true);?></div>
				<?php 
					// $test =__("This field is required",true);
					// print_r($test);
					
					
					$fname = __("Full Name",true);
					$enter_name=__("enter your name",true);
					
					
					$email = __("E-mail",true);
					$enter_email=__("enter your email address",true);
					
					$department = __("Department",true);
					
					$phone = __("Mobile",true);
					$enter_phone=__("enter your number",true);
					
					
					$msg = __("Comments",true);
					$enter_msg=__("write your feedback",true);
					
					
					$send = __("SEND",true);
					
					
					
					$fname_id = "fnameId";
					
					$email_id = "emailId";
					$phone_id = "phoneId";
					$msg_id = "msgId";
					
				?>
		
		
		
				<div id="msg" class="FormStatus" onclick="$('#msg').fadeOut();" style="display:none;"></div>
				
				<?php echo $this->form->create('Contact',array("url"=>array("controller"=>"Contacts","action"=>"save_contact"),"id"=>"contactForm")); ?>
				
				<div class="contact_details floatClass">
					<label class="floatClass contact_label"><?=$fname?></label>
					<div class="floatClass contact_field_contaainer"><?php echo $this->form->input('name',array("class"=>"required  contactInput defaultInvalid","label"=>false,"escape"=>false
					 ,'id'=>$fname_id ,
						 "onfocus"=>"change_default('$fname_id','$enter_name',this.value,false);",
						 "onblur"=>"change_default('$fname_id','$enter_name',this.value,true);",
						 "value"=>$enter_name
					
					)); ?>
					</div>
				</div>
				
			
		
				
				<div class="contact_details  floatClass">
					<label class="floatClass contact_label"><?=$phone?></label>
					<div class="floatClass contact_field_contaainer"><?php echo $this->form->input('phone',array("class"=>"required  contactInput defaultInvalid","label"=>false,"escape"=>false
					,'id'=>$phone_id ,
					 "onfocus"=>"change_default('$phone_id','$enter_phone',this.value,false);",
					 "onblur"=>"change_default('$phone_id','$enter_phone',this.value,true);",
					 "value"=>$enter_phone
					
					)); ?></div>
				</div>
				
				<div class="contact_details  floatClass">
					<label class="floatClass contact_label"><?=$email?></label>
					<div class="floatClass contact_field_contaainer"><?php echo $this->form->input('email',array("class"=>"required email contactInput defaultInvalid","label"=>false,"escape"=>false
					,'id'=>$email_id ,
					 "onfocus"=>"change_default('$email_id','$enter_email',this.value,false);",
					 "onblur"=>"change_default('$email_id','$enter_email',this.value,true);",
					 "value"=>$enter_email
					
					)); ?></div>
				</div>
				
				<?php 
				
				if (count($contant_departments) > 1){ ?>
				<div class="contact_details floatClass" style="position:relative;">
					<label class="floatClass contact_label"><?=$department?></label>
					<div class="floatClass contact_field_contaainer">
							<?php echo $this->form->input('contact_department_id',
							array("class"=>"required  selectBoxClass",
							'id'=>"ContactPurpose", 
							"label"=>false,
							"options"=>$contant_departments,
							
							"empty"=>__('select',true),
							"escape"=>false)); ?>
					</div>
				</div>
				<?php } ?>
				<div class="contact_details floatClass">
					<label class="floatClass contact_label"><?=$msg?></label>
					<div class="floatClass contact_field_contaainer"><?php echo $this->form->input('message',array("class"=>"required contactTextArea defaultInvalid","label"=>false,"escape"=>false
					,'id'=>$msg_id ,
					 "onfocus"=>"change_default('$msg_id','$enter_msg',this.value,false);",
					 "onblur"=>"change_default('$msg_id','$enter_msg',this.value,true);",
					 "value"=>$enter_msg
					
					)); ?>
					</div>
				</div>
				
				<div class="contact_recaptcha_details floatClass" id="recaptcha_container">
						<?php 
						if ($is_ajax){
							echo $this->element("recaptcha_ajax",array("className"=>"contactInput",'width'=>"215px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#b5b5b5'));					
						}
						else{
							echo $this->element("recaptcha",array("className"=>"contactInput",'width'=>"215px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#b5b5b5'));
						}
						?>
				</div>
				
				<div class="contact_details floatClass">
					<div class=""><?php echo $this->form->input($send, array('class'=>'ContactBtn floatRevClass' , 'type'=>'submit' ,'label'=>false , 'escape'=>false));  ?></div>
					<!-- <div class="ContactRestBtn floatRevClass" onclick="form_reset('contactForm');return false;"><?=$reset?></div> -->
				</div>
				<?php echo $this->form->end(); ?>
			</div>
		</div>
</div>	
	<!--//////////////////address ////////////////////////////// 		 -->
	
	

	
<script type="text/javascript">
function validation(){
	var text2='<?=__('This field is required',true)?>';
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, text2 );
	
	return $('#contactForm').valid();
}


	function loadScript() {
	  var script = document.createElement("script");
	  script.type = "text/javascript";
	  script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
	  document.body.appendChild(script);
	  
	}
	
	function initialize() {
	  var x= '<?=$data["DynamicPage"]['x_coordinate'];?>';
      var y= '<?=$data["DynamicPage"]['y_coordinate'];?>';
	  var myLatlng = new google.maps.LatLng(x,y);
	  var myOptions = {
	    zoom: 14,
	    center: myLatlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  var map = new google.maps.Map(document.getElementById("googleMapDiv"), myOptions);
	 // Creating a marker and positioning it on the map
		var marker = new google.maps.Marker({
		  position: new google.maps.LatLng(x,y),
		  map: map
		});
		
	
	}
	
	
$(document).ready(function() {
	
	$('.selectBoxClass').customSelect();
	
	
	loadScript();
		var options = {
			beforeSubmit: function(){
				var valid = validation();
					if (valid == 1){
						return true;
					}
					else{
						return false;
					}
			},
			resetForm: false,
			success:function(data){
				var text='';
				if(data == 1){
					text ='<?=__("visual_code",true)?>';
				}
				if(data == 2){
					text ='<?=__("required_fields",true)?>';
				}
				if(data == 3){
					text ='<?=__("email_sent",true)?>';
					
					$('#contactForm').clearForm();
					$('#contactForm').resetForm();
					$('#ContactPurpose').attr('value','0');
					
				}
				if(data == 4){
					text ='<?=__("valid_email",true)?>';
				}
				
				$('#msg').html(text);
				$('#msg').show();
				
				
				Recaptcha.reload();
			}
		};
			$('#contactForm').ajaxForm(options);
	 		$("#contactForm").addClass('requiredField');
});	
</script>



