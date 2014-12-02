
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
      	var url = window.location.href;
      	var urlsplitted = url.split('=');
      	var id = urlsplitted[1];
        var chart = null;

        $(document).ready(function()
        {
            if (chart == null)
              chart = new google.visualization.PieChart(document.getElementById('piechart'));

            drawChart();
        });

      	function drawChart() 
        {
      		var result = '';
      		$.ajax({
      			type: "POST",
      			url: "reloadChart.php",
      			data: { id : id},
      			cache: false,
      			success: function(data)
            {
      				result = data;
              //alert(result.toSource());
              var graphData = google.visualization.arrayToDataTable(JSON.parse(result));

              var options = {
                  backgroundColor: 'transparent',
                  title: 'Results: ',
                  sliceVisibilityThreshold:0,
              };

              chart.draw(graphData, options);
      			}
      		});
        };