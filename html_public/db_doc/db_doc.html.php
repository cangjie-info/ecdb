<!DOCTYPE html>
<html>
    <head>
    <meta charset='UTF-8' />
    <title>ECDB - Database documentation</title>
</head>
<body>

<?php require $includes . 'public_top.html.php'; ?>

<h1>Database documentation</h1>
<p>The ECDB MySQL database is designed to store, view and manipulate information about archeologically recovered texts in difficult orthographies. 
To some extent, the database is self-documenting, using the table and field comments in MySQL. 
The relational <a href = 'schema.pdf'>schema</a> and a data <a href='datadict.html'>dictionary</a> will be generated periodically with phpMyAdmin.
As a supplement to those documents, this page provides more detailed descriptions of some of the more complex features of the database. The descriptions are organized by tables (alphabetically) and then by field (in database order).</p>

<h2>Index</h2>
<p>Tables in this index that have more detailed documentation on this page appear as clickable links.</p>
<p>Closely related tables - tables that are closely connected via explicitly defined foreign key relations - usually share a common prefix in the table name.
This allows them to be conveniently displayed together by sorting on the table names.</p>
<h3>The <code>arch</code> group</h3>
<p>These tables document texts as archeological objects: their materials, the contexts and sites from which they were recovered, and the excavations that unearthed them.<p> 
<ul>
<li><code>arch_context_types</code></li>
<li><code>arch_contexts</code></li>
<li><code>arch_excavations</code></li>
<li><code>arch_localities</code></li>
<li><code>arch_objects</code></li>
<li><code>arch_periods</code></li>
<li><code><a href='#arch_sites'>arch_sites</a></code></li>
</ul>
<h3>The <code>graphs</code> group</h3>
<p>Tables in this group include a list of all graphs available for encoding texts, and others containing palaeographical information on those graphs. 
Representations in a number of fonts, graph component data, mappings to other encodings, and references to dictionaries are all here.
<ul>
<li><code><a href='#graphs'>graphs</a></code></li>
</ul>
<h3>The <code>inscr</code> group</h3>
<p>This group of tables models the text that appears on inscribed objects. <code>inscr_objects</code> is a table of physical objects bearing text (in their known maximal state of joining from fragments). 
<code>inscr_surfs</code> represents published surfaces of inscribed objects. 
A complex inscribed object often has more than one surface, and that surface may be published multiple times, perhaps in different states of joining from fragments.
For most object categories (bronzes, bamboo slips), a single surface is considered to bear only a single inscription. 
But, primarily to deal with the complexity of divination records from Anyang and elsewhere, the <code>inscrs</code> table is used to track the multiple inscriptions appearing on a single published surface.
Each inscription gets a separate entry in this table. The <code>inscr_graphs</code> table stores the graphs that occur in sequence in an individual inscription.</code> 
The publications in which published inscribed surfaces are found are listed in <code>pubs</code>.</p>
<ul>
<li><code><a href='#inscr_graphs'>inscr_graphs</a></code></li>
<li><code>inscr_object_types</code></li>
<li><code>inscr_objects</code></li>
<li><code>inscr_surf_types</code></li>
<li><code>inscr_surfs</code></li>
<li><code>inscrs</code></li>
<li><code>pubs</code></li>
</ul>
<h3>The <code>ref</code> group</h3>
<p>Tables in the <code>ref</code> group contain data from print-published reference works or digital resources.</p>
<ul>
<li><code>ref_chant</code></li>
<li><code>ref_gulin</code></li>
<li><code>ref_shen2008</code></li>
</ul>

<h2>Tables documentation</h2>

<h3>arch_context_types</h3>
<h3>arch_contexts</h3>
<h3>arch_excavations</h3>
<h3>arch_localities</h3>

<h3>arch_objects</h3>
<h3>arch_periods</h3>
<h3><a id='arch_sites'>arch_sites</a></h3>
<p>Archeological sites: groups of spatially proximate, temporally continuous and culturally related archeological remains. ECDB allows for 'localities' and 'features' below the level of the 'site', so in general we want the 'site' to as large an archeological unit as possible. E.g. Shang dynasty "Anyang Yinxu" is a site. E.g. Han period remains from Anyang are not considered to belong to the same site.</p>
<h4>Fields</h4>
<h5>id</h5>
<h5>name</h5>
<p>Unique, alphabetic (usually pinyin) name. This will usually be the transliteration of the Chinese name (name_zh field), which by convention is the modern name of the closest inhabited location. In order to maintain uniquness, adding higher levels in the geographic name may be necessary. For major historically prominent sites, using an historical name is also appropriate.</p>
<h5>name_zh</h5>
<p>Name as it appears in the Chinese scholarly literature. Chinese characters. Must be unique.</p>
<h5>address</h5>
<p>Full 'address' string of the site, in Chinese, beginning with province, and with all administrative unit names specified. E.g. 河南省安陽市.
<h5>description</h5>
<p>Short prose description of the site and its significance, focussing on its textual remains and their background. Not the place for long essays.</p>

