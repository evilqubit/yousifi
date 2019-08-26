<?php if($isAjax == false){ ?>


	<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 internalContent">
		<?php  } ?>


		<div class="floatClass fullPageTopBoarder col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
		<?php if(!empty($news_list)){

			foreach($news_list as $cat){
				$category_id=$cat['Category']['id'];
				$category_title=$cat['Category']['title'];
				$news_events=$cat['news_events'];
				$slug=$cat['SeoManagement']['slug'];

				$category_link="/$lang/DynamicPages/news_events_listing/$category_id/$slug";
				?>

				<div class="floatClass col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="floatClass newsCategoryRow col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="floatClass categoryListHeader">
							<div class="floatClass categoryListHeaderTitle"><?=strtoupper($category_title)?></div>
							<div class="floatRevClass categoryListHeaderViewAll"><a href="<?=$category_link?>"><?=__("View all",true)?></a></div>
						</div>
						
						<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<?php
							$index=1;
							$smal_index=1;
							foreach($news_events as $news){
								$id=$news['DynamicPage']['id'];
								$category_id=$news['DynamicPage']['category_id'];
								$title=$news['DynamicPage']['title'];
								$date=$news['DynamicPage']['date'];
								$short=$news['DynamicPage']['short'];
								$image=$news['DynamicPage']['image'];
								$slug=$news['SeoManagement']['slug'];

								$short= $this->Text->truncate($short,220,array("...",true , 'exact'=>false));


								if(!empty($date)){
									$date=$this->time->format('j-n-Y',$date);
									$date=explode("-", $date);

									$day_number = $date[0];
									$month = $this->NumbersFormat->get_month_name($date[1] ,$locale,0)." ";
									$year= $date[2];

								}

								$news_url='';
								$news_url="/$lang/DynamicPages/news_events_view/$category_id/$id/$slug";
								$img='';
								if(!empty($image)){
									$img="/files/dynamic_pages/preview/$image";
								}
								if($index == 1){									
									?>

								<div class="floatClass categoryListLargeRow col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="border_under_news_ev"></div>
									<div class="floatClass categoryListLargeImage  col-lg-12 col-md-12 col-sm-12 col-xs-12"><img class="img-responsive" src="<?=$img?>" alt="" /></div>
									<div class="floatClass  col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="floatClass homeNewsDate col-lg-1 col-md-1 col-sm-1 col-xs-1">
											<div class="floatClass homeNewsDateMonth "><?=$month?></div>
											<div class="floatClass homeNewsDateDay "><?=$day_number?></div>
											<div class="floatClass homeNewsDateYear "><?=$year?></div>
										</div>
										<div class="floatClass categoryListLargeTextContainer col-lg-11 col-md-11 col-sm-10 col-xs-10">
											<div class="floatClass categoryListLargeTitle col-lg-12 col-md-12 col-sm-12 col-xs-12" ><a href='<?=$news_url?>' > <?=$title?> </a></div>
											<div class="floatClass categoryListLargeText  col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href='<?=$news_url?>' > <?=$short?> </a></div>
										</div>
									</div>
								</div>

								<?php
								}else{
									$margin='';
									if(($smal_index % 2) == 0){
										$margin='0px;';
									}

									$smal_index++;
									?>
								<div class="floatClass categoryListSmallRow" style="margin: <?=$margin?>">
									<div class="floatClass  col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="floatClass homeNewsDate">
											<div class="floatClass homeNewsDateMonth "><?=$month?></div>
											<div class="floatClass homeNewsDateDay "><?=$day_number?></div>
											<div class="floatClass homeNewsDateYear "><?=$year?></div>
										</div>
										<div class="floatClass categoryListLargeTextContainer col-lg-10 col-md-10 col-sm-10 col-xs-10">
											<div class="floatClass categoryListLargeTitle col-lg-12 col-md-12 col-sm-12 col-xs-12"  ><a href="<?=$news_url?>"> <?=$title?></a></div>
										</div>
									</div>
								</div>

									<?php
								}

								$index++;

								if(($index % 2) == 0 ){
									echo "<div class='clearRow'></div>";
								}
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}

		} ?>



<?php if($isAjax == false){ ?>
	</div>
<?php  } ?>