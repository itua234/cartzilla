<?php 
    session_start();
    include 'layout/header.php';
    //connect to database
    include 'Functions.php';
    $user = new User();
?>
  <div class="m-t-100">
    <?php
      $reference = substr(md5(uniqid(rand(),1)),3,14);
      echo $reference."<br>";
      echo $user->reference()."<br>";
      echo $user->getRealIp()."<br>";
      $array = [
        "spark1",
        "spark2",
        "spark3"
      ];
        //get current time
        $current_time = time();
        //set cookie expiration for 1 month
        $cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);
        //set cookie
        setcookie("wishlist", $array, $cookie_expiration_time);
        if(isset($_COOKIE["wishlist"])):
          foreach($_COOKIE["wishlist"] as $value):
            echo "value:".$value."<br>";
          endforeach;
        endif;
    ?>
  </div>
  <button class="btn btn-primary clicktest" type="button">Click me</button>
  <div class="testcontainer" style="border:2px solid red;"></div>
  <div class="form-animation justify-content-center align-items-center pos-fixed">
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
  </div>
	<!-- Title page -->
	<section class="m-t-60 bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			About
		</h2>
	</section>	
	<div class="hamburger" data-toggle="collapse" data-target="#shipping_collapse" aria-expanded="false" aria-controls="shipping_collapse">
        <div class="menu menu-1"></div>
        <div class="menu menu-2"></div>
        <div class="menu menu-3"></div>
    </div>
    <div class="collapse" id="shipping_collapse">
  <div class="card card-body">
    Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
  </div>
</div>
<?php include 'layout/footer.php'; ?>
		

	