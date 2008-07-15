<?php

function cli_runcommand($txtCommand) {
	global $astman;

	if ($astman) {

		$html_out = "<pre>";
		$response = $astman->send_request('Command',array('Command'=>"$txtCommand"));
		$response = explode("\n",$response['data']);
		unset($response[0]); //remove the Priviledge Command line
		$response = implode("\n",$response);
		$html_out .= $response;
		$html_out .= "</pre>";
		return $html_out;
	}
}
?>
