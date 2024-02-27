<?php 
    include 'user-session.php';
    include 'dbcon.php';
    if(isset($_POST['delete'])){
        $id = $_POST['pid'];
        $oldpath = $_POST['imagepath'];

        if(!empty($oldpath)){
              if (file_exists("upload/".$oldpath)) {
                  unlink("upload/".$oldpath);
              } 
        }

        $sql = "DELETE FROM product WHERE product_id='$id'";

        if(mysqli_query($conn, $sql)){
            echo "<script>
                    alert('Successfully delete info!');
                    window.location.href= 'product.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to delete info!');
                    window.location.href= 'product.php';
                  </script>";
        }
        mysqli_close($conn);
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

    <title>Product</title>

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
                                <h1 class="h3 mb-0 text-gray-800 display-7">Product List</h1>
                                <a class="btn btn-sm btn-dark btn-add mb-0 px-4" href="new-product.php">New</a>
                            </div>
                        </div>
                        <div class="card-body" style="overflow: auto;">
                                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Product Price</th>
                                            <th>Product Short Desc</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                        <?php
                                            
                                            $sql = "SELECT * FROM product";
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0){
                                                $count = 1;
                                                while($rows = mysqli_fetch_assoc($result)){

                                                    if($rows['product_status'] == 1){
                                                       $statusBadge = "<span class='badge badge-success'>Active</span>";
                                                    }else{
                                                      $statusBadge = "<span class='badge badge-danger'>Deactive</span>";
                                                    }

                                            ?>

                                                <tr>   
                                                    <td>#<?php echo $count; ?></td>
                                                    <td>
                                                        <a data-lightbox="image-<?php echo $count; ?>" href="upload/<?php echo $rows['product_image']; ?>">
                                                            <img src='upload/<?php echo $rows['product_image']; ?>' width="80" class="rounded"/>
                                                        </a>
                                                    </td>
                                            
                                                    <td><?php echo $rows['product_name']; ?></td>
                                                    <td>
                                                        RM<?php echo $rows['product_price']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo html_entity_decode($rows['product_short_desc']); ?>
                                                    </td>
                                                 
                                                    <td><?php echo $statusBadge; ?></td>
                                                    
                                                    <td>
                                                        
                                                        
                                                         <div class="d-flex align-items-center">
                                                            <a class="btn btn-success btnIcon py-2-5"  data-bs-toggle="tooltip" data-bs-placement="top" title="Review" data-toggle="modal"
                                                            data-target="#reviewModal<?php echo $rows['product_id']; ?>"><i class="fas fa-comment"></i></a>

                                                            <a class="btn btn-dark  btnIcon py-2-5 ml-2" href="edit-product.php?eid=<?php echo $rows['product_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-pen"></i></a>

                                                            <form method="POST" action="product.php" onsubmit="javascript:return confirm('Confirm to delete product info?')">
                                                             <input value="<?php echo $rows['product_id'] ?>" name="pid" type="hidden" />
                                                             <input value="<?php echo $rows['product_image'] ?>" name="imagepath" type="hidden" />
                                                             <button type="submit" name="delete" class="btn btn-danger btnIcon py-2-5 ml-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                            </form>

                                                        </div>
                                                        

                                                    </td>
                                
                                                    <?php $count++; ?>
                                            
                                                </tr>

                                                <div class="modal fade" id="reviewModal<?php echo $rows['product_id']; ?>" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
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
                                                                        <!-- <div>
                                                                            <p>Review</p>
                                                                        </div> -->
                                                                        <div class="col-md-12 px-0">

                                                                            <?php
                                                                            $pid = $rows['product_id'];
                                                                            $sqlR = "SELECT * from review INNER JOIN user ON review.user_id = user.user_id WHERE review.product_id = '$pid'";
                                                                            $resultR = $conn->query($sqlR);
                                                                            if ($resultR->num_rows > 0) {
                                                                          
                                                                                while($rowR = mysqli_fetch_assoc($resultR)) {
                                                                            ?>      

                                                                                    <div class="review-text-box">

                                                                                        <div class="review-profile">
                                                                                            <img src="img/undraw_profile.svg" class="user-img" />
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
                                                                                echo '<p>No Review Yet</p>';
                                                                            }


                                                                            ?>

                                                                           

                                                                      </div>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


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
            $('a[href="product.php"]').addClass('active');
            $('a[data-target="#collapseMenu"]').parent().addClass('active');
            if(window.matchMedia('(min-width: 769px)').matches){
                $('#collapseMenu').addClass('show');
            }
            
        });

      
    </script>

</body>

</html>