
<?php 
if($is_ajax == false){
	?>	
	<div class="floatClass SearchMainContainer">
		<div class="floatClass searchResultheader">
			
			<?php 
			$header_title='';
			
			if(isset($search_by_category) && ($search_by_category == 1) ){
				
				if(isset($search_text) && !empty($search_text)){
					$default_search_text=__('store_search_val',true);
					
					$com=(strcmp ($default_search_text  ,$search_text ));
					
					if( $com == 0){	
										
						$header_title=__("search_result",true)." : "."<span class=''></span>";
					}else{
						$header_title=__("search_result",true)." : "."<span class=''>$search_text</span>";
					}
					
					
					
				}else{
					$header_title=__("search_result",true)." : "."<span>$category_name</span>";
					
				}
				
				
			}else{
				
				if(isset($search_text)){
					if($search_text == '1'){
						$search_text=__("all",true);
					}
				}else{
					$search_text='';
				}
				
				$header_title=__("search_result",true)." : "."<span class=''>$search_text</span>";
				
			}
			
			echo $header_title;
			?>
			
			
			
		</div>
		
		
		
		<div class="floatClass articleContainer" id="paginatedContent">
			<?php  } ?>
			
			<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
			<div class="paginationDiv" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>"Shop"));?></div>
			
			
			<div class="floatClass searchContent">
				<?php
				if(isset($data) && !empty($data)){
				foreach($data as $d){
					$id=$d['Shop']['id'];
					$title=$d['Shop']['title'];
					$text=$d['Shop']['text'];
					$url=$d['Shop']['url'];
					
					
					if(isset($is_search_by_alpha) && ($is_search_by_alpha == 1)){
						//$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
						
						$text=strip_tags($text,'');
						// $text=addslashes($text);					
						//$desc = $this->text->truncate($text,280,'...');
						$desc= $this->Text->truncate($text,280,array("...",true));
						
						//$desc=preg_replace('/&nbsp;/', ' ', $desc);
						
						//$desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>" ,'html'=>true ));
					
					}else{
						$title = $this->text->highlight($title,$search_text,array("format"=>"<span class='highlight'>$search_text</span>"));
						
						$text=strip_tags($text,'');
						// $text=addslashes($text);					
						$desc= $this->Text->truncate($text,280,array("...",true));
						
						//$desc=preg_replace('/&nbsp;/', ' ', $desc);
						
						//$desc = $this->text->highlight($desc,$search_text,array("format"=>"<span class='highlight'>$search_text</span>" ,'html'=>true ));
					
					}
					$desc=trim($desc);
					$desc=preg_replace("/&nbsp;/i","",$desc);
					?>
					
					<div class="floatClass searchResultRow">
						<div class="floatClass searchResultTitle"><a href="<?=$url?>"><?=$title?></a></div>
						<div class="floatClass searchResultText"><a href="<?=$url?>"><?=$desc?></a></div>
					</div>
				<?php 						
				}
				}else{
					echo "<div class='notResultText'>".__('no_data',true)."</div>";
				}
				 ?>
			</div>
			
			<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
			<div class="paginationDiv" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>"Shop"));?></div>
			
			
	<?php 
	if($is_ajax == false){
		?>	
		
	</div>
	</div>
	<?php } ?>