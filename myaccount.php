<?php
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'auth.php';
    $customer_email = $display_name = "";
    if(isset($_SESSION['id'])):
        $customer_id = $_SESSION['id'];
        $sql = "SELECT * FROM customers WHERE customer_id='$customer_id' LIMIT 1";
        $result = $user->details($sql);
        if($result):
            $customer_email = $result['email'];
            $display_name = strpos($customer_email, "@");
            $display_name = substr($customer_email, 0, $display_name);
            $firstName = $result['firstname'];
            $lastName = $result['lastname'];
        endif;
    endif;
    include 'layout/header.php';
    ?>
    <section class="" style="margin-top:80px;">
        <div class="container" style="">
            <div class="row">
                <ul class="col-xl-3 col-lg-3 col-md-4 list-unstyled">
                    <li class=""><a href="myaccount.php" class="dashboard-list-link d-flex align-items-center text-decoration-none" style="background-color:#fe696a;color:white;"><img class="w-h-25 m-r-10" src="images/icon/dashboard.svg">DASHBOARD</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/shopping-cart.svg">ORDERS</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/cloud-computing.svg">DOWNLOADS</a></li>
                    <li><a href="edit-address.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/Location.svg">ADDRESSES</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/credit-card.svg">PAYMENT METHODS</a></li>
                    <li><a href="edit-account.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/User2.svg">ACCOUNT DETAILS</a></li>
                    <li><a href="logout.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/logout.svg">LOGOUT</a></li>
                </ul>
                <div class="col-xl-9 col-lg-9 col-md-8" style="">
                    <p style="font-size:14px;">Hello <strong><?=$display_name?></strong> (not <strong><?=$customer_email?></strong>? <a href="logout.php" class="dashlist-link">Log out</a>)</p>
                    <p style="font-size:14px;">From your account dashboard you can view your <a href="" class="dashlist-link">recent orders</a>, manage your <a href="edit-address.php" class="dashlist-link">shipping and billing addresses</a>, and <a href="edit-account.php" class="dashlist-link">edit your password and account details.</a></p>
                </div>
            </div>
        </div>
    </section>
    <?php include 'layout/footer.php'; ?>
    