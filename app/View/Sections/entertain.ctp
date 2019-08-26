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
		<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20"  alt="ajaxloader"/></div>
		<div class="paginationDiv" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>'Shop'));?></div>
		
		
		<div class="floatClass articleInternalContainer">
		<?php 
		$index=1;
		$current_shop_url='';
		foreach($data as $d){
			$id=$d['Shop']['id'];
			$title=$d['Shop']['title'];
			$image=$d['Shop']['image_1'];
			
			$slug=$d['SeoManagement']['slug'];
			$ajax_url="/$lang/Shops/view/$id";
			
			$url="/$lang/Sections/entertain/$slug/page:$page?shop_id=$id";
			$img="/files/shops/thumb/$image";
			
			$title= $this->Text->truncate($title,25,array("...",true , 'exact'=>false));
			
			
			if((isset($selected_shop_id)) && ( $selected_shop_id == $id) && !empty($selected_shop_id)){
				$current_shop_url=$ajax_url;
			}
			
			
			$onclick="view_shop('$ajax_url');return false;";
			
			$margin='';
			if(($index % 4 )== 0){
				$margin='0px';
			}
			?>
			
			<div class="floatClass categoryRow" style="margin:<?=$margin?>; margin-bottom:31px; ">
				
				<div class="floatClass categoryImg"><a onclick="<?=$onclick?>" href="<?=$url?>"><img src="<?=$img?>" alt='<?=$title?>' /></a></div>
				
				<div class="floatClass categoryTextContainer">
					<div class="floatClass blueArrow"><a  onclick="<?=$onclick?>" href="<?=$url?>"><img src="/img/spacer.gif" width="17" height="11" alt='<?=$title?>' /></a></div>
					<div class="floatClass categoryTitleEntertain"><a  onclick="<?=$onclick?>" href="<?=$url?>"><?=$title?></a></div>					
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



<script type="text/javascript">
	
	$(document).ready(function(){
		<?php if(isset($current_shop_url) && !empty($current_shop_url)){ ?>		
			view_shop('<?=$current_shop_url?>');	
		<?php } ?>
	});
	
</script>
