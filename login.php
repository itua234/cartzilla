<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'includes/inc_login.php';
    include 'layout/header.php';
?>
    <section class="m-b-30 m-t-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-xl-5 col-md-6 col-sm-7" style="padding:20px;">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h3 class="text-center" style="font-weight:bolder;">Sign In</h3>
                        <p class="error text-center"><?php if(isset($errors['error'])){echo $errors['error']; } ?></p>
                        <input type="hidden" name="csrf_token" value="<?=$user->generateToken()?>">
                        <div class="d-flex flex-column">
                            <input type="email" placeholder="Email" name="email" class="form-control form-control-border" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; }?>">
                            <span class="error"><?php if(isset($errors['email'])){echo $errors['email']; } ?></span>
                        </div>
                        <div class="d-flex flex-column m-t-15">
                            <div class="d-flex" style="border:1px solid #e9ecef;">
                                <input type="password" placeholder="Password" name="password" class="form-control" id="toggle" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; }?>">
                                <span class="d-flex align-items-center justify-content-center p-l-10 p-r-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                            </div>
                            <span class="error"><?php if(isset($errors['pass'])){echo $errors['pass']; } ?></span>
                        </div>
                        <div class="d-flex justify-content-between m-t-10">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="remember" value="remember">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Remember Me</label>
                            </div>
                            <div class="">
                                <p class="text-center" style=""><a href="reset.php" class="text-decoration-none" style="color:#00004e;">Forgot password?</a></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="submit" class="btn btn-primary rounded-all w-full">Sign In</button>
                        </div>
                    </form>
                    <p class="m-t-10">Don't have an account?<a class="text-decoration-none" href="register.php" style="color:#00004e;padding-left:5px;display:inline-block;">Sign up</a></p>
                </div>
            </div>  
        </div>
    </section>
<?php include 'layout/footer.php'; ?>