<?php 
    $email = "";
    $errors = $data = array();
    //connect to database
    include 'Functions.php';
    $user = new User();
    //validate and sanitize user input
    $email = $user->escape_string($_POST['email']);
    if(empty($email)):
       $errors['email'] = "This field is required";
    else:
        $email = $user->test_input($email);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            $errors['email'] = "Invalid email format";
        else:
            // first check the database to make sure a user does not already exist with the same email address
            $user_check_query = "SELECT * FROM newsletter WHERE email='$email' LIMIT 1";
            $result = $user->details($user_check_query);
            if($result):
                //if user exists
                if($result['email'] === $email):
                    $errors['email'] = "Already subscribed for our newsletter";
                endif;
            endif;
        endif;
    endif;
    // finally insert the user's email into the newsletter table if there are no errors in the form
    if(count($errors) == 0):
        $query = "INSERT INTO newsletter (email) VALUES('$email')";
        $result = $user->query($query);
        if($result):
            $data['success'] = true;
            $data['message'] = "Successfully subscribed for our newsletter";
        endif;
    else:
        $data['success'] = false;
        $data['errors'] = $errors;
    endif;
    //return all our data to an ajax call
    echo json_encode($data);
?>