<h3><a id='graphs'>graphs</a></h3>
<p>This table is a list of all graphs available for encoding texts. Currenly it holds a very complete representation of the Anyang OBI inventory of graphs, based on the list found in Shen & Cao (2008). 
This will be expanded as we add graphs for encoding the HD and CZCN corpora. Not all graphs appearing in this list will actually be used for encoding texts. 
It may, for instance, turn out that a single graph has been represented more than once in the list, either in error, or because Shen & Cao (2008) split a couple of variant forms that should rather be encoded as a single graph. 
However, no graph will ever be deleted from the list. Rather, entries in the list that we consider should be merged with another graph will be simply notated as such.</p>
<p>NOTE: in addition to graphs that occur in inscriptions, the table also includes a small number of signs for inline editorial markup. Currently, four are defined. These are: id=6399-6402, for 'lacuna', 'unclear', 'lacunae', and 'space'. Becuase these signs need to go inline with the text, and <em>should</em> affect text searches (unlike <i>hewen</i>), they are treated as graphs and included in the graphs table.</p>
<h4>Fields</h4>
<h5>id</h5>
<p>A unique id number, used to represent the graph unambiguously. Graphs in the <code>inscr_graphs</code> table are represented using these id numbers.</p>
<h5>is_hewen</h5>
<p>Shen & Cao (2008) and other authors treat <i>hewen</i> as distinct graphs. We prefer to encode <i>hewen</i> as their component graphs, but with appropriate markup to indicate that they are <i>hewen</i>. This makes text searching easier to implement, without loss of information.
In order to represent Shen & Cao's graph list completely, and in order to manipulate previously encoded text that encodes <i>hewen</i> as single graphs, we have retained <i>hewen</i> graphs in the sign list. Their satus is indicated by this boolean field.</p>
<h5>exemplar</h5>
<p>Shen & Cao conveniently list inscription sources for many of the graphs that they include in their list. These are preserved in this field.</p>
<h5>ics3_glyph</h5>
<p>The textual representation of the graph using the CHANT ics3.ttf font. This is not available for all graphs in Shen & Cao (2008) or in this table.</p>
<h5>ics4_glyph</h5>
<p>The representation of the graph using the CHANT ics4.ttf font. Not available for all graphs.</p>
<h5>hd_glyph </h5>
<p>The graph in the huadong.ttf font. Since a number of graphs were new in the HD corpus, not all are represented in ics3.ttf. Shen & Cao (2008) aimed to represent all new HD graphs in their list.</p>
<h5>gulin</h5>
<p>The number of the graph in the <i>Jiaguwenzi gulin</i> 甲骨文字詁林 dictionary.</p>
<h5>notes</h5>
<p>A place to store notes on the graph.</p>

