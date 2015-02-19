<?php require $includes . 'top.html.php'; ?>

<h2>Save text image files in repository</h2>
<p>Images of published text surfaces should be in jpeg format. The file-name is stored in the img_file field of the inscr_surfs table, and so is relatively free to vary in format. However, clearly it makes sense to have image files that are transparently named, with the surface number and the publication name visible in the filename. The directory in which the files are placed, on the other hand, MUST have the same name as the name field in the pubs table, since this is used automatically to generate the correct path to the file. Pub names will be converted to lowercase when generating the path. The file path will be referred to in PHP as $repo_path/text_imgs/<PUBNAME>/<IMGFILE>.
<h2>Backup local db with mysqldump</h2>
<p>From the local shell:</p> 
<p><code>mysqldump -u root -p ecdb &gt; ecdb_yyyy-mm-dd.sql</code>.</p>
<p>On entering the pw, this will save an sql text file of the entire database to the current directory.</p>

<h2>Backup remote db with mysqldump</h2>
<pre>ssh www.cangjie.info -l &lt;USER&gt;</pre>
<p>Navigate to backup directory.</p>
<pre>mysqldump -u &lt;USER&gt; -p &lt;DBNAME&gt; &gt; ecdb.sql.yyyy.mm.dd
zip ecdb.sql.yyyy.mm.dd.zip ecdb.sql.yyyy.mm.dd</pre>

<h2>Restore local db from sql text file</h2>
<ol>
<li>Delete ("drop") any existing db called "ecdb" (using phpmyadmin, or mysql client).</li>
<li>Create an empty db called "ecdb" (using phpmyadmin, or mysql client).</li>
<li>Open shell prompt, and cd to wherever the .sql file is.</li>
<li><code>mysql -u root -p ecdb &lt; ecdb.sql</code>.</li>
<li><ul>
   <li>Enter mysql root pw when asked</li>
   <li>Because of the size of the db, it can take about 30-40s to populate the db.
       The prompt just hangs while that is going on.</li>
   <li>Refresh phpmyadmin page and see if it has worked.</li></ul>
</ol>
 
<h2>Restore remote (Hostgator) db from sql text file</h2>
<pre>scp &lt;PATH&gt;/ecdb.sql.yyyy-mm-dd &lt;USER&gt;@www.cangjie.info:~/tmp/ecdb.sql
ssh www.cangjie.info -l &lt;USER&gt;
mysql -h localhost -u &lt;DBUSER&gt; -p
drop database &lt;DBNAME&gt;;
create database &lt;DBNAME&gt;;</pre>
<p>Exit mysql client.</p>
<pre>mysql -h localhost -u &lt;USERNAME&gt; -p &lt;DBNAME&gt; &lt; ~/tmp/ecdb.sql
</pre>

<h2>Get Zotero item key from Firefox</h2>
<p>To read an item via the Zotero API, you need to have the item key. Oddly, the Zotero Firefox app does not provide simple access to the item keys. The following export translator will copy the item keys as a comma-separated list to the clipboard on Ctrl+Shift+c in the usual manner. The translator needs to be saved as a javascript file (<code>.js</code> file extension) in the Zotero <code>translators</code> directory.</p>
<pre>{
"translatorID":"0dbe4ec8-597c-4cc7-bfb5-c38321c5c689",
"translatorType":2,
"label":"Zotero Item Key",
"creator":"Adam Smith",
"target":"html",
"minVersion":"2.0",
"maxVersion":"",
"priority":200,
"inRepository":false,
"displayOptions":{"exportCharset":"UTF-8"},
"lastUpdated":"Fri 22 Aug 2014 12:24:20 PM EDT"
}

function doExport() {
	var item;
	while(item = Zotero.nextItem()) {
    Zotero.write(item.key);
	}
}</pre>

