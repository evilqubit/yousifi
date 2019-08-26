<?php 
if($is_ajax == false){
	
	if($about_ajax == false){
		echo $this->element("/header/about_us_menu");
	}
	
	if($about_ajax == false){
		echo "<div id='about_sections'>";	
	}	
	
	
 ?>


<div class="floatClass textArea  addTopSpace" id="FilterContent">
<?php  } 
		
		
		
		?>
	<div class="floatClass articleContainer" id="paginatedContent">
		<?php echo $this->element('/article/filter' , array("selected_month"=>$selected_month)); ?>
		
		<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt="ajaxloader" /></div>
		<div class="paginationDiv" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>$modelName));?></div>
		
		
		<div class="floatClass articleInternalContainer">
		<?php 
		$index=1;
		if(!empty($data)){
		foreach($data as $d){
			$id=$d['Section']['id'];
			$title=$d['Section']['title'];
			$image=$d['Section']['image'];
			$file=$d['Section']['file'];
			
			$slug=$d['SeoManagement']['slug'];
			$file_download_url='';
			if(!empty($file)){
				$file_download_url="/$lang/Sections/download_file/$id/$slug";
			}
			$url="/$lang/Sections/article_details/$id/";
			
			$img="/files/sections/preview/$image";
			$title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
			
			$margin='';
			if(($index % 2 )== 0){
				$margin='0px';
			}
			?>
			
			<div class="floatClass articleRow" style="margin:<?=$margin?>; margin-bottom:31px; ">
				<div class="floatClass articleRowImageContainer">
					<?php if(!empty($file_download_url)){
						?>
						<div class="floatClass ArticleDownloadImg"><a href="<?=$file_download_url?>"><img src="/img/spacer.gif" width="46" height="60"  alt="<?=$title?>" /></a></div>
						<?php
					} ?>
					
					<div class="floatClass ArticleImg"><a href="<?=$url?>"><img src="<?=$img?>" alt="<?=$title?>" /></a></div>
				</div>
				<div class="floatClass articleTextContainer">
					<div class="floatClass articleTitle"><a href="<?=$url?>"><?=$title?></a></div>
					<!-- <div class="floatClass articleShadow"></div> -->
					<div class="floatClass articleBtnContainer">
						<div class="floatClass readMoreContainer">
							<div class="floatClass readMoreIcon"><a href="<?=$url?>"><img src="/img/spacer.gif" width="17" height="15" alt="<?=$title?>" /></a></div>
							<div class="floatClass readMoreText"><a href="<?=$url?>"><?=__('read_more',true)?></a></div>
						</div>
						
						<?php if(!empty($file_download_url)){ ?>
							<div class="floatClass articleDownloadContainer">
								<div class="floatClass downloadIcon"><a href="<?=$file_download_url?>"><img src="/img/spacer.gif" width="17" height="15" alt="<?=$title?>" /></a></div>
								<div class="floatClass downloadText"><a href="<?=$file_download_url?>"><?=__('download',true)?></a></div>
							</div>
						<?php  } ?>
					</div>
				</div>
			</div>
			
			<?php 
			$index++;
		}
	}else{
		echo __("no_events",true);
	}
		?>
		</div>
		</div>
		<?php 
		
if($is_ajax == false){?>
	
	</div>
</div>
<?php   }?>









<?php 
if($about_ajax == false){

	echo "</div>";	
}
 ?>