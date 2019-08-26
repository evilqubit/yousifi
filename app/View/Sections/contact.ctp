<div class="row contacts-con">
	<div class="hold right">
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/infobox/1.1.12/src/infobox.js"></script>
		<div id="map_canvas"></div>
		<div style="">
			
		<div style="position: absolute; z-index: 222; top:30px; left: 20px;">SELECT BRANCH</div>
		<select id="map-select">
			<?php 
			
			
			
			$index=1;
			$first_x='';
			$first_y='';
			foreach($branches as $branch){
				$id=$branch['Branch']['id'];
				$title=$branch['Branch']['title'];
				$text=$branch['Branch']['text'];
				
				if($index == 1){
					$first_x=$branch['Branch']['x_coordinate'];
					$first_y=$branch['Branch']['y_coordinate'];
				}
			
			?>
			<option value="<?=$index?>"><?=$title?></option>
			
			<?php 
			$index++;
			} 
			
			
			
			?>
			<!-- <option value="2">dbayeh</option><option value="3">dbayeh</option> -->
			
			
		</select>
		
		</div>
	</div>

	<div class="hold left" style="margin-bottom: 20px;">
		
		<?php 
		
		$title=$section_details['Section']['internal_title'];
		$text=$section_details['Section']['text_1'];
		?>
		<h2><?=$title?></h2>
		<p><?=$text?></p>
		<form   type='file'  enctype="multipart/form-data"   method="post" id="contactForm" action="/Contacts/save_contact/">
			<fieldset>
				<label>Name</label>
				<input required name="data[Contact][name]" type="text">
			</fieldset>
			<fieldset>
				<label>e-mail</label>
				<input required name="data[Contact][email]"  type="email">
			</fieldset>
			<fieldset class="full">
				<label>Leave your message</label>
				<textarea required name="data[Contact][message]" ></textarea>
			</fieldset>
			
			
			<div class="contact_recaptcha_details floatClass" id="recaptcha_container" style="clear: both; float: left;">
					<?php 
					
						echo $this->element("recaptcha",array("className"=>"contactInput",'width'=>"290px" , 'image'=>'captcha_sprite_grey.png' , 'border_color'=>'#b5b5b5'));
					
					?>
			</div>
			<div style="clear: both;">
				<div style="display: none; float: right;" id="jobAjaxBtn"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
				<button class="btn btn-success" id="jobSubmitBtn" type="submit">submit</button>
				<button class="btn btn-grey" id="jobRestBtn" type="reset">clear</button>
			</div>
			
		</form>
		
		<div id="msg" class="FormStatus col-lg-12 col-md-12 col-sm-12 col-xs-12 " onclick="$('#msg').fadeOut();" style="display:none; float:right; text-align: right; margin-top: 20px; clear:both; color: #11b3c0;1px solid #bbbbbb; font-size: 20px;"></div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		
		
		
		
		
		
		var options = {
			beforeSubmit: function(){
				// var valid = validation();
					// if (valid == 1){
						// return true;
					// }
					// else{
						// return false;
					//}
					
				$("#jobSubmitBtn").hide();
				$("#jobRestBtn").hide();
				$("#jobAjaxBtn").show();
			},
			resetForm: false,
			success:function(data){
				$("#jobSubmitBtn").show();
				$("#jobRestBtn").show();
				$("#jobAjaxBtn").hide();
				
				var msg='';

				data=parseInt(data);
				
				switch(data)
				{
				case 1:
				  msg='<?=__("visual_code",true);?>'
				  break;
				case 2:
				  msg='<?=__('required_fields',true);?>'
				  break;
				case 3:
				  msg='<?=__("email_sent",true);?>'
				  break;
				case 4:
				  msg='<?=__('valid_email',true);?>'
				  break;
				default:
				  break
				}
				
				
				
				if(data == 3){
					
					$('#contactForm').clearForm();
					$('#contactForm').resetForm();
					
				}else{
					
				}
				
				$('#msg').html(msg);
				$('#msg').show();
				
				//Recaptcha.reload();
				
				
			}
		};
			$('#contactForm').ajaxForm(options);
	 		$("#contactForm").addClass('requiredField');
		
		
		
		
		// google map configuration 		
		
		
		
		
		if ($("#map_canvas").length) {

			var ib = new InfoBox();
			var map;
			function initialize() {
				if ($("#map_canvas").length) {
	
					var mapOptions = {
					  zoom: 12,
					  center: new google.maps.LatLng(<?=$first_x?>,<?=$first_y?>),
					  mapTypeId: google.maps.MapTypeId.ROADMAP,
					  scrollwheel: false,
					  disableDefaultUI: true
					};
					map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
	
				    google.maps.event.addListener(map, "click", function() { ib.close() });
	
					setMarkers(map, sites);
					infowindow = new google.maps.InfoWindow({
					    content: "loading..."
					});
		    		google.maps.event.trigger(markersArray[0], 'click');
	
				}
			}
			var markersArray = [];
	
			var sites = [
				
				<?php foreach($branches as $branch){
					 $id=$branch["Branch"]['id'];
					 $address=$branch["Branch"]['address'];
					 $phone=$branch["Branch"]['phone'];
					 $x_coordinate=$branch["Branch"]['x_coordinate'];
					 $y_coordinate=$branch["Branch"]['y_coordinate'];
					 
					 $mobile=$branch["Branch"]['mobile'];
					 $fax=$branch["Branch"]['fax'];
					 $email=$branch["Branch"]['email'];
					 
					
                   ?>
                    ['we’re here', <?=$x_coordinate?>,<?=$y_coordinate?>, 1, '<div class="map-box"><h2>we’re here </h2><div class="holder"><p><strong>address:</strong> <?=$address?></p><?php if(!empty($phone)){echo "<p><strong>Phone:</strong>".$phone;} ?> <?php if(!empty($mobile)){ echo "<br><strong>mobile:</strong>".$mobile;} ?>   <?php if(!empty($fax)){echo "<br><strong>fax:</strong></p>".$fax;}?>  <?php if(!empty($email)){ echo "<p><strong>e-mail:</strong> <a href=\'#\'>$email</a></p>";} ?> </div></div>'],
				
                   <?php 
                   
				} ?>
				
				
				
			];
	
			$("#map-select").change(function() {
				var curIN = $(this).val()-1;
			    var siteLatLng = new google.maps.LatLng(sites[curIN][1], sites[curIN][2]);
				map.setCenter(siteLatLng);
			    google.maps.event.trigger(markersArray[curIN], 'click');
				return false;
			});
	
	
			function createMarker(site, map){
			    var siteLatLng = new google.maps.LatLng(site[1], site[2]);
			    var marker = new google.maps.Marker({
			        position: siteLatLng,
			        map: map,
			        title: site[0],
			        zIndex: site[3],
			        html: site[4]
			    });
			    markersArray.push(marker);
			    // Begin example code to get custom infobox
			    var boxText = document.createElement("div");
			    boxText.style.cssText = "border: 0; margin-top: 0; background: none; padding: 0;";
			    boxText.innerHTML = marker.html;
			    var myOptions = {
		             content: boxText
		            ,disableAutoPan: false
		            ,maxWidth: 0
		            ,pixelOffset: new google.maps.Size(-170, 0)
		            ,zIndex: null
		            ,boxStyle: { 
		              background: ""
		              ,opacity: 1
		              ,width: "340px"
		             }
		            ,closeBoxMargin: "0 0"
		            ,closeBoxURL: "/img/space.png"
		            ,infoBoxClearance: new google.maps.Size(1, 1)
		            ,isHidden: false
		            ,pane: "floatPane"
		            ,enableEventPropagation: false
			    };
			    // end example code for custom infobox
	
			    google.maps.event.addListener(marker, "click", function (e) {
			     ib.close();
			     ib.setOptions(myOptions);
			     ib.open(map, this);
			    });
			    return marker;
			}
	
	
			function setMarkers(map, markers) {
	
			 for (var i = 0; i < markers.length; i++) {
			   createMarker(markers[i], map);
			 }
			};
	
			initialize();
	
	
		};
	});
	
</script>