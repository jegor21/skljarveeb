<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
<?php
require_once("konf.php");
global $yhendus;

if(!empty($_REQUEST["first_name"]) && !empty($_REQUEST["last_name"]) && !empty($_REQUEST["position"]) && !empty($_REQUEST["salary"]) && !empty($_REQUEST["start_date"])){
    $kask=$yhendus->prepare("UPDATE Employee SET first_name=?, last_name=?, position=?, salary=?, start_date=? WHERE employee_id=?");
    $kask->bind_param("sssdsi", $_REQUEST["first_name"], $_REQUEST["last_name"], $_REQUEST["position"], $_REQUEST["salary"], $_REQUEST["start_date"], $_REQUEST["employee_id"]);
    $kask->execute();
}

$kask=$yhendus->prepare("SELECT employee_id, first_name, last_name, position, salary, start_date FROM Employee");
$kask->bind_result($employee_id, $first_name, $last_name, $position, $salary, $start_date);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Employees</title>
    <header>
        <nav>
            <ul>
                <li><a href="Customer.php">Customers</a></li>
                <li><a href="Menu.php">Menu</a></li>
                <li><a href="Order.php">Orders</a></li>
                <li><a href="Employee.php">Employees</a></li>
                <li><a href="kasutajad.php">Kasutajad</a></li>
<li style="float: right;">
    <form action="logout.php" method="post" style="display:inline;">
        <input type="submit" value="Logi välja" name="logout" style="background:green;border:none;color:white;cursor:pointer;font:inherit;">
    </form>
</li>

            </ul>
        </nav>
    </header>
    <h1>Employees</h1>
</head>
<body>
<table>
    <?php
    while($kask->fetch()){
        echo "
        <tr>
            <td>$first_name</td>
            <td>$last_name</td>
            <td>$position</td>
            <td>$salary</td>
            <td>$start_date</td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='employee_id' value='$employee_id' />
                    <input type='text' name='first_name' value='$first_name' />
                    <input type='text' name='last_name' value='$last_name' />
                    <input type='text' name='position' value='$position' />
                    <input type='text' name='salary' value='$salary' />
                    <input type='text' name='start_date' value='$start_date' />
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
