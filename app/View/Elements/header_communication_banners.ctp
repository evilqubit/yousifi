<div class="external_top_border"><img src="/img/top_border.png" width="100%" height="7px" alt=""></div>
<div class="headerCommunicationBanner">
	<!-- <div class="hcmPrev"><div class="floatClass hcmPrevArrow"></div></div> -->
	<div class="floatClass" id="hcmCycle">
		<?php 
		 $websiteURL = Configure::read("WEBSITE_Domain");
		
		foreach ($headerCommunicationBanners as $hcm){
			// $hcmTitle = $hcm["HeaderCommunicationBanner"]['title'];
			$hcmImg = $hcm["HeaderCommunicationBanner"]['image'];
			// $hcmLink = $hcm["HeaderCommunicationBanner"]['link'];
		
		?>
			<img src="/files/header_communication_banners/preview/<?php echo $hcmImg;?>" title="" alt=""/>
		<?php }?>
	</div>
	<!-- <div class="hcmNext"><div class="floatClass hcmNextArrow"></div></div> -->
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#hcmCycle").cycle({
		fx:"scrollHorz",
		// prev:".hcmPrev",
		// next:".hcmNext",
		timeout:3000,
		cleartype:false,
		cleartypeNoBg:false
	});
});
</script>