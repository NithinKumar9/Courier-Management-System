<?php
//including the database connection file
$con = mysqli_connect('localhost','root','','courier');
if(mysqli_connect_error())
{
  die("Failed to connect with MySql: ".mysqli_connect_error());
}
else
{
$customer_name = $_POST['customer_name'];
$reciever_name = $_POST['reciever_name'];   
$customer_phone = $_POST['customer_phone'];
$reciever_phone = $_POST['reciever_phone'];
$customer_email = $_POST['customer_email'];
$reciever_email = $_POST['reciever_email'];
$customer_address = $_POST['customer_address'];
$reciever_address = $_POST['reciever_address'];
$length = $_POST['length'];
$height = $_POST['height'];
$pday = $_POST['pday'];

$quote = "SELECT quote_id FROM quote ORDER BY quote_id DESC LIMIT 1";
$co = mysqli_query($con,$quote);
$cour = mysqli_fetch_assoc($co);
$quote_id = $cour['quote_id'];

$getprice = "SELECT price FROM quote ORDER BY quote_id DESC LIMIT 1";
$getpric = mysqli_query($con,$getprice);
$getpri = mysqli_fetch_assoc($getpric);
$price = $getpri['price'];

$delivery_service = "SELECT delivery_service FROM quote WHERE quote_id = $quote_id";
$rs = mysqli_query($con,$delivery_service);
$dday = mysqli_fetch_assoc($rs);
$day = "";

if($dday['delivery_service'] == "Speed")
{
  $day = date('Y-m-d',strtotime('+1 day', strtotime($pday)));
  echo "$day";
}
elseif ($dday['delivery_service'] == "Best")
{
  $day = date('Y-m-d', strtotime($pday. ' + 2 days'));
  echo "$day";
}
elseif($dday['delivery_service'] == "Economy")
{
  $day = date('Y-m-d',strtotime('+4 days', strtotime($pday)));
  echo "$day";
} 
$sql2 = "INSERT INTO courier(length,height,quote_id,price) VALUES('$length','$height','$quote_id','$price')";
//insert data into customer table
$sql = "INSERT INTO customer(cu_name,cu_phone_no,cu_email_id,cu_address,pickup_date,quote_id) VALUES ('$customer_name','$customer_phone','$customer_email','$customer_address','$pday','$quote_id')";

$sql1 = "INSERT INTO reciever(r_name,r_phone_no,r_email_id,r_address,delivery_date) VALUES('$reciever_name','$reciever_phone','$reciever_email','$reciever_address','$day')";


//insert data into reciever table
/*
UPDATE courier SET customer_name = '$customer_name',
                           reciever_name = '$reciever_name',
                           customer_phone = '$customer_phone',
                           reciever_phone = '$reciever_phone',
                           customer_email = '$customer_email',
                           reciever_email = '$reciever_email',
                           customer_address = '$customer_address',
                           reciever_address = '$reciever_address',
                           lengt = '$length',
                           height = '$height',
                           pickup_date = '$pday',
                           delivery_date = '$day'
        WHERE courier_id = $courier_id";
        //INSERT INTO courier(customer_name,reciever_name,customer_phone,reciever_phone,customer_email,reciever_email,customer_address,reciever_address,pickup_date,delivery_date)
       //VALUES ('$customer_name','$reciever_name','$customer_phone','$reciever_phone', '$customer_email','$reciever_email','$customer_address','$reciever_address','$pday','$dday')";
*/
if(mysqli_query($con, $sql)) 
{
  if(mysqli_query($con,$sql1))
  {
    if(mysqli_query($con,$sql2))
    {
      echo "New record has been added successfully to courier table!";
    }
    echo "New record has been added successfully to reciever table!";
  }
  echo "New record has been added successfully to customer table!";
} else {
  echo "Error: " . $sql . ":-" . mysqli_error($con);
}
mysqli_close($con);
header('Location: summary.php');
}
?>
