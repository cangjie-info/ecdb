<?php
# PAGE TEMPLATE FOR ALL HTML PAGES
# To create a new page: 
# cp -r page_template <new_page_name>
# index.php should be exlusively php.
# Handles configuration files, db connection
# and querying, and data processing.
# It then 'includes' the html to display
# the page from the .html.php file in the same
# directory

//paths and other config
require '../../includes/all.php';

//connect to db
//all pages needing db connection need this
require $includes . 'mengzi_db_connect.php';

$PREPUNC_BITMASK = [
        1 => '“', #LEFTQUOTE
        2 => '‘',
        4 => '《'];

$POSTPUNC_BITMASK = [
        8 => '》',
        16 => '。',  #PERIOD
        32 => '？',
        64 => '！',
        128 => '、',
        256 => '，',
        512 => '：',
        16384 => '；',
        1024 => '’',
        2048 => '”'];

$narrative_id = 174;
if(isset($_GET["id"])) {
   $narrative_id = intval($_GET["id"]);
}

$query = 'SELECT TEST_graph, punc, sentences.number AS sn
          FROM narratives
            INNER JOIN sentences
            ON narrative_id = narratives.id
            INNER JOIN inscr_graphs
            ON sentence_id = sentences.id
          WHERE narratives.id = ' . $narrative_id .
          ' ORDER BY sentences.number, 
               inscr_graphs.sentence_number;';
   
$result = mysqli_query($link, $query);

if(!$result)
{
   $output = 'Error fetching containers: ' . mysqli_error($link);
   include $includes . 'error.html.php';
   exit();
}

$narrative_string = "";
$prev_sentence_number = 0;
while ($row = mysqli_fetch_assoc($result))
{
   if($prev_sentence_number == 0) {
      $narrative_string .= '<span id="' . $row['sn'] . '">';
   }
   else if($prev_sentence_number != $row['sn']) {
      $narrative_string .= "</span>\n<span id='" . $row['sn'] . "'>";
   }  
   $prev_sentence_number = $row['sn'];
   $graph[] = $row['TEST_graph'];
   $punc[] = $row['punc'];
   foreach($PREPUNC_BITMASK as $mask => $punc_char) {
      if(end($punc) & $mask) $narrative_string .= $punc_char;
   }
   $narrative_string .= end($graph);
   foreach($POSTPUNC_BITMASK as $mask => $punc_char) {
      if(end($punc) & $mask) $narrative_string .= $punc_char;
   }
}
$narrative_string .= "</span>";

$query = 'SELECT translation_text
         FROM translation_units
         INNER JOIN sentences ON sentences.id = follows_sentence_id
         INNER JOIN narratives ON narratives.id = sentences.narrative_id
         WHERE narratives.id = ' . $narrative_id .
         ' ORDER BY sentences.number;';

$result = mysqli_query($link, $query);
if(!$result)
{
   $output = 'Error fetching containers: ' . mysqli_error($link);
   include $includes . 'error.html.php';
   exit();
}

$translation = "";
while($row = mysqli_fetch_assoc($result))
{
   $translation .= " " . $row['translation_text'] . " ";
}


//include page with html
require 'narrative.html.php';


?>
