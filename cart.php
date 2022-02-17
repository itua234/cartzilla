<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'layout/header.php';
?>
	<section class="m-t-100 m-b-30">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="cart-form">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-7 col-sm-12">
                        <ul class="list-unstyled cart_item_container">
                            <?php
                                if(!empty($_SESSION['shopping_cart'])):
                                    foreach($_SESSION['shopping_cart'] as $key):
                                        ?>
                                            <li class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-3">
                        
                                                        <!-- Image -->
                                                        <a href="product.html">
                                                        <img src="images/<?=$key["image"]?>" alt="..." class="img-fluid">
                                                        </a>
                        
                                                    </div>
                                                    <div class="col">
                        
                                                        <!-- Title -->
                                                        <div class="d-flex mb-2 font-weight-bold">
                                                        <a class="text-body" href="product.php"> <?=$key["name"]?> </a> <span class="ml-auto">$<?=$key["price"]?></span>
                                                        </div>
                        
                                                        <!-- Text -->
                                                        <p class="mb-7 font-size-sm text-muted">
                                                        Size: M <br>
                                                        Color: Red
                                                        </p>
                        
                                                        <!--Footer -->
                                                        <div class="d-flex align-items-center">
                        
                                                            <!-- Select -->
                                                            <!--<select class="custom-select custom-select-xxs w-auto">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                    <option value="1">3</option>
                                                            </select>-->
                                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                                </div>
                        
                                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="<?php echo $key["product_id"]; ?>" value="1">
                        
                                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                                </div>
                                                            </div>
                        
                                                            <!-- Remove -->
                                                            <a class="font-size-xs text-gray-400 ml-auto js-remove-cart-item" href="" data-id="<?=$key["product_id"]?>">
                                                                <i class="fe fe-x"></i> Remove
                                                            </a>
                                                        
                                                        </div>
                        
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                    endforeach;     
                                else:
                                    echo "There are no items in the cart";
                                endif;
                            ?>
                        </ul>
                        <label for="coupon_code" class="">Coupon code:</label>
                        <div class="row justify-content-between">
                            <div class="col-12 col-md-7 col-sm-12 col-xl-8 col-lg-8">
                                <div class="row">
                                    <div class="col-8 col-md-6 col-xl-8 col-lg-8">
                                        <input type="text" id="coupon_code" class="form-control form-control-border" name="coupon" placeholder="Enter coupon code*">
                                    </div>
                                    <div class="col-4 col-md-6 col-xl-3 col-lg-4">
                                        <input type="submit" class="w-full btn btn-primary" name="coupon_btn" value="Apply">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5 col-md-4 col-sm-3 col-xl-3 col-lg-3">
                                <button type="submit" class="btn w-full btn-outline-primary update-cart" name="update_cart">Update Cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="" style="background-color:#f5f5f5;padding:25px;padding-bottom:40px;">
                            <ul class="list-unstyled">
                                <li style='border-bottom:1px solid rgba(0, 0, 0, 0.125);' class="p-b-15 d-flex justify-content-between">
                                    <span class="">Subtotal</span>
                                    <span class="">$89.00</span>
                                </li>
                                <li style='border-bottom:1px solid rgba(0, 0, 0, 0.125);' class="p-t-15 p-b-15 d-flex justify-content-between">
                                    <span class="">Tax</span>
                                    <span class="">$0.00</span>
                                </li>
                                <li style='border-bottom:1px solid rgba(0, 0, 0, 0.125);' class="font-weight-bold p-t-15 p-b-15 d-flex justify-content-between">
                                    <span class="">Total</span>
                                    <span class="cart_item_price">
                                        <?php 
                                            if(!empty($_SESSION['shopping_cart'])):
                                                $cart_total = array_column($_SESSION['shopping_cart'],'total');
                                                $count = count($cart_total);
                                                $sum = 0;
                                                for($i=0; $i<$count; $i++):
                                                    $sum += $cart_total[$i];
                                                    global $sum;
                                                endfor;
                                                $_SESSION['cart_total'] = $sum;
                                                echo "$".number_format($_SESSION['cart_total']);
                                            else:
                                                $_SESSION['cart_total'] = 0;
                                                echo "$"."0";
                                            endif;
                                        ?>
                                    </span>
                                </li>
                            </ul>
                            <span class="">Shipping cost calculated at Checkout</span>
                        </div>
                        <div class="p-t-30">
                            <a href="order.php" class="btn w-full btn-primary text-decoration-none">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>

                
            </div>
        </form>
        <div class="form-animation justify-content-center align-items-center pos-fixed">
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
    </section>
<?php include 'layout/footer.php'; ?>
		

	