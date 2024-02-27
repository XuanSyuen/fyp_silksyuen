<?php 
    include 'user-session.php';
    include 'dbcon.php';

    if(isset($_GET['did'])){
        $id = $_GET['did'];
        $sql = "DELETE FROM user WHERE user_id='$id'";

        if(mysqli_query($conn, $sql)){
            echo "<script>
                    alert('Successfully delete info!');
                    window.location.href= 'user.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to delete info!');
                    window.location.href= 'user.php';
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
    <title>User</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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
                                <h1 class="h3 mb-0 text-gray-800 display-7">User List</h1>
                                <a class="btn btn-dark btn-add mb-0 px-4 btn-sm" href="new-user.php">New</a>
                            </div>
                            
                        </div>
                        <div class="card-body" style="overflow: auto;">
                                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>User Mobile</th>
                                            <th>User Email</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                        <?php
                                            
                                            $sql = "SELECT * FROM user";
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0){
                                                $count = 1;
                                                while($rows = mysqli_fetch_assoc($result)){

                                        ?>

                                                <tr>   
                                                    <td>#<?php echo $count; ?></td>
                                                    <td>PA0<?php echo $rows['user_id']; ?></td>
                                                    <td><?php echo $rows['user_name']; ?></td>
                                                    <td><?php echo $rows['user_contact']; ?></td>
                                                    <td><?php echo $rows['user_email']; ?></td>
                                                    <td><?php echo $rows['user_created']; ?></td>
                                                    <td>
                                                        
                                                        <div class="d-flex align-items-center">
                                                            <a class="btn btn-dark  btnIcon py-2-5" href="edit-user.php?eid=<?php echo $rows['user_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-pen"></i></a>
                                                             <a class="btn btn-danger btnIcon py-2-5 ml-2" href="user.php?did=<?php echo $rows['user_id'] ?>" onclick="javascript:return confirm('Confirm to delete user info?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                                                        </div>

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
    <script type="text/javascript">
      
        $(document).ready(function() {
            
            $('[data-bs-toggle="tooltip"]').tooltip();
            $('#tableData').DataTable();
            $('a[href="user.php"]').addClass('active');
            $('a[data-target="#collapseMenuA"]').parent().addClass('active');
            if(window.matchMedia('(min-width: 769px)').matches){
                $('#collapseMenuA').addClass('show');
            }
            
        });

      
    </script>

</body>

</html>