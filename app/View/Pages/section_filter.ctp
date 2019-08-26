<?php 
if(!empty($category_list)){
?>
	
		<label>Select <?=$search_title?></label>
		<span id="crf-s-3" class="crf-s">
			<select  class="hided-s"  name="data[Search][category_id]" class="hided-s" style="display: none;">
				<option value="">All <?=$search_title?></option>
				<?php 
				foreach($category_list as $key=>$category ){
				?>
					<option value="<?=$key?>"><?=$category?></option>
				
				<?php
				}
				 ?> 
			</select>
			<span class="option">All <?=$search_title?></span>
		</span>
	



<div style="display: none;" id="footerSelectContent">
	
	
	
	<div data-id="crf-s-3" class="crf-sm hided-s new_content new_content_flag" style="display: none; position: absolute; left: 557.5px; top: 166px; width: 232px;"><ul>
		<li class=""><span class="link">All <?=$search_title?></span></li>
		
		
	<?php 		
				foreach($category_list as $key=>$category ){
				?>
					<li class=""><span class="link"><?=$category?></span></li>
				
				<?php
				}
				 ?> 
				 
			 </ul>
	</div>
</div>	
<?php 
}
?>

<script>
$(document).ready(function(){	
	$(".new_content").not(".new_content_flag").remove();
	$(".new_content").removeClass("new_content_flag");
	$('body').append($("#footerSelectContent").html());
	
});
	
</script>