<h3><a id='inscr_graphs'>inscr_graphs</a></h3>
<p>This table represents the graphs in the sequence that make up inscriptions. 
If a graph occurs in two different inscriptions, or twice in the same inscription, each occurrence will appear separately in this table. 
Besides the identity of the graph, a variety of mark-up and image-related information is also represented in this table.</p>
<h4>Fields</h4>
<h5>id</h5>
<p>Unique integer id for each graph instance.</p>
<h5>graph_id</h5>
<p>The identity of the graph as defined by the <a href='#graphs'><code>graphs</code></a> table.</p>
<h5>inscr_id</h5>
<p>The identity of the inscription in which the graph occurs. A reference to the id field in the <a href='#inscrs'><code>inscrs</code></a> table.</p>
<h5>number</h5>
<p>The ordinal number of the graph in the sequence of graphs in the inscription. 1, 2, 3, ... etc.</p>
<h5>markup</h5>
<p>This field stores a variety of markup for the graph in the form of bit-flags stored in a single integer value. 
This is hardly a human-readable format but it is compact and easily handled by client code: bitwise AND to read, OR to set, AND NOT to clear, and XOR to toggle, in the usual manner. The flags currently in use, and as named in an enum in the client code, are:</p>
<p>
<code>NO_MARKUP = 0 </code><br/>
<code>ALL_MARKUP = -1 </code><br/>
<code>GRAPH_UNCERTAIN = 1: </code>the graph's identity has been determined, but the determination is uncertain.<br/>
<code>CRACK_NUMBER = 2: </code>the graph is a crack-number on a divination bone.<br/>
<code>EDS_RESTORATION = 4: </code>the graph is missing or illegible, but can be confidently restored on the basis of context.<br/>
<code>HEWEN_LEFT = 8: </code>the first in a sequence of graphs that make up a <i>hewen</i>.<br/>
<code>HEWEN_RIGHT = 16: </code>the second (or third, etc.) in a sequence of graphs that make up a <i>hewen</i>.<br/>
<code>FORM_UNUSUAL = 32: </code>the identity of the graph is clear, but the form is unusual, non-standard, or in some way surprising. it may not resemble the form used in the font glyph. Graphs that are written upside-down in the context of right-way-up text should be marked up with this flag.<br/>
<code>CHONGWEN_LEFT = 64: </code>the first occurrence of a graph in a repeition indicated by a <i>chongwen</i> symbol.<br/>
<code>CHONGWEN_RIGHT = 128: </code>the second occurrence of a graph in repetition indicated by a <i>chongwen</i> symbol.<br/>
</p>
<p>It is almost certain that additional mark-up flags will be added in future.</p>

<h5>x1, y1, x2, y2 and rotation</h5>
<p>These fields record the position and rotations of the bouding box required to crop the graph thumbnail image from the image of the inscription.</p>
<h5>punc</h5>
<p>Punctuation represented by this field is <em>editorial</em> punctuation. It does not refer to marks or signs appearing in the original inscription. 
They would be encoded as graphs inline with the text, not as markup.</p>
<p>Punctuation comes in two flavors: pre-punctuation is punctuation that is inserted <em>before</em> the graph it is associated with in the stream of text. Post-punctuation refers to punctuation that is inserted <em>after</em> the graph with which it is associated. ECDB permits the following punctuation (pre-punctuation is the first three items in the list and the final two; the remainder are post-puntuation). Anything like a paragraph-break should (probably?) be treated as a section division.</p>
<p>

<code>LEFTQUOTE = 1 “</code><br/>
<code>LEFTINNERQUOTE = 2 ‘</code><br/>
<code>LEFTTITLE = 4 《</code><br/>
<code>RIGHTTITLE = 8 》</code><br/>
<code>PERIOD = 16 。</code><br/>
<code>QUESTION = 32 ？</code><br/>
<code>EXCLAMATION = 64 ！</code><br/>
<code>LISTCOMMA = 128 、</code><br/>
<code>COMMA = 256 ，</code><br/>
<code>COLON = 512 ：</code><br/>
<code>RIGHTINNNERQUOTE = 1024 ’</code><br/>
<code>RIGHTQUOTE = 2048 ”</code><br/>
<code>TAB = 4096 (indent, for verse sections, etc. - prepunc)</code><br/>
<code>NEWLINE = 8192 (start new line, for verse sections, paragraphs in long prose passages or speeches, etc. - prepunc)</code><br/>
<p><code>PERIOD, QUESTION, EXCLAMATION,</code> and <code>COLON</code> will be used to mark sentence endings during editing. Sentences are nevertheless modelled independently of punctuation.<br/>
</p>
<p>Only one of each punctuation item is permitted under this arrangment. Quotes can be nested, but only to a depth of two. 
Items always display in the order in which they appear in this list, except for the last two items: <code>NEWLINE</code> displays before all others, followed by </code>TAB</code>. E.g. a PERIOD always comes after a RIGHTTITLE but before a RIGHTQUOTE.<p>
<h5>ling_value_id</h5>
<p>The lingistic value of (morpheme written by) the graph.</p>

<h3>inscr_object_types</h3>
<h3>inscr_objects</h3>
<h3>inscr_surf_types</h3>
<h3>inscr_surfs</h3>
<h3><a id='inscrs'>inscrs<a></h3>
<h3>pubs</h3>
<h3>ref_chant</h3>
<h3>ref_gulin</h3>
<h3>ref_shen2008</h3>

<?php

echo "PHP working.\n";

?>
</body>
</html>
