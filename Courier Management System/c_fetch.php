
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
					<th>courier_id</th>
					<th>price</th>
					<th>customer_name</th>
					<th>reciever_name</th>
					<th>customer_address</th>
					<th>reciever_address</th>
					<th>customer_phone</th>
					<th>reciever_phone</th>
					<th>customer_email</th>
					<th>reciever_email</th>
					<th>pickup_date</th>
					<th>delivery_date</th>
					<th>f_pincode</th>
					<th>t_pincode</th>
					<th>delivery_service</th>
					<th>quantity</th>
					<th>weight</th>
					<th>height</th>
					<th>length</th>
					<th>courier_time</th>
				</tr>
			</thead>
			<tbody>
						
					
						

						<?php
						include 'connection.php';
                        $selectquery = "SELECT c.courier_id,q.price,cu.cu_name,r.r_name,cu.cu_address,r.r_address,cu.cu_phone_no,r.r_phone_no,cu.cu_email_id,r.r_email_id,cu.pickup_date,r.delivery_date,q.f_pincode,q.t_pincode,q.delivery_service,q.quantity,q.weigh,c.height,c.length,c.courier_time
						FROM courier as c, customer as cu, quote as q, reciever as r
						WHERE c.courier_id = cu.courier_id AND c.courier_id = r.courier_id AND q.quote_id = c.quote_id AND q.quote_id = cu.quote_id
						ORDER BY courier_id ASC";
                        $query = mysqli_query ($con,$selectquery);


                        while ($res = mysqli_fetch_assoc($query)){
                        ?>
							<tr>
							<td><?php echo $res['courier_id'];?></td>
							<td><?php echo $res['price'];?></td>
							<td><?php echo $res['cu_name'];?></td>
							<td><?php echo $res['r_name'];?></td>
							<td><?php echo $res['cu_address'];?></td>
							<td><?php echo $res['r_address'];?></td>
							<td><?php echo $res['cu_phone_no'];?></td>
							<td><?php echo $res['r_phone_no'];?></td>
							<td><?php echo $res['cu_email_id'];?></td>
							<td><?php echo $res['r_email_id'];?></td>
							<td><?php echo $res['pickup_date'];?></td>
							<td><?php echo $res['delivery_date'];?></td>
							<td><?php echo $res['f_pincode'];?></td>
							<td><?php echo $res['t_pincode'];?></td>
							<td><?php echo $res['delivery_service'];?></td>
							<td><?php echo $res['quantity'];?></td>
							<td><?php echo $res['weigh'];?></td>
							<td><?php echo $res['height'];?></td>
							<td><?php echo $res['length'];?></td>
							<td><?php echo $res['courier_time'];?></td>
						</tr>
						<?php
						}
				?>
				
						
			</tbody>
		</table>
	</div>
</div>	 