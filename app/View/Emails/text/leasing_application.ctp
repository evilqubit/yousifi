<?php


$type_of_space=$type_of_space_list[$data['space_type_id']];
$business_type=$business_of_space_list[$data['business_type_id']];

//$branch=$branches[$data['branch_id']];

$branch='';
if(isset($data['branch_id']) && !empty($data['branch_id'])){
	
	$branches_list=explode(',', $data['branch_id']);
	$count=count($branches_list);
	foreach($branches_list as $key=>$d){
		$branch_name=$branches[$d];
		$branch .= "$branch_name"." , ";
	}
}


$id=$data['id'];

$main_url=Configure::read('WEBSITE_URL');

$download_url=$main_url."/LeasingRelatedEntries/download/$id";

$file=$data['profile'];
$down="<a href='$download_url'>$file</a>";



$EMAIL_SIGNATURE=Configure::read("EMAIL_SIGNATURE_TEXT");
print "Dear Administrator,\n\n

A new leasing application form has been submitted with the following information:\n\n




Name : {$data['name']}\n

Email : {$data['email']}\n

Phone : {$data['phone']}\n
Mobile : {$data['mobile']}\n
Fax : {$data['fax']}\n

Phone : {$data['phone']}\n
Type of space required : {$type_of_space}\n

Business type: {$business_type}\n
Other Business type : {$data['business_type']}\n

Shop/Stand Name : {$data['shop_name']}\n

Space Required (sqm) : {$data['space_required']}\n



Branch: {$branch}\n

Company Profile : {$down}\n
Website : {$data['website']}\n



";
?>