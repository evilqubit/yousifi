<?php
$EMAIL_SIGNATURE=Configure::read("EMAIL_SIGNATURE_TEXT");

$company=$data['company'];
$phone=$data['phone'];


if(empty($company)){
	$company='N/A';
}
if(empty($phone)){
	$phone='N/A';
}


print "Dear Administrator,\n\n

A new contact form has been submitted with the following information:\n\n




Inquiry {$data['department']} \n
Subject {$data['subject']} \n

Name {$data['name']} \n
Email  {$data['email']} \n
Company  {$company} \n
Telephone  {$phone} \n

Message \n
{$data['message']}\n


";
?>