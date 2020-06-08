<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 2);
require '../PHPMailerAutoload.php';
$msg = "aaaaa";
        $mail = new PHPMailer;
        $mail->IsHTML(true);
        $mail->setFrom('diasporacampaigns@co-opbank.co.ke', 'Coop Diaspora');
        $mail->addAddress('derrick.wesonga@zilojo.com', 'Derrick');
        $mail->addCC('wesongaderrick@gmail.com', 'Derrick');

        // $mail->addAddress('emkimathi@co-opbank.co.ke', 'Eliud Kimathi');
        // $mail->addAddress('pgathu@co-opbank.co.ke', 'Peris Gathu');
        // $mail->addAddress('diasporacampaigns@co-opbank.co.ke');
        // $mail->addAddress('pgathu@co-opbank.co.ke');



        $mail->Subject = 'Mail test';
        $mail->Body = '<b>This is a test email</b>. If you receive this, <strong>please</strong> foward to derrick.wesonga@zilojo.com';

        // Attach the uploaded file
        $uploadfile = "test.pdf";
        $mail->addAttachment($uploadfile, 'My uploaded file');
        if (!$mail->send()) {
            $msg .= "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $msg .= "Message sent!";
        }
        echo $msg;

?>