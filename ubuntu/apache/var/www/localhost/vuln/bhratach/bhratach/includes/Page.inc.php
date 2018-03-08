<?php

if( !defined( 'WEB_PAGE_TO_ROOT' ) ) {

	define( 'BHRATACH System error- WEB_PAGE_TO_ROOT undefined' );
	exit;

}


session_start(); // Creates a 'Full Path Disclosure' vuln.


// Include configs
require_once WEB_PAGE_TO_ROOT.'config/config.inc.php';

require_once( 'PhpIds.inc.php' );

// Declare the $html variable
if(!isset($html)){

	$html = "";

}


// Set security cookie to high if no cookie exists
if (!isset($_COOKIE['security'])){

	setcookie( 'security', 'Low' );

}

// Bhratach version
function VersionGet() {

	return 'Copyright (C) DVWA';

}

// Bhratach release date
function ReleaseDateGet() {

	return 'November 2010';

}


// Start session functions -- 

function &SessionGrab() {

	if( !isset( $_SESSION[ 'bhratach' ] ) ) {

		$_SESSION[ 'bhratach' ] = array();

	}

	return $_SESSION[ 'bhratach' ];
}


function PageStartup( $pActions ) {

	if( in_array( 'authenticated', $pActions ) ) {

		if( !IsLoggedIn()){

			Redirect( WEB_PAGE_TO_ROOT.'login.php' );

		}
	}

	if( in_array( 'phpids', $pActions ) ) {

		if( PhpIdsIsEnabled() ) {

			PhpIdsTrap();

		}
	}
}


function PhpIdsEnabledSet( $pEnabled ) {

	$Session =& SessionGrab();

	if( $pEnabled ) {

		$Session[ 'php_ids' ] = 'enabled';

	} else {

		unset( $Session[ 'php_ids' ] );

	}
}


function PhpIdsIsEnabled() {

	$Session =& SessionGrab();

	return isset( $Session[ 'php_ids' ] );

}


function Login( $pUsername ) {

	$Session =& SessionGrab();

	$Session['username'] = $pUsername;

}


function IsLoggedIn() {

	$Session =& SessionGrab();

	return isset( $Session['username'] );

}


function Logout() {

	$Session =& SessionGrab();

	unset( $Session['username'] );

}


function PageReload() {

	Redirect( $_SERVER[ 'PHP_SELF' ] );

}

function CurrentUser() {

	$Session =& SessionGrab();

	return ( isset( $Session['username']) ? $Session['username'] : '') ;

}

// -- END

function &PageNewGrab() {

	$returnArray = array(
		'title' => 'Bhratach v.1.0 '.VersionGet().'',
		'title_separator' => ' :: ',
		'body' => '',
		'page_id' => '',
		'help_button' => '',
		'source_button' => '',
	);

	return $returnArray;
}


function SecurityLevelGet() {

	return isset( $_COOKIE[ 'security' ] ) ? $_COOKIE[ 'security' ] : 'low';

}



function SecurityLevelSet( $pSecurityLevel ) {

	setcookie( 'security', $pSecurityLevel );

}



// Start message functions -- 
function MessagePush( $pMessage ) {

	$Session =& SessionGrab();

	if( !isset( $Session[ 'messages' ] ) ) {

		$Session[ 'messages' ] = array();

	}

	$Session[ 'messages' ][] = $pMessage;
}



function MessagePop() {

	$Session =& SessionGrab();

	if( !isset( $Session[ 'messages' ] ) || count( $Session[ 'messages' ] ) == 0 ) {

		return false;

	}

	return array_shift( $Session[ 'messages' ] );
}


function messagesPopAllToHtml() {

	$messagesHtml = '<div class="content is-small">';

	while( $message = MessagePop() ) {	// TODO- sharpen!

		$messagesHtml .= "<blockquote>{$message}</blockquote>";

	}
	$messagesHTML .= "</div>";

	return $messagesHtml;
}
// --END

