

    <!-- Custom styles for the demo page -->
    <style>
    img {
        max-width: 100%;
    }
    .well {
       	background-color:#ffffff;
       	border:none;
        display:none;
        margin-top: 100px;
        margin-bottom: 100px;
       
    }
    pre.prettyprint {
        padding: 9px 14px;
    }
    .fulltable {
        max-width: 100%;
        overflow: auto;
    }
    .container {
        padding-left: 0;
        padding-right: 0;
    }
    .lineheight {
        line-height: 3em;
    }


	.privacyClose{
		float: right;
		color: #ffffff;
		border: none;
		background: none;
		width: 49px;
		height:49px;	
		margin-top: -60px;
		cursor:pointer;
		background:url(/img/en/sprite.png) -559px -236px;
		
	}
	.vidoeLayer {
		width: 854px;
		height: auto;
		padding: 20px;
		background-color: #ffffff;
	}
	.videoPlayerContainer {
		width: 854px;
		height:510px;
		margin-bottom: 10px; 
	}
    </style>
    


	<div style="width: 894px">
		
	
	<button class="my_popup_close privacyClose"></button>
	
    <div class="floatClass vidoeLayer">
    	
    	<?php 
    	$id=$data["Section"]['id'];
		$title=$data["Section"]['title'];
		$text=$data["Section"]['text_1'];
		
		$video_type=$data["Section"]['video_type'];
		$youtube=$data["Section"]['youtube'];
		$video=$data["Section"]['video'];
		$video_image=$data["Section"]['video_image'];
		
		
		//youtube
		if($video_type == 1){			
			$video_url="http://www.youtube.com/embed/$youtube";
		 ?>
	 
	 	<div class="floatClass videoPlayerContainer">
			<iframe id="ytplayer" type="text/html" width="854" height="510" src="<?=$video_url?>?autoplay=1" frameborder="0"></iframe>
		</div>
		<?php 	
		}else{
			
			// $video_url="/files/sections/video/flv/$video";
			$video_url="/files/sections/video/flv/$video";
			$video_image="/files/sections/preview/$video_image";
			

			?>
			
			<div id="myElement">Loading the player...</div>
			
			
			<script type="text/javascript">
			    jwplayer("myElement").setup({
			        file: "<?=$video_url?>",
			        
			        image: "<?=$video_image?>",
			        
			        
			        width: 854,
			        height: 510,
			        primary: 'html5',
			        html5player:'/js/jquery/jwplayer/jwplayer.html5.js',
			        flashplayer: '/js/jquery/jwplayer/jwplayer.flash.swf'
			    });
			</script>
			<?php 
			// video file
		} 
    	
    	?>
    	
    	<div class="floatClass articleDetailsTitle"><?=$title?></div>
<!--    	<div class="floatClass articleDetailsBottomBorder"></div>-->
    	<div class="floatClass videoLayerText"><?=$text?></div>
    </div>
    
    


</div>