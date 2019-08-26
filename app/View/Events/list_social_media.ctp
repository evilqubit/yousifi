<div class="floatClass news_bottom_section">
	<?php 
	$full_url=Configure::read('WEBSITE_URL').$url;
	?>
	<div class="floatClass readmore"><a onclick="show_news_details('<?=$url?>'); return false" href="<?=$url?>"><?=__('read more',true)?></a></div>
	<?php
	//$this->element('smo/smo_bar',array("pageUrl"=>$full_url,'title'=>$data["$modelName"]['title'],"fb_like"=>$fb_like))
	?>
</div>