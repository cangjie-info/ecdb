<?php require $includes . 'public_top.html.php'; ?>
<h2>Introduction</h2>
<p>The aim of this sub-project is to incorporate a complete representation of the Guangyun 廣韻 (GY) rhyme book into ECDB, both as a source of MC phonological data, and also as a lexical source.
There are several free sources of GY data available (see below). The sub-project will aim first to set up an independent GY MySQL database, and then will try to incorporate those tables into the relational structure of ECDB.
The typable transcription/reconstruction of Baxter (1992) will be used to represent MC phonological values.

<h2>Data sources</h2>

<h3>rhymedict - GuangyunSkimmer</h3>
<p>This is the main data source to be used in this sub-project.</p>
<p>This data includes a full representation of the phonological structure, headwords, and glosses of the Guang Yun 廣韻 rhyme dictionary. It is published online under the GNU GPL v3 license. The data also forms the basis of the <a href='http://ytenx.org'>韻典</a> website. The data is available for download: <a href='https://code.google.com/p/rhymedict/'>https://code.google.com/p/rhymedict/</a>
<p>downloaded: Fri 13 Feb 2015 10:15:39 PM EST, and in the ECDB data archive.</p>

<p>The GY is represented in five files.</p>
<ul><li>dziohym.csv - a list of GY homophone groups, with fanqie.</li>
<li>hiunn.csv - the finals (ignoring tone) of the GY. An initial plus a final uniquely specify a homophone group except for tone.</li>
<li>hiunnmiuk.csv - finals including tones, distinguishing kai/he and deng and chongniu.</li>
<li>kuankhiunn.csv - the words of the GY. The id field is of the form: /d+\.d+/ The first digits represent the homophone groups in order (referncing the id field o dziohym.csv), and the second, the number of the entry within the homophone group.</li>
<li>sjeng.csv - the set of 38 initials of the GY</li></ul>

<h4>Notes</h4>
<p>The headwords, fanqie and the glosses contain non-BMP graphs. The headwords will all be represented with codepoints in ecdb. But the glosses will be displayed as html, so all non-BMPs will be replaced with HTML entities. This is a hack to get around the fact that non-BMP unicode support is not available in earlier versions of MySQL, and is likely to be problematic for versions of PHP, PHPMyAdmin and various other tools.</p>
<p>Informtation about multiple readings of GY graphs is embedded into the text of the GY glosses, in formats like '又音某', '又音某、音某', '又某某切', '又某某、某某二切', etc. It is an easy task to extract the bulk of this information from the glosses using regular expressions. Since the additionl readings listed in the glosses do not always match the additional listing of the character elsewhere in the GY, this information is of some value.</p>

<h3>漢字データベースプロジェクト</h3>
<p>A sophisticated xml representation of the the entire text, including prefaces and book structure of the GY. 
Freely available for download from <a href = 'https://github.com/cjkvi/cjkvi-dict'>github</a>. Further documentation and other data here: <a href='http://kanji-database.sourceforge.net/'>http://kanji-database.sourceforge.net/</a>. 
The rhymedict project states that their GY gloss text came from this project, although their fanqie, headwords, etc. came from other sources. Data downloaded Fri 13 Feb 2015 10:05:52 PM EST, and in the ECDB data archive. To convert the xml data into a csv format suitable for import to MySQL, use something like the Python <a href='https://docs.python.org/2/library/xml.etree.elementtree.html'>ElementTree XML API</a>. 
Since the GY headwords and fanqie are indepdendent of the ryhmedict project's data, it would be good to run them against one another in comparison. The text of the prefaces would also be useful as part of a static page on the GY.</p>

<h3>Digitized GY editions</h3>
<p>I am aware of the following digitized GYs:</p>
<ul>
<li>Waseda U. Library
<ul><li><a href='http://www.wul.waseda.ac.jp/kotenseki/html/ho04/ho04_01757/index.html'>1704 澤存堂 edition</a>.</li>
<li></li><a href='http://www.wul.waseda.ac.jp/kotenseki/html/ho04/ho04_00038/index.html'>1667 符山堂 edition</a>.</li>
</ul><li>
<li>Tokyo U., 東洋文化研究所
<ul><li><a href='http://shanben.ioc.u-tokyo.ac.jp/main_p.php?nu=148400&order=rn_no&no=00081'>1704 澤存堂 edition</a>.</li>
</ul></ul>

<h2>Work done</h3>
<p>All files transferred to MySQL, and appropriately renamed.<p>

<h4>Initials</h4>


</body>
</html>
