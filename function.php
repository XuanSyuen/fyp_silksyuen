<?php
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	include 'dbcon.php';
	session_start();


	// new function
	// user
	if(isset($_POST['register'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];
    
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $current = date('Y-m-d H:i:s'); 

        $sql = "SELECT * FROM user where user_email = '$email'";
	    $result = mysqli_query($conn, $sql);

	    if (mysqli_num_rows($result) > 0) {

	   		  echo '<script>
					  alert("This email is registered before.");
					  window.location.href = "register.php";
					</script>';

	    }else{

	        

	            $sql = "INSERT INTO user (user_email, user_password, user_name, user_contact, user_created) VALUES ('$email', '$password', '$name', '$mobile','$current')";

	            $query_run = mysqli_query($conn, $sql);
	           
	            if ($query_run) {

		     
		   			echo '<script>
					  alert("Successfully create new user");
					  window.location.href = "login.php";
					</script>';
		        
		      	} else {
		
		   			echo '<script>
					  alert("Failed to create new user");
					  window.location.href = "register.php";
					</script>';

		      	}

	        

	    }

    }

    if(isset($_POST['login'])){

		$email = $_POST['email'];
      	$pass = $_POST['password'];
      	$sql = "SELECT * FROM user where user_email = '$email'";
	    $result = mysqli_query($conn, $sql);
			
			if(mysqli_num_rows($result) > 0){

			
					$row = mysqli_fetch_assoc($result);

					$pwDb = $row['user_password'];
					$sid = $row['user_id'];
					$semail= $row['user_email'];

					if($pwDb == $pass){
		
						$_SESSION['customerid'] = $sid;
						$_SESSION['customeremail'] = $semail;

			      		echo '<script>
							  window.location.href = "index.php";
							</script>';
									  
					}else{

						echo '<script>
							  alert("Invalid Credential");
							  window.location.href = "login.php";
							</script>';

					}

			}else{


				echo '<script>
					  alert("Invalid Credential");
					  window.location.href = "login.php";
					</script>';


			}
		  
	}

	// profile

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

            echo '<script>
					  alert("Successfully update profile info");
					  window.location.href = "account.php";
				 </script>';
        
        } else {
            echo '<script>
					  alert("Failed to update profile info");
					  window.location.href = "account.php";
				 </script>';
        }      
        
    }

    if(isset($_POST['addCart'])){

    	$id = $_POST['pid'];
		$qty = $_POST['qty'];
		$userid = $_POST['uid'];

		$sql = "SELECT * FROM cart where product_id = '$id' AND user_id = '$userid'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

			 $sqlUpdate = "UPDATE cart SET total_qty= total_qty + '$qty' where product_id = '$id' AND user_id = '$userid' ";
			 $queryU = mysqli_query($conn, $sqlUpdate);
			 if($queryU) {

			 	$sqlt = "SELECT SUM(total_qty)  as total FROM cart where user_id = '$userid'";
				$resultt = mysqli_query($conn, $sqlt);
				$rowt = $resultt->fetch_assoc();

				$msg = "Successfully update cart";
				echo json_encode(array(
				    'msg' => $msg,
				    'total' => $rowt['total'],
				    'status' => true
				));

				exit();

		    
		  	} else {
		        $msg = "Failed to update cart";
		  		returnErr($msg);
		  	}
		      

		}else{

			$sqlAdd = "INSERT INTO cart (total_qty, product_id, user_id) VALUES ('$qty', '$id', '$userid')";
		    $query_run = mysqli_query($conn, $sqlAdd);
		   
		    if ($query_run) {

		  		$sqlt = "SELECT SUM(total_qty) as total FROM cart where user_id = '$userid'";
				$resultt = mysqli_query($conn, $sqlt);
				$rowt = $resultt->fetch_assoc();

				$msg = "Successfully add cart";
				echo json_encode(array(
				    'msg' => $msg,
				    'total' => $rowt['total'],
				    'status' => true
				));

				exit();
		    
		  	} else {
		        $msg = "Failed to add cart";
		  		returnErr($msg);
		  	}


		}              

     
    }

    if(isset($_POST['checkCart'])){

		$checkCart = $_POST['checkCart'];
		$userid = $_POST['uid'];

		$sql = "SELECT SUM(total_qty)  as total FROM cart where user_id = '$userid'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {

			 $row = $result->fetch_assoc();
			 echo json_encode(array(
			    'total' => (int)$row['total'],
			    'status' => true
			  ));

			  exit();
		      

		}else{

			echo json_encode(array(
			    'total' => 0,
			    'status' => true
			));

			exit();


		}              

     
    }

    if(isset($_POST['preorder'])){

    	$uid = $_POST['uid'];
    	$address1 = mysqli_real_escape_string($conn, $_POST['address1']);
    	$address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    	$postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    	$city = mysqli_real_escape_string($conn, $_POST['city']);
    	$state = mysqli_real_escape_string($conn, $_POST['state']);
    	$country = mysqli_real_escape_string($conn, $_POST['country']);
    	
    	if(!empty($address2)){
    		$address = $address1 . ', ' . $address2 . ', ' . $postcode . '  , ' . $city . ', ' . $state . ', ' . $country;
    	}else{
    		$address = $address1 . ', ' . $postcode . ' ,' . $city . ', ' . $state . ', ' . $country;
    	}


    	$remark = mysqli_real_escape_string($conn, $_POST['remark']);
    	date_default_timezone_set("Asia/Kuala_Lumpur");
        $current = date('Y-m-d H:i:s'); 
        $status = 'pending';


        $sql = "INSERT INTO new_order (user_id, delivery_address, order_created, order_status, remark) VALUES ('$uid', '$address', '$current', '$status','$remark')";

	    mysqli_query($conn, $sql);
	    $last_order_id = mysqli_insert_id($conn);


    	$sqlGet = "SELECT cart.cart_id, cart.total_qty, cart.product_id, cart.user_id, product.product_price FROM cart INNER JOIN product ON cart.product_id = product.product_id where cart.user_id = '$uid'";

	    $resultGet = mysqli_query($conn, $sqlGet);
	    $dataGet = mysqli_fetch_all($resultGet);

	    
	    foreach ($dataGet as $key => $value) {

	    	 
	    	 $qty = $value[1];
	    	 $pid = $value[2];
	    	 $price = $value[4];
	    	 $totalprice = $qty * $price;

	    	 $sqlItem = "INSERT INTO order_item (product_id, qty, price, order_id) VALUES ('$pid', '$qty', '$totalprice', '$last_order_id')";

	    	 mysqli_query($conn, $sqlItem);

	        
	    }


        $sqlD = "DELETE FROM cart WHERE user_id='$uid'";

        if(mysqli_query($conn, $sqlD)){
            echo "<script>
                    alert('Successfully submit order!');
                    window.location.href= 'history.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to submit order!');
                    window.location.href= 'history.php';
                  </script>";
        }



    }

    if(isset($_POST['updatecart'])){

        $qty = $_POST['qty'];
        $cartid = $_POST['cartid'];
        
        foreach ($qty as $key => $value) {

        	$id = $cartid[$key];
        	$newqty = $value;
        	
        	$sql = "UPDATE cart SET total_qty = '$newqty' WHERE cart_id = '$id' ";
        	mysqli_query($conn, $sql);

        }
   
        
	    echo "<script>
	            alert('Successfully update cart!');
	            window.location.href= 'cart.php';
	          </script>"; 
  
        
    }


    if(isset($_POST['refund'])){

        $oid = $_POST['oid'];
        $reason = $_POST['reason'];
        
   	 	$sqlUpdate = "UPDATE new_order SET refund = 1, refund_reason = '$reason' where order_id = '$oid'";
	 	$queryU = mysqli_query($conn, $sqlUpdate);
	 	if($queryU) {

		
			$msg = "Successfully to refund item";
			returnSuccess($msg);

    
	  	} else {
	        $msg = "Failed to refund";
	  		returnErr($msg);
	  	}
   
     
        
    }


    if(isset($_POST['contact'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

    
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $current = date('Y-m-d H:i:s'); 

  
        $sql = "INSERT INTO contact (subject, name, email, mobile ,message, created_at) VALUES ('$subject', '$name', '$email', '$mobile', '$message','$current')";

        $query_run = mysqli_query($conn, $sql);
       
        if ($query_run) {
     
   			echo '<script>
			  alert("Successfully submit message");
			  window.location.href = "contact.php";
			</script>';
        
      	} else {

   			echo '<script>
			  alert("Failed to submit message");
			  window.location.href = "contact.php";
			</script>';

      	}

	        
    }

    if(isset($_POST['forgot'])){


    	$email = $_POST['email'];

        $sql = "SELECT * FROM user where user_email = '$email'";
	    $result = mysqli_query($conn, $sql);

	    if (mysqli_num_rows($result) > 0) {

	    	$row = mysqli_fetch_assoc($result);
	    	$newpass = generateRandomPassword();
	    	$sendEmail = sendEmail($email, $newpass);
	    	if($sendEmail){

	    		$sqlUpdate = "UPDATE user SET user_password = '$newpass' where user_email = '$email'";
	 			mysqli_query($conn, $sqlUpdate);

	 			$msg = 'Done Sent';
	 			returnMsg($msg, true);

	    	}else{
	    		$msg = 'Done Sent';
	 			returnMsg($msg, true);
	    	}

	    }else{
	    	$msg = 'Done Sent';
	 		returnMsg($msg, true);
	    }

    }

    if(isset($_POST['submit-rate'])){

    	$oid = $_POST['orderid'];
    	$pid = $_POST['productid'];
    	$itemid = $_POST['itemid'];
    	$uid = $_POST['uid'];
    	$rating = $_POST['rating'];
    	$message = mysqli_real_escape_string($conn,  $_POST['message']);
    	date_default_timezone_set("Asia/Kuala_Lumpur");
        $current = date('Y-m-d H:i:s'); 

    	$sql = "INSERT INTO review (order_id, product_id, user_id, rating ,comment, created_at) VALUES ('$oid', '$pid', '$uid', '$rating', '$message','$current')";

        $query_run = mysqli_query($conn, $sql);
       
        if ($query_run) {
     		
     		$sqlUpdate = "UPDATE order_item SET rated = '1' where id = '$itemid'";
	 		mysqli_query($conn, $sqlUpdate);

   			echo '<script>
			  alert("Successfully submit rating");
			  window.location.href = "history.php";
			</script>';
        
      	} else {

   			echo '<script>
			  alert("Failed to submit rating");
			  window.location.href = "history.php";
			</script>';

      	}

    }

    function sendEmail($email, $autoGeneratedPassword){

    	$mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Google's SMTP server
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'xuanmiiii02@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'fwev wwuq ikvs ugba'; // Replace with your Gmail password

        $mail->setFrom('xuanmiiii02@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = 'Reset Account Password';
        $mail->Body = "Dear {$email}, Your account password has been reset. It's important to treat this information with the utmost confidentiality to ensure the security of your account. New random password is generated: $autoGeneratedPassword . Thank you!
		";

		if(!$mail->send()) {
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
	}


	function generateRandomPassword($length = 8) {
	    // Define the character set to choose from
	    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	    $password = '';

	    // Get the total length of the character set
	    $charLength = strlen($characters);

	    // Generate random characters until the password length is reached
	    for ($i = 0; $i < $length; $i++) {
	        // Pick a random character from the character set
	        $randomChar = $characters[rand(0, $charLength - 1)];
	        // Append it to the password
	        $password .= $randomChar;
	    }

	    return $password;
	}


	function returnMsg($msgR, $statusR){

	   	$_SESSION['msg'] = $msgR;
	    $_SESSION['msg_status'] = $statusR;
	   
	}


	function returnMsgE($msgE, $statusE){

	   	$_SESSION['msgE'] = $msgE;
	    $_SESSION['msg_statusE'] = $statusE;
	   
	}

	function returnMsgL($msgL, $statusL){

	   	$_SESSION['msgL'] = $msgL;
	    $_SESSION['msg_statusL'] = $statusL;
	   
	}


	function returnSuccess($msg){

	  echo json_encode(array(
	    'msg' => $msg,
	    'status' => true
	  ));

	  exit();

	}


	function returnErr($msg){


	  echo json_encode(array(
	    'msg' => $msg,
	    'status' => false
	  ));

	  exit();

	}






?>