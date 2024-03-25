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
        <link rel="stylesheet" href="css/cart.css"/>
        <title>My Cart</title>

    </head>
    <body>  
        <?php include 'component/topbar.php'; ?>
        <section class="page-header">

            <div class="box">

                <div class="title-row">
                    <span class="round-shape"></span>
                    <h2 class="banner-title">Cart</h2>
                </div>
                <div class="bread-crumb">
                    <a href="index.html">Home</a> / Cart
                </div>
                
            </div>
            
        </section>

        <section class="cart-section">
            <div class="container mlrauto">

                <?php if(empty($cid)){ ?>

                    <div class="empty-login">
                        <img src="images/ico-1.jpg" />
                        <h3>SIGN IN TO PUCHASE OUR PRODUCTS</h3>
                        <a class="commonBtn" href="login.php">
                            LOGIN NOW
                        </a>
                    </div>

                <?php }else{ ?>
                
                    <?php 

                        $sql = "SELECT * FROM cart INNER JOIN product ON cart.product_id = product.product_id where user_id = '$cid'";
                        $result = mysqli_query($conn, $sql);
                        $carttotal = mysqli_num_rows($result);

                        if($carttotal == 0){
                    ?>      

                            <div class="empty-login">
                                <img src="images/ico-empty.png" />
                                <h3>Empty Cart ! Add More Product to Cart</h3>
                                <a class="commonBtn" href="products.php">
                                    Browse Products
                                </a>
                            </div>


                    <?php
                        }else{
                    ?>      

                            <form method="POST" action="function.php">
                                <table class="cart-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name-thumbnail">Product Name</th>
                                            <th class="product-price center">Unit Price</th>
                                            <th class="product-quantity center">Quantity</th>
                                            <th class="product-total center">Total</th>
                                            <th class="product-remove center">Action</th>
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
                                            <td class="product-thumbnail-title">
                                                <a>
                                                    <img src="admin/upload/<?php echo $row['product_image'] ?>" alt="">
                                                </a>
                                                <a class="product-name" href="#"><?php echo $row['product_name'] ?></a> 
                                            </td>
                                            <td class="product-unit-price center">
                                                <div class="product-price">
                                                    <span class="price">
                                                        <span>
                                                            <span class="currencySymbol">RM</span>
                                                            <span class="singleprice" data-id="<?php echo $row['product_id']; ?>" ><?php echo number_format($row['product_price'], 2, '.', ''); ?></span>
                                                        </span>
                                                    </span>           
                                                </div>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantityd mlrauto">
                                                    <button class="qtyBtn btnMinus" type="button" data-id="<?php echo $row['product_id'] ?>"><span>-</span></button>

                                                    <input name="qty[]" value="<?php echo $row['total_qty'] ?>" title="Qty" class="input-text qty text carqty" type="text" data-id="<?php echo $row['product_id'] ?>">

                                                    <input type="hidden" name="cartid[]" value="<?php echo $row['cart_id'] ?>">

                                                    <button class="qtyBtn btnPlus" type="button"  data-id="<?php echo $row['product_id'] ?>">+</button>
                                                </div>
                                            </td>
                                            <td class="product-total center">
                                                <div class="product-price">
                                                    <span class="price">
                                                        <span>
                                                            <span class="currencySymbol">RM</span>
                                                            <span class="subprice" data-id="<?php echo $row['product_id'] ?>">
                                                                <?php echo number_format($totalsub, 2, '.', ''); ?>
                                                            </span>
                                                        </span>
                                                    </span>           
                                                </div>
                                            </td>
                                            <td class="product-remove">
                                                <a href="cart-remove.php?did=<?php echo $row["cart_id"]; ?>" onclick="javascript:return confirm('Confirm to remove?')" ></a>
                                            </td>
                                        </tr>

                                        <?php } ?>
                                        
                                        <tr>
                                            <td colspan="6" class="actions">
                                                <button type="submit" class="button update" name="updatecart">Update Shopping Cart</button>
                                                <a href="products.php" class="button continue-shopping">Continue Shopping</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <div class="checkout-box">
                                <div class="left">
                                    <!--<div class="coupon">
                                        <h3>Counpon discount</h3>
                                        <p>
                                            Enter your code if you have one. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                        </p>
                                        <input type="text" name="coupon_code" placeholder="Enter Your code Here"> 
                                        <button type="submit" class="button" name="apply_coupon">Apply coupon</button>
                                     </div> -->
                                </div>
                                <div class="right">
                                    <div class="cart-totals">
                                        <h2>Cart Totals</h2>
                                        <table class="shop-table">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Sub Total</th>
                                                    <td data-title="Subtotal">
                                                        <span class="amount">
                                                            <span class="currencySymbol">RM</span>
                                                            <span class="subtotal-final"><?php echo number_format($finalTotal, 2, '.', ''); ?></span>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Grand Total</th>
                                                    <td data-title="Subtotal">
                                                        <span class="amount">
                                                            <span class="currencySymbol">RM</span>
                                                            <span class="grandtotal-final">
                                                                <?php echo number_format($finalTotal, 2, '.', ''); ?>
                                                            </span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="proceed-to-checkout">
                                            <a href="checkout.php" class="checkout-button">Proceed to checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                   
                <?php } ?>
            </div>
        </section>

        <?php include 'component/footer.php'; ?>
        <script type="text/javascript">
            $('.btnMinus').on('click', function(){    
                 var dataid = $(this).data('id');
                 var input = $(`.qty[data-id="${dataid}"]`).val();
                 if(input > 1){
                    var newValue = parseFloat(input) - 1;
                    var input = $(`.qty[data-id="${dataid}"]`).val(newValue);
                    var singleprice = $(`.singleprice[data-id="${dataid}"]`).text();
                    var newSub = parseFloat(newValue) * parseFloat(singleprice);
                    $(`.subprice[data-id="${dataid}"]`).html(newSub.toFixed(2));
                     checkFinal();
                }
            });

            $('.btnPlus').on('click', function(){
              
                var dataid = $(this).data('id');
                var input = $(`.qty[data-id="${dataid}"]`).val();
                var newValue = parseFloat(input) + 1;
                var input = $(`.qty[data-id="${dataid}"]`).val(newValue);
                var singleprice = $(`.singleprice[data-id="${dataid}"]`).text();
                var newSub = parseFloat(newValue) * parseFloat(singleprice);
                $(`.subprice[data-id="${dataid}"]`).html(newSub.toFixed(2));

                checkFinal();
            });

            $('.qty').keypress(function(e){ 
               if (this.value.length == 0 && e.which == 48 ){
                  return false;
               }
            });

            $('.qty').on('keyup', function(){

                var dataid = $(this).data('id');
                var value = $(this).val();
                var qty = '';
                if(value == ''){
                    qty = 1;
                }else{
                    qty = value;
                }

                var singleprice = $(`.singleprice[data-id="${dataid}"]`).text();
                var newSub = parseFloat(qty) * parseFloat(singleprice);
                $(`.subprice[data-id="${dataid}"]`).html(newSub.toFixed(2));

                checkFinal();

            });

            function checkFinal(){

                var final = 0;
                $('.subprice').each(function(){

                    final += parseFloat($(this).text());

                });

                $('.subtotal-final').html(final.toFixed(2));
                $('.grandtotal-final').html(final.toFixed(2));

            }
        </script>
    </body>
</html>