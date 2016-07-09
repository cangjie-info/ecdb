<!DOCTYPE html>
<html>
   <head>
      <meta charset='UTF-8' />
      <title>Mengzi 孟子</title>
      <link rel='stylesheet' type='text/css' href='mengzi_style.css' />
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      <script src='https://www.gstatic.com/charts/loader.js'></script>
      <script>
         google.charts.load('current', {'packages':['bar']});
         google.charts.setOnLoadCallback(drawChart);
         function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Sub-container');
            data.addColumn('number', 'Narratives');
            data.addColumn('number', 'Graphs');
            var json_rows = <?php echo $json_rows; ?>;
            for (var i = 0; i < json_rows.length; i++) {
               var name_zh = json_rows[i]['name_zh'];
               var graph_count = Number(json_rows[i]['graph_count']);
               var narrative_count = Number(json_rows[i]['narrative_count']);
               data.addRow([name_zh, narrative_count, graph_count]);
            }
            var options = {
               width: 1300,
               height: 500,
               chart: {
                  title: 'Distribution of narratives in the Mencius'
               },
               series: {
                  0: {axis: 'Narratives'},
                  1: {axis: 'Graphs'}
               },
               axes: {
                  y: {
                     Narratives: {label: 'narratives'},
                     Graphs: {side: 'right', label: 'graphs'}
                  }
               }
            };
            var chart = new google.charts.Bar(document.getElementById('chart_div'));
            chart.draw(data, options);
         };
      </script>
   </head>
   <body>
      <h1>Mengzi 孟子</h1>

<table>
   <tr>
      <th colspan='2'>Subcontainer</th>
      <th>Narratives</th>
      <th>Graph count</th>
      <th>Avg. graphs per narrative</th>
   </tr>
<?php

for ($i = 0; $i < count($name_zh); $i++)
{
   echo "<tr>
      <td>$name_zh[$i]</td>
      <td>$name_en[$i]</td>
      <td>$narrative_count[$i]</td>
      <td>$graph_count[$i]</td>
      <td>" . (int)($graph_count[$i] / $narrative_count[$i]) ."</tr>";
}

?>
</table>
      <div id='chart_div'></div>
   </body>
</html>
