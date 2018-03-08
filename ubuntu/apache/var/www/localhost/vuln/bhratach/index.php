<?php

define( 'WEB_PAGE_TO_ROOT', '' );

require_once WEB_PAGE_TO_ROOT.'bhratach/includes/Page.inc.php';

PageStartup( array( 'authenticated', 'phpids' ) );

$page = PageNewGrab();

$page[ 'title' ] .= $page[ 'title_separator' ].'Welcome';

$page[ 'page_id' ] = 'home';

$page[ 'body' ] .= "
	<h1 class=\"title\">All our cruises</h1>
	<h2 class=\"subtitle\">Speak to your cruise concierge for further information</h2>
	<hr />
<div class=\"columns\">
    <div class=\"column\">
		<div class=\"card\">
			<div class=\"card-image\">
				<img src=\"bhratach/images/cruise-1.jpg\" alt=\"Image\">
			</div>
			<div class=\"card-content has-text-centered\">
				<h2 class=\"subtitle \">Titanic Voyage</h2>
				<p class=\"content\">Now all can follow follow in the final footsteps of the Titanic.</p>
					<span class=\"tag\">
						Belfast
					</span>
					<span class=\"tag\">
						Southampton
					</span>
					<span class=\"tag\">
						Cherbourg
					</span>
					<span class=\"tag\">
						Cork
					</span>
			</div>
		</div>
	</div>
	<div class=\"column\">
		<div class=\"card\">
			<div class=\"card-image\">
				<img src=\"bhratach/images/cruise-2.jpg\" alt=\"Image\">
			</div>
			<div class=\"card-content has-text-centered\">
				<h2 class=\"subtitle \">Emerald Isle</h2>
				<p class=\"content\">A pleasant journey taking in all major Irish cities.</p>
					<span class=\"tag\">
						Dublin
					</span>
					<span class=\"tag\">
						Belfast
					</span>
					<span class=\"tag\">
						Derry
					</span>
					<span class=\"tag\">
						Galway
					</span>
					<span class=\"tag\">
						Cork
					</span>
			</div>
		</div>
    </div>
	<div class=\"column\">
		<div class=\"card\">
			<div class=\"card-image\">
				<img src=\"bhratach/images/cruise-3.jpg\" alt=\"Image\">
			</div>
			<div class=\"card-content has-text-centered\">
				<h2 class=\"subtitle\">Spanish Armada</h2>
				<p class=\"content\">An exhilarating journey around the British Isles recreating Francis Drake's victory in 1588.</p>
				<span class=\"tag\">
					Portsmouth
				</span>
				<span class=\"tag\">
					Calais
				</span>
				<span class=\"tag\">
					Edinburgh
				</span>
				<span class=\"tag\">
					Derry
				</span>
				<span class=\"tag\">
					Galway
				</span>
				<span class=\"tag\">
					Cork
				</span>
			</div>
		</div>
    </div>
</div>";


HtmlEcho( $page );

?>
