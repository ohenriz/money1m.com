
<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor = $_POST['valor'];
    $usuario_id = $_SESSION['usuario_id'];

    if ($valor < 30) {
        echo 'Valor mínimo de depósito é R$30.';
    } else {
        $stmt = $pdo->prepare("UPDATE usuarios SET saldo = saldo + :valor WHERE id = :id");
        $stmt->execute(['valor' => $valor, 'id' => $usuario_id]);

        $stmt = $pdo->prepare("INSERT INTO transacoes (usuario_id, tipo, valor) VALUES (:usuario_id, 'deposito', :valor)");
        $stmt->execute(['usuario_id' => $usuario_id, 'valor' => $valor]);

        echo 'Depósito realizado com sucesso!';
    }
}
?>

<form method="POST">
    <input type="number" name="valor" placeholder="Valor a depositar" required />
    <button type="submit">Depositar</button>
</form>
