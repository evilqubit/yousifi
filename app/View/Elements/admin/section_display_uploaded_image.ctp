<?php
$img = $data["Image"]['image'];
$imgId = $data["Image"]['id'];
?>




<fieldset class="FloatClass" style="margin-right:10px;margin-bottom:10px; width: 220px; float:left" id="imgDiv<?php echo $imgId;?>">
<legend><?php echo $img;?></legend>
	<span id="current_image_<?php echo $imgId;?>">
		<div class="FloatClass" style="width:250px;height:145px;overflow:hidden"><a class="FloatClass lightbox" href="/files/<?=$folderName?>/preview/<?=$img?>" ><img src="/files/<?=$folderName?>/thumb/<?=$img?>" border="0" alt=""   height='163' /></a></div>
	</span>
		
	
	<input type="hidden" name="data[Image][<?php echo $imgId;?>][id]" value="<?php echo $imgId;?>" />
	
	<div class="FloatClass" style="width:210px;">
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
			//print_r($data);exit;
			foreach ($languages as $l){
				$language=$l['Language']["language"];
				$code=$l['Language']["code"];
				$lang_id=$l['Language']["id"];
				$locale=$l['Language']["locale"];
				$dir=$l['Language']['direction'];
				$required="input_field";
				
				$img_title = $data["Image"]['title'][$locale];
				$img_caption = $data["Image"]['caption'][$locale];
				
				$url = $data["Image"]['url'];
				
				// $value=0;
				// $checked='';
				// if($home_page == 1){
					// $value=1;
					// $checked='checked';
				// }				
		    ?>
		    <div class="fields_lang_pane" id="<?=$locale?>" style="width:225px;">
		    	<div class="input_row" style="width:200px;"><div class="label">Title</div><div class="input_div"><input type="text" name="data[Image][<?php echo $imgId;?>][title][<?php echo $locale;?>]" value="<?php echo $img_title;?>" class="input_field imageTitleField<?php echo $locale;?>" style="width:200px" /></div></div>
		    	<div class="input_row" style="width:200px;"><div class="label">Caption</div><div class="input_div"><textarea name="data[Image][<?php echo $imgId;?>][caption][<?php echo $locale;?>]" class="input_field" style="width:200px"  ><?php echo $img_caption;?></textarea></div></div>
		    </div>
		    
		    <?php } ?>
		    
		    
		  </div>
		  
		  	<div class="input_row" style="width:200px;"><div class="label">URL</div><div class="input_div"><input type="text" name="data[Image][<?php echo $imgId;?>][url]" value="<?php echo $url;?>" class="input_field imageUrl" style="width:200px" /></div></div>
		   	
		 
			<?php 
			$delete_url="/admin/Images/delete_section_image/$imgId/$folderName";
			?>
			<div class="FloatClass" style="width:200px;"><a href="/admin/images/delete_section_image/<?=$imgId?>/<?=$folderName?>" class="FloatClass" onclick="removeSelectedImg('<?=$delete_url?>','<?=$imgId?>');return false;" style="cursor:pointer;clear:both;"><b>X delete image</b></a></div>
		
			<?php //echo $this->element("admin/upload_new_image",array("albumId"=>$albumId,"album_type"=>$album_type,"current_folder"=>$current_folder,"imgId"=>$imgId ,"preferred_size"=>$preferred_size)); ?>
		  
		  
		</div>
</fieldset>


<!-- <div id="tabs">
<ul>
<li><a href="#tabs-1">Nunc tincidunt</a></li>
<li><a href="#tabs-2">Proin dolor</a></li>
<li><a href="#tabs-3">Aenean lacinia</a></li>
</ul>
<div id="tabs-1">
<p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
</div>
<div id="tabs-2">
<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
</div>
<div id="tabs-3">
<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
</div>
</div> -->

<script type="text/javascript">

$(document).ready(function() {
	//$("#tabs").tabs();
	setTimeout(function(){  $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'}); }, 8000);
  
    
 });
 
	function update_checkBox(id){
		
		if($('#'+id).is(':checked')){
			$('#'+id).val(1);
		}else{
			$('#'+id).val(2);
			//$('#'+id).removeAttr('checked');
		}
		
	}
</script>