<h2>Insert COinS data into a web-page</h2>
<ol><li>Set Zotero Quick Copy default output format to "COinS".</li>
<li>Copy COinS data for one or more items to clipboard using Ctrl+Shift+c in the usual manner.</li>
<li>Paste the resulting <code>&lt;span&gt;</code>s into the html file. (view source for the contents of these brackets [
<span class='Z3988' title='url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_id=urn%3Aisbn%3A9787501017102&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book&amp;rft.btitle=Tengzhou%20Qianzhangda%20mudi%20%E6%BB%95%E5%B7%9E%E5%89%8D%E6%8E%8C%E5%A4%A7%E5%A2%93%E5%9C%B0&amp;rft.place=Beijing&amp;rft.publisher=Wenwu%20Chubanshe%20%E6%96%87%E7%89%A9%E5%87%BA%E7%89%88%E7%A4%BE&amp;rft.aulast=Zhongguo%20Shehui%20Kexue%20Yuan%20Kaogu%20Yaniusuo%20%E4%B8%AD%E5%9C%8B%E7%A4%BE%E6%9C%83%E7%A7%91%E5%AD%B8%E9%99%A2%20%E8%80%83%E5%8F%A4%E7%A0%94%E7%A9%B6%E6%89%80&amp;rft.au=Zhongguo%20Shehui%20Kexue%20Yuan%20Kaogu%20Yaniusuo%20%E4%B8%AD%E5%9C%8B%E7%A4%BE%E6%9C%83%E7%A7%91%E5%AD%B8%E9%99%A2%20%E8%80%83%E5%8F%A4%E7%A0%94%E7%A9%B6%E6%89%80&amp;rft.date=2005&amp;rft.isbn=9787501017102'></span>

<span class='Z3988' title='url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_id=urn%3Aisbn%3A9787100000572&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book&amp;rft.btitle=%3Ci%3EZuo%20Zhuan%3C%2Fi%3E%20xuci%20yanjiu%20%E5%B7%A6%E5%82%B3%E8%99%9B%E8%A9%9E%E7%A0%94%E7%A9%B6&amp;rft.place=Beijing&amp;rft.publisher=Shangwu%20Yinshuguan%20%E5%95%86%E5%8B%99%E5%8D%B0%E6%9B%B8%E9%A4%A8&amp;rft.aulast=He%20Leshi%20%E4%BD%95%E6%A8%82%E5%A3%AB&amp;rft.au=He%20Leshi%20%E4%BD%95%E6%A8%82%E5%A3%AB&amp;rft.date=1989&amp;rft.isbn=9787100000572'></span>
] to see an example.) The COinS data should result in a clickable citation link in the Firefox URL window. Click to import to Zotero.</li>
</ol>
<p>This procedure currently has one obvious shortcoming for single-field Chinese-style author names. A single author name gets duplicated as both <code>rft.aulast</code> <em>and</em> <code>rft.au</code>. On import, the author appears twice. Try importing from this page, and inspecting the COinS source, and you will see what I mean. Deleting one of the duplicates is easy, but it is annoying. Writing an alternative COinS export translator would be one solution.</p>   


<h2>Insert Zotero bibliographic data into a web-page by querying the Zotero API</h2>
<ol>
    <li>Figure out your Zotero user id. This is not the same as your Zotero username. Log into your Zotero account at www.zotero.org. Settings &gt; Feeds/API. Copy the value given by "Your userID for use in API calls is ... ".</li>
    <li>Construct an API query URL that gives you the bibliographic data you need in the format you want it. <a href="https://www.zotero.org/support/dev/web_api/v2/read_requests">Documentation</a>.</li>
    <ul>
        <li>The URL starts with <code>https://api.zotero.org/users/&lt;userid&gt;/</code>.</li>
        <li>For a single bibliographic item, add <code>items/&lt;itemkey&gt;</code>. To discover the item key, see the HowTo on this page.</li>
        <li>Item example: <code>https://api.zotero.org/users/160881/items/8HTNV32W/?v=3&format=bib&style=elsevier-harvard2</code>. <code>160881</code> is my user id. <code>8HTNV32W</code> is the item id in my Zotero database. <code>v=3</code> selects the most recent API version number (i.e. ver. 3). <code>format=bib</code> requests that the data be formatted as an XHTML bibliography. <code>style=elsevier-harvard2</code> sets the citation style. I like elsevier-harvard2 because 1/ it doesn't pointlessly capitalize all title words, and 2/ it doesn't italicize Chinese (or any) titles. See the result returned by this URL <a href="https://api.zotero.org/users/160881/items/8HTNV32W/?v=3&format=bib&style=elsevier-harvard2">here.</a></li> 
        <li>Multiple item example: <code>https://api.zotero.org/users/160881/items/?v=3&format=bib&style=elsevier-harvard2&itemKey=UDAKWEPD,6MPC3NRH,BETZ6T8M,2A44Q48D,9KDGT7VK,24MN76X3,IFITWC8S,5JKVSN7X,DSF26IDM,2W76QV2C,983IUQW6,5IBA73W6</code>. Notice that the item keys are now a comma-separated list in the query string. Result is <a href="https://api.zotero.org/users/160881/items/?v=3&format=bib&style=elsevier-harvard2&itemKey=UDAKWEPD,6MPC3NRH,BETZ6T8M,2A44Q48D,9KDGT7VK,24MN76X3,IFITWC8S,5JKVSN7X,DSF26IDM,2W76QV2C,983IUQW6,5IBA73W6">here</a>.</li>
        <li>Tag example: to return a bibliography of all items with a particular tag use tag=<tagname> in the query string. E.g. <code>https://api.zotero.org/users/160881/items/?v=3&format=bib&style=elsevier-harvard2&tag=OBI</code>. Result is <a href="https://api.zotero.org/users/160881/items/?v=3&format=bib&style=elsevier-harvard2&tag=OBI">here</a>. For more complocated tag queries, see the <a href="https://www.zotero.org/support/dev/web_api/v2/read_requests">Documentation</a>.</li>
        <li>COinS: By changing the <code>format=bib</code> to <code>format=coins</code>, a set of <code>&lt;span&gt;</code>s containing COinS data is returned instead. <code>https://api.zotero.org/users/160881/items/?v=3&format=coins&tag=OBI</code>.</li> 
    </ul>
    <li>Adding the bibliograpic data to a php/html webpage is simple:<pre>
