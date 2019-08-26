<?php
$SITE_LOCATION=Configure::read("WEBSITE_URL");
$SITE_NAME=Configure::read("SITE_NAME");

print "Dear User  ,<br/><br/>

A user credential has been created for you on system:<br/> <br/>


<b>Email :</b> {$data["User"]["email"]}<br/>
<b>Password : </b> {$data["User"]["real_password"]}<br/>




";
?>