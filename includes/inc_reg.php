<?php 
    $firstname = $lastname = $email = $password = "";
    $errors = $errors2 = array();
    if(isset($_POST['submit'])):
        $csrf_token = $_POST['csrf_token'];
        if($csrf_token != $_SESSION['csrf_token']):
            //Reset token
            unset($_SESSION['csrf_token']);
            //die("CSRF token validation failed");
        else:
            //escape user input
            $email = $user->escape_string($_POST['email']);
            $password = $user->escape_string($_POST['password']);
            //validate email address
            if(empty($email)):
                $errors['email'] = "This field is required";
            else:
                $email = $user->test_input($email);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
                    $errors['email'] = "Invalid email format";
                endif;
            endif;
            //validate password
            $validate = $user->validate($password);
            if($validate):
                if(is_array($validate)):
                    $errors2 = $validate;
                else:
                    $errors['pass'] = $validate;
                endif;
            endif;
            //hash customers password
            $password_hash = $user->password_encryption($password);
            //check for errors if none, add customer details into the database .....
            if((count($errors) == 0) AND (count($errors2) == 0)):
                $sql = "SELECT * FROM customers WHERE email='$email' LIMIT 1";
                $row = $user->details($sql);
                if(is_array($row)):
                    $errors['email'] = "email not available";
                else:
                    $sql = "INSERT INTO customers (email, password) VALUES ('$email', '$password_hash')";
                    $results = $user->insert($sql);
                    if($results):
                        $query = "SELECT * FROM customers WHERE email = '$email' LIMIT 1";
                        $row = $user->details($query);
                        if($row):
                            $_SESSION['id'] = $row['customer_id'];
                            $_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
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
                        endif;
                    endif;
                endif;
            endif;
        endif;
    endif;
?>