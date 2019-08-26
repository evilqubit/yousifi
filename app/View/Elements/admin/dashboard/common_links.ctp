<div class="important_short_cuts">
	<div class="dashboardHeaderContainer">
		<div class="dashboardHeaderIconCommonLink"></div>
		<div class="dashboardHeaderTextCommonLink">Common Tasks</div>
	</div>
	
	<div class="commonLinkContainer">
		<div>
			<?php  $i=0; 
				foreach($important_links as $url=>$links){
								
					if($i%2==0){
						$bgColor="F4F4F4";
					}
					else{
						$bgColor="FFFFFF";
					}
					$i++;
			?>
			
				<div class="commonLinkTitle" style="background-color: <?="#".$bgColor?>"><a href="<?=$url?>"><?=$links?></a></div>
			<?php  } ?>
		</div>
		
	</div>
	
</div>