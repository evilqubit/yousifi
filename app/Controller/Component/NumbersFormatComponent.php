<?php
App::uses('Component', 'Controller');
class NumbersFormatComponent extends Component {

	function formatNumber($eng_number,$locale="eng",$format_flag=1,$separator=",",$show_currency=0){
		
		if(!is_numeric($eng_number)){
			if($show_currency)
				return $eng_number.__("currency",true);
			else return $eng_number;
		}
			
		//print_r($eng_number)	;exit;
			if($format_flag){
			
				if(is_double(trim($eng_number)) && ($eng_number==floor($eng_number))){
					$eng_number=number_format(floor($eng_number),1,".",$separator);
					
				}
				else
					$eng_number=number_format($eng_number,0,".",$separator);
				
			}else{
				$separator = "";
			}
			
			$eng_number=number_format($eng_number,0,".",$separator);
		if($locale=="ara"){	
			$numbers = array('&#1632;','&#1633;','&#1634;','&#1635;','&#1636;','&#1637;','&#1638;','&#1639;','&#1640;','&#1641;');
			
			
			$eng_number=str_split($eng_number);
			$ret_nb="";
			
			foreach ($eng_number as $val){
				if(isset($numbers[$val]))
					$ret_nb.=$numbers[$val];
				else{
					if($val==" ")
						$val="&nbsp;";
					$ret_nb.=$val;
				}
			}
		}else{
			$ret_nb=$eng_number;
		}
		
		if($show_currency)
			return $ret_nb.__("currency",true);
		else return $ret_nb;
		
	}
	
	function get_month_name($month_index=0,$locale="eng",$conditions=array()){
		if($locale=="ara"){
			$month_array = array('',"&#1610;&#1606;&#1575;&#1610;&#1585;","&#1601;&#1576;&#1585;&#1575;&#1610;&#1585;","&#1605;&#1575;&#1585;&#1587;","&#1575;&#1576;&#1585;&#1610;&#1604;","&#1605;&#1575;&#1610;&#1608;","&#1610;&#1608;&#1606;&#1610;&#1608;","&#1610;&#1608;&#1604;&#1610;&#1608;","&#1571;&#1594;&#1587;&#1591;&#1587;","&#1587;&#1576;&#1578;&#1605;&#1576;&#1585;","&#1571;&#1603;&#1578;&#1608;&#1576;&#1585;","&#1606;&#1608;&#1601;&#1605;&#1576;&#1585;","&#1583;&#1610;&#1587;&#1605;&#1576;&#1585;");
			
		}elseif($locale == 'fre'){
			if(isset($conditions['month_format']) && $conditions['month_format']=='long')
				$month_array=array('','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
			else $month_array=array('','janv','févr','mars','avril','mai','juin','juil','août','sept','oct','nov','déc');
		}else{
			if(isset($conditions['month_format']) && $conditions['month_format']=='long')
				$month_array=array('','January','February','March','April','May','June','July','August','September','October','November','December');
			else $month_array=array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		}
		
		
		
		
		return $month_array[$month_index];
	}
	
	function get_week_days($locale){
		$week_array=array();
		if($locale=="eng")
			$week_array=array("S","M","T","W","T","F","S");
			
		return $week_array;
	}
	
}
	
	
?>