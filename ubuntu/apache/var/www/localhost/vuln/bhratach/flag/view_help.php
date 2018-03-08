<?php

define( 'WEB_PAGE_TO_ROOT', '../' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Help';

$id = $_GET[ 'id' ];
$security = $_GET[ 'security' ];

$help = file_get_contents( WEB_PAGE_TO_ROOT."flag/{$id}/help/help.php" );

$page[ 'body' ] .= "
<div class=\"body_padded\">
	{$help}
</div>
";

dvwaHelpHtmlEcho( $page );

?>