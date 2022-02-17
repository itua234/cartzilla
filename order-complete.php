<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User(); 
    if(isset($_SESSION["order_complete"])):
        $reference_id = $_SESSION["reference_id"];
        unset($_SESSION["shopping_cart"]);
    else:
        $url = "cart.php";
        $user->redirect_url($url);
        exit();
    endif;
    include 'layout/header.php';
?>
	<section class="m-t-80 m-b-30">
		<div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-8 text-center">
                    <p class='font-weight-bold fs-18'>Thank you for your order!</p>
                    <p>Your order has been placed and will be processed as soon as possible.</p>
                    <p>Make sure you make note of your order number, which is <span class="font-weight-bold"><?=$reference_id?></span></p>
                    <p>You will be receiving an email shortly with confirmation of your order. You can now:</p>
                    <p><a href="" class="btn btn-outline-primary text-decoration-none">Go back shopping</a></p>
                    <p><a href="" class="btn btn-primary text-decoration-none"><img class="w-h-20 m-r-10" src="images/icon/Location-white.svg">Track order</a></p>
                </div>
            </div>
        </div>
	</section>	
<?php include 'layout/footer.php'; ?>