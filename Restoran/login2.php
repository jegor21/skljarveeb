<?php include('konf.php'); ?>
<?php
global $yhendus;
session_start();

if (!empty($_POST['login']) && !empty($_POST['pass'])) {
    $login = htmlspecialchars(trim($_POST['login']));
    $pass = htmlspecialchars(trim($_POST['pass']));
    $sool = 'superhero';
    $kryp = crypt($pass, $sool);

    $paring=$yhendus->prepare("SELECT kasutaja, parool, onAdmin FROM kasutajad WHERE kasutaja=? AND parool=?");
    $paring->bind_param("ss", $login, $kryp);
    $paring->execute();
    $paring->store_result();

    if ($paring->num_rows == 1) {
        $paring->bind_result($kasutaja, $parool, $onAdmin);
        $paring->fetch();
        
        $_SESSION['kasutaja'] = $login;
        $_SESSION['admin'] = ($onAdmin == 1) ? true : false;

        header('Location: index.php');
        exit();
    } else {
        echo "kasutaja või parool on vale";
    }
    $yhendus->close();
}
?>
<link rel="stylesheet" type="text/css" href="style/style.css">
<h1>Login</h1>
<form action="" method="post">
    Login: <input type="text" name="login"><br>
    Password: <input type="password" name="pass"><br>
    <input type="submit" value="Logi sisse">
</form>
<p>admin - password:opilane -> может просматривать все страницы используя навигационное меню,менять значения в таблицах, просматривать таблицу пользователей, добавлять и удалять их </p>
<p>opilane - password:admin -> не имеет доступа к таблицам пользователей и работников</p>
