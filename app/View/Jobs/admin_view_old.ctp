<div class="maintitle">Careers</div>
<div class="subtitle"><?=$page_subtitle?></div>
<div class="cv_box">
	<div class="label" style="">Name</div>
	<div class="cv_div"><?php echo $this->request->data["$modelName"]["first_name"]." ".$this->request->data["$modelName"]['last_name']; ?></div>
</div>
<div class="cv_box">
	<div class="label" style="">Email</div>
	<div class="cv_div"><?php echo $this->request->data["$modelName"]["email"]?></div>
</div>
<div class="cv_box">
	<div class="label" style="">Phone</div>
	<div class="cv_div"><?php echo $this->request->data["$modelName"]["phone"]?></div>
</div>
<div class="cv_box">
	<div class="label" style="">Website</div>
	<div class="cv_div"><?php echo $this->request->data["$modelName"]["website"]?></div>
</div>
<div class="cv_box">
	<div class="label" style="border:0px;padding:0px;">CV</div>
	<div class="cv_div"><a href="/admin/jobs/download/<?php echo $this->request->data["$modelName"]["id"]; ?>" title="download"><span class="FloatClass"><?php echo $this->request->data["$modelName"]["cv"]; ?></span></a></div>
</div>


<script type="text/javascript">
function print_page(){
	  var a = window.open('','','width=800,height=800,scrollbars=yes,resizable=yes');
       a.document.open("text/html");
       a.document.write('<link rel="stylesheet" type="text/css" href="/css/admin/default.css" />');
       a.document.write("<div class='maintitle'>Contact Forms</div><div class='subtitle'>View</div>"+$('#content_for_print').html()+"<\/div>");
       a.document.close();
       a.print();
}
</script>