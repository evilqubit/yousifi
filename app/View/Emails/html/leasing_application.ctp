<?php





$type_of_space=$type_of_space_list[$data['space_type_id']];
$business_type=$business_of_space_list[$data['business_type_id']];

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

$EMAIL_SIGNATURE=Configure::read("EMAIL_SIGNATURE_HTML");
print "Dear Administrator,<br/><br/>

A new leasing application form has been submitted with the following information:<br/><br/>







<b>Name </b> {$data['name']}<br/>

<b>Email </b> {$data['email']}<br/>

<b>Phone </b> {$data['phone']}<br/>
<b>Mobile </b> {$data['mobile']}<br/>
<b>Fax </b> {$data['fax']}<br/>

<b>Phone </b> {$data['phone']}<br/>
<b>Type of space required </b> {$type_of_space}<br/>

<b>Business type</b> {$business_type}<br/>
<b>Other Business type </b> {$data['business_type']}<br/>

<b>Shop/Stand Name </b> {$data['shop_name']}<br/>

<b>Space Required (sqm) </b> {$data['space_required']}<br/>



<b>Branch</b> {$branch}<br/>

<b>Company Profile </b> {$down}<br/>
<b>Website </b> {$data['website']}<br/>


";
?>
