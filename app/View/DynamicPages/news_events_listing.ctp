<?php if($isAjax == false){ ?>


	<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 internalContent">
		<div class="floatClass fullPageTopBoarder2 col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>


		<div class="floatClass articleContainer" id="paginatedContent">

		<?php  } ?>
		<div class="floatClass categoryListHeader">
			<?php $category_title=$category_details['Category']['title'];?>
			<div class="floatClass backBtn"><a onclick="window.history.go(-1); return false;"  href="<?=$back_url?>"><?=__("< Back to previous page",true)?></a>
				<div class="floatClass backAjaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
			</div>

			<div class="floatClass categoryListHeaderInternal"><?=strtoupper($category_title)?></div>
		</div>


		<div class="PaginationAjaxLoader"><img src="/img/ajax-loader.gif" width="20" height="20" alt="ajaxloader" /></div>
		<div class="paginationDiv floatClass" id="paginationDiv1"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>$modelName));?></div>


		<?php if(!empty($data)){

			?>

			<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<?
				$index=1;
				$smal_index=1;
				foreach($data as $news){
					$id=$news['DynamicPage']['id'];
					$category_id=$news['DynamicPage']['category_id'];
					$title=$news['DynamicPage']['title'];
					$date=$news['DynamicPage']['date'];
					$short=$news['DynamicPage']['short'];
					$slug=$news['SeoManagement']['slug'];

					$short= $this->Text->truncate($short,220,array("...",true , 'exact'=>false));


					if(!empty($date)){
						$date=$this->time->format('j-n-Y',$date);
						$date=explode("-", $date);

						$day_number = $date[0];
						$month = $this->NumbersFormat->get_month_name($date[1] ,$locale,0)." ";
						$year= $date[2];

					}

					$news_url="/$lang/DynamicPages/news_events_view/$category_id/$id/$slug";
					?>
					<div class="floatClass categoryListLargeRowInternal col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="floatClass  col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="floatClass homeNewsDate col-lg-1 col-md-1 col-sm-1 col-xs-1">
								<div class="floatClass homeNewsDateMonth "><?=$month?></div>
								<div class="floatClass homeNewsDateDay "><?=$day_number?></div>
								<div class="floatClass homeNewsDateYear "><?=$year?></div>
							</div>
							<div class="floatClass categoryListLargeTextContainer col-lg-11 col-md-11 col-sm-10 col-xs-10">
								<div class="floatClass categoryListLargeTitle col-lg-12 col-md-12 col-sm-12 col-xs-12" ><a onclick="show_news_details('<?=$news_url?>' , '<?=$id?>'); return false;" href='<?=$news_url?>' > <?=$title?> </a></div>
								<div class="floatClass categoryListLargeText  col-lg-12 col-md-12 col-sm-12 col-xs-12"><a onclick="show_news_details('<?=$news_url?>', '<?=$id?>');  return false;"  href='<?=$news_url?>' > <?=$short?> </a></div>
							</div>
						</div>
						<div class="floatClass newsListingAjaxLoader" id="newsListingAjaxLoader_<?=$id?>"><img src="/img/ajax-loader.gif" width="20" height="20" alt=""/></div>
						<div class="floatClass col-lg-12 col-md-12 col-sm-12 col-xs-12 listingBoarder"></div>


					</div>
				<?php
				}
				?>

			</div>

			<div class="paginationDiv" id="paginationDiv2"><?php echo $this->element('paginator',array("paginationDivId"=>"paginationDiv1","modelName"=>$modelName));?></div>

			<?php
		}else{
			echo "<div class='floatClass noDataFound' > No data found </div>";
		} ?>


<?php if($isAjax == false){ ?>
		</div>
	</div>
<?php  } ?>