<?php 
/// ajax call from pagination
if(!isset($this->params['named']["page"])){
?>
<div class="floatClass paginationDiv" id="paginationDiv1"><?php echo $this->element("custom_paginator");?></div>
<?php } ?>



<div class="floatClass paginatedDiv" id="paginatedDiv" style="">
	

	<div class="floatRevClass paginationDiv" id="paginationDivPage<?php echo $page;?>" style="display:none"><?php echo $this->element("custom_paginator");?></div>
	<div class="floatClass paginatedDiv" id="paginatedContent<?php echo $page;?>">	
	<div class="floatClass albumsContainer" >
	
	<?php $count=count($data) -1;
	 foreach($data AS $index => $album){
	 	$img = $album['Image'][0]["image"];
		$album_title = strtoupper($album['Album']['title']);
		$album_title = $text->truncate($album_title,25,array("...",true));
		$album_slug=$album['SeoManagement']['slug'];
		$album_id=$album['Album']['id'];
		
	 	
	 	?>
			<?php if ($index % 2 == 0 ){ ?>
				<!-- style="<?php if ($count == $index){?> border:none; <?php } ?>" -->
			<a href="/albums/view/<?php echo $album_id; ?>/<?php echo $album_slug; ?>">
				<div class="floatClass albumLeftSide" >
					<div class="AlbumImage" >
						<?php if(!empty($img) && file_exists(WWW_ROOT."files/albums/images/thumb/{$img}")){?>
							<img src='<?php echo $imgURL?>/files/albums/images/thumb/<?php echo $img ?>'  alt='<?php echo $album_title; ?>'  title='<?php echo $album_title; ?>'  border='0'/>
							<div class="AlbumDescription"><?php echo $album_title; ?> </div>	
						<?php  } ?>
					</div>
				</div>
			</a>
			<?php } else {?>
			<a href="/albums/view/<?php echo $album_id; ?>/<?php echo $album_slug; ?>">
				<div class="floatClass albumRightSide" >
					<div class="AlbumImage" >
						<?php if(!empty($img) && file_exists(WWW_ROOT."files/albums/images/thumb/{$img}")){?>
							<img src='<?php echo $imgURL?>/files/albums/images/thumb/<?php echo $img ?>'  alt='<?php echo $album_title; ?>' title='<?php echo $album_title; ?>' border='0'/>
							<div class="AlbumDescription"><?php echo $album_title; ?> </div>	
						<?php  } ?>
					</div>
				</div>
			</a>
			<?php  }  ?> 
		
	<?php } ?>
	</div>
	</div>
</div>
<?php 
/// ajax call from pagination
if(!isset($this->params['named']["page"])){
?>
<div class="floatClass paginationDiv" id="paginationDiv2"><?php echo $this->element("custom_paginator");?></div>
<?php } ?>