function HtmlEcho( $pPage ) {

	$menuBlocks = array();

	$menuBlocks['home'][] = array( 'id' => 'home', 'name' => 'Home', 'url' => '.' );

	$menuBlocks['flag'][] = array( 'id' => 'brute', 'name' => 'Guest wifi access', 'url' => 'flag/extranet/.' );
	$menuBlocks['flag'][] = array( 'id' => 'sqli', 'name' => 'Tour guide finder', 'url' => 'flag/extranet/sqli/.' );
	$menuBlocks['flag'][] = array( 'id' => 'xss_r', 'name' => 'Booking status', 'url' => 'flag/name/.' );
	$menuBlocks['flag'][] = array( 'id' => 'xss_s', 'name' => 'Guest book', 'url' => 'flag/msg/.' );

	$menuBlocks['logout'][] = array( 'id' => 'logout', 'name' => 'Logout', 'url' => 'logout.php' );

	$menuHtml = '<nav class="navbar">
					<div class="container">
						<div class="navbar-brand">';

	foreach( $menuBlocks as $menuBlock ) {

		$menuBlockHtml = '';

		foreach( $menuBlock as $menuItem ) {

			$selectedClass = ( $menuItem[ 'id' ] == $pPage[ 'page_id' ] ) ? 'selected' : '';

			$fixedUrl = WEB_PAGE_TO_ROOT.$menuItem['url'];

			$menuBlockHtml .= "<a onclick=\"window.location='{$fixedUrl}'\" class=\"{$selectedClass} navbar-item\" href=\"{$fixedUrl}\">{$menuItem['name']}</a>";

		}

		$menuHtml .= "{$menuBlockHtml}";
	}

	$menuHtml .= "	
			</div>
		</div>
	</nav>";
	
	// Get security cookie --
	$securityLevelHtml = '';

	switch( SecurityLevelGet() ) {

		case 'low':
			$securityLevelHtml = 'low';
			break;

		case 'medium':
			$securityLevelHtml = 'low';
			break;

		case 'high':
		default:
			$securityLevelHtml = 'low';
			break;
	}
	// -- END
	
	$phpIdsHtml = '<b>PHPIDS:</b> '.( PhpIdsIsEnabled() ? 'enabled' : 'disabled' );

	$userInfoHtml = '<b>Username:</b> '.( CurrentUser() );

	$messagesHtml = messagesPopAllToHtml();

	if( $messagesHtml ) {

		$messagesHtml = "<div class=\"body_padded\">{$messagesHtml}</div>";

	}
	

	if( $pPage[ 'source_button' ] ) {

		$systemInfoHtml = ButtonSourceHtmlGet( $pPage[ 'source_button' ] )." $systemInfoHtml";

	}

	if( $pPage[ 'help_button' ] ) {

		$systemInfoHtml = ButtonHelpHtmlGet( $pPage[ 'help_button' ] )." $systemInfoHtml";

	}
	
	
	// Send Headers + main HTML code
	Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
	Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".WEB_PAGE_TO_ROOT."bhratach/css/main.css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".WEB_PAGE_TO_ROOT."bhratach/css/bulma.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"".WEB_PAGE_TO_ROOT."favicon.ico\" />

		<script type=\"text/javascript\" src=\"".WEB_PAGE_TO_ROOT."bhratach/js/dvwaPage.js\"></script>

	</head>

	<body class=\"home\">
		<div id=\"container\">

			<div id=\"header\">
				<div class=\"container\">
					<div class=\"columns\">
						<div class=\"column is-one-quarter\">
							<img class=\"is-pulled-left\" src=\"".WEB_PAGE_TO_ROOT."bhratach/images/logo.png\" alt=\"Bhratach\" />
						</div>
						<div class=\"column auto\">
								<span class=\"tag is-danger is-medium\">
									Sale
								</span>
								<h4 class=\"title is-4\">
									50% off all activity passes
								</h4>
								<h6 class=\"subtitle is-6\">Speak to your activity manager</h6>
						</div>
						<div class=\"column auto\">
							<h2 class=\"subtitle\">
								Latest updates
							</h2>
							<div>
								<span class=\"tag is-danger\">Alert</span> North Sea experiencing high winds
							</div>
							<div>
								<span class=\"tag is-info\">Facilities</span> Emerald Princess undergoing repairs
							</div>
						</div>
					</div>
				</div>
			</div>
				{$menuHtml}
			<div id=\"main_body\">
				<div class=\"container\">
						{$messagesHtml}
					{$pPage['body']}
					
				</div>
			</div>

			<div class=\"clear\">
			</div>

			<div id=\"system_info\">
				{$systemInfoHtml}
			</div>

			<footer class=\"footer\">
				<div class=\"container\">
					<div class=\"content has-text-centered\">
						<p>Bhratach Cruises ".VersionGet()."</p>
					</div>
				</div>
			</footer>
			

		</div>

	</body>

</html>";
}


function dvwaHelpHtmlEcho( $pPage ) {
	// Send Headers
	Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
	Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".WEB_PAGE_TO_ROOT."bhratach/css/help.css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".WEB_PAGE_TO_ROOT."bhratach/css/bulma.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"".WEB_PAGE_TO_ROOT."favicon.ico\" />

	</head>

	<body>
	
	<div id=\"container\">

			{$pPage['body']}

		</div>

	</body>

</html>";
}


