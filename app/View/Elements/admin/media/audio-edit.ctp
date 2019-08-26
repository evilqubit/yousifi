<li id="<?php echo $audio['Media']['id'];  ?>" class="mix audio" >
	<a href="<?php echo '/'.$audio['Media']['audioUrl']; ?>">
		<div>
			<img width="200" height="10"   src="<?php echo '/img/utility/user.png?4334' ?>" alt="" />
			<i> <span style="background-color:red; width:100%; padding-left:2px; padding-right:2px;"><?php echo $audio['Media']['audioName']; ?></span>
			</i>
		</div>
	</a>
	<div class="gallery-tools">
		<a href="#"  audio-id="<?php echo $audio['Media']['id'];  ?>" class='delete-audio' ><i class="icon-trash"></i></a>
		<a href="#modal-3" data-toggle="modal" media-id="<?php echo $audio['Media']['id'];  ?>" class='edit-mediainfo' ><i class="icon-edit"></i></a>
		<a href="#" class="handle" ><i class="icon-random"></i></a>
	</div>
</li>
