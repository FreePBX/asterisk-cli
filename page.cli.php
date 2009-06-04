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
$txtCommand = isset($_POST['txtCommand'])?$_POST['txtCommand']:'';

$tabindex = 0;
?>

<h2><?php echo _("Asterisk CLI")?></h2>

<form action="config.php?type=tool&display=cli" method="POST" enctype="multipart/form-data" name="frmExecPlus">
	<table>
		<tr>
			<td class="label" align="right"><?php echo _("Command:")?></td>
			<td class="type"><input name="txtCommand" type="text" size="70" value="<?php htmlspecialchars($txtCommand);?>" tabindex="<?php echo ++$tabindex;?>"></td>
		</tr>
		
		<tr>
			<td valign="top">   </td>
			<td valign="top" class="label">
				<input type="submit" class="button" value="<?php echo _("Execute:")?>" tabindex="<?php echo ++$tabindex;?>">
			</td>
		</tr>
		
		<tr>
			<td height="8"></td>
			<td></td>
		</tr>
	</table>
</form>

<p>
<?php if (isBlank($txtCommand)): ?>
</p>
<?php endif; 

function isBlank( $arg ) { return ereg( "^\s*$", $arg ); }

if (!isBlank($txtCommand))
{
	$html_out = cli_runcommand($txtCommand);
	echo $html_out;
}

?>

