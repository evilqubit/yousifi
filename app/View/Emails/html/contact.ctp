<?php
$EMAIL_SIGNATURE=Configure::read("EMAIL_SIGNATURE_HTML");



print "Dear Administrator,<br/><br/>

A new contact form has been submitted with the following information:<br/><br/>


<b>Name</b> {$data['name']}<br/>
<b>Email </b> {$data['email']}<br/>

<b>Message </b><br/>
{$data['message']}<br/><br/>

";
?>
