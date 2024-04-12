<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "school";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM a";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Set headers to force download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');

    // Open file handle for output
    $output = fopen('php://output', 'w');

    // Write headers to CSV file
    fputcsv($output, array('Name', 'Age'));

    // Write data rows to CSV file
    while($row = $result->fetch_assoc()) {
        fputcsv($output, array($row["name"], $row["age"]));
    }

    // Close file handle
    fclose($output);
} else {
    echo "0 results";
}

$conn->close();
?>
