<?php
// Get file path from query string parameter
$file = $_GET["file"];

// Send file as download to client
if (file_exists($file)) {
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . basename($file));
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
	exit();
} else {
	// Display error message
	die("Error downloading file: file does not exist.");
}
?>