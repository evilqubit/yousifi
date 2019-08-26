<?php
$EMAIL_SIGNATURE=Configure::read("EMAIL_SIGNATURE_HTML");
print "Dear {$data['name']},\n \n

Thank you for taking the time to fill the application and for your interest in LeMall. Your application is under review and we may contact you whenever we have new availabilities 

";
?>
