<div class="maintitle">Videos</div>
<div class="subtitle">Edit Video</div>

<?php echo $this->form->create('Video',array('type'=>'file','url'=>array('controller'=>'Videos','action'=>'admin_edit',$id),'id'=>'PageForm'));?>
	
	<?php 
		if($type == 'server'){?>
			<div class="input_row" id="server_div" >	
				<div class="label">Videos</div>	
				<div class="input_div">
				<?php 
					echo Configure::read('WEBSITE_URL').'/files/videos/files/flv';
					echo $this->form->input("video_server",array("options"=>$server_videos_list,'size'=>10,"escape"=>false,"label"=>false,'selected'=>$selected, "style"=>"width:400px;height:200px;font-size:11px;border:1px solid;"));
				?>
				</div>
			</div>
			<div class="input_row">
				<div class="label">Snapshot Image</div>
				<img src="/files/<?=$folderName?>/thumb/<?=$img?>" border="0" alt=""/>
			</div>
			
		<?php }elseif($type == 'url'){?>
			<div id="youtub_div" >
				<div class="input_row">Youtube URL should be in the following format: http://www.youtube.com/embed/youtube_id</div>
				<div class="input_row">
					<div class="label">Video URL(Youtube)</div>
					<div class="input_div"><?php echo $this->form->input("video_url",array('label'=>false,'class'=>"url youtube"));?></div>
				</div>
			</div>
			<div class="input_row">
				<div class="label">Snapshot Image</div>
				<img src="http://img.youtube.com/vi/<?=$youtube_id;?>/1.jpg" border="0" alt=""/>
			</div>
			
			
		<?php }elseif($type == 'file'){?>
			<div class="input_row" id="file_div">
				<div class="input_row">
					<div class="label">Video File</div>
					<div class="input_div"><?php echo $this->form->input("video",array('type'=>'file','label'=>false));?></div>
				</div>
				<div class="label" style="clear: both;">Chosen Video file name  :</div>
				<div class="input_div" ><?=$data["$modelName"]['video']?></div>
			</div>
			
			<div class="input_row">
				<div class="label">Snapshot Image</div>
				<img src="/files/<?=$folderName?>/thumb/<?=$img?>" border="0" alt=""/>
			</div>
		<?php }
	?>
	
	
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
				<div class="input_div"><?php echo $this->form->input("Video.caption.$locale",array('label'=>false,'class'=>"$required","dir"=>"$dir"));?></div>
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
function isValidURL(url){
  
    var RegExp = /(http):\/\/(www.youtube.com\/embed\/)([0-9A-Za-z]){3,}/;

    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
}
	
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