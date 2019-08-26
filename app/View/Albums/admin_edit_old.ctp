<div class="maintitle"><?php echo $page_title;?></div>
<div class="subtitle">Edit <?php echo $page_sub_title;?></div>

<?php echo $this->form->create('Album',array('type'=>'file','url'=>array('controller'=>'Albums','action'=>'admin_edit',$id),'id'=>'PageForm'));?>
	<?php echo $this->element("/admin/upload_images",array("albumId"=>$id ,"chosen_images"=>$chosen_images ,"album_type"=>$album_type,"preferred_size"=>$preferred_size)); ?>
	


<?php if($type == 'home'){ ?>	
	<!-- <div class="input_row" >
		<div class="label">Cover Image</div>
		<div class="input_div"><?php echo $this->form->input("$modelName.image",array('label'=>false,"type"=>"file","size"=>"43"));?>Preferred Size 980 X 230 (pixels)
			<!-- <div class="clear_btn input_row" onclick="clear_img_path(this);">Clear Image Path</div> -->
		<!-- </div>
	</div>  -->
	
	
	
	
	
	<?php
if(!empty($this->request->data[$modelName]["image"])){
	$img = $this->request->data[$modelName]["image"];
	$imgId = $this->request->data[$modelName]["id"];
	$thumbLocation = "/files/$userFilesFolder/thumb/$img";
	$previewLocation = "/files/$userFilesFolder/preview/$img";
?>
<!-- <div id='main_image_container'></div>
<div class="input_row image_container" id="imgDiv" >
	<div class="label">Chosen Image</div>
	<div class="input_div"><a href="<?php echo $previewLocation;?>" class="lightbox"><img src="<?php echo $thumbLocation;?>" alt="" border="0" /></a></div>
	
</div> -->
<?php
}
?>



<?php } ?>
	
	
	
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
				<div class="input_div"><?php echo $this->form->input("Album.title.$locale",array('label'=>false,'class'=>"$required","dir"=>"$dir"));?></div>
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
    $("#PageForm").validate();
    
     /*tabs*/
    $(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
    $(".page_types_tabs").tabs(".page_types_panes > div",{effect: 'fade'});
    $(".lang_page_type_tabs").tabs(".lang_page_type_panes > div",{effect: 'fade'});
    /*end tabs*/
    
});
</script>