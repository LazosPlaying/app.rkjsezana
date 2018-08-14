<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/phpmailer/Exception.php';
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';
require_once __DIR__ . '/settings.nogit.php';

class mail extends settingsPHPMailer {

	public function send($data){
		if (
			isset($data) &&
			isset($data['from']['addr']) &&
			isset($data['from']['name']) &&
			isset($data['to']['addr']) &&
			isset($data['to']['name']) &&
			isset($data['content']['title']) &&
			isset($data['content']['subject']) &&
			isset($data['content']['html']) &&
			isset($data['content']['nohtml'])
		){

			$email_html = file_get_contents(__DIR__.'/phpmailer/template.htm');
			$email_html = str_replace("{{title}}", $data['content']['title'], $email_html);
			$email_html = str_replace("{{html}}", $data['content']['html'], $email_html);
			$email_html = str_replace("{{subject}}", $data['content']['subject'], $email_html);

			$mail = new PHPMailer(true);                              					// Passing `true` enables exceptions
			try {
				//Server settings
				$mail->SMTPDebug = 0;                                 					// Enable verbose debug output
				$mail->isSMTP();                                      					// Set mailer to use SMTP
				$mail->Host = $this->mailHost;  										// Specify main and backup SMTP servers									From settings.nogit.php
				$mail->SMTPAuth = $this->mailSMTPAuth;                               	// Enable SMTP authentication											From settings.nogit.php
				$mail->Username = $this->mailUsername;                 				// SMTP username														From settings.nogit.php
				$mail->Password = $this->mailPassword;      							// SMTP password														From settings.nogit.php
				$mail->SMTPSecure = $this->mailSMTPSecure;                           	// Enable TLS encryption, `ssl` also accepted							From settings.nogit.php
				$mail->Port = $this->mailPort;                                    		// TCP port to connect to												From settings.nogit.php
				$mail->CharSet = 'UTF-8';

				//Recipients
				$mail->setFrom($data['from']['addr'], $data['content']['title']);
				$mail->addAddress($data['to']['addr'], $data['to']['name']);	// Add a recipient

				//Content
				$mail->isHTML(true);                                  			// Set email format to HTML
				$mail->Subject = $data['content']['subject'];
				$mail->Body    = $email_html;
				$mail->AltBody = $data['content']['nohtml'];

				$mail->send();
				return array(
					'is_success' => true,
					'code' => 200,
					'message' => 'Message has been sent'
				);
			} catch (Exception $e) {
				return array(
					'is_success' => false,
					'code' => 500,
					'message' => $mail->ErrorInfo
				);
			}

		} else {
			return array(
				'is_success' => false,
				'code' => 500,
				'message' => 'one or more parametrers are missing'
			);
		}
	}
}
