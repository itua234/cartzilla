<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	include 'Connection.php';
    require_once 'mail/Exception.php';
    require_once 'mail/PHPMailer.php';
    require_once 'mail/SMTP.php';
	class User extends DbConnection{
        public function __construct(){
            parent::__construct();
        }
        public function getRealIp(){
            switch(true):
                case(!empty($_SERVER['HTTP_X_REAL_IP'])):
                    return $_SERVER['HTTP_X_REAL_IP'];
                break;
                case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
                break;
                case(!empty($_SERVER['HTTP_X_CLIENT_IP'])):
                    return $_SERVER['HTTP_X_CLIENT_IP'];
                break;
                default: 
                    return $_SERVER['REMOTE_ADDR'];
            endswitch;
        }
        /* Code to generate a CSRF token and store the same...  */
        public function generateToken(){
            //check if a token is present for the current session
            if(!isset($_SESSION['csrf_token'])):
                //No token present, generate a new one
                //$token = bin2hex(random_bytes(32));
                $token = md5(uniqid(rand(), true));
                $_SESSION['csrf_token'] = $token;
            else:
                //Reuse the token
                $token = $_SESSION['csrf_token'];
            endif;
            return $token;
        }
        /* There are many libraries and frameworks already available which have their own implementation of CSRF validation. Though this is the simple implementation of CSRF, You need to write some code to regenerate your CSRF token dynamically to prevent from CSRF token stealing and fixation.*/
        
        //ensure that the form is correctly filled ...
        public function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        public function password_encryption($password){
            $Blowfish_Hash_Format = "$2y$10$";
            $Salt_Length = 22;
            $Salt = $this->Generate_Salt($Salt_Length);
            $Formatting_Blowfish_With_Salt = $Blowfish_Hash_Format.$Salt;
            $Hash = crypt($password,$Formatting_Blowfish_With_Salt);
            return $Hash;
        }
        public function password_check($password,$existing_hash){
            $hash = crypt($password,$existing_hash);
            if($hash === $existing_hash):
                return true;
            else:
                return false;
            endif;
        }
        public function Generate_Salt($length){
            $unique_random_string = md5(uniqid(mt_rand(), true));
            $base64_string = base64_encode($unique_random_string);
            $modified_base64_string = str_replace('+','.',$base64_string);
            $salt = substr($modified_base64_string,0,$length);
            return $salt;
        }
        public function details($sql){
            $query = $this->connection->query($sql);
            $row = $query->fetch_array();
            if($row):  
                return $row;
            else:
                return false;
            endif;       
        }
        public function query($sql){
            $query = $this->connection->query($sql);
            return $query;
        }
        public function insert($sql){
            $query = $this->connection->query($sql);
            if($query):
                return true;
            else:
                return false;
            endif;
        }
        public function update($sql){
            $query = $this->connection->query($sql);
            if($query):
                return true;
            else:
                return false;
            endif;
        }
        public function delete($sql){
            $query = $this->connection->query($sql);
            if($query):
                return true;
            else:
                return false;
            endif;
        }
        public function escape_string($value){
            return $this->connection->real_escape_string($value);
        }
        public function redirect_url($url){
            $root = (isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'];
            $root.=str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $redirect_url = $root.$url;
            return header("Location: ".$redirect_url);
        }
        public function reference(){
            $token = "";
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "0123456789";
            $max = strlen($codeAlphabet) - 1;
            for($i=0; $i<14; $i++):
                $token .= $codeAlphabet[mt_rand(0, $max)];
            endfor;
            return $token;
        }
        public function sendMail($email, $subject, $body){
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;    
                $mail->isSMTP();                   
                $mail->SMTPAuth = true;                        
                $mail->SMTPSecure = 'tls'; 
                $mail->Host = 'smtp.gmail.com';
                $mail->Username = 'sivatech234@gmail.com';
                $mail->Password = "Scientia234#";             
                $mail->Port = 587;                    
                $mail->setFrom('no-reply@cartzilla.com', 'Cartzilla');
                $mail->addAddress($email); 
                //$mail->addReplyTo('no-reply@cartzilla.com');
                $mail->isHTML(true);                  
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->smtpConnect([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    ]
                ]);
                $mail->send();
                if($mail->send()):
                    return "Check your email to reset your password."; 
                endif;
            } 
            catch(Exception $e){
                return "Email could not be sent:";
            }
        }

        public function validate($password){
            $errors2 = array();
            switch(true):
                case(!empty($password)):
                    if(strlen($password) >= '8'):
                        $password = $this->test_input($password);
                        if(preg_match("/^[a-zA-Z]*$/", $password)):
                            $errors2[0] = "Password Must Contain At Least One Number";
                        endif;
                        if(!preg_match("#[A-Z]+#", $password)):
                            $errors2[1] = "Password Must Contain At Least One Capital Letter";
                        endif;
                        if(!preg_match("#[a-z]+#", $password)):
                            $errors2[2] = "Password Must Contain At Least One Small Letter";
                        endif;

                        if(!empty($errors2)):
                            return $errors2;
                        endif;
                    else:
                        return "Password Must Contain At Least 8 Characters!";
                    endif;
                break;
                default:
                    return "This field is required";
            endswitch;
            return false;
        }
    }
?>
