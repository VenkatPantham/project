<?php

# Connect to MySQL database
$conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=leaflet;", "postgres", "postgresql");

# Checking Connection
if (!$conn) {
	echo 'No connection';
	exit;
}

# However the User's Query will be passed to the DB:
$sql = "SELECT * FROM project ORDER BY id";

# Try query or error
$db = $conn->query($sql);
if (!$db) {
	echo 'An SQL error occured';
	exit;
}

# Build GeoJSON feature collection array
$geojson = array(
	'type'      => 'FeatureCollection',
	'features'  => array()
);

# Loop through rows to build feature arrays
while ($row = $db->fetch(PDO::FETCH_ASSOC)) {
	$properties = $row;
	unset($properties['latitude']);
	unset($properties['longitude']);
	$feature = array(
		'type' => 'Feature',
		'geometry' => array(
			'type' => 'Point',
			# Pass Longitude and Latitude Columns here
			'coordinates' => array($row['longitude'], $row['latitude'])
		),
		# Pass other attribute columns here
		'properties' => $properties
	);
	# Add feature arrays to feature collection array
	array_push($geojson['features'], $feature);
}

header('Content-type: application/json');
echo json_encode($geojson, JSON_PRETTY_PRINT);

#for local json files use code below

// $fp = fopen('data.json', 'w');
// fwrite($fp, geoJson($json));
// fclose($fp);

$conn = NULL;
?>