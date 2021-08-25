<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
 Manager/Staff
</title>
<link rel ="icon" href="logo.png" type="image/x-icon"> 
</head>
<style>

ul {
		 list-style-type:none;
		 margin-top:0px;
		 margin-left:30px;
		 margin-right:30px;
		 padding:0px;
		 overflow:hidden; 
		 position:fixed;
		 width:97%;
		 top:0;
		 border-top-left-radius: 20px;
        border-top-right-radius: 20px;
      }
      li {
         float:left;
         }
			li a{
			display: block;
			color:black;
			text-align:center;
			padding:14px 16px;
			text-decoration:none;
			float:left;
			}
					li a:hover{
					color:blue;
					}
					h3{
					color:black;
					}
					 h3:hover{
					 color:blue;
					 }
					 h2:hover{
					 color:blue;
					 }
.overlay {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0px;
  left: 0px;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
  overflow-x: hidden;
  transition: 0.5s;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
  margin-top: 30px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
  color: #f1f1f1;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}     
            h2{
			text-align:center;
			margin:50px;
			font-size:50px;
            }
body{
background-repeat:no-repeat;
background-image:url('https://img.freepik.com/free-vector/3d-perspective-style-diamond-shape-white-background_1017-27556.jpg?size=626&ext=jpg');
background-position:relative;
background-size:100%;			
}			
</style>					
<body>					
<ul>
    <li><img src="logo.png"/> </li>
	<li><h3><b>V3couriers</b></h3></li>
    <li style="float:right"><a href="about.html">About</a></li>
	<li style="float:right"><a href="contact.html">Contact us</a></li>
    <li style="float:right"><a  href="Home.html">Home</a></li>
	 </ul>
<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
    <a href="m_staff.php">Staff</a>
    <a href="m_courier.php">Couriers</a>
    <a href="m_delivery.php">Delivery Boy</a>
    <a href="mlogin.html">Log Out</a>
   </ul>
  </div>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
<script>
function openNav() {
  document.getElementById("myNav").style.width = "25%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
</script>
<h2><b>Staff Details</b></h2>
<?php
include 's_fetch.php';
?>
	
	 </body>
	 </html>