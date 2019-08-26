
<?php

if(!isset($image_box_id)) {
	$image_box_id='';
}

?>

<div class="control-group" id="<?=$image_box_id?>" >
	<label class="control-label" for="JobPublish" id="subject_image_label">
		<?php
		$upload_label='Icon';
		if(isset($title) && !empty($title)){
			$upload_label=$title;
		}			
		echo $upload_label;
		?>			
	</label>

	<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.image",array( 'id'=>'current_image', 'label'=>false,"type"=>"file","size"=>"43"));?>
		<div id="preferred_size_1"> Preferred size : <?=$preferred_size?></div>
		<div id="preferred_size_2" style="display: none"> Preferred size : <?php
		
		if(isset($preferred_size_3)){
			echo $preferred_size_3;
		}
		
		
		?></div>
		<!-- <div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div> -->
	</div>
	
	<?php if(isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"])){ ?>
		<div class="input_row " style='float:left' >
			<div class="label">Chosen Image</div>
			<div class="input_div"><a href="/files/<?=$userFilesFolder?>/original/<?php echo $this->request->data["$modelName"]["image"];?>" class='lightbox' ><img src="/files/<?=$userFilesFolder?>/thumb/<?php echo $this->request->data["$modelName"]["image"];?>" alt="" border="0" /></a></div>		
		</div>
	<?php } ?>
</div>	
