<?php 
if($is_ajax == false){
	echo $this->element("/header/about_us_menu");
	
	echo "<div id='about_sections'>";		
}
?>


<div class="floatClass textArea  addTopSpace" id="FilterContent">

	<div class="floatClass videoContainer" id="paginatedContent">
		
		<div class="ajaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
		<div class="paginationDiv" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>$modelName));?></div>
		
		
		<div class="floatClass articleInternalContainer">
		<?php 
		$index=1;
		
		$open_video_id=0;
			
		foreach($data as $d){
			$id=$d['Section']['id'];
			$title=$d['Section']['title'];
			$text=$d['Section']['text_1'];
			$image=$d['Section']['video_image'];
			
			
			$video_type=$d["Section"]['video_type'];
			$youtube=$d["Section"]['youtube'];
			$youtube_image=$d["Section"]['youtube_image'];
			$video=$d["Section"]['video'];
			$video_image=$d["Section"]['video_image'];
	
			
			
			$img="/files/sections/preview/$image";
			
			//youtube
			if($video_type == 1){			
				//use vidoe snap shot
				if($youtube_image == 1){
					$img="http://img.youtube.com/vi/$youtube/0.jpg";
				}else{
					$img="/files/sections/preview/$video_image";
				}
				
			}else{
				$img="/files/sections/preview/$video_image";
			} 
		
		
			$title= $this->Text->truncate($title,50,array("...",true , 'exact'=>false));
			$text= $this->Text->truncate($text,250,array("...",true , 'exact'=>false));
			
			$margin='';
			if(($index % 2 )== 0){
				$margin='0px';
			}
			
			if(isset($selected_video_id) && !empty($selected_video_id)){
				if($selected_video_id == $id){
					$open_video_id=$id;					
				}
			}
			
			
			$url="/$lang/Sections/videos/page:$page/?video_id=$id";			
			$onclick="open_video($id);return false";
			?>
			
			<div class="floatClass videoRow" style="margin:<?=$margin?>; margin-bottom:31px; ">
				<div class="floatClass videoRowImageContainer">					
					<div class="floatClass internalVideoPlayBtn"><a onclick="<?=$onclick?>" href="<?=$url?>"><img src="/img/spacer.gif" width="87" height="87" alt=""/></a></div>
					<div class="floatClass VideoImg"><a onclick="<?=$onclick?>" href="<?=$url?>"><img src="<?=$img?>" alt=""/></a></div>
				</div>
				
				<div class="floatClass videoTextContainer">
					<div class="floatClass videoTitle"><a onclick="<?=$onclick?>" href="<?=$url?>"><?=$title?></a></div>
<!--					<div class="floatClass articleDetailsBottomBorder"></div>-->
					
					<div class="floatClass videoText"><a onclick="<?=$onclick?>" href="<?=$url?>"><?=$text?></a></div>
				</div>
			</div>
			
			<?php 
			$index++;
		}
		?>
		</div>		
	</div>
</div>
<script type="text/javascript">	
	$(document).ready(function(){
		<?php if(isset($open_video_id) && !empty($open_video_id) && ($open_video_id > 0)){ ?>
			open_video('<?=$open_video_id?>');	
		<?php } ?>
	});	
</script>

<?php 
if($is_ajax == false){
	
	echo "</div>";		
}
?>
