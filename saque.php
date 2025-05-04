
<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor = $_POST['valor'];
    $usuario_id = $_SESSION['usuario_id'];

    if ($valor < 200000) {
        echo 'Valor mínimo de saque é R$200.000.';
    } else {
        $stmt = $pdo->prepare("SELECT saldo FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $usuario_id]);
        $usuario = $stmt->fetch();

        if ($usuario['saldo'] >= $valor) {
            $stmt = $pdo->prepare("UPDATE usuarios SET saldo = saldo - :valor WHERE id = :id");
            $stmt->execute(['valor' => $valor, 'id' => $usuario_id]);

            $stmt = $pdo->prepare("INSERT INTO transacoes (usuario_id, tipo, valor) VALUES (:usuario_id, 'saque', :valor)");
            $stmt->execute(['usuario_id' => $usuario_id, 'valor' => $valor]);

            echo 'Saque realizado com sucesso!';
        } else {
            echo 'Saldo insuficiente.';
        }
    }
}
?>

<form method="POST">
    <input type="number" name="valor" placeholder="Valor a sacar" required />
    <button type="submit">Sacar</button>
</form>
