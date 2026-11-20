<?php

include "db_connect_online.php";

$result = mysqli_query($connection, "SELECT * FROM vehicles");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registered Vehicles</title>
</head>

<body>

    <h1>THE HUB KAREN MALL</h1>

    <h2>Vehicle Management System</h2>

    <hr>

    <h2>REGISTERED VEHICLES</h2>

    <a href="/vehicles_online.php">Register New Vehicle</a>

    <br><br>

    <table border="1" cellpadding="12" cellspacing="0">

        <tr>
            <th>ID</th>
            <th>Registration Number</th>
            <th>Vehicle Type</th>
            <th>Owner Name</th>
        </tr>

        <?php

        if ($result && mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

        ?>

        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['registration_number']); ?></td>
            <td><?php echo htmlspecialchars($row['vehicle_type']); ?></td>
            <td><?php echo htmlspecialchars($row['owner_name']); ?></td>
        </tr>

        <?php
            }

        } else {

            echo "<tr><td colspan='4'>No vehicles registered yet.</td></tr>";

        }

        ?>

    </table>

    <br><br>

    <a href="index.php">Back to Dashboard</a>

</body>

</html>