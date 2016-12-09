<?php
$title = 'Crear usuario';
$username = null;
$email = null;
$password = null;
$idUser = null;
if($user){
    $idUser = $user->getId();
    $username = $user->getUsername();
    $email = $user->getEmail();
    $password = $user->getPassword();
}

ob_start();
?>
    <form onsubmit="/create_user" method="get">
        <input type="text" name="username" value="<?php if($username) echo $username; ?>" required>
        <input type="email" name="email" value="<?php if($email) echo $email; ?>" required>
        <input type="password" name="password" value="<?php if($password) echo $password; ?>" required>
        <input type="hidden" name="idUser" value="<?php if($idUser) echo $idUser; ?>">
        <input type="submit" name="enviar">
    </form>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';