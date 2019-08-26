<style type="text/css">
	.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
		background-color: transparent !important;		
		border: none !important;
		padding: 0px;
		width: 290px !important;
		position: absolute;
		z-index: 9999;
		left: 0px;
		padding-left: 10px;
	}
	.ui-multiselect-menu ui-widget ui-widget-content ui-corner-all {
		width: 264px !important;
	}
	
	.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button {
		width: 15px !important;
		top: -10px !important;
		margin-right: 5px;
		height: 25px;
	}
	
	
	.ui-multiselect-checkboxes .ui-corner-all span{
		color: #848484;
	    font-size: 14px;
	    font-family: "DINPro";
	    line-height: 14px;
	}
	.ui-state-hover {
		border: none;
		outline: none;
		text-decoration: none;
	}
	.ui-corner-all ui-state-hover {
		border: none !important;
		outline: none !important;
		text-decoration: none !important;
	}
	.ui-corner-all input {
		text-decoration: none;
	}
	.ui-multiselect-checkboxes label {
		padding: 0px;
	}
	.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
		color: #848484;
		font-size:14px;
		font-family:"DINPro";
	}
</style>


<div class="row leasing">
	<div class="hold">
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
			$title=$section_details['Section']['internal_title'];
			$text=$section_details['Section']['text_1'];
			
		?>
		<h2><?=$title?></h2>
		<p><?=$text?></p>
		
		
		<form type='file'  enctype="multipart/form-data"   method="post" id="leasingForm" action="/LeasingRelatedEntries/save_contact/"  >
			<div class="block">
				<fieldset>
					<label>Name</label>
					<input required name="data[LeasingApplication][name]" type="text">
				</fieldset>
				<fieldset>
					<label>e-mail</label>
					<input required type="mail" name="data[LeasingApplication][email]">
				</fieldset>
				<fieldset>
					<label>Phone Number</label>
					<input   type="text" name="data[LeasingApplication][phone]">
				</fieldset>
				<fieldset>
					<label>Mobile Number</label>
					<input required type="text" name="data[LeasingApplication][mobile]">
				</fieldset>
				<fieldset>
					<label>Fax</label>
					<input type="text" name="data[LeasingApplication][fax]">
				</fieldset>
			</div>
			<div class="block space">
				<fieldset class="clear">
					<label>Type of space required</label>
					<select  name="data[LeasingApplication][space_type_id]">
						<?php
						foreach($type_of_space_list as $key=>$type){
							?>
							
							<option value="<?=$key?>" ><?=$type?></option>
							<?php 
						}
						 ?>
						
					</select>
				</fieldset>
				<fieldset>
					<label>Business type</label>
					
					<select  name="data[LeasingApplication][business_type_id]">
						<?php
						foreach($business_of_space_list as $key=>$type){
							?>
							
							<option value="<?=$key?>" ><?=$type?></option>
							<?php 
						}
						 ?>
						
					</select>
						
					
				</fieldset>
				<fieldset>
					<label>&nbsp;</label>
					<input type="text" name="data[LeasingApplication][business_type]">
				</fieldset>
				<fieldset>
					<label>Shop/Stand Name</label>
					<input required type="text" name="data[LeasingApplication][shop_name]">
				</fieldset>
				<fieldset>
					<label>Space Required (sqm)</label>
					<input required type="text" name="data[LeasingApplication][space_required]">
				</fieldset>
				<fieldset>
					<label>Mall</label>
					<select id="Basic"  multiple="multiple" required  name="data[LeasingApplication][branch_id][]">
						<?php
						foreach($branches as $key=>$type){
							?>
							
							<option value="<?=$key?>" ><?=$type?></option>
							<?php 
						}
						 ?>
						
					</select>
				</fieldset>
				<fieldset>
					<label>Company Profile</label>
					<input required id="file-1" name="data[LeasingApplication][profile]" type="file"><label for="file-1"  class="file"></label>
				</fieldset>
				<fieldset>
					<label>Website link if any</label>
					<input type="text" name="data[LeasingApplication][website]">
				</fieldset>
				
				
				<div class="contact_recaptcha_details floatClass" id="recaptcha_container" style="clear: both; float: left;">
					<?php 						
						echo $this->element("recaptcha",array("className"=>"contactInput",'width'=>"290px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#b5b5b5'));						
					?>
				</div>
					
			</div>
			<div class="btns">
				
				<div style="display: none; float: right;" id="LeasingAjaxBtn"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
				<button class="btn btn-success" type="submit" id="leasingjobSubmitBtn">submit</button>
				<button class="btn btn-grey" id="jobRestBtn" type="reset">clear</button>
					
			</div>
		</form>
		<div id="msgleasingjobSubmitBtn" class="FormStatus col-lg-12 col-md-12 col-sm-12 col-xs-12 " onclick="$('#msgleasingjobSubmitBtn').fadeOut();" style="display:none; float:right; text-align: right; margin-top: 20px; clear:both; color: #11b3c0;1px solid #bbbbbb; font-size: 20px;"></div>
	
	</div>
	
		
</div>





<script type="text/javascript">
function validation(){
	var text2='<?=__('This field is required',true)?>';
	jQuery.validator.addMethod("defaultInvalid", function(value, element) {
		return value != element.defaultValue;
	}, text2 );
	
	return $('#leasingForm').valid();
}

 
	
	
$(document).ready(function() {
	
	 $("#Basic").multiselect({
	 	
	 	
	 	header: false,
	 	noneSelectedText : "Select Branch" ,
	 	 multiple: true

	 });
	
		var options = {
			beforeSubmit: function(){
				// var valid = validation();
					// if (valid == 1){
						// return true;
					// }
					// else{
						// return false;
					//}
					
				$("#leasingjobSubmitBtn").hide();
				$("#jobRestBtn").hide();
				$("#LeasingAjaxBtn").show();
			},
			resetForm: false,
			success:function(data){
				$("#leasingjobSubmitBtn").show();
				$("#jobRestBtn").show();
				$("#LeasingAjaxBtn").hide();
				
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
				  msg='<?=__('email_sent',true);?>'
				  break;
				default:
				  break
				}
				
				
				if(data == 3){
					$('#leasingForm').clearForm();
					$('#leasingForm').resetForm();
				}
				
				
				
				
				$('#msgleasingjobSubmitBtn').html(msg);
				$('#msgleasingjobSubmitBtn').show();
				
				//Recaptcha.reload();
				
				
			}
		};
			$('#leasingForm').ajaxForm(options);
	 		$("#leasingForm").addClass('requiredField');
});	
</script>


