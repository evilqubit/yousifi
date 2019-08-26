<?php 
// print_r($data);exit;
	$img_name=$data["$sourceModel"]['image'];
	$img_id=$data["$sourceModel"]['id'];
	//$update_image=$img_name.'?'.rand();
	$homeThumbDim = getimagesize(WWW_ROOT."/files/$userFilesFolder/thumb/$img_name");
	
	$WidthDim=$homeThumbDim[0];
	$HeightDim=$homeThumbDim[1];
	
	?>

	<!-- home thumb -->

	<div style="float: left;"><img src="/files/<?=$userFilesFolder;?>/thumb/<?php echo $img_name."?".rand();?>" alt="" /></div>
	<div style="float: left; margin-left: 5px;">
		<div><?=$description;?></div>
		<div>Required size :<?=$Width." X ".$Height." PX ";?> </div>
		<div>Actual size :<?=$WidthDim." X ".$HeightDim." PX ";?> </div>
		<div onclick="cropImg('<?=$sourceModel?>', '<?=$img_id;?>' ,'homeThumb');return false;" style="cursor: pointer;">Click To Crop</div>
	</div>
