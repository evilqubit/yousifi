
<div class="googleAnaylticMainContainer">




        
        

<div class="box" style="float: left; width: 690px;">
<div class="box-title">
<h3><i class="icon-bar-chart" style="float:left;"></i> <div style="float:left; font-family: Arial; font-size: 18px; color: #C1014D; font-weight: normal;"> Visitors Chart / Last 30 Days</div></h3>
<div class="box-tool">
 
</div>
</div>
<div class="box-content">

    <div id="chartContainer" style="height: 300px; width:670px;"></div>

       <script type="text/javascript">

	    var chart = new CanvasJS.Chart("chartContainer",
	    {
	
	      title:{
	     
	      },
	       data: [
	      {
	        type: "line",
	        showInLegend: true, 
			name: "series1",
	        legendText: "Page Visits",
	        dataPoints: [
	        <?php foreach($results as $result): ?>
	        
	        { x: new Date( <?php echo substr($result,0,4);?>, <?php echo substr($result,4,3) - 1;?>, <?php echo substr($result, 8);?>) , y: <?php echo $result->getVisits();?> },
	        <?php endforeach; ?>
	        ]
	      },
	        {
	        type: "line",
	        showInLegend: true, 
			name: "series1",
	        legendText: "Page Views",
	        dataPoints: [
	        <?php foreach($results as $result): ?>
	        
	        { x: new Date( <?php echo substr($result,0,4);?>, <?php echo substr($result,4,3) - 1;?>, <?php echo substr($result, 8);?>) , y: <?php echo $result->getPageviews();?> },
	        <?php endforeach; ?>
	        ]
	      }
	      ]
	    });
	    chart.render();
	    $('.canvasjs-chart-credit').hide();
	 </script> 
             
 </div>
 
</div>

<div class="googleWeeklyResault">
	<div class="googleTitle">Weekly Visitors Stat</div>
	<div class="googleVisitText">Visits: <span class="value"><?php echo $visits ?></span></div>
	<div class="googleVisitText">Page Views: <span class="value"><?php echo $pageviews ?></span></div>
	
	<div class="googleAnaylticsLink">
		<div style="float:left;"><img style="margin-right: 10px;" width="60px" height="60px" src='/img/utility/googlea.png'/></div>
		<div style="float: left; width: 160px; font-family: Arial; margin-top: 10px; font-size: 14px;"> Go to <a href="http://www.google.com/analytics/">Google Analytic's</a>  website for more insights</div>
	</div>
		
</div>
                      
</div>
       


        

                  