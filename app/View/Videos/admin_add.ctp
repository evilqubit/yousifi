<div class="maintitle">Videos</div>
<div class="subtitle">Add Video</div>

<?php echo $this->form->create('Video',array('type'=>'file','url'=>array('controller'=>'Videos','action'=>'admin_add'),'id'=>'PageForm'));?>
	
	<div class="input_row">
		<div class="label">How would you like to add the Video file?</div>
		<div class="input_div"><?php echo $this->form->input("Video.type",array('type'=>'select','onchange'=>'typeChanged(this)','label'=>false,'options'=>array('server'=>'Choose From Server','file'=>'Upload Video File','url'=>'YouTube URL'),'selected'=>'server'));?></div>
	</div>
	
	<div id="youtub_div"  style="display: none;">
		<div class="input_row">Youtube URL should be in the following format: http://www.youtube.com/embed/youtube_id</div>
		<div class="input_row">
			<div class="label">Video URL(Youtube)</div>
			<div class="input_div"><?php echo $this->form->input("Video.video_url",array('label'=>false,'class'=>"required url youtube"));?></div>
		</div>
	</div>
	
	<div class="input_row" id="file_div" style="display: none;">
		<div class="input_row">
			<div class="label">Video File</div>
			<div class="input_div"><?php echo $this->form->input("Video.video",array('type'=>'file','label'=>false));?></div>
		</div>
	</div>
	
	<div class="input_row" id="server_div" >	
		<div class="label">Videos</div>	
		<div class="input_div">
		<?php 
			echo Configure::read('WEBSITE_URL').'/files/videos/files/flv';
			echo $this->form->input("video_server",array("options"=>$server_videos_list,'size'=>10,"escape"=>false,"label"=>false,"style"=>"width:400px;height:200px;font-size:11px;border:1px solid;"));
		?>
		</div>
	</div>


<div id="common_fields" style="float:left;clear:both;margin-top:20px;">
	<!--here goes the languages tabs for all the page types fields-->
	<div class="fields_lang_tabs">
		<?php foreach ($languages as $l){ 
		    $language=$l['Language']["language"];
	    ?>
			<span><a href="#"><?php echo $language;?></a></span>
		<?php }?>
	</div>
	<!--end-->
	<!--here goes the multilingual fields form inputs for all the page types-->
	<div class="fields_lang_panes" style="margin-bottom:20px;">
		<?php
	 	foreach ($languages as $l){ 
		    $language=$l['Language']["language"];
	        $code=$l['Language']["code"];
	        $lang_id=$l['Language']["id"];
	        $locale=$l['Language']["locale"];
	        $dir=$l['Language']['direction'];
	        if($lang_id==1)	$required="required";
	        else	$required="input_field";
	        
	    ?>
	    <div class="fields_lang_pane">
			<div class="input_row">
				<div class="label">Title</div>
				<div class="input_div"><?php echo $this->form->input("Video.title.$locale",array('label'=>false,'class'=>"$required","dir"=>"$dir"));?></div>
			</div>
			
			<div class="input_row">
				<div class="label">Caption</div>
				<div class="input_div"><?php echo $this->form->input("Video.caption.$locale",array('label'=>false,'class'=>"can-be-empty","dir"=>"$dir"));?></div>
			</div>
		</div>
		<?php }?>
	</div>
	<!--end-->
</div>

<?php 
	echo $this->element("admin/seo_box",array("languages"=>$languages,"modelName"=>"$modelName","fieldId"=>0));
?>

<div class="input_row">
	<div class="submit_div"><?php echo $this->form->submit('Save',array('class'=>'submit_btn'));?>
</div>
<?php echo $this->form->end();?>

<script type="text/javascript">
$(document).ready(function(){
	
	$.validator.addMethod("youtube", function(value, element) {
			var match = isValidURL(value);
            return match;
        }, "* URL should be in the above format.please try again");
	
    $("#PageForm").validate();
    
    
     /*tabs*/
    $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
    $(".page_types_tabs").tabs(".page_types_panes > div",{effect: 'fade'});
    $(".lang_page_type_tabs").tabs(".lang_page_type_panes > div",{effect: 'fade'});
    /*end tabs*/
  
});

</script>