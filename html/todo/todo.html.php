<?php require $includes . 'top.html.php'; ?>
<h2>Planned changes to the ECDB data or web interface.</h2>
<h3>Short term</h3>
<ul>
<li>Complete HD data entry.</li>
<li>Mergers etc.
    <ul>
        <li>以</li>
        <li>翌日</li>
        <li>月 and 夕 - this is a confusing issue, and the solution adopted should be documented.</li>
        <li>the 羌 group - again, complex. Needs careful thought.</li>
    </ul>
<li>ref_ics3 table - a reference list of all ICS3 graphs and their CHANT bushou, plus web page.</li>
<li>glyphs for new graphs</li>
<li>name, cjk_strict and cjk_fudge fields in graphs table need to be extensively populated.</li>
<li>grapheme/ling_val categories - livestock animals, body parts, numerals, ganzhi, sacrifical verbs, etc.</li>
<li>imgs and page numbers for hj, uk, tn, etc.</li>
<li>review and improve all existing pages.</li>
<li>search by collection and surface number</li>
<li>concordance by prior and previous graph</li>
<li>Add live-editable prose analyses for graphs and ling_vals</li>
<li>List all ics3 glyphs associated with a particular graph. (also Shen &amp; Cao numbers).</li>
<li>"Other projects" page or selected list of links.</li>
<li>Data sources page</li>
<li>Merge HD signs into graphs table</li>
<li>hook up viewer client to edit the main db</li>
<li>populate unambiguous graph instances with linguistic values - numerals, most ganzhi, 貞 etc.</li>
<li>break up CHANT hewen - this is complex - do as transaction with rollback on failure.</li>
<li>Fonts page.</p>
<li>Joins and duplicates infrastructure</li>
<li>ECDB php API - swap graph etc., insert graph, global replace.</li>
<li>Baxter and Sagart linguistic values list</li>
<li>Glossary of terms table and page.</li>
<li>add mechanism for recording joins and duplicates
<li>add lingistic data</li>
<li>add CDP obi data to ECDB: merge to graphs, and residue to ref_cdp</li>
<li>upload hj images</li>
<li>hj image paths</li>
<li>rename CZCN image files to match HD files</li>
<li>complete match of HD graphs to shen 2008</li>
<li>complete HD proofing and image data</li>
<li>master font to display master sign list - try ics3.ttf+huadong.ttf+(new signs for czcn).</li>
<li></li>
</ul>
<h3>Longer term</h3>
<ul>
<li>CHANT bi data.</li>
<li>CDP  data.</li>
<li>Duplicates and joins.</li>
<li>CSS styling.</li>
<li>New CHANT OBI data - joins, bubian and OBI groups.</li>
<li>OBI images.</li>
<li>ImageMagick.</li>
<li>Guangyun and Shuowen.</li>
<li></li>
<li></li>
<li></li>
</ul>
==Longer term goals==
===OBI===
*Merge HD and CZCN transcriptions using common signlist. 
*document gulin/leizuan sign list
*document HuaDong project
*put HuaDong data online
*add [[CHANT]] OBI data to ECDB
*add some received texts to ECDB - try [[Mengzi]]
*document CHANT fonts & data
*document Shen & Cao (2008)
*functionality for joins and duplicates
===Web interface===
*concordance
*dynamic google earth map of localities
*use ImageMagick to display individual inscriptions and graphs.

