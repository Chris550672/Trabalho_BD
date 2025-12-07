<?php
session_start();
include('verifica_login.php');
include('conexao_2.php');

// VERIFICAR SE VEIO UM ID
if (!isset($_POST['id'])) {
    die("ID não enviado.");
}

$id = intval($_POST['id']);

// RECEBER DADOS DO FORM
$nome      = $_POST['nome_comp'];
$ultNome   = $_POST['ultnome'];
$dataNasc  = $_POST['data_nasc'];
$resp      = $_POST['resp'];
$genero    = $_POST['genero'];
$curso     = $_POST['curso'];
$rua       = $_POST['rua'];
$num       = $_POST['num'];
$bairro    = $_POST['bairro'];
$cep       = $_POST['cep'];

// PREPARAR UPDATE
$sql = "UPDATE alunos SET 
            nome_comp = '$nome',
            ultNome = '$ultNome',
            data_nasc = '$dataNasc',
            resp = '$resp',
            genero = '$genero',
            curso = '$curso',
            rua = '$rua',
            num = '$num',
            bairro = '$bairro',
            cep = '$cep'
        WHERE id = $id";

// EXECUTAR UPDATE
if ($conexao->query($sql) === TRUE) {
    $_SESSION['mensagem'] = "Dados atualizados com sucesso!";
    header("Location: tabela.php");
    exit();
} else {
    echo "Erro ao atualizar: " . $conexao->error;
}
?>
