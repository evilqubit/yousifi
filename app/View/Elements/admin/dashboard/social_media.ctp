<div class="dashboard_social">
	<div class="dashboardHeaderContainerSocial">
		<div class="dashboardHeaderIconSocial"></div>
		<div class="dashboardHeaderTextSocial">Social stream</div>
	</div>
	
	<div class="SocialMainContainer">
		<div style="float:left; width: 1018px; height: 500px;">
		<?php if(!empty($settings['Setting']['fbPage'])) { ?>
		<div class="dashboardFbContainer">
			<?=$this->element("/facebook/fb")?>
			<?=$this->element("/facebook/fb_streem")?>
		</div>
		<?php } ?>
		<?//php debug($settings);die; ?>
		<?php if (!empty($settings['Setting'][''])) { ?>
		<div class="dashboardTwContainer">
			<?php echo $this->element("/twitter/tw")?>
		</div>
		<?php } ?>
		</div>


		<!-- <div   style="clear: both; margin-top: 20px; width: 855px; float: left; height: 300px; overflow: hidden; text-align: center;">
			<div style="font-family: Arial; font-size: 16px; color: #000000; margin-bottom: 5px;">Instagram</div>
			<div id="instagram"></div>

		</div> -->
	</div>





</div>


<script type="text/javascript">



	$(document).ready(function(){


		setTimeout(function(){
			//$("#instagram").html('<iframe onload="" style="height: 1084px;" id="iframecode" scrolling="no" src="http://instaembedder.com/gallery.php?username=audubai&hashtag=&width=150&cols=3&frame=0&image_border=0&rows=1&cell_margin=120&display_username=0&likes=1&comments=1&date=1&link=1&caption=1&color=gray" frameborder="0" width="696"></iframe>');


		}, 5000);



	});


</script>



