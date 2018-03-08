<?php

define( 'WEB_PAGE_TO_ROOT', '../../' );
require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();
$page[ 'title' ] .= $page[ 'title_separator' ].'Message Forum';
$page[ 'page_id' ] = 'Information';

DatabaseConnect();

$vulnerabilityFile = 'low.php';


require_once WEB_PAGE_TO_ROOT."flag/xss_s/source/{$vulnerabilityFile}";

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h1>Message Forum</h1>

	<div class=\"vulnerable_code_area\">

		<form method=\"post\" name=\"guestform\" onsubmit=\"return validate_form(this)\">
		<table width=\"550\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\">
		<tr>
		<td width=\"100\">Name *</td> <td>
		<input name=\"txtName\" type=\"text\" size=\"30\" maxlength=\"10\"></td>
		</tr>
		<tr>
		<td width=\"100\">Message *</td> <td>
		<textarea name=\"mtxMessage\" cols=\"50\" rows=\"3\" maxlength=\"50\"></textarea></td>
		</tr>
		<tr>
		<td width=\"100\">&nbsp;</td>
		<td>
		<input name=\"btnSign\" type=\"submit\" value=\"Enter Message\" onClick=\"return checkForm();\"></td>
		</tr>
		</table>
		</form>

		{$html}
		
	</div>
	
	<br />
	
	".dvwaGuestbook()."
	<br />
	

</div>
";


HtmlEcho( $page );
?>
