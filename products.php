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
    <style type="text/css">
        .flexbox{
            display: flex;
            flex-flow: row wrap;
        }
    </style>


</head>

<body>

    <?php include 'component/topbar.php'; ?>

    <section class="page-header">

        <div class="box">

            <div class="title-row">
                <span class="round-shape"></span>
                <h2 class="banner-title">All Products</h2>
            </div>
            <div class="bread-crumb">
                <a href="index.php">Home</a> / Products
            </div>

        </div>

    </section>

    <!-- product -->
    <section class="popular-section">

        <div class="title-box">

            <?php

            if (isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $sql = "SELECT * from product WHERE product_name LIKE '%$keyword%' AND product_status = 1";
            } else {
                $keyword = "";
                $sql = "SELECT * from product WHERE product_status = 1";
            }

            ?>

            <div class="title-group">
                <!-- <img src="images/hot.png" > -->
                <div class="flexrow">
                    <h2 class="top">All Products</h2>
                    <div class="sort-view">
                        <div class="sorts searchinput">
                            <i class="fas fa-search"></i>
                            <input type="search" id="keyword" placeholder="Search Product..." class="commonInput"
                                value="<?php echo $keyword; ?>" />
                        </div>
                        <div class="commonBtn" id="searchBtn">
                            Search
                        </div>
                    </div>
                    <div class="sort-view">
                        <a class="view-mode active" href="#"><i class="fa-solid fa-grip"></i></a>
                        <a class="view-mode" href="#"><i class="fa-solid fa-bars"></i></a>
                        <div class="sorts">
                            <select name="sort">
                                <option value="">Default Sorting</option>
                                <option selected="selected" value="">low to high</option>
                                <option value="">high to low</option>
                                <option value="">Best Seller</option>
                                <option value="">Popular Products</option>
                            </select>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </div>
                </div>

            </div>

            <?php 

                $result = $conn->query($sql);
                if($result->num_rows == 2 || $result->num_rows == 3){
                    $flexbox = 'flexbox';
                }else{
                    $flexbox = '';
                }

            ?>

            <div class="prod-box <?php echo $flexbox; ?>">
                <?php
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        if ($result->num_rows < 6) {
                            $max = 'max300';
                        } else {
                            $max = '';
                        }
                        echo '<div class="single ' . $max . '">
                                    
                                    <a href="detail.php?pid=' . $row["product_id"] . '"><img src="admin/upload/' . $row["product_image"] . '"/></a>
                                    <p>' . $row["product_name"] . '</p>
                                    <p>RM ' . number_format($row["product_price"], 2) . '</p>
                                    
                                    <div class="action flexcol">';

                        if (empty($cid)) {

                            echo '<a class="add minbtn" href="login.php">
                                                    Login Now
                                              </a>
                                   <a class="add minbtn" href="detail.php?pid=' . $row["product_id"] . '">
                                        Details
                                    </a>';

                        } else {
                            echo '<a class="add minbtn" onclick="AddCart(' . $row["product_id"] . ')">
                                                    Add Cart
                                              </a>
                                    <a class="add minbtn" href="detail.php?pid=' . $row["product_id"] . '">
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

        <div class="pagination-row">

                <div class="goru-pagination center clearfix">
                    <a class="prev" href="#"><i class="fa-solid fa-arrow-left"></i></a>
                    <span class="current">1</span>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a class="next" href="#"><i class="fa-solid fa-arrow-right"></i></a>
                </div>
                
             </div>

    </section>
    <!-- product -->

    <?php include 'component/footer.php'; ?>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#searchBtn').on('click', function () {

                var keyword = $('#keyword').val();
                if (keyword != "") {
                    window.location.href = "products.php?keyword=" + keyword.trim();
                } else {
                    window.location.href = "products.php";
                }

            });

            $('.navmenu a[href="products.php"]').addClass('active');

        });
    </script>
</body>

</html>