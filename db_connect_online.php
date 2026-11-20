<?php

$connection = mysqli_connect(
    "sql307.infinityfree.com",
    "if0_43481711",
    "120394roki",
    "if0_43481711_hubparking"
);

if (!$connection) {
    die("Online database connection failed: " . mysqli_connect_error());
}

?>