<?php require $includes . 'top.html.php'; ?>

<h2>Save text image files in repository</h2>
<p>Images of published text surfaces should be in jpeg format. The file-name is stored in the img_file field of the inscr_surfs table, and so is relatively free to vary in format. However, clearly it makes sense to have image files that are transparently named, with the surface number and the publication name visible in the filename. The directory in which the files are placed, on the other hand, MUST have the same name as the name field in the pubs table, since this is used automatically to generate the correct path to the file. Pub names will be converted to lowercase when generating the path. The file path will be referred to in PHP as <code>$repo_path/text_imgs/<PUBNAME>/<IMGFILE></code>.

<h2>Configure ssh / git for push to remote shared server (Hostgator)</h2>
<p>Procedure given here is based on <a href='http://www.arlocarreon.com/blog/git/push-git-repo-into-shared-hosting-account-like-hostgator/'>Arlo Carreon</a>'s instuctions.</p>
<p>1. Set up ssh access to remote server.</p>
<p>Request ssh access via Hostgator cPanel. You should then be able to get remote access with... </p>
<p><code>ssh user@cangjie.info -p 2222</code></p>
<p>... substituting your user name. Hostgator uses port 2222 for ssh. This will lead to a password prompt. <code>logout</code> to exit.</p>
<p>We want to bypass the password logon using a public key. To generate a key...</p>
<p><code>ssh-keygen</code></p>
<p>The public key will be the contents of the text file <code>~/.ssh/id_rsa.pub</code>. Copy the contents into the file <code>~/.ssh/authorized_keys</code> on the Hostgator server.</p>
<p>2. Configure git on the remote serrver to accept pushes via ssh.</p>
<p>ssh into Hostgator. Then run the command <code>git config receive.denyCurrentBranch ignore</code>. Then save the following lines in the text file <code>GIT_REPO_PATH/.git/hooks/post-receive</code>.</p>
<pre><code>
#!/bin/sh
# Save this in: PATH_TO_REPO/.git/hooks/post-receive
GIT_WORK_TREE=../ git checkout -f
</code></pre>
<p>Make that file executable with <code>chmod +x PATH_TO_REPO/.git/hooks/post-receive</code>.</p>
<p>3. Configure ssh locally to automate connection to Hostgator.</p>
<p>In order to bypass the password logon, and use the public key set up in step 1., using port 2222, put the following lines into the text file <code>~/.ssh//config</code></p>
<pre><code>
Host cangjie.info
   Port 2222
   PreferredAuthentications publickey
</code></pre>
<p>It is now possible to get ssh access to Hostgator with <code>ssh user@cangjie.info</code>.</p>
<p>4. Add the Hostgator server as a git remote repository.</p>
<p><code>cd</code> to the local git repository, and type </p>
<p><code>git remote add web user@cangjie.info:public_html/ecdb</code></p>
<p>Now, local changes to the ECDB web pages can be pushed to the live web-site using the simple command: <code>git push web</code>.</p>


<h2>Backup local db with mysqldump</h2>
<p>From the local shell:</p> 
<p><code>mysqldump -u root -p ecdb &gt; ecdb_yyyy-mm-dd.sql</code>.</p>
<p>On entering the pw, this will save an sql text file of the entire database to the current directory.</p>

<h2>Backup remote db with mysqldump</h2>
<code>ssh www.cangjie.info -l &lt;USER&gt;</code>
<p>Navigate to backup directory.</p>
<pre><code>mysqldump -u &lt;USER&gt; -p &lt;DBNAME&gt; &gt; ecdb.sql.yyyy.mm.dd
zip ecdb.sql.yyyy.mm.dd.zip ecdb.sql.yyyy.mm.dd</code></pre>

<h2>Restore local db from sql text file</h2>
<ol>
<li>Delete ("drop") any existing db called "ecdb" (using phpmyadmin, or mysql client).</li>
<li>Create an empty db called "ecdb" (using phpmyadmin, or mysql client).</li>
<li>Open shell prompt, and cd to wherever the .sql file is.</li>
<li><code>mysql -u root -p ecdb &lt; ecdb.sql</code>.</li>
<li><ol>
   <li>Enter mysql root pw when asked</li>
   <li>Because of the size of the db, it can take about 30-40s to populate the db.
       The prompt just hangs while that is going on.</li>
   <li>Refresh phpmyadmin page and see if it has worked.</li></ol>
</ol>
 
<h2>Restore remote (Hostgator) db from sql text file</h2>
<pre><code>scp &lt;PATH&gt;/ecdb.sql.yyyy-mm-dd &lt;USER&gt;@www.cangjie.info:~/tmp/ecdb.sql
ssh www.cangjie.info -l &lt;USER&gt;
mysql -h localhost -u &lt;DBUSER&gt; -p
drop database &lt;DBNAME&gt;;
create database &lt;DBNAME&gt;;</pre></code>
<p>Exit mysql client.</p>
<code>mysql -h localhost -u &lt;USERNAME&gt; -p &lt;DBNAME&gt; &lt; ~/tmp/ecdb.sql
</code>

