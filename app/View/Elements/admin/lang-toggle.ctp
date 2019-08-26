 <div class="btn-group">
<a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle"><i class="icon-cog"></i> Languages <span id="PageLang"></span> <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-danger">
   <?php 
  // print_r($languages);exit;
   
   
   foreach($languages as $config){
  		$local=$config['Language']['locale'];
		$language=$config['Language']['language'];
		$direction=$config['Language']['direction'];
		$code=$config['Language']['code'];
   
    ?> 
    <li><a class="langSelector" data-locale ="<?php echo $code; ?>"  href="#"><?php echo $language; ?></a></li>
<?php } ?>
</ul>
 </div>
 
<script>
$( document ).ready(function() {	
$('.language').hide();
var defaultLocale = 'en';
$('.'+defaultLocale).show();



if(defaultLocale == 'ar'){
	$("#PageLang").html("(Arabic)");
}else if(defaultLocale == 'en'){
	$("#PageLang").html("(English)");
}else{
	$("#PageLang").html("(French)");
}

$('.langSelector').click(function(){
	
	var locale = $(this).attr('data-locale');
	
	$('.language').hide();
	$('.'+locale).show();
	
	
	if(locale == 'ar'){
		$("#PageLang").html("(Arabic)");
	}else if(locale == 'en'){
		$("#PageLang").html("(English)");
	}else{
		$("#PageLang").html("(French)");
	}
	
	
});
});
</script>
         