<?=$this->element('album_overlay')?>
<div class="floatClass ProjectAlbumContainer">
	<?php
	$count=0;
	foreach($data["Image"] as $img){
		$id=$img['id'];
		$title=$img['title'];
		$img=$img['image'];
		$album_id=$data["Album"]["id"];
		
		
		
		if($count > 1 && $count % 4 == 0){
			if($lang =='en'){
				$margin='margin-right:0px';
			}elseif($lang == 'ar'){
				$margin='margin-left:0px';
			}
			
		}else{
			$margin = "";
		}
		$url="/$lang/Projects/view_album/$album_id/$id";
		$onclick="open_project_album('$url')";
	
	 ?>
	 <div class="floatClass prjectImgElementContainer" onclick="<?=$onclick?>" style="<?=$margin?>">
	 	<div class="floatClass prjectImgElement"><img src="/files/albums/thumb/<?=$img?> alt="" ></div>
	 	<div class="floatClass ImgeListTitle"> <?=$title?></div>
	 </div>
	 
	 <?php 
	 $count++;
	}
	 ?>
	
</div>