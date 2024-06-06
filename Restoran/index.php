<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
    </style>
    
</head>
<link rel="stylesheet" type="text/css" href="style/style.css">
<body>
    
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
<h1>Tere tulemast!</h1>
    <?php
    include('footer.php')
    ?>
</body>
</html>
