<?php 
    $errors = array();
    if(isset($_POST['submit'])):
        $csrf_token = $_POST['csrf_token'];
        if($csrf_token != $_SESSION['csrf_token']):
            //Reset token
            unset($_SESSION['csrf_token']);
            //die("CSRF token validation failed");
        else:
            //escape user input
            $email = $user->escape_string($_POST['email']);
            $pass = $user->escape_string($_POST['password']);
            if(empty($email)):
                $errors['email'] = "This field is required";
            else:
                $email = $user->test_input($email);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                    $errors['email'] = "Invalid email format";
                endif;
            endif;
            if(empty($pass)):
                $errors['pass'] = "This field is required";
            endif;
            //check for errors if none, log the user in .....
            if(count($errors) == 0):
                $query = "SELECT * FROM customers WHERE email = '$email' LIMIT 1";
                $row = $user->details($query);
                if($row):
                    if($user->password_check($pass,$row['password'])):
                        $_SESSION['id'] = $row['customer_id'];
                        $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
                        //get current time
                        $current_time = time();
                        //set cookie expiration for 1 month
                        $cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);
                        if(isset($_POST['remember'])):
                            //set cookie
                            setcookie("email", $email,$cookie_expiration_time);
                            setcookie("password",$pass,$cookie_expiration_time);
                        endif;
                        if(isset($_SESSION['checkout_page'])):
                            unset($_SESSION['checkout_page']);
                            $root = (isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'];
                            $root.=str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                            $redirect_url = $root."order.php";
                            ?>
                                <script>
                                    var url = "<?=$redirect_url;?>"
                                    window.location = url;
                                </script>
                            <?php
                        else:
                            $root = (isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'];
                            $root.=str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
                            $redirect_url = $root."myaccount.php";
                            ?>
                                <script>
                                    var url = "<?=$redirect_url;?>"
                                    window.location = url;
                                </script>
                            <?php
                        endif;
                    else:
                        $errors['error'] = 'Incorrect login credentials';
                    endif;
                else:
                    $errors['error'] = 'Incorrect login credentials';
                endif;
            endif;
        endif;
    endif;
?>