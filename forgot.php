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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                            <form action="function.php" method="POST" onsubmit="return validateForm()">
                            <div class="row">

                                <div class="colFull">
                                    <label>Email</label>
                                    <input placeholder="" name="email" type="email" id="email" required>
                                </div>
                        
                                <div class="auth-btn">
                                    <button type="submit" class="button" name="reset" id="resetButton">RESET</button>
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
            $(document).ready(function() {
        $("#resetButton").on("click", function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            var email = $('#email').val().trim();

            // Validate email field
            if (email === '') {
                alert('Please enter your email address.');
                return; // Stop the function if validation fails
            } else if (!validateEmail(email)) {
                alert('Please enter a valid email address.');
                return; // Stop the function if validation fails
            }

            // Email is valid, proceed with AJAX request
            sendPasswordResetRequest(email);
        });

        // Helper function to validate email format
        function validateEmail(email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        // Function to handle the AJAX request
        function sendPasswordResetRequest(email) {
            var button = $("#resetButton");
            var count = 120; // 2 minutes in seconds
            button.prop("disabled", true).text("Please Wait..."); // Disable button and change text

            $.ajax({
                type: "POST",
                url: "function.php",
                data: { 'email': email, 'forgot': 1 },
                dataType: "json",
                success: function(response) {
                    if(response.status === 'error') {
                        alert(response.message);
                    } else {
                        alert('Reset Link Have Sent! Please check your email.');
                    }
                    button.prop("disabled", false).text("RESET"); // Enable button and reset text
                },
                error: function() {
                    alert('There was an error processing your request. Please try again.');
                    button.prop("disabled", false).text("RESET"); // Enable button and reset text
                }
            });

            // Start countdown for resend link
            var countdownInterval = setInterval(function() {
                count--;
                var minutes = Math.floor(count / 60);
                var seconds = count % 60;
                var formattedSeconds = seconds < 10 ? "0" + seconds : seconds;
                button.text("Resend in: " + minutes + ":" + formattedSeconds);

                if (count === 0) {
                    clearInterval(countdownInterval);
                    button.text("RESET").prop("disabled", false); // Enable button and reset text
                }
            }, 1000); // Update every second
        }
    });
        </script>
        

    </body>
</html>