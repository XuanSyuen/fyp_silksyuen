<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- import google font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="css/common.css"/>
        <link rel="stylesheet" href="css/form.css"/>
        <title>Login</title>

    </head>
    <body>  
        
        <?php include 'component/topbar.php'; ?>

        <section class="page-header">

            <div class="box">

                <div class="title-row">
                    <span class="round-shape"></span>
                    <h2 class="banner-title">Login</h2>
                </div>
                <div class="bread-crumb">
                    <a href="index.php">Home</a> / Login
                </div>
                
            </div>
            
        </section>

        <section class="checkout-section">
            <div class="container">
                <div class="checkout-box">
                    <div class="left">
                        <div class="customer-login">
                            Does not have account ? <a href="register.php">Click here to Sign Up</a>
                        </div>
                        <div class="billing-fields">
                            <h3>Login</h3>
                            <form action="function.php" method="POST">
                                <div class="row">

                                    <div class="colFull">
                                        <label>Email</label>
                                        <input placeholder="" name="email" type="email" required>
                                    </div>
                            
                                    <div class="colFull">
                                        <label>Password</label>
                                        <input placeholder="" name="password" type="password" required>
                                    </div>

                                    <div class="colFull">
                                        <a class="forgot-link" href="forgot.php">Forgot your password?</a>
                                    </div>

                                    <div class="auth-btn">
                                        <button type="submit" class="button" name="login">SIGN IN</button>
                                    </div>
                                  
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <img src="images/ico-2.jpg" style="width: 100%;" />
                    </div>
                </div>
            </div>
        </section>


        <?php include 'component/footer.php'; ?>
         <script>
            $('.rightmenu a[href="login.php"]').addClass('active');
        </script>
        

    </body>
</html>