<div class="dashboard_google">
	<div class="dashboardHeaderContainerGoogle">
		<div class="dashboardHeaderIconGoogle"></div>
		<div class="dashboardHeaderTextGoogle">Google analytics</div>
	</div>
	
	<div class="GoogleMainContainer" id="GoogleMainContainer">
		Loading google analytics <img src="/img/ajax-loader.gif" width="20" height="20" alt=""/>
	</div>
	
</div>


<script type="text/javascript">
	$(document).ready(function(){
	$.ajax({
		url: '/admin/Administrators/getstats',
		beforeSend:function(data){
			$("#news_dropDown").show();
		},
		success: function(data){
			
			$('#GoogleMainContainer').html(data);
			
		},
		complete: function(){
			$("#news_dropDown").hide();
		}
	});
	});
</script>