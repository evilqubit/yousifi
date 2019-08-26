
<div class="floatClass textArea  addTopSpace">
	<?php 
	$title=$section_details["Section"]['internal_title'];
	$text=$section_details["Section"]['text_1'];
	
	?>
	
	<div class="floatClass PageTitle"><?=strtoupper($title)?></div>
	
	
	<div class="floatClass mapLocatorMainContainer">
		
		<div class="floatClass FloorHeader">
			<?php  
			$total_map=count($map_locator);
			$width=$total_map*230;
			 ?>
			<div style="margin: 0 auto; width: <?=$width."px"?>">
			<?php 
			$total_map=count($map_locator);
			$mapTitleCount = 0;
			foreach($map_locator as $map){
				$id=$map['map_details']['Map']['id'];
				$title=$map['map_details']['Map']['title'];
				$onclick="switch_floor($id); return false";
				$url="/$lang/Sections/store_locator/$id";
				
				
				$active_class='';
				if($id == $selected_floor_id){
					$active_class='floorHeaderTitleActive';
				}
				
				if(!is_numeric($selected_floor_id) && $mapTitleCount == 0){
					$active_class='floorHeaderTitleActive';
				}
				
				?>
				
				<div class="floatClass floorHeaderTitle"><a id='mapFloor_<?=$id?>' class="<?=$active_class?> mapFloor" onclick="<?=$onclick?>" href="<?=$url?>"><?=$title?></a></div>
				<?php 
				$mapTitleCount++;
			} ?>
			</div>
		</div>
		<div id="mapLocatorMainContainer">
			
			<?php 
			$total_map=count($map_locator);
			$mapCount = 0;
			foreach($map_locator as $map){
				$id=$map['map_details']['Map']['id'];
				$title=$map['map_details']['Map']['title'];
				$image=$map['map_details']['Map']['image'];
				$onclick='';
				$image="/files/maps/preview/$image";
				$map_data=$map['map_data'];
				
				
				$OtherMapSection=$map['OtherMapSection'];
				
				
				$display='none';
				if($id == $selected_floor_id){
					$display='block';
				}
				
				if(!is_numeric($selected_floor_id) && $mapCount == 0){
					$display='block';
				}
				
				$map_element_id="veg_$id";
				?>
				
				<div style="display: <?=$display?>" id="map_<?=$id?>"  class="floatClass MapContent">
					<!-- map image  -->
					<div class="floatClass MapLocatorImageContainer">
						<img id="<?=$map_element_id?>" usemap="#<?=$map_element_id?>" src="<?=$image?>">
						
						
						
						
						
						
						
						<?php 
						//////////////////// 	other map data tool tips ///////////////////
						
						foreach($OtherMapSection as $other){
							
								$other_id=$other['OtherMapSection']['id'];
								$other_title=$other['OtherMapSection']['title'];							
								$coordinate=$other['OtherMapSection']['coordinate'];
								
									
								$coordinate=explode(',', $coordinate);
								
								$c_index=0;
								$x=0;
								$y=0;
								foreach($coordinate as $c){
									
									if($c_index == 0){
										$x=$c;												
									}
									if($c_index == 1){
										$y=$c;												
									}
									
									if($c_index % 2 == 0){
										if($c < $x){
											$x=$c;
										}
									}else{
										if($c < $y){
											$y=$c;
										}
									}								
									$c_index++;											
								}
								
								$left=$x+20;
								$top=$y+20;	
								
								if($left > 800){
									// $left=$left-320;
									
								}
								
								$left=360;
								$top=100;
								
								$bg = "background-color:#cf3427;";
								
								?>										
								<div class="tool_tip" style="<?php echo $bg;?> top:<?=$top.'px'?>; left:<?=$left.'px'?>;" id="other_tool_tip_<?=$other_id?>">
									<div class="toolTipClose" onclick="close_tool_tip();">X</div>
									<div class="floatClass toolTipTitle" style="color: #ffffff"><?=$other_title?></div>
									
								</div>										
								<?php 
							}

					
						
						////////////////////		tool tips		///////////////////////////////////	
						
						foreach($map_data as $d){						
							$section_name=$d['section_details']['Section']['section'];
							$section_id=$d['section_details']['Section']['id'];
							
							if($section_name == 'entertain'){
								$shop_details=$d['shop_details'];									
								if(!empty($shop_details)){
									
									foreach($shop_details as $sh){
										$shop_id=$sh['Shop']['id'];
										$shop_title=$sh['Shop']['title'];
										$category_id=$sh['Shop']['category_id'];
										
										$shop_location=$sh['Shop']['location'];						
										$coordinate=$sh['MapLocator'][0]['coordinate'];	
										$coordinate=explode(',', $coordinate);
										
										$c_index=0;
										$x=0;
										$y=0;
										foreach($coordinate as $c){
											
											if($c_index == 0){
												$x=$c;												
											}
											if($c_index == 1){
												$y=$c;												
											}
											
											if($c_index % 2 == 0){
												if($c < $x){
													$x=$c;
												}
											}else{
												if($c < $y){
													$y=$c;
												}
											}								
											$c_index++;											
										}
										
										$left=$x+20;
										$top=$y+20;	
										
										$url="/$lang/Sections/entertain/?shop_id=$shop_id";
										
										
										switch ($section_id){
											case 1:
												$bg = "background-color:#522f91;";
												break;
											case 2:
												$bg = "background-color:#00b152;";
												break; 
											case 3:
												$bg = "background-color:#ffb657;";
												break; 
												
										}
										?>										
										<div class="tool_tip" style="<?php echo $bg;?> top:<?=$top.'px'?>; left:<?=$left.'px'?>;" id="tool_tip_<?=$shop_id."_".$id?>">
											<div class="toolTipClose" onclick="close_tool_tip();">X</div>
											<div class="floatClass toolTipTitle"><a href="<?=$url?>"><?=$shop_title?></a></div>
											<div class="floatClass toolTipText"><a href="<?=$url?>"><?=$shop_location?></a></div>
											<div class="floatClass toolTipLink">
												<div class="floatClass toolTipArrow"><a href="<?=$url?>"><img src="/img/spacer.gif" width="18" height="15" alt=""/></a></div>
												<div class="floatClass tooltipShowDetails"><a target="_blank" href="<?=$url?>"><?=__("shop_details",true)?></a></div>
											</div>
											
										</div>										
										<?php 
									}									
								}						
							}else{
								$category_details=$d['category_details'];
								if(!empty($category_details)){
									foreach($category_details as $cat){
										$shop_details=$cat['Shop'];										 
											if(!empty($shop_details)){
												foreach($shop_details as $sh){													
													
													$shop_id=$sh['id'];
													$shop_title=$sh['title'];
													$category_id=$sh['category_id'];
													$shop_location=$sh['location'];	
																
													$coordinate=$sh['MapLocator'][0]['coordinate'];	
													$coordinate=explode(',', $coordinate);
													$c_index=0;
													$x=0;
													$y=0;
													foreach($coordinate as $c){
														if($c_index == 0){
															$x=$c;												
														}
														if($c_index == 1){
															$y=$c;												
														}
														if($c_index % 2  == 0){
															if($c < $x){
																$x=$c;
															}
														}else{
															if($c < $y){
																$y=$c;
															}
														}								
														$c_index++;											
													}
													
													$left=$x+20;
													$top=$y+20;	
													
													$url="/$lang/Sections/index/$category_id/?shop_id=$shop_id";											
													
													switch ($section_id){
														case 1:
															$bg = "background-color:#522f91;";
															break;
														case 2:
															$bg = "background-color:#00b152;";
															break; 
														case 3:
															$bg = "background-color:#ffb657;";
															break; 
															
													}
										
													?>
													<div class="tool_tip" style="<?php echo $bg;?> top:<?=$top.'px'?>; left:<?=$left.'px'?>;" id="tool_tip_<?=$shop_id."_".$id?>">
														<div class="toolTipClose" onclick="close_tool_tip();">X</div>
														<div class="floatClass toolTipTitle"><a href="<?=$url?>"><?=$shop_title?></a></div>
														<div class="floatClass toolTipText"><a href="<?=$url?>"><?=$shop_location?></a></div>
														<div class="floatClass toolTipLink">
															<div class="floatClass toolTipArrow"><a href="<?=$url?>"><img src="/img/spacer.gif" width="18" height="15" alt=""/></a></div>
															<div class="floatClass tooltipShowDetails"><a  target="_blank" href="<?=$url?>"><?=__("shop_details",true)?></a></div>
														</div>
														
													</div>															
													<?php 
												}
											}												
									}									
								}
							}
						}
						/////////////////////////////////////////////////////////
						?>
					
					</div>
					
					
					
					
					
					
					
					
					
					
					<!-- //////////// //////	map coordinate details	////////////////////////  -->
						
						<map id="<?=$map_element_id?>_map" name="<?=$map_element_id?>">	
							
							
							<?php 
							// $OtherMapSection
							
							foreach($OtherMapSection as $other){
								
								$other_id=$other['OtherMapSection']['id'];
								$other_title=$other['OtherMapSection']['title'];							
								$coordinate=$other['OtherMapSection']['coordinate'];
								$sub_SectionMapLocator=$other['SectionMapLocator'];	
							?>										
								<area id="area_<?="other_".$other_id?>" shape="poly"  name="<?="sub_".$other_id?>" coords="<?=$coordinate?>" href="#">
								
								<?php 
								foreach($sub_SectionMapLocator as $sub){
									$sub_id=$sub['id'];							
									$coordinate=$sub['coordinate'];
									?>
									
									<area id="area_<?="sub_".$other_id?>" shape="poly"  name="<?="sub_".$other_id?>" coords="<?=$coordinate?>" href="#">
									 
									<?php 
								}
								?>
							<?php 	
							}
							?>
							
							
												
							<?php 
							
							///////////////// shops 	/////////////////
							$all_shops=array();
							
							$index=0;
							foreach($map_data as $d){
														
								$section_name=$d['section_details']['Section']['section'];
								$section_id=$d['section_details']['Section']['id'];
								
								$color='';
								if($section_id == 1){
									$color='522f91';
								}elseif($section_id == 2){
									$color='00b152';
								}else{
									$color='ffb657';
								}
								
								
								if($section_name == 'entertain'){
									$shop_details=$d['shop_details'];									
									if(!empty($shop_details)){
										foreach($shop_details as $sh){
											$shop_id=$sh['Shop']['id'];							
											$coordinate=$sh['MapLocator'][0]['coordinate'];	
											
											$all_shops[$index]['shop_id']=$shop_id;
											$all_shops[$index]['color']=$color;
											
																				
											?>										
											<area id="area_<?=$shop_id."_".$id?>" shape="poly"  name="<?=$shop_id?>" coords="<?=$coordinate?>" href="#">										
											<?php 
											$index++;
										}									
									}						
								}else{
									$category_details=$d['category_details'];
									if(!empty($category_details)){
										foreach($category_details as $cat){
											$shop_details=$cat['Shop'];										 
												if(!empty($shop_details)){
													foreach($shop_details as $sh){
														$shop_id=$sh['id'];													
														$coordinate=$sh['MapLocator'][0]['coordinate'];	
														
														$all_shops[$index]['shop_id']=$shop_id;
														$all_shops[$index]['color']=$color;
																					
														?>
														<area id="area_<?=$shop_id."_".$id?>" shape="poly"   name="<?=$shop_id?>" coords="<?=$coordinate?>" href="#">													
														<?php 
														$index++;
													}
												}												
										}									
									}
								}
								
								$index++;
							}
							?>					
						</map>
						
						
						<script type="text/javascript">

					$(document).ready(function () {
						   var image = $('#<?=$map_element_id?>');
						   image.mapster(
					       {
					       		fillOpacity: 0.7,
					       		fillColor: "cf3427",
					       		strokeColor: "cf3427 ",
					       		strokeOpacity: 0.7,
					       		strokeWidth: 2,
					       		stroke: true,
					            isSelectable: true,
								singleSelect: true,
					            mapKey: 'name',
					            listKey: 'name',
					            onClick: function (e) {
					                //shop_id=e.key;
					                i=$(this).attr('id');
					                console.log(i);
					                shop=i.split("_");
					                
					                
					                
					                shop_id=shop[1];
					                
					                if(shop_id == 'other' || shop_id == 'sub'){
					                	
					                	other_id=shop[2];
					                	
					                	
					                	
					                	if($("#other_tool_tip_"+other_id).is(":hidden")){
						                	 $(".tool_tip").hide();
						                	$("#other_tool_tip_"+other_id).show();
						                }else{
						                	$(".tool_tip").hide();
						                }
						                
						                 $('html, body').animate({
										        scrollTop: '500px'
										    }, 1000);
					                	//alert(other_id);
					                	
					                }else{
					                	
					                	
					                	 if($("#tool_tip_"+shop_id+'_<?=$id?>').is(":hidden")){
						                	 $(".tool_tip").hide();
						                	$("#tool_tip_"+shop_id+'_<?=$id?>').show();
						                }else{
						                	$(".tool_tip").hide();
						                }
					                }
					                
					            },
					             areas: [
					             
					            <?php
					            
					            foreach($all_shops as $s){
					            	$shop_i=$s['shop_id'];
									$color=$s['color'];
									
									?>
									{
						                key: "<?=$shop_i?>",
						                fillColor: "<?=$color?>"
						            },
									<?php 
					            }
					             ?>
					            
					           
					            ]
            
            
					        });
					      });
					      </script>
						
						
						
						<!-- //////////////////////////////////////////////////////////  -->
						
						
				
					
					<!-- map list  -->
					<?php
					$index=1;
					
					
					foreach($map_data as $d){
						
						$section_id=$d['section_details']['Section']['id'];
						$section_title=$d['section_details']['Section']['title'];
						$section_color=$d['section_details']['Section']['color'];
						$section_name=$d['section_details']['Section']['section'];
						
						$margin='';
						if($index == 3){
							$margin='0px;';
						}
						?>
						
						
					
						
						<div style="margin:<?=$margin?>" class="floatClass MapLocatorSectionContainer">
							<div class="floatClass MapLocatorSectionTitle" style="background-color:<?="#".$section_color;?> "><?=$section_title?></div>
							
							<?php 
							if($section_name == 'entertain'){
								$shop_details=$d['shop_details'];	
								
								
								if(!empty($shop_details)){
									foreach($shop_details as $sh){
										$shop_id=$sh['Shop']['id'];
										$shop_title=$sh['Shop']['title'];
										$coordinate=$sh['MapLocator'][0]['coordinate'];
										$onclick="show_shop_map($shop_id,$id)";
										
										?>
										<div class="floatClass MapLocatorCatContainer">
											<div class="floatClass MapLocatorTitle"  onclick='<?=$onclick?>'><?=$shop_title?></div>											
										</div>
										
										
										<?php 
									}									
								}						
							}else{
								$category_details=$d['category_details'];
								if(!empty($category_details)){
									foreach($category_details as $cat){
										$cat_id=$cat['Category']['id'];
										$cat_title=$cat['Category']['title'];
										$shop_details=$cat['Shop'];										
										?>
										<div class="floatClass MapLocatorCatContainer">
											<div class="floatClass MapLocatorCatTitle"><?=$cat_title?></div>
											
											<?php 
											if(!empty($shop_details)){
												foreach($shop_details as $sh){
													$shop_id=$sh['id'];
													$shop_title=$sh['title'];
													$coordinate=$sh['MapLocator'][0]['coordinate'];
													$onclick="show_shop_map($shop_id,$id)";
													?>
													<div class="floatClass MapLocatorTitle" onclick='<?=$onclick?>'><?=$shop_title?></div>
													
													<?php 
												}
											}
											?>
										</div>
										<?php 
									}									
								}
							}
							?>
						</div>
						
						<?php 
						$index++;
					}
					
					 ?>
					 
				    
					
				</div>
				<?php 
				
				$mapCount++;
			} ?>
			
		</div>
		
	</div>
 </div>
