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
        <title>Forgot Password</title>

    </head>
    <body>  
        
        <?php include 'component/topbar.php'; ?>

        <section class="page-header">

            <div class="box">

                <div class="title-row">
                    <span class="round-shape"></span>
                    <h2 class="banner-title">Forgot Password</h2>
                </div>
                <div class="bread-crumb">
                    <a href="index.php">Home</a> / Forgot Password
                </div>
                
            </div>
            
        </section>

        <section class="checkout-section">
            <div class="container">
                <div class="checkout-box">
                    <div class="left">
                        <div class="customer-login">
                            Enter email to get reset link
                        </div>
                        <div class="billing-fields">
                            <h3>Forgot Password</h3>
                            <div class="row">

                                <div class="colFull">
                                    <label>Email</label>
                                    <input placeholder="" name="email" type="email" id="email" required>
                                </div>
                        
                                <div class="auth-btn">
                                    <button type="button" class="button" name="reset" id="resetButton">RESET</button>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <img src="images/ico-7.jpg" style="width: 100%;" />
                    </div>
                </div>
            </div>
        </section>


        <?php include 'component/footer.php'; ?>
        <script>
            $('.rightmenu a[href="login.php"]').addClass('active');
            var sendlink = true;
            $(document).ready(function(){
                $("#resetButton").on("click", function(){

                    var button = $(this);
                    var count = 120; // 2 minutes in seconds

                    if(sendlink){
                        button.text("Please Wait..."); // Reset button text
                        button.prop("disabled", true); // Enable button after countdown
                        var param = {
                            'email': $('#email').val(),
                            'forgot' : 1
                        }

                        $.ajax({
                            type: "POST",
                            url: "function.php",
                            data: param,
                            cache: false,
                            dataType: "json",
                            success: function(data) {

                                alert('Reset Link Have Sent!');

                            },
                            error: function(data){
                            
                            }
                        });

                        $('#email').val('');
                        alert('Reset Email Sent! Please Your Email');

                        sendlink = false;

                        

                        button.prop("disabled", true); // Disable button during countdown

                        var countdownInterval = setInterval(function(){
                            count--;
                            var minutes = Math.floor(count / 60);
                            var seconds = count % 60;

                            // Format seconds with two decimals
                            var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

                            // Update button text to show countdown
                            button.text("Resend in: " + minutes + ":" + formattedSeconds);

                            if(count === 0) {
                                clearInterval(countdownInterval);
                                button.text("Get Reset Link"); // Reset button text
                                button.prop("disabled", false); // Enable button after countdown
                                sendlink = true;
                            }
                        }, 1000); // Update every half second

                    }
                    
                });
            });
        </script>
        

    </body>
</html>