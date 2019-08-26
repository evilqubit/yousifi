


<style>
	.bx-wrapper .bx-viewport{
		background: no-repeat;
		border: none;
		left: 0px;
		box-shadow: 0px;	
	}
</style>

<div class="features">
	<div class="slider">
		<ul class="Headerbxslider">
			
			<?php 
			
			foreach($header_banners as $banner){
				$id=$banner['Banner']['id'];
				$title=$banner['Banner']['title'];
				$image=$banner['Banner']['image'];
				$text=$banner['Banner']['text'];
				$url=$banner['Banner']['url_1'];
				
				$img="/files/banners/preview/$image";
			?>
			<li style="left: 0px;">
				<img style="width: 100%" src="<?=$img?>" alt="">
				
				
				
				<?php if(!empty($title) && !empty($text)){ ?>
				<div class="bx-caption">
					<div class="info">
						<h3><?=$title?></h3>
						<?=$text?>
					</div>
				</div>
				<?php } ?>
				
			</li>	
			
			<?php  } ?>		
		</ul>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		
		
		$('.Headerbxslider').bxSlider({
		  mode: 'horizontal',
		  pager :false,
		  controls:false,
		  autoStart:true,
		  auto:true,
		  captions: true,
		  speed:500,
		  pause:8000
		});
	});
</script>