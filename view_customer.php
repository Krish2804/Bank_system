<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System - View Customert</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="one">
        <h2>Customer Details</h2>
        <?php
        $conn = new mysqli("localhost", "root", "", "bank_system");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $customer_id = $_GET["customer_id"];

        $sql = "SELECT * FROM customers WHERE customer_id = '$customer_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
            echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
            echo "<p><strong>Current Balance:</strong> " . $row["current_balance"] . "</p>";
        } else {
            echo "Customer not found.";
        }

        $conn->close();
        ?>
        <br>
        <table class="two">
            <tr>
                <td>
                    <a href="index.html">Home Page</a><br>
                </td>
                <td>
                    <a href="view_customers.php">View all Customer</a><br>
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