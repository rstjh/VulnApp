<?php

define( 'WEB_PAGE_TO_ROOT', '' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

define( 'WEB_ROOT_TO_PHPIDS_LOG', 'external/phpids/'.dvwaPhpIdsVersionGet().'/lib/IDS/tmp/phpids_log.txt' );
define( 'WEB_ROOT_TO_PHPIDS_LOG', WEB_PAGE_TO_ROOT.WEB_ROOT_TO_PHPIDS_LOG );

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'PHPIDS Log';
$page[ 'page_id' ] = 'log';
//$page[ 'clear_log' ]; <- Was showing error.

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>PHPIDS Log</h1>
	
	<p>". dvwaReadIdsLog() ."</p>
	
	<br />
	<br />
	
	<form action=\"#\" method=\"GET\">
    <input type=\"submit\" value=\"Clear Log\" name=\"clear_log\">
    </form>
	
	".dvwaClearIdsLog()."
	
</div>
";


HtmlEcho( $page );

?>
