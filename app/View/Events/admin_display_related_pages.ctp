<?php
$latestSection = "";

$sectionNames = array("about"=>"About Us","patient"=>"Patient Care","medical"=>"Medical Education","biomedical"=>"Biomedical Research","careers"=>"Careers");
$rightColumnIds = array("Careers"=>1,"blogs"=>2,"News"=>3,"Event"=>4,"Tender"=>5,"SideBanner"=>6);

$relatedPagesCount = 0;



if(!empty($otherRelatedModels)){
	
	foreach ($otherRelatedModels as $relatedModel=>$relatedModelEntry){
		$relatedModel_ReadableName = $relatedModelEntry["sectionName"];
		
		$showVisibility = 0;
		if(isset($rightColumnIds[$relatedModel])){
			$colId = $rightColumnIds[$relatedModel];
			$showVisibility = 1;
			
			if(isset($pagesRightCol[$colId])){
				$visibleFlag = $pagesRightCol[$colId];
			}else{
				$visibleFlag = 1;
			}
			
		}
		
		if($latestSection != ""){
//				echo "</select>"; //end relatedSection
				echo "</div>"; //end relatedSection
			}
				
		$onChange = "";
		if($relatedModel == "Album"){
			$onChange = "open_related_album(this)";
		}
		
		echo "<div class='relatedSection'>";
			echo "<div class='relatedSectionTitle'>
				$relatedModel_ReadableName&nbsp;&nbsp;&nbsp;";
			
				if($showVisibility == 1){
					if($visibleFlag == 1){
						$visibleChecked = "checked=\"checked\"";
						$hiddenChecked = "";
					}else{
						$visibleChecked = "";
						$hiddenChecked = "checked=\"checked\"";
					}
				
					echo '<input type="radio" id="option1_'.$colId.'" name="data[PagesRightColumn]['.$colId.'][visible]" value="1" '.$visibleChecked.' /><label for="option1_'.$colId.'">Visible</label>';
					echo '<input type="radio" id="option2_'.$colId.'" name="data[PagesRightColumn]['.$colId.'][visible]" value="0" '.$hiddenChecked.'/><label for="option2_'.$colId.'">Hidden</label>';
				}
			
			echo "</div>";
			echo "<div class='FloatClass' style='width:300px;'>";
//				echo $this->Form->input("PagesRelation.$relatedModel",array("id"=>"PagesRelation$relatedModel","options"=>$parentsList["$relatedModel"],"multiple"=>"multiple","label"=>false,"class"=>"relatedDDL checkLists","onclick"=>$onChange,"empty"=>false));
				echo "<select class='relatedDDL checkLists' name='data[PagesRelation][$relatedModel][]' id='data[PagesRelation][$relatedModel]' multiple='multiple' style='height:280px;'>";
				foreach ($parentsList[$relatedModel] as $entryId=>$entryTitle){
					if(isset($pagesRelations[$entryId]["$relatedModel"]))
						$checked = "selected";
					else $checked = "";
					
					echo "<option value='$entryId' class='level1' $checked>$entryTitle</option>";
				}
				
				echo "</select>";
			echo "</div>";	
		$latestSection = $relatedModel;
		$relatedPagesCount++;
			
		echo "</div>"; //last created relatedSection
	}
}
	
	echo $this->Form->input("News.albums_images",array("type"=>"hidden","id"=>"albums_images"));
	
	echo $this->Form->input("News.has_image",array("type"=>"hidden","id"=>"has_image"));
	
	echo $this->Form->input("News.has_video",array("type"=>"hidden","id"=>"has_video"));

?>


<?php 
//echo $this->form->input("RelatedDynamicPage.related_dynamic_page_ids",array("options"=>$parentsList,"multiple"=>"multiple","escape"=>false,"label"=>false,"id"=>"related_pages","style"=>"width:400px;height:200px;font-size:11px;border:1px solid;"));
?>
<!--<div style="cursor:pointer;float:left;margin-right:10px;" onclick="select_all_entries()">Select All</div>
<div style="cursor:pointer;float:left;" onclick="unselect_all_entries()">Unselect All</div>-->

<style>
.ui-widget{
	font-size:9px !important;
}
</style>
<script type="text/javascript">
	$(document).ready( function() {
		
		$(".relatedSectionTitle").buttonset();
		
//		$("[id^='PagesRelation']").each(function(){
		$(".checkLists").each(function(){
		    $(this).multiSelect({
		    	selectAll:false,
		    	listHeight:"380",
		    	noneSelected:"",
		    	optGroupSelectable:"",
		    	oneOrMoreSelected:""
		    });
		});
		
		
		
		
		$("[name^='data[PagesRelation][Video]']").each(function(){
			$(this).bind("change",function(){video_changed()});
			
			
			if($(this).attr("checked") == "checked"){
				
				
			}
		});
		
		
		
//		$("[name^='PagesRelationAlbum']").each(function(){
		$("[name^='data[PagesRelation][Album]']").each(function(){
			$(this).bind("change",function(){related_album_click(this)});
			$(this).parent().hover(function(){display_images_tooltip(this)},function(){hide_images_tooltip(this)});
			
			if($(this).attr("checked") == "checked"){
				
				display_images_tooltip($(this).parent());
			}
		});
		
		alreadyRelatedImages = [<?php echo implode(",",$imagesRelations);?>];
		
	});
</script>