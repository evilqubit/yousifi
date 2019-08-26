<?php
$get_array=$this->GetArrayFormat->get_string_array($_GET);
$get_array = substr($get_array,1);
$get_array="?".$get_array;

$this->Paginator->options(array(
						'update' => '#page_content',
						'url' => array_merge(array('?' => $get_array), $this->passedArgs)
						)
				);
	echo "<div style='width:750px; float:right; margin:0;margin-top:20px;'>";
		echo "<div style='float:right;'>".$this->Paginator->next(' Next >>',array('style'=>'float:left;width:70px;'), null, null)."</div>";
		echo "<div style='float:right;padding-left:5px;padding-right:5px;'>".$this->Paginator->numbers(true)."</div>";
		echo "<div style='float:right;'>".$this->Paginator->prev('<< Previous ',array('style'=>'float:left;width:75px;'), null, null)."</div>";
		
	echo "</div>";
?>