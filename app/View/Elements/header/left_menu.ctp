<style type="text/css">.menu2 .slicknav_menutxt{display:none;}</style>

<?php
$counter = 0;
foreach($section_left_menu as $menu){
$counter++;
if($counter ==1)
{
	$sectionTitle = $menu['DynamicPage']['title'];
}

}
?>
<div class="floatClass leftMenu  col-md-12 col-sm-12 col-xs-12">
	 
    <div class='col-sm-6 col-xs-6 visible-sm visible-xs'>
	
		<div class="floatClass " style='color:black;width:auto'> 
			<h4 id='sectionTitle'><?=$sectionTitle;?></h4>
		</div>
	</div>
	<div class='col-sm-6 col-xs-6 visible-sm visible-xs'>
		<div id="leftMenu" class="floatRevClass menu2" ></div>	
	</div>	
	<ul id="innerLeftmenu" >						
		<?php
		foreach($section_left_menu as $menu){
			$id=$menu['DynamicPage']['id'];
			$title=$menu['DynamicPage']['title'];
			$slug=$menu['SeoManagement']['slug'];
			
			$url="/$lang/DynamicPages/$section/$id/";
			$menu_id="section_$id";
			
			$active_menu='';
			if($category_id == $id){
				$active_menu='activeLeftMenu';
			}
			
			?>
			
			
			<li>
				<div  class="leftMenu_<?=$id?>  floatClass leftMenuRow <?=$active_menu?>"><a  onclick="get_content('<?=$url?>' , '<?=$id?>','<?=$title?>'); return false"   id="<?=$menu_id?>"  href="<?=$url?>"><?=$title?></a></div>
				<div class="floatRevClass leftMenuArrow visible-lg"><img src="/img/spacer.gif" width="11" height="11" alt=""/></div>
				<div class="leftMenuAjaxLoader" id="ajaxLoader_<?=$id?>" ><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
				
			</li>
		
			
			
			<?php 
		}				
		?>
	</ul>			
</div>

<script type="text/javascript">
	$(document).ready(function(){			
		
		$('#innerLeftmenu').slicknav({
			prependTo:'#leftMenu'
			
		});
		
	});
</script>