<?php


$id=$data['AppliedCv']['id'];



$job_title=$data['job_details']['title'];
$job_title= "<b>Job applied for </b> {$job_title}<br/>";

$name=$data['AppliedCv']['first_name']." ".$data['AppliedCv']['last_name'];
$email=$data['AppliedCv']['email'];
$phone=$data['AppliedCv']['phone'];




$main_url=Configure::read('WEBSITE_URL');

$cv_download_url=$main_url."/admin/Jobs/download/$id/cv";

$cv_down='N/A';
if(isset($data['AppliedCv']['cv']) && !empty($data['AppliedCv']['cv'])){
	$file=$data['AppliedCv']['cv'];
	$cv_down="<a href='$cv_download_url'>$file</a>";
}


$EMAIL_SIGNATURE=Configure::read("EMAIL_SIGNATURE_HTML");
print "Dear Administrator,<br/><br/>

A new career form has been submitted with the following information:<br/><br/>




{$job_title}

<b>Name </b> {$name}<br/>


<b>Email </b> {$email}<br/>
<b>Phone </b> {$phone}<br/>

<b>CV </b> {$cv_down}<br/>

";
?>
