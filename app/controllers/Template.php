<?php
/**
 * Pages
 */
class Template extends Controller
{
	private $salt = SECURE_SALT;
	
	function __construct()
	{
		$this->adminModel = $this->model('AdminControl');
	}

	public function sendConfirmation(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {		
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$application = $this->adminModel->getUserPendingApplication(trim($_POST['id']));

		$data = [
			'user' => $application
		];
		$email = $data['user'][0]->email;
		$name = $data['user'][0]->firstname . ' ' . $data['user'][0]->lastname;
		$body = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\"><html data-editor-version=\"2\" class=\"sg-campaigns\" xmlns=\"http://www.w3.org/1999/xhtml\"><head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1\">
		<!--[if !mso]><!-->
		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\">
		<!--<![endif]-->
		<!--[if (gte mso 9)|(IE)]>
		<xml>
		  <o:OfficeDocumentSettings>
			<o:AllowPNG/>
			<o:PixelsPerInch>96</o:PixelsPerInch>
		  </o:OfficeDocumentSettings>
		</xml>
		<![endif]-->
		<!--[if (gte mso 9)|(IE)]>
	<style type=\"text/css\">
	  body {width: 600px;margin: 0 auto;}
	  table {border-collapse: collapse;}
	  table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
	  img {-ms-interpolation-mode: bicubic;}
	</style>
	<![endif]-->
		<style type=\"text/css\">
	  body, p, div {
		font-family: arial,helvetica,sans-serif;
		font-size: 14px;
	  }
	  body {
		color: #000000;
	  }
	  body a {
		color: #1188E6;
		text-decoration: none;
	  }
	  p { margin: 0; padding: 0; }
	  table.wrapper {
		width:100% !important;
		table-layout: fixed;
		-webkit-font-smoothing: antialiased;
		-webkit-text-size-adjust: 100%;
		-moz-text-size-adjust: 100%;
		-ms-text-size-adjust: 100%;
	  }
	  img.max-width {
		max-width: 100% !important;
	  }
	  .column.of-2 {
		width: 50%;
	  }
	  .column.of-3 {
		width: 33.333%;
	  }
	  .column.of-4 {
		width: 25%;
	  }
	  @media screen and (max-width:480px) {
		.preheader .rightColumnContent,
		.footer .rightColumnContent {
		  text-align: left !important;
		}
		.preheader .rightColumnContent div,
		.preheader .rightColumnContent span,
		.footer .rightColumnContent div,
		.footer .rightColumnContent span {
		  text-align: left !important;
		}
		.preheader .rightColumnContent,
		.preheader .leftColumnContent {
		  font-size: 80% !important;
		  padding: 5px 0;
		}
		table.wrapper-mobile {
		  width: 100% !important;
		  table-layout: fixed;
		}
		img.max-width {
		  height: auto !important;
		  max-width: 100% !important;
		}
		a.bulletproof-button {
		  display: block !important;
		  width: auto !important;
		  font-size: 80%;
		  padding-left: 0 !important;
		  padding-right: 0 !important;
		}
		.columns {
		  width: 100% !important;
		}
		.column {
		  display: block !important;
		  width: 100% !important;
		  padding-left: 0 !important;
		  padding-right: 0 !important;
		  margin-left: 0 !important;
		  margin-right: 0 !important;
		}
	  }
	</style>
		<!--user entered Head Start--><!--End Head user entered-->
	  </head>
	  <body>
		<center class=\"wrapper\" data-link-color=\"#1188E6\" data-body-style=\"font-size:14px; font-family:arial,helvetica,sans-serif; color:#000000; background-color:#FFFFFF;\">
		  <div class=\"webkit\">
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\" class=\"wrapper\" bgcolor=\"#FFFFFF\">
			  <tbody><tr>
				<td valign=\"top\" bgcolor=\"#FFFFFF\" width=\"100%\">
				  <table width=\"100%\" role=\"content-container\" class=\"outer\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
					<tbody><tr>
					  <td width=\"100%\">
						<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
						  <tbody><tr>
							<td>
							  <!--[if mso]>
								<center>
								<table><tr><td width=\"600\">
								<![endif]-->
									  <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"width:100%; max-width:600px;\" align=\"center\">
										<tbody><tr>
										  <td role=\"modules-container\" style=\"padding:0px 0px 0px 0px; color:#000000; text-align:left;\" bgcolor=\"#FFFFFF\" width=\"100%\" align=\"left\"><table class=\"module preheader preheader-hide\" role=\"module\" data-type=\"preheader\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;\">
											<tbody><tr>
												<td role=\"module-content\">
												<p></p>
												</td>
											</tr>
											</tbody></table><table class=\"module\" role=\"module\" data-type=\"text\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"90a90e62-9d1d-4116-89ff-241cb3673097\" data-mc-module-version=\"2019-10-22\">
											<tbody>
												<tr>
												<td style=\"padding:18px 0px 18px 0px; line-height:30px; text-align:inherit;\" height=\"100%\" valign=\"top\" bgcolor=\"\" role=\"module-content\"><div><h2 style=\"text-align: center\">Congratulations</h2><div></div></div></td>
												</tr>
											</tbody>
											</table><table class=\"module\" role=\"module\" data-type=\"text\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"table-layout: fixed;\" data-muid=\"c8a6b10a-d951-4d8b-9468-8b8ac55d2a54\" data-mc-module-version=\"2019-10-22\">
											<tbody>
												<tr>
												<td style=\"padding:18px 0px 18px 0px; line-height:22px; text-align:inherit;\" height=\"100%\" valign=\"top\" bgcolor=\"\" role=\"module-content\"><div><div style=\"font-family: inherit; text-align: inherit\">Good day " . $data['user'][0]->username . "!<br/><br/> Your application to <em>Kasambahay </em>Is now approve. Please use your credentials during your registration to go to you account.</div><div></div></div></td>
												</tr>
											</tbody>
											</table><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"module\" data-role=\"module-button\" data-type=\"button\" role=\"module\" style=\"table-layout:fixed;\" width=\"100%\" data-muid=\"ef6ab3b1-ba0c-4325-8c02-6e5616b3ed71\">
												<tbody>
												<tr>
													<td align=\"center\" bgcolor=\"\" class=\"outer-td\" style=\"padding:0px 0px 0px 0px;\">
													<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper-mobile\" style=\"text-align:center;\">
														<tbody>
														<tr>
														<td align=\"center\" bgcolor=\"#57b846\" class=\"inner-td\" style=\"border-radius:6px; font-size:16px; text-align:center; background-color:inherit;\">
															<a href=\"http://192.168.0.22/sf_kasambahay/pages/login\" style=\"background-color:#57b846; border:1px solid #57b846; border-color:#57b846; border-radius:35px; border-width:1px; color:#ffffff; display:inline-block; font-size:14px; font-weight:normal; letter-spacing:0px; line-height:normal; padding:12px 44px 12px 48px; text-align:center; text-decoration:none; border-style:solid;\" target=\"_blank\">Login</a>
														</td>
														</tr>
														</tbody>
													</table>
													</td>
												</tr>
												</tbody>
											</table></td>
										</tr>
									  </tbody></table>
									  <!--[if mso]>
									</td>
								  </tr>
								</table>
							  </center>
							  <![endif]-->
							</td>
						  </tr>
						</tbody></table>
					  </td>
					</tr>
				  </tbody></table>
				</td>
			  </tr>
			</tbody></table>
		  </div>
		</center> 
	</body></html>";
		$subject = "Application COnfirmation";
	
		$headers = array(
			'Authorization: Bearer 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',
			'Content-Type: application/json'
		);
	
		$data = array(
			"personalizations" => array(
				array(
					"to" => array(
						array(
							"email" => $email,
							"name" => $name
						)
					)
				)
			),
			"from" => array(
				"email" => "kasambahay@support.com"
			),
			"subject" => $subject,
			"content" => array(
				array(
					"type" => "text/html",
					"value" => $body
				)
			)
		);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
	
		echo json_encode($data);
		}
    }
}