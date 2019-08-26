



<div class="floatClass textArea  addTopSpace addBottomSmallSpace" id="FilterContent">
	
	<div class="floatClass backBtn"><a href="<?=$back_url?>"><?=__("back",true)?></a></div>
	<?=$this->element("/article/photo_layer")?>
	<?php
	
	
	//print_r($data);exit;
	$id=$data["Section"]['id'];
	$title=$data["Section"]['title'];
	$text=$data["Section"]['text_1'];
	
	$video_type=$data["Section"]['video_type'];
	$youtube=$data["Section"]['youtube'];
	$youtube_image=$data["Section"]['youtube_image'];
	$video=$data["Section"]['video'];
	$video_image=$data["Section"]['video_image'];
	$file=$data["Section"]['file'];
	
	$file_download_url='';
	if(!empty($file)){
		$file_download_url="/$lang/Sections/download_file/$id";
	}
	
	$width='';
	if(empty($video) && empty($youtube)){
		$width='980px';
	}
	
	
	 ?>
	<div class="floatClass articleDetailsContainer">
		<div class="floatClass articleDetailsLeft" style="width:<?=$width?>">
			<div class="floatClass articleDetailsTitleContainer">
				<div class="floatClass articleDetailsTitle"><?=$title?></div>
				


				
				<?php if(!empty($file_download_url)){ ?>
					<div class="floatClass articleDownloadInternalContainer">
						<div class="floatClass downloadIcon"><a href="<?=$file_download_url?>"><img src="/img/spacer.gif" width="17" height="15" alt="spacer" /></a></div>
						<div class="floatClass downloadText"><a href="<?=$file_download_url?>"><?=__('download',true)?></a></div>
					</div>
				<?php  } ?>
						
						
				<!-- <div class="floatClass articleDetailsBottomBorder"></div> -->
			</div>
			<div class="floatClass articleDetailsText" style="width:<?=$width?>"><?=$text?></div>
		</div>
		
		
		
		<?php
		
		if(!empty($video) || !empty($youtube)){
		 ?>
		
		<div class="floatClass articleDetailsRight">		
			<?php 
			//youtube
			if($video_type == 1){			
				//use vidoe snap shot
				if($youtube_image == 1){
					$img="http://img.youtube.com/vi/$youtube/0.jpg";
				}else{
					$img="/files/sections/preview/$video_image";
				}
				
			}else{
				$img="/files/sections/preview/$video_image";
			} 
			
			$onclick="open_video($id)";
			?>	
				
				<div class="floatClass articleDetailsRightHeaderContainer">
					<div class="floatClass articleDetailsRightHeaderTitle"><?=__("related_video",true)?></div>
					<!-- <div class="floatClass blueTitleBottomBorder"></div> -->
				</div>
				
				<div class="floatClass articleDetailsVideoContainer " id="<?=$id?>" onclick="<?=$onclick?>">
					<div class="floatClass playBtn"><img src="/img/spacer.gif" width="87" height="87"  alt="spacer" /></div>
					<div class="floatClass articleDetailsVideoImg"><img width="355"  src="<?=$img?>"  alt="image" /></div>
				</div>
				
		</div>		
		<?php  } ?>
	</div>
	
</div>






<script>


	
	$(document).ready(function(){
		
			
			
		// $('#my_newsletter').popup({
			  // onopen: function() {
// 			   
			  // }
			// });
	});	
</script>

