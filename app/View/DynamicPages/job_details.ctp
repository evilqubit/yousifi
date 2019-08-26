
<?php

$text=$job_details['Job']['text'];
 ?>

<div class="floatClass jobDetailsText"><?=$text?></div>




<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">




	<?php echo $this->form->create('AppliedCv',array("url"=>array("controller"=>"Jobs","action"=>"upload_cv"),"id"=>"JobForm")); ?>

			<input name="data[AppliedCv][job_id]" type="hidden" value="<?=$id?>" />


			<div class="floatClass jobFormRow"><?php echo $this->form->input('first_name',
			array("class"=>"required  jobnput Input defaultInvalid","label"=>false,"escape"=>false
			 ,'id'=>'f_name' , 'placeholder'=>'First Name' )); ?>
			</div>


			<div class="floatClass jobFormRow"><?php echo $this->form->input('last_name',
			array("class"=>"required  jobnput Input defaultInvalid","label"=>false,"escape"=>false
			 ,'id'=>'l_name' , 'placeholder'=>'Last Name' )); ?>
			</div>

			<div class="floatClass jobFormRow"><?php echo $this->form->input('email',
			array("class"=>"required email  jobnput Input defaultInvalid","label"=>false,"escape"=>false
			 ,'id'=>'email' , 'placeholder'=>'Email' )); ?>
			</div>

			<div class="floatClass jobFormRow"><?php echo $this->form->input('phone',
			array("class"=>"required  jobnput number defaultInvalid","label"=>false,"escape"=>false
			 ,'id'=>'phone' , 'placeholder'=>'Phone Number' )); ?>
			</div>

		<div class="contact_recaptcha_details jobFormRow floatClass" id="recaptcha_container">
					<?php
					//if ($is_ajax){
						echo $this->element("recaptcha_ajax",array("className"=>"jobnput required",'width'=>"286px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#b5b5b5'));
					// }
					// else{
						// echo $this->element("recaptcha",array("className"=>"contactInput",'width'=>"215px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#b5b5b5'));
					// }

					?>
			</div>



			<div class="floatClass jobFormRow">
				<div class="input file">
					<div id="fileLabel"  class="fileLabel" >Upload your cv</div>
					<input onchange="update_file_field()" id="cv_file" class="required jobnput  defaultInvalid" type="file" placeholder="Upload your cv" name="data[AppliedCv][cv]">
				</div>
				</div>
			<!-- <div class="floatClass jobFormRow"><?php echo $this->form->input('cv',
			array("class"=>"required  jobnput number defaultInvalid","label"=>false, 'type'=>'file', "escape"=>false
			 ,'id'=>'cv_file' , 'placeholder'=>'Upload your cv' )); ?>
			</div> -->






		<div class="jobFormRow floatClass">
			<div class="submitBtn">
				<?php
				$send=__("SUBMIT",true);
				 echo $this->form->input($send, array('class'=>'floatClass JobSubmit' , 'type'=>'submit' ,'label'=>false , 'escape'=>false));  ?>
			 </div>
			 <div class="floatClass jobSubmitloader"><img src="/img/ajax-loader.gif" width="20" height="20" /></div>

		</div>
		<div id="msg" class="FormStatus" onclick="$('#msg').fadeOut();" style="display:none;"></div>
	<?php echo $this->form->end(); ?>


</div>


<script type="text/javascript">
function validation(){
	var text2='<?=__('This field is required',true)?>';
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, text2 );

	return $('#JobForm').valid();
}


function update_file_field(){

}



$(document).ready(function() {


		$("#cv_file").nicefileinput({
			label : 'Browse'
		});






		var options = {
			beforeSubmit: function(){
				$(".submitBtn").hide();
				$(".jobSubmitloader").show();
				var valid = validation();
					if (valid == 1){
						return true;
					}
					else{

						$(".submitBtn").show();
						$(".jobSubmitloader").hide();
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

					$('#JobForm').clearForm();
					$('#JobForm').resetForm();


				}
				if(data == 4){
					text ='<?=__("valid_email",true)?>';
				}
				if(data == 5){
					text ='<?=__("invalid_file_type",true)?>';
				}


				$('#msg').html(text);
				$('#msg').show();


				$(".submitBtn").show();
				$(".jobSubmitloader").hide();

				Recaptcha.reload();
			}
		};
			$('#JobForm').ajaxForm(options);
	 		$("#JobForm").addClass('requiredField');
});
</script>