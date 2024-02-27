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
	<link rel="stylesheet" href="css/home.css" />

	<title>Z STYLE</title>

</head>

<body>

	<?php include 'component/topbar.php'; ?>

	<section class="slide-section">

		<div class="slideshow-container">

			<div class="mySlides fade">

				<div class="slider-counter">
					<span class="current-item">01</span>
					<span class="bar"></span>
					<span class="total-item">02</span>
				</div>

				<div class="slider-box">

					<div class="left">
						<h1 class="title">Enhance Life with Elegance</h1>
						<p class="subtitle">
							Experience the essence of modern living with our premium selection of stylish electronics -
							a delightful fusion of function and fashion.
						</p>
						<a class="btnview" href="products.php">
							View Products
						</a>
					</div>
					<div class="right">
						<div class="bannerimg">
							<img src="images/banner-product.png" />
						</div>
					</div>

				</div>

			</div>

			<div class="mySlides fade">

				<div class="slider-counter">
					<span class="current-item">02</span>
					<span class="bar"></span>
					<span class="total-item">02</span>
				</div>

				<div class="slider-box">

					<div class="left">
						<h1 class="title">Unleash the Power of Apples!</h1>
						<p class="subtitle">
							Embrace the seamless elegance and cutting-edge technology with our exceptional range of
							Apple products
						</p>
						<a class="btnview" href="products.php">
							View Products
						</a>
					</div>
					<div class="right">
						<div class="bannerimg">
							<img src="images/banner-product1.png" />
						</div>
					</div>

				</div>

			</div>

			<a class="prev" onclick="plusSlides(-1)"><i class="fa-solid fa-left-long"></i></a>
			<a class="next" onclick="plusSlides(1)"><i class="fa-solid fa-right-long"></i></i></a>

		</div>

	</section>

	<!-- Service Section Start -->
	<section class="service-section">
		<div class="content">
			<div class="item">
				<div class="single-service">
					<img src="images/truck.png" alt="">
					<h4>100% Free Shipping</h4>
					<p>We ship all our products for free as long as you buying within the USA.</p>
				</div>
			</div>
			<div class="item">
				<div class="single-service">
					<img src="images/headphone.png" alt="">
					<h4>24/7 Support</h4>
					<p>Our support team is extremely active, you will get response within 2 minutes.</p>
				</div>
			</div>
			<div class="item">
				<div class="single-service">
					<img src="images/undo.png" alt="">
					<h4>30 Day Return</h4>
					<p>Our 30 day return program is open from customers, just fill up a simple form.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- Service Section End -->

	<!-- most popular -->
	<section class="popular-section">

		<div class="title-box">

			<div class="title-group">
				<h2 class="top">New Product</h2>
			</div>

			<div class="prod-box">

				<?php

				$sql = "SELECT * from product ORDER BY product_id DESC LIMIT 4 ";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {

					while ($row = $result->fetch_assoc()) {
						echo '<div class="single">
			                		<div class="tag new">
			                			New
			                		</div>
			                		<a href="detail.php?pid=' . $row["product_id"] . '"><img src="admin/upload/' . $row["product_image"] . '" /></a>
			                		<p>' . $row["product_name"] . '</p>
			                		<p>RM ' . number_format($row["product_price"], 2) . '</p>
			                		<div class="action flexcol">';

						if (empty($cid)) {

							echo '<a class="add minbtn" href="login.php">
					                				Login Now
					                		  </a><a class="add minbtn" href="detail.php?pid=' . $row["product_id"] . '">
		                				Details
		                		    </a>';

						} else {
							echo '<a class="add minbtn" onclick="AddCart(' . $row["product_id"] . ')">
					                				Add Cart
					                		  </a><a class="add minbtn" href="detail.php?pid=' . $row["product_id"] . '">
		                				Details
		                		    </a>';
						}


						echo '</div>
			                	</div>';
					}
				} else {
					echo "<div>No Product Yet</div>";
				}

				?>



			</div>


			<div class="cate-left">
				<img src="images/shape.png" alt="">
			</div>


			<div class="cate-shage">
				<img src="images/shape1.png" alt="">
			</div>
		</div>

	</section>
	<!-- most popular -->

	<script src="js/slide.js"></script>
	<?php include 'component/footer.php'; ?>
	<script>
		$('.navmenu a[href="index.php"]').addClass('active');
	</script>

</body>

</html>