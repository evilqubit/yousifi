<Style>
.menu2 .slicknav_menutxt{display:none;}


.slicknav_nav {display: block;margin-top:70px !important}
</Style>
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
	<!-- <div id="leftMenu" class="floatRevClass"></div>-->
	  <div class='col-sm-6 col-xs-6 visible-sm visible-xs'>
	
		<div class="floatClass " style='color:black;width:auto'> 
			<h4 id='sectionTitle'><?=$sectionTitle;?></h4>
		</div>
	</div>
	<div class='col-sm-6 col-xs-6 visible-sm visible-xs'>
	<div id="leftMenu" class="floatRevClass menu2" ></div>	
	</div>	
	
			
	<ul id="innerLeftmenu">						
		<?php
		
		foreach($section_left_menu as $menu){
			$id=$menu['DynamicPage']['id'];
			$title=$menu['DynamicPage']['title'];
			$slug=$menu['SeoManagement']['slug'];
			
			$children=$menu['children'];
			
//			$url="#";
			$url="/$lang/DynamicPages/business/$section/$id/$slug";
			$menu_id="section_$id";
			
			$active_menu='';
			$sub_menu_display='none';
			if($active_main_menu == $id){
				$active_menu='activeLeftMenu';
				$sub_menu_display='block';
			}
			
			if(!empty($url)){
				//$onclick = "";
               $onclick = "show_submenu('$id','$title','$url'); return false;";
			}else{
				$onclick = "show_submenu('$id','$title','$url'); return false;";
			}
			
			?>
			
			
			<li>
				<div class="leftMenu_<?=$id?> floatClass leftMenuRow <?=$active_menu?>"><a  onclick="<?php echo $onclick;?>"   id="<?=$menu_id?>"  href="<?=$url?>"><?=$title?></a></div>
				<div class="floatRevClass leftMenuArrow visible-lg"><img src="/img/spacer.gif" width="11" height="11" alt=""/></div>
				<div class="leftMenuAjaxLoader" id="ajaxLoader_<?=$id?>" ><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
				
				<ul style="display: <?=$sub_menu_display?>;" class="subMenuRow" id="submenu_<?=$id?>">
				<?php if(!empty($children)){
					foreach($children as $sub){
						$sub_id=$sub['DynamicPage']['id'];
						$title=$sub['DynamicPage']['title'];
						$slug=$sub['SeoManagement']['slug'];
						
						$children=$menu['children'];
						
						$url="/$lang/DynamicPages/business/$section/$sub_id/$slug";
						
						$subMenuActiveClass='';
						if($category_id == $sub_id){
							$subMenuActiveClass='SubLeftMenuRowActive';
						}
						?>
						
							<li>
								<div class="sub_leftMenu_<?=$sub_id?> floatClass SubLeftMenuRow  <?=$subMenuActiveClass?>"><a  onclick="get_sub_content('<?=$url?>' , '<?=$sub_id?>' ,'<?=$id?>','<?=$title?>'); return false"  href="<?=$url?>"><?=$title?></a></div>						
							</li>
						
					<?php 
					
					}} ?>
				</ul>
				
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