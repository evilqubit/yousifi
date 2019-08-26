<?php if($isAjax == false){ ?>
	
	<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 internalContent">
		<div class="internalTopBorder col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
		<div class="floatClass articleContainer" id="paginatedContent">
		<?php  } ?>
		<?php 
		$title=$news_details['DynamicPage']['title'];
		$text=$news_details['DynamicPage']['text'];
		$image=$news_details['DynamicPage']['image'];
		
		
		
		$date=$news_details['DynamicPage']['date'];
		
		
		if(!empty($date)){
			$date=$this->time->format('j-n-Y',$date);			
			$date=explode("-", $date);
		
			$day_number = $date[0];
			$month = $this->NumbersFormat->get_month_name($date[1] ,$locale,0)." ";
			$year= $date[2];
			
		}
					
		$img='';
		if(!empty($image)){
			$img="/files/dynamic_pages/preview/$image";
		}
		 ?>
		
		<div class="internalText">
			
			
			<div class="floatClass backBtn"><a onclick="window.history.go(-1); return false;"  href="<?=$back_url?>"><?=__("< Back to previous page",true)?></a>
				<div class="floatClass backAjaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
			</div>
			<div class="floatClass  col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			
				<?php if(!empty($img)){?>
					<div class="floatClass newsDetailsImage col-lg-6 col-md-6 col-sm-12 col-xs-12"><img class="img-responsive" src="<?=$img?>" alt="" /></div>
				<?php } ?>
				
				<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<div class="floatClass homeNewsDate col-lg-1 col-md-1 col-sm-1 col-xs-1">								
						<div class="floatClass homeNewsDateMonth "><?=$month?></div>
						<div class="floatClass homeNewsDateDay "><?=$day_number?></div>
						<div class="floatClass homeNewsDateYear "><?=$year?></div>								
					</div>
					<div class="floatClass newsDetailsTextContainer col-lg-11 col-md-11 col-sm-10 col-xs-10">
						<div class="floatClass newsDetailsTitle col-lg-12 col-md-12 col-sm-12 col-xs-12"><?=$title?></div>
						<div class="floatClass newsDetailsText col-lg-12 col-md-12 col-sm-12 col-xs-12"><?=$text?></div>
					</div>			
				</div>
			
			</div>
		</div>
		
<?php if($isAjax == false){ ?>
		</div>
	</div>
<?php  } ?>