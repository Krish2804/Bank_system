<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking System - Transfer Money</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="one">
        <h2>Transfer Money</h2>
        <?php
        $conn = new mysqli("localhost", "root", "", "bank_system");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sender_id = $_GET["sender_id"];

        $sql = "SELECT * FROM customers WHERE customer_id = '$sender_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sender = $result->fetch_assoc();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $receiver_id = $_POST["receiver_id"];
                $amount = $_POST["amount"];

                $sender_balance = $sender["current_balance"];
                if ($amount > $sender_balance) {
                    echo "Insufficient balance.";
                } else {
                    $sender_balance -= $amount;
                    $sql_update_sender = "UPDATE customers SET current_balance = '$sender_balance' WHERE customer_id = '$sender_id'";
                    $conn->query($sql_update_sender);

                    $sql_update_receiver = "UPDATE customers SET current_balance = current_balance + '$amount' WHERE customer_id = '$receiver_id'";
                    $conn->query($sql_update_receiver);

                    $sql_insert_transaction = "INSERT INTO transfers (sender_id, receiver_id, amount) VALUES ('$sender_id', '$receiver_id', '$amount')";
                    $conn->query($sql_insert_transaction);

                    echo "Money transferred successfully!";
                }
            }

            $sql_customers = "SELECT * FROM customers WHERE customer_id != '$sender_id'";
            $result_customers = $conn->query($sql_customers);

            if ($result_customers->num_rows > 0) {
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='sender_id' value='$sender_id'>";
                echo "<label>Select receiver:</label>";
                echo "<select name='receiver_id'>";
                while ($row = $result_customers->fetch_assoc()) {
                    echo "<option value='" . $row["customer_id"] . "'>" . $row["name"] . "</option>";
                }
                echo "</select><br>";
                echo "<label>Enter amount:</label>";
                echo "<input type='number' name='amount' step='0.01' min='0'><br>";
                echo "<input type='submit' value='Transfer'>";
                echo "</form>";
            } else {
                echo "No customers found.";
            }
        } else {
            echo "Sender not found.";
        }

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
                    <a href="transaction_history.php">Transaction History</a>
                </td>
            </tr>
        </table><br>
    </div>
</body>

</html>