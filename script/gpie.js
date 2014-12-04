var pathname = window.location.pathname;
var pathnameSplitted = pathname.split('?');
var endereco = pathnameSplitted[0];

  if( endereco.toUpperCase() == "/LTW/panel/viewpoll.php".toUpperCase()) {

        google.load("visualization", "1", {packages:["corechart"]});

      	var url = window.location.href;
      	var urlsplitted = url.split('=');
      	var parameters = urlsplitted[1];
        var temp = parameters.split('&');
        var id = temp[0];
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
  }
  else {};
