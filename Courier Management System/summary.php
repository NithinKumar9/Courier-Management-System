<?php
$con = mysqli_connect("localhost","root","","courier");
//Fetch sender details
$sql = "SELECT cu_name,cu_email_id,cu_phone_no,cu_address FROM customer ORDER BY courier_id DESC LIMIT 1";
$records = mysqli_query($con,$sql);
//Fetch reciever details
$sql_1 = "SELECT r_name,r_email_id,r_phone_no,r_address FROM reciever ORDER BY courier_id DESC LIMIT 1";
$records_1 = mysqli_query($con,$sql_1);
//Fetch courier details
$sql_2 = "SELECT c.courier_id,q.f_pincode,q.t_pincode,q.quantity,q.weigh,c.height,c.length,q.delivery_service,cu.pickup_date,r.delivery_date FROM courier as c,quote as q,reciever as r,customer as cu WHERE c.courier_id = cu.courier_id AND c.courier_id = r.courier_id AND c.quote_id = cu.quote_id ORDER BY courier_id desc LIMIT 1";
$records_2 = mysqli_query($con,$sql_2);
//fetch the amount 
$sql_3 = "SELECT price FROM quote ORDER BY quote_id DESC LIMIT 1";
$records_3 = mysqli_query($con,$sql_3);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Summary</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
</head>
<style>
    * {
        margin: 0px;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }

    .bg {
        background-image: url("home_background.jpg");
        height: 100%;
        width: 100%;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }
    .nav {
        position: relative;
        padding: 20px;
        background-color: #00204fff;
    }

    .nav img {
        position: absolute;
        top: 0px;
        margin-top: 0px;
        float: left;
    }

    .nav ul {
        position: relative;
        top: 0px;
        list-style-type: none;
        text-align: right;
        justify-content: center;
    }

    .nav li a {
        position: relative;
        display: block;
        color: white;
        padding: 0px 15px;
        top: 0px;
        left: 10px;
        right: 10px;
        text-decoration: none;
        float: left;
    }

    .nav li a:hover {
        color: red;
    }
    .dropdown {
        position: relative;
        display: inline-block;
        text-align: center;
    }

    .dropdown-content {
        display: none;
        top: 15px;
        position: absolute;
        background-color: #f1f1f1;
        border-radius: 10px;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 10px 10px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        border-radius: 10px;
        background-color: rgb(253, 0, 55);
        color: white;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: red;
    }

    [type="fb"] {
        position: absolute;
        float: right;
        size: 1px;
        right: 12px;
        top: 200px;

    }

    [type="in"] {
        position: absolute;
        float: right;
        size: 1px;
        right: 10px;
        top: 250px;
    }

    [type="g"] {
        position: absolute;
        float: right;
        size: 1px;
        right: 10px;
        top: 300px;
    }
    html,
    .root {
    padding: 0;
     margin: 0;
    font-size: 18px;
}

body {
  font: menu;
  font-size: 1rem;
  line-height: 1.4;
  padding: 0;
  margin: 0;
}
section {
  padding-top: 4rem;
  width: 50%;
  margin: auto;
}
h1 {
  font-size: 2rem;
  font-weight: 500;
}
details[open] summary ~ * {
  animation: open 0.3s ease-in-out;
}

