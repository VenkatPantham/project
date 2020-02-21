<?php

# Connect to PostgreSQL database
$conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=leaflet;", "postgres", "postgresql");

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
