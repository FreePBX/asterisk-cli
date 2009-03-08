<?php
//This file is part of FreePBX.
//
//    FreePBX is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 2 of the License, or
//    (at your option) any later version.
//
//    FreePBX is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with FreePBX.  If not, see <http://www.gnu.org/licenses/>.
//
//  Written by Diego Iastrubni <diego.iastrubni@xorcom.com>
//  Copyright (C) 2005, Xorcom
//
//  This code is derived from ASTLinux 0.3
//
//  The original author of AST linux is:
//  Kristian Kielhofner - KrisCompanies, LLC - http://astlinux.org/
//

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
