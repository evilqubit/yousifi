<?php  if (!empty($images_videos)){?>

<div class="floatClass photo_gallery_container">
	<div class="photo_gallery_internal_container">
		<!-- <div class="hcmPrev"><div class="floatClass hcmPrevArrow"></div></div> -->
		<div class="floatClass" id="photo_gallery_Cycle">
			<?php 
			$row_index=0;
			$index=1;
			$total=count($images_videos);
			
			foreach ($images_videos as $images_videos_element){
				$type=$images_videos_element['PagesRelation']['related_model'];
				
				if($type == "Video"){
					$id = $images_videos_element['Video']['id'];
					$title = $images_videos_element['Video']['title'];
					$img = $images_videos_element['Video']['image'];
					$video = $images_videos_element['Video']['video'];
					$video_url = $images_videos_element['Video']['video_url'];
					$video_type = $images_videos_element['Video']['type'];
					
					
					if($video_type == "url"){
						//////
						$v = explode(".jpg",$img);
						$vid = $v[0];
					}
					
					$url="";
					
				}elseif($type == "Image"){
					$id = $images_videos_element['Image']['id'];
					$title = $images_videos_element['Image']['title'];
					$img = $images_videos_element['Image']['image'];
					
					$url="/Images/view_image/$id/$main_title";
				}
				
				
				
			 if (($row_index % 8) == 0){
				echo "<div style='width:980px; clear: both;'>";
				}
			 $margin='';
			 if (($index % 8) == 0){
				$margin='0px';
				}
			  ?>
			
				<?php if ($type == "Image"){?>
					<div  onclick="open_service_overlay('<?=$url?>')" class="floatClass image_video_elemnt_content" style="margin-right: <?=$margin?>" >
						<img alt="<?=$title?>" src="/files/albums/thumb/<?=$img;?>" title="" alt=""/>
					</div>
				<?php }elseif ($type == "Video"){
					
						if($video_type == "url"){
							?>
							<div  onclick="embed_video('<?=$id?>', '<?=$main_title?>')" class="floatClass image_video_elemnt_content" style="margin-right: <?=$margin?>" >
								<div class="play_btn"></div>
								<img alt="youtube" src="http://img.youtube.com/vi/<?=$vid?>/0.jpg" width="114" height="80" title="" alt=""/>
							</div>
							
						<?php }else{?>
							
							<div  onclick="embed_video('<?=$id?>', '<?=$main_title?>')" class="floatClass image_video_elemnt_content" style="margin-right: <?=$margin?>" >
								<div class="play_btn"></div>
								<img alt="image" src="/files/videos/images/thumb/<?=$img;?>"  title="" alt=""/>
							</div>
							
							
						<?php }
				 }  ?>					
			<?php 
			$index++;
			$row_index++;
			if ((($row_index % 8) == 0) || ($row_index == $total)){
				echo "</div>";
			} ?>
			
			<?php }?>
		</div>
		
		<!-- <div class="hcmNext"><div class="floatClass hcmNextArrow"></div></div> -->
	</div>
	<?php if($total >8) {?>
	<div class="floatRevClass  newsNavigationContainer">
		<div class="floatClass news_nav_prev" onclick="$('#photo_gallery_Cycle').cycle('prev');"></div>
		<div class="floatClass" id="nav"></div>
		<div class="floatClass news_nav_next" onclick="$('#photo_gallery_Cycle').cycle('next');"></div>
	</div>
	<?php } ?>
</div>


<?php } ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#photo_gallery_Cycle").cycle({
		fx:"scrollHorz",
		timeout:0,
		
  		after:  function(currSlideElement, nextSlideElement, options, forwardFlag){
  			
  			if(options.currSlide != 0){
  				//FB.XFBML.parse();
  			}
	   	// 
	   },
		pager:"#nav",
		cleartypeNoBg: true,
		pagerAnchorBuilder: function(index, el) {
			index=parseInt(index)+1;
			var new_index=index;
			<?php  if ($lang == 'ar'){?>
				new_index=parse_arabic_numbers(index);
			<?}?>
			
	        return "<a class='news_nav_elemnt'>"+new_index+"</a>";
  			 }
    	
	});
});
</script>