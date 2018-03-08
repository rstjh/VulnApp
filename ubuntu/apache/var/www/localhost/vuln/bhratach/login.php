<?php

define( 'WEB_PAGE_TO_ROOT', '' );

require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'phpids' ) );

DatabaseConnect();

if( isset( $_POST[ 'Login' ] ) ) {


	$user = 'admin';
	$user = stripslashes( $user );
	$user = mysql_real_escape_string( $user );


	$pass = $_POST[ 'password' ];
	$pass = stripslashes( $pass );
	$pass = mysql_real_escape_string( $pass );
	$pass = 'password';
	$pass = md5( $pass );
	

	$qry = "SELECT * FROM `users` WHERE user='$user' AND password='$pass';";

	$result = @mysql_query($qry) or die('<pre>' . mysql_error() . '</pre>' );

	if( $result && mysql_num_rows( $result ) == 1 ) {	// Login Successful...

		MessagePush( "You have logged in as '".$user."'" );
		Login( $user );
		Redirect( 'index.php' );

	}

	// Login failed
	MessagePush( "Login failed" );
	Redirect( 'login.php' );
}

$messagesHtml = messagesPopAllToHtml();

Header( 'Cache-Control: no-cache, must-revalidate');		// HTTP/1.1
Header( 'Content-Type: text/html;charset=utf-8' );		// TODO- proper XHTML headers...
Header( "Expires: Tue, 23 Jun 2009 12:00:00 GMT");		// Date in the past

echo "

<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>Brhatach - Login</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"".WEB_PAGE_TO_ROOT."bhratach/css/login.css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".WEB_PAGE_TO_ROOT."bhratach/css/bulma.css\" />

	</head>

	<body>

	<div class=\"login-layout\">
		<div class=\"login-column column-centered\">
			<img src=\"bhratach/images/login-logo.png\" />
			<h1 class=\"subtitle\" style=\"margin-top:30px\">Guest dashboard</h1>
		</div>
		<div class=\"login-column\">
			<h2 class=\"subtitle\">Login to your account</h2>
				<form action=\"login.php\" class=\"control\" method=\"post\">
					<fieldset>
						<div class=\"field\">
							<label for=\"username\" class=\"label\">Username</label>
							<p class=\"control\">
								<input name=\"username\" class=\"input\" type=\"text\" placeholder=\"Username\">
							</p>
						</div>

						<div class=\"field\">
							<label for=\"password\" class=\"label\">Password</label>
							<p class=\"control\">
								<input name=\"password\" class=\"input\" type=\"text\" placeholder=\"Password\">
							</p>
						</div>
								
						<p class=\"control\"><input type=\"submit\" class=\"button is-primary\" value=\"Login\" name=\"Login\"></p>
					</fieldset>
				</form>
		</div>
	</div>
	{$messagesHtml}

	</body>

</html>
";

?>
