<div class="floatClass HomePhotoCycle">
	<div class="home_photo_gallery_title"><?=__('THE SPECIALIST GROUP',TRUE)?></div>
	<div class="floatClass" id="homeCycle">
		
			<?php 
			
			foreach ($album["Image"] as $image){
				///////////////////////////////////////////
				$imgFolder='albums';
				$id = $image["id"];
				$img = $image["image"];
				$title = $image["title"];
			?>
			<?php if(!empty($img) && file_exists(WWW_ROOT."/files/$imgFolder/preview/{$img}")){?>
			<div class="homeImage floatClass">
				<img src="/files/<?=$imgFolder?>/preview/<?=$img?>" title="<?=$title?>" alt="<?=$title?>"/>
			<?php }?>
			</div>
	<?php 
		}
	?>
	</div>
	<div class="floatClass" id="nav"></div>

</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#homeCycle").cycle({
		fx:"scrollHorz",
		timeout:5000,
		pager:"#nav",
		cleartypeNoBg: true,
		pagerAnchorBuilder: function(index, el) {
	        return "<a style='cursor:pointer;'></a>";
    	}
	});
});
</script>