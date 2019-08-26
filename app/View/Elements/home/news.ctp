
<?php if(!empty($home_latest_news)){ ?>
	<div class="floatClass homeNewsMainContainer">
		<div class="container">
			
			
			<div class="floatCalss homeHighlights col-lg-12 col-md-12 col-sm-12 col-xs-12"><?php echo strtoupper(__("highlights",true))?></div>
			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php 
				$index=1;
				foreach($home_latest_news as $news){
					$id=$news['DynamicPage']['id'];
					$category_id=$news['DynamicPage']['category_id'];
					$title=$news['DynamicPage']['title'];
					$date=$news['DynamicPage']['date'];
					$text=$news['DynamicPage']['short'];
					$slug=$news['SeoManagement']['slug'];
					
					
					$full_date='';
					if(!empty($date)){
						$date=$this->time->format('j-n-Y',$date);			
						$date=explode("-", $date);
					
						$day_number = $date[0];
						$month = $this->NumbersFormat->get_month_name($date[1] ,$locale,0)." ";
						$year= $date[2];
						
					}
					$url='';
					$url="/$lang/DynamicPages/news_events_view/$category_id/$id/$slug";		
					
					$margin='';
					if($index ==3){
						$margin = '0px;';
					}
					?>
					
					<div class="floatClass news_row col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin: <?=$margin?>">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 floatClass homeNewsHeader">
							<div class="floatClass homeNewsDate">								
								<div class="floatClass homeNewsDateMonth "><?=$month?></div>
								<div class="floatClass homeNewsDateDay "><?=$day_number?></div>
								<div class="floatClass homeNewsDateYear "><?=$year?></div>								
							</div>
							
							<div class="floatClass homeNewsTitle"><a href="<?=$url?>"><?=$title?></a></div>
						</div>
						<div class="floatClass homeNewsText"><a href="<?=$url?>"><?=$text?></a></div>
					</div>
					
					<?php 
					$index++;
				} ?>
			</div>
			
		</div>
	</div>
<?php  } ?>