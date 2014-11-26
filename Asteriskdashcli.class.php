<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2013 Schmooze Com Inc.
$setting = array('authenticate' => true, 'allowremote' => false);
class Asteriskdashcli implements BMO {
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
	/* This function is a modified version of what was in the asterisk-cli module
	 * With Copyright (C) 2005, Xorcom
	 */
	public function cli_runcommand($txtCommand) {
		if ($this->AstMan) {
			$response = $this->AstMan->send_request('Command',array('Command'=>"$txtCommand"));
			$response = explode("\n",$response['data']);
			unset($response[0]); //remove the Priviledge Command line
			$response = implode("\n",$response);
			$html_out .= htmlspecialchars($response);
			return $html_out;
		}
	}
	public function getActionBar($request) {
        $buttons = array();
        switch($request['display']) {
            case 'clitool':
                $buttons = array(
                    'delete' => array(
                        'name' => 'CLIcmd',
                        'id' => 'send',
                        'value' => _('Send Command')
                        )
                       );
            break;
        }
        return $buttons;
    }    
}
