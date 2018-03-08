<?php

define( 'WEB_PAGE_TO_ROOT', '' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Bhratach Security';
$page[ 'page_id' ] = 'security';

$securityHtml = '';
if( isset( $_POST['seclev_submit'] ) ) {
	$securityLevel = 'high';

	switch( $_POST[ 'security' ] ) {
		case 'low':
			$securityLevel = 'low';
			break;
		case 'medium':
			$securityLevel = 'medium';
			break;
	}

	$securityLevel = 'low';
	SecurityLevelSet( $securityLevel );
	MessagePush( "Security level set to {$securityLevel}" );
	PageReload();
}


if( isset( $_GET['phpids'] ) ) {
	switch( $_GET[ 'phpids' ] ) {
		case 'on':
			PhpIdsEnabledSet( true );
			MessagePush( "PHPIDS is now enabled" );
			break;
		case 'off':
			PhpIdsEnabledSet( false );
			MessagePush( "PHPIDS is now disabled" );
			break;
	}

	PageReload();
}
PhpIdsEnabledSet( true );

$securityOptionsHtml = '';
$securityLevelHtml = '';
foreach( array( 'low', 'medium', 'high' ) as $securityLevel ) {
	$selected = '';
	if( $securityLevel == SecurityLevelGet() ) {
		$selected = ' selected="selected"';
		$securityLevelHtml = "<p>Security Level is currently <em>$securityLevel</em>.<p>";
	}
	$securityOptionsHtml .= "<option value=\"{$securityLevel}\"{$selected}>{$securityLevel}</option>";
}

$phpIdsHtml = 'PHPIDS is currently ';
if( PhpIdsIsEnabled() ) {
	$phpIdsHtml .= '<em>enabled</em>. [<a href="?phpids=off">disable PHPIDS</a>]';
} else {
	$phpIdsHtml .= '<em>disabled</em>. [<a href="?phpids=on">enable PHPIDS</a>]';
}

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>DVWA Security <img src=\"".WEB_PAGE_TO_ROOT."bhratach/images/lock.png\"></h1>

	<br />
	
	<h2>Script Security</h2>

	{$securityHtml}

	<form action=\"#\" method=\"POST\">
		{$securityLevelHtml}
		<p>You can set the security level to low, medium or high.</p>
		<p>The security level changes the vulnerability level of DVWA.</p>

		<select name=\"security\">
			{$securityOptionsHtml}
		</select>
		<input type=\"submit\" value=\"Submit\" name=\"seclev_submit\">
	</form>

	<br />
	<hr />
	<br />

	<h2>PHPIDS</h2>

	<p>".ExternalLinkUrlGet( 'http://php-ids.org/', 'PHPIDS' )." v.".dvwaPhpIdsVersionGet()." (PHP-Intrusion Detection System) is a security layer for PHP based web applications. </p>
	<p>You can enable PHPIDS across this site for the duration of your session.</p>

	<p>{$phpIdsHtml}</p>
	[<a href=\"?test=%22><script>eval(window.name)</script>\">Simulate attack</a>] -
	[<a href=\"ids_log.php\">View IDS log</a>]
	
</div>
";


HtmlEcho( $page );

?>
