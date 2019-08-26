<div class="floatRevClass album_CloseBtn"  onclick="close_image_video_overlay();"></div>
<div class="floatClass overlay_title"><?=$title?></div>
<div class="photo_gallery_video_element">
	
	
	<?php 
		$type=$data["Video"]['type'];
		$video_url=$data["Video"]['video_url'];
		$img = $data['Video']['image'];
		$video = $data['Video']['video'];
		
		if($type == "url"){
	 ?>
		<iframe id="ytplayer" type="text/html" width="449" height="314" src="<?=$video_url?>?autoplay=1" frameborder="0"></iframe>
		
		<?php 
		}else{?>
			
			<div class="floatClass mainPlayerDiv"><div id="player1"></div></div>
		<?php }
		?>
</div>

	<script type="text/javascript">
	

	
	$(document).ready(function(){
		//countdownInterval = self.setInterval(function(){set_countdown()},1000);
		
		
		<?php if($type != "url"){?>
		
	 	jwplayer("player1").setup({
	        file: "/files/videos/files/flv/<?=$video;?>",
//	        file: "http://link.videoplatform.limelight.com/media/?mediaId=3799471432a4407da5d0e9ded9222c28&width=480&height=321&playerForm=Player",
	        image: "/files/videos/images/preview/<?=$img;?>",
	        skin: "/js/jquery/jwplayer/skins/roundster.xml",
	//         advertising: {
	//		    client: 'vast',
	////		    client: 'googima',
	////			tag: 'http://ad.doubleclick.net/pfadx/ABCDEFGH'
	//		    tag: 'http://adserver.com/vastResponse.xml'
	//		  }
	  
	//		 playlist: [{
	//	       image: "/files/images/video_image.jpg",
	//	        file: "/files/videos/small.mp4",
	//	    },{
	////	        image: "/assets/bunny.jpg",
	//	        file: "/files/videos/baileys_5sec.mp4",
	//	    }],
	        base: "/js/jquery/jwplayer/",
	//        logo: {
	//	        file: '/img/captcha_spritegif',
	//	        link: 'http://google.com'
	//	    },
	        width: 449,
	        height: 314
	       
	    });
	    
	   // jwplayer().onComplete(function() {open_how_to_join()});
	  <?php } ?>
	  
	});
	</script>