<?php

# If you are having problems connecting to the MySQL database and all of the variables below are correct
# try changing the 'db_server' variable from localhost to 127.0.0.1. Fixes a problem due to sockets.
# Thanks to digininja for the fix.

# Database management system to use

$DBMS = 'MySQL';
#$DBMS = 'PGSQL';

# Database variables

$_BHRATACH = array();
$_BHRATACH[ 'db_server' ] = 'localhost';
$_BHRATACH[ 'db_database' ] = 'bhratach';
$_BHRATACH[ 'db_user' ] = 'root';
$_BHRATACH[ 'db_password' ] = '';

# Only needed for PGSQL
$_BHRATACH[ 'db_port' ] = '5432'; 

?>
