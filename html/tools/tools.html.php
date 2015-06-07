<?php require $includes . 'top.html.php'; ?>
<p>This page outlines all of the tools, software and other components that are currently being used in developing the ECDB project. The aim to provide a sufficiently complete description so that any of the work could be easlily replicated.</p>
<h2>Operating systems</h2>
<h3><a href="http://www.ubuntu.com/download/desktop">Ubuntu</a> Linux 12.04 64bit</h3>
<ul>
<li>Ubuntu Linux 12.04 64 bit</li>
<li>Windows 7 Pro</li>
</ul>
<p>The original motivation for using Linux was the greater availability and ease of use of certain open source tools, compared with MS Windows. A second motivation was to ensure that as ECDB developed, it would remain replicatable independently of the usual hardware or operating system choices.</p> 
<h3>Microsoft Windows 7</h3>
<p>Although ECDB development began on Linux, it was important that everything be portable onto more popular desktop operating systems. If everything is portable between Linux and MS Windows, I am assuming that portability to the Mac OSs will not be too difficult either.</p>

<h2>Web hosting</h2>
<p>The live version of these web-pages, together with the live version of the ECDB MySQL database, are hosted on a bottom-of-the-range <a href="http://www.hostgator.com/shared">Hostgator</a> shared server account ("Hatchling"). This costs about $80 / year. </p>

<h2>HTML, PHP, CSS</h2>
<p>The online web-pages for the project, including the web-interfaces to the database, are handcoded using HTML, CSS, and PHP. For the most part, nothing more complex that what could be found in an introductory textbook has been used. Anything more complex than that will be documented in these pages.</p>

<h2>MySQL</h2>
<ul>
<li>MySQL &gt; ver 5.5</li>
<li>phpMyAdmin &gt; ver 4.3.8</li>
</ul>
<p><a href="https://dev.mysql.com/downloads/mysql/">MySQL</a> was chosen as the database server for ECDB because it is popular, powerful, well-documented, integrates easily with PHP, and is offered as standard by web-hosting packages. It is easily installed on Ubuntu using the standard repository, and is easy to install on Windows using <a href="http://www.wampserver.com/en/">WAMP</a>. The structure of the ECDB database is modified using <a href="http://www.phpmyadmin.net/home_page/index.php">phpMyAdmin</a> and working on a local copy of the database, which is then uploaded to the remote server. This, and other related backup procedures are described elsewhere.</p>

<h2>Web server</h2>
<ul>
<li>Wamp server 2.5</li>
<ul><li>Apache 2.4.9</li>
    <li>PHP 5.5.12</li>
    <li>MySQL 5.6.17</li>
    </ul>
<li>Lamp server</li>
<ul><li>Apache 2.4.7</li>
    <li>PHP 5.5.9</li>
    <li>MySQL 5.5.43</li>
</ul>
</ul>
<p>For local development versions of the web documentation and PHP interfaces to the database, a standard Wamp (Windows) or Lamp (Ubuntu) stack is used with minimal modification.<p>

<h2>Qt, C++</h2>
<ul>
<li>Qt 4</li>
<li>Qt 5</li>
<li>g++ 4.8.2</li>
<li>MinGW 4.9.1 32 bit</li>
</ul>
<p><a href="http://www.qt.io/download-open-source/">Qt</a>/C++ is used for the development of GUI desktop applications for complex ECDB tasks like image manipulation and transcription editing. The current version of <a href="">Viewer</a> has been developed in Qt4, and compiles successfully on Ubuntu. The longer term goal is to have all apps developed in Qt5, and compiling on both Windows and Ubuntu. Qt is easily installed from the Ubuntu repository or (for Windows) using the msi installer. 
Visual C++ is one (cost-free) option for a compiler on Windows, but I think MinGW is sufficient for all purposes.</p>
<p>One complication on Windows. Qt needs a plugin to access MySQL servers. This seems to be absent on the standard Windows installation, and so needs to be compiled. The compilation requires the MySQL library file <code>libmysql.dll</code> and possibly other MySQL development files that were not included in the (my) Wamp installation. The solution followed the instructions given by <a href="http://seppemagiels.com/blog/create-mysql-driver-qt5-windows">Seppe Magiels</a>.</p>
<ul>
<li>Download <code>mysql-5.6.24-win32.zip</code> from <a href="dev.mysql.com"><code>dev.mysql.com</code></a>.</li>
<li>Unzip to location of choice. Note that MySQL is not being newly installed (it was previously installed with the Wamp package), but this gives us the files we need to compile the Qt plugin.</li>
<li>Confirm that <code>libmysql.lib</code> is present.</li>
<li>Follow Seppe's instructions, modifying paths and file names as necessary.</li>
<li>Delete the unzipped mysql files as they are no longer necessary. (Don't delete the MySQL files that cam with the Wamp package.)</li>
</ul>

<h2>Python</h2>
<ul><li>Python 3.4</li></ul>
<p>For quicker solutions, particularly data wrangling, Python is used.</p>

<h2>Git</h2>
<p>The version control software <a href="http://git-scm.com/">Git</a> is used to keep track of changes to all code (both that of the html/php pages, and the Qt desktop clients), and to keep the versions on the various development machines and the server in sync with one another. Code for the ECDB project is kept on a <a hreaf="https://github.com/cangjie-info">GitHub</a> repository.</p>

<h2>ssh</h2>
<h2>FontForge</h2>
<h2>Glyphtracer</h2>
<h2>GIMP</h2>
<h2>Vim</h2>
<h2>Grsync</h2>
<h2>pdftoppm</h2>
<h2>pdftk</h2>

<h2>Linux command-line tools</h2>
<ul><li>Add <code>.jpg</code> file name extension to all files in current directory: <code>find . -type f -exec mv {} {}.jpg ';'</code></li></ul> 
</body>
</html>
