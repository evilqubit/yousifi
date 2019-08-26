<?php
App::import('Vendor', 'I18N', array('file' => 'I18N' . DS . 'Arabic.php'));
class ArabicHelper extends Helper {

	var $transliterateAr;
	
	function transliterate_numbers($content,$formatFlag=0,$locale='ara'){
		
		if($locale != "ara")
			return $content;
			
		if(empty($this->transliterateAr))
			$this->transliterateAr = new I18N_Arabic('Transliteration');

		if($formatFlag && is_numeric($content)){
			$content = number_format($content,null,".",",");
		}
		
		$content = $this->transliterateAr->arNum($content);
		
//		$content = preg_replace("/\./",__("comma",true),$content);
		
		return $content;
	}
	
	


function formatNumber_($eng_number,$locale="eng",$format_flag=1,$separator=",",$show_currency=0){
  
  
   
  
   if($format_flag){
   
    if(is_double(trim($eng_number)) && ($eng_number==floor($eng_number))){
     $eng_number=number_format(floor($eng_number),1,".",$separator);
     
    }
    else
     $eng_number=number_format($eng_number,0,".",$separator);
    
   }
   
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
	
	function transliterate_phone_numbers($content,$formatFlag=0){
		
		 if(empty($this->transliterateAr))
		   $this->transliterateAr = new I18N_Arabic('Transliteration');
		
		  if($formatFlag && is_numeric($content)){
		   $content = number_format($content,null,".",",");
		  }
		  
		  $content = $this->transliterateAr->arNum($content);	
		  
		  print_R($content);exit;	  
		  //$content = preg_replace("/\./",__("comma",true),$content);
		  
		  
		  return $content;
	}
	
}
?>