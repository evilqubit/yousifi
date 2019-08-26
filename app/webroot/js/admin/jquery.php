<?php

ob_start ("ob_gzhandler");
header("Content-Type: text/javascript");
header("Cache-Control: public\r\n");
print (file_get_contents("../jquery/jquery-1.10.1.min.js"));
print "\r\n";

print (file_get_contents("../jquery/jquery-ui/jquery-ui.min.js"));
print "\r\n";


print (file_get_contents("../jquery/canvas_area_draw/jquery.canvasAreaDraw.js"));
print "\r\n";
print (file_get_contents("../jquery/bootstrap/bootstrap.min.js"));
print "\r\n";
print (file_get_contents("../jquery/nicescroll/jquery.nicescroll.min.js"));
print "\r\n";


print (file_get_contents("../jquery/lightbox/js/lightbox.js"));
print "\r\n";
print (file_get_contents("../jquery/uploadify/jquery.uploadify.js"));
print "\r\n";
// print (file_get_contents("../ckeditor/ckeditor.js"));
// print "\r\n";
// 
// print (file_get_contents("../ckfinder/ckfinder.js"));
// print "\r\n";

print (file_get_contents("../jquery/jquery-tags-input/jquery.tagsinput.min.js"));
print "\r\n";

// print (file_get_contents("../jquery/prettyPhoto/js/jquery.prettyPhoto.js"));
// print "\r\n";

print (file_get_contents("../jquery/mix/jquery.mixitup.js"));
print "\r\n";

print (file_get_contents("../jquery/jquery-validation/dist/jquery.validate.min.js"));
print "\r\n";
print (file_get_contents("../jquery/jquery-validation/dist/additional-methods.min.js"));
print "\r\n";
print (file_get_contents("../jquery/jcrop/js/jquery.Jcrop.min.js"));
print "\r\n";
print (file_get_contents("../jquery/data-tables/jquery.dataTables.js"));
print "\r\n";


print (file_get_contents("../jquery/timeago/timeago.js"));
print "\r\n";

print (file_get_contents("../jquery/pace/pace.min.js"));
print "\r\n";
print (file_get_contents("../jquery/canvasjs/canvasjs.min.js"));
print "\r\n";
print (file_get_contents("../jquery/scrollbar/jquery.mCustomScrollbar.concat.min.js"));
print "\r\n";
print (file_get_contents("../jquery/chosen/chosen.jquery.js"));
print "\r\n";
print (file_get_contents("../jquery/AYS/jquery.are-you-sure.js"));
print "\r\n";

print (file_get_contents("../jquery/multiselect/jquery.multiselect.js"));
print "\r\n";
print (file_get_contents("../jquery/multiselect/jquery.multiselect.filter.js"));
print "\r\n";
print (file_get_contents("../jquery/jwplayer/jwplayer.js"));
print "\r\n";

print (file_get_contents("../user_interface/popup_window/jquery.popupoverlay.js"));
print "\r\n";
print (file_get_contents("../jquery/jwplayer/jwplayer.js"));
print "\r\n";

// print (file_get_contents("../jquery/color_picker/colorpicker.js"));
// print "\r\n";
// print (file_get_contents("../jquery/color_picker/eye.js"));
// print "\r\n";
// print (file_get_contents("../jquery/color_picker/utils.js"));
// print "\r\n";
print (file_get_contents("./default.js"));
print "\r\n";


ob_flush();
?>