<style>
	.bx-wrapper .bx-viewport{
		background: no-repeat;
		border: none;
		left: 0px;
		box-shadow: 0px;	
	}
</style>

<div class="features" style="clear: both;">
	<div class="slider">
		<ul class="Headerbxslider">
			
			<?php 
			
			foreach($home_banners as $banner){
				$id=$banner['Banner']['id'];
				$title=$banner['Banner']['title'];	
				$text=$banner['Banner']['text'];	
				
				$link=$banner["Banner"]['url'];
				$img=$banner['Banner']['image'];
				
				
				
				if($lang == 'en'){
					$title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
				}else{
					$title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
				}
				
				$text= $this->Text->truncate($text,300,array("...",true , 'exact'=>false));
				
				
				
				if(!empty($img)){
					$img="/files/banners/preview/$img";
					
					$image_size=getimagesize(WWW_ROOT.$img);
					
					$width=$image_size[0];
					$height=$image_size[1];
					
				}	
				
				
				if(!empty($link)){
					
					if(substr($link,0,7) != "http://" ){
							$link = "http://$link";
						}
					
					$aStart="<a href='$link'>";
					$aEnd='</a>';
					
				}else{	
					$aStart="";
					$aEnd='';
				}
			?>
			<li style="left: 0px;">
				<?=$aStart?>
				<img />
				<img style="width: 100%;" src="<?=$img?>" alt="" />
				<img style="width: 100%; position: absolute; z-index: 2; top: 120px;" src="/img/header_shadow.png" alt="" />
				
				<?=$aEnd?>
				
				
				
				<?php if(!empty($title) && !empty($text)){ ?>
				<div class="bx-caption">
					<div class="info">
						<div class="bxsliderTitle"><?=$aStart?> <?=$title?> <?=$aEnd?></div>
						<div class="bxsliderText hidden-sm hidden-xs"><?=$aStart?> <?=$text?> <?=$aEnd?></div>						
					</div>
				</div>
				<?php } ?>
				
			</li>	
			
			<?php  } ?>		
		</ul>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		
		
		$('.Headerbxslider').bxSlider({
		  mode: 'horizontal',
		  pager :false,
		  controls:true,
		  autoStart:false,
		  auto:false,
		  captions: true,
		  speed:500,
		  pause:8000
		});
	});
</script>