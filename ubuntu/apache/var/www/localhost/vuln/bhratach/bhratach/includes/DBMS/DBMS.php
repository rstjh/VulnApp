<?php

/*

This file contains all of the database management code for DVWA.
All code related to database management should be kept in here.

*/

### MySQL ###
if ($DBMS == 'MySQL') {
 $DBMS = htmlspecialchars(strip_tags($DBMS));
 $DBMS_errorFunc = mysql_error();
 
 function escapeString( $var ) {
  $var = mysql_real_escape_string( $var );
  return $var;
 }
 
 function db_login( $user,$pass )  {
  $login = "SELECT * FROM `users` WHERE user='$user' AND password='$pass';";

	$result = @mysql_query($login) or die('<pre>' . mysql_error() . '</pre>' );

	if( $result && mysql_num_rows( $result ) == 1 ) {	// Login Successful...
		MessagePush( "You have logged in as '".$user."'" );
		Login( $user );
		Redirect( 'index.php' );
		}
 }
}
### END MySQL ###

### PGSQL ###
elseif ($DBMS == 'PGSQL') {
 $DBMS = htmlspecialchars(strip_tags($DBMS));
 $DBMS_errorFunc = @pg_last_error();
 
 function escapeString( $var ) {
  $var = pg_escape_string( $var );
  return $var;
 }
 
 function db_login( $user,$pass ) {
    $login = "SELECT * FROM users WHERE username='$user' AND password='$pass';";
  
  $result = @pg_query( $login ) or die('<pre>' . pg_last_error() . '</pre>');
  
  if($result && pg_num_rows( $result ) == 1) {	// Login Successful...
   MessagePush( "You have logged in as '".$user."'" );
   Login( $user );
   Redirect( 'index.php' );
  }
 }
}
### END PGSQL ###

### INVALID DBMS ###
else {
 $DBMS = "No DBMS selected.";
 $DBMS_errorFunc = '';
}
### END INVALID ###

$DBMS_connError = '<div align="center">
		<img src="'.WEB_PAGE_TO_ROOT.'bhratach/images/logo.png">
		<pre>Unable to connect to the database.<br>'.$DBMS_errorFunc.'<br /><br /></pre>
		Click <a href="'.WEB_PAGE_TO_ROOT.'setup.php">here</a> to setup the database.
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
		$dbconn = @pg_connect("host=".$_BHRATACH[ 'db_server' ]." port=".$_BHRATACH[ 'db_port' ]." dbname=".$_BHRATACH[ 'db_database' ]." user=".$_BHRATACH[ 'db_user' ]." password=".$_BHRATACH[ 'db_password' ]) 
		or die( $DBMS_connError );
	}
}

// -- END

?>
