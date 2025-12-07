<?php
session_start();
include('conexao.php'); 
// Verifica campos vazios
if (
    empty($_POST['nome_comp']) || 
    empty($_POST['data_nasc']) ||
    empty($_POST['resp']) ||
    empty($_POST['curso']) ||
    empty($_POST['ultnome']) ||
    empty($_POST['rua']) ||
    empty($_POST['num']) ||
    empty($_POST['bairro']) ||
    empty($_POST['cep']) ||
    empty($_POST['genero'])
) {
    $_SESSION['mensagem'] = "Preencha todos os campos!";
    header('Location: registrar.php');
    exit();
}

$nome       = $_POST['nome_comp'];
$data_nasc  = $_POST['data_nasc'];
$resp       = $_POST['resp'];
$genero     = $_POST['genero'];
$curso      = $_POST['curso'];
$ultnome    = $_POST['ultnome'];
$rua        = $_POST['rua'];
$num        = $_POST['num'];
$bairro     = $_POST['bairro'];
$cep        = $_POST['cep'];

$sql = "
    INSERT INTO alunos
    (nome_comp, ultNome, data_nasc, resp, genero, curso, rua, num, bairro, cep)
    VALUES 
    ('$nome', '$ultnome', '$data_nasc', '$resp', '$genero', '$curso', '$rua', '$num', '$bairro', '$cep')
";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Muito bem! Item adicionado :p";
    header('Location: registrar.php');
    exit();
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
    header('Location: registrar.php');
    exit();
}
?>
