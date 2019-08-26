<?php 
if($is_ajax == false){?>
<div class="floatClass textArea  addTopSpace" id="FilterContent">
	<?php 
	$title=$section_details["Section"]['internal_title'];
	$text=$section_details["Section"]['text_1'];
	
	?>
	
	<div class="floatClass PageTitle"><?=strtoupper($title)?></div>
	<div class="floatClass PageText"><?=$text?></div>
	
	<div class="floatClass articleContainer" id="paginatedContent">
		<?php } ?>
		<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
		<div class="paginationDiv" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>'Category'));?></div>
		
		
		<div class="floatClass articleInternalContainer">
		<?php 
		$index=1;
		foreach($data as $d){
			$id=$d['Category']['id'];
			$title=$d['Category']['title'];
			$image=$d['Category']['image'];
			
			$slug=$d['SeoManagement']['slug'];
			$url="/$lang/Sections/index/$id/$slug";
			
			$img="/files/categories/thumb/$image";
			$title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
			
			$margin='';
			if(($index % 4 )== 0){
				$margin='0px';
			}
			?>
			
			<div class="floatClass categoryRow" style="margin:<?=$margin?>; margin-bottom:31px; ">
				
				<div class="floatClass categoryImg"><a  href="<?=$url?>"><img alt="<?=$title?>" src="<?=$img?>" /></a></div>
				
				<div class="floatClass categoryTextContainer">
					<div class="floatClass blueArrow"><a href="<?=$url?>"><img src="/img/spacer.gif" width="17" height="11" alt="<?=$title?>"  /></a></div>
					<div class="floatClass categoryTitle"><a href="<?=$url?>"><?=$title?></a></div>					
				</div>
			</div>
			
			<?php 
			$index++;
		}
		?>
		</div>
		<?php 
if($is_ajax == false){?>
	</div>
</div>

<?php  } ?>

