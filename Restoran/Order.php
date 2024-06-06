<?php
session_start();
?>
<?php
require_once("konf.php");
global $yhendus;

if(!empty($_REQUEST["customer_id"]) && !empty($_REQUEST["order_date_time"]) && !empty($_REQUEST["order_amount"]) && !empty($_REQUEST["employee_id"])){
    $kask=$yhendus->prepare("UPDATE `Order` SET customer_id=?, order_date_time=?, order_amount=? WHERE order_id=?");
    $kask->bind_param("isdii", $_REQUEST["customer_id"], $_REQUEST["order_date_time"], $_REQUEST["order_amount"], $_REQUEST["order_id"]);
    $kask->execute();
}

$kask=$yhendus->prepare("SELECT order_id, customer_id, order_date_time, order_amount FROM `Order`");
$kask->bind_result($order_id, $customer_id, $order_date_time, $order_amount);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Orders</title>
    <header>
        <nav>
            <ul>
                <li><a href="Customer.php">Customers</a></li>
                <li><a href="Menu.php">Menu</a></li>
                <li><a href="Order.php">Orders</a></li>
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) { ?>
                    <li><a href="Employee.php">Employees</a></li>
                    <li><a href="kasutajad.php">Kasutajad</a></li>
                <?php } ?>
                <li style="float: right;">
                    <form action="logout.php" method="post" style="display:inline;">
                        <input type="submit" value="Logi välja" name="logout" style="background:green;border:none;color:white;cursor:pointer;font:inherit;">
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <h1>Orders</h1>
</head>
<body>
<table>
    <?php
    while($kask->fetch()){
        echo "
        <tr>
            <td>$customer_id</td>
            <td>$order_date_time</td>
            <td>$order_amount</td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='order_id' value='$order_id' />
                    <input type='text' name='customer_id' value='$customer_id' />
                    <input type='text' name='order_date_time' value='$order_date_time' />
                    <input type='text' name='order_amount' value='$order_amount' />
                    <input type='submit' value='Update' />
                </form>
            </td>
        </tr>
        ";
    }
    ?>
</table>
    <?php
    include('footer.php')
    ?>
</body>
</html>
