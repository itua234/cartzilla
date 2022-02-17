<?php 
    /*switch(true):
        case(!empty($pass)):
            if(strlen($pass) >= '8'):
                $pass = $user->test_input($pass);
                if(preg_match("/^[a-zA-Z]*$/", $pass)):
                    $errors2['pass1'] = "Password Must Contain At Least One Number";
                endif;
                if(!preg_match("#[A-Z]+#", $pass)):
                    $errors2['pass2'] = "Password Must Contain At Least One Capital Letter";
                endif;
                if(!preg_match("#[a-z]+#", $pass)):
                    $errors2['pass3'] = "Password Must Contain At Least One Small Letter";
                endif;
            else:
                $errors['pass'] = "Password Must Contain At Least 8 Characters!";
            endif;
        break;
        default:
            $errors['pass'] = "This field is required";
    endswitch;
?>