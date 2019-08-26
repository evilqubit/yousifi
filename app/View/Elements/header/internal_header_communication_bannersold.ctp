<?php
if(isset($section_banner) && !empty($section_banner)){
	$img=$section_banner['Banner']['image'];
	$img="/files/banners/preview/$img";?>
	
	
	<div class="floatClas internalHeaderBanner col-lg-12 col-md-12 col-sm-12 col-xs-12"  >
		<div class="floatClass  container  internalBannerTextContainer"> 
			<?=strtoupper($section_name)?>
		</div>
		<div class="floatClass">
			<img class="img-responsive internalHeaderImage" src="<?=$img?>" alt="" width="100%" /></a></div>
			
			<img style="width: 100%; position: absolute; z-index: 2; left: 0px; top: 8%;" src="/img/internal_shadow.png" alt="">
		</div>
		
		
	</div>
	<?php 
}

 ?>