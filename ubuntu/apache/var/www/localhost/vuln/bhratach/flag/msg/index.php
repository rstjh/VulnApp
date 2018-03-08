<?php

define( 'WEB_PAGE_TO_ROOT', '../../' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Guest book';
$page[ 'page_id' ] = 'Information';

DatabaseConnect();

$vulnerabilityFile = 'low.php';


require_once WEB_PAGE_TO_ROOT."flag/msg/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<div class=\"columns\">
	<div class=\"column\">
		<h1 class=\"title\">Guest book</h1>
		<h2 class=\"secondary subtitle\">Over the years we have had the pleasure of welcoming many guests onboard our fine vessels. We welcome past guests to share their stories and experiences from past Bhratach Cruise experiences.</h2>
	
		<form method=\"post\" name=\"guestform\" onsubmit=\"return validate_form(this)\">
		<div class=\"field\">
			<label class=\"label\">Name</label>
			<p class=\"control\">
				<input class=\"input\" type=\"text\" name=\"txtName\" placeholder=\"Name\">
			</p>
		</div>

		<div class=\"field\">
			<label class=\"label\">Message</label>
			<p class=\"control\">
				<textarea class=\"textarea\" name=\"mtxMessage\" placeholder=\"Your guestbook message\"></textarea>
			</p>
		</div>

		<p class=\"control\">
			<input name=\"btnSign\" class=\"button is-primary\" type=\"submit\" value=\"Enter Message\" onClick=\"return checkForm();\">
		</p>

		</form>
		
		{$html}
		</div>
	
	<div class=\"column\">
		".Guestbook()."
	</div>
	</div>
</div>
";


HtmlEcho( $page );
?>
