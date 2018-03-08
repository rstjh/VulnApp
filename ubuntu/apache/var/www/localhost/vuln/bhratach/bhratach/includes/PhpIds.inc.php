<?php

if( !defined( 'WEB_PAGE_TO_ROOT' ) ) {
	define( 'System error- WEB_PAGE_TO_ROOT undefined' );
	exit;
}

define( 'WEB_ROOT_TO_PHPIDS', 'external/phpids/'.PhpIdsVersionGet().'/' );
define( 'WEB_PAGE_TO_PHPIDS', WEB_PAGE_TO_ROOT.WEB_ROOT_TO_PHPIDS );

// Add PHPIDS to include path
set_include_path( get_include_path().PATH_SEPARATOR.WEB_PAGE_TO_PHPIDS.'lib/' );

require_once 'IDS/Init.php';

function PhpIdsVersionGet() {
	return '0.6';
}

// PHPIDS Log parsing function 
function ReadIdsLog() {

	$file_array = file(WEB_ROOT_TO_PHPIDS_LOG);
	
	$data = '';

	foreach ($file_array as $line_number => $line){
		$line = explode(",", $line);
		$line = str_replace("\""," ",$line);
		
		$datetime = $line[1];
		$vulnerability = $line[3];
		$variable = urldecode($line[4]);
		$request = urldecode($line[5]);
		$ip = $line[6];
		
		$data .= "<div id=\"idslog\"><b>Date/Time:</b> " . $datetime . "<br /><b>Vulnerability:</b> " . $vulnerability . "<br /><b>Request:</b> " . htmlspecialchars($request) . "<br /><b>Variable:</b> " . htmlspecialchars($variable) . "<br /><b>IP:</b> " . $ip . "</div>";
	}

return $data;
}

// Clear PHPIDS log
function ClearIdsLog()	{
	if (isset($_GET['clear_log'])) { 
		$fp = fopen(WEB_ROOT_TO_PHPIDS_LOG, w);
		fclose($fp);
		MessagePush( "PHPIDS log cleared" );
		PageReload();
	}
}

// Main PHPIDS function
function PhpIdsTrap() {
	try {
		$request = array(
			'REQUEST' => $_REQUEST,
			'GET' => $_GET,
			'POST' => $_POST,
			'COOKIE' => $_COOKIE
		);

		$init = IDS_Init::init( WEB_PAGE_TO_PHPIDS.'lib/IDS/Config/Config.ini' );

		$init->config['General']['base_path'] = WEB_PAGE_TO_PHPIDS.'lib/IDS/';
		$init->config['General']['use_base_path'] = true;
		$init->config['Caching']['caching'] = 'none';

		// 2. Initiate the PHPIDS and fetch the results
		$ids = new IDS_Monitor( $request, $init );
		$result = $ids->run();

		if (!$result->isEmpty()) {
			require_once 'IDS/Log/File.php';
			require_once 'IDS/Log/Composite.php';

			$compositeLog = new IDS_Log_Composite();
			$compositeLog->addLogger(IDS_Log_File::getInstance($init));
			
			$compositeLog->execute($result);
			
			echo 'Hacking attempt detected and logged.';

			//echo $result;
			exit;
		}
	} catch (Exception $e) {
		/*
		* something went terribly wrong - maybe the
		* filter rules weren't found?
		*/
		printf(
			'An error occured: %s',
			$e->getMessage()
		);
	}
}

?>
