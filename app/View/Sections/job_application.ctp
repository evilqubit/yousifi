<div class="row leasing" style="min-height: 700px;">
	<div class="hold" style="position: relative; z-index: 1">
		<div class="right-info style-2" style="padding: 0px; background: none;">
			<!-- <div class="holder">
				<h3><span class="line-1">are</span><span class="line-2">you</span><span class="line-3">in<em>?</em></span></h3>
			</div> -->
			<?php
			if(!empty($images_list)){
				foreach($images_list as $im){
					$title=$im['Image']['title'];
					$image=$im['Image']['image'];
					
					$url=$im['Image']['url'];
					$image="/files/sections/preview/$image";
					$aStart="";
					$aEnd="";
					if(!empty($url)){
						$aStart="<a style='display:block;' href='$url'>";
						$aEnd="</a>";
					}
					
					
					if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
					        $url = "http://" . $url;
					    }
					
					?>
					<?php echo $aStart; ?>
						<img src="<?=$image?>" alt="<?=$title?>">
					<?php echo $aEnd;?>
					<?php 
				}
			}
			 ?>
		</div>
	</div>
	<div class="info">
		
		<?php
		$title=$job_details["Job"]['title'];
		$text=$job_details["Job"]['text'];
		
		 ?>
		<h2><?=$title?></h2>
		<p><?=$text?></p>
		
		<div style="clear:both;float:left">
			<form type='file'  enctype="multipart/form-data"   method="post" id="jobForm" action="/Jobs/upload_cv/<?=$job_id?>"  >
				<input type="hidden" name="data[AppliedCv][job_id]" value="<?=$job_id?>" />
				<div class="block">
					<fieldset>
						<label>First Name</label>
						<input required name="data[AppliedCv][first_name]" type="text">
					</fieldset>
					<fieldset>
						<label>Last Name</label>
						<input required name="data[AppliedCv][last_name]" type="text">
					</fieldset>
					<fieldset>
						<label>e-mail</label>
						<input required type="mail" name="data[AppliedCv][email]">
					</fieldset>
					<fieldset>
						<label>Phone Number</label>
						<input required name="data[AppliedCv][phone]" type="text">
					</fieldset>
					<fieldset>
						<label>Resume</label>
						<input id="file-1" type="file" name="data[AppliedCv][cv]"><label for="file-1" class="file"></label>
					</fieldset>
					
					
					<div class="contact_recaptcha_details floatClass" id="recaptcha_container" style="clear: both; float: left;">
							<?php 
							
								echo $this->element("recaptcha",array("className"=>"contactInput",'width'=>"290px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#b5b5b5'));
							
							?>
					</div>
					
					
				</div>
				
				<div class="btns">
					<div style="display: none; float: right;" id="jobAjaxBtn"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
					<button class="btn btn-success" type="submit" id="jobSubmitBtn">submit</button>
					<button class="btn btn-grey" id="jobRestBtn" type="reset">clear</button>
				</div>
			</form>
		</div>
		
		<div id="msg" class="FormStatus col-lg-12 col-md-12 col-sm-12 col-xs-12 " onclick="$('#msg').fadeOut();" style="display:none; float:right; text-align: right; margin-top: 20px; clear:both; color: #11b3c0;1px solid #bbbbbb; font-size: 20px;"></div>
		
	</div>
</div>
			




<script type="text/javascript">
function validation(){
	var text2='<?=__('This field is required',true)?>';
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, text2 );
	
	return $('#jobForm').valid();
}

 
	
	
$(document).ready(function() {
	
	
	
		var options = {
			beforeSubmit: function(){
				// var valid = validation();
					// if (valid == 1){
						// return true;
					// }
					// else{
						// return false;
					//}
					
				$("#jobSubmitBtn").hide();
				$("#jobRestBtn").hide();
				$("#jobAjaxBtn").show();
			},
			resetForm: false,
			success:function(data){
				$("#jobSubmitBtn").show();
				$("#jobRestBtn").show();
				$("#jobAjaxBtn").hide();
				
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
				
				
				
				if(data == 3){
					
					$('#jobForm').clearForm();
					$('#jobForm').resetForm();
					
				}else{
					
				}
				
				$('#msg').html(msg);
				$('#msg').show();
				
				//Recaptcha.reload();
				
				
			}
		};
			$('#jobForm').ajaxForm(options);
	 		$("#jobForm").addClass('requiredField');
});	
</script>
