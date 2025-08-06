<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle Dark Mode">
        <i class="fas fa-adjust"></i>
    </button>

    <h2><i class="fas fa-credit-card"></i> Payment Records</h2>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Card Number</th>
                    <th>Expiry</th>
                    <th>CVV</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $conn = new mysqli("localhost", "root", "", "sneaker store");
                if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

                $sql = "SELECT name, phone, address, card_number, expiry_month, expiry_year, cvv FROM payments";
                $result = $conn->query($sql);
                $serialNumber = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $maskedCard = str_repeat('*', max(0, strlen($row['card_number']) - 4)) . substr($row['card_number'], -4);
                        $maskedCVV = str_repeat('*', strlen($row['cvv']));

                        echo "<tr title='Click to copy row'>";
                        echo "<td>{$serialNumber}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['phone']}</td>";
                        echo "<td>{$row['address']}</td>";
                        echo "<td>{$maskedCard}</td>";
                        echo "<td>{$row['expiry_month']}/{$row['expiry_year']}</td>";
                        echo "<td>{$maskedCVV}</td>";
                        echo "</tr>";
                        $serialNumber++;
                    }
                } else {
                    echo "<tr><td colspan='7'>No payment records found.</td></tr>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleTheme() {
            document.body.classList.toggle("dark");
            localStorage.setItem("theme", document.body.classList.contains("dark") ? "dark" : "light");
        }

        // Apply saved theme
        if (localStorage.getItem("theme") === "dark") {
            document.body.classList.add("dark");
        }

        // Copy row text on click
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('click', () => {
                const text = Array.from(row.children).map(td => td.innerText).join('\t');
                navigator.clipboard.writeText(text);
                alert("Row copied!");
            });
        });
    </script>
</body>
</html>
