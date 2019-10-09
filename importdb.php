<?php
$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_database = 'u1';
$mysql_filename = 'u1.sql';

// Create connection
$conn = new mysqli($mysql_host, $mysql_username, $mysql_password);

// Check connection
if ($conn->connect_error) {die($conn->connect_error);}

// Create database
$sql = "CREATE DATABASE " . $mysql_database;
if ($conn->query($sql) === TRUE) {echo "Database Created<br>";} else {echo $conn->error;}
$conn->close();


// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($mysql_filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
echo "Tables Imported";
?>