<?php

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'loja';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro de conexão: " . $conexao->connect_error);
}


if (isset($_GET['consulta'])) {
    $consulta = $_GET['consulta'];

    $sql = "SELECT id, nome FROM categoria WHERE nome LIKE '%$consulta%'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "ID: " . $row['id'] . " - Nome: " . htmlspecialchars($row['nome']) . "<br>";
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
} else {
    echo "Digite algo na barra de pesquisa.";
}

$conexao->close();
?>

