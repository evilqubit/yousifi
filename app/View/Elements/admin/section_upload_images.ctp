<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-title">
				<h3><i class="icon-play"></i>Media Gallery</h3>
			</div>
				<div class="FloatClass" style="width:100%;margin-top:15px;" id="AddImagesDiv">
					<div class="FloatClass">
						<input id="file_upload" name="file_upload" type="file" />
					</div>
					<div class="FloatClass" style="margin-top:10px;margin-left:15px;">
						Preferred Size: <strong><?=$preferred_size;?></strong> (pixels)
					</div>
				</div>
				
				<div id="addedImages" class="FloatClass" style="margin-top:20px;width:100%;">
					<?php
					
					
					 if(isset($chosen_images) && !empty($chosen_images)){
						
						foreach ($chosen_images as $data){ 
							echo $this->element("admin/section_display_uploaded_image",array("data"=>$data,"folderName"=>$userFilesFolder,"preferred_size"=>''));
						}
					}
					?>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	
	if($("#auto_label1").length > 0 && $("#auto_label1").val() ==1)
		addLabel = 1;
	else addLabel = 0;
	
	init_uploadify(addLabel);
	
});

function init_uploadify(addLabelVal){
	$('#file_upload').uploadify({
		'method': "PUT",
	    'swf'  : '/js/jquery/uploadify/uploadify.swf?<?php echo time().rand();?>',
	    'uploader'    : '/images/section_upload_image/<?=$model_name;?>/<?=$section?>/<?=$type?>/<?=$hashed_id?>/kjd_kml819?<?php echo time().rand();?>',
	    'cancelImg' : '/js/jquery/uploadify/cancel.png',
	    'auto'      : true,
	    'multi'       : true,
	    'fileTypeExts'     : '*.jpg;*.gif;*.png',
	    'button_image_url'   : '/img/admin/browse.gif',
	    'buttonImage'   : '/img/admin/browse.gif',
	    'width'   : '118',
	    'height'   : '37',
	    'removeTimeout': '0.5',
	    'onUploadSuccess'  : function(file,data,response) {
	    	$('#addedImages').append(data);
	    	$(".fields_lang_tabs").tabs(".fields_lang_panes > div",{effect: 'fade'});
	    }
	  });
}
</script>