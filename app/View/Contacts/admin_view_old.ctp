<div class="maintitle">Contact Forms</div>
<div class="subtitle">View</div>

<!--<div class="FloatClass" style="width:642px;text-align:right"><a href="javascript:void();" onclick="print_page();return false;"><img src="/img/admin/print.gif" alt="" border="0" title="print" />&nbsp;Print</a></div>-->


<div id="content_for_print">
<?php
$modelName="Contact";
?>
<div class="cv_box">
	<div class="label" style="border:0px;padding:0px;">Name</div>
	<div class="cv_div"><?php echo $this->data[$modelName]["name"]; ?></div>
</div>
<div class="cv_box">
	<div class="label" style="border:0px;padding:0px;">Email</div>
	<div class="cv_div"><?php echo $this->data[$modelName]["email"]; ?></div>
</div>
<div class="cv_box">
	<div class="label" style="border:0px;padding:0px;">Phone</div>
	<div class="cv_div"><?php echo $this->data["$modelName"]["phone"]; ?></div>
</div>
<div class="cv_box">
	<div class="label" style="border:0px;padding:0px;">Department</div>
	<div class="cv_div"><?php echo $this->data['ContactDepartment']['title']; ?></div>
</div>
<div class="cv_box">
	<div class="label" style="border:0px;padding:0px;">Message</div>
	<div class="cv_div"><?php echo $this->data[$modelName]["message"]; ?></div>
</div>
<div class="cv_box">
	<div class="label" style="border:0px;padding:0px;">Date</div>
	<div class="cv_div"><?php echo $this->Time->niceShort($this->data[$modelName]['created']); ?></div>
</div>
</div>

<script type="text/javascript">
//function print_page(){
//	  var a = window.open('','','width=800,height=800,scrollbars=yes,resizable=yes');
//        a.document.open("text/html");
//        a.document.write('<link rel="stylesheet" type="text/css" href="/css/admin/default.css" />');
//        a.document.write("<div class='maintitle'>Contact Forms</div><div class='subtitle'>View</div>"+$('#content_for_print').html()+"<\/div>");
//        a.document.close();
//        a.print();
//}
</script>