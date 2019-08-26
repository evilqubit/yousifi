<?php if ($lang =='en'){
	$direction_left='left';
	$direction_right='right';
	$direction='left';
}elseif($lang =='ar'){
	$direction_left='left';
	$direction_right='right';
	$direction='right';
}

 ?>

<style>
.album_photo_overlay{

    /*background: url("/img/en/message.jpg") no-repeat; */
    /* must be initially hidden */
    display:none;
 
    /* place overlay on top of other elements */
    z-index:99999;
 
    /* styling */
    background-color:#ffffff;
 
    
    min-height:189px;
    /*border:1px solid #666;*/
    
    /*width: 594px;*/
    width: 520px;
    height: auto;
    top:0px !important;
    
    padding:0px;
    
    /* CSS3 styling for latest browsers */
    box-shadow:0 0 10px 5px #C9C7C7;
    -webkit-box-shadow: 0 0 10px 5px #C9C7C7;
    
    padding-left: 37px;
    padding-right: 37px;
    padding-bottom: 30px;
    padding-top: 30px;
    
    
    
}
.album_photo_overlay .photoCloseBtn {
	
   font-family: Arial;
   font-size: 12px;
   color: #2e3192;
   font-weight: bold;
   cursor: pointer;
}

#OverlayPhotoAlbum{

    width: 520px;
    height: auto;
    z-index: 99999; 
}

.service_overlay_images{
	width: 520px;
	height: 251px;
	clear: both;
	margin-top: 15px;
	margin-bottom: 25px;
}


</style>


<div class="album_photo_overlay" id="photoOverlay">	
	  <!--////////////// close button///////////////	 -->
	  
	  
	 
	  
</div>
<script type="text/javascript"> 
	var slider='';
	var auto_play=0;
	
	//set the overlay setting
	$("#photoOverlay").overlay({
 
    // some mask tweaks suitable for facebox-looking dialogs

	    // disable this for modal dialog-type of overlays
	    closeOnClick: true,
	    onClose: function (){
			//slider.exitFullscreen();
			//slider.destroy();
			
	    },
	    top: 0,
	    <?=$direction?>: -600,
	    fixed: false,
	    load:false
    });
    
   
 $(document).ready(function($) {
 	// $("#photoOverlay").overlay().load();
});
			
	
	
	
	



</script>