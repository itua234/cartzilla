<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'auth.php';
    $errors = $errors2 = array();
    $firstname = $lastname = $email = $zip_code = $town = $state = $company_name = $street = "";
    $firstName = $lastName = "";
    if(isset($_SESSION['id'])):
        $customer_id = $_SESSION['id'];
        if(isset($_POST['submit'])):
            $firstname = $user->escape_string($_POST['firstname']);
            $lastname  = $user->escape_string($_POST['lastname']);
            $email = $user->escape_string($_POST['email']);
            $zip_code = $user->escape_string($_POST['zip_code']);
            $town  = $user->escape_string($_POST['town']);
            $state = $user->escape_string($_POST['state']);
            $company_name = $user->escape_string($_POST['company_name']);
            $street = $user->escape_string($_POST['street']);

            //validate firstname
            if(empty($firstname)):
                $errors['firstname'] = "First name is a required field.";
            else:
                $firstname = $user->test_input($firstname);
                if(!preg_match("/^[a-zA-Z]*$/", $firstname)){
                    $errors['firstname'] = "Invalid name format";
                }
            endif;

            //validate lastname
            if(empty($lastname)):
                $errors['lastname'] = "Last name is a required field.";
            else:
                $lastname = $user->test_input($lastname);
                if(!preg_match("/^[a-zA-Z]*$/", $lastname)){
                    $errors['lastname'] = "Invalid name format";
                }
            endif;

            //validate email address
            if(empty($email)):
                $errors['email'] = "Email is a required field";
            else:
                $email = $user->test_input($email);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)):
                    $errors['email'] = "Invalid email format";
                endif;
            endif;

            //validate  zip_code
            if(empty($zip_code)):
                $errors['zip'] = "Zip is a required field.";
            else:
                $zip_code = $user->test_input($zip_code);
            endif;

            //validate  town / city
            if(empty($town)):
                $errors['town'] = "Town / City is a required field.";
            else:
                $town = $user->test_input($town);
            endif;

            //validate  state
            if(empty($state)):
                $errors['state'] = "State is a required field.";
            else:
                $state = $user->test_input($state);
            endif;

            //validate  company name
            if(!empty($company_name)):
                $company_name = $user->test_input($company_name);
            endif;

            //validate  street
            if(empty($street)):
                $errors['street'] = "State is a required field.";
            else:
                $street = $user->test_input($street);
            endif;

            //if there are no errors insert into database...
            if(count($errors) == 0):
                $sql = "SELECT * FROM shipping WHERE customer_id='$customer_id' LIMIT 1";
                $row = $user->details($sql);
                if(is_array($row)):
                    $sql = "UPDATE shipping SET firstname='$firstname', email='$email', lastname='$lastname', state='$state', street='$street', company_name='$company_name', town='$town', zipcode='$zip_code' WHERE customer_id='$customer_id' LIMIT 1";
                    $result = $user->update($sql);
                    if($result):
                        //header("location: edit-address.php");
                        echo "details have been updated";
                    endif;
                else:
                    $sql = "INSERT INTO shipping (customer_id, email, firstname, lastname, zipcode, state, town, company_name, street) VALUES ('$customer_id', '$email', '$firstname', '$lastname', '$zip_code', '$state', '$town', '$company_name', '$street')";
                    $result = $user->insert($sql);
                    if($result):
                        //header("location: edit-address.php");
                        echo "details have been inserted";
                    endif;
                endif;
            endif;
        endif;
        
        $sql = "SELECT * FROM shipping WHERE customer_id='$customer_id' LIMIT 1";
        $result = $user->details($sql);
        if($result):
            $firstName = $result['firstname'];
            $lastName = $result['lastname'];
            $zip_code = $result['zipcode'];
            $town = $result['town'];
            $state = $result['state'];
            $company_name = $result['company_name'];
            $street = $result['street'];
            $email = $result['email'];
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
                    <h4>Shipping Addresses</h4>
                    <form method="post" style="padding-top:10px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                            <label for="" style="font-weight:bold;font-size:14px;">Company name (optional)</label>
                            <input type="text" class="form-control form-control-border" name="company_name" value="<?=$company_name?>">
                        </div>
                        <div class="d-flex flex-column" style="margin-top:20px;">
                            <label for="" style="font-weight:bold;font-size:14px;">Street address <span style="color:red;">*</span></label>
                            <input type="text" placeholder="House number and street name" class="form-control form-control-border" name="street" value="<?=$street?>">
                        </div>
                        <div class="d-flex flex-wrap dashlist-form justify-content-between" style="margin-top:20px;">
                            <div class="d-flex flex-column dashlist-form-100 dashlist-form-200">
                                <label for="" style="font-weight:bold;font-size:14px;">Email address <span style="color:red;">*</span></label>
                                <input type="email" class="form-control form-control-border" name="email" value="<?=$email?>">
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col">
                                <label for="" style="font-weight:bold;font-size:14px;">Postcode / ZIP <span style="color:red;">*</span></label>
                                <input type="text" class="form-control form-control-border" name="zip_code" value="<?=$zip_code?>">
                            </div>
                            <div class="col">
                                <label for="" style="font-weight:bold;font-size:14px;">Town / City <span style="color:red;">*</span></label>
                                <input type="text" class="form-control form-control-border" name="town" value="<?=$town?>">
                            </div>
                        </div>
                        <div class="d-flex flex-column" style="margin-top:20px;">
                            <label for="" style="font-weight:bold;font-size:14px;">State <span style="color:red;">*</span></label>
                            <input type="text" class="form-control form-control-border" name="state" value="<?=$state?>">
                        </div>
                        <div class="" style="margin-top:40px;">
                            <input type="submit" name="submit" class="btn btn-primary" value="SAVE ADDRESS">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include 'layout/footer.php'; ?>
    