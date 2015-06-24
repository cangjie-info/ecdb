<?php require $includes . 'public_top.html.php'; ?>
<p>The Viewer application is a first attempt at building a tool for editing ECDB inscriptions, and for linking the transcriptions to images, graph by graph.
It began - as the name implies - as an app for simply displaying previously entered HuaDong transcriptions side by side with images from the original publication. But editing functions and database read/write were added over time. All this was done in a very ad hoc and experimental manner.
The Viewer application is currently being used to complete a review of the ECDB HuaDong transcriptions and a complete graph-by-graph mapping to <i>taben</i> 拓本 images. The application will no longer be developed, but the plan is to replace it with a newer, more carefully designed tool for the same purpose.</p>
<p>Viewer was written using Qt4/C++. The code is on <a href="https://github.com/cangjie-info/viewer">GitHub</a>. It compiles and runs on Linux (Ubuntu 14.04) as described here. I haven't attempted to compile it for MS Windows or any other OS.</p>
<p>(NOTE. The screen shots on this page are reduced in size. To view at full size, right click and select <code>View image</code>.)<p>
<h2>Startup</h2>
<p>On startup, Viewer attempts to find a configuration file located at <code>~/.cangjie</code>. If it doesn't already exist, Viewer creates it. This configuration file keeps a record of the last inscribed surface that was in use in the previous session. When the main window of the application is closed, the configuration file is updated with the id of the current inscribed surface.</p>
<p>Viewer then attempts to open a connection to a MySQL database on the local machine. If successful, it retrieves a set of surface ids. Currently the query is hard-coded to retrieve the surfaces in the HuaDong publication. Viewer navigates to the surface with the id that was found in the config file. It then retrieves all of the transcriptions and image data associated with that surfaces and populates widgets in the main window. In addition to the main window, a "graph viewer" is also opened as a second window.</p>
<h2>Surface mode</h2>
<img src='opening_screen.png' />
<p>The image above shows a typical opening screen. The configuration file has told Viewer that the last visited inscribed surface was HD237, and so it has automatically navigated to that surface, displaying the raw page image in the RH side, and the previously entered transcriptions in the left. Notice the status bar at the bottom, and the menu at the top.</P>
<h3>Status bar</h3>
<p>The status bar gives information about the current state of the inscribed surface being edited.</p>
<img src='status_bar.png' />
<p>In this example the status bar tells us that we are editing <code>surface: 108237</code>. <code>108</code> is the id number of the publication from which the surface comes, in this case HD. <code>237</code> is the name of the surface. <code>surface type: PV</code> tells us that this is the ventral surface of a plastron.
<code>zoom = x0.237305</code> tells us that the raw image has been zoomed to about 24%, to fit it into the window. Viewer does the automatically for each new image. The zoom can be changed manually. See below.
<code>rotation = 0</code> tells us that the image is not currently rotated.
<code>mode = SURFACE</code> tells us that Viewer is currently in SURFACE mode (the other modes are <code>INSCRIPTION</code> and <code>GRAPH</code>.) <code>LOCKED</code> tells us that the surface is currently locked, to prevent accidental editing. <code>UNMODIFIED</code> indicates that the data for this surface has not yet been chenged.</p>
<h3>Surface bounding box</h3>
<p>The first task is to set the bounding box for the surface image. The aim here is to drag a bounding box reasonably tightly around the region of the image that contains the surface (here HD237). There are two reasons for this: 1/ to crop away an distracting or unnecessary whitespace that would otherwise clutter the image, and 2/ because many publications have more than one image per page, and we just want the image of the surface we are interested in (not a problem in this case).</p>
<p>First, unlock the record with the <code>U</code> key. The status bar should update. To set the bounding box, click and drag in the usual way, until the green rubber-band captures the desired area. On releasing the mouse, the bounding box will be set. If the first attempt is not correct, either drag the rubber band a second time (<code>SURFACE</code> mode only) or hit <code>BACKSPACE</code> and drag again.</p> In unusual cases, the surface may be oddly orientated in the publication image. To correct this, the image may be rotated before the bounding box is set. To rotate, use <code>&gt;</code> and <code>&lt;</code> for clockwise and anti-clockwise. Use <code>^</code> to reset the rotation. To zoom, use <code>+</code>, <code>-</code> and <code>0</code> to enlarge, reduce and set to 100%.
Once the surface bounding box has been set, we can switch to <code>INSCRIPTION</code> mode by pressing <code>SPACE</code>. To return to SURFACE mode, press <code>Esc</code>.</p>
<h2>Inscription mode</h2>
<p>On entering <code>INSCRIPTION</code> mode, we get a new view of the image cropped to the bounding box that was set in <code>SURFACE</code> mode.</p>
<img src='inscription_mode1.png' />
<h3>Inscription bounding boxes</h3>
<p>Now the task is to drag similar bounding boxes around all of the inscriptions that appear on the surface. Locating all the inscriptions on a large and complex oracle-bone like HD237 will require a zooming (see above for controls) and moving around. To move the image, use the arrow keys, the mouse wheel (up and down), or the sroll bars at the edge of the image. Also, since many inscriptions on an oracle bone will be written at odd orientations, it will also be necessary in many cases to rotate the image (as above) before dragging the bounding box, to ensure that the inscription image is captured appropriately.</p>
<p>Unlike in <code>SURFACE</code> mode, dragging a second bounding box does not delete the first. Rather, both remain on the screen, and so on as more are added. The current bounding box is green, and the others are red. To delete the current bounding box, use <code>BACKSPACE</code>.</p>
<img src='inscription_mode2.png' />
<p>The inscription bounding boxes are stored as a (numerically ordered) list. Whenever a new box is drawn, it is added immediatly after the current bounding box in the list. A display of the numerical sequence of boxes can be toggled on and off with the <code>I</code> key (short for "index"). Eventually, this list will need to be in the same order as the transcriptions that appear in the left pane. Both the order of the bounding boxes and the order of the transcriptions can be modified, but for obvious reasons it is best to get one straight first, and then to modify the other to match it.<p>
<h3>Navigating and modifying the bounding-box list</h3>
<p>As just mentioned, the current bounding box (green) will usually be the one that was most recentrly added. But, to move the current bounding box further forward or back in the list, use <code>]</code> and <code>[</code>. Notice how the green box moves throught the sequence, wrapping around when it gets to the end. This allows us to delete (<code>BACKSPACE</code>) and insert (drag a new bounding box) from anywhere in the list. We can also shift the position of any box within the list by 1/ making it the current box (green), and 2/ using <code>Ctrl+]</code> and <code>Ctrl+[</code> to increment or decrement its list position. Note that this will also affect the ordinal position of the subsequent or preceeding box. The effects of all of these operatons are most clearly seen if the index numbering is toggled on (<code>I</code>).</p>
<h3>Summary of commands/keys so far</h3>
<ul>
<li><code>SPACE</code> move from SURFACE mode to INSCRIPTIONS mode</li>
<li><code>Esc</code> move from INSCRIPTIONS mode to SURFACE mode</li>
<li><code>&lt;</code> rotate clockwise</li>
<li><code>&gt;</code> rotate counterclockwise</li>
<li><code>^</code> reset rotation</li>
<li><code>+</code> zoom in</li>
<li><code>-</code> zoom out</li>
<li><code>0</code> zoom to 100%</li>
<li><code>]</code> set next box in list as current box</li>
<li><code>[</code> set previous box in list as current box</li>
<li><code>BACKSPACE</code> delete current box</li>
<li><code>Ctrl+[</code> increment ordinal position of current box</li>
<li><code>Ctrl+]</code> decrement ordinal position of current box</li>
<li><code>I</code> toggle display of box ordinal numbers</li>
</ul>
<h2>The transcriptions pane</h2>
<p>The transcription pane on the left side displays an ordered list of transcriptions of the inscriptions that appear on the surface, together with the ordinal numbers of image bounding boxes (if any) to which they correspond. Aligning the sequences of transcriptions and image bounding boxes is the task that will be described here. Editing of the transcribed text will be dealt with below.</p>
<p>Each transcription in the pane is prefaced by a couple of terms separated by a slash "/". The first is an integer representing the ordinal position of the transcription in the list (from 1 to the total number of inscriptions in the list). The term after the slash is either the ordinal position of the corresponding bounding box, or "no image", if there is no corresponding image box. Since editors sometimes transcribe text that is not visible (at all) in a published rubbing, Viewer allows for inscriptions that have no corresponding image bounding box. The default value is "no image", as can be seen from the screen-shots above.</p>
<p>Both transcriptions and bounding boxes are always sorted in their numerical order in this pane. But the two sequences can be staggered due to the presence of transcriptions with no image box ("<code>no image</code>") in the list. The first image box will correspond to the first transcription that is not set to "no image". The second image box will correspond to the second transcription that is not set to "no image", and so on, till the two lists are exhausted. If there are not enough available transcriptions not set to "no image", Viewer will append some new blank transcriptions to the end of the list to accommodate them. 
Notice that this is what has happened in the screen shot above: as new boxes were added to the image pane, Viewer added 
fresh transcriptions to the list, starting at #17 to accommodate them, since all existing transcriptions were already set to "no image". By changing the "no image" setting of the transcriptions, the image box sequence will be moved up into the newly-available slots.</p>
<h3>Navigating the transcriptions pane</h3>
<p>Most of the navigation operations in the transcriptions pane use key combinations with <code>SHIFT</code> to make them easier to remember as a group. The current transcription (#1 in the screen shot above) is distinguished with a white background.
The choice of current transcription can be changed by moving up and down though the list with <code>SHIFT+up</code> and <code>SHIFT+down</code> (arrow keys). To toggle the "no image" setting for the current transcription, use <code>SHIFT+n</code>. Notice how the sequence of image box numbers moves up to take advantage of the newly available space. To turn off "no image" for ALL of the transcriptions at once, use <code>Ctrl+n</code>. If this last operation is performed from the state shown in the screen shot above, the first five transcriptions will be shown as corresponding with the five image boxes that were drawn, while the remainder show a blank after the slash. (Note that this is not - yet - the correct correspondence.)</p>
<img src='transcriptions1.png' />
<p>The transcriptions with blank image box numbers will accommodate freshly drawn bounding boxes as they are created. If the surface is saved (written to the database), any blank image numbers will revert to the "no image" setting when the surface is revisited in Viewer. Any rows in the transcriptions pane that have a blank image box number AND no transcription text will be ignored and not written to the database when the surface is saved. {I hope - check}.</p>
<p>When doing image boxes for surfaces that already have more-or-less complete sets of transcriptions (as with HD), the best approach is first to remove all "no image" settings, then to make sure that the transcriptions are in the desired order (see below), and only then to begin dragging bounding boxes, ideally in the order of the transcriptions to avoid having to shuffle them around subsequntly.
To move a transcription up or down in the sequence, 1/ make it the current transcription (white) using <code>SHIFT+up</code> and <code>SHIFT+down</code>, 2/ move it up or down in the list using <code>Ctrl+up</code> and <code>Ctrl+down</code>. Notice that the transcription text will move, but that the ordinal numbering of transcriptions and image boxes will remain in sequence. The "no image" setting (on or off) will also move with the transcription.
To delete the current transcription altogether use <code>SHIFT+BACKSPACE</code>. To duplicate the current transctiption (useful if entering large numbers of very similar inscriptions from scratch), use <code>SHIFT+c</code>. The duplicate will be inserted into the subsequent slot in the list.</p>
<h3>Saving or discarding work</h3>
<p>At any point during the above, or subsequently, one can choose to save (write to the database) the changes made with the usual <code>Ctrl+s</code>. Saves are not revertible, so don't save unless you are confident that your changes are an improvement. Note also that, currently, saves work quite destructively, by deleting all previous records of inscriptions etc. on the surface, together with their primary key values, and writing the edited set from scratch. This means that any relational data that used the old key values would become invalid. Currently there is no such additional data beyond what is handled by Viewer, so the problem is one for the future when there might be.</p>
<p>To discard changes and revert to the previously saved version of the surface, use <code>SHIFT+Ctrl+x</code>. This also is not undoable.</p>
<h3>Summary of new commands/keys</h3>
<ul>
<li><code>SHIFT+up</code> set previous transcription as current</li>
<li><code>SHIFT+down</code> set next transcription as current</li>
<li><code>SHIFT+n</code> toggle "no image" on current transcription</li>
<li><code>Ctrl+n</code> set all "no image" to off</li>
<li><code>SHIFT+BACKSPACE</code> delete current transcription</li>
<li><code>Ctrl+up</code> move current transcription up (decrement ordinal)</li>
<li><code>Ctrl+down</code>  move current transcription down (increment ordinal)</li>
<li><code>SHIFT+c</code> duplicate current transcription</li>
<li><code>SHIFT+s</code> save all surface data</li>
<li><code>Ctrl+SHIFT+x</code> discard all changes and revert to previous saved version</li>
</ul>
<h2>Graphs mode</h2>
<p>Assuming that all the inscription boxes and transcriptions are done and placed in the right order so that their sequences correspond, it is now time to switch to GRAPHS mode. Set the current inscription bounding box to the one that you wish to work on. Press <code>SPACE</code> to go into GRAPH mode. Press <code>Esc</code> at any time to return to INSCRIPTIONS mode.</p>
<p>On entering GRAPHS mode, the image pane changes to show just the image within the current inscription bounding box. Analogously to the previous two modes, the task is to drag bounding boxes, but around the individual graphs this time. The controls are identical to before, and again, the aim is to get the boxes in the right sequence, this time correspondig to the sequence of graphs in the text. Suppose we were doing the graphs for one of the two inscriptions on HD237 that begins 庚寅歲祖甲... The first screen shot below shows Viewer in INSCRIPTIONS mode with the inscription as the current bounding box (green).</p>
<img src='graphs_mode1.png' />
<p>The next screen shot shows the result of moving into GRAPHS mode.</p>
<img src='graphs_mode2.png' />
<p>Some of the graphs are slightly skew because of the way the scribe oriented the text. As the rotation is not large, it is not a serious issue, but a perfectionist could rotate either the inscription bounding box or the graph bounding boxes. Once all the graphs have been captured, including the four crack numbers, the result is as in the screenshot below.</p>
<img src='graphs_mode3.png' />
<p>Having finished that inscription, we can use <code>Esc</code> to return to INSCRIPTIONS mode and work on each of the other inscriptions.</p>
<h2>Transcription editing dialog</h2>
<p>Editing the text of a transcription, including its markup, requires a new pop-up dialog window. A second purpose of the transcription editing dialog is to confirm the matching of the graph bounding boxes to the graphs in the transcription. (Unless this step is gone through, the graph bounding box data will be discarded! {Check this - this could be a bug or a feature depending on how you look at it}). To bring up the dialog, press <code>e</code> (for "edit"). This can be done from any of the three modes. The transcription that will be displayed for editing is the current (white) transcription from the transcriptions pane.</p>
<img src='editing1.png' />
<p>The dialog appears as shown below. The word <code>NULL</code> here has the same meaning as the "no image" setting in the transcriptions pane {change to unify terminology?}: the graph currently under the pink editing cursor is set not to correspond to a graph bounding box from the image. We want to change that unless a graph is completely invisible in the rubbing. The transcription should initially be identical to that which appears in the current transcription in the transcriptions pane in the main window. The dialog automatically resizes to accommodate the changing length of the transcription text. Below the transcription is a white text box with the prompt <code>I to begin</code>. Editing commands can be typed into this box after pressing the <code>i</code> key.<p>
<h3>Dialog operations/keys</h3>
<ul>
<li><code>right</code> move pink cursor right</li>
<li><code>left</code> move cursor left</li>
<li><code>BACKSPACE</code> delete graph under cursor</li>
<li><code>Ctrl+right</code> move graph one space right (saves deleteing and reentering)</li>
<li><code>Ctrl+left</code> move graph one space left</li>
<li><code>n</code> toggle image "NULL"</li>
<li><code>Ctrl+n</code> remove all image "NULL"s</li>
<li><code>i</code> use text box to insert new graph or add markup</li>
<li><code>Esc</code> abandon changes and close dialog</li>
<li><code>Ctrl+Enter</code> save changes</li>
</ul>
<p>Most of these are self-explanatory. The image "NULL"s require some explanation. The relationship between graph images (captured by the bounding boxes in GRAPHS mode in the main window) and the individual graphs of the transcription is exactly analgous to the relationship between transcriptions and inscription images captured by the bounding boxes in INSCRIPTIONS mode. Each is treated as an (ordered) list. The next transcription graph corresponds to the next graph bounding box image unless the transcription graph is marked as "NULL", in which case the graph image is pushed further down the transcription. In general, every transcription graph should have a corresponding image, so it is usual to start with <code>Ctrl+n</code> to clear all the "NULL"s. If individual graphs lack an image, they can be set to "NULL" with <code>n</code>. Once "NULL" has been switched off for all the correct graphs, the corresponding graph image should appear instead of "NULL", as below. If there are insufficient graph images in the image list, the word "none" will appear instead of "NULL". This provides a very useful visual check that a/ the transcription, and b/ the graph images and their sequence are correct.</p>
<img src='editing2.png' />
<p>Inserting new graphs into the transcription, or adding markup, is slightly more complicated. Press <code>i</code> to type in the text box. To insert a graph before the pink cursor position, type the ascii-typable name of the graph, follwed by <code>Enter</code>. {This is not user-friendly for anyone not familiar with ads's idiosyncratic table of ascii-typable names. Alternative entry methods are planned for the future.} To insert a sequence of graphs, type their names separated by spaces.</p>
<p>To add markup to the graph under the pink cursor, type one of the following markup commands which begin with <code>%</code>, followed by <code>Enter</code>. In order to repeat the same markup over multiple subsequent graphs, append <code>:</code> followed by an integer. Multiple inserted graphs and markup commands can be entered at once separated by spaces.</p>
<ul>
<li><code>%u</code> graph uncertain</li>
<li><code>%cn</code> graph is an oracle-bone crack number</li>
<li><code>%ed</code> graph is an editorial restoration</li>
<li><code>%hl</code> graph is the left-most in a <i>hewen</i> sequence</li>
<li><code>%hr</code> graph is a subsequent member of a <i>hewen</i> sequence</li>
<li><code>%cl</code> graph is the left-most in a <i>chongwen</i> sequence</li>
<li><code>%cr</code> graph is a subsequent member of a <i>chongwen</i> sequence</li>
<li><code>%fu</code> the form of the graph is unusual (given the way it is transcribed)</li>
</ul>
<p>The markup and the way it is recorded in the database is documented <a href='../../html_public/db_doc/#markup'>here</a>. The different categories of markup are displayed in Viewer (in this dialog and in the transcriptions pane) using various forms of text-decoration (text and background color, underlining, etc.).</p>
<h2>Graph viewer window</h2>
<p>This window can display all bounding-box graph images that have been recorded as corresponding to a particular transcribed graph (by the process described above). It is an experimental bit of functionality that is currently only very incompletely developed - merely a proof of conept. When Viewer opens, in addition to the main window discussed above, a second window opens: the graph viewer window. Initially it appears blank apart from an input box at the top left.</p>
<img src='graph_viewer1.png' />
<p>Type the ascii-typable name of the graph into the input box and press <code>Enter</code>. All images of this graph will be displayed in the window. Since this can be quite a processig-intesive task if there are many exemplars (since every graph needs to cropped from the inscription image, which is in turn cropped from the surface image, which in turn is cropped from the raw image, potentially with rotations at each stage), expect this to take some time to complete for high-frequnecy graphs.</p>
<img src='graph_viewer2.png' />
<?php require $includes . 'public_bottom.html.php'; ?>
