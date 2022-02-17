<?php 
    if(!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))):
        $url = "login.php";
        $user->redirect_url($url);
        exit();
    else:
        $user_id = $_SESSION['id'];
        $query = "SELECT * FROM customers WHERE customer_id = '$user_id' LIMIT 1";
        $user_data = $user->details($query);
        if($user_data):
            //$_SESSION['user'] = $user_data;
            $_SESSION['email'] = $user_data["email"];
        endif;
    endif;
?>