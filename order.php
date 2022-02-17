<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    if(isset($_SESSION['cart_total'])):
        $total_order = $_SESSION['cart_total'];
        if($total_order == 0):
            $url = "cart.php";
            $user->redirect_url($url);
            exit();
        else:
            if(!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))):
                $_SESSION['checkout_page'] = TRUE;
                $url = "login.php";
                $user->redirect_url($url);
                exit();
            else:
                $url = "checkout.php";
                $user->redirect_url($url);
                exit();
            endif;
        endif;
    endif;
?>