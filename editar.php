<?php
session_start();
include('verifica_login.php');
include('menu.php');
include('conexao_2.php');

// PEGAR ID
if (!isset($_GET['id'])) {
    die("ID não informado.");
}

$id = intval($_GET['id']);

// CONSULTAR ALUNO
$sql = "SELECT * FROM alunos WHERE id = $id";
$result = $conexao->query($sql);

if ($result->num_rows == 0) {
    die("Aluno não encontrado.");
}

$aluno = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Aluno</title>
</head>
<body>

<section class="h-100 mt-5">
    <div class="container h-100">
        <div class="row justify-content-center align-items-start">
            <div class="col-md-8">


              <form class="border p-4 rounded shadow bg-light" action="update.php" method="POST">

                <h1 class="mb-4 text-center main-title">
                    <i class="bi bi-pencil-square me-2"></i> Editar Aluno
                </h1>

                <!-- ID OCULTO -->
                <input type="hidden" name="id" value="<?= $aluno['id']; ?>">

                <!-- GRUPO DOS BLOCOS -->
                <div class="row g-4">

                    <!-- BLOCO 1 -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <i class="bi bi-person-vcard-fill me-2"></i> Informações Pessoais
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Primeiro Nome</label>
                                    <input type="text" class="form-control" 
                                           name="nome_comp"
                                           value="<?= $aluno['nome_comp']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Último Nome</label>
                                    <input type="text" class="form-control" 
                                           name="ultnome"
                                           value="<?= $aluno['ultNome']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" 
                                           name="data_nasc"
                                           value="<?= $aluno['data_nasc']; ?>">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- BLOCO 2 -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <i class="bi bi-people-fill me-2"></i> Responsável
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Responsável</label>
                                    <input type="text" class="form-control" 
                                           name="resp"
                                           value="<?= $aluno['resp']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tipo</label><br>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                               name="genero" value="mãe"
                                               <?= $aluno['genero'] == 'mãe' ? 'checked' : ''; ?>>
                                        <label class="form-check-label">Mãe</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                               name="genero" value="pai"
                                               <?= $aluno['genero'] == 'pai' ? 'checked' : ''; ?>>
                                        <label class="form-check-label">Pai</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                               name="genero" value="outro"
                                               <?= $aluno['genero'] == 'outro' ? 'checked' : ''; ?>>
                                        <label class="form-check-label">Outro</label>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- BLOCO 3 -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <i class="bi bi-bookmark-star-fill me-2"></i> Curso
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Curso</label>
                                    <select class="form-select" name="curso">
                                        <option value="Enfermagem" 
                                            <?= $aluno['curso'] == 'Enfermagem' ? 'selected' : ''; ?>>
                                            Enfermagem
                                        </option>
                                        <option value="Informatica" 
                                            <?= $aluno['curso'] == 'Informatica' ? 'selected' : ''; ?>>
                                            Informática
                                        </option>
                                        <option value="D.S" 
                                            <?= $aluno['curso'] == 'D.S' ? 'selected' : ''; ?>>
                                            Desenvolvimento de Sistemas
                                        </option>
                                        <option value="Administração" 
                                            <?= $aluno['curso'] == 'Administração' ? 'selected' : ''; ?>>
                                            Administração
                                        </option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- BLOCO 4 -->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-dark text-white">
                                <i class="bi bi-geo-alt-fill me-2"></i> Endereço
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Rua</label>
                                    <input type="text" class="form-control" 
                                           name="rua"
                                           value="<?= $aluno['rua']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Número</label>
                                    <input type="text" class="form-control" 
                                           name="num"
                                           value="<?= $aluno['num']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" class="form-control" 
                                           name="bairro"
                                           value="<?= $aluno['bairro']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-control" 
                                           name="cep"
                                           value="<?= $aluno['cep']; ?>">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-secondary text-white mt-4 w-100">
                    Salvar Alterações
                </button>

              </form>

            </div>
        </div>
    </div>
</section>
