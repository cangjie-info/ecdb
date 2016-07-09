<!DOCTYPE html>
<html>
   <head>
      <meta charset='UTF-8' />
      <title>Mengzi 孟子</title>
      <link rel='stylesheet' type='text/css' href='../mengzi_style.css' />
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      <script src='https://www.gstatic.com/charts/loader.js'></script>
      <script>
         google.charts.load('current', {'packages':['corechart']});
         google.charts.setOnLoadCallback(drawChart);
         function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'graph');
            data.addColumn('number', 'graph_count');
            var json_rows = <?php echo $json_rows; ?>;
            for (var i = 0; i < json_rows.length; i++) {
               var graph = json_rows[i]['graph'];
               var graph_count = Number(json_rows[i]['graph_count']);
               data.addRow([graph, graph_count]);
            }
            var options = {
               width: 1000,
               height: 500,
               title: 'Graph frequencies in the Mencius'
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
         };
      </script>
   </head>
   <body>
      <h1>Mengzi 孟子</h1>

      <div id='chart_div'></div>
   </body>
</html>
