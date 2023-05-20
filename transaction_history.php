<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System - Transaction History</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="three">
        <h2>Transaction History</h2>
        <?php
        $conn = new mysqli("localhost", "root", "", "bank_system");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM transfers";
        $result = $conn->query($sql);
        
        echo "<div class='four'>";
            if ($result->num_rows > 0) {
                echo "<table style='width: 100%;'>";
                echo "<tr><th>Transaction ID</th><th>Sender ID</th><th>Receiver ID</th><th>Amount</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["transfer_id"] . "</td>";
                    echo "<td>" . $row["sender_id"] . "</td>";
                    echo "<td>" . $row["receiver_id"] . "</td>";
                    echo "<td>" . $row["amount"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No transactions found.";
            }
        echo "</div>";

        $conn->close();
        ?>
        <br>
        <table class="two">
            <tr>
                <td>
                    <a href="index.html">Home Page</a>
                </td>
                <td>
                    <a href="view_customers.php">View all Customer</a>
                </td>
                <td>
                    <a href="view_customer.php">View Specific Customer</a>
                </td>
                <td>
                    <a href="transfer_money.php">Transfer Money</a>
                </td>
            </tr>
        </table><br>
    </div>
</body>

</html>