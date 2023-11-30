<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $codigo_produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    $conexao = new mysqli('MySQL:3306', 'root', '', 'loja');

    $sql = "INSERT INTO carrinho (email, codigo_produto, quantidade) VALUES ('$email', $codigo_produto, $quantidade)";
    $conexao->query($sql);

    $conexao->close();

    echo "Produto adicionado ao carrinho com sucesso!";
}
?>
