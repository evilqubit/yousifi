<div style="clear: both; float: left">
	<div class="input_row" >
		<div class="label lang_bar" style="cursor:pointer; text-align: center;" onclick="$('#templates_div').slideToggle()">Choose  Template</div>
	</div>
	
	<div id="templates_div" class="input_div" style="width:800px;clear:both;display:none;">
		
		
		<?php 
		//print_r($landingPageSetting);exit;
		
		// if(isset($show_inherite) && ($show_inherite == 1)){ 
// 			
			// if($templateActionType == 'add'){
				// $checked31='checked="checked"';
				// $checked32='';
// 				
			// }else{
// 				
					// $checked31=0;
					// $checked32=0;
					// if($this->request->data["$modelName"]['inherit_parent_template'] == 1){
						// $checked31='checked="checked"';
						// $checked32='';
					// }elseif($this->request->data["$modelName"]['inherit_parent_template'] == 0){
						// $checked31='';
						// $checked32='checked="checked"';
// 						
					// }
// 					
// 				
// 				
			// }
			
			?>
			<!-- <div class="input_row" style="clear: both; width: 900px;margin-bottom: 20px;">
				<div class="label">Template inherited : </div>
				<div class="input_div" id="templateInheriteRadio">
					<input type="radio" id="option131" name="data[<?php echo $modelName;?>][inherit_parent_template]" value="1"  <?=$checked31?> /><label for="option131">Yes</label>
					<input type="radio" id="option130" name="data[<?php echo $modelName;?>][inherit_parent_template]" value="0"  <?=$checked32?> /><label for="option130">No</label>
				</div>
			</div> -->
		<?php //} ?>
		
		
		<?php
			
			$index=0;
			foreach($templates as $key=>$template){
				
				$previewLocation="/img/templates/preview/$key.png";
				$thumbLocation="/img/templates/thumb/$key.png";
				
				// if($templateActionType == 'add'){
					// if($index == 0){
						// $selected = "checked = 'checked'";
					// }else{
						// $selected = "";
					// }
					// $index++;
// 					
				// }elseif($templateActionType == 'edit'){	
					// if($content_template_type == $key){
						// $selected = "checked = 'checked'";
					// }else{
						// $selected = "";
					// }
				// }
				
				$selected = "";
				if($selected_template == $key){
					$selected = "checked = 'checked'";
				}
				
				
				
				
				
				
				
				//$onchange="updateTemplateRelatedImage(\"$key\")";
				$onchange="";
				echo "<div class='FloatClass' style='width:300px;height:auto;  margin-bottom: 20px;'>";
					echo "<input onchange='$onchange' type='radio' id='Template$key' name = 'data[$modelName][template_id]' $selected value= '$key' />";
					echo "<label for='Template$key'>$template<br/>";
						
					echo "<a href='$previewLocation' class='lightbox'><img src='$thumbLocation' alt='' border='0' /></a></label>";
					
				echo "</div>";
			}
		?>
	</div>
</div>



<script type="text/javascript">

$(document).ready(function() {
	
	
	$("#templateInheriteRadio").buttonset();
	$("#directoryUrlRadio").buttonset();
	
	
});
</script>