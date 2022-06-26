<?php
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2014 Schmooze Com Inc.
//
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="fpbx-container">
				<div class="display no-border">
					<div class="container-fluid">
						<div class="section-title" data-for="asteriskcli">
							<h3><?php echo _("Asterisk CLI") ?></h3>
						</div>
						<div class="row">
							<div class="section col-md-12" data-id="asteriskcli">
								<div class="element-container">
									<div class="row">
										<div class="col-md-12">
											<div class="">
												<div class="row form-group">
													<div class="col-md-3">
														<label class="control-label" for="astcmd"><?PHP echo _("CLI Command") ?></label>
													</div>
													<div class="col-md-9">
														<div class="input-group">
															<input type="text" class="form-control typeaheadd" id="astcmd">
															<span class="input-group-btn">
																<button class="btn btn-default" id="send" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i> <?php echo _('Send Command')?></button>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class = "output">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
