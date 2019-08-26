<?php if($video['Media']['type'] == "video" and $video['Media']['subtype'] == "" ): ?>
<li id="<?php echo $video['Media']['id'];  ?>" class='mix video'>
	<a target="_blank" href="<?php echo $video['Media']['videoUrl']; ?>" rel="">
		<div>
			<img id='cover<?php echo $video['Media']['id'];  ?>' width="200" height="10"  src="<?php echo $video['Media']['dir'].'/thumb/'.$video['Media']['imagename']; ?>" alt="" />
			<i><img src="/img/admin/play.png"/></i>	
		</div>
	</a>
	<div class="gallery-tools">
		<a href="#"  vid-id="<?php echo $video['Media']['id'];  ?>" class='delete-video' ><i class="icon-trash"></i></a>
		<a href="#modal-3" data-toggle="modal" media-id="<?php echo $video['Media']['id'];  ?>" class='edit-mediainfo' ><i 														class="icon-edit"></i></a>
		<a href="#modal-2" data-toggle="modal" data-img-crop="<?php echo $video['Media']['dir'].'/preview/'.$video['Media']['imagename']; ?>" data-img="<?php echo $video['Media']['dir'].'/thumb/'.$video['Media']['imagename']; ?>" vid-id="<?php echo $video['Media']['id'];  ?>" class='crop-video' ><i class="icon-move"></i></a>
		<a href="#modal-1" data-toggle="modal" vid-id="<?php echo $video['Media']['id'];  ?>" class='edit-cover-video' ><i class="icon-camera-retro"></i></a>
		<a href="#" class="handle" ><i class="icon-random"></i></a>
	</div>
</li>
<?php endif; ?>
<?php  if($video['Media']['subtype'] == "youtube"): ?>
<li id="<?php echo $video['Media']['id'];  ?>" class='mix video'>
	<a target="_blank" href="<?php echo $video['Media']['youtubeUrl']; ?>" rel="prettyPhoto">
		<div>
			<img id='cover<?php echo $video['Media']['id'];  ?>' width="200" height="10"  src="
				<?php if(isset($video['Media']['imagename'])){echo $video['Media']['dir'].'/thumb/'.$video['Media']['imagename'];}
					else{ echo $this->Youtube->url($video['Media']['youtubeUrl'],'hqthumb');    }?>" alt="" />
			<i><img src="/img/admin/play.png"/></i>
		</div>
	</a>
	<div class="gallery-tools">
		<a href="#modal-3" data-toggle="modal" media-id="<?php echo $video['Media']['id'];  ?>" class='edit-mediainfo' ><i 														class="icon-edit"></i></a>
		<a href="#"  vid-id="<?php echo $video['Media']['id'];  ?>" class='delete-video' ><i class="icon-trash"></i></a>
		<a id='crop<?php echo $video['Media']['id'];  ?>' href="#modal-2" data-toggle="modal" data-img-crop="<?php if($video['Media']['imagename']){echo $video['Media']['dir'].'/preview/'.$video['Media']['imagename'];}?>" data-img="<?php if($video['Media']['imagename']){echo $video['Media']['dir'].'/thumb/'.$video['Media']['imagename'];} ?>" vid-id="<?php echo $video['Media']['id'];  ?>" class='crop-video' ><i class="icon-move"></i></a>
		<a href="#modal-1" data-toggle="modal" vid-id="<?php echo $video['Media']['id'];  ?>" class='edit-cover-video' ><i class="icon-camera-retro"></i></a>
		<a href="#" class="handle" ><i class="icon-random"></i></a>
	</div>
</li>
<?php endif; ?>
