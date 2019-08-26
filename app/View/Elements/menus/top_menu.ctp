
<div class="floatRevClass">
	<?php $comming_soon_url="/$lang/Pages/comming_soon"; ?>
	<!-- <div class="floatClass topMenu">
		<ul>
			<li class="floatClass"><a class="topMenuElement " href="/" id="home"><?=strtoupper(__("home",false))?></a></li>
			<li class="floatClass"><a class="topMenuElement " href="/" onclick="open_comming_soon_overlay('<?=$comming_soon_url?>'); return false" id="home"><?=strtoupper(__("prospective students",false))?></a></li>
			<li class="floatClass"><a class="topMenuElement " href="/" onclick="open_comming_soon_overlay('<?=$comming_soon_url?>'); return false"  id="home"><?=strtoupper(__("current students",false))?></a></li>
			<li class="floatClass"><a class="topMenuElement " href="/" onclick="open_comming_soon_overlay('<?=$comming_soon_url?>'); return false" id="home"><?=strtoupper(__("faculty & staff",false))?></a></li>
		</ul>
	</div> -->
	<!-- <div class="floatClass" style="width: 525px; height: 23px; margin-left: 67px; margin-top: 41px; padding-left: 40px; padding-right: 27px"></div> -->
	<?php $url="/$lang/DynamicPages/search_content/"; ?>
	
	<?=$this->element("login") ?>
	
	<div class="floatClass search_icon" onclick="open_search_overlay('<?=$url?>');"></div>
	<div class="floatRevClass langIcon"><a href="<?php echo $change_lang;?>"> <?=__('arabic',true)?> </a></div>

</div>