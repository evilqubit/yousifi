
<style>
	.slick-slide img {
		width: auto;
	}
	.slick-slide {
		position: relative;
		z-index: 99; 
		overflow: hidden;
	}
	.slick-slider {
		width: 100%;
		margin: 0 auto;
		overflow: hidden;
		position: relative; 
	}
	
	.homeImageRow {
		width: 480px;
		height: 330px;
	}
	
	
	.slick-dots {
		width: 480px;
		height: 29px;
		position: absolute;
		background-color: #2c2a31;
		top: 301px;
		padding: 0px;
		margin: 0px;
		text-align: center;
	}
	.slick-dots li {
		margin: 0px;
	}
	
	.slick-dots li button::before {
		font-size: 40px;
		line-height: 27px;
		color:#969598;
	}
	.slick-dots li.slick-active button::before {
		color: #ffffff;
	}
</style>


<div class="floatClass homeRightImage" >
	
	
	


<div class="slider home_home_single_item" >

<?php
$indexi=1;


foreach($home_right_banners as $banner){
	$id=$banner['Banner']['id'];
	$title=$banner['Banner']['title'];	
	$type=$banner['Banner']['type']; // image , file
	
	
	$video=$banner['Banner']['video']; 
	$youtube=$banner['Banner']['youtube'];
	$video_type=$banner['Banner']['video_type']; // youtube = 1 or file = 0
	
	$video_image=$banner['Banner']['video_image'];
	$use_snaped_image=$banner['Banner']['use_snaped_image'];
	
	 
	$link=$banner["Banner"]['url'];
	$img=$banner['Banner']['image_1'];
	
	
	
	//if(!empty($img)){
		$img="/files/banners/preview/$img";
		
	if(!empty($link)){
		
		if(substr($link,0,7) != "http://" ){
				$link = "http://$link";
			}
		
		$aStart="<a href='$link'>";
		$aEnd='</a>';
		
	}else{	
		$aStart="";
		$aEnd='';
	}
	
	?>
	<div class="homeImageRow">
		<?php if($type == 'image'){			
			?>
			<div class="floatClass homeImageInnerRow" ><?=$aStart?><img alt="<?=$title?>"  src="<?=$img?>"/><?=$aEnd?></div>	
			
			<?php 
		}else{
			if($video_type == 1){ //youtube																								
				if($use_snaped_image == 1){
					$img="http://img.youtube.com/vi/$youtube/0.jpg";
					
				}else{
					$img="/files/banners/preview/$video_image";
				}
				
			
			}else{
				$img="/files/banners/preview/$video_image";
			}
			
			$onclick="banner_open_video($id)";

			?>
			
			<div class="floatClass homeImageInnerRow" onclick="<?=$onclick?>" >
				<div class="videoPlayBtn"><img alt="spacer" src="/img/spacer.gif" width="87" height="87" /></div>
				<div class="VideoImage"><img alt="<?=$title?>" width="480"  src="<?=$img?>"/></div>
			</div>	
			
			<?php 
		} ?>
				
	</div>
	<?php 
	//}	

$indexi++;
}
 ?>
 </div>
 </div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('.home_home_single_item').slick({
		  dots: true,
		  autoplay:true,
		  pauseOnHover:false,
		  arrows:false,
		  lazyLoad:"ondemand",
		  autoplaySpeed:8000,
		  infinite: false,
		  draggable:false,
		  fade: false,
		  slide: 'div',
		  cssEase: 'linear'
		});
			
		
		
	});
	
</script>
