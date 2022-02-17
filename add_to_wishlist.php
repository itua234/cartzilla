<?php 
    //connect to database
    session_start();
    $quantityErr = "";
    $errors = array();
    $data = array();
    include 'Functions.php';
    $user = new User();
    //validate and sanitize user input
    $product_id = $user->escape_string($_POST['product_id']);
    $quantity = $user->escape_string($_POST['num_product']);
    $size = $user->escape_string($_POST['size']);
    $color = $user->escape_string($_POST['color']);
    $sql = "SELECT * FROM products WHERE product_id='$product_id' LIMIT 1";
    $row = $user->details($sql);
    if($row):
        $product_name = $row['product_name'];
        $product_id = $row['product_id'];
        $price = $row['price'];
        $stock = $row['total_stock'];
        $image = $row['product_image'];
        $product_id = "a". $product_id;
        $cartArray = array(
            $product_id => array(
                'name' => $product_name,
                'product_id' => ltrim($product_id,"a"),
                'price' => $price,
                'quantity' => $quantity,
                'image' => $image,
                'total' => $price * $quantity
            )
        );
    endif;
    if($quantity < $stock):
        if(empty($_SESSION["shopping_cart"])):
            $_SESSION["shopping_cart"] = array();
            $_SESSION["shopping_cart"] = $cartArray;
            foreach($_SESSION['shopping_cart'] as $key):
                $cart_total_quantity = $key['quantity'];
                $cart_total_price = $key['price'] * $key['quantity'];
            endforeach;
        else:
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            if(in_array($product_id,$array_keys)):
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
            else:
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
            endif;
            $d = array_column($_SESSION['shopping_cart'],'quantity','price');
            $total_quantity = $total_price = 0;
            foreach($d as $key => $value):
                $total_quantity += $value;
                $total_price += $key * $value;
                global $total_quantity;
                global $total_price;
            endforeach;
            $cart_total_quantity = $total_quantity;
            $cart_total_price = $total_price;
        endif;
    else:
        $quantityErr = "quantity is above stock";
    endif;
    $data = [
        'cart_total_quantity' => $cart_total_quantity,
        'cart_total_price' => $cart_total_price,
        'quantity_err' => $quantityErr,
        'product_name' => $product_name
    ];
    echo json_encode($data);
    exit;
?>