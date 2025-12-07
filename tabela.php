<?php
session_start();
include('verifica_login.php');
include('menu.php');
include('conexao_2.php'); 

// Verifica se existe pesquisa
$pesquisa = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $pesquisa = $conexao->real_escape_string($_GET['search']);
    $sqlConsulta = "
        SELECT * FROM alunos 
        WHERE nome_comp LIKE '%$pesquisa%'
           OR ultNome LIKE '%$pesquisa%'
        ORDER BY nome_comp ASC
    ";
} else {
    $sqlConsulta = "SELECT * FROM alunos ORDER BY nome_comp ASC";
}

$resultado = $conexao->query($sqlConsulta);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Tabela</title>

<style>
/* css da tabelinha */
.card-custom {
    background: #fff;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.10);
}

.table thead th {
    background-color: #f1f1f1;
    font-weight: 600;
}

.search-input {
    border-radius: 8px;
    padding: 10px;
}

.search-btn {
    border-radius: 8px;
}

.table tbody tr td,
.table tbody tr th {
    padding: 14px 10px !important;
}
</style>

</head>
<body>
    <div class="container mt-5">

        <div class="card-custom">

            <h3 class="fw-semibold mb-3 text-center" style="background-color: darkslategrey; color: whitesmoke; border-radius: 10px;">
                <i class="bi bi-people-fill me-2"></i>Alunos Cadastrados
            </h3>

            <!-- Barra de pesquisa-->
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input 
                        type="text" 
                        name="search"
                        class="form-control search-input"
                        placeholder="Buscar por nome ou último nome..."
                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                    >
                    <button class="btn dark search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <!--tabela-->
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Último Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Responsável</th>
                            <th>Tipo do responsável</th>
                            <th>Curso</th>
                            <th>Rua</th>
                            <th>Número</th>
                            <th>Bairro</th>
                            <th>CEP</th>
                            <th colspan="2" class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    if ($resultado->num_rows > 0) {
                        $i = 1;
                        while($row = $resultado->fetch_assoc()) { ?>
                            
                            <tr>
                                <th><?= $i++; ?></th>
                                <td><?= $row['nome_comp']; ?></td>
                                <td><?= $row['ultNome']; ?></td>
                                <td><?= $row['data_nasc']; ?></td>
                                <td><?= $row['resp']; ?></td>
                                <td><?= $row['genero']; ?></td>
                                <td><?= $row['curso']; ?></td>
                                <td><?= $row['rua']; ?></td>
                                <td><?= $row['num']; ?></td>
                                <td><?= $row['bairro']; ?></td>
                                <td><?= $row['cep']; ?></td>

                                <td class="text-center">
                                    <a href="editar.php?id=<?= $row['id']; ?>" class="btn btn-dark text-white btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="excluir.php?id=<?= $row['id']; ?>" 
                                    class="btn btn-dark text-white btn-sm"
                                    onclick="return confirm('Tem certeza que deseja excluir este aluno?');">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </td>
                            </tr>

                    <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="12" class="text-center p-3">
                                Nenhum aluno encontrado<?= $pesquisa ? " para '$pesquisa'" : "" ?>.
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</body>
</html>
