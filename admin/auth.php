<?php

	include 'dbcon.php';
	session_start();

	if(isset($_POST['login'])){

		$email = $_POST['email'];
      	$pass = $_POST['password'];
      	$sql = "SELECT * FROM admin where admin_email = '$email'";
	    $result = mysqli_query($conn, $sql);
			
			if(mysqli_num_rows($result) > 0){

			
					$row = mysqli_fetch_assoc($result);

					$pwDb = $row['admin_password'];
					$sid = $row['admin_id'];
					$semail= $row['admin_email'];

					if($pwDb == $pass){
		
						$_SESSION['uid'] = $sid;
						$_SESSION['email'] = $semail;
						$_SESSION['role'] = 'admin';

			      		echo '<script>alert("Welcome Back. Admin"); 
							  window.location.href = "dashboard.php";
							</script>';
									  
					}else{

					    $msg = "Invalid Credential.";
					    $status = "danger";
				  		returnMsg($msg, $status);
				   		header('location:index.php');

					}

			}else{


				$msg = "Invalid Credential.";
				$status = "danger";
				returnMsg($msg, $status);
				header('location:index.php');

			}
		  

	}

	function returnMsg($msgR, $statusR){

	   	$_SESSION['msg'] = $msgR;
	    $_SESSION['msg_status'] = $statusR;
	   
	}


	function returnMsgE($msgE, $statusE){

	   	$_SESSION['msgE'] = $msgE;
	    $_SESSION['msg_statusE'] = $statusE;
	   
	}



?>