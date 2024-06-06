<?php
session_start();
?>
<?php
require_once("konf.php");
global $yhendus;

if(!empty($_REQUEST["dish_name"]) && !empty($_REQUEST["description"]) && !empty($_REQUEST["price"]) && !empty($_REQUEST["category_id"])){
    $kask=$yhendus->prepare("UPDATE Menu SET dish_name=?, description=?, price=?, category_id=? WHERE dish_id=?");
    $kask->bind_param("ssdii", $_REQUEST["dish_name"], $_REQUEST["description"], $_REQUEST["price"], $_REQUEST["category_id"], $_REQUEST["dish_id"]);
    $kask->execute();
}

$kask=$yhendus->prepare("SELECT dish_id, dish_name, description, price FROM Menu");
$kask->bind_result($dish_id, $dish_name, $description, $price);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Menu</title>
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
    <h1>Menu</h1>
</head>
<body>
<table>
    <?php
    while($kask->fetch()){
        echo "
        <tr>
            <td>$dish_name</td>
            <td>$description</td>
            <td>$price</td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='dish_id' value='$dish_id' />
                    <input type='text' name='dish_name' value='$dish_name' />
                    <input type='text' name='description' value='$description' />
                    <input type='text' name='price' value='$price' />
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
