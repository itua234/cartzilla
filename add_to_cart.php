<?php 
    session_start();
    $errors = $data = array();
    //connect to database
    include 'Functions.php';
    $user = new User();
    //validate and sanitize user input
    $product_id = $user->escape_string($_POST['product_id']);
    $quantity = $user->escape_string($_POST['num_product']);
    $quantity = (int)$quantity;
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
        $message = NULL;
        if(empty($_SESSION["shopping_cart"])):
            $_SESSION["shopping_cart"] = array();
            $_SESSION["shopping_cart"] = $cartArray;
            foreach($_SESSION['shopping_cart'] as $key):
                $cart_total_quantity = $key['quantity'];
                $cart_total_price = $key['price'] * $key['quantity'];
                $cart_total_price = number_format($cart_total_price);
            endforeach;
            $new_product = '
            <li class="header-cart-item flex-w flex-t m-b-12" data-id="'.$cartArray[$product_id]['product_id'].'">
                <div class="header-cart-item-img">
                    <img src="images/'.$cartArray[$product_id]['image'].'" alt="IMG">
                </div>
    
                <div class="header-cart-item-txt p-t-8">
                    <a href="cart.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                        '.$cartArray[$product_id]['name'].'
                    </a>
    
                    <span class="header-cart-item-info">
                        $'.$cartArray[$product_id]['price'].'
                    </span>
                </div>
            </li>';
        else:
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            if(in_array($product_id,$array_keys)):
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
                $new_product = NULL;
            else:
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
                $new_product = '
                <li class="header-cart-item flex-w flex-t m-b-12" data-id="'.$cartArray[$product_id]['product_id'].'">
                    <div class="header-cart-item-img">
                        <img src="images/'.$cartArray[$product_id]['image'].'" alt="IMG">
                    </div>
        
                    <div class="header-cart-item-txt p-t-8">
                        <a href="cart.php" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            '.$cartArray[$product_id]['name'].'
                        </a>
        
                        <span class="header-cart-item-info">
                            $'.$cartArray[$product_id]['price'].'
                        </span>
                    </div>
                </li>';
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
            $cart_total_price = number_format($total_price);
        endif;
    else:
        $message = "quantity is above stock";
    endif;
    $data = [
        'new_product' => $new_product,
        'cart_total_quantity' => $cart_total_quantity,
        'cart_total_price' => $cart_total_price,
        'errors' => $message,
        'product_name' => $product_name
    ];
    echo json_encode($data);
    exit;
?>