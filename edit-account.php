<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'auth.php';
    $errors = $errors2 = array();
    $firstName = $lastName = $customer_email = $display_name = "";
    if(isset($_SESSION['id'])):
        $customer_id = $_SESSION['id'];
        if(isset($_POST['submit'])):
            $firstname = $user->escape_string($_POST['firstname']);
            $lastname  = $user->escape_string($_POST['lastname']);
            $email = $user->escape_string($_POST['email']);   

            //validate firstname
            if(empty($firstname)):
                $errors['firstname'] = "<strong>First name</strong> is a required field.";
            else:
                $firstname = $user->test_input($firstname);
                if(!preg_match("/^[a-zA-Z]*$/", $firstname)){
                    $errors['firstname'] = "Invalid name format";
                }
            endif;

            //validate lastname
            if(empty($lastname)):
                $errors['lastname'] = "<strong>Last name</strong> is a required field.";
            else:
                $lastname = $user->test_input($lastname);
                if(!preg_match("/^[a-zA-Z]*$/", $lastname)){
                    $errors['lastname'] = "Invalid name format";
                }
            endif;

            //validate email address
            if(empty($email)):
                $errors['email'] = "<strong>Email</strong> is a required field.";
            else:
                $email = $user->test_input($email);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)):
                    $errors['email'] = "Invalid email format";
                endif;
            endif;
           
            if(count($errors) == 0):
                $sql = "UPDATE customers SET firstname='$firstname', lastname='$lastname', email='$email' WHERE customer_id='$customer_id' LIMIT 1";
                $query = $user->update($sql);
                if($query):
                    $message = "data has been updated successfully";
                    ?>
                    <script>
                        swal("data has been updated successfully", "", "success");
                    </script>
                    <?php
                endif;
            endif;
        endif;
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
        <div class="container">
            <div class="row">
                <ul class="col-xl-3 col-lg-3 col-md-4 list-unstyled">
                    <li class=""><a href="myaccount.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/dashboard.svg">DASHBOARD</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/shopping-cart.svg">ORDERS</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/cloud-computing.svg">DOWNLOADS</a></li>
                    <li><a href="edit-address.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/Location.svg">ADDRESSES</a></li>
                    <li><a href="" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/credit-card.svg">PAYMENT METHODS</a></li>
                    <li><a href="edit-account.php" class="dashboard-list-link d-flex align-items-center text-decoration-none" style="background-color:#fe696a;color:white;"><img class="w-h-25 m-r-10" src="images/icon/User2.svg">ACCOUNT DETAILS</a></li>
                    <li><a href="logout.php" class="dashboard-list-link d-flex align-items-center text-decoration-none"><img class="w-h-25 m-r-10" src="images/icon/logout.svg">LOGOUT</a></li>
                </ul>
                <div class="col-xl-9 col-lg-9 col-md-8">
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
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="col">
                                <label for="" style="font-weight:bold;font-size:14px;">First name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control form-control-border" name="firstname" value="<?=$firstName?>">
                            </div>
                            <div class="col">
                                <label for="" style="font-weight:bold;font-size:14px;">Last name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control form-control-border" name="lastname" value="<?=$lastName?>">
                            </div>
                        </div>
                        <div class="d-flex flex-column" style="margin-top:20px;">
                            <label for="" style="font-weight:bold;font-size:14px;">Display name <span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-border" name="display_name" value="<?=$display_name?>">
                        </div>
                        <p style="font-style:italic;font-size:14px;margin-top:10px;">This will be how your name will be displayed in the account section and in reviews</p>
                        <div class="d-flex flex-column"style="margin-top:15px;font-weight:bold;font-size:14px;">
                            <label for="">Email address <span style="color:red;">*</span></label>
                            <input type="email" class="form-control form-control-border" name="email" value="<?=$customer_email?>">
                        </div>
                        <div class="" style="margin-top:40px;">
                            <input type="submit" name="submit" class="btn btn-primary" value="SAVE CHANGES">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include 'layout/footer.php'; ?>
    