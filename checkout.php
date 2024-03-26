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
        <link rel="stylesheet" href="css/checkout.css"/>
        <title>Checkout</title>

    </head>
    <body>  
        <?php include 'component/topbar.php'; ?>

        <?php 

            $sql = "SELECT * FROM cart INNER JOIN product ON cart.product_id = product.product_id where user_id = '$cid'";
            $result = mysqli_query($conn, $sql);
            $carttotal = mysqli_num_rows($result);

            if($carttotal == 0){
                echo "<script>alert('Add item to cart first.');</script>";
                echo "<script>window.location.href='shop.php';</script>"; 
            }

        ?>

        <section class="page-header">

            <div class="box">

                <div class="title-row">
                    <span class="round-shape"></span>
                    <h2 class="banner-title">Checkout</h2>
                </div>
                <div class="bread-crumb">
                    <a href="index.html">Home</a> / Checkout
                </div>
                
            </div>
            
        </section>

        <section class="checkout-section">
            <form method="POST" action="function.php">
                <div class="container">
                    <div class="checkout-box">
                        <div class="left">
                            <div class="billing-fields">
                                <h3>Billing Info</h3>
                                <div class="row">

                                    <input type="hidden" name="uid" value="<?php echo $cid; ?>">
                                   
                    
                                    <div class="colFull">
                                        <label>Address 1*</label>
                                        <input name="address1" type="text"  required>
                                    </div>
                                    <div class="colFull">
                                        <label>Address 2</label>
                                        <input name="address2" type="text">
                                    </div>
                                    <div class="colHalf">
                                        <label>Postal Code</label>
                                        <input name="postcode" type="text" required>
                                    </div>
                                    <div class="colHalf">
                                        <label>City</label>
                                        <input name="city" type="text" required>
                                    </div>
                                    <div class="colHalf">
                                        <label>State</label>
                                        <input name="state" type="text" required>
                                    </div>
                                    <div class="colHalf">
                                        <label>Country</label>
                                        <input name="country" type="text" value="Malaysia" readonly>
                                    </div>
                                    
                                    <div class="colFull">
                                        <label>Order Note</label>
                                        <textarea name="remark" placeholder=""></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="checkout-review-order" id="order_review">
                                <h3>Your Order</h3>
                                <table class="check-table checkout-review-order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Products</th>
                                            <th class="product-total"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                            $finalTotal = 0;
                                            while($row = mysqli_fetch_assoc($result)) { 
                                                $totalsub = $row['total_qty'] * $row['product_price'];
                                                $finalTotal += $totalsub;
                                        ?>

                                        <tr class="cart-item">
                                            <td class="product-name">
                                                <?php echo $row['product_name']; ?>
                                                x <?php echo $row['total_qty']; ?>
                                            </td>
                                            <td class="product-total">
                                                <div class="product-price clearfix">
                                                    <span class="price">
                                                        <span>
                                                            <span class="currencySymbol">RM</span>
                                                            <?php echo number_format($totalsub, 2); ?>
                                                        </span>
                                                    </span>           
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td>
                                                <div class="product-price clearfix">
                                                    <span class="price">
                                                        <span><span class="currencySymbol">RM</span><?php echo number_format($finalTotal, 2); ?></span>
                                                    </span>           
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Shipping</th>
                                            <td>
                                                <div class="product-price clearfix">
                                                    <span class="price">
                                                        <span><span class="currencySymbol">RM</span>0</span>
                                                    </span>           
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <div class="product-price clearfix">
                                                    <span class="price">
                                                        <span><span class="currencySymbol">RM</span><?php echo number_format($finalTotal, 2); ?></span>
                                                    </span>           
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="checkout-payment" id="payment">
                                    <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_bacs">
                                            <input checked="checked"  name="payment_method" class="input-radio" id="payment_method_bacs" type="radio" value="transfer" class="optionPay" onclick="changeView()">
                                            <label for="payment_method_bacs">Credit Card or Debit Card</label>
                                            <div class="payment_box payment_method_bacs visibales" id="transfer-desc">
                                                <p>
                                                Securely pay for purchases using your credit or debit card, offering convenience and flexibility. Simply input your card details during checkout for swift transactions.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_cod">
                                            <input  name="payment_method" class="input-radio" id="payment_method_cod" type="radio" value="cheque" class="optionPay" onclick="changeView()">
                                            <label for="payment_method_cod">Bank Transfer</label>
                                            <div class="payment_box payment_method_cod" id="cod-desc">
                                                <p>
                                                Seamlessly transfer funds directly from your bank account to complete transactions. Enjoy the ease of electronic payments without the need for physical cash or cards.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_paypal">
                                            <input  name="payment_method" class="input-radio" id="payment_method_paypal" type="radio" value="paypal" class="optionPay" onclick="changeView()">
                                            <label for="payment_method_paypal">Touch 'n Go eWallet<i class="twi-cc-mastercard"></i><i class="twi-cc-visa"></i><i class="twi-cc-paypal"></i><i class="twi-cc-discover"></i></label>
                                            <div class="payment_box payment_method_paypal" id="paypal-desc">
                                                <p>
                                                Experience hassle-free payments with Touch 'n Go eWallet, enabling quick and contactless transactions via your smartphone. Simply scan, pay, and go, without the need for physical cards or cash.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="place-order">
                                    <button class="button" type="submit" name="preorder" onclick="javascript:return confirm('Confirm to place order?')">Order Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>


        <?php include 'component/footer.php'; ?>
        <script type="text/javascript">
            

            var input = document.getElementsByClassName("optionPay");
            var option1 = document.querySelector('#transfer-desc');
            var option2 = document.querySelector('#cod-desc');
            var option3 = document.querySelector('#paypal-desc');

            function changeView(){


                var value = document.querySelector('input[name="payment_method"]:checked').value;
                option1.classList.remove('visibales');
                option2.classList.remove('visibales');
                option3.classList.remove('visibales');

                if(value == 'transfer'){
                    option1.classList.add('visibales');
                }else if(value == 'cheque'){
                    option2.classList.add('visibales');
                }else if(value == 'paypal'){
                    option3.classList.add('visibales');
                }

            }
        

        </script>

    </body>
</html>