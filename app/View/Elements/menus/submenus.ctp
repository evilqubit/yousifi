<?php 

if(isset($subMenuData) && !empty($subMenuData)){?>

<div class="submenu" id="subMenu_<?=$section?>">
		<ul class="">
			<?php 		
				$index=0;
				$row_index=0;
				$total=count($subMenuData);
				foreach($subMenuData as $subChild){
					
					
					
					$index++;
					//$section = $subChild["DynamicPage"]["section"];
					$pageId = $subChild["DynamicPage"]["id"];
					$pageSlug = $subChild["SeoManagement"]["slug"];
					$sub_pages_count1=count($subChild["SubPage"]);
					
					
					$aStart = "<a href='/$lang/DynamicPages/index/$pageId/$pageSlug'>";
					$aEnd = "</a>";
							
						?>
						<!-- start div  -->
						<?php if (($row_index % 4) == 0){
							echo "<div style='clear: both;'>";
						} ?>
						
							
						<!--  -->
							<li class="floatClass submenu_element" id="subMenu_<?=$pageId?>">
								<div class="floatClass sub_mainLink"><?=$aStart.($subChild['DynamicPage']['title']).$aEnd;?><div class="green_arrow_2"></div></div>
								
								
								<!--/////////////////			 submenu 1 		////////////////////////////////  -->
								<!-- if(isset($subChild["SubPage"]) && !empty($subChild["SubPage"]) -->
								<?php if(false){ ?>
									
									<div class="submenu1" id="submenu1_<?=$pageId?>" style="display: none;">
											<ul class="floatClass">
												<?php 
												$row_index1=0;
												$row1_total=count($subChild["SubPage"]);
												foreach($subChild["SubPage"] as $sub_subChild){
													$subpageId = $sub_subChild["id"];
													$pageSlug = $sub_subChild["SeoManagement"]["slug"];
													
													$sub_pages_count2=count($sub_subChild["sub_sub_menu"]);
													
													$aStart = "<a class='sub_subMenu_anchor' href='/$lang/DynamicPages/index/$subpageId/$pageSlug'>";
													$aEnd = "</a>";
													
													if (($row_index1 % 2) == 0){
														echo "<div style='clear: both;'>";
													}
							
												?>
														<li style="z-index: 10;" class="floatClass submenu_element1" id="sub_subMenu_<?=$subpageId?>" >
															<div class="floatClass sub_mainLink1"><?=$aStart.($sub_subChild['title']).$aEnd;?><div class="green_arrow_3"></div></div>
															
															<!--/////////////////			 submenu 2 		////////////////////////////////  -->
															<?php if(isset($sub_subChild["sub_sub_menu"]) && !empty($sub_subChild["sub_sub_menu"])){ ?>
																
																<div class="submenu2"  id="submenu2_<?=$subpageId?>" style="display: none; z-index: 90000;">
																		<ul class="floatClass">
																			<?php 
																			$row_index2=0;
																			$row1_tota2=count($sub_subChild["sub_sub_menu"]);
																			foreach($sub_subChild["sub_sub_menu"] as $sub_subChild2){
																				$subpage2Id = $sub_subChild2["DynamicPage"]["id"];
																				$pageSlug = $sub_subChild2["SeoManagement"]["slug"];
								
																				$aStart = "<a href='/$lang/DynamicPages/index/$subpage2Id/$pageSlug'>";
																				$aEnd = "</a>";
																				
																				if (($row_index2 % 2) == 0){
																					echo "<div style='clear: both;'>";
																				}
														
																			?>
																					<li class="floatClass submenu_element2" style=" z-index: 90000;">
																						<div class="floatClass sub_mainLink2"><?=$aStart.($sub_subChild2["DynamicPage"]['title']).$aEnd;?></div>
																					</li>
																					
																					
																					
																					
																				<?php 
																					$row_index2++;
																				if (($row_index2 % 2) == 0 || ($row1_tota2 == $row_index2)){
																					echo "</div>";
																				} ?>
																			<?php }
																			?>
																		</ul>
																</div>
															<?php }?>
															
															
															<!--/////////////////			 end of submenu 2 		////////////////////////////////  -->
														</li>
														
														<script type="text/javascript">
															var config2 = {
																over: function(elemt){
																	//alert('test');
																	$(this).children('.sub_mainLink1').css('background-color',"#006a72");
																	
																	$(this).css("z-index","11");
																	
																	$(this).find('.sub_subMenu_anchor').css("color","#ffffff");
																	
																	<?php if(($sub_pages_count2 > 0) ){?> 
																	$(this).find('.green_arrow_3').show();
																	<?php  } ?>
																	
																	$('#submenu2_<?=$subpageId?>').show();
																},
																timeout: 300, // number = milliseconds delay before onMouseOut
																out: function(){
																	$(this).children('.sub_mainLink1').css('background-color',"");
																	$(this).find('.sub_subMenu_anchor').css('color',"#008487");
																	
																	$(this).css("z-index","10");
																	
																	<?php if(($sub_pages_count2 > 0) ){?> 
																	$(this).find('.green_arrow_3').hide();
																	<?php  } ?>
										
																	$('#submenu2_<?=$subpageId?>').hide();
																}
															};
															$('#sub_subMenu_<?=$subpageId?>').hoverIntent(config2);
														</script>
														
																
														<?php 
															$row_index1++;
														if (($row_index1 % 2) == 0 || ($row1_total == $row_index1)){
															echo "</div>";
														} ?>
													<?php }
													?>
												</ul>
										</div>
									<?php }?>
									
									
									<!--/////////////////			 end of submenu 1 		////////////////////////////////  -->
							</li>
							
							<script type="text/javascript">
								var config1 = {
									over: function(elemt){
										$(this).children('.sub_mainLink').css('background-color',"#008486");
										
										<?php if(($sub_pages_count1 > 0) ){?> 
										//$(this).find('.green_arrow_2').show();
										<?php  } ?>
										$('#submenu1_<?=$pageId?>').show();
									},
									timeout: 300, // number = milliseconds delay before onMouseOut
									out: function(){
										$(this).children('.sub_mainLink').css('background-color',"");
										<?php if(($sub_pages_count1 > 0) ){?> 
										//$(this).find('.green_arrow_2').hide();
										<?php  } ?>
										
										$('#submenu1_<?=$pageId?>').hide();
									}
								};
								$('#subMenu_<?=$pageId?>').hoverIntent(config1);
							</script>
													
						<?php 
							$row_index++;
						if (($row_index % 4) == 0 || ($total == $row_index)){
							echo "</div>";
						} ?>
						<!-- end div  -->
				<?php }
			?>
		</ul>

</div>

<?php }?>


