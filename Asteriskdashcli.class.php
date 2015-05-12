<?php
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2013 Schmooze Com Inc.
namespace FreePBX\modules;
class Asteriskdashcli implements \BMO {
	public function __construct($freepbx = null) {
		if ($freepbx == null) {
			throw new Exception("Not given a FreePBX Object");
		}
		$this->FreePBX = $freepbx;
		$this->AstMan = $freepbx->astman;
	}
	public function install() {}
	public function uninstall() {}
	public function backup() {}
	public function restore($backup) {}
	public function doConfigPageInit($page) {}
	public function ajaxRequest($req, &$setting) {
		if ($req == "clicmd") {
			return true;
		}
		return false;
	}

	public function ajaxHandler() {
		if ($_REQUEST['command'] == "clicmd") {
			$res = $this->cli_runcommand($_REQUEST['data']);
			return json_encode($res);
		}
	}

	/**
	 * This function is a modified version of what was in the original asterisk-cli module
	 * With Copyright (C) 2005, Xorcom
	 * Written by Diego Iastrubni <diego.iastrubni@xorcom.com>
	 * Copyright (C) 2005, Xorcom
	 * This function was derived from ASTLinux 0.3
	 * The original author of AST linux is:
	 * Kristian Kielhofner - KrisCompanies, LLC - http://astlinux.org/
	 */
	public function cli_runcommand($txtCommand) {
		if ($this->AstMan) {
			$response = $this->AstMan->send_request('Command',array('Command'=>"$txtCommand"));
			if(!empty($response['data'])) {
				$response = explode("\n",$response['data']);
				unset($response[0]); //remove the Priviledge Command line
				$response = implode("\n",$response);
				$html_out = htmlspecialchars($response);
				return $html_out;
			} else {
				return _("No Output Returned");
			}

		}
	}
}
