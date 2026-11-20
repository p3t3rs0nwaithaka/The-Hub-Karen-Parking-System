<?php

include "db_connect_online.php";

$message = "";

// Process vehicle registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $registration_number = trim($_POST["registration_number"]);
    $vehicle_type = $_POST["vehicle_type"];
    $owner_name = trim($_POST["owner_name"]);

    $sql = "INSERT INTO vehicles
            (registration_number, vehicle_type, owner_name)
            VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($connection, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $registration_number,
        $vehicle_type,
        $owner_name
    );

    try {

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        header("Location: vehicles_online.php?registered=1");
        exit;

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1062) {
            $message = "This vehicle is already registered!";
        } else {
            $message = "Registration failed. Please try again.";
        }

        mysqli_stmt_close($stmt);
    }
}

// Display success message after registration
if (isset($_GET["registered"])) {
    $message = "Vehicle registered successfully!";
}

// Retrieve all registered vehicles
$result = mysqli_query($connection, "SELECT * FROM vehicles");

?>

<!DOCTYPE html>
<html>

<head>
    <title>The Hub Parking System</title>
</head>

<body>

    <h1>THE HUB KAREN MALL</h1>

    <h2>Vehicle Management System</h2>

    <hr>

    <h2>VEHICLE REGISTRATION</h2>

    <?php
    if ($message != "") {
        echo "<p>" . htmlspecialchars($message) . "</p>";
    }
    ?>

    <form method="POST" action="">

        <label>Vehicle Registration Number:</label><br>

        <input type="text"
               name="registration_number"
               placeholder="e.g. KDA 123A"
               required>

        <br><br>

        <label>Vehicle Type:</label><br>

        <select name="vehicle_type" required>

            <option value="">Select Vehicle Type</option>
            <option value="Car">Car</option>
            <option value="Motorcycle">Motorcycle</option>
            <option value="Van">Van</option>
            <option value="Truck">Truck</option>

        </select>

        <br><br>

        <label>Owner's Name:</label><br>

        <input type="text"
               name="owner_name"
               placeholder="Enter owner's name"
               required>

        <br><br>

        <button type="submit">Register Vehicle</button>

    </form>

    <br>

    <hr>

    <h2>REGISTERED VEHICLES</h2>

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