<?php

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
<section class="d-flex align-items-center pos-fixed" style="z-index:500;padding:0 15px;height:60px;top:0;left:0;width:100%;">
    <a href="index.php" style="margin-right:auto;"><span>CARTZILLA</span></a>
    <div class="m-r-15">
        <a href="myaccount.php"><img class="w-h-30" src="images/icon/<?php if(isset($_SESSION["id"])){ echo "logged_user.svg"; }else{echo "user.svg";} ?>"></a>
    </div>
    <div class="pos-relative cart-count m-r-15 d-flex align-items-center justify-content-center" style="background-color:#e9ecef;border-radius:50%;width:40px;height:40px;">
        <img class="w-h-25" src="images/icon/heart-01.png">
        <div class="fs-12 d-flex align-items-center justify-content-center pos-absolute" style="width:20px;height:20px;color:white;border-radius:50%;background-color:#fe696a;top:-6px;right:-8px;">
            4
        </div>
    </div>
    <div class="js-show-cart pos-relative m-r-15 d-flex align-items-center justify-content-center" style="background-color:#e9ecef;border-radius:50%;width:40px;height:40px;">
        <img class="w-h-25" src="images/icon/shopping-cart.svg">
        <div class="cart-total-quantity fs-12 d-flex align-items-center justify-content-center pos-absolute" style="width:20px;height:20px;color:white;border-radius:50%;background-color:#fe696a;top:-6px;right:-8px;">
            
        </div>
    </div>
    <div class="hamburger" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <div class="menu menu-1"></div>
        <div class="menu menu-2"></div>
        <div class="menu menu-3"></div>
    </div>
</section>
<div class="collapse container p-t-15 p-b-20" id="collapseExample">
    <div class="row">
        <div class="col">
            <form class="w-full" method="" action="">
                <input type="text" class="form-control form-control-border rounded-all" placeholder="Search for products">
            </form>
            <ul class="list-unstyled m-t-10">
                <li class="nav-list rounded-all"><a href="" class="nav-list-link">Home</a></li>
                <li class="nav-list m-t-10 rounded-all"><a href="" class="nav-list-link">Shop</a></li>
                <li class="nav-list m-t-10 rounded-all"><a href="" class="nav-list-link">Blog</a></li>
                <li class="nav-list m-t-10 rounded-all"><a href="" class="nav-list-link">About</a></li>
                <li class="nav-list m-t-10 rounded-all"><a href="" class="nav-list-link">Contact</a></li>
            </ul>
        </div>
    </div>
</div>
<section class="pos-fixed w-full bg-white" style="z-index:500;height:60px;bottom:0;left:0;border-top:1px solid #e9ecef;">
    <div class="container h-full">
        <div class="row h-full">
            <div class="col-4 flex-column d-flex justify-content-center align-items-center">
                <img class="w-h-30" src="images/icon/heart-01.png">
                <span class="fs-12">Wishlist</span>
            </div>
            <div class="col-4 flex-column d-flex justify-content-center align-items-center" style="border-left:1px solid #e9ecef;" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <div class="hamburger m-b-5">
                    <div class="menu menu-1"></div>
                    <div class="menu menu-2"></div>
                    <div class="menu menu-3"></div>
                </div>
                <span class="fs-12">Menu</span>
            </div>
            <div class="col-4 flex-column d-flex justify-content-center align-items-center" style="border-left:1px solid #e9ecef;">
                <img class="w-h-30" src="images/icon/shopping-cart.svg">
                <div class="fs-12"><span class="cart-total-price"></span></div>
            </div>
        </div>
    </div>
</section>
<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full" data-id="25" style="padding:0;">
					
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $0
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

