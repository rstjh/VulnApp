<?php

define( 'WEB_PAGE_TO_ROOT', '../../' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Guest Wifi Access';
$page[ 'page_id' ] = 'Bhratach';

DatabaseConnect();

$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;

	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;

	case 'high':
	default:
		$vulnerabilityFile = 'high.php';
		break;
}

require_once WEB_PAGE_TO_ROOT."flag/brute/source/{$vulnerabilityFile}";

$body['body'] .= "<div class=\"body_padded\">";

if ($html) {
	$page['body'] .= "<article class=\"message is-danger\">
		<div class=\"message-body\">
			{$html}
		</div>
	</article>";
}

$page[ 'body' ] .= "
	<div class=\"columns\">
		<div class=\"column\">
			<h1 class=\"title\">Guest wifi Access</h1>
			<h2 class=\"secondary subtitle\">
				Bhratach is pleased to provide complimentary wifi to all guests.
			</h2>
			<article class=\"message is-warning \">
				<div class=\"message-body\">
					Guests are reminded that a username and password is <strong>placed in the welcome pack in guests' rooms.</strong>
				</div>
			</article>
		</div>
		<div class=\"column\">
			<h2 class=\"subtitle\">Login</h2>

			<form action=\"#\" method=\"GET\">
				<div class=\"field\">
					<label class=\"label\">Username</label>
					<div class=\"control\">
						<input class=\"input\" type=\"text\" placeholder=\"Username\">
					</div>
				</div>

				<div class=\"field\">
					<label class=\"label\">Password</label>
					<div class=\"control\">
						<input class=\"input\" type=\"password\" AUTOCOMPLETE=\"off\" placeholder=\"Password\" />
					</div>
				</div>
				
				<div class=\"control\">
					<input class=\"button is-primary\" type=\"submit\" value=\"Access wifi\" name=\"Login\">
				</div>
			</form>
		</div>
	</div>

</div>
";

HtmlEcho( $page );

?>