<?php

# Connect to PostgreSQL database
$conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=rajahmundry;", "postgres", "postgresql");

# Checking Connection
if (!$conn) {
    echo 'No connection';
    exit;
}

# However the User's Query will be passed to the DB:
$sql = "SELECT *,ST_AsGeoJSON(the_geom) as geom FROM petrol_bunks ORDER BY gid";

# Try query or error
$db = $conn->query($sql);
if (!$db) {
    echo 'An SQL error occured';
    exit;
}

// # Loop through rows to build feature arrays
$features = [];

while ($row = $db->fetch(PDO::FETCH_ASSOC)) {
    $feature = ['type' => 'Feature'];
    $feature['geometry'] = json_decode($row['geom']);
    unset($row['geom']);
    unset($row['the_geom']);
    $feature['properties'] = $row;
    array_push($features, $feature);
}
$featureCollection = ['type' => 'FeatureCollection', 'features' => $features];

header('Content-type: application/json');
echo json_encode($featureCollection, JSON_PRETTY_PRINT);

$conn = NULL;
