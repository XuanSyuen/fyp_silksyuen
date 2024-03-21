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
        <title>My Account</title>

    </head>
    <body>  
        
        <?php include 'component/topbar.php'; ?>

        <section class="page-header">

            <div class="box">

                <div class="title-row">
                    <span class="round-shape"></span>
                    <h2 class="banner-title">My Account</h2>
                </div>
                <div class="bread-crumb">
                    <a href="index.php">Home</a> / Account Profile
                </div>
                
            </div>
            
        </section>

        <section class="checkout-section">
            <div class="container">
                <div class="checkout-box">
                    <div class="left">
                        <div class="billing-fields">
                            <h3>Account Profile</h3>

                            <?php 
                                  $sqlE = "SELECT user_id, user_email, user_name, user_contact FROM user WHERE user_id = '$cid'";
                                  $resultE = mysqli_query($conn, $sqlE);
                                  $rowE = mysqli_fetch_assoc($resultE);

                            ?>
                            <form action="function.php" method="POST">
                                <div class="row">
                                        <input type="hidden" placeholder="Your ID" name="id" autocomplete="off" value="<?php echo $rowE['user_id']; ?>" >

                                        <div class="colFull">
                                            <label>Name*</label>
                                            <input placeholder="" name="name" type="text" value="<?php echo $rowE['user_name']; ?>" required>
                                        </div>
                                        <div class="colHalf">
                                            <label>Email (Non Editable)</label>
                                            <input placeholder="" name="email" type="email" value="<?php echo $rowE['user_email']; ?>" disabled>
                                        </div>
                                        <div class="colHalf">
                                            <label>Contact No*</label>
                                            <input placeholder="" name="mobile" type="number" value="<?php echo $rowE['user_contact']; ?>" required>
                                        </div>
                            
                                        <div class="colFull">
                                            <label>New Password (Optional)</label>
                                            <input placeholder="" name="password" type="password" pattern="^(?=.*[A-Za-z])(?=.*\d).{8,}$" title="Password must be at least 8 characters long and include both letters and numbers." required>
                                        </div>

                                        <div class="auth-btn">
                                            <button type="submit" class="button" name="update-user">Update</button>
                                        </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <img src="images/ico-5.jpg" style="width: 100%;" />
                    </div>
                </div>
            </div>
        </section>


        <?php include 'component/footer.php'; ?>
        
        <script>
            $('.rightmenu a[href="account.php"]').addClass('active');
        </script>

    </body>
</html>