&lt;?php 
$url = 'https://api.zotero.org/users/160881/items/?v=3&format=coins&tag=OBI';
$var = file_get_contents($url);
echo $var;
?&gt;<pre>
    </li>
</ol>

<h2>Install git</h2>
<p><code>sudo apt-get install git</code> (or use synaptic)</p>
<!--
2. IDENTIFY YOUR APACHE WEBROOT
I expect this to be /var/www/html/ - that should already exist from your apache installation - if not, we need to work out where that is. If there are things already in your /var/www/html/, you can either
retain them if you think they are useful, or delete them. Doesn't matter.

Whatever is under the webroot gets served as a webpage when you navigate
the browser to http://localhost

e.g. Apache will respond to the browser request for
   http://localhost/blah/blah/index.php
   by serving the webpage at
       /var/www/html/blah/blah/index.php
       and so on.

       3. CLONE MY GITHUB REPOSITORY
       cd /var/www/html
       git clone https://github.com/cangjie-info/ecdb.git

       You need to have your internet connection open for that, obviously. That will download a few directories and html/php files. They should now all be inside /var/www/html/ecdb/
       You should be able to find
       ..../ecdb/html/ (for our pw-protected online pages)
       ..../ecdb/html_public/ (no pw)
       ..../ecdb/includes/ (code that other pages reuse often)

       There is also a hidden directory
       /var/www/html/ecdb/.git/
       This is where git keeps track of everything. We don't need to touch it. If at any stage something goes horribly wrong and you want to start over, just delete the entire ecdb directory, and you will have cleared everything.

       4. CREATE MYSQL ACCOUNT FOR PHP, AND CREDENTIALS FILE
       I've attached a file called mysql.php. This contains the logon credentials for php to access mysql. Copy it to
       /var/www/html/mysql.php
       If we were serving pages over the internet we wouldn't put it here under the web-root because it is not secure. But this is a local version and it's easier to keep track of here. Take a look at the file with a text editor. You can see four php variables - the ones you are interested in are:
       $db_user
       $db_pw
       You need to create a mysql user using phpmyadmin. it will have a user
       name and a pword. Edit mysql.php to put the user name in the $db_user variable (mine is called 'php'). Put the pword in $db_pw (mine is 'BWV582'). When you create the user you need to grant it privileges on the database ecdb. In principle, we are supposed to grant as few privileges as possible (to protect the db from our own errors and the malice of others), but the stakes aren't very high in this case. Currently, none of the web pages modify the db, so SELECT is the only privilege necessary. But that will change, so why not grant all "Data" and "Structure" privileges on ecdb for now.

       5. APACHE ALIAS
       This caused me a few hours of grief, but I finally got it figured out.
       We want apache to be able to serve image files in the regular way. For
       example:
       http://localhost/ecdb/repository/sign_list_imgs/sc/sc_0024.jpg
       should give us an image of Shen & Cao (2008:24). But, I wanted all my
       img files outside the webroot (they are in ~/ecdb/repository/ ). Apache
       is designed only to serve files under the webroot normally (for security
       - so that you don't end up accidentally serving all the secrets on your
       hard drive to the world). So you need to set up an "alias" to make
       http://localhost/ecdb/repository/
       point to a different directory, viz. ~/ecdb/repository/
       instead of /var/www/html/ecdb/repository/

       So...

       1/ stop apache
       sudo service apache2 stop

       2/ find the file /etc/apache2/mods-enabled/alias.conf
       Use a text editor to add the following lines at the end, just *before*
       the line </IfModule>

             Alias /ecdb/repository/ "/home/ads/ecdb/repository/"
                   <Directory "/home/ads/ecdb/repository/">
                             Options FollowSymlinks
                                       AllowOverride None
                                                 Require all granted
                                                       </Directory>

                                   That should be 6 lines if the email hasn't broken them. You will also
                                   need to change "ads" (2 instances) to whatever your linux user name is.
                                   Save.

                                   3/ restart apache
                                   sudo service apache2 restart
                                  (Ignore the "Could not reliably determine...")

                                   Also, you should be able to see how to modify that alias so that you can place your ecdb/repository directory wherever you want, but I'll leave that to you.

                                   6. REPOSITORY
                                   This is where our images of scanned publications go. Since these
                                   collections are vast, just create the empty directory structure and we
                                   can work out how to transfer the files later.
                                   /home/ads/ecdb/repository/sign_list_imgs/sc/ (that's for shen & cao)
                                   /home/ads/ecdb/repository/text_imgs/czcn/ (that's for czcn)

                                   Again, you need to replace "ads" by your linux username.
                                   /home/<user>/ is the same as ~/

                                   Download the Shen & Cao imgs:
                                   https://www.dropbox.com/sh/cw6ir1vukl47pzo/AAB1aHBm64DAl-wDJU7fWvD-a

                                   You can delete the pdfs. Make sure that all the .jpgs are directly under
                                   /home/<user>/ecdb/repository/sign_list_imgs/sc/

                                   If you've done everything so far, you should be able to access Shen &
                                   Cao page images via this local webpage:
                                   http://localhost/ecdb/html/shen2008/
                                   A good test to see whether everything is working. Is it? If it's not, we need to trouble shoot before trying anything else.

                                   7. CLIENT CODE / EXECUTABLES
                                   Let's deal with this later. We can use git for that too.
-->
<h2>Some git commands</h2>
<code>git clone &lt;url&gt;</code>
<p>
<p>Builds a local git repository (in the current directory) that is a clone of the remote one identified by the url. All the commands below work as long as you are in or under a directory with .git in it. (Error otherwise.) To clone the ecdb github repositories, use the following url <code>https://github.com/cangjie-info/ecdb</code>. 
<p>Git remembers where it cloned from, by creating a "remote" called "origin".
Try... <p><code>git remote</code></p> <p>This lists all your remote repositories. For you, that should return the one word "origin". I have an extra remote called "web" which points at another clone on the hostgator server.</p>
<p><code>git remote --verbose (or -v)</code></p>
<p><code>git status</code><p>
<p>This tells you whether anything has been changed by you in your local repository. Nothing to report yet.</p>
<p><code>git pull origin</code></p>
<p>This grabs the most up to date version from the remote "origin" and updates your files (with some complications we can worry about later) and the edit history. Good idea to do this first whenever working with the files, but no unundoable harm comes from editing old versions. Try it now... you should get "Already up to date", unless I pushed some edits since you cloned.</p>
<p>Edit one of the existing ecdb html/php files. "git status" will report the change. The file is being tracked.</p>
<p><code>git diff</code></p>
<p>This reports the exact changes, all tracked files, line by line. If you want to discard the changes you use:</p>
<p><code>git checkout -- &lt;filename&gt; (or multiple &lt;filename&gt;s)</code></p>

                                                       The changes are not just reverted; they are irretrievably lost. Try git diff and git status to confirm the reversion.

                                                       If you add a new file anywhere under ..../ecdb/, "git status" will report the addition. But any changes to the new file will not be tracked unless/until you use:

                                                       git add <filename> (or multiple <filename>s)

                                                       If you decide that the current state of changes to a particular file(s) are likely to be worth keeping (i.e. you've spell-checked, you've tested the web-page, etc.), again use:

                                                       git add <filename> (or multiple <filename>s)

                                                       This takes a snapshot of the state of the file. git diff will go back to showing nothing, until you make additional changes. If you decide that all the current snapshots are worth preserving as a stage in the development of the project, use:

                                                       git commit -m 'I made some changes'

                                                       This will record all the changes since the "add"s - any changes that you made after "add"-ing will be retained but won't be in that particular commit. You can "add" again when you are ready.

                                                       git log

                                                       Gives a listing of all the previous commits in the history of the project. SPACE to page down, q to quit. These are all the stages that we can roll back to or examine.

                                                       9. GET A GITHUB ACCOUNT
                                                       Final step. This is so you can push your edits back into "origin" so I can share them too.

                                                       https://github.com/
                                                       needs username, pw and email.

                                                       Let me know the username by email and I will add you as a collaborator, giving you write access to the remote repository. Then...

                                                       cd /var/www/html/ecdb/
                                                       git push origin

                                                       It will ask you for your username and pw. If you haven't changed anything it will say something like "Already up to date". If you have, your edits will be merged into "origin". Everything you push is publicly accessible, so we won't push any copyrighted material (unless carefully obfuscated) or passwords or personal info.

</body>
</html>
