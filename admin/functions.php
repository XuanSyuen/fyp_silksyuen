<?php

	include 'dbcon.php';
	include 'user-session.php';


	// new function
	// user
	if(isset($_POST['create-user'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];
    
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $current = date('Y-m-d H:i:s'); 

        $sql = "SELECT * FROM user where user_email = '$email'";
	    $result = mysqli_query($conn, $sql);

	    if (mysqli_num_rows($result) > 0) {

	          $msg = "This email is registered before.";
      		  $status = "danger";
      		  returnMsg($msg, $status);
	   		  header('location:new-user.php');

	    }else{

	        

	            $sql = "INSERT INTO user (user_email, user_password, user_name, user_contact, user_created) VALUES ('$email', '$password', '$name', '$mobile','$current')";

	            $query_run = mysqli_query($conn, $sql);
	           
	            if ($query_run) {

		      		$msg = "Successfully create new user";
		      		$status = "success";
		      		returnMsg($msg, $status);
		   			header('location:new-user.php');
		        
		      	} else {
			        $msg = "Failed to create new user";
		      		$status = "danger";
		      		returnMsg($msg, $status);
		   			header('location: new-user.php');
		      	}

	        

	    }

    }

    if(isset($_POST['update-user'])){

		$id = $_POST['id'];
		$name = $_POST['name'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];
      	        
        $sql = "UPDATE user SET user_name='$name', user_contact = '$mobile' ";

      	if(isset($password) && !empty($password)){

	      $sql .= ", user_password = '$password'";

      	}

        $sql .= "WHERE user_id = '$id'";

        $query_run = mysqli_query($conn, $sql);
           
        if ($query_run) {

      		$msg = "Successfully update user info";
      		$status = "success";
      		returnMsg($msg, $status);
   			header('location:edit-user.php?eid='.$id);
        
      	} else {
	        $msg = "Failed to create update user info";
      		$status = "danger";
      		returnMsg($msg, $status);
   			header('location: edit-user.php?eid='.$id);
      	}      
	    
	}
	// user end


	// product
	if(isset($_POST['create-product'])){

        $name = $_POST['name'];
        $price = $_POST['price'];
        $sdesc =  mysqli_real_escape_string($conn, $_POST['sdesc']);
        $desc = mysqli_real_escape_string( $conn, $_POST['desc']);

        $status = 1;
        
        if(isset($_FILES['image']['name']) && $_FILES['image']["name"] != '' ){

            $img = $_FILES['image'];
            $filename = date('YmdHis').'_'.(str_replace(' ','',$img['name']));
            $path = $img['tmp_name'];
            $move = move_uploaded_file($path,'upload/'.$filename);

            $sql = "INSERT INTO product (product_name, product_desc, product_short_desc, product_price, product_image, product_status) VALUES ('$name', '$desc', '$sdesc' ,'$price' ,'$filename', '$status')";

            $query_run = mysqli_query($conn, $sql);

           
            if ($query_run) {

	      		$msg = "Successfully create new product";
	      		$status = "success";
	      		returnMsg($msg, $status);
	   			header('location:new-product.php');
	        
	      	} else {
		        $msg = "Failed to create new product";
	      		$status = "danger";
	      		returnMsg($msg, $status);
	   			header('location: new-product.php');
	      	}

        }
    }

    if(isset($_POST['update-product'])){

    	$id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $desc =  mysqli_real_escape_string($conn, $_POST['desc']);
        $sdesc =  mysqli_real_escape_string($conn, $_POST['sdesc']);
        $status = $_POST['status'];
        $oldpath = $_POST['oldpath'];
       
	    	$sql = "UPDATE product SET product_name='$name', product_desc = '$desc', product_short_desc = '$sdesc',product_price ='$price', product_status = '$status' ";
	        
	        if(isset($_FILES['image']['name']) && $_FILES['image']["name"] != '' ){

	            $img = $_FILES['image'];
	            $filename = date('YmdHis').'_'.(str_replace(' ','',$img['name']));
	            $path = $img['tmp_name'];
	            $move = move_uploaded_file($path,'upload/'.$filename);

	            if($move){
	            	$sql .= ", product_image = '$filename'";
	            	if(!empty($oldpath)){
			              if (file_exists("upload/".$oldpath)) {
			                  unlink("upload/".$oldpath);
			              } 
			        }
	            }

	        }

	        $sql .= "WHERE product_id = '$id'";

	        if (mysqli_query($conn, $sql)) {

	      		$msg = "Successfully update product info";
	      		$status = "success";
	      		returnMsg($msg, $status);
	   			header('location:edit-product.php?eid='.$id);
	        
	      	} else {
		        $msg = "Failed to update product";
	      		$status = "danger";
	      		returnMsg($msg, $status);
	   			header('location: edit-product.php?eid='.$id);
	      	}

    }

	// product

	// profile

	if(isset($_POST['update-profile'])){

		$id = $_POST['id'];
		$username = $_POST['username'];
        $password = $_POST['password'];

      	     
        $sql = "UPDATE admin SET admin_username ='$username' ";

      	if(isset($password) && !empty($password)){

	      $sql .= ", admin_password = '$password'";

      	}

        $sql .= "WHERE admin_id = '$id'";

        $query_run = mysqli_query($conn, $sql);
           
        if ($query_run) {

      		$msg = "Successfully update admin info";
      		$status = "success";
      		returnMsg($msg, $status);
   			header('location:profile.php');
        
      	} else {
	        $msg = "Failed to create update admin info";
      		$status = "danger";
      		returnMsg($msg, $status);
   			header('location: profile.php');
      	}      
	    
	}


	// profile

  
	function returnMsg($msgR, $statusR){

	   	$_SESSION['msg'] = $msgR;
	    $_SESSION['msg_status'] = $statusR;
	   
	}


	function returnMsgE($msgE, $statusE){

	   	$_SESSION['msgE'] = $msgE;
	    $_SESSION['msg_statusE'] = $statusE;
	   
	}



?>