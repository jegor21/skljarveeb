<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
<?php
session_start();
?>
<?php
require_once("konf.php");
global $yhendus;

if(!empty($_REQUEST["name"]) && !empty($_REQUEST["phone_number"])){
    $kask=$yhendus->prepare("UPDATE Customer SET name=?, phone_number=? WHERE customer_id=?");
    $kask->bind_param("ssi", $_REQUEST["name"], $_REQUEST["phone_number"], $_REQUEST["customer_id"]);
    $kask->execute();
}

$kask=$yhendus->prepare("SELECT customer_id, name, phone_number FROM Customer");
$kask->bind_result($customer_id, $name, $phone_number);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Customers</title>
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
    <h1>Customers</h1>
</head>
<body>
<table>
    <?php
    while($kask->fetch()){
        echo "
        <tr>
            <td>$name</td>
            <td>$phone_number</td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='customer_id' value='$customer_id' />
                    <input type='text' name='name' value='$name' />
                    <input type='text' name='phone_number' value='$phone_number' />
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
