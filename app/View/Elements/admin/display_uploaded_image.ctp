<?php
$img = $data["Image"]['image'];
$imgId = $data["Image"]['id'];
$albumId = $data["Image"]['album_id'];

?>
<fieldset class="FloatClass" style="margin-right:10px;margin-bottom:10px;" id="imgDiv<?php echo $imgId;?>">
<legend><?php echo $img;?></legend>
	<span id="current_image_<?php echo $imgId;?>">
		<div class="FloatClass" style="width:100px;height:145px;overflow:hidden"><a class="FloatClass lightbox" href="/files/<?=$folderName?>/preview/<?=$img?>" ><img src="/files/<?=$folderName?>/thumb/<?=$img?>" border="0" alt="" width="90" /></a></div>
	</span>
		
	
	<input type="hidden" name="data[Image][<?php echo $imgId;?>][id]" value="<?php echo $imgId;?>" />
	
	<div class="FloatClass" style="width:225px;">
		<div class="fields_lang_tabs" style="width:225px;">
		<?php foreach ($languages as $l){ 
			$language=$l['Language']["language"];
			$locale=$l['Language']["locale"];
		?>
		<span><a href="#<?=$locale?>"><?php echo $language;?></a></span>
		<?php }?>
		</div>
		<div class="fields_lang_panes" style="margin-bottom:20px;width:225px;">
			<?php
			foreach ($languages as $l){
				$language=$l['Language']["language"];
				$code=$l['Language']["code"];
				$lang_id=$l['Language']["id"];
				$locale=$l['Language']["locale"];
				$dir=$l['Language']['direction'];
				$required="input_field";

				$img_title = $data["Image"]['title'][$locale];
				$img_caption = $data["Image"]['caption'][$locale];
				
				
		    ?>
		    <div class="fields_lang_pane" style="width:225px;">
		    	<div class="input_row" style="width:200px;"><div class="label">Title</div><div class="input_div"><input type="text" name="data[Image][<?php echo $imgId;?>][title][<?php echo $locale;?>]" value="<?php echo $img_title;?>" class="input_field imageTitleField<?php echo $locale;?>" style="width:200px" /></div></div>
		    	<div class="input_row" style="width:200px;"><div class="label">Caption</div><div class="input_div"><textarea name="data[Image][<?php echo $imgId;?>][caption][<?php echo $locale;?>]" class="input_field" style="width:200px"  ><?php echo $img_caption;?></textarea></div></div>
		    </div>
		    <?php } ?>
		  </div>
		  
	
		<div class="FloatClass" style="width:225px;"><a href="/admin/images/delete/<?=$imgId?>/<?=$folderName?>" class="FloatClass" onclick="removeImg(<?=$imgId?>,'<?=$folderName?>');return false;" style="cursor:pointer;clear:both;"><b>X delete image</b></a></div>
		
		<?php //echo $this->element("admin/upload_new_image",array("albumId"=>$albumId,"album_type"=>$album_type,"current_folder"=>$current_folder,"imgId"=>$imgId ,"preferred_size"=>$preferred_size)); ?>
		  
		  
		</div>
</fieldset>