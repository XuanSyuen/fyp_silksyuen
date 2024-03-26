<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- import google font -->
	<link rel="icon" type="image/png" href="images/futurexlogo2.png" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
		integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="css/common.css" />
	<link rel="stylesheet" href="css/product.css" />

	<title>Products</title>


</head>

<body>

	<?php include 'component/topbar.php'; ?>

	<?php

	if (isset($_GET['pid'])) {
		$pid = $_GET['pid'];
		$sql = "SELECT * from product WHERE product_id = '$pid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		$sqlR = "SELECT * from review INNER JOIN user ON review.user_id = user.user_id WHERE review.product_id = '$pid'";
		$resultR = $conn->query($sqlR);

	} else {
		header('Location: products.php');
	}


	?>

	<section class="page-header">

		<div class="box">

			<div class="title-row">
				<span class="round-shape"></span>
				<h2 class="banner-title">Product Detail</h2>
			</div>
			<div class="bread-crumb">
				<a href="index.php">Home</a> / <a href="products.php">Products</a> / Detail
			</div>

		</div>

	</section>

	<!-- product -->
	<section class="popular-section">

		<div class="detailbox">


			<div class="imagebox">

				<img src="admin/upload/<?php echo $row["product_image"] ?>" />

			</div>

			<div class="contentbox">

				<h1>
					<?php echo $row['product_name'] ?>
				</h1>
				<h2 class="price">RM
					<?php echo number_format((float) $row['product_price'], 2, '.', ''); ?>
				</h2>
				<div class="shortdesc">
					<?php echo html_entity_decode($row['product_short_desc']); ?>
				</div>
				<div class="desc hide">
					<?php echo html_entity_decode($row['product_desc']); ?>
				</div>

				<div class="cartbtn">

					<?php

					if (empty($cid)) {

						echo '<a class="minbtn btnClick" href="login.php">
					                Login Now
					              </a>
					               ';

					} else {
						?>
						<div class="qtybox">
							<div class="quantityd mlrauto">
								<button class="qtyBtn btnMinus" type="button"><span>-</span></button>
								<input value="1" id="amount" title="Qty" class="input-text qty text carqty" type="text">
								<button class="qtyBtn btnPlus" type="button">+</button>
							</div>
							<div class="btnAddCart" onclick="detailAddCart(<?php echo $pid; ?>)">
								Add Cart
							</div>
						</div>

						<?php
					}

					?>

				</div>

			</div>



			<div class="cate-left">
				<img src="images/shape.png" alt="">
			</div>


			<div class="cate-shage">
				<img src="images/shape1.png" alt="">
			</div>
		</div>

		<div class="review">
			<h2 class="review-title">Review</h2>
			<?php 
				if ($resultR->num_rows > 0) {

                    while ($rowR = $resultR->fetch_assoc()) {
            ?>

            			<div class="review-text-box">

            				<div class="review-profile">
            					<img src="images/profile.webp" class="user-img" />
            				</div>

            				<div class="review-info">
            					<h3 class="review-username"><?php echo $rowR['user_name'] ?></h3>
            					<div class="colFull">
	                                <div class="star-rating-detail" data-rating="0">
	                                  <i class="fa fa-star <?php echo $rowR['rating'] >= "1" ? 'active' : '' ?>" data-value="1"></i>
	                                  <i class="fa fa-star <?php echo $rowR['rating'] >= "2" ? 'active' : '' ?>" data-value="2"></i>
	                                  <i class="fa fa-star <?php echo $rowR['rating'] >= "3" ? 'active' : '' ?>" data-value="3"></i>
	                                  <i class="fa fa-star <?php echo $rowR['rating'] >= "4" ? 'active' : '' ?>" data-value="4"></i>
	                                  <i class="fa fa-star <?php echo $rowR['rating'] == "5" ? 'active' : '' ?>" data-value="5"></i>
	                                </div>
	                            </div>
            					<p class="review-text">Comment On <?php echo $rowR['created_at'] ?></p>
            					<div class="review-box">
            						<div class="innerbox">
            							 <?php echo html_entity_decode($rowR['comment']); ?>
            						</div>
            					</div>
            				</div>
			
						</div>

            <?php
                    }

                }else{


                	echo '<p style="margin-top: 10px;">No Review Yet</p>';


                }
			?>
		
		</div>

	</section>
	<!-- product -->

	<?php include 'component/footer.php'; ?>
	<script type="text/javascript">
		$(document).ready(function () {

			$('.btnMinus').on('click', function () {


				var dataid = $(this).data('id');
				var input = $(`.qty`).val();
				if (input > 1) {
					var newValue = parseFloat(input) - 1;
					$(`.qty`).val(newValue);
				}

			});

			$('.btnPlus').on('click', function () {


				var input = $(`.qty`).val();
				var newValue = parseFloat(input) + 1;
				$(`.qty`).val(newValue);


			});
			$('.navmenu a[href="products.php"]').addClass('active');

		});
		function detailAddCart(pid) {

			var val = $('#amount').val();
			if (val < 1 || val == '') {
				alert('Please enter qty');
				return;
			}
			var productid = pid;
			var uid = '<?php echo $cid; ?>';
			var param = {
				'pid': productid,
				'uid': uid,
				'qty': val,
				'addCart': 1
			}

			$.ajax({
				type: "POST",
				url: "function.php",
				data: param,
				cache: false,
				dataType: "json",
				success: function (data) {


					alert(data.msg);
					if (data.total !== undefined) {
						$('.cartamount').html(`<span>${data.total}</span>`);
					}


				},
				error: function (data) {

				}
			});


		}

		
	</script>
</body>

</html>