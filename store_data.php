<?php

# Connect to MySQL database
$conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=leaflet;", "postgres", "postgresql");
// $conn = new PDO("pgsql:host=ec2-34-192-30-15.compute-1.amazonaws.com;port=5432;dbname=dt1cb351i5ccg", "sznfsdvbtqkmpd", "dffd2604e97c096e0e62439ca8e1dc4bb1fab036867cefef6e1745ff578d0650");
// $conn = new PDO("pgsql:host=satao.db.elephantsql.com;port=5432;dbname=wzexiavy", "wzexiavy", "rvjPAkRTIEAyxy7-tQegp93oBEXdp87j");

# Checking Connection
if (!$conn) {
    echo 'No connection';
    exit;
}

$sno = $_POST['sno'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

# However the User's Query will be passed to the DB:
$sql = "INSERT INTO project (sno,latitude,longitude) VALUES ('$sno','$latitude','$longitude')";

# Try query or error
$db = $conn->query($sql);
if (!$db) {
    echo 'An SQL error occured';
    exit;
}
// else {
//     // echo "<script> location.href='index.html'; </script>";
//     header("refresh:5;url:index.html");
//     exit;
// }

$conn = NULL;
