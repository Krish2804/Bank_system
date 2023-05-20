<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System - View Customers</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="one">
        <h2>Customer List</h2>
        <?php
        $conn = new mysqli("localhost", "root", "", "bank_system");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM customers";
        $result = $conn->query($sql);

        echo "<div class='four'>";
            if ($result->num_rows > 0) {
                echo "<table style='width: 100%;'>";
                echo "<tr><th>Customer ID</th><th>Name</th><th>Email</th><th>Current Balance</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["customer_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["current_balance"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No customers found.";
            }
        echo "</div>";

        $conn->close();
        ?>
        <br>
        <table class="two">
            <tr>
                <td>
                    <a href="index.html">Home Page</a><br>
                </td>
                <td>
                    <a href="view_customer.php">View Specific Customer</a>
                </td>
                <td>
                    <a href="transfer_money.php">Transfer Money</a>
                </td>
                <td>
                    <a href="transaction_history.php">Transaction History</a>
                </td>
            </tr>
        </table><br>
    </div>
</body>

</html>