
<!DOCTYPE html>
<html>
<head>
<title>
</title>
<?php include 'style.css';?>
</head>
<body>
<div class="center-div">
	<div class="table-responsive">
		<table>
			<thead>
				<tr>
					<th>emp_id</th>
					<th>f_name</th>
					<th>l_name</th>
					<th>email_id</th>
					<th>dob</th>
					<th>phone_no</th>
					<th>address</th>
					<th>designation</th>
				</tr>
			</thead>
			<tbody>
						<?php
						include 'connection.php';
						$selectquery = "select emp_id,f_name,l_name,email_id,dob,phone_no,address,designation from employee where designation='Staff' order by emp_id asc";
						$query = mysqli_query ($con,$selectquery);

						while($res = mysqli_fetch_array($query)){

						
						?>
						<tr>
							<td><?php echo $res['emp_id'];?></td>
							<td><?php echo $res['f_name'];?></td>
							<td><?php echo $res['l_name'];?></td>
							<td><?php echo $res['email_id'];?></td>
							<td><?php echo $res['dob'];?></td>
							<td><?php echo $res['phone_no'];?></td>
							<td><?php echo $res['address'];?></td>
							<td><?php echo $res['designation'];?></td>
						</tr>
						<?php
						}
				?>
			</tbody>
		</table>
	</div>
</div>	 