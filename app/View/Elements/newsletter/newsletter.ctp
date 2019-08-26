<div class="floatClass newsletterMainBox">
	
	<div class="floatClass newsletterFirstTitle"><?=strtoupper(__("newsletterFirstTitle"))?></div>
	<div class="floatClass newsletterSecondTitle"><?=strtoupper(__("newsletterSecondTitle"))?></div>
	
	<div class="floatClass newsletterStatusMsg">
		<div id="msg" class="newsletterFormStatus"  onclick="$('#msg').fadeOut();"></div>
	</div>
	
	<div class="floatClass newsletterFormContainer">
		<form   enctype="multipart/form-data"   method="post" id="newsletter_Form" action="/Pages/register_newsletter"  >						
			
		<div class="newsLetterFieldContainer">	
			<?php $name=__("name",true); ?>
			
			<?php echo $this->form->input('newsletter.name',array("class"=>"newsletterFormInput defaultInvalid required domain","label"=>false,"escape"=>false
				 ,'id'=>'newsName' ,
					 "onfocus"=>"change_default('newsName','$name',this.value,false);",
					 "onblur"=>"change_default('newsName','$name',this.value,true);",
					 "value"=>$name
				
				)); ?>
				
				
			<!-- <input class="newsletterFormInput defaultInvalid required"  placeholder="<?=strtoupper($name)?>"  name="data[newsletter][name]" type="text" /> -->
		</div>
		<div class="newsLetterFieldContainer">	
			<?php $email=__("email",true); ?>
			
			
			<?php echo $this->form->input('newsletter.email',array("class"=>"newsletterFormInput email defaultInvalid required","label"=>false,"escape"=>false
				 ,'id'=>'newsEmail' ,
					 "onfocus"=>"change_default('newsEmail','$email',this.value,false);",
					 "onblur"=>"change_default('newsEmail','$email',this.value,true);",
					 "value"=>$email
				
				)); ?>
				
				
			
		</div>	
			
			
		<div class="newsletterSubmitBtnContainer">
			<?php
			$subscribe=__("subscribe",true);
			 ?>
			<div style="display: none; float: right;" id="jobAjaxBtn"><img  alt="ajaxloader" src="/img/ajax-loader.gif" width="20" height="20" /></div>
			<input type="submit" class="newsletterSubmitBtn" value="<?=$subscribe?>" />
			
		</div>
		</form>
	</div>
	
	
					
					
</div>
					
				
		





<script type="text/javascript">


function validation(){
	
	var text2='<?=__('This field is required',true)?>';
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, text2 );
	
	return $('#newsletter_Form').valid();
}


function text(){
	var text1='<?=__('Enter A valid name',true)?>';
//	jQuery.validator.addMethod("domain", function(value, element) {
//	  return this.optional(element) ||  /^[A-Za-z]+$/.test(value)
//	}, text1);
	
	return $('#newsletter_Form').valid();
}
 
	
	
$(document).ready(function() {
	
	
	
		var options = {
			beforeSubmit: function(){
				$(".newsletterSubmitBtn").hide();				
				$("#jobAjaxBtn").show();
				var valid = validation();
				
				
				var v=text();
				
				
				if (valid == 1  && v == 1){
					return true;
				}
				else{
					
					$(".newsletterSubmitBtn").show();				
					$("#jobAjaxBtn").hide();
					return false;
				}
					
				
			},
			resetForm: false,
			success:function(data){
				$(".newsletterSubmitBtn").show();				
				$("#jobAjaxBtn").hide();	
				var msg='';
				
				data=parseInt(data);
				
				switch(data)
				{
				case 1:
				  msg='<?=__("newsletter_msg_1",true);?>'
				  break;
				  
				 case 2:
				  msg='<?=__("newsletter_msg_2",true);?>'
				  break;
				case 3:
				  msg='<?=__("newsletter_msg_3",true);?>'
				  break;
				  case 4:
				  msg='<?=__("newsletter_msg_4",true);?>'
				  break;
				  case 5:
				  msg='<?=__("newsletter_msg_5",true);?>'
				  break;
				   case 6:
				  msg='<?=__("newsletter_msg_6",true);?>'
				  break;
				  case 7:
				  msg='<?=__("newsletter_msg_7",true);?>'
				  break;
				  case 8:
				  msg='<?=__("newsletter_msg_8",true);?>'
				  break;
				  case 9:
				  msg='<?=__("newsletter_msg_9",true);?>'
				  break;
				  case 10:
				  msg='<?=__("newsletter_msg_10",true);?>'
				  break;
				  case 11:
				  msg='<?=__("newsletter_msg_11",true);?>'
				  break;					
				}
				
				if(data == 10){							
					$('#newsletter_Form').clearForm();
					$('#newsletter_Form').resetForm();					
				}
				
				$('#msg').html(msg);
				$('#msg').show();
				//Recaptcha.reload();
				
				
			}
		};
			$('#newsletter_Form').ajaxForm(options);
	 		$("#newsletter_Form").addClass('requiredField');
});	
</script>
