<?php

define( 'WEB_PAGE_TO_ROOT', '' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'phpids' ) );

if( !IsLoggedIn() ) {	// The user shouldn't even be on this page
	//MessagePush( "You were not logged in" );
	Redirect( 'login.php' );
}

Logout();
MessagePush( "You have logged out" );
Redirect( 'login.php' );

?>

