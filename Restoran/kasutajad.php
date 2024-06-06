<?php
session_start();
?>
<?php
// Подключаем файл с конфигурацией базы данных
require_once("konf.php");
global $yhendus;

// Обработка добавления нового пользователя
if(isset($_POST['submit']) && isset($_POST['new_username']) && isset($_POST['new_password'])) {
    $username = $_POST['new_username'];
    $password = $_POST['new_password'];
    
    // Проверка наличия данных
    if(!empty($username) && !empty($password)) {
        // Шифрование пароля
        $sool = 'superhero';
        $kryp = crypt($password, $sool);
        
        // Вставка нового пользователя в базу данных
        $insert = $yhendus->prepare("INSERT INTO kasutajad (kasutaja, parool) VALUES (?, ?)");
        $insert->bind_param("ss", $username, $kryp);
        $insert->execute();
    }
}

// Обработка удаления пользователя
if(isset($_POST['delete']) && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    // Удаляем пользователя только если это не администратор
    $check_admin = $yhendus->prepare("SELECT kasutaja FROM kasutajad WHERE id = ?");
    $check_admin->bind_param("i", $user_id);
    $check_admin->execute();
    $check_admin->bind_result($username);
    $check_admin->fetch();
    $check_admin->close();

    if($username !== 'admin') {
        $delete = $yhendus->prepare("DELETE FROM kasutajad WHERE id = ?");
        $delete->bind_param("i", $user_id);
        $delete->execute();
    }
}

// Получаем данные пользователей из таблицы kasutajad
$kask = $yhendus->prepare("SELECT id, kasutaja, parool FROM kasutajad");
$kask->bind_result($id, $kasutaja, $parool);
$kask->execute();
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Kasutajad</title>
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
    <h1>Kasutajad</h1>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>Kasutajanimi</th>
        <th>Parool</th>
        <th>Tegevus</th>
    </tr>
    <?php
    while($kask->fetch()){
        // Делаем кнопку удаления неактивной для пользователя с именем 'admin'
        $deleteButtonDisabled = ($kasutaja === 'admin') ? 'disabled' : '';

        echo "
        <tr>
            <td>$id</td>
            <td>$kasutaja</td>
            <td>$parool</td>
            <td>
                <form action='' method='post'>
                    <input type='hidden' name='user_id' value='$id' />
                    <input type='submit' name='delete' value='Delete' $deleteButtonDisabled />
                </form>
            </td>
        </tr>
        ";
    }
    ?>
</table>

<!-- Форма для добавления новых пользователей -->
<form action='' method='post'>
    <input type='text' name='new_username' placeholder='New Username' required />
    <input type='password' name='new_password' placeholder='New Password' required />
    <input type='submit' name='submit' value='Add User' />
</form>
    <?php
    include('footer.php')
    ?>
</body>
</html>
