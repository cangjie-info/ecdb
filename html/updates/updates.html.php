<?php require $includes . 'top.html.php'; ?>
<p>Dated descriptions of completed updates to the ECDB database structure and data. Modifications to the web page code is tracked with git commit messages - doesn't go here.</p>
<hr />
<!--- New entries immediately below this comment -->
<p>Sat 20 Sep 2014 02:03:59 PM EDT</p>
<p>Mergers of ganzhi duplicates in the graphs table. Merger of ２惠 signs. Assignment of linguistic values to disambiguate 子 and 巳 (now identical graphically). Correction of the "coffin" pictorgam problem.</p>
<p>ling_values table added, together with a few sample values.</p>
<hr />
<p>Tue 26 Aug 2014 11:21:35 AM EDT</p>
<p>Added cjk_strict and cjk_fudge to graphs table. If there is an exact CJK match (incl. extensions A, B, etc.), then its code point goes in cjk_strict. Must be unique. cjk_fudge can hold any approximation of the graph written in unicode text. e.g. 貞-卜, etc. Need not be unique.　Leave blank if cjk_strict has a value.</p>
<p>Added graphs_kaoshi, and arch_reports tables. These are for storing zotero item keys for their respective topics.</p>
<p>Added ling_values table.</p>

<!-- Format for entries 
<p> date </p>
<p> summary description </p>
<hr />
-->

</body>
</html>
