<div id="headwrap">
	<div id="titlelogo">
		<a href="./">
			<img src="images/bemo-logo2.png" width="167" height="100" alt="Site logo" />
		</a>
	</div>
</div>

<div id="mwrap">
	<div id="lt"></div>
	<div id="lm"></div>
	<div id="lb"></div>
</div>

<div id="nwrap">
	<div id="menuBtn"></div>
	<nav>
		<ul class="navigation">
			<li<?php if($page['name']=='home'){ echo ' id="current"'; } ?>><a href="index.php?page=home" rel="self">Main</a></li>
			<li<?php if($page['name']=='contact'){ echo ' id="current"'; } ?>><a href="index.php?page=contact" rel="self">Contact Us</a></li>
		</ul>
	</nav>
</div>
