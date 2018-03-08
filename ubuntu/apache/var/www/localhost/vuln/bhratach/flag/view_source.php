<?php

define( 'WEB_PAGE_TO_ROOT', '../' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Source';

$id = $_GET[ 'id' ];
$security = $_GET[ 'security' ];


if ($id == 'fi'){
	$vuln = 'File Inclusion';
}
elseif ($id == 'brute'){
	$vuln = 'Brute Force';
}
elseif ($id == 'csrf'){
	$vuln = 'CSRF';
}
elseif ($id == 'exec'){
	$vuln = 'Command Execution';
}
elseif ($id == 'sqli'){
	$vuln = 'SQL Injection';
}
elseif ($id == 'sqli_blind'){
	$vuln = 'SQL Injection (Blind)';
}
elseif ($id == 'upload'){
	$vuln = 'File Upload';
}
elseif ($id == 'xss_r'){
	$vuln = 'Reflected XSS';
}
else {
	$vuln = 'Stored XSS';
}


$source = @file_get_contents( WEB_PAGE_TO_ROOT."flag/{$id}/source/{$security}.php" );
$source = str_replace( array( '$html .=' ), array( 'echo' ), $source );

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>".$vuln." Source</h1>
	
	<div id=\"code\">
	<table width='100%' bgcolor='white' style=\"border:2px #C0C0C0 solid\">
	<tr>
	<td><div id=\"code\">".highlight_string( $source, true )."</div></td>
	</tr>
	</table>
	
	</div>
	
	<br />
	<br />
	
	<FORM><INPUT TYPE=\"BUTTON\" VALUE=\"Compare\" ONCLICK=\"window.location.href='view_source_all.php?id=$id'\">
</FORM>

</div>
";

dvwaSourceHtmlEcho( $page );

?>
