
<div class="newsSmoBar" style="width:195px;float:left; margin-left: 10px;">
<!--	Facebook   -->
<?php if($fb_like == 1 ){?>
<div class="floatClass socialMediaPhotoOverlay" style="width: 75px;overflow: hidden;" >
	<div class="fb-like" data-href="<?= $pageUrl; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
</div>
<?php } ?>
<!--	Twitter   -->
	
	<div class="floatClass">
		
		<!-- AddThis Button BEGIN -->
		
		
		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style " style="float:right;width:120px;" addthis:url="<?=$pageUrl;?>" addthis:title="<?php echo $title;?>">
			<a class="addthis_button_linkedin"></a>
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_email"></a>
			<a class="addthis_button_compact"></a>
		</div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-514af642790763f7"></script>

		<!-- AddThis Button END -->
		<!-- AddThis Button END -->

	</div>
</div>		
<script type="text/javascript">
	$(document).ready(function(){
		


	});
</script>