<?php
 
    include 'dbcon.php';

    if(isset($_GET['did'])){
        $id = $_GET['did'];
        $sqlD = "DELETE FROM cart WHERE cart_id='$id'";

        if(mysqli_query($conn, $sqlD)){
            echo "<script>
                    alert('Successfully remove item from cart!');
                    window.location.href= 'cart.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to remove item!');
                    window.location.href= 'cart.php';
                  </script>";
        }
        mysqli_close($conn);
    }

?>