==Workflow==
'''first''': Read/edit [http://cangjie.info/wiki/index.php?title=Early_Chinese_Database_%28ECDB%29#Immediate_goals immediate goals] list. Only do things that are on this list.

'''web page edits''': Start by pulling version of web-page from git hub. Edit. Commit. Push remote to github and to site if ready.

'''db edits''': no need to push local to web for every edit. Like backups, import/export SQL file using PhpMyAdmin.

'''data wrangling''': transfer all files to local ecdb/data_in_process/ until complete. Preserve original and finished data, and scripts used for wrangling, in ecdb/data_archive/done/

'''edits to desktop clients''': start by pulling from github. End with compilable code, commit, push to github.

'''last''': edit [http://cangjie.info/wiki/index.php?title=Work_log work log] to state what has been completed.

==Data==
===Sign lists===
*CHANT ICS3
*HuaDong.ttf
*Jiaguwenzi gulin 甲骨文字詁林 / leizuan 類纂.
*Shen (2008)
*jiaguwen bian 甲骨文編
*Liu Zhao Xin jiaguwen bian 新甲骨文編
*Li Zongkun Jiagu wenzi bian 甲骨文字編
*Chen Nianfu 陳年福 殷墟甲骨文字詞總表 [http://www.xianqin.org/blog/archives/2634.html]
*Chinese Document Processing lab [http://cdp.sinica.edu.tw/hanzi/cdphanzi.htm]
*Chen Tingzhu 陳婷珠. 2010. Yin Shang Jiaguwen Zixing Xitong Zai Yanjiu 殷商甲骨文字形系統再研究. Di 1 ban. Shanghai: Shanghai Renmin Chubanshe 上海人民出版社. (附录: 甲骨文字形表)
* Matt's sign list

===Text transcriptions===
====Electronic====
*CHANT x 2
*Matt CZCN
*Adam HuaDong
*Takashima Bingbian [http://kjc-sv016.kjc.uni-heidelberg.de]
====Print====
*陳年福編《殷墟甲骨文摹釋全編》

==Tools==
===Languages===
*[https://www.python.org/ Python3] - for cleaning up local data files.
** Python [https://docs.python.org/3.1/library/re.html re module] for regular expressions.
*[http://www-h.eng.cam.ac.uk/help/tpl/languages/C++.html C++] - for developing desktop clients.
*[http://qt-project.org/ Qt] - C++ library, for developing desktop clients.
*[http://docs.webplatform.org/wiki/html html5] and [http://docs.webplatform.org/wiki/css css] for web interfaces.
*[http://www.php.net/manual/en/ PHP] - for web interfaces.
*[http://docs.webplatform.org/wiki/javascript JavaScript] - for web interfaces.
===Database===
*[http://dev.mysql.com/doc/refman/5.5/en/ MySQL] - local and remote installations of MySQL. Currently both are v. 5.5. The local installation contains the updated master copy of the data.
*[http://docs.phpmyadmin.net/en/latest/ phpMyAdmin] - for database administration.
===Web hosting===
*[http://www.hostgator.com/ Hostgator].
===Other tools===
*[http://www.mediawiki.org/wiki/Help:Contents MediaWiki] - for this wiki.
*[[FontForge]] - font editor.
*[https://launchpad.net/glyphtracer Glyphtracer] - to make fonts from images.
*[http://docs.gimp.org/2.8/en/ GIMP] - image editor.
*[http://vimdoc.sourceforge.net/ Vim] - text editor.
*[[ssh]] - for remote communication via command line.
*[[git]] - version control.
*[[Grsync]] - incremental file transfer, for local backups.
*[[Doxygen]] - documentation.
*pdftoppm - converts pdf into images, e.g. <code>pdftoppm -jpeg -r 300 file.pdf prefix</code>
*pdftk - for re-paginating, joining etc. pdf docs.
*[[Linux command-line tools]]

==Where is everything?==
*<code>cangjie.info/ecdb/</code>
**<code>cangjie.info/ecdb/html/</code> - pw-protected web interface, nothing here now.
**<code>cangjie.info/ecdb/html_public/</code> - public web interface, nothing here now.
**<code>cangjie.info/ecdb/repository/</code> - image files, etc.
**<code>cangjie.info/ecdb/documentation/</code> - public pdf documentation files.
*Anything may be on this wiki.
*All code (C++/Qt, python, php, HTML, etc.) should be on GitHub [https://github.com/cangjie-info], (with my local version as /home/ads/code/)
*MySQL data is currently local - backing up is important - as data is improved, it can be migrated online.

==Backup Procedures==
*wiki - this wiki is not backed up, except by Hostgator..
*code - git remote repository makes backup unnecessary.
*MySQL files - export as dated , zipped SQL file using PhpMyAdmin. Save in ~/Dropbox/ecdb_bak.
*files - use Grsync to backup local files to hard-drive.
*Zotero - synced to multiple machines. Backup zotero directory using Grsync.
</body>
</html>
