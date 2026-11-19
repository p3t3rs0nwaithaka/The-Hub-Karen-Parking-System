<?php

$connection = mysqli_connect("localhost", "root", "", "the_hub_parking");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>