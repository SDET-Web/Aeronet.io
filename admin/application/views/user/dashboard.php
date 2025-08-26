<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Month', 'User', 'Product', 'Credits'],
        <?php
        $start = $month = strtotime(date('Y').'-01-01');
		$end = time();
		while($month < $end){
			echo "['".date('M', $month)."', ".($subs[date('M', $month)]==''?'0.00':$subs[date('M', $month)]).", ".($prod[date('M', $month)]==''?'0.00':$prod[date('M', $month)]).", ".($cred[date('M', $month)]==''?'0.00':$cred[date('M', $month)])."],";
			$month = strtotime("+1 month", $month);
		}?>
        ]);

        var options = {
          title: 'This Year\'s Income',
          hAxis: {title: 'Month', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>


<div class="row">
	<div class="col-lg-12 portlets ui-sortable">
		<div class="panel">
			<div class="panel-header bg-dark">
				<h3><i class="fa fa-table"></i> Dashboard</h3>
				<div class="clearfix"></div>
			</div>
			<div class="filter-left">
				<div class="panel-content pagination2 table-responsive">
					<div class="clear">&nbsp;</div>

<h4 class="alert_info">Welcome to Admin Panel for Lazy-Eights.com, Use left side Panel to navigate.</h4>



					<div class="clear">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
</div>