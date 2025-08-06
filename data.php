<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sneaker store"; 

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST is set
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect data safely
    $Name = $_POST['name'] ?? '';
    $Phone = $_POST['phone'] ?? '';
    $Address = $_POST['address'] ?? '';
    $Card_Number = $_POST['card_number'] ?? '';
    $Expiry_Month = $_POST['expiry_month'] ?? '';
    $Expiry_Year = $_POST['expiry_year'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO payments (name, phone, address, card_number, expiry_month, expiry_year, cvv) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $Name, $Phone, $Address, $Card_Number, $Expiry_Month, $Expiry_Year, $cvv);

    if ($stmt->execute()) {
        echo "<script>
            alert('Checkout complete');
            setTimeout(function() {
                window.location.href = 'index.html';
            }, 1000);
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

    