@keyframes open {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
details summary::-webkit-details-marker {
  display: none;
}

details summary {
  width: 100%;
  padding: 0.5rem 0;
  border-top: 1px solid black;
  position: relative;
  cursor: pointer;
  font-size: 1.25rem;
  font-weight: 300;
  list-style: none;
}

details summary:after {
  content: "+";
  color: black;
  position: absolute;
  font-size: 1.75rem;
  line-height: 0;
  margin-top: 0.75rem;
  right: 0;
  font-weight: 200;
  transform-origin: center;
  transition: 200ms linear;
}
details[open] summary:after {
  transform: rotate(45deg);
  font-size: 2rem;
}
details summary {
  outline: 0;
}
details table{
  font-size: 0.95rem;
  margin: 0 0 1rem;
  padding-top: 1rem;
}
.butt a {
        position: center;
        text-decoration: none;
        
        padding: 8px 8px;
        background-color: rgb(255, 123, 0);
        border-radius: 20px;
        color: azure;
    }

    .butt a:hover {
        background: rgb(0, 0, 0);
        color: rgb(255, 123, 0);
    }
</style>
<body>
  <div class="bg">
    <div class="nav">
        <img src="logo.png" alt="LOGO" />
        <ul>
            <li style="float:right"><a href="about.html">About</a></li>
            <li style="float:right"><a href="contact.html">Contact</a></li>
            <div class="dropdown">
                <li style="float:right"><a href="#">Login</a></li>
                <div class="dropdown-content">
                    <a href="mlogin.html">Manager Login</a>
                    <a href="slogin.html">Staff Login</a>
                    <a href="dlogin.html">Delivary Boy Login</a>
                </div>
            </div>
        </ul>
    </div>
    </div>
    <section>
        <h1>
          Conform the courier details.
        </h1>
        <details>
          <summary>Sender Details</summary>
          <table width="680" border="2" cellpadding="2" cellspacing='2'>
            <thead>
                <tr>
                    <th>Sender Name</th>
                    <th>Sender Email</th>
                    <th>Sender Phone Number</th>
                    <th>Sender Address</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                    <?php
                        while ($course = mysqli_fetch_assoc($records)){
                          echo "<tr>";
                          echo "<td>".$course['cu_name']."</td>";
                          echo "<td>".$course['cu_email_id']."</td>";
                          echo "<td>".$course['cu_phone_no']."</td>";
                          echo "<td>".$course['cu_address']."</td>";
                          echo "</tr>";
                        }
                    ?>
                    <tr>
                      </tbody>
        </table>
        </details>
        <details>
          <summary>Reciever Details</summary>
          <table width="680" border="2" cellpadding="2" cellspacing='2'>
            <thead>
                <tr>
                    <th>Reciever Name</th>
                    <th>Reciever Email</th>
                    <th>Reciever Phone Number</th>
                    <th>Reciever Address</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                    <?php
                        while ($course = mysqli_fetch_assoc($records_1)){
                          echo "<tr>";
                          echo "<td>".$course['r_name']."</td>";
                          echo "<td>".$course['r_email_id']."</td>";
                          echo "<td>".$course['r_phone_no']."</td>";
                          echo "<td>".$course['r_address']."</td>";
                          echo "</tr>";
                        }
                    ?>
                    <tr>
                      </tbody>
        </table>
        </details>
        <details>
          <summary>Courier Details</summary>
          <table width="800" border="1" cellpadding="2" cellspacing='2'>
            <thead>
                <tr>
                    <th>Courier Id</th>
                    <th>From Pincode</th>
                    <th>To Pincode</th>
                    <th>Quantity</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Length</th>
                    <th>Delivery Service</th>
                    <th>Pickup Date</th>
                    <th>Delivery Date</th>
                  
                </tr>
            </thead>
            <tbody>
                    <tr>
                    <?php
                        while ($course = mysqli_fetch_assoc($records_2)){
                          echo "<tr>";
                          echo "<td>".$course['courier_id']."</td>";
                          echo "<td>".$course['f_pincode']."</td>";
                          echo "<td>".$course['t_pincode']."</td>";
                          echo "<td>".$course['quantity']."</td>";
                          echo "<td>".$course['weigh']."</td>";
                          echo "<td>".$course['height']."</td>";
                          echo "<td>".$course['length']."</td>";
                          echo "<td>".$course['delivery_service']."</td>";
                          echo "<td>".$course['pickup_date']."</td>";
                          echo "<td>".$course['delivery_date']."</td>";
                          echo "</tr>";
                        }
                    ?>
                    <tr>
                      </tbody>
        </table>
        </details>
        <details>
          <summary>Payment Details</summary>
          <p>Total Price: Rs. <?php
          while($result = mysqli_fetch_assoc($records_3)){
            echo $result['price'];
          } 
          ?>/- Only</p>
          <p> Presently we are accepting CASH ONLY</p>
          <p> Pay to our Delivery Boy</p>
        </details>
        <div class="butt">
          <a href="Home.html">Place the Courier</a>
          <button onclick="window.print()">Print</button>
      </div>
        
      </section>
    
</body>
</html>