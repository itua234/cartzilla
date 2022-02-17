<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'includes/inc_reset.php';
    include 'layout/header.php';
?>
    <section class="m-b-30 m-t-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-xl-5 col-md-6 col-sm-7" style="padding:20px;">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h3 class="text-center" style="font-weight:bolder;">Password Reset</h3>
                        <p class="text-center">Enter your email to reset your password.</p>
                        <p class="text-center" style="color:green;"><?php if(isset($errors['message'])){echo $errors['message']; } ?></p>
                        <input type="hidden" name="csrf_token" value="<?=$user->generateToken()?>">
                        <div class="d-flex flex-column">
                            <input type="email" placeholder="Email" name="email" class="form-control form-control-border" value="<?php if(isset($email)){ echo $email; }?>">
                            <span class="error"><?php if(isset($errors['email'])){echo $errors['email']; } ?></span>
                        </div>
                        <div class="d-flex justify-content-end m-t-30">
                            <button type="submit" name="submit" class="btn btn-primary rounded-all w-full">Submit</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </section>
<?php include 'layout/footer.php'; ?>