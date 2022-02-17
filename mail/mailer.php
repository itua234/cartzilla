<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit'])){
require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';

$mail = new PHPMailer(true);
try {
$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.qordinatesmobile.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'admin@qordinatesmobile.com';                 // SMTP username
$mail->Password = 'scientia234';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('admin@qordinatesmobile.com', 'New Account Registration');
$mail->addAddress('ituaosemeilu234@gmail.com');    // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('admin@qordinatesmobile.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML


$mail->Subject = "New User Registration on Tinkerspay";//$_POST['subject'];
$mail->Body    = "
        <table class='table'>
                      <thead class='text-primary'>
                       
                      </thead>
                      <tbody>
                        
                      <tr>
                          <th>User:  </th>
                          <td>osemeilu</td>
                      </tr>
                      <tr>
                          <th>Email: </th>
                          <td>ituaosemeilu234@gmail.com</td>
                      </tr>
                      <tr>
                          <th>Phone: </th>
                          <td>08114800769</td>
                      </tr>
                      </tbody>
                    </table> 
                    </br>"; //'This is the HTML message body <b>in bold!</b>';
                
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
   // echo "<script>window.open('tables.php','_self')</script>";    
} 
catch(Exception $e){
    echo "Message could not be sent: {$mail->ErrorInfo}";
}

}

?>
<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<form method="post">
  <input type="text" name="">
  <input type="submit" name="submit">
</form>
</body>
</html>