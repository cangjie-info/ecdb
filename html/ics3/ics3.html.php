<?php require $includes . 'top.html.php'; ?>

<p>filename = ics3.ttf
<br />
md5 = e6ad0ab25b93ef0fde5eb02baff43dfe
<br />fontname = "ICS3"
Version = 2.0; 2003; initial release
<br />
copyright = "Copyright (c) CHANT, ICS, CUHK,, 2003. All rights reserved."
</p>
This font was originally for use with the earliest version of the CHANT oraclebone database.
It is no longer available for download from the CHANT site, having been superseded by the chant.ttf font, which includes oracle-bone glyphs as well as other font-ranges needed for the CHANT databases.
It appears that the oracle-bone glyphs in the ics3.ttf font are identical to those in the chant.ttf font, which simply translates them by a constant offset. The advantage of the original ics3.ttf font is that all the defined glyphs fall within the BMP (mostly within the range of the Private Use Area). 
This means that applications which are not fully unicode compliant (i.e. which do not support non-BMP code-points) can be used without modification to handle text encoded according to ics3.ttf.
</p> 
<p>The glyphs in the font are relatively large, with a fixed width of 1024 (inluding the alphanumeric and punctuation glyphs). This means that they do not display well together with alphabetic text at the same point-size.</p>

<p>The font has defined glyphs in the following Unicode ranges:</p>
<p>0020-007e:   ASCII</p>
<p class="ics3">
<?php 
function unichr($u) {
       return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
}

for ($i = 0x0020; $i <=0x007e; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>2026: 3dot ellipsis     U</p>
<p class="ics3">&#x2026;</p>
<p>25a1: lacuna         U</p>
<p class="ics3">&#x25a1;</p>
<p>3001: list comma     U</p>
<p class="ics3">&#x3001;</p>
<p>3002: Chinese period U</p>
<p class="ics3">&#x3002;</p>
<p>3014-3015: Chinese brackets   U</p>
<p class="ics3">&#x3014;&#x3015;</p>
<p>e000-f83d: jiaguwen glyphs (some BLANK)</p>
<p>e000-f453: apparently in bushou and sign-list order</p>
<p class="ics3">
<?php 
for ($i = 0xe000; $i <=0xf453; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f454-f4ca: gan & zhi (with one intrusion at f45a)</p>
<p class="ics3">
<?php 
for ($i = 0xf454; $i <=0xf4ca; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f4cb-f57a: day-name hewen</p>

<p class="ics3">
<?php 
for ($i = 0xf4cb; $i <=0xf57a; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f57b-f593: numerals 1-10 incl. variants</p>
<p class="ics3">
<?php 
for ($i = 0xf57b; $i <=0xf593; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f594-f5a3: various (incl. ganzhi and zhen), significance of placing unclear.</p>

<p class="ics3">
<?php 
for ($i = 0xf594; $i <=0xf5a3; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f5a4-f82f: more unusual signs, apparently in bushou and possibly signlist order.</p>
  
<p class="ics3">
<?php 
for ($i = 0xf5a4; $i <=0xf82f; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f830-f83d: all blank</p>

<p class="ics3">
<?php 
for ($i = 0xf830; $i <=0xf83d; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f83f: BLANK</p>
<p>f841-f847: jiaguwen glyphs (some BLANK)</p>

<p class="ics3">
<?php 
for ($i = 0xf841; $i <=0xf847; $i++) {
   echo "&#$i;";
}
?>
</p>
<p>f848: lacunae</p>
<p class="ics3">&#xf848;</p>
<p>f84f: BLANK</p>
<p class="ics3">&#xf84f;</p>
<p>(Unicode Private Use ends with f8ff)</p>
<p>fe30: colon       U (Presentation form for vertical two dot leader)</p>
<p class="ics3">&#xfe30;</p>
<p>ff01: exclamation    U (Fullwidth exclamation mark)</p>
<p class="ics3">&#xff01;</p>
<p>ff08-9: parentheses     U (Fullwidth ...  )</p>
<p class="ics3">&#xff08;&#xff09;</p>
<p>ff0c: comma       U (Full width …)</p>
<p class="ics3">&#xff0c;</p>
<p>ff1a: colon       U (Fullwidth …)</p>
<p class="ics3">&#xff1a;</p>
<p>ff1b: semi-colon     U (fullwidth)</p>
<p class="ics3">&#xff1b;</p>
<p>ff1f: question       U (fullwidth)</p>
<p class="ics3">&#xff1f;</p>
It remains to be determined which of these are actually used in the transcriptions.

<?php require $includes . 'public_bottom.html.php'; ?>

