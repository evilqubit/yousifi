
<div class="floatClass homeAlbumCycleContainer">
	
	<?php 
	$total=count($home_album_details['Image']);
	
	
	
	
	?>
	
	<div class="floatClass photoGalleryNavContainer">	
		<?php  if($total > 1){ ?>	
			<div class=" home_nav_prev" onclick="$('#homeHeaderCycle').cycle('prev');"></div>
			<div class=" home_nav_next" onclick="$('#homeHeaderCycle').cycle('next');"></div>
		<?php } ?>
		<div class="overlyCloseBtn"  onclick="$('#home_album_overlay').overlay().close();"></div>
	</div>
	
	
	
	<div class="floatClass HomeImageContent" id="homeHeaderCycle">
		<?php 
		$index=0;
		$start_slid=0;
		$start_slid_index=0;
		$total=count($home_album_details['Image']);
		
		foreach ($home_album_details['Image'] as $img_elemnt){
			
			$id = $img_elemnt['id'];
			$Img = $img_elemnt['image'];
			if($index < 2 ){
				$img="src='/files/albums/preview/$Img'";
			}else{
				$img="asrc='/files/albums/preview/$Img'";
			}
			
			if($image_id == $id){
				$img="src='/files/albums/preview/$Img'";
				$start_slid=$start_slid_index;
			}else{
				$start_slid_index++;
			}
			$index++;

			?>
			
			
			<div  class="floatClass HomeImageContent" id='<?=$id?>'  >
				<img id='header_<?=$id?>' <?=$img?> title="" alt=""/>
			</div>
			
		<?php  } ?>
	
	</div>
</div>



<?php 
	$total=count($home_album_details['Image']);
	
	
	if($total > 1){
	
	?>
	

<script type="text/javascript">
	
	$(document).ready(function(){
		$("#homeHeaderCycle").cycle({
			fx:"scrollHorz",
			timeout:0,
			startingSlide:'<?=$start_slid?>',
			
	  		before:  function(currSlideElement, nextSlideElement, options, forwardFlag){
	  			//$('#homeCycle2').cycle('next');
	  			current_id=$(this).attr('id');
	  			
	  			next_id=$("#"+current_id).next().attr('id');
	  			
				if ($("#header_"+next_id ).attr("asrc")) {
		           $("#header_"+next_id).attr("src", $("#header_"+next_id).attr("asrc"));
		        }
	  			if(options.currSlide != 0){
	  				//FB.XFBML.parse();
	  			}
		   	// 
		   },
			// pager:"#nav",
			cleartypeNoBg: true,
			//onPrevNextEvent: null,// callback fn for prev/next events: function(isNext, zeroBasedSlideIndex, slideElement) 
			onPrevNextEvent: function(isNext, zeroBasedSlideIndex, slideElement) {
				//$('#homeTextCycle').cycle(zeroBasedSlideIndex);
				
				// index=parseInt(index);
		        // return "<div class='floatClass nav_elemnt' onclick=$('#homeCycle2').cycle("+index+")><img src='/img/spacer.gif' width='44' height='22' alt=""/></div>";
	  			}	    	
		});
		
	});
	
	
</script>

<?php } ?>
