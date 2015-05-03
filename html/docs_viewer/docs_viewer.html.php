<?php require $includes . 'top.html.php'; ?>
<p>The Viewer application is a first attempt at building a tool for editing ECDB inscriptions, and for linking the transcriptions to images, graph by graph.
It began - as the name implies - as an app for simply displaying previously entered HuaDong transcriptions side by side with images from the original publication. But editing functions and database read/write were added over time. All this was done in a very ad hoc and experimental manner.
The Viewer application is currently being used to complete a review of the ECDB HuaDong transcriptions and a complete graph-by-graph mapping to <i>taben</i> 拓本 images. The application will no longer be developed, but the plan is to replace it with a newer, more carefully designed tool for the same purpose.</p>
<p>Viewer was written using Qt4/C++. The code is on <a href="https://github.com/cangjie-info/viewer">GutHub</a>. It compiles and runs on Linux (Ubuntu 14.04) as described here. I haven't attempted to compile it for MS Windows or any other OS.</p>
<h2>Startup</h2>
<p>On startup, Viewer attempts to find a configuration file located at <code>~/.cangjie</code>. If it doesn't already exist, Viewer creates it. This configuration file keeps a record of the last inscribed surface that was in use in the previous session. When the main window of the application is closed, the configuration file is updated with the id of the current inscribed surface.</p>
<p>Viewer then attempts to open a connection to a MySQL database on the local machine. If successful, it retrieves a set of surface ids. Currently the query is hard-coded to retrieve the surfaces in the HuaDong publication. Viewer navigates to the surface with the id that was found in the config file. It then retrieves all of the transcription and image data associated with that surfaces and populates widgets in the main window. In addition to the main window, a "graph viewer" is also opened as a second window.</p>
<h2>Surface image</h2>
<img src='opening_screen.png' />
<p>The image above shows the transcriptions for HD237 together with the image from the original publication. Apart from the link to the raw image, no additional image information has been added to this surface record yet. The inscriptions also require some editing.
The raw page image in this case has only a single inscribed surface on it (viz. HD237), though some pages will have multiple surfaces. The first task is to crop the surface image 

</body>
</html>
