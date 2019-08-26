<?php
if(isset($related_image) && !empty($related_image)){

?>


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
		width: 730px;
		height: 532px;
		margin: 0 auto;
		/*overflow: hidden;*/
		position: relative; 
	}
	
	.slick-list {
		overflow: visible;
	}
	.headerNextArrow {
		position: absolute; 
		z-index:1; 
		top: 249px;  
		right:9px; 
		
		width: 38px;
		height: 38px;	
		background:url(/img/en/sprite.png)  -562px -482px no-repeat;
		cursor: pointer;
	}
	
	
	.headerNextArrow img{
		width: 38px;
		height: 38px;	
		outline: none;
		border: none;
	}
	
	
	
	.headerPrevArrow {
		position: absolute; 
		z-index:1; 
		top: 249px;  
		left:9px; 
		
		width: 38px;
		height: 38px;	
		background:url(/img/en/sprite.png)  -490px -482px no-repeat;
		cursor: pointer;
	}
	
	
	.headerPrevArrow img{
		width: 25px;
		height: 30px;
		outline: none;
		border: none;
	}
	



</style>

<?php
	$imagesSize = sizeof($related_image);
?>

<div class="photoLayerMainContainer">
	<div class="photoLayerShadowLeft"></div>
	<div class="photoLayerShadowRight"></div>
	
	
	<?php if($imagesSize > 1){ ?>
	<div class="floatClass photoLayerArrowsContainer" >
		<div class="headerNextArrow" onclick="$('.photo_layer').slickNext()"><img src="/img/spacer.gif" width="38" height="38" alt=""/></div>
		<div class="headerPrevArrow" onclick="$('.photo_layer').slickPrev()"><img src="/img/spacer.gif" width="38" height="38" alt=""/></div>
	</div>
	<?php } ?>
	
	<div class="photo_layer" >	
			<?php
			
			$index=1;
			foreach($related_image as $banner){
				$id=$banner['Image']['id'];
				$title=$banner['Image']['title'];	
				$img=$banner['Image']['image'];
				$img="/files/images/preview/$img";
				
				if($index > 2){
					$src="data-lazy='$img' src=''";
				}else{
					$src="src='$img'";
				}
				?>
				<div><img style=" position:relative; text-align: center; margin: 0 auto;" src='<?=$img?>' alt=""/></div>			
			
				<?php 
				$index++;
			}
			 ?>
	 </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('.photo_layer').slick({
		  dots: false,
		  autoplay:false,
		  pauseOnHover:false,
		  arrows:false,
		  lazyLoad:"ondemand",
		  autoplaySpeed:8000,
		  infinite: true,
		  draggable:false,
		  fade: false,
		  slide: 'div',
		  cssEase: 'linear',
		  slidesToShow: 1
		});
			
		
		
	});
	
</script>




	
	
	
<?php 	
}
 ?>