<style>
.album_overlay{

    /*background: url("/img/en/message.jpg") no-repeat; */
    /* must be initially hidden */
    display:none;
 
    /* place overlay on top of other elements */
    z-index:999999 !important;
 
    /* styling */
    background-color:#ffffff;
 
    
    min-height:189px;
    /*border:1px solid #666;*/
    
    /*width: 594px;*/
    width: 498px;
    height: auto;
    /*top:0px !important;*/
    
    padding:0px;
    
    /* CSS3 styling for latest browsers */
    /*box-shadow:0 0 10px 5px #C9C7C7;
    -webkit-box-shadow: 0 0 10px 5px #C9C7C7;*/
    
    padding-left: 30px;
    padding-right: 30px;
    padding-bottom: 32px;
    padding-top: 32px;
    
    
    
}
.album_CloseBtn {
	
   width: 14px;
   height: 15px;
   background:url(/img/sprite.png) -83px -283px;
   cursor: pointer;
   position: absolute;
   top:-25px;
   right: 0px;
   
}

.album_img_preview{
	width: 497px;
	height: 293px;
	overflow: hidden;
	clear: both;
	margin-bottom: 5px;
	text-align: center;
}
</style>


<div class="album_overlay" id="photoOverlay">	
	  
	 
	  
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
	     mask: {
 
	    // you might also consider a "transparent" color for the mask
	    color: '#000000',
	 
	    // load mask a little faster
	    loadSpeed: 200,
	 
	    // very transparent
	    opacity: 0.7
	    },
	    top: "20%",
	    
	    fixed: false,
	    load:false
    });
    
   
 $(document).ready(function($) {
 	//$("#photoOverlay").overlay().load();
});

</script>