<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $errors = array();
    if(isset($_POST['submit'])):
        $csrf_token = $_POST['csrf_token'];
        if($csrf_token != $_SESSION['csrf_token']):
            //Reset token
            unset($_SESSION['csrf_token']);
            //die("CSRF token validation failed");
        else:
            $email = $user->escape_string($_POST['email']);
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
                $token = md5(2418*2) . $email;
                $addkey = substr(md5(uniqid(rand(),1)),3,10);
                $token = $token . $addkey;
                $root = (isset($_SERVER['HTTPS'])?"https://":"http://");
                $root .= "192.168.43.85";
                $root.=str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                $url = "password-reset.php?token=".$token."&email=".$email;
                $url = $root.$url;
                $body = "
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
                                    <p><a href=\"{$url}\">Click here to reset your password</a></p>
                                    <p>Thanks for reading.</p>
                                </div>
                                <div class=''>
                                    <p>Cartzilla</p>
                                </div>
                            </div>
                        </body>
                    </html>"; 
                $subject = "Password Reset Request For Cartzilla";

                $query = "SELECT customer_id FROM customers WHERE email = '$email'";
                $row = $user->details($query);
                if($row):
                    $sql = "SELECT * FROM passwordreset WHERE email = '$email' LIMIT 1";
                    $row = $user->details($sql);
                    if(is_array($row)):
                        $curDate = date("Y-m-d H:i:s");
                        $expDate = $row['exp_time'];
                        $id = $row['id'];
                        if($expDate <= $curDate):
                            $expformat = mktime(date("H")+7,date("i"),date("s"),date("m"),date("d"),date("Y"));
                            $new_expdate = date("Y-m-d H:i:s", $expformat);
                            $query = "UPDATE passwordreset SET exp_time='$new_expdate',token='$token' WHERE id='$id' LIMIT 1";
                            $results = $user->update($query);
                            if($results):
                                //send a mail to the email address
                                $response = $user->sendMail($email, $subject, $body);
                                $errors['message'] = $response;
                            endif;
                        else:
                            $errors['message'] = "An email has already been sent.";
                        endif;
                    else:
                        $expformat = mktime(date("H")+7,date("i"),date("s"),date("m"),date("d"),date("Y"));
                        $expdate = date("Y-m-d H:i:s",$expformat);
                        $query = "INSERT INTO passwordreset (id,email,token,exp_time) VALUES (NULL,'$email','$token','$expdate')";
                        $result = $user->insert($query);
                        if($result):
                            //send a mail to the email address
                            $response = $user->sendMail($email, $subject, $body);
                            $errors['message'] = $response;
                        endif;
                    endif;
                endif;
            endif;
        endif;
    endif;
?>