<?php
session_start();
include('verifica_login.php');
include('menu.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrador de Itens</title>
</head>
<body>

<section class="h-100 mt-5">
    <div class="container h-100">
        <div class="row justify-content-center align-items-start">
            <div class="col-md-8">

              <form class="border p-4 rounded shadow bg-light" action="registro.php" method="POST">
                        <h1 class="mb-4 text-center main-title">
                        <i class="bi bi-journal-plus me-2"></i> Registrar Aluno
                    </h1>

    <!-- ALERTA -->
    <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><?= $_SESSION['mensagem']; ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['mensagem']); ?>
    <?php endif; ?>

    <!-- GRUPO DOS BLOCOS -->
    <div class="row g-4">

        <!-- BLOCO 1: INFORMAÇÕES PESSOAIS -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-person-vcard-fill me-2"></i> Informações Pessoais
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Primeiro Nome</label>
                        <input type="text" class="form-control" name="nome_comp">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Último Nome</label>
                        <input type="text" class="form-control" name="ultnome">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nasc">
                    </div>

                </div>
            </div>
        </div>

        <!-- BLOCO 2: RESPONSÁVEL / TIPO -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-people-fill me-2"></i> Responsável
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Responsável</label>
                        <input type="text" class="form-control" name="resp">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo</label><br>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genero" value="mãe">
                            <label class="form-check-label">Mãe</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genero" value="pai">
                            <label class="form-check-label">Pai</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genero" value="outro">
                            <label class="form-check-label">Outro</label>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- BLOCO 3: CURSO -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-bookmark-star-fill me-2"></i> Curso
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Curso</label>
                        <select class="form-select" name="curso">
                            <option selected></option>
                            <option value="Enfermagem">Enfermagem</option>
                            <option value="Informatica">Informática</option>
                            <option value="D.S">Desenvolvimento de Sistemas</option>
                            <option value="Administração">Administração</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>

        <!-- BLOCO 4: ENDEREÇO -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-geo-alt-fill me-2"></i> Endereço
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Rua</label>
                        <input type="text" class="form-control" name="rua">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número</label>
                        <input type="text" class="form-control" name="num">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="bairro">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cep">
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- /row -->

    <button type="submit" class="btn btn-secondary text-white mt-4 w-100">Enviar</button>

</form>


            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
