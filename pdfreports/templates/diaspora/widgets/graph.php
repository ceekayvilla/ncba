<script type="text/javascript">
$(function () { 
	    $('#graph').highcharts({
	        chart: {
	            type: 'line'
	        },
	        title: {
	            text: 'NSE Stock Price'
	        },
	        xAxis: {
	            categories: [<?php echo $dataArray['xValues'] ?>]
	        },
	        yAxis: {
	            title: {
	                text: 'Shares Traded'
	             }
	        },
	        series: [
			{
	            name: 'Mumias Sugar',
	            data: [1086, 909, 1074, 1086, 989, 974]
	        }, {
	            name: 'Kenya Power',
	            data: [5074, 7976, 3874, 5074, 3976, 3874]
	        }]
	    });
	});
</script>
<div class="graph" id="graph">
					
</div>