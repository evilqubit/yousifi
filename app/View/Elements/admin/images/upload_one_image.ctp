<div class="control-group">
	<label class="control-label" for="JobPublish">
		<?php
		$upload_label='Image';
		if(isset($title) && !empty($title)){
			$upload_label=$title;
		}
		echo $upload_label;

		$required_class='';
		if(isset($required) && ($required == 1)){
			$required_class='required';
		}
		?>
	</label>

	<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.image",array( 'id'=>'current_image',  'class'=>"$required_class", 'label'=>false,"type"=>"file","size"=>"43"));?>
		<div id="preferred_size_1"> Preferred size : <?=$preferred_size?></div>
		<div id="preferred_size_2" style="display: none"> Preferred size : <?php

		if(isset($preferred_size_3)){
			echo $preferred_size_3;
		}
		?></div>
		<!-- <div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div> -->
	</div>



	<?php if(isset($this->request->data[$modelName]["image"]) && !empty($this->request->data[$modelName]["image"])){ ?>
		<div class="input_row " style='float:left;clear:both;margin-left:120px;margin-top:20px;' >
			<div class="label">Chosen Image</div>
			<div class="input_div"><a href="/files/<?=$userFilesFolder?>/original/<?php echo $this->request->data["$modelName"]["image"];?>" class='lightbox' ><img src="/files/<?=$userFilesFolder?>/thumb/<?php echo $this->request->data["$modelName"]["image"];?>" alt="" border="0" /></a></div>
		</div>

		<div class="input_row " style='float:left;clear:both;margin-left:120px;' >
			<?php //echo $this->form->input("$modelName.delete_image",array("type"=>"checkbox","label"=>"Delete Image")); ?>
		</div>

	<?php } ?>




</div>
