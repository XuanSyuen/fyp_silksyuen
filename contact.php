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
        <title>Contact</title>

    </head>
    <body>  
        
        <?php include 'component/topbar.php'; ?>

        <section class="page-header">

            <div class="box">

                <div class="title-row">
                    <span class="round-shape"></span>
                    <h2 class="banner-title">Contact Us</h2>
                </div>
                <div class="bread-crumb">
                    <a href="index.php">Home</a> / Contact Us
                </div>
                
            </div>
            
        </section>

        <section class="checkout-section">
            <div class="container">
                <div class="checkout-box align-center">
                    <div class="left">
                        <div class="customer-login">
                        Get in touch with us here |<a>Or send an email to silksyuen@gmail.com</a>
                        </div>
                        <div class="billing-fields">
                            <h3>Fill In Below</h3>
                            <form action="function.php" method="POST" onsubmit="return validateForm()">
                                <div class="row">

                                    <div class="colFull">
                                        <label>Name</label>
                                        <input placeholder="" name="name" type="text" required>
                                    </div>
                            
                                    <div class="colHalf">
                                        <label>Email</label>
                                        <input placeholder="" name="email" type="email" required>
                                    </div>

                                    <div class="colHalf">
                                        <label>Phone No</label>
                                        <input placeholder="" name="mobile" type="text" required>
                                    </div>

                                    <div class="colFull">
                                        <label>Subject</label>
                                        <input placeholder="" name="subject" type="text" required>
                                    </div>
                            
                                    <div class="colFull">
                                        <label>Message</label>
                                        <textarea cols="3" name="message" required></textarea>

                                    </div>

                                    <div class="auth-btn">
                                        <button type="submit" class="button" name="contact">Submit</button>
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <img src="images/ico-4.jpg" style="width: 100%;" />
                    </div>
                </div>
            </div>
        </section>

        <?php include 'component/footer.php'; ?>
        <script>
            $('.navmenu a[href="contact.php"]').addClass('active');

            function validateForm() {
        // Validate name
        var name = document.forms[0]["name"].value;
        if (name == "") {
            alert("Name must be filled out");
            return false;
        }

        // Validate email
        var email = document.forms[0]["email"].value;
        if (email == "") {
            alert("Email must be filled out");
            return false;
        } else {
            // Simple email format validation
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Invalid email format");
                return false;
            }
        }

        // Validate phone number
        var mobile = document.forms[0]["mobile"].value;
        if (mobile == "") {
            alert("Phone No must be filled out");
            return false;
        }

        // Validate subject
        var subject = document.forms[0]["subject"].value;
        if (subject == "") {
            alert("Subject must be filled out");
            return false;
        }

        // Validate message
        var message = document.forms[0]["message"].value;
        if (message == "") {
            alert("Message must be filled out");
            return false;
        }

        // If everything is valid, allow form submission
        return true;
    }
        </script>
    </body>
</html>