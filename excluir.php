<?php
include("conexao_2.php");

if (!isset($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM alunos WHERE id = $id";
$conexao->query($sql);

header("Location: tabela.php?del=ok");
exit;
