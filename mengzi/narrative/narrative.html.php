<!DOCTYPE html>
<html>
   <head>
      <meta charset='UTF-8' />
      <title>Mengzi 孟子</title>
      <link rel='stylesheet' type='text/css' href='../mengzi_style.css' />
      <script>
      var highlight_id = 1;
      function init() {
         document.getElementById("1").className = "highlight";
      }
      document.onkeydown = function(evt) {
         evt = evt || window.event;
         if (evt.keyCode == 39) {
            var old_div = document.getElementById(highlight_id);
            highlight_id++;
            var new_div = document.getElementById(highlight_id);
            if(!new_div) {
               highlight_id = 1;
               new_div = document.getElementById(highlight_id);
            }
            old_div.className = "";
            new_div.className = "highlight";
         }
      };
      </script>
   </head>
   <body onload="init()">
      <h1>Mengzi 孟子</h1>

<?php


echo '<p>' . $narrative_string . "</p>\n";
echo "<p>$translation</p>";
?>
   </body>
</html>
