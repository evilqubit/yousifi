<div class="floatClass SearchMainContainer">
	<div class="floatClass searchResultheader">
		
		<?php 
		
		
		$header_title='';
		
		$header_title=__("search_result",true)." : "."<span class=''>$search_text</span>";
			
		
		
		echo $header_title;
		?>
		
		
		
	</div>
	
	
	
	<div class="floatClass articleContainer" id="paginatedContent">
		
		<div class="floatClass searchContent">
			<?php
			
			$no_result=0;
			
			
			if(!empty($search_result['Section'])){
				$no_result=1;				
			}
			if(!empty($search_result['Job'])){
				$no_result=1;				
			}
			if(!empty($search_result['Service'])){
				$no_result=1;				
			}
			if(!empty($search_result['Category'])){
				$no_result=1;				
			}
			if(!empty($search_result['Shop'])){
				$no_result=1;				
			}
			if(!empty($search_result['main_sections'])){
				$no_result=1;				
			}
			
			
			 
			 
			 
			
			
			if($no_result == 1){
				
				
				
				//print_r($search_result);exit;
				
				foreach($search_result  as $model=>$data){
					
					
					
					if($model == 'Section'){
						
						foreach($data  as $content ){
							$id=$content['Section']['id'];	
							$title=$content['Section']['title'];
							$text=$content['Section']['text_1'];
							$section=$content['Section']['section'];
							$slug=$content['SeoManagement']['slug'];
							
							$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
								
							//$desc	=$text;		
								
							$text=strip_tags($text,'');	
							$desc = $this->text->excerpt($text,$search_text,280,"...");
							$desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
// 							
							
							
							$url='';
							if($section == 'videos'){
								$url="/$lang/Sections/videos/?video_id=$id";							
							}
							
							if($section == 'overview'){
								$url="/$lang/Sections/overview";
								$title=__("overview",true);	
							}
							if($section == 'get_here'){
								$url="/$lang/Sections/get_here";
								$title=$content['Section']['internal_title'];													
							}
							
							if($section == 'opening_hours'){
								$url="/$lang/Sections/opening_hours";
																					
							}
							
							if($section == 'articles'){
								$url="/$lang/Sections/article_details/$id";
																					
							}
							if($section == 'contact'){
								$url="/$lang/Sections/contact_us";
								$title=$content['Section']['internal_title'];													
							}
							
							
							if($section == 'terms_conditions'){
								$url="/$lang/Sections/terms_conditions";
								$title=$content['Section']['internal_title'];													
							}
							
							if($section == 'privacy'){
								$url="/$lang/Sections/privacy";
								$title=$content['Section']['internal_title'];													
							}
							
							
							
							?>
								<div class="floatClass searchResultRow">
									<div class="floatClass searchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
									<div class="floatClass searchResultText"><a href="<?=$url?>"><?=$desc?></a></div>
								</div>
							<?php 
						}						
					}
					
					if($model == 'main_sections'){
						
						foreach($data  as $content ){
							$id=$content['Section']['id'];	
							$title=$content['Section']['title'];
							$text=$content['Section']['text_1'];
							$section=$content['Section']['section'];
							$slug=$content['SeoManagement']['slug'];
							
							$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
												
							// $desc = $this->text->excerpt($text,$search_text,280,"...");
							// $desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
// 							
							
							
							$url='';
							
							
							
							if($section == 'shop'){
								$url="/$lang/Sections/categories/shop";							
							}
							if($section == 'dine'){
								$url="/$lang/Sections/categories/dine";							
							}
							if($section == 'entertain'){
								$url="/$lang/Sections/categories/entertain";							
							}
							if($section == 'overview'){
								$url="/$lang/Sections/overview";
								$title=__("overview",true);	
							}
							
							if($section == 'opening_hours'){
								$url="/$lang/Sections/opening_hours";
																					
							}
							
							
							
							if($section == 'get_here'){
								$url="/$lang/Sections/get_here";
								$title=$content['Section']['internal_title'];													
							}
							
							if($section == 'services'){
								$url="/$lang/Sections/services";
								$title=$content['Section']['internal_title'];
																					
							}
							
							
							
							if($section == 'articles'){
								$url="/$lang/Sections/articles";
								$title=$content['Section']['internal_title'];
																					
							}
							
							if($section == 'videos'){
								$url="/$lang/Sections/videos";	
								$title=$content['Section']['internal_title'];						
							}
							
							if($section == 'contact'){
								$url="/$lang/Sections/contact_us";
								$title=$content['Section']['internal_title'];													
							}
							
							
							if($section == 'get_here'){
								$url="/$lang/Sections/get_here";
								$title=$content['Section']['internal_title'];													
							}
							if($section == 'store_locator'){
								$url="/$lang/Sections/store_locator";
								$title=$content['Section']['internal_title'];													
							}
							if($section == 'sitemap'){
								$url="/$lang/Sections/sitemap";
								$title=$content['Section']['internal_title'];													
							}
							
							
							
							if($section == 'terms_conditions'){
								$url="/$lang/Sections/terms_conditions";
								$title=$content['Section']['internal_title'];													
							}
							
							if($section == 'privacy'){
								$url="/$lang/Sections/privacy";
								$title=$content['Section']['internal_title'];													
							}
							
							
							
							
							
							?>
								<?php  
								
								if($section == 'careers'){
									$careers_form_url="/$lang/Sections/vacancies/?section=vacancies";
									$careers_url="/$lang/Sections/upload_your_cv/?section=upload_your_cv";
									
									$career_form_title=__("Upload_your_CV",true);
									$career_title=__("Vacancies",true);
										
										?>
										<div class="floatClass searchResultRow">									
											<div class="floatClass searchResultTitle"><a href="<?=$careers_form_url?>"><?=$career_form_title?></a></div>											
										</div>
										
										<div class="floatClass searchResultRow">									
											<div class="floatClass searchResultTitle"><a href="<?=$careers_url?>"><?=$career_title?></a></div>											
										</div>
										<?php 											
								}else{
								?>
								<div class="floatClass searchResultRow">
									
									<div class="floatClass searchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
									
								</div>
							<?php
								} 
						}						
					}




					if($model == 'Service'){
						
						foreach($data  as $content ){
							$id=$content['Service']['id'];	
							$title=$content['Service']['title'];
							$text=$content['Service']['text'];
							
							$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
												
							$desc = $this->text->excerpt($text,$search_text,280,"...");
							$desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
							
							$url='';
							
							$url="/$lang/Sections/services";
							
							?>
								<div class="floatClass searchResultRow">
									<div class="floatClass searchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
									<div class="floatClass searchResultText"><a href="<?=$url?>"><?=$desc?></a></div>
								</div>
							<?php 
						}						
					}
					
					if($model == 'Job'){
						
						foreach($data  as $content ){
							$id=$content['Job']['id'];	
							$title=$content['Job']['title'];
							$text=$content['Job']['text'];
							
							$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
												
							$desc = $this->text->excerpt($text,$search_text,280,"...");
							$desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
							
							$url="/$lang/Sections/careers?job_id=$id";
							
							?>
								<div class="floatClass searchResultRow">
									<div class="floatClass searchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
									<div class="floatClass searchResultText"><a href="<?=$url?>"><?=$desc?></a></div>
								</div>
							<?php 
						}						
					}	
					
					if($model == 'Category'){
						
						foreach($data  as $content ){
							$id=$content['Category']['id'];	
							$title=$content['Category']['title'];
							
							
							$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
												
							// $desc = $this->text->excerpt($text,$search_text,280,"...");
							// $desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
							
							$url="/$lang/Sections/index/$id";
							
							?>
								<div class="floatClass searchResultRow">
									<div class="floatClass searchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
									<!-- <div class="floatClass searchResultText"><a href="<?=$url?>"><?=$desc?></a></div> -->
								</div>
							<?php 
						}						
					}
					
					
					
					if($model == 'Shop'){
						
						foreach($data  as $content ){
							$id=$content['Shop']['id'];	
							$title=$content['Shop']['title'];
							$text=$content['Shop']['text'];
							$section_id=$content['Shop']['section_id'];
							$category_id=$content['Shop']['category_id'];
							
							$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
												
							$desc = $this->text->excerpt($text,$search_text,280,"...");
							$desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
							
							$url=$content['Shop']['url'];
							//$url="/$lang/Sections/careers?job_id=$id";
							
							
							// if($section_id == 3){
								// $url="/$lang/Sections/entertain/?shop_id=$id";
// 													
							// }else{
								// $url="/$lang/Sections/index/$category_id/?shop_id=$id";
// 								
							// }
							
							?>
								<div class="floatClass searchResultRow">
									<div class="floatClass searchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
									<div class="floatClass searchResultText"><a href="<?=$url?>"><?=$desc?></a></div>
								</div>
							<?php 
						}						
					}	
				}					
			}else{
				echo "<div class='notResultText'>".__('no_data',true)."</div>";
			}
			 ?>
		</div>
		

	</div>
</div>
