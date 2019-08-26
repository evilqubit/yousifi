<?php
$get_array=$this->GetArrayFormat->get_string_array($_GET);
$get_array = substr($get_array,1);
$get_array="?".$get_array;

$url = array_merge(array(), $this->passedArgs);
$url = array_merge($url,array("lang"=>$lang));

//print_r($this->Paginator->params["paging"][$modelName]);
if($this->Paginator->params["paging"][$modelName]["pageCount"] > 1){
	$this->Paginator->options(array(
							'update' => '#paginatedContent',
//							'url' => array_merge(array('?' => $get_array), $this->passedArgs),
							'url' => $url,
							'before'=> "pagination_start()",
							'complete' => 'paginationComplete()'
							)
					);
			$current_page=$this->Paginator->params["paging"][$modelName]["page"];
			$count=$this->Paginator->params["paging"][$modelName]["pageCount"];

			$current_pageVal = $current_page;
			$countVal = $count;
			//print_r('test');exit;
			if($locale == "ara"){
				//foreach ($yearsList  as $year=>$yearVal){
					$current_pageVal = $this->Arabic->transliterate_numbers($current_page,0,$locale);
					$countVal = $this->Arabic->transliterate_numbers($count,0,$locale);

					//print_r($current_pageVal);exit;
				//}
			}
			// print_r($count);
			// $this->Paginator->params["paging"][$modelName]["pageCount"]="&#1634;";
			// echo "<div class='paginationCounter'>".__("page",true)." ".$this->Paginator->counter(array('separator'=>__('of',true)))."</div>";
			$first=__("first",true);
			$last=__("last",true);
			$next=__("next_page",true);
			// $next="<img src='/img/spacer.gif'  width='26' height='26' alt=""/>";
			// $prev_page="<img src='/img/spacer.gif'  width='26' height='26' alt=""/>";
			//$prev_page=__("prev_page",true);
			// echo "<div class='paginationCounter'>".__("page",true)."<span class='currentActivePage'> &nbsp;" .$current_pageVal."</span> ".__('of',true)."&nbsp;".$countVal."</div>";
			echo "<div class='newsPaginationContainer'>";

			if($current_page > 1){
				//echo "<div class='page_first'>".$this->Paginator->first($first,array("escape"=>false), null, null)."</div>";
				echo "<div class='page_prev'>".$this->Paginator->prev($prev_page,array("escape"=>false), null, null)."</div>";
			}

				echo "<div class='floatClass paginatorNumbersContainer' >";
					echo $this->Paginator->numbers(array('separator'=>' ','modulus'=>6, 'ellipsis'=>'...',  'class'=>'paginator_elemnt floatClass','tag'=>'div', 'currentClass'=>'activeSlide'));


					if($current_page != $count && ($count > 6)){
						echo "<span class='floatClass'>...</span>";
						echo "<div class='last_page'>".$this->Paginator->last("$countVal",array("escape"=>false), null, null)."</div>";
					}
				echo "</div>";

				if($current_page != $count){
					echo "<div class='page_next'>".$this->Paginator->next($next,array("escape"=>false), null, null)."</div>";
					//echo "<div class='last_page'>".$this->Paginator->last($last,array("escape"=>false), null, null)."</div>";
				}


			echo '</div>';

	echo $this->Js->writeBuffer();
}
?>

<script type="text/javascript">
function parse_arabic_numbers_pagination(elmt){
     inputContent = $(elmt).html();

     arabicNbs =["\u0660","\u0661","\u0662","\u0663","\u0664","\u0665","\u0666","\u0667","\u0668","\u0669"];
     //    arabicNbs = ["&#1633;"];

     for(i=0;i<=9;i++){
         //        inputContent = inputContent.replace(new RegExp(i, 'g'),$("#number"+i).val());
         inputContent = inputContent.replace(new RegExp(i, 'g'),arabicNbs[i]);
     }


     $(elmt).html(inputContent);
}



	$(document).ready(function(){


		<?php
		if($this->Paginator->params["paging"][$modelName]["pageCount"] > 1){

		if($lang == 'ar'){ ?>
		$('.paginator_elemnt a').each(function(){
			parse_arabic_numbers_pagination(this);

		});
		parse_arabic_numbers_pagination('.activeSlide');

		<?php }} ?>



	});



</script>
