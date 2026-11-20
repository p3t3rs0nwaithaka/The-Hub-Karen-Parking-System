<?php

include "db_connect_online.php";

$message = "";

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

    if (mysqli_stmt_execute($stmt)) {
        $message = "Vehicle registered successfully!";
    } else {
        $message = "Registration failed: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Vehicle Registration</title>
</head>

<body>

    <h1>THE HUB KAREN MALL</h1>

    <h2>Vehicle Management System</h2>

    <hr>

    <h2>Vehicle Registration</h2>

    <?php
    if ($message != "") {
        echo "<p>$message</p>";
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

    <a href="index.php">Back to Dashboard</a>

</body>

</html>