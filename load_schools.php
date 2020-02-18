<?php

# Connect to MySQL database
$conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=rajahmundry;", "postgres", "postgresql");

# Checking Connection
if (!$conn) {
    echo 'No connection';
    exit;
}

# However the User's Query will be passed to the DB:
$sql1 = "SELECT *,ST_AsGeoJSON(the_geom) as geom FROM govt_schools ORDER BY gid";
$sql2 = "SELECT *,ST_AsGeoJSON(the_geom) as geom FROM private_schools ORDER BY gid";
$sql3 = "SELECT *,ST_AsGeoJSON(the_geom) as geom FROM college ORDER BY gid";
$sql4 = "SELECT *,ST_AsGeoJSON(the_geom) as geom FROM university ORDER BY gid";

# Try query or error
$db1 = $conn->query($sql1);
$db2 = $conn->query($sql2);
$db3 = $conn->query($sql3);
$db4 = $conn->query($sql4);
if (!$db1 && !$db2 && !$db3 && !$db4) {
    echo 'An SQL error occured';
    exit;
}

// # Loop through rows to build feature arrays
$features = [];

while ($row1 = $db1->fetch(PDO::FETCH_ASSOC)) {
    $feature = ['type' => 'Feature'];
    $feature['geometry'] = json_decode($row1['geom']);
    unset($row1['geom']);
    unset($row1['the_geom']);
    $feature['properties'] = $row1;
    array_push($features, $feature);
}
while ($row2 = $db2->fetch(PDO::FETCH_ASSOC)) {
    $feature = ['type' => 'Feature'];
    $feature['geometry'] = json_decode($row2['geom']);
    unset($row2['geom']);
    unset($row2['the_geom']);
    $feature['properties'] = $row2;
    array_push($features, $feature);
}
while ($row3 = $db3->fetch(PDO::FETCH_ASSOC)) {
    $feature = ['type' => 'Feature'];
    $feature['geometry'] = json_decode($row3['geom']);
    unset($row3['geom']);
    unset($row3['the_geom']);
    $feature['properties'] = $row3;
    array_push($features, $feature);
}
while ($row4 = $db4->fetch(PDO::FETCH_ASSOC)) {
    $feature = ['type' => 'Feature'];
    $feature['geometry'] = json_decode($row4['geom']);
    unset($row4['geom']);
    unset($row4['the_geom']);
    $feature['properties'] = $row4;
    array_push($features, $feature);
}
$featureCollection = ['type' => 'FeatureCollection', 'features' => $features];

header('Content-type: application/json');
echo json_encode($featureCollection, JSON_PRETTY_PRINT);

$conn = NULL;
