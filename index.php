<?php
// SQL to fetch the top-selling products
$sqlHotSales = "SELECT p.product_id, p.product_name, p.product_image, p.product_price, SUM(oi.qty) AS total_sold
                FROM order_item oi
                JOIN product p ON oi.product_id = p.product_id
                GROUP BY p.product_id
                ORDER BY total_sold DESC
                LIMIT 4"; // Get the top 4 best-selling products

include 'dbcon.php';

$resultHotSales = $conn->query($sqlHotSales);
$hotSalesProducts = [];

if ($resultHotSales && $resultHotSales->num_rows > 0) {
    while ($row = $resultHotSales->fetch_assoc()) {
        $hotSalesProducts[] = $row;
    }
}
?>

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

	<title>SilkSyuen</title>

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
						<h1 class="title">Chic Trends for Modern Women</h1>
						<p class="subtitle">
						Explore high-quality, unique designs that capture the essence of modern style. 
						Elevate your wardrobe with our trendy collection curated for women aged 18 to 35.
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
						<h1 class="title">Discover Your Style Oasis</h1>
						<p class="subtitle">
						Unleash your fashion flair with our high-quality, trendy designs tailored for modern women aged 18 to 35. 
						Elevate your wardrobe effortlessly.
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
					<p>Experience the convenience of free delivery on all your fashion finds. 
						Elevate your shopping journey without worrying about additional costs – your style, delivered to your doorstep, always on us.</p>
				</div>
			</div>
			<div class="item">
				<div class="single-service">
					<img src="images/headphone.png" alt="">
					<h4>24/7 Support</h4>
					<p>We've got your back day and night! Our dedicated customer support team is here 24/7 to assist you. 
						Any queries, concerns, or style advice you need – we're just a message or call away.</p>
				</div>
			</div>
			<div class="item">
				<div class="single-service">
					<img src="images/undo.png" alt="">
					<h4>30 Day Return</h4>
					<p>Shop with confidence knowing you have 30 days to make sure you love your choices. If it's not a perfect fit, return it hassle-free. 
						Your satisfaction is our commitment to a worry-free shopping experience.</p>
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

				$sql = "SELECT * from product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 4 ";
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

	<!-- Hot Sales Section -->
	<section class="popular-section">
		<div class="title-box">
			<div class="title-group">
				<h2 class="top">Hot Sales</h2>
			</div>
			<div class="prod-box">
				<?php foreach ($hotSalesProducts as $product): ?>
					<div class="single">
					<div class="tag hot">
			                			Hot
			                		</div>
						<a href="detail.php?pid=<?php echo htmlspecialchars($product['product_id']); ?>">
							<img src="admin/upload/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" />
						</a>
						<p><?php echo htmlspecialchars($product['product_name']); ?></p>
						<p>RM <?php echo number_format($product['product_price'], 2); ?></p>
						<div class="action flexcol">
							<a class="add minbtn" href="detail.php?pid=<?php echo htmlspecialchars($product['product_id']); ?>">Details</a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<!-- Include the category shapes if needed -->
		<div class="cate-left">
			<img src="images/shape.png" alt="">
		</div>
		<div class="cate-shage">
			<img src="images/shape1.png" alt="">
		</div>
	</section>
	<!-- End Hot Sales Section -->

	<?php include 'component/footer.php'; ?>
	<script src="js/slide.js"></script>
	<script>
		$('.navmenu a[href="index.php"]').addClass('active');
	</script>
</body>
</html>