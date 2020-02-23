<?php

# Connect to PostgreSQL database
// $conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=trial;", "postgres", "postgresql");
$conn = new PDO("pgsql:host=ec2-184-72-236-3.compute-1.amazonaws.com;port=5432;dbname=d1f6ahsj5b8ids", "omhmsgdadziael", "40852ceb183c08bf075e59f067158f485c1e4f1fc1162b0a9ff9bf16e4710c8f");

# Checking Connection
if (!$conn) {
    echo 'No connection';
    exit;
}

# However the User's Query will be passed to the DB:
$sql = "SELECT table_name FROM information_schema.tables WHERE table_type='BASE TABLE' AND table_schema='public' AND table_name NOT IN('spatial_ref_sys') ORDER BY table_name";

# Try query or error
$db = $conn->query($sql);
if (!$db) {
    echo 'An SQL error occured';
    exit;
}

$tables = [];
while ($table = $db->fetch(PDO::FETCH_ASSOC)) {

    array_push($tables, $table);
}

echo json_encode($tables, JSON_PRETTY_PRINT);

$conn = NULL;
