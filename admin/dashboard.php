<?php 
    include 'user-session.php'; 
    include 'dbcon.php';

    $sql = "SELECT COUNT(*) as Total FROM product WHERE product_status = 1";
    $result = mysqli_query($conn, $sql);

 
    if(mysqli_num_rows($result) > 0){
        $rows = mysqli_fetch_assoc($result);
        $total = $rows['Total'];
    }else{
        $total = 0;
    }

    $sqlU = "SELECT COUNT(*) as Total FROM user";
    $resultU = mysqli_query($conn, $sqlU);

    if(mysqli_num_rows($resultU) > 0){
        $rowsU = mysqli_fetch_assoc($resultU);
        $totalU = $rowsU['Total'];
    }else{
        $totalU = 0;
    }

    $sqlO = "SELECT COUNT(*) as Total FROM new_order WHERE order_status = 'pending'";
    $resultO = mysqli_query($conn, $sqlO);

    if(mysqli_num_rows($resultO) > 0){
        $rowsO = mysqli_fetch_assoc($resultO);
        $totalO = $rowsO['Total'];
    }else{
        $totalO = 0;
    }

    $sqlC = "SELECT COUNT(*) as Total FROM new_order WHERE order_status = 'completed'";
    $resultC = mysqli_query($conn, $sqlC);

    if(mysqli_num_rows($resultC) > 0){
        $rowsC = mysqli_fetch_assoc($resultC);
        $totalC = $rowsC['Total'];
    }else{
        $totalC = 0;
    }

    // Total Sales Revenue Query
    $sqlTotalRevenue = "SELECT SUM(qty * price) AS total_revenue FROM order_item";
    $resultTotalRevenue = mysqli_query($conn, $sqlTotalRevenue);
    $totalRevenue = 0;
    if ($resultTotalRevenue) {
        $rowTotalRevenue = mysqli_fetch_assoc($resultTotalRevenue);
        $totalRevenue = $rowTotalRevenue['total_revenue'];
    }

    // Sales by Product Query
    $sqlSalesByProduct = "SELECT p.product_name, SUM(oi.qty) AS units_sold, SUM(oi.qty * oi.price) AS total_sales 
                        FROM order_item oi
                        JOIN product p ON oi.product_id = p.product_id
                        GROUP BY oi.product_id";
    $resultSalesByProduct = mysqli_query($conn, $sqlSalesByProduct);
    $productSales = [];
    while ($row = mysqli_fetch_assoc($resultSalesByProduct)) {
        $productSales[] = array(
            'product_name' => $row['product_name'],
            'units_sold' => $row['units_sold'],
            'total_sales' => $row['total_sales']
        );
    }

    // Fetch the data for the top 4 best-selling products
    $sqlTopProducts = "SELECT p.product_name, SUM(oi.qty) AS total_quantity_sold
    FROM order_item oi
    JOIN product p ON oi.product_id = p.product_id
    GROUP BY oi.product_id
    ORDER BY total_quantity_sold DESC
    LIMIT 4";
    $resultTopProducts = mysqli_query($conn, $sqlTopProducts);
    $topProductsLabels = [];
    $topProductsData = [];

    if ($resultTopProducts && mysqli_num_rows($resultTopProducts) > 0) {
    while ($row = mysqli_fetch_assoc($resultTopProducts)) {
    $topProductsLabels[] = $row['product_name'];
    $topProductsData[] = $row['total_quantity_sold'];
    }
    }

    // SQL to fetch the top 4 lowest-selling products
    $sqlLowestSelling = "SELECT p.product_name, SUM(oi.qty) AS total_quantity_sold
    FROM order_item oi
    JOIN product p ON oi.product_id = p.product_id
    GROUP BY oi.product_id
    ORDER BY total_quantity_sold ASC
    LIMIT 4"; // Get the lowest 4 selling products
    $resultLowestSelling = mysqli_query($conn, $sqlLowestSelling);
    $lowestSellingProductsData = [];
    $lowestSellingProductsLabels = [];

    if ($resultLowestSelling && mysqli_num_rows($resultLowestSelling) > 0) {
    while ($row = mysqli_fetch_assoc($resultLowestSelling)) {
    $lowestSellingProductsLabels[] = $row['product_name'];
    $lowestSellingProductsData[] = $row['total_quantity_sold'];
    }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <?php include 'component/sidebar.php' ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'component/navbar.php' ?>

                <div class="container-fluid">

                    <h1 class="h3 mb-3 text-gray-800">Dashboard</h1>

                    <div class="row">

                        <!-- User Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                               User Count</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalU; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

              
                        <!-- Product Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                               Active Product Count</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cookie-bite text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                               Pending Order Count</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalO; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Order Card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                               Completed Order Count</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalC; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Sales Revenue -->
                        <div class="col-xl-6 col-lg-6" style="position: relative; height:40vh; width:80vw; margin-top: 50px">
                            <canvas id="total-sales-revenue-chart"></canvas>
                        </div>

                        <!-- Sales by Product -->
                        <div class="col-xl-6 col-lg-6" style="position: relative; height:40vh; width:80vw; margin-top: 50px">
                            <canvas id="sales-by-product-chart"></canvas>
                        </div>

                        <!-- Top Sales by Product -->
                        <div class="col-xl-6 col-lg-6" style="position: relative; height:40vh; width:80vw; margin-top: 50px">
                            <canvas id="top-products-chart"></canvas>
                        </div>

                        <!-- Least Sales by Product -->
                        <div class="col-xl-6 col-lg-6" style="position: relative; height:40vh; width:80vw; margin-top: 50px">
                            <canvas id="lowest-selling-products-chart"></canvas>
                        </div>

                    </div>

                </div>


            </div>

            <?php include 'component/footer.php'; ?>

        </div>

    </div>

    <?php include 'component/modal.php'; ?>
    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/admin.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('.nav-item .nav-link[href="dashboard.php"]').parent().addClass('active');
            
        });
    </script>

    <script type="text/javascript">
    // Passing PHP data to JavaScript
    var totalRevenue = <?php echo json_encode($totalRevenue); ?>;
    var productSales = <?php echo json_encode($productSales); ?>;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart for Total Sales Revenue
        var ctxRevenue = document.getElementById('total-sales-revenue-chart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: ["Total Revenue"],
                datasets: [{
                    label: 'Total Sales Revenue',
                    data: [totalRevenue],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Parsing data for the Sales by Product chart
        var productNames = productSales.map(function(item) { return item.product_name; });
        var productTotals = productSales.map(function(item) { return item.total_sales; });

        // Chart for Sales by Product
        var ctxProduct = document.getElementById('sales-by-product-chart').getContext('2d');
        new Chart(ctxProduct, {
            type: 'bar',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Sales by Product',
                    data: productTotals,
                    backgroundColor: productSales.map(() => 'rgba(153, 102, 255, 0.2)'),
                    borderColor: productSales.map(() => 'rgba(153, 102, 255, 1)'),
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    // Top 4 Best-Selling Products Chart
    var ctxTopProducts = document.getElementById('top-products-chart').getContext('2d');
    var topProductsChart = new Chart(ctxTopProducts, {
        type: 'bar', // You can change this to 'line', 'pie', etc.
        data: {
            labels: <?php echo json_encode($topProductsLabels); ?>,
            datasets: [{
                label: 'Top 4 Best-Selling Products',
                data: <?php echo json_encode($topProductsData); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Prepare the data for the Lowest Selling Products chart
    var ctxLowestSelling = document.getElementById('lowest-selling-products-chart').getContext('2d');
    var lowestSellingProductsChart = new Chart(ctxLowestSelling, {
        type: 'bar', // You can change this to 'line', 'pie', etc.
        data: {
            labels: <?php echo json_encode($lowestSellingProductsLabels); ?>,
            datasets: [{
                label: 'Top 4 Lowest-Selling Products',
                data: <?php echo json_encode($lowestSellingProductsData); ?>,
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script> 
</body>
</html>