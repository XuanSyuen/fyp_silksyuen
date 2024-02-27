<?php 
    include 'user-session.php';
    include 'dbcon.php';
   

    if(isset($_GET['action'])){

        $type = $_GET['action'];
        $orderid = $_GET['oid'];
        // 0=pending, 1 - completed, 2=delivering, 3=deliveringcancelled
        if($type == 0){
            $statusUp = 'pending';
        }else if($type == 1){
            $statusUp = 'completed';
        }else if($type == 2){
            $statusUp = 'delivering';
        }else if($type == 3){
            $statusUp = 'cancelled';
        }

        $sqlUS = "UPDATE new_order SET order_status = '$statusUp' ";
        $sqlUS .= "WHERE order_id = '$orderid'";

        mysqli_query($conn, $sqlUS);
        echo "<script>
            alert('Successfully update status!');
            window.location.href= 'order.php';
          </script>";

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

    <title>Order</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/lightbox/dist/css/lightbox.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'component/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'component/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" id="form-table">

                    <!-- Page Heading -->
                    

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1 class="h3 mb-0 text-gray-800 display-7">Order List</h1>
                            </div>
                        </div>
                        <div class="card-body" style="overflow: auto;">
                                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>User Info</th>
                                            <th>Total Amount</th>
                                            <th>Delivery Address</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                        <?php
                                            
                                            $sql = "SELECT * FROM new_order INNER JOIN user ON new_order.user_id = user.user_id";
                                            $result = mysqli_query($conn, $sql);
                                           

                                            if(mysqli_num_rows($result) > 0){
                                                $count = 1;
                                                while($rows = mysqli_fetch_assoc($result)){

                                                    $btn = '';
                                                    if($rows['order_status'] == 'completed'){

                                                        $status = '<span class="text-success">Completed</span>';

                                                    }else if($rows['order_status'] == 'delivering'){
                                                        $status = '<span class="text-warning">Delivering</span>';
                                                        $btn = '
                                                                <a onclick="javascript:return confirm(\'Change status to pending?\');" class="btn btn-sm btn-dark ml-2" href="order.php?action=0&oid='.$rows['order_id'].'">Pending</a>

                                                                <a onclick="javascript:return confirm(\'Change status to cancelled?\');" class="btn btn-sm btn-danger ml-2" href="order.php?action=3&oid='.$rows['order_id'].'">Cancelled</a>

                                                                <a onclick="javascript:return confirm(\'Change status to completed?\');" class="btn btn-sm btn-success ml-2" href="order.php?action=1&oid='.$rows['order_id'].'">Completed</a>

                                                                ';
                                                    }else if($rows['order_status'] == 'cancelled'){
                                                        $status = '<span class="text-danger">Cancelled</span>';
                                                        $btn = '

                                                                <a onclick="javascript:return confirm(\'Change status to pending?\');" class="btn btn-sm btn-dark ml-2" href="order.php?action=0&oid='.$rows['order_id'].'">Pending</a>

                                                                <a onclick="javascript:return confirm(\'Change status to cancelled?\');" class="btn btn-sm btn-warning ml-2 text-black" href="order.php?action=2&oid='.$rows['order_id'].'">Delivering</a>

                                                                <a onclick="javascript:return confirm(\'Change status to completed?\');" class="btn btn-sm btn-success ml-2" href="order.php?action=1&oid='.$rows['order_id'].'">Completed</a>

                                                                ';

                                                    }else{
                                                        $status = '<span>Pending</span>';
                                                        $btn = '
                                                                <a onclick="javascript:return confirm(\'Change status to delivering?\');" class="btn btn-sm btn-warning ml-2 text-black" href="order.php?action=2&oid='.$rows['order_id'].'">Delivering</a>

                                                                <a onclick="javascript:return confirm(\'Change status to cancelled?\');" class="btn btn-sm btn-danger ml-2" href="order.php?action=3&oid='.$rows['order_id'].'">Cancelled</a>

                                                                <a onclick="javascript:return confirm(\'Change status to completed?\');" class="btn btn-sm btn-success ml-2" href="order.php?action=1&oid='.$rows['order_id'].'">Completed</a>

                                                                ';
                                                    }

                                                    $oid = $rows['order_id'];

                                                    $sqlSum = "SELECT SUM(price) AS sum, SUM(qty) AS sumQty  FROM order_item WHERE order_id = '$oid' ";
                                                    $resultSum = mysqli_query($conn, $sqlSum);
                                                    $rowSum = mysqli_fetch_assoc($resultSum);

                                            ?>

                                                <tr>   
                                                    <td>#<?php echo $count; ?></td>
                                                    <td>
                                                        <p>ID: <?php echo $rows['user_id'] ?> </p>
                                                        <p>Name: <?php echo $rows['user_name'] ?> </p>
                                                        <p>Email: <?php echo $rows['user_email'] ?> </p>
                                                        <p>Mobile: <?php echo $rows['user_contact'] ?> </p>
                                                    </td>

                                                    <td>RM<?php echo number_format($rowSum['sum'], 2) ?> for <?php echo $rowSum['sumQty'] ?> item</td>
                                            
                                                    <td><?php echo $rows['delivery_address']; ?></td>
                                                    <td>
                                                        <?php echo ($rows['remark'] == '') ? '-' : $rows['remark'] ; ?>
                                                    </td>
                                                
                                                    <td><?php echo $status; ?></td>
                                                    <td><?php echo $rows['order_created']; ?></td>
                                                    
                                                    <td>
                                                        

                                                        <div class="d-flex align-items-center">

                                                            <a class="btn btn-dark btnIcon py-2-5"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ordered Item" data-toggle="modal"
                                                            data-target="#orderModal<?php echo $oid; ?>"><i class="fas fa-eye"></i></a>
                                                            <?php echo $btn; ?>
                                                        </div>


                                                        <div class="modal fade" id="orderModal<?php echo $oid; ?>" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog  modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                                <div class="col text-right pr-0">
                                                                                    <button type="button" class="close modal-close" data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div>
                                                                                    <p>Ordered Item</p>
                                                                                </div>
                                                                                <div class="col-md-12">

                                                                                    <?php
                                                                                    $sqlP = "SELECT product_id, qty, price  FROM order_item WHERE order_id = '$oid' ";
                                                                                    $resultP = mysqli_query($conn, $sqlP);

                                                                                    $count = 1;
                                                                                    while($rowP = mysqli_fetch_assoc($resultP)) {

                                                                    
                                                                                            $pid = $rowP['product_id'];

                                                                                            $sqlDetail = "SELECT *  FROM product WHERE product_id = '$pid' ";
                                                                                            $resultD = mysqli_query($conn, $sqlDetail);


                                                                                            $rowD = mysqli_fetch_assoc($resultD);

                                                                                            echo '<div class="row mb-4">
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="modal-add-cart-product-img">

                                                                                                            <a data-lightbox="image-'.$oid.'" href="upload/'.$rowD["product_image"].'">
                                                                                                                <img src="upload/'.$rowD["product_image"].'" class="rounded" width="120"/>
                                                                                                            </a>
                                                                                                           
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-8">
                                                                                                        <div class="modal-add-cart-info product-title display-8 mb-2">'.$rowD["product_name"].'</div>
                                                                                                        <p class="product-detail mb-1">Ordered Qty : &nbsp;'.$rowP['qty'].'</p>
                                                                                                        <p class="product-detail">Total: RM'.number_format($rowP['price'],2).'</p>
                                                                                                    </div>
                                                                                                </div>';

                                                                                            $count++;
                                                                                    }


                                                                                    ?>

                                                                                   

                                                                              </div>
                                                                               
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--  <div class="d-flex align-items-center">
                                                            <a class="btn btn-dark  btnIcon py-2-5" href="edit-product.php?eid=<?php echo $rows['product_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-pen"></i></a>

                                                            <form method="POST" action="product.php" onsubmit="javascript:return confirm('Confirm to delete product info?')">
                                                             <input value="<?php echo $rows['product_id'] ?>" name="pid" type="hidden" />
                                                             <input value="<?php echo $rows['product_image'] ?>" name="imagepath" type="hidden" />
                                                             <button type="submit" name="delete" class="btn btn-danger btnIcon py-2-5 ml-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                            </form>

                                                        </div>
                                                         -->

                                                    </td>
                                
                                                    <?php $count++; ?>
                                            
                                                </tr>


                                                <?php } ?>

                                        <?php }else{ ?>



                                        <?php } ?>
                                        
                                    
                                    </tbody>
                                </table>
                        </div>
                    </div>

                </div>       
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'component/footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include 'component/modal.php' ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/admin.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/lightbox/dist/js/lightbox.min.js"></script>
    <script type="text/javascript">
      
        $(document).ready(function() {
            
            $('[data-bs-toggle="tooltip"]').tooltip();
            $('#tableData').DataTable();
            $('a[href="order.php"]').parent().addClass('active');
           
            
        });

      
    </script>

</body>

</html>