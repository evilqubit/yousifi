<?php 

if(isset($inner_menuChildren) && !empty($inner_menuChildren)){?>

<div class="inner_main_menu floatClass" id="inner_menu">
		<ul class="">
			<?php 		
				$index=0;
				
				$total=count($inner_menuChildren["$section"]);
				foreach($inner_menuChildren["$section"] as $subChild){
					
					
					
					$index++;
					//$section = $subChild["DynamicPage"]["section"];
					$pageId = $subChild["DynamicPage"]["id"];
					$pageSlug = $subChild["SeoManagement"]["slug"];
					$sub_pages_count1=count($subChild["SubPage"]);
					
					$active_class='';
					if(isset($this_id)){
						if($pageId == $this_id){
							$active_class='active_menu';
						}
					}
					$href="/$lang/DynamicPages/index/$pageId/$pageSlug";
					$onclick="openMenuContent('$href'); ";
					
					// $aStart = "<a class='inner_menu_anchor $active_class'  href='/$lang/DynamicPages/index/$pageId/$pageSlug'  onclick=$onclick >";
					// $aEnd = "</a>";
					
							
						?>
						<!-- start div  -->
					
						
							
						<!--  -->
							<li class="floatClass inner_submenu_element" id="inner_subMenu_<?=$pageId?>">
								<div class="floatClass inner_sub_mainLink" >
									<a class="inner_menu_anchor <?=$active_class?>"  href=<?=$href?>   onclick="<?=$onclick?> return false; " ><?=($subChild['DynamicPage']['title'])?></a>
									<?php if($sub_pages_count1 >0){?>
									<div class="white_arrow"></div>
									<?php }?>
								</div>
								
								
								<!--/////////////////			 submenu 1 		////////////////////////////////  -->
								
									<?php if(isset($subChild["SubPage"]) && !empty($subChild["SubPage"])){ ?>
									
									<div class="inner_sub_menu1" id="inner_sub_menu1_<?=$pageId?>" style="display: none;">
											<ul class="floatClass">
												<?php 
												
												foreach($subChild["SubPage"] as $sub_subChild){
													$subpageId = $sub_subChild["id"];
													$pageSlug = $sub_subChild["SeoManagement"]["slug"];
													
													$sub_pages_count2=count($sub_subChild["sub_sub_menu"]);
													
													// $aStart = "<a class='sub_subMenu_anchor' href='/$lang/DynamicPages/index/$subpageId/$pageSlug'>";
													// $aEnd = "</a>";
													
													
													$href="/$lang/DynamicPages/index/$subpageId/$pageSlug";
													$onclick="openMenuContent('$href'); ";
													
												?>
														<li class="floatClass inner_submenu1_element" id="inner_sub_subMenu_<?=$subpageId?>">
															<div class="floatClass inner_sub_mainLink1">
																<a class="sub_subMenu_anchor "  href=<?=$href?>   onclick="<?=$onclick?> return false; " ><?=($sub_subChild['title'])?></a>
																<!-- <?=$aStart.strtoupper($sub_subChild['title']).$aEnd;?> -->
																<?php if($sub_pages_count2 > 0)  { ?>
																	<div class="inner_white_arrow"></div>
																<?php } ?>
																
															</div>
															
															<!--/////////////////			 submenu 2 		////////////////////////////////  -->
															
															<?php if(isset($sub_subChild["sub_sub_menu"]) && !empty($sub_subChild["sub_sub_menu"])){ ?>
																
																<div class="inner_sub_menu2" id="inner_sub_subMenu2_<?=$subpageId?>" style="display: none;">
																		<ul class="floatClass">
																			<?php 
																			foreach($sub_subChild["sub_sub_menu"] as $sub_subChild2){
																				$subpage2Id = $sub_subChild2["DynamicPage"]["id"];
																				$pageSlug = $sub_subChild2["SeoManagement"]["slug"];
								
																				$aStart = "<a href='/$lang/DynamicPages/index/$subpage2Id/$pageSlug'>";
																				$aEnd = "</a>";
																				
																				$href="/$lang/DynamicPages/index/$subpage2Id/$pageSlug";
																				$onclick="openMenuContent('$href'); ";
																			?>
																					<li class="floatClass inner_submenu2_element">
																						<div class="floatClass inner_sub_mainLink2">
																							<!-- <?=$aStart.ucwords($sub_subChild2["DynamicPage"]['title']).$aEnd;?> -->
																							<a   href=<?=$href?>   onclick="<?=$onclick?> return false; " ><?=($sub_subChild2["DynamicPage"]['title'])?></a>
																						</div>
																					</li>

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
																	$(this).children('.inner_sub_mainLink1').css('background-color',"#006a72");

																	<?php if(($sub_pages_count2 > 0) ){?> 
																	//$(this).find('.green_arrow_4').show();
																	<?php  } ?>
																	
																	$('#inner_sub_subMenu2_<?=$subpageId?>').show();
																},
																timeout: 300, // number = milliseconds delay before onMouseOut
																out: function(){
																	$(this).children('.inner_sub_mainLink1').css('background-color',"");
																	
																	<?php if(($sub_pages_count2 > 0) ){?> 
																	//$(this).find('.green_arrow_4').hide();
																	<?php  } ?>
										
																	$('#inner_sub_subMenu2_<?=$subpageId?>').hide();
																}
															};
															$('#inner_sub_subMenu_<?=$subpageId?>').hoverIntent(config2);
														</script>
														
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
										
										$(this).find('.inner_menu_anchor').css('color',"#2e9fa7");
										
										
										$('#inner_sub_menu1_<?=$pageId?>').show();
									},
									timeout: 300, // number = milliseconds delay before onMouseOut
									out: function(){
										$(this).find('.inner_menu_anchor').css('color',"#ffffff");
										
										
										$('#inner_sub_menu1_<?=$pageId?>').hide();
									}
								};
								$('#inner_subMenu_<?=$pageId?>').hoverIntent(config1);
							</script>
													
						<!-- end div  -->
				<?php }
			?>
		</ul>

</div>

<?php }?>



<script type="text/javascript">
	var config1 = {
		over: function(elemt){
			$('.mainContent').css('z-index',1002);
		},
		timeout: 300, // number = milliseconds delay before onMouseOut
		out: function(){
			$('.mainContent').css('z-index',999);
		}
	};
	$('#inner_menu').hoverIntent(config1);
</script>
