<!DOCTYPE html>
<html lang="en">
<title>Staff</title>

<body>
    <table width="600" border="1" cellpaddin="1" cellspacing="1">
        <tr>
            <th>Courier Id</th>
            <th>Prize</th>
            <th>Customer Name</th>
            <th>Reciever Name</th>
            <th>Customer Address</th>
            <th>Reciever Address</th>
            <th>PickUp Date</th>
            <th>Delivery Date</th>
            <th>Quantity</th>
            <th>Weight</th>
            <th>Height</th>
            <th>Length</th>
            <th>Picked</th>
            <th>Delivered</th>
        </tr>

        <?php
        $con = mysqli_connect("localhost", "root", "iloveyoumom", "courier");
        if ($con->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM courier";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {

            while ($courier = mysqli_fetch_assoc($records)) {
                echo "<tr>";
                echo "<td>" . $courier[courier_id] . "</td>";
                echo "<td>" . $courier[prize] . "</td>";
                echo "<td>" . $courier[customer_name] . "</td>";
                echo "<td>" . $courier[reciever_name] . "</td>";
                echo "<td>" . $courier[customer_address] . "</td>";
                echo "<td>" . $courier[reciveer_address] . "</td";
                echo "<td>" . $courier[pickup_date] . "</td";
                echo "<td>" . $courier[delivery_date] . "</td";
                echo "<td>" . $courier[quantity] . "</td>";
                echo "<td>" . $courier[weight] . "</td>";
                echo "<td>" . $courier[height] . "</td>";
                echo "<td>" . $courier[length] . "</td>";
                echo "<td>" . $courier[picked] . "</td>";
                echo "<td>" . $courier[delivered] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $con->close();
        ?>
    </table>
</body>

</html>