<?php
    if(isset($_POST['coupon_btn'])):
        //escape user input
        $coupon = $user->escape_string($_POST['coupon']);
        echo $coupon;
    endif;
    $errors = array();
    $firstname2 = $lastname2 = $street2 = $town2 = "";
    if(isset($_POST['order_btn'])):
        //Sanitize/escape user input
        $email = $user->escape_string($_POST['b_email']);
        $phone = $user->escape_string($_POST['b_phone']);
        $street = $user->escape_string($_POST['b_street']);
        $state = $user->escape_string($_POST['b_state']);
        $town = $user->escape_string($_POST['b_town']);
        $country = $user->escape_string($_POST['b_country']);
        $firstname = $user->escape_string($_POST['b_first_name']);
        $lastname = $user->escape_string($_POST['b_last_name']);

        //Validate form input
         //validate state
        $stateArray = array(
            0 => 'Abia',1 => 'Abuja',
            2 => 'Adamawa',3 => 'Akwa Ibom',
            4 => 'Anambra',5 => 'Bauchi',
            6 => 'Bayelsa',7 => 'Borno',
            8 => 'Benue',9 => 'Cross River',
            10 => 'Delta',11 => 'Ebonyi',
            12 => 'Edo',13 => 'Ekiti',
            14 => 'Enugu',15 => 'Gombe',
            16 => 'Imo',17 => 'Jigawa',
            18 => 'Kaduna',19 => 'Kano',
            20 => 'Katsina',21 => 'Kebbi',
            22 => 'Kogi',23 => 'Kwara',
            24 => 'Lagos',25 => 'Nassarawa',
            26 => 'Niger',27 => 'Ogun',
            28 => 'Ondo',29 => 'Osun',
            30 => 'Oyo',31 => 'Plateau',
            32 => 'Rivers',33 => 'Sokoto',
            34 => 'Taraba',35 => 'Yobe',
            36 => 'Zamfara',100 => 'Choose an option'
        );
        foreach($stateArray as $key => $value){
            if($key == $state){
                $state_value = $value;
                global $state_value;
            }
        };
        if($state_value !== "Choose an option"):
            $state_value = $user->test_input($state_value);
        else:
            $state_value = NULL;
        endif;

        //validate firstname
        if(empty($firstname)):
            $errors['firstname'] = "Billing First name is a required field.";
        else:
            $firstname = $user->test_input($firstname);
            if(!preg_match("/^[a-zA-Z]*$/", $firstname)){
                $errors['firstname'] = "Invalid name format";
            }
        endif;

        //validate lastname
        if(empty($lastname)):
            $errors['lastname'] = "Billing Last name is a required field.";
        else:
            $lastname = $user->test_input($lastname);
            if(!preg_match("/^[a-zA-Z]*$/", $lastname)){
                $errors['lastname'] = "Invalid name format";
            }
        endif;

        //validate email address
        if(empty($email)):
            $errors['email'] = "Billing Email is a required field";
        else:
            $email = $user->test_input($email);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)):
                $errors['email'] = "Invalid email format";
            endif;
        endif;

        //validate  phone
        if(empty($phone)):
            $errors['phone'] = "Billing Phone is a required field.";
        else:
            $phone = $user->test_input($phone);
        endif;

        //validate  street
        if(empty($street)):
            $errors['street'] = "Billing Street address is a required field.";
        else:
            $street = $user->test_input($street);
        endif;

        //validate  town
        if(empty($town)):
            $errors['town'] = "Billing Town / City is a required field.";
        else:
            $town = $user->test_input($town);
        endif;

        //validate  country
        if(!empty($country)):
            $country = $user->test_input($country);
        else:
            $country = NULL;
        endif;

        //Check if there's a different address for shipping 
        if(isset($_POST['shipping-check'])):
            $firstname2 = $user->escape_string($_POST['s_first_name']);
            $lastname2 = $user->escape_string($_POST['s_last_name']);
            $street2 = $user->escape_string($_POST['s_street1']);
            $town2 = $user->escape_string($_POST['s_town']);
            $country2 = $user->escape_string($_POST['s_country']);
            $zipcode2 = $user->escape_string($_POST['s_zipcode']);

            //validate firstname
            if(empty($firstname2)):
                $errors['firstname2'] = "Shipping First name is a required field.";
            else:
                $firstname2 = $user->test_input($firstname2);
                if(!preg_match("/^[a-zA-Z]*$/", $firstname2)){
                    $errors['firstname2'] = "Invalid name format";
                }
            endif;

            //validate lastname
            if(empty($lastname2)):
                $errors['lastname2'] = "Shipping Last name is a required field.";
            else:
                $lastname2 = $user->test_input($lastname2);
                if(!preg_match("/^[a-zA-Z]*$/", $lastname2)){
                    $errors['lastname2'] = "Invalid name format";
                }
            endif;

            //validate  street
            if(empty($street2)):
                $errors['street2'] = "Shipping Street address is a required field.";
            else:
                $street2 = $user->test_input($street2);
            endif;

            //validate  town
            if(empty($town2)):
                $errors['town2'] = "Shipping Town / City is a required field.";
            else:
                $town2 = $user->test_input($town2);
            endif;

            //validate  country
            if(!empty($country2)):
                $country2 = $user->test_input($country2);
            else:
                $country2 = NULL;
            endif;

            //validate  zipcode
            if(!empty($zipcode2)):
                $zipcode2 = $user->test_input($zipcode2);
            else:
                $zipcode2 = NULL;
            endif;
        else:
            $firstname2 = $firstname;
            $lastname2 = $lastname;
            $street2 = $street;
            $town2 = $town;
            $country2 = $country;
            $zipcode2 = NULL;
        endif;
        //if there are no errors insert into database...
        if(count($errors) == 0):
            //Generates a pseudo-unique reference
            $reference_id = $user->reference();
            $user_email = $_SESSION['email'];
            $public_key = "pk_test_6f455aced231a01895f203605546f1ac47664de1";

            $sql = "INSERT INTO orders (order_id, customer_id, order_date, reference_id, total) VALUES (NULL, '$user_id', NOW(), '$reference_id', '$cart_total')";
            $results = $user->insert($sql);
            if($results):
                $query = "SELECT order_id FROM orders WHERE reference_id='$reference_id' LIMIT 1";
                $row = $user->details($query);
                if($row):
                    $order_id = $row["order_id"];
                endif;
            endif;
            $_SESSION['payment'] = [
                $reference_id,
                $user_email,
                $cart_total,
                $public_key,
                $order_id
            ];
            //Create jididiudiu
            $price = "price";
            $quantity = "quantity";
            $product_id = "product_id";
            foreach($_SESSION['shopping_cart'] as $key):
                $sql = "INSERT INTO order_contents (oc_id, order_id, product_id, price, quantity, ship_date) VALUES (NULL, '$order_id', '$key[$product_id]', '$key[$price]', '$key[$quantity]', NOW())";
                $insert = $user->insert($sql);
                if($insert):
                    $sql = "INSERT INTO order_address (id, order_id, billing_firstname, billing_lastname, billing_email, billing_phone, billing_street, billing_town, billing_state, billing_country, shipping_firstname, shipping_lastname, shipping_country, shipping_street, shipping_town, shipping_zipcode) VALUES (NULL, '$order_id', '$firstname', '$lastname', '$email', '$phone', '$street', '$town', '$state_value', '$country', '$firstname2', '$lastname2', '$country2', '$street2', '$town2', '$zipcode2')";
                    $result = $user->insert($sql);
                    if($result):
                        
                    endif;
                endif;
            endforeach;
            $url = "order-pay.php";
            $user->redirect_url($url);
            exit();
        endif;
    endif;
?>