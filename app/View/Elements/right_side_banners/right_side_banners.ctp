<style>
	.bx-wrapper .bx-viewport{
		background: no-repeat;
		border: none;
		left: 0px;
		box-shadow: 0px;	
	}
</style>


	<div class="slider">
		<ul class="Headerbxslider">			
			<?php 			
			foreach($images_larg_list as $banner){
				$title=$banner['Image']['title'];
				$image=$banner['Image']['image'];
				
				$url=$banner['Image']['url'];
				$image="/files/sections/preview/$image";
				$aStart="";
				$aEnd="";
				if(!empty($url)){
					$aStart="<a style='display:block;' href='$url'>";
					$aEnd="</a>";
				}				
				
				if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			        $url = "http://" . $url;
			    }
			?>
			<li style="left: 0px;">
				
				<?php echo $aStart; ?>
					<img  style="width: 100%"  src="<?=$image?>" alt="<?=$title?>">
				<?php echo $aEnd;?>	
			</li>	
			
			<?php  } ?>		
		</ul>
	
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
