<div class="control-group">
			<label class="control-label" for="JobPublish">Image</label>
		
			<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.image.".$local,array('label'=>false,"type"=>"file","size"=>"43"));?>
				<div> Preferred size : <?=$preferred_size?></div>
				<div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div>
			</div>
		
		<?php if(isset($this->request->data[$modelName]["image"][$local]) && !empty($this->request->data[$modelName]["image"][$local])){ ?>
			<div class="input_row " style='float:left' >
				<div class="label">Chosen Image</div>
				<div class="input_div"><a href="/files/<?=$userFilesFolder?>/original/<?php echo $this->request->data["$modelName"]["image"][$local];?>" class='lightbox' ><img src="/files/<?=$userFilesFolder?>/thumb/<?php echo $this->request->data["$modelName"]["image"][$local];?>" alt="" border="0" /></a></div>		
			</div>
		<?php } ?>
	</div>	