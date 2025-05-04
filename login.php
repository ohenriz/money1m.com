
<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        header('Location: perfil.php');
    } else {
        echo 'Usuário ou senha inválidos.';
    }
}
?>

<form method="POST">
    <input type="text" name="email" placeholder="Email" required />
    <input type="password" name="senha" placeholder="Senha" required />
    <button type="submit">Entrar</button>
</form>
