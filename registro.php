
<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)");
    $stmt->execute(['nome' => $nome, 'email' => $email, 'senha_hash' => $senha_hash]);

    echo 'Cadastro realizado com sucesso!';
}
?>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required />
    <input type="text" name="email" placeholder="Email" required />
    <input type="password" name="senha" placeholder="Senha" required />
    <button type="submit">Cadastrar</button>
</form>
