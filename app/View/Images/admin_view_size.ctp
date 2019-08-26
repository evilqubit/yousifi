<div style="border: 1px solid #000000; float: left;">
	<div style="float: right; cursor: pointer;" onclick="close_view_sizes();"><img src="/img/admin/delete.gif" alt="Close Croping" />Close Croping</div>
	<?php 
	$img_name=$data["$sourceModel"]['image'];
	// $img_name=$img_name.' ? '.rand();
	$img_id=$data["$sourceModel"]['id'];
	
	$thumbDim = getimagesize(WWW_ROOT."/files/$userFilesFolder/thumb/$img_name");
	
	
	// print_r($homeThumbDim);exit;
	
	$homeThumbWidth=198;
	$homeThumbHeight=198;
	$homeThumbWidthDim=$thumbDim[0];
	$homeThumbHeightDim=$thumbDim[1];
	
	// $homePreviewWidth=301;
	// $homePreviewHeight=200;
	// $homePreviewWidthDim=$homePreviewDim[0];
	// $homePreviewHeightDim=$homePreviewDim[1];
// 	
// 	
	// $overlayPreviewWidth=560;
	// $overlayPreviewHeight=370;
	// $overlayPreviewWidthDim=$overlayPreviewDim[0];
	// $overlayPreviewHeightDim=$overlayPreviewDim[1];
// 
	// $overlayThumbWidth=99;
	// $overlayThumbHeight=66;
	// $overlayThumbWidthDim=$overlayThumbDim[0];
	// $overlayThumbHeightDim=$overlayThumbDim[1];
// 
	// $internalWidth=123;
	// $internalHeight=82;
	// $internalWidthDim=$internalDim[0];
	// $internalHeightDim=$internalDim[1];
	
	
	?>

	<!-- home thumb -->
	<div  style="width:640px; height: auto;  clear: both; margin-bottom: 20px; float: left;" id="homeThumb_<?=$img_id;?>">
		<div style="float: left;"><img src="/files/<?=$userFilesFolder?>/thumb/<?php echo $img_name;?>" alt="" /></div>
		<div style="float: left; margin-left: 5px;">
			<div>Home Thumb</div>
			<div>Required size :<?=$homeThumbWidth." X ".$homeThumbHeight." PX ";?> </div>
			<div>Actual size :<?=$homeThumbWidthDim." X ".$homeThumbHeightDim." PX ";?> </div>
			<div onclick="cropImg('<?=$sourceModel?>', '<?=$img_id;?>' ,'homeThumb');return false;" style="cursor: pointer;">Click To Crop</div>
		</div>
	</div>
	<!-- home preview -->
	<!-- <div  style="width:640px; height: auto; clear: both; margin-bottom: 20px; float: left;" id="homePreview_<?=$img_id;?>">
		<div style="float: left;"><img src="/files/images/homePreview/<?php echo $img_name;?>" alt="" /></div>
		<div style="float: left; margin-left: 5px;">
			<div>Home Preview</div>
			<div>Required size :<?=$homePreviewWidth." X ".$homePreviewHeight." PX ";?> </div>
			<div>Actual size :<?=$homePreviewWidthDim." X ".$homePreviewHeightDim." PX ";?> </div>
			<div onclick='cropImg(<?=$img_id;?> ,"homePreview");return false;' style="cursor: pointer;">Click To Crop</div>
		</div>
	</div> -->
	<!--//////////////////////////// 	 -->
	<!-- overlay thumb -->
	<!-- <div  style="width:640px;  height: auto; clear: both; margin-bottom: 20px; float: left;" id="overlayThumb_<?=$img_id;?>" >
		<div style="float: left;"><img src="/files/images/overlayThumb/<?php echo $img_name;?>" alt="" /></div>
		<div style="float: left; margin-left: 5px;">
			<div>Overlay Thumb </div>
			<div>Required size :<?=$overlayThumbWidth." X ".$overlayThumbHeight." PX ";?> </div>
			<div>Actual size :<?=$overlayThumbWidthDim." X ".$overlayThumbHeightDim." PX ";?> </div>
			<div onclick='cropImg(<?=$img_id;?> ,"overlayThumb");return false;' style="cursor: pointer;">Click To Crop</div>
		</div>
	</div> -->
	<!-- overlay preview -->
	<!-- <div  style="width:640px; height: auto; clear: both; margin-bottom: 20px; float: left;" id="overlayPreview_<?=$img_id;?>" >
		<div style="float: left;"><img src="/files/images/overlayPreview/<?php echo $img_name;?>" alt="" /></div>
		<div style="float: left; margin-left: 5px;">
			<div>Overlay Preview</div>
			<div>Required size :<?=$overlayPreviewWidth." X ".$overlayPreviewHeight." PX ";?> </div>
			<div>Actual size :<?=$overlayPreviewWidthDim." X ".$overlayPreviewHeightDim." PX ";?> </div>
			<div onclick='cropImg(<?=$img_id;?> , "overlayPreview");return false;' style="cursor: pointer;">Click To Crop</div>
		</div>
	</div> -->
	<!-- ///////////////////////////////  -->
	<!-- internal-->
	<!-- <div  style="width:640px; height: auto; clear: both; margin-bottom: 20px; float: left;" id="internal_<?=$img_id;?>">
		<div style="float: left;"><img src="/files/images/internal/<?php echo $img_name;?>" alt="" /></div>
		<div style="float: left; margin-left: 5px;">
			<div>Photo gallery Thumb</div>
			<div>Required size :<?=$internalWidth." X ".$internalHeight." PX ";?> </div>
			<div>Actual size :<?=$internalWidthDim." X ".$internalHeightDim." PX ";?> </div>
			<div onclick='cropImg(<?=$img_id;?> ,"internal");return false;' style="cursor: pointer;">Click To Crop</div>
		</div>
	</div> -->
</div>