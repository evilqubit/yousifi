<div class="fixed_social_media_bar_container">
	
	<?php 
	$facebook=$social_media_links['SocialMedia']['facebook'];
	$twitter=$social_media_links['SocialMedia']['twitter'];	
	$instagram=$social_media_links['SocialMedia']['instagram'];	
	$youtube=$social_media_links['SocialMedia']['youtube'];
	
	
	?>
	
	<?php if(isset($facebook) && !empty($facebook)){  ?>
		<div class="floatClass fbSocialMedia"><a target="_blank" href="<?=$facebook?>"><img src="/img/spacer.gif" width="57" height="57" alt="facebook" /></a></div>
	<?php } ?>
	
	<?php if(isset($twitter) && !empty($twitter)){  ?>
		<div class="floatClass twSocialMedia"><a target="_blank" href="<?=$twitter?>"><img src="/img/spacer.gif" width="57" height="57" alt="twitter" /></a></div>
	<?php } ?>
	
	<?php if(isset($instagram) && !empty($instagram)){  ?>
		<div class="floatClass inSocialMedia"><a target="_blank" href="<?=$instagram?>"><img src="/img/spacer.gif" width="57" height="" alt="instagram" /></a></div>
	<?php } ?>
	
	<?php if(isset($youtube) && !empty($youtube)){  ?>
		<div class="floatClass ytSocialMedia"><a target="_blank" href="<?=$youtube?>"><img src="/img/spacer.gif" width="57" height="57" alt="youtube" /></a></div>
	<?php } ?>
</div>