<h2>Get Zotero item key from Firefox</h2>
<p>To read an item via the Zotero API, you need to have the item key. Oddly, the Zotero Firefox app does not provide simple access to the item keys. The following export translator will copy the item keys as a comma-separated list to the clipboard on Ctrl+Shift+c in the usual manner. The translator needs to be saved as a javascript file (<code>.js</code> file extension) in the Zotero <code>translators</code> directory.</p>
<pre><code>{
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
}</code></pre>

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
        <li>Tag example: to return a bibliography of all items with a particular tag use tag=<tagname> in the query string. E.g. <code>https://api.zotero.org/users/160881/items/?v=3&format=bib&style=elsevier-harvard2&tag=OBI</code>. Result is <a href="https://api.zotero.org/users/160881/items/?v=3&format=bib&style=elsevier-harvard2&tag=OBI">here</a>. 
        For more complicated tag queries, see the <a href="https://www.zotero.org/support/dev/web_api/v2/read_requests">Documentation</a>.</li>
        <li>COinS: By changing the <code>format=bib</code> to <code>format=coins</code>, a set of <code>&lt;span&gt;</code>s containing COinS data is returned instead. <code>https://api.zotero.org/users/160881/items/?v=3&format=coins&tag=OBI</code>.</li> 
    </ul>
    <li>Adding the bibliograpic data to a php/html webpage is simple:<code>
&lt;?php 
$url = 'https://api.zotero.org/users/160881/items/?v=3&format=coins&tag=OBI';
$var = file_get_contents($url);
echo $var;
?&gt;</code>
    </li>
</ol>

<h2>Install git</h2>
<p><code>sudo apt-get install git</code> (or use synaptic)</p>

<h2>Clone Github repository</h2>
<pre><code>
       cd /var/www/html
       git clone https://github.com/cangjie-info/ecdb.git
</code></pre>
      <p>You need to have your internet connection open for that, obviously. That will download a few directories and html/php files. They should now all be inside <code>/var/www/html/ecdb/</code>

      <p>You should be able to find</p>
       <p><code>..../ecdb/html/</code> (for pw-protected online pages)</p>
       <p><code>..../ecdb/html_public/</code> (no pw)</p>
       <p><code>..../ecdb/includes/</code> (code that other pages reuse often)</p>

       <p>There is also a hidden directory
       <code>/var/www/html/ecdb/.git/</code>
       This is where git keeps track of everything. We don't need to touch it. If at any stage something goes horribly wrong and you want to start over, just delete the entire ecdb directory, and you will have cleared everything.</p>

<h2>Create MySQL account for PHP, and credentials file</h2>
      <p>The credentials file <code>mysql.php</code> contains the logon credentials for php to access mysql. For the local (development) version of the web-pages, it should be located at <code>/var/www/html/mysql.php</code></p>
<h2>Apache alias</h2>
<p>We want apache to be able to serve image files in the regular way. For
       example:
       <code>http://localhost/ecdb/repository/sign_list_imgs/sc/sc_0024.jpg</code>
       should give us an image of Shen & Cao (2008:24). But, I wanted all my
       img files outside the webroot (they are in <code>~/ecdb/repository/</code> ). Apache
       is designed only to serve files under the webroot normally (for security). So you need to set up an "alias" to make
       <code>http://localhost/ecdb/repository/</code>
       point to a different directory, viz. <code>~/ecdb/repository/</code>
       instead of <code>/var/www/html/ecdb/repository/</code></p>

       <p>So...</p>

       <p>1/ stop apache</p>
       <p><code>sudo service apache2 stop</code></p>

       <p>2/ find the file <code>/etc/apache2/mods-enabled/alias.conf</code> 
       Use a text editor to add the following lines at the end, just *before*
       the line <code>&lt;/IfModule&gt;</code></p>
       <p><pre><code>
Alias /ecdb/repository/ "/home/ads/ecdb/repository/"
&lt;Directory "/home/ads/ecdb/repository/"&gt;
   Options FollowSymlinks
   AllowOverride None
   Require all granted
&lt;/Directory&gt;
</code></pre></p>
<p>Save.</p>

<p>3/ restart apache</p>
<p><code>sudo service apache2 restart</code></p>
<p>(Ignore the "Could not reliably determine...")</p>

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

<p>The changes are not just reverted; they are irretrievably lost. Try git diff and git status to confirm the reversion. If you add a new file anywhere under <code>..../ecdb/</code>, "git status" will report the addition. But any changes to the new file will not be tracked unless/until you use:</p>

<p><code>git add &lt;filename&gt; (or multiple &lt;filename&gt;s)</code></p>
<p>If you decide that the current state of changes to a particular file(s) are likely to be worth keeping (i.e. you've spell-checked, you've tested the web-page, etc.), again use:</p>
<p><code>git add &lt;filename&gt; (or multiple &lt;filename&gt;s)</code></p>
<p>This takes a snapshot of the state of the file. git diff will go back to showing nothing, until you make additional changes. If you decide that all the current snapshots are worth preserving as a stage in the development of the project, use:</p>

<p><code>git commit -m 'I made some changes'</code></p>

<p>This will record all the changes since the "add"s - any changes that you made after "add"-ing will be retained but won't be in that particular commit. You can "add" again when you are ready.</p>
<p><code>git log</code></p>
<p>Gives a listing of all the previous commits in the history of the project. SPACE to page down, q to quit. These are all the stages that we can roll back to or examine.</p>
<?php require $includes . 'bottom.html.php'; ?>
