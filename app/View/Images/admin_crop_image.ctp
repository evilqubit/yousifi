<?php 
$uploadedImage = $data["$sourceModel"]["image"];
$imageId = $data["$sourceModel"]["id"];


$imgDim = getimagesize(WWW_ROOT."/files/$userFilesFolder/original/$uploadedImage");

$previewWidth=$imgDim[0];
$previewHeight=$imgDim[1];

$cropWidth = $Width;
$cropHeight = $Height;
?>
		
<div class="FloatClass" style="width:560px;"><img src="/files/<?=$userFilesFolder;?>/list/<?php echo $uploadedImage."?".rand();?>" alt="" id="uploadedPic"/></div>



<?php

$imgWidth = $cropWidth;
$imgHeight = $cropHeight;

?>
<?php echo $this->form->create("Image",array("url"=>array("controller"=>"Images","action"=>"admin_crop_image",$sourceModel,$imageId ,$dim),"id"=>"cropImageForm")); ?>

<div class="FloatClass" style="width:110px">
	<?php
		echo $this->form->input("x1",array("type"=>"hidden","id"=>"cropX","value"=>"0"));
		echo $this->form->input("y1",array("type"=>"hidden","id"=>"cropY","value"=>"0"));
		echo $this->form->input("imageWidth",array("type"=>"hidden","id"=>"cropWidth","value"=>"$imgWidth"));
		echo $this->form->input("imageHeight",array("type"=>"hidden","id"=>"cropHeight","value"=>"$imgHeight"));
		echo $this->form->input("imageId",array("type"=>"hidden","value"=>"$imageId"));
		echo $this->form->input("imageName",array("type"=>"hidden","value"=>"$uploadedImage"));
	?>
	
	<div class="FloatClass" id="cropLoader" style="display:none"><img src="/img/loader.gif" alt="" id="cropLoader" /></div>
</div>

<div class="input_row" style="clear:both;">
	<div class="input_div"><?php echo $this->form->submit("Save Crop",array("class"=>"submit_btn"));?></div>
</div>

<?php 
	echo $this->form->end();
?>
	
<script type="text/javascript">
	 $('#uploadedPic').imgAreaSelect(
	{ 
		minWidth: <?php echo $imgWidth;?>, 
		minHeight: <?php echo $imgHeight;?>, 
		handles: false, 
		show:false, 
		persistent: true,
		x1: 0, 
		y1: 0, 
		x2:<?php echo $imgWidth;?>, 
		y2: <?php echo $imgHeight;?>,
		maxWidth : <?php echo $imgWidth; ?>,
		maxHeight : <?php echo $imgHeight; ?>,
		onSelectEnd: function (img, selection) {
			x1 = selection.x1;
			y1 = selection.y1;
			
			width = selection.width;
			height = selection.height;
			
			$("#cropWidth").val(width);
			$("#cropHeight").val(height);
			$("#cropX").val(x1);
			$("#cropY").val(y1);
			
	    }

	
		});
		
		
	
	var ajaxOptions =  { 
		beforeSubmit: function(){
			$("#cropLoader").show();
			$("#saveCropBtn").hide();},
        success:  function(){
        	$('#uploadedPic').imgAreaSelect({remove:true});
        	
        	$.ajax({
        		
				url: "/admin/images/crop_update/<?=$sourceModel?>/<?=$imageId;?>/<?=$dim;?>",
				success: function(data){
					var dim="<?=$dim;?>";
					$('#'+dim+'_<?=$imageId;?>').html(data);
					
				}
			});

        }
    }; 
	$("#cropImageForm").ajaxForm(ajaxOptions);
	

</script>