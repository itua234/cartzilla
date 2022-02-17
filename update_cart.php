<?php
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    if(!empty($_SESSION['shopping_cart'])):
        unset($_POST["coupon"]);
        unset($_POST["update_cart"]);
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        foreach($_POST as $key => $value):
            $sql = "SELECT * FROM products WHERE product_id='$key' LIMIT 1";
            $row = $user->details($sql);
            if($row):
                $stock = $row['total_stock'];
                if($value < $stock):
                    $key = "a". $key;
                    if(in_array($key,$array_keys)):
                        $_SESSION["shopping_cart"][$key]['quantity'] = $value;
                        $_SESSION["shopping_cart"][$key]['total'] = $_SESSION["shopping_cart"][$key]['price'] * $value;
                    endif;
                endif;
            endif;
        endforeach;
        $total = array_column($_SESSION['shopping_cart'],'total');
        $count = count($total);
        $sum = 0;
        for($i=0; $i<$count; $i++):
            $sum += $total[$i];
            global $sum;
        endfor;
        $cart_total = number_format($sum);
        $_SESSION['cart_total'] = $cart_total;
        
        $d = array_column($_SESSION['shopping_cart'],'quantity');
        $total_quantity = 0;
        foreach($d as $key => $value):
            $total_quantity += $value;
            global $total_quantity;
        endforeach;
        $cart_total_quantity = $total_quantity;

    else:
        $cart_total = NULL;
        $cart_total_quantity = NULL;
        $_SESSION['cart_total'] = 0;
    endif;

    $data = [
        'cart_total' => $cart_total,
        'cart_total_quantity' => $cart_total_quantity
    ];
    echo json_encode($data);
    exit;
?>