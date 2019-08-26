<style>
.map{
	/*width:300px;*/
	height: 400px;
	
}
</style>


<?php
$id=$branch_details['DynamicPage']['id'];
$title=$branch_details['DynamicPage']['title'];
$text=$branch_details['DynamicPage']['text'];
$x_coordinate=$branch_details['DynamicPage']['x_coordinate'];
$y_coordinate=$branch_details['DynamicPage']['y_coordinate'];
?>


<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	<div class="floatClass contactBranchTextContainer ">
		<?=$text?>
	</div>
	<div class="floatClass col-lg-8 col-md-8 col-sm-12 col-xs-12">
		<div class="map" id="googleMapDiv" ></div>
		
	</div>		
</div>	




<script type="text/javascript">
	
	$(document).ready(function(){
		initialize();
		
	});
	  
	
	
	function initialize() {
		
	  var myLatlng = new google.maps.LatLng(<?php echo $x_coordinate; ?>,<?php echo $y_coordinate; ?>);
	  var myOptions = {
	    zoom: 14,
	    center: myLatlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  var map = new google.maps.Map(document.getElementById("googleMapDiv"), myOptions);
	 // Creating a marker and positioning it on the map
		var marker = new google.maps.Marker({
		  position: new google.maps.LatLng(<?php echo $x_coordinate; ?>,<?php echo $y_coordinate; ?>),
		  map: map
		});
		
	
	}

</script>

				