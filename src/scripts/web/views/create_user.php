<?php
$title = 'Crear usuario';
$username = null;
$email = null;
$password = null;
$idUser = null;
if(isset($user)){
    $idUser = $user->getId();
    $username = $user->getUsername();
    $email = $user->getEmail();
    $password = $user->getPassword();
}

ob_start();
?>
    <form onsubmit="/create_user" method="get">
        <label for="username">Nombre usuario: </label>
        <input type="text" name="username" value="<?php if($username) echo $username; ?>" required>
        <label for="email">Email: </label>
        <input type="email" name="email" value="<?php if($email) echo $email; ?>" required>
        <label for="password">Contraseña: </label>
        <input type="password" name="password" value="<?php if($password) echo $password; ?>" required>
        <input type="hidden" name="idUser" value="<?php if($idUser) echo $idUser; ?>">
        <input type="submit" name="enviar">
    </form>
<?php
$content = ob_get_clean();

require __DIR__ . '/main_layout.php';