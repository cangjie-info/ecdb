<?php require $includes . 'top.html.php'; ?>
<p>This page describes the various components that fit together to
make the ECDB system, how they relate to each other, and how they
need to be set up on local and remote platforms for development and
deployment.</p>
<p>Procedures are given for setting up on local 
<a href='#linux'>Linux</a> and 
<a href='#windows'>Windows</a> for development, and 
<a href='#remote'>remotely</a> for web deployment.</p>
<h2 id='linux'>Linux (Ubuntu)</h2>
<p>1. Install Ubuntu Linux by booting the installer from DVD.</p>
<p>2. Install the synaptic package manager: 
<code>sudo apt-get install synaptic</code>. This makes installing
the subsequent packages simple.</p>
<p>3. Install tools. A full list is given on the 
<a href='../tools/'>tools</a> page, but the following are
essential.</p>
<ul>
  <li>Chinese input method - this often requires some annoying
  tweaking to get right.</li>
  <li>git - to maintain a local version of the code
  repository.</li>
  <li>ssh - for easy remote access to the web version of ECDB. See the <a href='../docs'>Admin documentation</a> page for instructions on setting up ssh.</li>
  <li>grsync - optional, but this is helpful for syncing
  backups.</li>
</ul>
<p>4. Qt/C++ development tools</p>
<ul>
  <li>g++ - C++ compiler</li>
  <li>Qt 4 and Qt 5 - selecting the following packages in synaptic
  is probably sufficient. Everything else should come along for the
  ride as dependencies: 
  <ul>
    <li>qt4-default</li>
    <li>qt5-default</li>
    <li>qtcreator</li>
  </ul></ul>
  <p>5. LAMP server stack</p>
  <ul>
    <li>apache2 - webserver, for serving local versions of
    webpages.</li>
    <li>php5 - for server-side web-page code.</li>
    <li>mysql-client &amp; mysql-server - ECDB database backend.
    During installation you will be asked to select a root
    password.</li>
    <li>phpmyadmin - GUI tool for MySQL database admin. During
    installation you will be prompted to select apache2 as the
    web-server to configure, aksed for the MySQL root password, and
    invited to set a password for phpmyadmin.</li>
  </ul>
  <p>To test that these have installed correctly, open a browser
  and enter 
  <code>localhost</code>in the address box. This should give the
  apache default page. Enter 
  <code>localhost/phpmyadmin</code>and you should reach a
  functional phpmyadmin interface.</p>
  <p>6. Clone local version of ECDB web pages.</p>
  <p>Identify your web root directory. This is the location of the
  web pages that are served on navigating to localhost. With my
  standard apache2 installation this was 
  <code>/var/www/html/</code>, where the 
  <code>index.html</code>file for the default apache2 page should
  be located.
  <p>
    <p>With the webroot as the current directory, run 
    <code>git clone
    https://github.com/cangjie-info/ecdb.git</code>in the terminal.
    This will clone the ECDB webpages from the remote repoitory.
    Local and remote changes can be kept in sync using git.</p>
    <p>One important file is missing: the credentials file that
    tells PHP what username and password it needs to log onto the
    MySQL database. For a live website, we would keep this out of
    the root directory, but this local version expects to find it
    here: 
    <code>/var/www/html/mysql.php</code>. Create a text file with
    that name, with the contents: </p>
    <pre>
&lt;?php

// connection credentials for php connection to MySQL
$db_host = 'localhost';
$db_user = 'php';
$db_pw = '&lt;password&gt;';
$db_prefix = ''; // needed for remote shared server

?&gt;
</pre>
    <p>We will set the MySQL password below.</p>
    <p>7. Clone application desktop application code.</p>
    <p>Currently, the only significant application is <a href='../../html_public/docs_viewer'>Viewer</a>.The code for this can go anywhere convenient. Mine goes in <code>~/prog/</code>. The procedure is the same for cloning the web pages: <code>git clone https://github.com/cangjie-info/viewer.git</code>.</p>
<p>If Qt/C++ was set up correctly, you should be able to compile and run the code for Viewer, although it will behave unimpressively because the backend database has not been set up.</p>
    <p>8. Import MySQL databses</p>
    <p>There are two databases that need to be imported into MySQL. One goes by the name of 'ecdb', provides the back end to the PHP web-based interface, and contains data from CJCN (Matt) and other collections (CHANT). Another is called 'ec', and provides the Viewer application with data on the HD corpus. The structre of the two databases is actually fairly similar, and merging them is a medium-term priority.</p> 
<p>For instructions on backing up and restoring databases, see the <a href='../docs/'>Admin documentation</a> page.</p>
<p>9. Add a new user using phpMyAdmin with read privileges on the new databases. Update <code>/var/www/html/mysql.php</code> with the new user's name and password. The local version of the webpages should now display with the browser, adequately apart from the missing fonts. The user name and pw for ec needs to match that given in the <code>db_handler.cpp</code> source code file for Viewer.</p>
<p>10. Add the <a href='../../html_public/fonts'>fonts</a> needed to work in ECDB.</p> 
<p>11. Add repository files.</p>
<p>The local versions of the web pages expect to find the repository at <code>~/ecdb/repository</code>. There should be two subdirectories: <code>text_imgs</code> and <code>sign_list_imgs</code> containing files for {at this stage} the HD and CZCN corpora, and the sign-lists <i>Gulin</i> and Shen &amp; Cao (2008). Because these are outside the web root, we need to set things up so that PHP can access them.
 For that, we need to set up an 'alias' in apache, so that <code>http://localhost/ecdb/repository/</code> points to <code>~/ecdb/repository/</code>, instead of the expected directory under the web root.</p>
<p>a/ stop apache<br />
<code>sudo service apache2 stop</code></p>
<p>b/ Find the file <code>/etc/apache2/mods-enabled/alias.conf</code>, and 
use a text editor to add the following lines at the end, just *before*
the line <code>&lt;/IfModule&gt;</code>
<pre><code>
   Alias /ecdb/repository/ "/home/ads/ecdb/repository/"
   &lt;Directory "/home/ads/ecdb/repository/"&gt;
       Options FollowSymlinks
       AllowOverride None
       Require all granted
   &lt;/Directory&gt;
</code></pre>
You will need to change <code>/home/ads/</code> to the name of your own home directory, obviously, and to make sure that all the directories in the tree <code>/home/ads/ecdb/repository/</code> have read permissions for apache.<p>
<p>c/ restart apache<br />
<code>sudo service apache2 restart</code><br />
(Ignore the "Could not reliably determine...") 
</p>
      <h2 id='windows'>Windows</h2>
      <h2 id='remote'>Remote hosting</h2>
<?php require $includes . 'bottom.html.php'; ?>
