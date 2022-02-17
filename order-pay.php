<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'auth.php';
    if(isset($_SESSION["payment"])):
        $key = $_SESSION['payment'][3];
        $reference = $_SESSION['payment'][0];
        $email = $_SESSION['payment'][1];
        $amount = $_SESSION['payment'][2];
        $order_id = $_SESSION['payment'][4];
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
                <div class="col-xl-8 col-lg-8 col-md-8">
                    <div class="d-flex flex-column p-b-7" style="border-bottom:1px dashed black;">
                        <span class="fs-13">ORDER NUMBER:</span>
                        <span class="font-weight-bold fs-18"><?=$order_id?></span>
                    </div>
                    <div class="d-flex flex-column p-t-5 p-b-7" style="border-bottom:1px dashed black;">
                        <span class="fs-13">DATE:</span>
                        <span class="font-weight-bold fs-18">
                            <?php
                                list($day,$month,$year,$hour,$min,$sec) = explode("/",date("d/F/Y/h/i/s"));
                                echo $month." " .$day.",". " ".$year;
                            ?>
                        </span>
                    </div>
                    <div class="d-flex flex-column p-t-5 p-b-7" style="border-bottom:1px dashed black;">
                        <span class="fs-13">TOTAL:</span>
                        <span class="font-weight-bold fs-18">$<?=$amount?></span>
                    </div>
                    <div class="d-flex flex-column p-t-5 p-b-7" style="border-bottom:1px dashed black;">
                        <span class="fs-13">PAYMENT METHOD:</span>
                        <span class="font-weight-bold fs-18">Debit/Credit Cards</span>
                    </div>
                    <div class="p-t-30">
                        <p>Thank you for your order, please click on the button below to pay with Paystack.</p>
                        <div class="">
                            <form id="paymentForm">
                                <div class="form-submit">
                                    <button type="submit" class="btn btn-outline-primary text-decoration-none" onclick="payWithPaystack()"> Pay Now</button>
                                </div>
                            </form>
                            <script src="https://js.paystack.co/v1/inline.js"></script>
                            <script>
                                const paymentForm = document.getElementById('paymentForm');
                                paymentForm.addEventListener("submit", payWithPaystack, false);
                                function payWithPaystack(e) {
                                    e.preventDefault();
                                    let handler = PaystackPop.setup({
                                        key: "<?=$key?>", // Replace with your public key
                                        email: "<?=$email?>",
                                        amount: "<?=$amount?>" * 100,
                                        ref: "<?=$reference?>", // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                        // label: "Optional string that replaces customer email"
                                        onClose: function(){
                                            alert('Window closed.');
                                        },
                                        callback: function(response){
                                            //let message = 'Payment complete! Reference: ' + response.reference;
                                            //alert(message);
                                            window.location = "verify_transaction.php?reference="+ response.reference;
                                        }
                                    });
                                    handler.openIframe();
                                }
                            </script>
                            <a href="" class="btn btn-outline-primary text-decoration-none">Cancel order & restore cart</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>	
<?php include 'layout/footer.php'; ?>