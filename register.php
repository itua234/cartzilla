<?php 
    session_start();
    include 'layout/header.php';
    //connect to database
    include 'Functions.php';
    $user = new User();
    include 'includes/inc_reg.php';
?>
    <section class="m-t-80 m-b-30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-xl-5 col-md-6 col-sm-7" style="padding:20px;">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <h3 class="text-center" style="font-weight:bolder;">Sign up</h3>
                        <p class="error text-center"><?php if(isset($errors['error'])){echo $errors['error']; } ?></p>
                        <input type="hidden" name="csrf_token" value="<?=$user->generateToken()?>">
                        <div class="d-flex flex-column">
                            <input type="email" placeholder="Email" name="email" class="form-control form-control-border" value="<?=$email?>">
                            <span class="error"><?php if(isset($errors['email'])){echo $errors['email']; } ?></span>
                        </div>
                        <div class="d-flex flex-column m-t-15">
                            <div class="d-flex" style="border:1px solid #e9ecef;">
                                <input type="password" placeholder="Password" name="password" class="form-control" id="toggle">
                                <span class="d-flex align-items-center justify-content-center p-r-10 p-l-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                            </div>
                            <span class="error">
                                <?php 
                                    if(isset($errors['pass'])):
                                        echo $errors['pass'];
                                    endif;
                                ?>
                            </span>
                            <span class="error">
                                <?php 
                                    if(isset($errors2)):
                                        if(is_array($errors2)):
                                            foreach($errors2 as $array):
                                                echo $array . "<br>";
                                            endforeach;
                                        endif;
                                    endif;
                                ?>
                            </span>
                        </div>
                        <span class="" style="font-size:12px;font-style:italic">By registering your details, you agree with our Terms & Conditions, and Privacy and Cookie Policy. </span>
                        <div class="form-check form-switch m-t-10">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Sign me up for the Newsletter! </label>
                        </div>
                        <div class="d-flex justify-content-end m-t-20">
                            <button type="submit" name="submit" class="btn btn-primary rounded-all w-full">Sign Up</button>
                        </div>
                    </form>
                    <p class="m-t-10">Already have an account?<a href="login.php" style="color:#00004e;padding-left:5px;display:inline-block;">Sign In</a></p>
                </div>
            </div>  
        </div>
    </section>
<?php include 'layout/footer.php'; ?>