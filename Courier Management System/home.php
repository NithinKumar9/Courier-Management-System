<?php
        $con = mysqli_connect('localhost','root','','courier');
        if(mysqli_connect_error()){
            die("Failed to connect with MySql: ".mysqli_connect_error());
        }
        else{
            $f_pincode = $_POST['f_pincode'];
            $t_pincode = $_POST['t_pincode'];
            $quantity = $_POST['quantity'];
            $weigh = $_POST['weight'];
            $delivery_service = $_POST['delivery_service'];
            $price = $_POST['result'];

            $sql = "INSERT INTO quote(f_pincode,t_pincode,quantity,weigh,delivery_service,price) VALUES ('$f_pincode','$t_pincode','$quantity','$weigh','$delivery_service','$price')";

            if (mysqli_query($con, $sql)) {
                header("Location: details_tentative.html");
            }
            else {
                echo "Error: " . $sql . ":-" . mysqli_error($con);
            }
            mysqli_close($con);

        }
?>