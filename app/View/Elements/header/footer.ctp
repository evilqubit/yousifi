<div class="footer" style="z-index: 2;">
	<div class="container">
		<p class="copy">Copyright 2014, LeMall</p>
		<ul class="ft-menu">
			<li><a href="#" class="my_popup_open">Privacy</a></li>
			<li><a href="/Sections/sitemap">Sitemap</a></li>
			<li><a href="/Sections/about">About</a></li>
		</ul>
		<div class="social">
			<p>Get social</p>
			<ul>
				
				<?php
				$fb=$social_media_links['SocialMedia']['facebook'];
				$tw=$social_media_links['SocialMedia']['twitter'];
				$youtube=$social_media_links['SocialMedia']['youtube'];
				$google=$social_media_links['SocialMedia']['google'];
				$instagram=$social_media_links['SocialMedia']['instagram'];
				
				
				 ?>
				
				
				<?php if(isset($fb) && !empty($fb)){?>
					<li class="facebook"><a target="_blank" href="<?=$fb?>"></a></li>
				<?php } ?>
				
				<?php if(isset($tw) && !empty($tw)){?>
					<li class="twitter"><a target="_blank" href="<?=$tw?>"></a></li>
				<?php } ?>
				<?php if(isset($youtube) && !empty($youtube)){?>
					<li class="youtube"><a target="_blank" href="<?=$youtube?>"></a></li>
				<?php } ?>
				<?php if(isset($google) && !empty($google)){?>					
					<!-- <li class="google-plus"><a target="_blank" href="<?=$google?>"></a></li> -->
				<?php } ?>
				
				<?php if(isset($instagram) && !empty($instagram)){?>					
					<li class="instagram"><a target="_blank" href="<?=$instagram?>"></a></li>
				<?php } ?>
				
				
			</ul>
		</div>
		<!-- <div class="social social-mail my_newsletter_open" style="cursor: pointer;">
			<p>Join our newsletter</p>
			<ul>
				<li class="mail"><a href="#"></a></li>
			</ul>
		</div> -->
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#my_popup').popup({
			  onopen: function() {
			   $.ajax({
					url: '/Sections/privacy',
					beforeSend:function(data){
						
					},
					success: function(data){
						// videoEmbed = '<iframe id="ytplayer" type="text/html" width="449" height="314" src="'+vURL+'?autoplay=1" frameborder="0"></iframe>';
			
						$('#my_popup').html(data);
						
						//$('.photo_gallery_video_element').html(videoEmbed);
						
					},
					complete: function(){
						
					}
				});
			  }
			});
			
			
		$('#my_newsletter').popup({
			  onopen: function() {
			   
			  }
			});
	});	
</script>