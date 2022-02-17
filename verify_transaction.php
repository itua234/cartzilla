<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    if(isset($_GET['reference'])):
        $reference = $user->escape_string($_GET['reference']);
        $reference = $user->test_input($reference);
        $query = "SELECT * FROM orders WHERE reference_id='$reference' LIMIT 1";
        $row = $user->details($query);
        if($row):
            $sql = "UPDATE orders SET payment_status='paid' WHERE reference_id='$reference' LIMIT 1";
            $update = $user->update($sql);
            if($update):
                $_SESSION["order_complete"] = "TRUE";
                $_SESSION["reference_id"] = $reference;
                $url = "order-complete.php";
                $user->redirect_url($url);
                exit();
            endif;
        endif;
    endif;
?>