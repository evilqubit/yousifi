

<li id="<?php echo $image['Media']['id'];  ?>" class="mix image" >
	<a href="<?php echo "/files/$userFilesFolder/preview/".$image['Media']['imagename']; ?>" rel="prettyPhoto" title="Description of image">
		<div>
			<img width="200" height="10"   src="<?php echo "/files/$userFilesFolder/thumb/".$image['Media']['imagename']."?".rand(); ?>" alt="" />
			<i> </i>
		</div>
	</a>
	
	
	<div  class="gallery-tools">
		<a href="#"  img-id="<?php echo $image['Media']['id'];  ?>" class='delete-image' ><i title="delete" class="icon-trash"></i></a>
		<a href="#modal-3" data-toggle="modal" media-id="<?php echo $image['Media']['id'];  ?>" class='edit-mediainfo' ><i  title="edit"  class="icon-edit"></i></a>
		<!-- <a href="#modal-2" data-toggle="modal" data-img-crop="<?php echo "/files/$userFilesFolder/images/preview/".$image['Media']['imagename']."?".rand(); ?>"  img-id="<?php echo $image['Media']['id'];  ?>" class='crop-img' ><i class="icon-move"></i></a> -->
		<a href="#" class="handle" ><i  title="drag and drop to order"  class="icon-random"></i></a>
	</div>
		
</li>
