
<div id="photoList">
	<!-- <div class="navigatorBg"></div>
	<div class="navigator">
		<a class="jspArrow jspArrowUp"></a>
		<div class="upNavigator floatClass  "></div>
		<div class="downNavigator floatClass"></div>
	</div> -->


	<script type="text/javascript">
	
		var index=1;
		var flag=1;
		var wWidth = getWindowWidth();
		var result=Math.floor(wWidth / (186 * 2));
		
	</script>
	<?php
	
	 foreach($data['Image'] as $image){
		?>
		
		 <div id="<?=$image['id']?>" class="floatClass">  
			<?php if(!empty($image) && file_exists(WWW_ROOT."files/{$folderName}/thumb/{$image['image']}")){?>
				
				<a href="/files/<?=$folderName?>/preview/<?php echo $image['image'];?>" class='lightbox' >
					<img class="grayscale thumbImage"  onmouseout="showColors($(this))" onmouseover="removeColors($(this))" src="/files/<?=$folderName?>/thumb/<?php echo $image['image'];?>"   alt="<?=$image['title']?>" border="0" />
				</a>
			<?php  } ?>
		
		</div>
		
		<script type="text/javascript">
			if(index > result){
				flag++;
				index=2;
			}
			else{
				index++;
			}
			if( (flag % 2) == 1){
				$('#'+<?=$image['id']?>).addClass("imageBoxRight showImage");	
			}else{
				$('#'+<?=$image['id']?>).addClass("imageBoxLeft showImage");
			}
		</script>
	<?php  } ?>
</div>






<script type="text/javascript">
function updateHeight_photoList(wHeight){
	// alert(wHeight);
	wHeight = wHeight - 270;
	// alert(wHeight);
	var number_of_rows=Math.floor(wHeight / (96 * 2));
	// alert(number_of_rows);
	wHeight = number_of_rows * 192;
	 
	 // alert(wHeight);
	$('#photoList').css('height',wHeight+'px');
}

function updateWidth_photoList(wWidth){
	
	if(wWidth <= 1200 ){
		// $('body').css('width','1200px');
		// $('body').css('overflow','auto');
		// $('html').css('width','1150px');
		// $('html').css('overflow','auto');
		$('#photoList').css('width','1180px');
		$('.jspContainer').css('width','1180px');
		//$('#PageContainer').css('overflow','auto');
		
		
	}
	else{
		// $('body').css('width',wWidth+'px');
		// $('body').css('overflow','hidden');
		// $('html').css('width',wWidth+'px');
		// $('html').css('overflow','hidden');
		$('#photoList').css('width',wWidth+'px');
		$('.jspContainer').css('width',wWidth+'px');
		
		//$('#PageContainer').css('overflow','hidden');
		
		
	}
}

	//on document ready load
	$(document).ready(function(){
		var wWidth = getWindowWidth();
		var wHeight = getWindowHeight();
				
       	updateWidth_photoList(wWidth);
       	updateHeight_photoList(wHeight);
	
		
	
		//image container scroller
		$('#photoList').jScrollPane(
			{
				showArrows: true,
				arrowScrollOnHover: true,
				speed:3,
				initialDelay:0
			}
		);

		//image light box
   		$('.showImage a').lightBox({
			fixedNavigation:false
		});
		
		
		// //image lazy load
		// $("img").lazyload({
			// container: $("#photoList"),
              // effect : "fadeIn"
          // });
		
		
		
   			
	});
	//on window resize event
	$(window).resize(function(){
		 var wWidth=getWindowWidth();
		 var wHeight=getWindowHeight();
		 
		 updateHeight_photoList(wHeight);
		 updateWidth_photoList(wWidth);
	});
</script>