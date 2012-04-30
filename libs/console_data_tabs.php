<?php

	/**

	Console Data Tabs

	- returns tab data to render

	i = ID
		- alarm (tab: console-alarms) -- not used, this was a test!
		- config (tab: console-config)
		- cnt (tab: console-new-user {manual web hook entry} )	

	**/

	function myjsonmsg($buffer) { // jquery is expecting a JSON output :)

		$output = array();
		$output['msg'] = $buffer;

		$output = json_encode($output);

		return $output;

	}

	ob_start('myjsonmsg'); // buffer the scripts below, then send to callback for JSNON-ISZING

	switch ($_REQUEST['i']) {
		case "alarms":
			require_once('../libs/console_tab_alarms.php');	// user's console alarms
			break;
		case "config":
			require_once('../libs/console_tab_config.php'); // Config Tab.
			break;
		case "cnt":
			require_once('../libs/console_modal_newuser_manual.php'); // Manual WebHook Tabe for New Users		
			break;
		default:
			die('404: Data not found');
	}

	

	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header('Content-Type: text/javascript');

	ob_end_flush(); // output the PHP from ^above^ require statements as a JSON String.

?>