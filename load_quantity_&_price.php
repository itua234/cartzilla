<?php 
    session_start();
    $data = array();
    //connect to database
    include 'Functions.php';
    $user = new User();
    if(empty($_SESSION["shopping_cart"])):
        $cart_total_quantity = "0";
        $cart_total_price = "0";
    else:
        $d = array_column($_SESSION['shopping_cart'],'quantity','price');
        $total_quantity = $total_price = 0;
        foreach($d as $key => $value):
            $total_quantity += $value;
            $total_price += $key * $value;
            global $total_quantity;
            global $total_price;
        endforeach;
        $cart_total_quantity = $total_quantity;
        $cart_total_price = number_format($total_price);
    endif;
    $data = [
        'cart_total_quantity' => $cart_total_quantity,
        'cart_total_price' => $cart_total_price
    ];
    echo json_encode($data);
    exit;
?>