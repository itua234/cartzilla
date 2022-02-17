<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'auth.php';
    $errors = array();
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
    <section class="" style="margin-top:80px;margin-bottom:100px;">
        <div class="container" style="">
            <div class="row">
                <ul class="col-xl-3 col-lg-3 col-md-4 list-unstyled">
                    <li class=""><a href="myaccount.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/dashboard.svg">DASHBOARD</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/shopping-cart.svg">ORDERS</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/cloud-computing.svg">DOWNLOADS</a></li>
                    <li><a href="edit-address.php" class="dashboard-list-link d-flex align-items-center text-decoration-none" style="background-color:#fe696a;color:white;"><img class="w-h-25 m-r-10" src="images/icon/Location.svg">ADDRESSES</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/credit-card.svg">PAYMENT METHODS</a></li>
                    <li><a href="edit-account.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/User2.svg">ACCOUNT DETAILS</a></li>
                    <li><a href="logout.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/logout.svg">LOGOUT</a></li>
                </ul>
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <h4 style="font-weight:bold;">My Addresses</h4>
                    <p>The following addresses will be used on the checkout page by default.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 style="font-weight:bold">Billing Address</h5>
                        <p><a href="billing.php"><img class="w-h-20 m-r-10" src="images/icon/edit.svg"><span>Edit</span></a></p>
                    </div>
                    <div class="" style="font-style:italic;">
                        <?php 
                            $sql = "SELECT * FROM billing WHERE customer_id='$customer_id' LIMIT 1";
                            $result = $user->details($sql);
                            if($result):
                                echo $result['firstname']. " " .$result['lastname'] ."<br>";
                                echo $result['company_name'] ."<br>";
                                echo $result['street'] ."<br>";
                                echo $result['town'] ."<br>";
                                echo $result['state'] ."<br>";
                            else:
                                echo "<i>You have not set up this type of address yet.</i>";
                            endif;
                        ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center" style="margin-top:25px;">
                        <h5 style="font-weight:bold;">Shipping Address</h5>
                        <p><a href="shipping.php"><img class="w-h-20 m-r-10" src="images/icon/edit.svg"><span>Edit</span></a></p>
                    </div>
                    <div class="" style="font-style:italic;">
                        <?php 
                            $sql = "SELECT * FROM shipping WHERE customer_id='$customer_id' LIMIT 1";
                            $result = $user->details($sql);
                            if($result):
                                echo $result['firstname']. " " .$result['lastname'] ."<br>";
                                echo $result['street'] ."<br>";
                                echo $result['town'] ."<br>";
                                echo $result['state'] ."<br>";
                                echo $result['zipcode'] ."<br>";
                            else:
                                echo "<i>You have not set up this type of address yet.</i>";
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'layout/footer.php'; ?>
    