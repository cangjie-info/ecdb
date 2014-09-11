<?php
$page_name = "Bib test"; // title and <h1>
require '../../includes/all.php';

$zot_tags = array('OBI', 'Corpora');
$zot_data = getZot('tags', $zot_tags);

//include page with html
require 'bib_test.html.php';

?>
