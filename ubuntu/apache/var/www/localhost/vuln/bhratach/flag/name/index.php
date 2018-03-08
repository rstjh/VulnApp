<?php

define( 'WEB_PAGE_TO_ROOT', '../../' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'What is your name?';
$page[ 'page_id' ] = 'name';

DatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;

	case 'medium':
		$vulnerabilityFile = 'low.php';
		break;

	case 'high':
	default:
		$vulnerabilityFile = 'low.php';
		break;
}

require_once WEB_PAGE_TO_ROOT."flag/name/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<div class=\"columns\">
		<div class=\"column\">
			<h1 class=\"title\">Booking status</h1>
			<h2 class=\" secondary subtitle\">Whether you wish to review your Bhratach credits, reserve a restaurant table or book a place on our 'Ocean Snake' water ride, we have you covered.</h2>
			<article class=\"message is-warning\">
				<div class=\"message-body\">
					Enter your last name to retrieve your booking.
				</div>
			</article>
		</div>
		<div class=\"column\">
			<form name=\"XSS\" action=\"#\" method=\"GET\">
				<div class=\"field\">
					<label class=\"label\">Guest name</label>
					<div class=\"control\">
						<input class=\"input\" type=\"text\" placeholder=\"Guest name\">
					</div>
				</div>
				<div class=\"control\">
					<input class=\"button is-primary\" type=\"submit\" value=\"Retrieve booking\">
				</div>
			</form>
		</div>
	</div>
		{$html}
</div>
";

HtmlEcho( $page );

?>
