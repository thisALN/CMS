<!doctype html>
<html>
<head>
	<title>About this probject</title>
	<style type="text/css">
		img {max-width: 100%; }
	</style>
</head>
<body>
	<p>I've been trying to finish this before I build another portfolio/personal website because each time I do that I mostly delete my previous content and have to refind it. Also because once its built my site never changes, just the look if I want it to but its also fully automate-able. Basically the main theory is similar to wordpress but different by</p>
	<blockquote>theme -> post OR page / media is completely separate<br>
	<em>posts are single entries<br>
	pages are hierarchal</em></blockquote>
	<p>I want mine to be</p>
	<blockquote>theme -> filesystem [-> other servers]<br>
	<em>filesystem is a collection of any data stored/represented by this system<br>
	by storing directories as collections of entries, any entry can have subparts of any media type</em></blockquote>
	<p>The <b>similarity</b> is that instead of having a static filesystem and loading from a certain theme file (start the callstack, whatever initiates the entire script) that then has to jump around the server side of the site including or referencing various parts, it just lists all the content prior to showing anything and then just injects/writes it when the page is output. This means its way quicker, more secure, easier to program, etc. Downsides don't really exist because either way the native filesystem is simulated, files aren't actually in those locations. Idk how much you know about this, I can explain it more sometime but basically any URL is just a string that stands for an address/location on the disk and so it SEEMS organized.</p>
	<p>directories have functions such as <code>remove</code>, <code>add</code>, <code>sort</code>, <code>list</code>, <code>outputBySPECIFICATION</code> (category, type, etc). Images can be linked from anywhere, sizes can be dynamically chosen (WP can't do this, you have to resize all the images if you want to change anything). These functions can be added as "shortcuts" to admin dropdowns/menus, ex: if the blog.add(content) function is bound to an admin menu you'd probs call it "Post" and that's exactly what it does. It would add a new entry to the "blog" listing, and the homepage of "blog" will automatically output in its list.</p>
	<p>A single server has an admin user (only accessible on the local server, root permissions), and any other users can be shared between different servers. This means that users/content don't need to be duplicated if you want to reshare to a different site/blog, that individual user is given access to the server and then from a single admin page they see all of their content across any server they access and they can easily distribute certain content to other servers if they wish (as well as designating timeouts of access). Content can be split into smaller "files" and only parts are shared if they want.</p>
	<p>extra benefit: this means that static links in pages that the files get moved and then the link is broken (I think this happened a lot at shodor) will never happen. This logic fails when its outside the same domain but either way the server's domain of control also ends there.</p>
	<p>For example:
	<div><pre>
	"About me" <em>- single page, links to "Portfolio", Social stuff, etc.</em>
	"Blog" - <em>directory, contains a part as an index (description, links to a dynamic list of subentries, etc)
	-   "Post 1" - subentry of blog
	-   "Post 2" - another subentry, each of these can behave as a directory if the user wants.</em>
	"Portfolio" - <em>directory, has a self-page but also listings for all subentries
	-   "Photography" - page for photos
	-   "Portraits" - self explanatory probs
	-   "ETC" - more
	-   "Videography" - ...
	-   "Design" - ...
	-   "Graphics"
	-   "Web"
	-   "Apparel"</em></pre></div>
	<p><img src="images/filesystemex.png" style="float: right; width: 450px; border: 1px #888 solid;"/>Long story short the hierarchy can be whatever you want, and I'm planning on making the admin page look similar to the generic mac file system layout. I'll send a screenshot for clarity of which one. I sketched an example of it in the pdf i've included. This view wouldn't show much probs except title/author/edit date/ellipsis of content, but the content would be edited in its own window - probs either a sidebar thing or overlay. </p>
	<p>I'd prefer to keep the UI in as few screens/pages as possible. This site is designed to work for any size screen/server (ultimately I want to mix it with my OS idea and since everyones entire filesystem is hosted in a cloud setup with all computers usably close and with enough storage space, this means that webservers can be arbitrarily hosted and whenever requested each computer/node would send the relevant files. It means its a perfectly backed up system as a very small fraction of the current storage/bandwidth uses. Side note but this would also ruin all ISPs, especially fuck comcast and at&t/time warner, and its designed to be able to transmit up to a GB in under a second across the US to anywhere with more than 5 computers within the local network  -this is my main standard metric for my OS/internet idea).</p>
	<p>All the images/files/other content (can include applications as well, both native OS ones and others since chrome/firefox support direct USB/thunderbolt interfaces from JS - with can run ~3x faster than compiled java) are shown in this same layout, and we never have to move the files or content entries - we just update the references to each in a reference table (as far as I know this is what computers do on a low level for a standard filesystem).</b>
	<img src="images/IMG_0165.JPG" />
	<p>Normally a webserver only returns the relevant file at the location you ask for (from the url) and if you only specify a directory it only returns the "index.TYPE" file unless other rules are set. That's why some urls are</p>
	<blockquote>
	<pre>
	host://sub.domain.tld/bar/foo/</pre>
	the "index.whatever" file is here^:index.html
	and idk if you've noticed by some sites end with
	<pre>	host://sub.domain.tld/bar/foo</pre>
	this is because they are renaming a file probs called
	<pre>	host://sub.domain.tld/bar/foo.php</pre>
	</blockquote>
	<h3>No ifs, hopefully</h3>
	<p>But I want to completely skip this and get rid of any outliers, I want it (and my AI already does this) to function as a fully continuous mathematical function instead of a logic based one. A lot of the math is just a representation of logic but when arithmetically computed its way faster and reliable, as well as natively expandable and simpler to debug.</p>
	<p>My method just checks the remaining url after ".tld/" and compares it to the "url" part of the entry data. If we want we can optimize it to only look at entries that share the same prior url. Overall this is slightly slower than a native server but it should be less than 1/10 the size and slowness of WP (also more secure) and its compute time goes up with around 1n instead of WPs which is kinda n^2 but maintains a memory hog of n/2ish. Mine has a constant server memory use of just the references for the relevant part of the site and uses less for refactoring the data when it needs updating.</p>
	<img src="images/IMG_0163.JPG" />
	<h3>Output(URL)</h3>
	<p>This means that the server can perfectly reference, organize, and handle any file type and allows the user to designate how it is output or communicated to the client. Well mostly themes do this, but theme dev is hella easy. If we support plugins i'm gonna make themes require certain ones, this is a main issue with WP - if a site 	configuration starts using plugins it can be almost hell to move it to another physical server.</p>
	<h3>Future</h3>
	<p>Later on we can make it written fully in server languages so that the frontend is perfectly updated/standard syntax/algorithms so an updated client doesn't hurt and our same code is usable in decades from now. Also maybe write it in apache/C so it's faster than a normal server or use the AI system to automatically organize photos/files/content based on context/content.</p>
	<img src="images/CMS.pdf"/>
	</body>
<html>