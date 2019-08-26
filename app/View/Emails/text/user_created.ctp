<?php
$SITE_LOCATION=Configure::read("WEBSITE_URL");
$SITE_NAME=Configure::read("SITE_NAME");

print "Dear User  ,\n

A user credential has been created for you on system:\n\n


<b>Email : </b> {$data["User"]["email"]}\n
<b>Password : </b> {$data["User"]["real_password"]}\n




";
?>