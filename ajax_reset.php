<?php 
    $data = array();
    $errors = array();
    $errors2 = array();
    //connect to database
    include 'Functions.php';
    $user = new User();
    //validate and sanitize data
    $email = $user->escape_string($_POST['email']);
    $password1 = $user->escape_string($_POST['password']);
    $password2 = $user->escape_string($_POST['confirm_password']);
    //validate password
    switch(true):
        case(!empty($password1)):
            if($password2 == $password1):
                if(strlen($password1) >= '8'):
                    $password1 = $user->test_input($password1);
                    if(preg_match("/^[a-zA-Z]*$/", $password1)):
                        array_push($errors2, "Password Must Contain At Least One Number");
                    endif;
                    if(!preg_match("#[A-Z]+#", $password1)):
                        array_push($errors2, "Password Must Contain At Least One Capital Letter");
                    endif;
                    if(!preg_match("#[a-z]+#", $password1)):
                        array_push($errors2, "Password Must Contain At Least One Small Letter");
                    endif;
                else:
                    $errors['pass'] = "Passwords Must Contain At Least 8 Characters!";
                endif;
            else:
                $errors['pass'] = "Passwords do not match";
            endif;
        break;
        default:
            $errors['pass'] = "This field is required";
    endswitch;
    //hash customers new password
    $password_hash = $user->password_encryption($password1);
    //check for errors if none, add customer details into the database .....
    if((count($errors) == 0) AND (count($errors2) == 0)):
        $query = "SELECT customer_id FROM customers WHERE email='$email'";
        $row = $user->details($query);
        if($row):
            $customer_id = $row['customer_id'];
            $query = "UPDATE customers SET password='$password_hash' WHERE customer_id='$customer_id' LIMIT 1";
            $update = $user->update($query);
            if($update):
                $sql = "DELETE FROM passwordreset WHERE email='$email' LIMIT 1";
                $delete = $user->delete($sql);
                if($delete):
                    $message = "Password has been changed successfully";
                endif;
            endif;
        endif;
    else:
        $message = NULL;
    endif;

    $data = [
        'errors1' => $errors,
        'errors2' => $errors2,
        'msg' => $message
    ];
    echo json_encode($data);
    exit;
?>