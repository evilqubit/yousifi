<?php
ob_start ("ob_gzhandler");
header("Content-Type: text/javascript");
header("Cache-Control: public\r\n");
print (file_get_contents("./jquery/jquery-1.10.1.min.js"));
print "\r\n";


print (file_get_contents("./jquery/jwplayer/jwplayer.js"));
print "\r\n";


print (file_get_contents("./jquery/slick/slick.min.js"));
print "\r\n";



print (file_get_contents("./jquery/jquery.hoverintent.js"));
print "\r\n";

print (file_get_contents("./jquery/form.js"));
print "\r\n";

print (file_get_contents("./jquery/validate/ar_validate.js"));
print "\r\n";


print (file_get_contents("./jquery/custom_select/custom_select.js"));
print "\r\n";


print (file_get_contents("./jquery/scroll_to_top/jquery-scrollToTop.js"));
print "\r\n";

print (file_get_contents("./user_interface/popup_window/jquery.popupoverlay.js"));
print "\r\n";


print (file_get_contents("./jquery/uicustom/light_uicustom.js"));
print "\r\n";

print (file_get_contents("./jquery/uicustom/timepicker.js"));
print "\r\n";

print (file_get_contents("./jquery/asAccordion/asAccordion.js"));
print "\r\n";


print (file_get_contents("./jquery/imagemapster/imagemapster.js"));
print "\r\n";


print (file_get_contents("./jquery/jQuery_address/jquery.address-1.5.min.js"));
print "\r\n";


// print (file_get_contents("./jquery/uicustom/uicustom.js"));
// print "\r\n";

// print (file_get_contents("./jquery/drop_down/jquery.multiselect.min.js"));
// print "\r\n";


print (file_get_contents("./default.js"));
print "\r\n";





 $fileName="js_cached_ar.js";
 $fh = fopen("./{$fileName}", "w+");
 chmod("./{$fileName}", 0644);
 $data = ob_get_clean();
 
 fwrite($fh, $data);
 fclose($fh);


//ob_flush();

?>