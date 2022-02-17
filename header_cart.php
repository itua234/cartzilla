<?php 
    session_start();
    $errors = $array = $data = array();
    //connect to database
    include 'Functions.php';
    $user = new User();
    if(empty($_SESSION["shopping_cart"])):
        $arr = "There are no items in the cart";
    else:
        $column = array_column($_SESSION['shopping_cart'],'quantity','price');
        $total_price = 0;
        foreach($column as $key => $value):
            $total_price += $key * $value;
            global $total_price;
        endforeach;
        $cart_total_price = number_format($total_price);
        foreach($_SESSION['shopping_cart'] as $key):
            $arr = '
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="images/'.$key['image'].'" alt="IMG">
                    </div>
    
                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            '.$key['name'].'
                        </a>
    
                        <span class="header-cart-item-info">
                            $'.$key['price'].'
                        </span>
                    </div>
                </li>';
            array_push($array,$arr);
        endforeach;
    endif;
    $data = [
        'check' => $array,
        'cart_total_price' => $cart_total_price
    ];
    echo json_encode($data);
    exit;
?>