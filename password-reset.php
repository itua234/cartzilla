<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <!-- SEO Meta Tags-->
  <meta name="description" content="Cartzilla - Bootstrap E-commerce Template">
  <meta name="keywords" content="bootstrap, shop, e-commerce, market, modern, responsive,  business, mobile, bootstrap, html5, css3, js, gallery, slider, touch, creative, clean">
  <meta name="author" content="Createx Studio">
  <!-- Viewport-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  
  <meta property="fb:app_id" content="" />
  <meta property="0g:url" content="" />
  <meta property="og:type" content="" />
  <meta property="og:title" content="" />
  <meta property="og:image" content="" />
  <meta property="og:description" content="" />
  <meta property="og:site_name" content="" />
  <meta property="og:locale" content="" />
  <meta property="article_author" content="" />
  
  <meta name="twitter:card" content="" />
  <meta name="twitter:site" content="" />
  <meta name="twitter:creator" content="" />
  <meta name="twitter:url" content="" />
  <meta name="twitter:title" content="" />
  <meta name="twitter:description" content="" />
  <meta name="twitter:image" content="" />
  
  <link href="" ref="publisher" />
  <meta itemprop="name" content="" />
  <meta itemprop="description" content="" />
  <meta itemprop="image" content="" />
  
  <meta name="theme-color" content="" />
  <meta name="apple-mobile-web-app-status-bar-style" content="" />
  
    <title>Cartzilla | Fashion Store v.2</title>
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="css/base.css" type="text/css" media="all">
    <!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
</head>
<style type="text/css">
    .error{
        color:red;
        font-size:14px;
    }
</style>
<body>
    <?php
        if((isset($_GET['token'])) && isset($_GET['email'])):
            $token = $_GET['token'];
            $email = $_GET['email'];
            $email = $user->escape_string($email);
            if(!empty($email)):
                $email = $user->test_input($email);
            endif;
            $curDate = date("Y-m-d H:i:s");
            $sql = "SELECT * FROM passwordreset WHERE email='$email' and token='$token' LIMIT 1";
            $row = $user->details($sql);
            if(is_array($row)):
                $expDate = $row['exp_time'];
                if($expDate >= $curDate):
                    ?>
                    <section class="m-b-30 m-t-80">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-5 col-xl-5 col-md-6 col-sm-7" style="padding:20px;">
                                    <form method="post" class="reset_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <h3 class="text-center" style="font-weight:bolder;">Password Reset</h3>
                                        <p class="text-center">Enter your new password.</p>
                                        <p class="error text-center"><?php if(isset($errors['error'])){echo $errors['error']; } ?></p>
                                        <input type="hidden" name="csrf_token" value="<?=$user->generateToken()?>">
                                        <input type="hidden" name="email" value="<?=$email?>">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex" style="border:1px solid #e9ecef;">
                                                <input type="password" placeholder="New Password" name="password" class="form-control" id="toggle" value="">
                                                <span class="d-flex align-items-center justify-content-center p-l-10 p-r-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                                            </div>
                                            <div class="error error1"></div>
                                            <div class="error error2"></div>
                                        </div>
                                        <div class="d-flex flex-column m-t-15">
                                            <div class="d-flex" style="border:1px solid #e9ecef;">
                                                <input type="password" placeholder="Confirm New Password" name="confirm_password" class="form-control" id="toggle" value="">
                                                <!--<span class="d-flex align-items-center justify-content-center p-l-10 p-r-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>-->
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end m-t-30">
                                            <button type="submit" name="submit" class="btn btn-primary rounded-all w-full">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                        <div class="form-animation justify-content-center align-items-center pos-fixed">
                            <div class="wave"></div>
                            <div class="wave"></div>
                            <div class="wave"></div>
                            <div class="wave"></div>
                            <div class="wave"></div>
                        </div>
                    </section>
                    <?php
                endif;
            endif;
        endif;
    ?>

    <!--===============================================================================================-->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
    <script src="js/slick-custom.js"></script>
    <!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<!--===============================================================================================-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js.map"></script>
    <!--===============================================================================================-->
    <script src="https://kit.fontawesome.com/4211943ec2.js" crossorigin="anonymous"></script>
	<script>
        $(document).ready(function(){
			$('.reset_form').on("submit",function(event){
				event.preventDefault();
                var formData = $(this).serialize();
                //start the animation
                $('.form-animation').css({"display":"flex"});
                $('.error1').text("");
                $('.error2').text("");
				$.ajax({
					type:'post',
					url:'ajax_reset.php',
					data:formData,
					dataType:'json'
				})
				//using the done promise callback
				.done(function(data){
					if(data){
						// stop the animation
                        $('.form-animation').css({"display":"none"});
                        if(data.errors1){
                            $('.error1').text(data.errors1.pass);
                        }   
                        if(data.errors2){
                            var error2 = data.errors2;
                            if(error2 instanceof Array){
                                for(var i=0; i<error2.length; i++){
                                    $('.error2').append("<span>"+error2[i]+"</span>");
                                }
                            }
                        }  
                        if(data.msg){
                            //alert(data.msg);
                            swal(data.msg, "", "success");
                        }
					}
				})
				//using the fail promise callback
				.fail(function(data){

				});
			});
		});
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
	<!--===============================================================================================-->
    <script>
        function togglePassword(){
            var toggle = document.getElementById('toggle');
            switch(true){
                case(toggle.type === "password"):
                    toggle.type = "text";
                break;
                default:
                    toggle.type = "password";
            }
        }
    </script>
</body>
</html>