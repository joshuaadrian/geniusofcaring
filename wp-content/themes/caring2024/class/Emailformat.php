<?php

class Emailformat {

    public $recipient_email_address;
    public $recipient_name;
    public $sender_email_address;
    public $sender_name;
    public $subject;
    public $message;
	public $cta;
	public $email_header;
	public $email_header_to_content;
	public $email_content_to_cta;
	public $email_footer;
	
	function __construct(){
		$this->email_header = '
			<div style="margin:0;padding:0;background-color:#ffffff;min-height:100%!important;width:100%!important" marginheight="0" marginwidth="0">
				<center>
					<table height="100%" cellspacing="0" cellpadding="0" border="0" width="100%" align="center" style="border-collapse:collapse;margin:0;padding:0;background-color:#ffffff;height:100%!important;width:100%!important">
						<tbody><tr>
							<td valign="top" align="center" style="margin:0;padding:20px;border-top:0;height:100%!important;width:100%!important">
								<table cellspacing="0" cellpadding="0" border="0" width="600" style="border-collapse:collapse;border:0">
									<tbody><tr>
										<td valign="top" align="center">
											<table cellspacing="0" cellpadding="0" border="0" width="600" style="border-collapse:collapse;background-color:#ffffff;border-top:0;border-bottom:0">
												<tbody><tr>
													<td valign="top" style="padding-top:9px"></td>
												</tr>
											</tbody></table>
										</td>
									</tr>
									<tr>
										<td valign="top" align="center">
											<table cellspacing="0" cellpadding="0" border="0" width="600" style="border-collapse:collapse;background-color:#ffffff;border-top:0;border-bottom:0">
												<tbody><tr>
													<td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse">
														<tbody>
																<tr>
																	<td valign="top" style="padding:9px">
																		<table cellspacing="0" cellpadding="0" border="0" width="100%" align="left" style="border-collapse:collapse">
																			<tbody><tr>
																				<td valign="top" style="padding-right:9px;padding-left:9px;padding-top:0;padding-bottom:0">
																					<img width="600" height="125"align="left" style="max-width:600px;height:auto;padding-bottom:0;display:inline!important;vertical-align:bottom;border:0;outline:none;text-decoration:none" src="https://gallery.mailchimp.com/0a7e7fabe77c4e3be776a0cbe/images/0ae913e4-676f-4ab4-81e6-920c29343185.png" alt="" class="CToWUd a6T" tabindex="0">
																				</td>
																			</tr>
																		</tbody></table>
																	</td>
																</tr>
														</tbody>
													</table><table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse">
														<tbody>
															<tr>
																<td style="padding:30px 18px">
																	<table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse">
																		<tbody><tr>
																			<td>
																				<span></span>
																			</td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody>
													</table></td>
												</tr>
											</tbody></table>
										</td>
									</tr>
									<tr>
										<td valign="top" align="center">
											<table cellspacing="0" cellpadding="0" border="0" width="600" style="border-collapse:collapse;background-color:#ffffff;border-top:0;border-bottom:0">
												<tbody><tr>
													<td valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse">
														<tbody>
															<tr>
																<td valign="top">
																	<table cellspacing="0" cellpadding="0" border="0" width="600" align="left" style="border-collapse:collapse">
																		<tbody><tr>
																			<td valign="top" style="padding-top:9px;padding-right:18px;padding-bottom:9px;padding-left:18px;color:#201e29;font-family:Helvetica;font-size:15px;line-height:150%;text-align:left">
																				<h1 style="margin:0;padding:0;display:block;font-family:Helvetica;font-size:20px;font-style:normal;font-weight:bold;line-height:200%;letter-spacing:normal;text-align:center;color:#201e29!important">';

		$this->email_header_to_content = '</h1>
																				<br>';

		$this->email_content_to_cta = '
																			</td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody>
													</table><table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse">
														<tbody>
															<tr>
																<td valign="top" align="center" style="padding-top:0;padding-right:18px;padding-bottom:18px;padding-left:18px">
																	<table cellspacing="0" cellpadding="0" border="0" style="border-collapse:separate!important;border-radius:5px;background-color:#db685f">
																		<tbody>
																			<tr>
																				<td valign="middle" align="center" style="font-family:Arial;font-size:14px;padding:20px">';
		$this->email_footer = '
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table><table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse">
														<tbody>
															<tr>
																<td style="padding:50px 18px">
																	<table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse">
																		<tbody><tr>
																			<td>
																				<span></span>
																			</td>
																		</tr>
																	</tbody></table>
																</td>
															</tr>
														</tbody>
													</table></td>
												</tr>
											</tbody></table>
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
					</tbody></table>
				</center>
			</div>';
	}
	
	public function create_cta($link,$text){
		$this->cta = '<a style="font-weight:bold;letter-spacing:normal;line-height:100%;text-align:center;text-decoration:none;color:#ffffff;word-wrap:break-word" title="' . $text . '" href="' . $link . '">' . $text . '</a>';
	}
	
	public function create_message($title,$message){
		$this->message = $this->email_header . $title . $this->email_header_to_content . $message . $this->email_content_to_cta . $this->cta . $this->email_footer;
	}
}
	
	
	
	
	
	
	
	
	
	