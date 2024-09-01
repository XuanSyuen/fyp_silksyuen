<?php 
    include 'user-session.php';
    include 'dbcon.php';

    if( isset($_GET["eid"]) ){
        $edtid = $_GET['eid'];
        $sqlE = "SELECT product_id, product_name, product_price, product_desc, product_short_desc ,product_image, product_status  FROM product WHERE product_id = '$edtid'";
        $resultE = mysqli_query($conn, $sqlE);
        $rowE = mysqli_fetch_assoc($resultE);
    }else{
        echo "<script>alert('Select one product.');</script>";
        echo "<script>window.location.href='product.php';</script>";
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

    <title>Edit Product</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="vendor/summernote/summernote-bs4.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style type="text/css">
    
        .file-input{
            padding: 0.3rem 0.75rem;
        }

        .file-input::-webkit-file-upload-button{
            font-size: 12px;
        }

    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <?php include 'component/sidebar.php'; ?>
       
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'component/navbar.php'; ?>

                <div class="container-fluid">
                    

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <h1 class="h3 mb-0 text-gray-800 display-7">Update Product</h1>
                                    </div>
                                    
                                </div>
                                <div class="card-body p-5">

                                    <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']) ){ ?>

                                        <div class="alert alert-<?php echo $_SESSION['msg_status'] ?> alert-dismissible fade show" role="alert">
                                          <strong><?php echo $_SESSION['msg'] ?></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>

                                    <?php $_SESSION['msg'] = ''; $_SESSION['msg_status'] = ''; } ?>
                                        
                                    <form method="POST" action="functions.php" enctype="multipart/form-data">

                                        <div class="row">

                                            <div class="col-12">

                                                <div class="form-group d-none">
                                                    <label for="id">Product ID</label>
                                                    <input type="text" class="form-control" id="id" name="id" placeholder="Enter ID" value="<?php echo $rowE['product_id']; ?>"> 
                                                </div>

                                                <div class="form-group">
                                                    <label for="name">Product Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required value="<?php echo $rowE['product_name']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="price">Product Price</label>
                                                    <input type="text" class="form-control numberOnly" id="price" name="price" placeholder="Enter Price" required value="<?php echo $rowE['product_price']; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="sdesc">Description</label>
                                                    <textarea id="ssummernote" name="sdesc"><?php echo $rowE['product_short_desc']; ?></textarea>
                                                </div>

                                                <!-- <div class="form-group">
                                                    <label for="desc">Description</label>
                                                    <textarea id="summernote" name="desc"><?php echo $rowE['product_desc']; ?></textarea>
                                                </div> -->
                                                
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="1" <?php echo ($rowE['product_status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                                        <option value="0" <?php echo ($rowE['product_status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                                    </select>
                                                </div>

                                                <div class="form-group d-none">
                                                    <label for="oldpath">Old Path</label>
                                                    <input type="text" class="form-control" id="oldpath" name="oldpath" required  value="<?php echo $rowE['product_image']; ?>">
                                                </div>  

                                                <div class="form-group">
                                                    <label for="image">Product Image (Optional)</label>
                                                    <input type="file" class="form-control file-input" name="image">
                                                </div>
                                            
                                                
                                            </div>

                                           
                                        </div>
                                        
                                        <div class="my-3 text-center">
                                            <input class="btn btn-dark btnAction" type="submit" value="Update" name="update-product" />
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

        

            </div>

            <?php include 'component/footer.php' ?>

        </div>

    </div>

    <?php include 'component/modal.php' ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/admin.min.js"></script>
    <script src="vendor/summernote/summernote-bs4.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            
            // $('a[href="new-product.php"]').addClass('active');
            $('a[data-target="#collapseMenu"]').parent().addClass('active');
            if(window.matchMedia('(min-width: 769px)').matches){
                $('#collapseMenu').addClass('show');
            }
            $('#summernote').summernote();
            $('#ssummernote').summernote();
            
        });

          //Allow Number Only
        $(".numberOnly").on("input", function (evt) {
            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            if ((evt.which !== 46 || self.val().indexOf('.') !== -1) && (evt.which < 48 || evt.which > 57))
            {
                evt.preventDefault();
            }
        });   
    </script>
</body>

</html>