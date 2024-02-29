<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SilkSyuen</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">

        html, body{
            height: 100%;
        }

        .bg-body{
            background:  #272626; 
        }

        .custom-select{
            height: 50px;
        }

        .bg-card{
            background: #fff;
        }

        .btn-black{
            background: #000;
            color: #ffffff;
        }
        

    </style>

</head>

<body class="bg-body">


    <div class="container h-100">
    
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center h-100">


            <div class="col-xl-5 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 bg-card">
                    <div class="card-body p-0 position-relative" >


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center mb-3">
                                        <div class="d-flex justify-content-center align-items-center mb-4">
                                            <img src="img/logo.png " style="max-width: 250px;" />
                                        </div>
                                        <div class="text-center">
                                           <!--  <h6 class="text-uppercase text-dark font-weight-bold">Delish Kuih Raya</h6> -->
                                        </div>
                                    </div>
                                    <?php session_start(); ?>
                            
                                    <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']) ){ ?>

                                        <div class="alert alert-<?php echo $_SESSION['msg_status'] ?> alert-dismissible fade show" role="alert">
                                          <strong class="display-7"><?php echo $_SESSION['msg'] ?></strong>
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>

                                    <?php $_SESSION['msg'] = ''; $_SESSION['msg_status'] = ''; } ?>

                                    <form class="user" method="POST" action="auth.php">
                                        
                                        <div class="form-group">
                                            <label>Admin Email</label>
                                            <input type="text" class="form-control form-control-sm form-control-user rounded"
                                                id="email" name="email" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                             <label>Admin Password</label>
                                            <input type="password" class="form-control form-control-sm  form-control-user rounded" id="password" name="password" required>
                                        </div>

                                        <input type="submit" value="LOGIN" name="login" class="btn btn-black btn-user btn-block mt-4 mb-2 rounded">

                                        <a href="../index.php" class="btn btn-dark btn-user btn-block rounded">
                                            BACK
                                        </a>
                                                     
                                    </form>
                                   
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/admin.min.js"></script>

</body>

</html>