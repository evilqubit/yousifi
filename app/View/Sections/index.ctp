<?php 
if($is_ajax == false){?>
<div class="floatClass textArea  addTopSpace" id="FilterContent">	
	<?php 
	$title=$section_details["Section"]['internal_title'];
	$text=$section_details["Section"]['text_1'];
	
	?>
	
	<div class="floatClass PageTitle"><?=strtoupper($title)?></div>
	<div class="floatClass PageText"><?=$text?></div>
	
	<div class="floatClass shopCategoriesList">
		<?php 
		foreach($category_list as $cat){
			$id=$cat['Category']['id'];
			$title=$cat['Category']['title'];
			
			$slug=$cat['SeoManagement']['slug'];
			$active_category_class='';
			if($id == $selected_category_id){
				$active_category_class='active_category';
			}
			
			$url="/$lang/Sections/index/$id/$slug";
			
			$onclick="get_shops_of_selected_category('$url','$id'); return false;";
			?>
			<div class="floatClass InternalCategoryTitle">
				<a id="Cat_<?=$id?>" class="<?=$active_category_class?> allCategoryTitle" onclick="<?=$onclick?>" href="<?=$url?>"><?=$title?></a>
				<div class="floatClass categoryAjaxLoader" id="categoryAjaxLoader_<?=$id?>"><img src="/img/ajax-loader.gif" width="20" height="20" alt="ajaxloader" /></div>
			</div>
			
			<?php 
		}
		 ?>
	</div>
	
	<div class="floatClass ShopListContainer" id="paginatedContent">
		<?php } ?>
		<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
		<div style="margin-bottom: 20px;" class="paginationDiv floatClass" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>'Shop'));?></div>
		 
		
		<div class="floatClass shopInternalContainer">
		<?php 
		$index=1;
		$current_shop_url='';
		foreach($data as $d){
			$id=$d['Shop']['id'];
			$title=$d['Shop']['title'];
			$image=$d['Shop']['image_1'];
			
			$slug=$d['SeoManagement']['slug'];
			$ajax_url="/$lang/Shops/view/$id";
			
			$url="/$lang/Sections/index/$selected_category_id/$slug/page:$page?shop_id=$id";
			$img="/files/shops/thumb/$image";
//			$title= $this->Text->truncate($title,25,array("...",true , 'exact'=>false));
			
			
			if((isset($selected_shop_id)) && ( $selected_shop_id == $id) && !empty($selected_shop_id)){
				$current_shop_url=$ajax_url;
			}
			
			$onclick="view_shop('$ajax_url');return false;";
			
			$margin='';
			if(($index % 3 )== 0){
				$margin='0px';
			}
			?>			
			<div class="floatClass ShopRow" style="margin:<?=$margin?>; margin-bottom:31px; ">				
				<div class="floatClass shopImg"><a onclick="<?=$onclick?>" href="<?=$url?>"><img src="<?=$img?>" alt='<?=$title?>' /></a></div>				
				<div class="floatClass categoryTextContainer">
					<div class="floatClass shopTitle" style="height:44px;"><a href="<?=$url?>"><?=$title?></a></div>					
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

