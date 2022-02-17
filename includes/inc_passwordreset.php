<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $errors = array();
    if(isset($_POST['submit'])):
        //include database connection
        include 'User.php';
        $user = new User();
        //escape user input
        $email = $user->escape_string($_POST['email']);
        //validate email address
        if(empty($email)):
            $errors['email'] = "This field is required";
        else:
            $email = $user->test_input($email);
            $display_name = strpos($email, "@");
            $display_name = substr($email, 0, $display_name);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $errors['email'] = "Invalid email format";
            endif;
        endif;
        if(count($errors) == 0):
            $query = "SELECT customer_id FROM customers WHERE email = '$email' LIMIT 1";
            $row = $user->details($query);
            if($row):
                $sql = "SELECT * FROM passwordreset WHERE email = '$email' LIMIT 1";
                $row = $user->details($sql);
                if($row):
                    $message = "An e-email with instructions to create a new password has already been sent to you.";
                else:
                    $token = md5(2418*2) . $email;
                    $addkey = substr(md5(uniqid(rand(),1)),3,10);
                    $token = $token . $addkey;
                    $expformat = mktime(date("H")+1,date("i"),date("s"),date("m"),date("d"),date("Y"));
                    $expdate = date("Y-m-d H:i:s",$expformat);
                    $query = "INSERT INTO passwordreset (email,token,exp_time) VALUES ('$email','$token','$expdate')";
                    $results = $user->insert($query);
                    if($results):
                        require_once 'mail/Exception.php';
                        require_once 'mail/PHPMailer.php';
                        require_once 'mail/SMTP.php';

                        $mail = new PHPMailer(true);
                        try {
                        $mail->SMTPDebug = 0;                               // Enable verbose debug output

                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = 'sivatech234@gmail.com';                 // SMTP username
                        $mail->Password = 'Scientia234#';                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom('admin@cartzilla.com', 'Cartzilla');
                        $mail->addAddress($email);    // Add a recipient
                        //$mail->addAddress('ellen@example.com');               // Name is optional
                        //$mail->addReplyTo('admin@qordinatesmobile.com');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');

                        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = "Password Reset Request For Cartzilla";//$_POST['subject'];
                        $mail->Body    = "
                        <!DOCTYPE html>
                        <html lang='en-US'>
                            <head>
                                <meta charset='utf-8'>
                                <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
                                <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
                                <link href=\"https://fonts.googleapis.com/css2?family=Comforter&display=swap\" rel=\"stylesheet\">
                            </head>
                            <body style=\"font-family: 'Comforter', cursive;\">
                                <div style='border:2px solid red;padding:50px 0'>
                                    <div style='padding:30px 40px;border:2px solid black;'>
                                        <h3>Password Reset Request</h3>
                                    </div>
                                    <div style=\"padding:30px 40px;border:2px solid black;\">
                                        <h2>Hi {$display_name},</h2>
                                        <p>Someone has requested a new password for the following account on Cartzilla:</p>
                                        <p>Username: {$display_name}</p>
                                        <p>If you didn't make this request, just ignore this email. If you'd like to proceed: </p>
                                        <p><a href=\"http://192.168.43.85/lance/changepassword.php?token=$token&email=$email\">Click here to reset your password</a></p>
                                        <p>Thanks for reading.</p>
                                    </div>
                                    <div class=''>
                                        <p>Cartzilla</p>
                                    </div>
                                </div>
                            </body>
                        </html>"; 
                                        
                        //$mail->AltBody = $_POST['message'];

                        $mail->smtpConnect([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            ]
                        ]);

                        $mail->send();
                        $message = "An e-email with instructions to create a new password has been sent to you.";
                        } 
                        catch(Exception $e){
                            echo "Message could not be sent: {$mail->ErrorInfo}";
                        }
                    endif;
                endif;
            endif;
        endif;
    endif;
?>