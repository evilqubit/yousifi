<div id="banner_type_container">



<?php 


	$checked0='checked="checked"';
	$checked1='';
	$display="display: none;";
	$type=1;
	if(isset($this->request->data["Section"]['video_type'])){
		if($this->request->data["Section"]['video_type'] == 1){
			$checked0='checked="checked"';
			$checked1='';
			$type=1;
			
		}elseif($this->request->data["Section"]['video_type'] == 0){
			$checked0='';
			$checked1='checked="checked"';
			$type=0;
		}
	}
?>
	
	
<div class="control-group">
	<label class="control-label" for="JobPublish">Type</label>
	<div class="input_div" id="typeRadio">
		<input type="radio" onchange="update_video_type(1)" id="option10" name="data[Section][video_type]" value="1"  <?=$checked0?>  /><label for="option10">Youtube</label>
		<input type="radio" onchange="update_video_type(0)" id="option11" name="data[Section][video_type]" value="0" <?=$checked1?>  /><label for="option11">Video File</label>
	</div>
</div>
				
	
	
	
	
	<?php 
	$checked10='';
	$checked11='checked="checked"';
	$video_snap_shot_type='';
	
	if(isset($this->request->data["Section"]['youtube_image'])){
		if($this->request->data["Section"]['youtube_image'] == 1){
			$checked10='checked="checked"';
			$checked11='';
			$video_snap_shot_type=1;
			
		}elseif($this->request->data["Section"]['youtube_image'] == 0){
			$checked10='';
			$checked11='checked="checked"';
			$video_snap_shot_type=0;
			
		}
	}
?>
	
	
<div class="control-group">
	<label class="control-label" for="JobPublish">Use Video Snapped image</label>
	<div class="input_div" id="youtubeRadio">
		<input type="radio" onchange="update_video_snapp_type(1)"  id="option12" name="data[Section][youtube_image]" value="1"  <?=$checked10?>  /><label for="option12">Yes</label>
		<input type="radio" onchange="update_video_snapp_type(0)" id="option13" name="data[Section][youtube_image]" value="0" <?=$checked11?>  /><label for="option13">No</label>
	</div>
</div>			
				
<div class="control-group" id="youtube_link">
	<label class="control-label" for="JobPublish">Youtube ID</label>
	<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.youtube",array('type'=>'text' , 'class'=>'', 'escape' => false,'label'=>false));?></div>
	<div  style="clear: both; float: left; margin-left: 170px;">Please add only the youtube id that comes after the "V" in the URL.  https://www.youtube.com/watch?v=<span style="font-size: 15px; color: red;">zkxqRthhwIs</span></div>


	<?php 
	
	if(isset($this->request->data["$modelName"]['youtube']) && !empty($this->request->data["$modelName"]['youtube'])){
		$video_id=$this->request->data["$modelName"]['youtube'];
		?>
		<div class="input_row" style="clear: both; float: left; margin-left: 170px;">
			<div class="label">Youtube Snapshot Image</div>
			<a target="_blank" href="https://www.youtube.com/watch?v=<?=$video_id?>"> <img src="http://img.youtube.com/vi/<?=$video_id;?>/1.jpg" border="0" alt=""/></a>
		</div>
	<?php 
	}
	?>	
</div>			


<div class="control-group" id="video_file" style="display: block;">
	<label class="control-label" for="JobPublish">Video File</label>
	<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.video",array('type'=>'file' , 'class'=>'', 'escape' => false,'label'=>false));?></div>
	
	
	<?php 
	
	if(isset($this->request->data["$modelName"]['video']) && !empty($this->request->data["$modelName"]['video'])){
		$video_name=$this->request->data["$modelName"]['video'];
		?>
		<div class="input_row">
			<div class="label">Chosen vidoe</div>
			<!-- <img src="/files/banners/thumb/<?=$img?>" border="0" alt=""/> -->
			<a target="_blank" href="/" onclick="open_video('<?=$id?>'); return false;" > <?=$video_name?></a>
		</div>
		<?php 
	}
	?>
	
</div>


<div class="control-group" id="video_image">
		<label class="control-label" for="JobPublish">Video Image</label>
	
		<div class="input_div" style='float:left' ><?php echo $this->Form->input("$modelName.video_image",array('label'=>false,"type"=>"file","size"=>"43"));?>
			<div> Preferred size : <?=$video_preferred_size?></div>
			<div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div>
		</div>
	
	<?php if(isset($this->request->data[$modelName]["video_image"]) && !empty($this->request->data[$modelName]["video_image"])){ ?>
		<div class="input_row " style='float:left' >
			<div class="label">Chosen Image</div>
			<div class="input_div"><a href="/files/<?=$userFilesFolder?>/preview/<?php echo $this->request->data["$modelName"]["video_image"];?>" class='lightbox' ><img src="/files/<?=$userFilesFolder?>/thumb/<?php echo $this->request->data["$modelName"]["video_image"];?>" alt="" border="0" /></a></div>		
		</div>
	<?php } ?>
</div>	
	
</div>

<script type="text/javascript">	
	$("#typeRadio").buttonset();
	$("#youtubeRadio").buttonset();
	

	$(document).ready(function (){
		update_video_snapp_type('<?=$video_snap_shot_type?>');
		
		update_video_type('<?=$type?>');
		
		
	});
	
</script>

