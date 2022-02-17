<?php
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.paddifysolutions.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@paddifysolutions.com';                 // SMTP username
        $mail->Password = 'Paddifys234#';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('info@paddifysolutions.com', 'Cartzilla');
        $mail->addAddress($email);    // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('info@paddifysolutions.com');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML


        $mail->Subject = $subject;//$_POST['subject'];
        //$mail->Body    = "</br>"; //'This is the HTML message body <b>in bold!</b>';
        $mail->Body = $body;  
        //$mail->AltBody = $_POST['message'];

        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        $mail->send();
        echo "Message has been sent";   
    } 
    catch(Exception $e){
        echo "Message could not be sent: {$mail->ErrorInfo}";
    }
?>