function dvwaSourceHtmlEcho( $pPage ) {
	// Send Headers
	Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
	Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
	Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

	echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".WEB_PAGE_TO_ROOT."bhratach/css/source.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"".WEB_PAGE_TO_ROOT."favicon.ico\" />

	</head>

	<body>

		<div id=\"container\">

			{$pPage['body']}

		</div>

	</body>

</html>";
}

// To be used on all external links --
function ExternalLinkUrlGet( $pLink,$text=null ) {

	if (is_null($text)){

		return '<a href="http://hiderefer.com/?'.$pLink.'" target="_blank">'.$pLink.'</a>';

	}

	else {

		return '<a href="http://hiderefer.com/?'.$pLink.'" target="_blank">'.$text.'</a>';

	}
}
// -- END

function ButtonHelpHtmlGet( $pId ) {

	$security = SecurityLevelGet();

	return "<input type=\"button\" value=\"View Help\" class=\"popup_button\" onClick=\"javascript:popUp( '".WEB_PAGE_TO_ROOT."flag/view_help.php?id={$pId}&security={$security}' )\">";

}


function ButtonSourceHtmlGet( $pId ) {

	$security = SecurityLevelGet();

	return "<input type=\"button\" value=\"View Source\" class=\"popup_button\" onClick=\"javascript:popUp( '".WEB_PAGE_TO_ROOT."flag/view_source.php?id={$pId}&security={$security}' )\">";

}

// Database Management --

if ($DBMS == 'MySQL') {

 $DBMS = htmlspecialchars(strip_tags($DBMS));

 $DBMS_errorFunc = 'mysql_error()';

}
elseif ($DBMS == 'PGSQL') {

 $DBMS = htmlspecialchars(strip_tags($DBMS));

 $DBMS_errorFunc = 'pg_last_error()';

}
else {

 $DBMS = "No DBMS selected.";

 $DBMS_errorFunc = '';

}

$DBMS_connError = '
		<link rel="stylesheet" type="text/css" href="'.WEB_PAGE_TO_ROOT.'bhratach/css/bulma.css" />
		<div style="display:flex; align-items: center; justify-content: center;">
				<div style="flex: 1;" class="has-text-centered">
					<img src="'.WEB_PAGE_TO_ROOT.'bhratach/images/logo.png">
					<div style="margin: 20px;"><code>'.$DBMS_errorFunc.'</code></div>
					<h3 class="subtitle is-3">Dashboard database not found</h3>
					<a class="button is-primary" href="'.WEB_PAGE_TO_ROOT.'setup.php">Setup database</a>
				</div>
		</div>';

function DatabaseConnect() {

	global $_BHRATACH;
	global $DBMS;
	global $DBMS_connError;

	if ($DBMS == 'MySQL') {

		if( !@mysql_connect( $_BHRATACH[ 'db_server' ], $_BHRATACH[ 'db_user' ], $_BHRATACH[ 'db_password' ] )
		|| !@mysql_select_db( $_BHRATACH[ 'db_database' ] ) ) {
			die( $DBMS_connError );
		}

	}
	
	elseif ($DBMS == 'PGSQL') {

		$dbconn = pg_connect("host=".$_BHRATACH[ 'db_server' ]." dbname=".$_BHRATACH[ 'db_database' ]." user=".$_BHRATACH[ 'db_user' ]." password=".$_BHRATACH[ 'db_password' ])
		or die( $DBMS_connError );

	}
}

// -- END


function Redirect( $pLocation ) {

	session_commit();
	header( "Location: {$pLocation}" );
	exit;

}

// XSS Stored guestbook function --
function Guestbook(){

	$query  = "SELECT name, comment FROM guestbook";
	$result = mysql_query($query);

	$guestbook = '<h2 class="subtitle">Guest comments</h2>';
	
	while($row = mysql_fetch_row($result)){	
		
		if (SecurityLevelGet() == 'high'){

			$name    = htmlspecialchars($row[0]);
			$comment = htmlspecialchars($row[1]);
	
		}

		else {

			$name    = $row[0];
			$comment = $row[1];

		}
		
		$guestbook .= "<div class=\"box\">
						<div class=\"content\">
							<p><strong>{$name}</strong><br />" . "
							{$comment}
						</div>
						</div>";
	} 
	
return $guestbook;
}
// -- END


?>
