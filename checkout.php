<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'auth.php';
    if(!empty($_SESSION['shopping_cart'])):
        $total = array_column($_SESSION['shopping_cart'],'total');
        $count = count($total);
        $sum = 0;
        for($i=0; $i<$count; $i++):
            $sum += $total[$i];
            global $sum;
        endfor;
        $cart_total = number_format($sum);
    else:
        $url = "cart.php";
        $user->redirect_url($url);
        exit();
    endif;
    include 'includes/inc_checkout.php';
    include 'layout/header.php';
?>
<section class="m-t-80 m-b-40">
    <div class="container-fluid">
        <h5 style="font-weight:bold;">Billing Details</h5>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container-fluid">
            <p>Have a coupon ? <span class="text-primary text-decoration-none" style="cursor:pointer" data-toggle="collapse" data-target="#coupon_collapse" aria-expanded="false" aria-controls="coupon_collapse">
    Please apply it below</span></p>
            <div class="row p-b-20 collapse" id="coupon_collapse">
                <div class="col">
                    <input type="text" class="form-control form-control-border" name="coupon" placeholder="Coupon code">
                </div>
                <div class="col">
                    <input type="submit" class="w-full btn btn-primary" name="coupon_btn" value="Apply coupon">
                </div>
            </div>
        </div>
    </form>
    <div class="">
        <?php 
            if(!empty($errors)):
            ?>
                <div class="" style="border-top:2px solid red;background-color:gray;padding:10px 20px;margin-bottom:30px;">
                    <?php 
                    foreach($errors as $arr):
                        echo $arr ."<br>";
                    endforeach;
                    ?>
                </div>
            <?php 
            endif;
        ?>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <label for="">First Name *</label>
                    <input type="text" class="form-control form-control-border" name="b_first_name" value="<?php if(isset($firstname)){ echo $firstname; }?>">
                </div>
                <div class="col">
                <label for="">Last Name *</label>
                    <input type="text" class="form-control form-control-border" name="b_last_name" value="<?php if(isset($lastname)){ echo $lastname; }?>">
                </div>
            </div>
            <div class="row p-t-20">
                <div class="col">
                    <label for="">Country *</label>
                    <input type="text" class="form-control form-control-border" name="b_country">
                </div>
            </div>
            <div class="row p-t-20">
                <div class="col">
                    <label for="">Address Line 1 *</label>
                    <input type="text" class="form-control form-control-border" name="b_street"  value="<?php if(isset($street)){ echo $street; }?>">
                </div>
            </div>
            <div class="row p-t-20">
                <div class="col">
                    <label for="">Town/City *</label>
                    <input type="text" class="form-control form-control-border" name="b_town" value="<?php if(isset($town)){ echo $town; }?>">
                </div>
            </div>
            <div class="row p-t-20">
                <div class="col">
                    <label for="">State/Country</label>
                    <select class="form-control form-control-border" name="b_state">
                        <option value="100">Choose an option</option>
                        <option value="0">Abia</option>
                        <option value="1">Abuja</option>
                        <option value="2">Adamawa</option>
                        <option value="3">Akwa Ibom</option>
                        <option value="4">Anambra</option>
                        <option value="5">Bauchi</option>
                        <option value="6">Bayelsa</option>
                        <option value="7">Borno</option>
                        <option value="8">Benue</option>
                        <option value="9">Cross River</option>
                        <option value="10">Delta</option>
                        <option value="11">Ebonyi</option>
                        <option value="12">Edo</option>
                        <option value="13">Ekiti</option>
                        <option value="14">Enugu</option>
                        <option value="15">Gombe</option>
                        <option value="16">Imo</option>
                        <option value="17">Jigawa</option>
                        <option value="18">Kaduna</option>
                        <option value="19">Kano</option>
                        <option value="20">Katsina</option>
                        <option value="21">Kebbi</option>
                        <option value="22">Kogi</option>
                        <option value="23">Kwara</option>
                        <option value="24">Lagos</option>
                        <option value="25">Nassarawa</option>
                        <option value="26">Niger</option>
                        <option value="27">Ogun</option>
                        <option value="28">Ondo</option>
                        <option value="29">Osun</option>
                        <option value="30">Oyo</option>
                        <option value="31">Plateau</option>
                        <option value="32">Rivers</option>
                        <option value="33">Sokoto</option>
                        <option value="34">Taraba</option>
                        <option value="35">Yobe</option>
                        <option value="36">Zamfara</option>
                    </select>
                </div>
            </div>
            <div class="row p-t-20">
                <div class="col">
                    <label for="">Phone *</label>
                    <input type="number" class="form-control form-control-border" name="b_phone" value="<?php if(isset($phone)){ echo $phone; }?>">
                </div>
                <div class="col">
                    <label for="">Email *</label>
                    <input type="email" class="form-control form-control-border" name="b_email" value="<?php if(isset($email)){ echo $email; }?>">
                </div>
            </div>
        </div>
        <div class="container-fluid">   
            <div class="row p-t-15">
                <div class="col">
                    <div class="form-check form-switch" >
                        <input class="form-check-input" name="shipping-check" type="checkbox" id="flexSwitchCheckDefault" data-toggle="collapse" data-target="#shipping_collapse" aria-expanded="false" aria-controls="shipping_collapse">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Ship to a different address ?</label>
                    </div>
                </div>
            </div>

            <div class="collapse" id="shipping_collapse">
                <div class="row">
                    <div class="col">
                        <label for="">First Name *</label>
                        <input type="text" class="form-control form-control-border" name="s_first_name" value="<?php if(isset($firstname2)){ echo $firstname2; }?>">
                    </div>
                    <div class="col">
                    <label for="">Last Name *</label>
                        <input type="text" class="form-control form-control-border" name="s_last_name" value="<?php if(isset($lastname2)){ echo $lastname2; }?>">
                    </div>
                </div>
                <div class="row p-t-20">
                    <div class="col">
                        <label for="">Country *</label>
                        <input type="text" class="form-control form-control-border" name="s_country" placeholder="Country">
                    </div>
                </div>
                <div class="row p-t-20">
                    <div class="col">
                        <label for="">Address Line 1 *</label>
                        <input type="text" class="form-control form-control-border" name="s_street1" placeholder="Address Line 1">
                    </div>
                </div>
                <div class="row p-t-20">
                    <div class="col">
                        <label for="">Town/City *</label>
                        <input type="text" class="form-control form-control-border" name="s_town" placeholder="Town / City">
                    </div>
                    <div class="col">
                        <label for="">ZIP / Postcode *</label>
                        <input type="text" class="form-control form-control-border" name="s_zipcode" placeholder="Zip / Postcode">
                    </div>
                </div>
            </div>

            <div class="row p-t-15">
                <div class="col">
                    <span class="" style="font-size:12px;font-style:italic">Your personal data will be used to process your order, support your experiences throughout this website, and for other purposes described in our privacy policy.</span>
                    <input type="submit" class="w-full m-t-20 btn btn-primary" name="order_btn" value="Place Order">
                </div>
            </div>
        </div>
    </form>
</section>
<?php include 'layout/footer.php'; ?>