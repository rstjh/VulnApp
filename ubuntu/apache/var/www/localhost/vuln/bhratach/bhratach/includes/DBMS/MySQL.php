<?php

/*

This file contains all of the code to setup the initial MySQL database. (setup.php)

*/

if( !@mysql_connect( $_BHRATACH[ 'db_server' ], $_BHRATACH[ 'db_user' ], $_BHRATACH[ 'db_password' ] ) ) {
	MessagePush( "Could not connect to the database - please check the config file." );
	PageReload();
}

// Create database
$drop_db = "DROP DATABASE IF EXISTS bhratach;";
if( !@mysql_query ( $drop_db ) ) {
	MessagePush( "Could not drop existing database<br />SQL: ".mysql_error() );
	PageReload();
}

$create_db = "CREATE DATABASE bhratach;";

if( !@mysql_query ( $create_db ) ) {
	MessagePush( "Could not create database<br />SQL: ".mysql_error() );
	PageReload();
}

MessagePush( "Database has been created." );

// Create table 'users'
if( !@mysql_select_db( $_BHRATACH[ 'db_database' ] ) ) {
	MessagePush( 'Could not connect to database.' );
	PageReload();
}

$create_tb = "CREATE TABLE users (user_id int(6),first_name varchar(15),last_name varchar(15), user varchar(15), password varchar(32),avatar varchar(70), PRIMARY KEY (user_id));";
if( !mysql_query( $create_tb ) ){
	MessagePush( "Table could not be created<br />SQL: ".mysql_error() );
	PageReload();
}

MessagePush( "'users' table was created." );

// Insert some data into users

// Get the base directory for the avatar media...
$baseUrl = 'http://'.$_SERVER[ 'SERVER_NAME' ].$_SERVER[ 'PHP_SELF' ];
$stripPos = strpos( $baseUrl, 'setup.php' );
$baseUrl = substr( $baseUrl, 0, $stripPos ).'hackable/users/';

$insert = "INSERT INTO users VALUES
	('1','admin','admin','admin',MD5('password'),'{$baseUrl}admin.jpg'),
	('2','Fred','Brown','fred',MD5('Alm0st.Th3r3!'),'{$baseUrl}gordonb.jpg'),
	('3','Lara','Croft','lara',MD5('H3lpM356'),'{$baseUrl}1337.jpg'),
	('4','Brian','Picasso','brian',MD5('IAMHAPPY'),'{$baseUrl}pablo.jpg'),
	('5','Bob','Smith','smithy',MD5('password'),'{$baseUrl}smithy.jpg');";
if( !mysql_query( $insert ) ){
	MessagePush( "Data could not be inserted into 'users' table<br />SQL: ".mysql_error() );
	PageReload();
}
MessagePush( "Data inserted into 'users' table." );
	
// Create guestbook table
$create_tb_guestbook = "CREATE TABLE guestbook (comment_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT, comment varchar(300), name varchar(100), PRIMARY KEY (comment_id));";
	
if( !mysql_query( $create_tb_guestbook ) ){
	MessagePush( "Table could not be created<br />SQL: ".mysql_error() );
	PageReload();
}
	
MessagePush( "'guestbook' table was created." );
	
// Insert data into 'guestbook'
$insert = "INSERT INTO guestbook VALUES
('1','This is a test comment.','test');";
	
if( !mysql_query( $insert ) ){
	MessagePush( "Data could not be inserted into 'guestbook' table<br />SQL: ".mysql_error() );
	PageReload();
}
MessagePush( "Data inserted into 'guestbook' table." );

MessagePush( "Setup successful!" );
PageReload();

?>
