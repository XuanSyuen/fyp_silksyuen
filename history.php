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
        <title>Order History</title>
        <style type="text/css">
            .copyright-section.fixed{
                width: -webkit-fill-available;
                border-top: 3px solid #ecf3ff;
                bottom: 0;
                position: fixed;
                padding: 22px 85px 24px;
            }

            .z0{
                z-index: unset;
            }

            .itemrow{
                display: flex;
                align-items: center;
                padding-bottom: 15px;
                gap: 20px;
            }

            .itemrow .innerbox{
                padding-top: 40px;
            }

            .itemrow img{
                width: 120px;
                border-radius: 4px;
            }

            .inline{
                display: flex;
                align-items: left;
                flex-direction: column;
                gap: 10px;
            }

            .inline .title{
                font-weight: 600;
                font-size: 16px;
            }

            .inline p{
                font-size: 14px;
            }
        </style>

    </head>
    <body>  
        
        <?php include 'component/topbar.php'; ?>

        <section class="page-header">

            <div class="box">

                <div class="title-row">
                    <!-- <span class="round-shape"></span> -->
                    <h2 class="banner-title z0">Order History</h2>
                </div>
                <div class="bread-crumb z0">
                    <a href="index.php">Home</a> / Order History
                </div>
                
            </div>
            
        </section>

        <section class="checkout-section" style="padding-top: 0px;">
            <div class="container">
                <div class="checkout-box" style="width: 100%;">
                    <div style="overflow: auto; width: 100%;">
                        <div class="billing-fields">
                            <h3>Order</h3>

                            <?php 
                                 $sqlO = "SELECT * FROM new_order WHERE user_id = '$cid'";
                                 $resultO = mysqli_query($conn, $sqlO);


                            ?>
                            <div class="table_page table-responsive" style="min-width: 1000px;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Delivery Address</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            if (mysqli_num_rows($resultO) > 0) {

                                                $count = 1;
                                                while($rowO = mysqli_fetch_assoc($resultO)) {

                                                    $oid = $rowO['order_id'];

                                                    $sqlSum = "SELECT SUM(price) AS sum, SUM(qty) AS sumQty  FROM order_item WHERE order_id = '$oid' ";
                                                    $resultSum = mysqli_query($conn, $sqlSum);
                                                    $rowSum = mysqli_fetch_assoc($resultSum);
                                                    

                                                    if($rowO['order_status'] == 'completed'){
                                                        $status = '<span class="text-success">Completed</span>';
                                                    }else if($rowO['order_status'] == 'delivering'){
                                                        $status = '<span class="text-warning">Delivering</span>';
                                                    }else if($rowO['order_status'] == 'cancelled'){
                                                        $status = '<span class="text-danger">Cancelled</span>';
                                                    }else{
                                                        $status = '<span>Pending</span>';
                                                    }

                                                    echo '<tr>
                                                            <td>'.$count.'</td>
                                                            <td>'.$rowO['order_created'].'</td>
                                                            <td>'.$rowO['delivery_address'].'</td>
                                                            <td>'.$status.'</td>
                                                            <td>RM'.number_format($rowSum['sum'], 2).' for '.$rowSum['sumQty'].' item</td>
                                                            <td>

                                                                <label class="btn view" for="modal-'.$oid.'">View</label>

                                                            </td>
                                                          </tr>';
                                                    $count++;

                                                    echo '
                                                        <input class="modal-state" id="modal-'.$oid.'" type="checkbox" />
                                                        <div class="modal">
                                                              <label class="modal__bg" for="modal-'.$oid.'"></label>
                                                              <div class="modal__inner">
                                                                <label class="modal__close" for="modal-'.$oid.'"></label>
                                                                <div class="innerbox">';

                                                                $sqlP = "SELECT id, rated, product_id, qty, price  FROM order_item WHERE order_id = '$oid' ";
                                                                            $resultP = mysqli_query($conn, $sqlP);


                                                                            while($rowP = mysqli_fetch_assoc($resultP)) {

                                                            
                                                                                    $pid = $rowP['product_id'];
                                                                                    $itemid = $rowP['id'];
                                                                                    $itemid = $rowP['id'];

                                                                                    $sqlDetail = "SELECT *  FROM product WHERE product_id = '$pid' ";
                                                                                    $resultD = mysqli_query($conn, $sqlDetail);


                                                                                    $rowD = mysqli_fetch_assoc($resultD);

                                                                                    if($rowP['rated'] == 1){
                                                                                        $btnRate = '<label class="btn rated-btn">Rated</label>';
                                                                                    }else{
                                                                                        $btnRate = '<label class="btn rating-btn" for="modalR" data-pid="'.$pid.'" data-oid="'.$oid.'" data-itemid="'.$itemid.'">Rating</label>';
                                                                                    }

                                                                                    echo '<div class="itemrow">

                                                                                            <img class="img-fluid" src="admin/upload/'.$rowD["product_image"].'">

                                                                                            <div class="inline">

                                                                                                <div class="title">'.$rowD["product_name"].'</div>
                                                                                                <p>Ordered Qty : &nbsp;'.$rowP['qty'].'</p>
                                                                                                <p>Total: RM'.number_format($rowP['price'],2).'</p>

                                                                                                '.$btnRate.'

                                                                                            </div>

                                                                                         </div>';

                                                                                  


                                                                            }

                                                        echo '    </div>
                                                              </div>
                                                        </div>';
                                                }
                                              
                                            } else {
                                                
                                                echo "<tr><td colspan='6'>No Order Yet</td></tr>";

                                            }



                                        ?>
                                        
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <input class="modal-state" id="modalR" type="checkbox" />
            <div class="modal">
                <label class="modal__bg" for="modalR"></label>
                <div class="modal__inner">
                    <label class="modal__close" for="modalR"></label>
                    <div class="innerbox">

                        <form method="POST" action="function.php" onsubmit="javascript:return confirm('Confirm to submit rating?')">
                            <input type="hidden" name="orderid" value="" id="oid">
                            <input type="hidden" name="productid" value="" id="pid">
                            <input type="hidden" name="itemid" value="" id="itemid">
                            <input type="hidden" name="uid" value="<?php echo $cid; ?>">
                            <h1 class="rating-title">Give Rating To This Product</h1>
                            <div class="colFull">
                                <div class="star-rating" data-rating="0">
                                  <i class="fa fa-star" data-value="1"></i>
                                  <i class="fa fa-star" data-value="2"></i>
                                  <i class="fa fa-star" data-value="3"></i>
                                  <i class="fa fa-star" data-value="4"></i>
                                  <i class="fa fa-star" data-value="5"></i>
                                </div>
                                <input type="hidden" id="rating-input" name="rating" value="0">
                            </div>
                            <div class="colFull">
                                <label class="rating-label">Write your review here</label>
                                <textarea cols="3" name="message" class="rating-txt" required></textarea>
                            </div>
                            <div class="rate-btn">
                                <button type="submit" class="button" name="submit-rate">Submit</button>
                            </div>
                        </form>

                    </div>  
                </div>
            </div>
        </section>


        <?php include 'component/footer.php'; ?>
        <script type="text/javascript">
            $('.rating-btn').on('click', function(){

                var pid = $(this).data('pid');
                var oid = $(this).data('oid');
                var itemid = $(this).data('itemid');
                $(`#pid`).val(pid);
                $(`#oid`).val(oid);
                $(`#itemid`).val(itemid);

            });
            $('.star-rating i').on('mouseenter', function() {
              const hoveredStarValue = parseFloat($(this).data('value'));
              highlightStars(hoveredStarValue);
            });

            $('.star-rating').on('mouseleave', function() {
              const currentRating = parseFloat($(this).attr('data-rating'));
              highlightStars(currentRating);
            });

            $('.star-rating i').on('click', function() {
              const clickedStarValue = parseFloat($(this).data('value'));
              $('.star-rating').attr('data-rating', clickedStarValue);
              updateStarRating();
            });

            function highlightStars(value) {
                $('.star-rating i').css('color', '#e2e2e2');
                $('.star-rating i').filter('[data-value="' + Math.floor(value) + '"]').prevAll().addBack().css('color', '#FFD700');
            }


            function updateStarRating() {
              const rating = parseFloat($('.star-rating').attr('data-rating'));
              highlightStars(rating);
              $('#rating-input').val(rating);
            }
            $('.navmenu a[href="history.php"]').addClass('active');
        </script>
        
     

    </body>
</html>