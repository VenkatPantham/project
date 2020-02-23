<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

# Connect to Postgres database
$conn = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=leaflet;", "postgres", "postgresql");
// $conn = new PDO("pgsql:host=ec2-184-72-236-3.compute-1.amazonaws.com;port=5432;dbname=d1f6ahsj5b8ids", "omhmsgdadziael", "40852ceb183c08bf075e59f067158f485c1e4f1fc1162b0a9ff9bf16e4710c8f");

# Checking Connection
if (!$conn) {
    echo 'No database is connected';
    exit;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "File already exists. Try changing the name and upload again.<br>";
    $uploadOk = 0;
}
// Allow certain file formats
if ($fileType != "csv") {
    echo "Only CSV files are allowed.<br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $tableName = $_POST['tableName'];
        $tableRows = 0;

        $file = fopen($target_file, "r");
        if ($file) {
            $tableRows = count(fgetcsv($file));
        } else {
            die("Unable to open file");
        }
        fclose($file);

        # However the User's Query will be passed to the DB:
        // $sql = "SELECT load_csv_file('$tableName','/home/venkat-pantham/Desktop/Project/gis/$target_file',$tableRows)";
        $sql = "SELECT load_csv_file('$tableName','/home/ubuntu/project/$target_file',$tableRows)";

        # Try query or error
        $db = $conn->query($sql);
        if (!$db) {
            echo 'An SQL error occured';
            // echo pg_get_result($db);
            exit;
        }

        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn = NULL;
