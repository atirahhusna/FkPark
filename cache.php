<?php
$directory = 'C:\xampp2.0\htdocs\FkPark\cache'; // Update with the correct directory path

try {
    // Attempt to create directory if it doesn't exist
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
        echo 'Directory created successfully!';
    } else {
        echo 'Directory already exists.';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
