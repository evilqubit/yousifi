
<div class="floatClass textArea  addTopSpace">
	<?php 
	$title=$section_details["Section"]['internal_title'];
	$text=$section_details["Section"]['text_1'];
	
	$x_coordinate=$section_details["Section"]['x_coordinate'];
	$y_coordinate=$section_details["Section"]['y_coordinate'];
	
	?>
	
	<div class="floatClass PageTitle"><?=strtoupper($title)?></div>
	<div class="floatClass PageText"><?=$text?></div>
	
	
	<div class="get_here_map" id="get_here_map"></div>
	
<?php
if(isset($data_list) && !empty($data_list)){
	
	foreach($data_list as $oh){
		$title=$oh['Section']['title'];
		$text=$oh['Section']['text_1'];
		$img=$oh['Section']['image'];
		
		$img="/files/sections/thumb/$img";
		
	?>
	<div class="floatClass getHereContainer">
		<div class="floatClass getHereImage"><img src="<?=$img?>" alt='<?=$title?>' /></div>
		<div class="floatClass getHereTextContainer">
			<div class="floatClass getHereListTitle" >
				<?=$title?>
				<div style="width: 100%; height: 1px; background-color: #000000;"></div>
				
			</div>
			<div class="floatClass getHereText"><?=$text?></div>
		</div>
	</div>
	<?php 
}

}
 ?>
 </div>



<script type="text/javascript">
	
	$(document).ready(function(){
		loadScript();
		
	});
	  
	function loadScript() {
	  var script = document.createElement("script");
	  script.type = "text/javascript";
	  script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
	  document.body.appendChild(script);
	  
	}
	
	function initialize() {
	  var myLatlng = new google.maps.LatLng(<?php echo $x_coordinate; ?>,<?php echo $y_coordinate; ?>);
	  var myOptions = {
	    zoom: 14,
	    center: myLatlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  var map = new google.maps.Map(document.getElementById("get_here_map"), myOptions);
	 // Creating a marker and positioning it on the map
		var marker = new google.maps.Marker({
		  position: new google.maps.LatLng(<?php echo $x_coordinate; ?>,<?php echo $y_coordinate; ?>),
		  map: map
		});
		
	
	}

</script>
