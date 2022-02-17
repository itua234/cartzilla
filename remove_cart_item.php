<?php 
    session_start();
    $array = $data = array();
    //connect to database
    include 'Functions.php';
    $user = new User();
    //validate and sanitize data
    $product_id = $user->escape_string($_POST['product_id']);
    $code = "a". $product_id;
    foreach($_SESSION["shopping_cart"] as $key => $value):
        if($key == $code):
            unset($_SESSION["shopping_cart"][$code]);
            if(empty($_SESSION['shopping_cart'])):
                $message = "There are no items in the cart";
                $cart_total = NULL;
                $cart_total_quantity = NULL;
                $_SESSION['cart_total'] = 0;
            else:
                $message = NULL;
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
            endif;
        endif;
    endforeach;
    $data = [
        'message' => $message,
        'cart_total' => $cart_total,
        'cart_total_quantity' => $cart_total_quantity,
        'product_id' => $product_id
    ];
    echo json_encode($data);
    exit;
?>