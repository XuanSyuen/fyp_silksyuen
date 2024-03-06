<?php 
    include 'user-session.php';
    include 'dbcon.php';
    if(isset($_POST['delete'])){
        $id = $_POST['cid'];

        $sql = "DELETE FROM contact WHERE contact_id='$id'";

        if(mysqli_query($conn, $sql)){
            echo "<script>
                    alert('Successfully delete!');
                    window.location.href= 'contact.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to delete!');
                    window.location.href= 'contact.php';
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

    <title>Contact</title>

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
                                <h1 class="h3 mb-0 text-gray-800 display-7">Message</h1>
                            </div>
                        </div>
                        <div class="card-body" style="overflow: auto;">
                                <table class="table table-bordered" id="tableData" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>User Info</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                        <?php
                                            
                                            $sql = "SELECT * FROM contact";
                                            $result = mysqli_query($conn, $sql);
                                           

                                            if(mysqli_num_rows($result) > 0){
                                                $count = 1;
                                                while($rows = mysqli_fetch_assoc($result)){
;

                                            ?>

                                                <tr>   
                                                    <td>#<?php echo $count; ?></td>
                                                    <td>
                                                        Name: <?php echo $rows['name']; ?>
                                                        <hr>
                                                        Email: <?php echo $rows['email']; ?>
                                                        <hr>
                                                        Mobile: <?php echo $rows['mobile']; ?>
                                                      

                                                    </td>
                                                    <td><?php echo $rows['subject']; ?></td>
                                                    <td><?php echo html_entity_decode($rows['message']); ?></</td>
                                                    <td><?php echo $rows['created_at']; ?></td> 
                                                    <td>
                                                        
                                                        <div class="d-flex align-items-center">
                                                        
                                                            <form method="POST" action="contact.php" onsubmit="javascript:return confirm('Confirm to delete?')">
                                                             <input value="<?php echo $rows['contact_id'] ?>" name="cid" type="hidden" />
                                                           
                                                             <button type="submit" name="delete" class="btn btn-danger btnIcon py-2-5" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                                            </form>

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
    <script src="vendor/lightbox/dist/js/lightbox.min.js"></script>
    <script type="text/javascript">
      
        $(document).ready(function() {
            
            $('[data-bs-toggle="tooltip"]').tooltip();
            $('#tableData').DataTable();
            $('a[href="contact.php"]').parent().addClass('active');
           
            
        });

      
    </script>

</body>

</html>