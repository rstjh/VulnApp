<?php

define( 'WEB_PAGE_TO_ROOT', '' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Setup';
$page[ 'page_id' ] = 'setup';

if( isset( $_POST[ 'create_db' ] ) ) {

	if ($DBMS == 'MySQL') {
		include_once WEB_PAGE_TO_ROOT.'bhratach/includes/DBMS/MySQL.php';
	}
	elseif ($DBMS == 'PGSQL') {
		include_once WEB_PAGE_TO_ROOT.'bhratach/includes/DBMS/PGSQL.php';
	}
	else {
		MessagePush( "ERROR: Invalid database selected. Please review the config file syntax." );
		PageReload();
	}

}


$page[ 'body' ] .= "
<div class=\"body_padded has-text-centered\">

	<h2 class=\"title is-3\">Welcome to your guest dashboard.</h2>
	<h2 class=\"subtitle is-5\">To proceed, activate the database by clicking the button below.</h2>

	Backend Database: <b>".$DBMS."</b>
	
	<!-- Create db button -->
	<form action=\"#\" method=\"post\">
		<input name=\"create_db\" class=\"button is-large is-primary\" type=\"submit\" value=\"Activate dashboard\">
	</form>
</div>
";


HtmlEcho( $page );

?>
