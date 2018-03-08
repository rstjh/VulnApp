<?php

define( 'WEB_PAGE_TO_ROOT', '../../../' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'User ID Verification';
$page[ 'page_id' ] = 'sqli';

DatabaseConnect();

$vulnerabilityFile = 'low.php';


require_once WEB_PAGE_TO_ROOT."flag/extranet/sqli/source/{$vulnerabilityFile}";


$magicQuotesWarningHtml = '';

// Check if Magic Quotes are on or off
if( ini_get( 'magic_quotes_gpc' ) == true ) {
	$magicQuotesWarningHtml = "	<div class=\"warning\">This could be a red herring!!!</div>";
}

$body['body'] .= "<div class=\"body_padded\">";

if ($html) {
	$page['body'] .= "<article class=\"message is-primary\">
		<div class=\"message-header\">
			Retrieved tour guide
		</div>
		<div class=\"message-body\">
			{$html}
		</div>
	</article>";
}


$page[ 'body' ] .= "
	<div class=\"columns\">
		<div class=\"column\">
			<h1 class=\"title\">Tour guide finder</h1>
			<h2 class=\"secondary subtitle\">To retrieve information relating a tour guide booking, please enter the booking reference number.</h2>
			<img src=\"/bhratach/bhratach/images/tour-guide.jpg\" />
			{$magicQuotesWarningHtml}
		</div>

		<div class=\"column\">
			<form action=\"#\" method=\"GET\">

			<div class=\"field\">
				<label class=\"label\">Booking reference</label>
				<p class=\"control\">
					<input class=\"input\" type=\"text\" name=\"id\" placeholder=\"Booking reference\">
				</p>
			</div>
				<input type=\"submit\" class=\"button is-primary\" name=\"Submit\" value=\"Retrieve booking\">
			</form>

		

		</div>
	</div>


</div>
";

HtmlEcho( $page );

?>
