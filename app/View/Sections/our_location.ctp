<div class="row locations-con">
	<div class="info">
		<?php 
		$title=$section_details['Section']['internal_title'];
		
		?>
		<h2><?=$title?></h2>
		<section class="malls">
			<?php
			$index=1;
			$x_co_1='';
			$y_co_1='';
			
			$x_co_2='';
			$y_co_2='';
			
			$x_co_3='';
			$y_co_3='';
			
			$title1='';
			$title2='';
			$title3='';
			
			
			foreach($branches as $branch){
				$id=$branch['Branch']['id'];
				$title=$branch['Branch']['title'];
				$open_hours=$branch['Branch']['open_hours'];
				$phone=$branch['Branch']['phone'];
				
				$x_coordinate=$branch['Branch']['x_coordinate'];
				
				$y_coordinate=$branch['Branch']['y_coordinate'];
				
				
				$url='';
				$onclick="show_stores($id)";
				
				
				
				if($index == 1){
					$x_co_1=$x_coordinate;
					$y_co_1=$y_coordinate;
					$title1=$title;
					
				}elseif($index == 2){
					$x_co_2=$x_coordinate;
					$y_co_2=$y_coordinate;
					$title2=$title;
					
				}elseif($index == 3){
					
					$x_co_3=$x_coordinate;
					$y_co_3=$y_coordinate;
					$title3=$title;
				}
				
				
				?>
				
				
				<article class="color-<?=$index?>">
					<h3>LeMall<br><?=$title?></h3>
					<p class="phone"><?=$phone?></p>
					<p>Opening hours:<br><strong><?=$open_hours?></strong></p>
					<span style="cursor: pointer;" class="link" onclick="<?=$onclick?>" >View stores in this mall</span>
				</article>
				
				<?php 
				$index++;
				
			}
			 ?>
			 
			<script type="text/javascript">
				function show_stores(branch_id){
					
					   $.ajax({
							url: '/Pages/view_stores/'+branch_id,
							beforeSend:function(data){
								
							},
							success: function(data){
								
								$('#my_stores').popup('show');
								$('#my_stores').html(data);
								
								
								
							},
							complete: function(){
								
							}
						});
					 }
					
				
			</script> 
			 
			 
			 
			<!-- <article class="color-1">
				<h3>LeMall<br>Dbayeh</h3>
				<p class="phone">+961 4 408 111</p>
				<p>Opening hours:<br><strong>Everyday from 10 AM till 10 PM</strong></p>
				<a class="link" href="#">View stores in this mall</a>
			</article>
			<article class="color-2">
				<h3>LeMall<br>Dbayeh</h3>
				<p class="phone">+961 4 408 111</p>
				<p>Opening hours:<br><strong>Everyday from 10 AM till 10 PM</strong></p>
				<a class="link" href="#">View stores in this mall</a>
			</article>
			<article class="color-3">
				<h3>LeMall<br>Dbayeh</h3>
				<p class="phone">+961 4 408 111</p>
				<p>Opening hours:<br><strong>Everyday from 10 AM till 10 PM</strong></p>
				<a class="link" href="#">View stores in this mall</a>
			</article> -->
		</section>
	</div>
	<div class="map">
		<div id="map-canvas-simple"></div>			
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script>
	function initialize() {
	  var myLatlng1 = new google.maps.LatLng(<?=$x_co_1?>, <?=$y_co_1?>);
	  var myLatlng2 = new google.maps.LatLng(<?=$x_co_2?>, <?=$y_co_2?>);
	  var myLatlng3 = new google.maps.LatLng(<?=$x_co_3?>,  <?=$y_co_3?>);
	  var mapOptions = {
		zoom: 15,
		
	  scrollwheel: true,
	  disableDefaultUI: true,
		center: myLatlng1
	  }
	  var map = new google.maps.Map(document.getElementById('map-canvas-simple'), mapOptions);
	
	  var marker = new google.maps.Marker({
		  position: myLatlng1,
		  map: map,
		  title: '<?=$title1?>'
	  });
	  
	  
	  var marker = new google.maps.Marker({
		  position: myLatlng2,
		  map: map,
		  title: '<?=$title2?>'
	  });
	  
	    var marker = new google.maps.Marker({
		  position: myLatlng3,
		  map: map,
		  title: '<?=$title3?>'
	  });
	  
	  
	  
	  
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
	
		</script>
	</div>
</div>






