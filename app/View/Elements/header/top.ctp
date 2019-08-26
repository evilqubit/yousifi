
<div class="container">
	<div class="floatClass col-12 col-md-12 col-sm-12 col-xs-12">
		<div class="floatClass headerLogo col-lg-5 col-md-5 col-sm-6 col-xs-10"><a href="/"><img  class="img-responsive" src="/img/en/logo.png"  alt="" /></a></div>
		
		
		<div class="floatRevClass socialMediaIcons">
			<?php
			if(isset($social_media_links) && !empty($social_media_links)){
				
				$fb=$social_media_links['SocialMedia']['facebook'];
				$ins=$social_media_links['SocialMedia']['instagram'];
				$linkedin=$social_media_links['SocialMedia']['linkedin'];
				$tw=$social_media_links['SocialMedia']['twitter'];
				
				?>
				
				
				<?php  if(!empty($fb)){
					?>
					<div class="floatClass fbIcon"><a href="<?=$fb?>" target="_blank"><img src="/img/spacer.gif" width="34" height="34"  alt="" /></a></div>
					<?php 
				}?>
				
				<?php  if(!empty($ins)){
					?>
					<div class="floatClass insIcon"><a href="<?=$ins?>" target="_blank"><img src="/img/spacer.gif" width="34" height="34"  alt="" /></a></div>
					<?php 
				}?>
				
				<?php  if(!empty($linkedin)){
					?>
					<div class="floatClass linkedInIcon"><a href="<?=$linkedin?>" target="_blank"><img src="/img/spacer.gif" width="34" height="34"  alt="" /></a></div>
					<?php 
				}?>
				
				<?php  if(!empty($tw)){
					?>
					<div class="floatClass twIcon"><a href="<?=$tw?>" target="_blank"><img src="/img/spacer.gif" width="34" height="34"  alt="" /></a></div>
					<?php 
				}?>
				
				
				<?php 
				
				
			}
			?>
		 
		 </div>
	</div>
</div>