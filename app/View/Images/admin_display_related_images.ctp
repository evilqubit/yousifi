<div class="relateAlbumImages_title"><?php echo $album["Album"]["title"];?></div>

<?php

	if(empty($chosenImages)){
		$chosenFlag = false;
	}else $chosenFlag = true;
		
	$albumId = $album["Album"]["id"];
	if(!empty($album["Image"])){
		foreach ($album["Image"] as $entry){
			$entryId = $entry["id"];
			$entryImg = $entry["image"];
			
			$checked = "checked='checked'";
			
			if(isset($alreadyRelatedImagesIds[$entryId]) && !$chosenFlag){
				$chosenImages[$albumId][$entryId] = $entryId;
			?>	
				<script type="text/javascript">
					var albumId = <?php echo $albumId;?>;
					if(!chosenImages[albumId])
						chosenImages[albumId] = {};
						
					var currImgId = <?php echo $entryId;?>;
					chosenImages[albumId][currImgId] = currImgId;
				</script>
			<?php
			}
			
	
		
			
			//if album chosen for the first time or if image is already chosen
			if(empty($chosenImages) || !isset($chosenImages[$albumId]) || isset($chosenImages[$albumId][$entryId])){
				$checked = "checked='checked'";
				$checkVisibility = "visible";
				$labelBorder = "border:solid 4px #aeaeae";
				
			?>	
			<script type="text/javascript">
				var albumId = <?php echo $albumId;?>;
				if(!chosenImages[albumId])
					chosenImages[albumId] = {};
					
				var currImgId = <?php echo $entryId;?>;
				chosenImages[albumId][currImgId] = currImgId;
			</script>
			
			<?php
			}else{
				$checked = "";
				$checkVisibility = "hidden";
				$labelBorder = "";
			}
			?>
			<label for="relateImageEntryCheck<?php echo $entryId;?>" class="relateImageEntry" style="<?php echo $labelBorder;?>"><div class="green_checkmarkDiv" ><img src="/img/admin/green_checkmark.gif" alt="" border="0" class="green_checkmark" id="green_checkmarkDiv<?php echo $entryId;?>" style="visibility:<?php echo $checkVisibility;?>"/></div><img src="/files/albums/thumb/<?php echo $entryImg;?>" alt="" border="0" /><input type="checkbox" <?php echo $checked;?> name="data[RelatedImage][image_id]" id="relateImageEntryCheck<?php echo $entryId;?>" class="transparent" onchange="highlightRelatedImage(this,<?php echo $album["Album"]["id"];?>);"/></label>
			
			

			<?php
		}
	}
?>

