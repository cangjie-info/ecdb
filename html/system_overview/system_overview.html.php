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
<p>You may want to reset permissions on the <code>/var/www/html/</code> directory so that it can be edited withou superuser privileges.</p>
<p>7. Clone application desktop application code.</p>
<p>This can go anywhere convenient. Mine goes in <code>~/prog/</code>. The procedure is the same for cloning the web pages: <code>
<h2 id='windows'>Windows</h2>
<h2 id='remote'>Remote hosting</h2>
<h2>System components</h2>
<h3>Repository</h3>
<p>The repository is a fixed directory location where large quantities of essentially static data are stored, and from where they can be accessed by the other componenets of ECDB. The most important data stored here are text images in the form of jpeg page scans of publications. Since much of this material is, unfortunately, under copyright, it cannot be made freely available over the web.
Scans of important published sign-lists are also kept here. A set of fonts used by ECDB applications, and dated back-ups of the MySQL database are also kept here.</p>
<p>Currently, the repository can be relied upon to contain the following data:</P>
<ul>
  <li><code>repository/text_imgs/</code>
    <ul><li><code>repository/text_imgs/czcn/</code> - page images from the Cunzhong Cunnan publication.</li>
    <li><code>repository/text_imgs/hd/</code> - page images from the HuaDong publication.</li>
    </ul>

  <li><code>repository/fonts</code>
    <ul><li><code>HuaDongFont0.9.ttf</code> - a font for representing that glyph repertoire of the HuaDong corpus.</li></ul>
  </li>
  <li><code>
mysql_dumps  sign_list_imgs  text_imgs

<h3>Code for web-pages</h3>
<h3>Code for Desktop application development</h3>
<h3>MySQL database</h3>
<h3>Zotero database</h3>
<h2>System setup by platform</h2>
<h3>Ubuntu</h3>
<h3>Windows</h3>
<h3>Remote server</h3>
<?php require $includes . 'bottom.html.php'; ?>
