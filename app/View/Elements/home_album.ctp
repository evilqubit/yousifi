
<div class="floatclass homeAlbum">
	<?php 
		$index=0;
		foreach($data["Image"] as $img){
			$image=$img['image'];
			$id=$img['id'];
			$album_id=$img['album_id'];
			$url="/Images/view_album_image/$album_id/$id";
			
			
			$onclick="open_home_album('$url')";
			$margin='';
			if($index == 2){
				//$margin='0px';
			}
			$index++;
		?>
		
		<div  onclick="<?=$onclick?>" class="floatClass HomeAlbumContainer" style='margin:<?=$margin?>' >
			<img src="/files/albums/thumb/<?=$image;?>" title="" alt=""/>
		</div>
	
	<?php } ?>
</div>
