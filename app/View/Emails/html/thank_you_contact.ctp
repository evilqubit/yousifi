<?php
$EMAIL_SIGNATURE=Configure::read("EMAIL_SIGNATURE_HTML");
$curDate = date('d-M-Y h:i:s');


$message=__("contact_thank_u",true);




$text_alig='';
$direction='';
if($lang == 'en'){
	
}else{
	$text_alig='right';
	$direction='rtl';
	
}

print <<<HTHT

<div style="text-align:$text_alig; direction:$direction" >$message<div>

HTHT;

