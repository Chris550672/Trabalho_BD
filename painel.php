<?php
session_start();
include('verifica_login.php');
include('menu.php');
include('conexao_2.php'); // <-- conexão correta AQUI





// total geral
$sqlTotal = $conexao->query("SELECT COUNT(*) AS total FROM alunos");
$totalRegistros = $sqlTotal->fetch_assoc()['total'];

// enfermagem
$sqlEnf = $conexao->query("SELECT COUNT(*) AS totalEnf FROM alunos WHERE curso = 'Enfermagem'");
$totalEnfermagem = $sqlEnf->fetch_assoc()['totalEnf'];

// informática
$sqlInfo = $conexao->query("SELECT COUNT(*) AS totalInfo FROM alunos WHERE curso = 'Informatica'");
$totalInfo = $sqlInfo->fetch_assoc()['totalInfo'];

// desenvolvimento de sistemas
$sqlDS = $conexao->query("SELECT COUNT(*) AS totalDS FROM alunos WHERE curso = 'D.S'");
$totalDS = $sqlDS->fetch_assoc()['totalDS'];

// administração
$sqlAdm = $conexao->query("SELECT COUNT(*) AS totalAdm FROM alunos WHERE curso = 'Administração'");
$totalAdm = $sqlAdm->fetch_assoc()['totalAdm'];


#Informações dos responsáveis
// Mãe
$sqlMae = $conexao->query("SELECT COUNT(*) AS respMae FROM alunos WHERE genero = 'mae'");
$respMae = $sqlMae->fetch_assoc()['respMae'];

// Pai
$sqlPai = $conexao->query("SELECT COUNT(*) AS respPai FROM alunos WHERE genero = 'pai'");
$respPai = $sqlPai->fetch_assoc()['respPai'];

// Outro responsável
$sqlOutro = $conexao->query("SELECT COUNT(*) AS respOutro FROM alunos WHERE genero = 'outro'");
$respOutro = $sqlOutro->fetch_assoc()['respOutro'];

#Informações dos bairros
// PEGAR TODOS OS BAIRROS E CONTAR QUANTOS ALUNOS TEM EM CADA UM
$sqlBairros = $conexao->query("
    SELECT bairro, COUNT(*) AS total 
    FROM alunos 
    GROUP BY bairro
");

// Colocar tudo em array
$bairros = [];
while ($row = $sqlBairros->fetch_assoc()) {
    $bairros[] = $row;
}

// ORDENAR (MAIOR → MENOR)
usort($bairros, function($a, $b) {
    return $b['total'] <=> $a['total'];
});

// PEGAR APENAS OS 7 MAIORES
$bairrosTop7 = array_slice($bairros, 0, 7);

// Separar labels e valores
$labelsBairros = [];
$valoresBairros = [];

foreach ($bairrosTop7 as $b) {
    $labelsBairros[] = $b['bairro'];
    $valoresBairros[] = $b['total'];
}

// Mandar para JS
$labelsBairrosJson = json_encode($labelsBairros);
$valoresBairrosJson = json_encode($valoresBairros);

# Maior e menor de idade

// Maiores de idade
$sqlMaior = $conexao->query("
    SELECT COUNT(*) AS totalMaior 
    FROM alunos 
    WHERE TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) >= 18
");
$totalMaior = $sqlMaior->fetch_assoc()['totalMaior'];

// Menores de idade
$sqlMenor = $conexao->query("
    SELECT COUNT(*) AS totalMenor 
    FROM alunos 
    WHERE TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) < 18
");
$totalMenor = $sqlMenor->fetch_assoc()['totalMenor'];

#Faixa Etária
$sqlFaixa = $conexao->query("
    SELECT 
        SUM(CASE WHEN TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) BETWEEN 14 AND 16 THEN 1 ELSE 0 END) AS faixa1,
        SUM(CASE WHEN TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) BETWEEN 17 AND 18 THEN 1 ELSE 0 END) AS faixa2,
        SUM(CASE WHEN TIMESTAMPDIFF(YEAR, data_nasc, CURDATE()) >= 19 THEN 1 ELSE 0 END) AS faixa3
    FROM alunos
");

$faixa = $sqlFaixa->fetch_assoc();
$faixa1 = $faixa['faixa1']; // 14–16
$faixa2 = $faixa['faixa2']; // 17–18
$faixa3 = $faixa['faixa3']; // 19+



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Painel</title>
</head>

<body class="bg-light">
<h1 class="text-center fw-semibold mt-3">Informações dos Usuários</h1>
</div>
<div class="container mt-5 ">

<!-- CARDS -->
<div class="row justify-content-center text-center">

    <div class="col-md-2 mb-2">
        <div class="card shadow border-0 d-flex flex-row">
            <div style="width:8px; background:#007bff; border-radius:8px 0 0 8px;"></div>
            <div class="card-body">
                <h5>Total de Registros</h5>
                <h2 class="text-primary"><?= $totalRegistros ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-2 mb-2">
        <div class="card shadow border-0 d-flex flex-row">
            <div style="width:8px; background:#28a745; border-radius:8px 0 0 8px;"></div>
            <div class="card-body">
                <h5>Enfermagem</h5>
                <h2 class="text-success"><?= $totalEnfermagem ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-2 mb-2">
        <div class="card shadow border-0 d-flex flex-row">
            <div style="width:8px; background:#17a2b8; border-radius:8px 0 0 8px;"></div>
            <div class="card-body">
                <h5>Informática</h5>
                <h2 class="text-info"><?= $totalInfo ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-2 mb-2">
        <div class="card shadow border-0 d-flex flex-row">
            <div style="width:8px; background:#ffc107; border-radius:8px 0 0 8px;"></div>
            <div class="card-body">
                <h5>D.S</h5>
                <h2 class="text-warning"><?= $totalDS ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-2 mb-2">
        <div class="card shadow border-0 d-flex flex-row">
            <div style="width:8px; background:#ff8800; border-radius:8px 0 0 8px;"></div>
            <div class="card-body">
                <h5>ADM</h5>
                <h2 class="text-warning"><?= $totalAdm ?> </h2>
            </div>
        </div>
    </div>

</div>


<!-- GRÁFICOS -->
<div class="row mt-4">

    <div class="col-md-6">
        <div class="card shadow border-0 p-3">
            <h5 class="text-center text-white p-2 rounded mb-3" style="background: darkslategray;">Distribuição por Curso</h5>
            <canvas id="graficoPizza"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow border-0 p-3">
            <h5 class="text-center text-white p-2 rounded mb-3" style="background: darkslategray;">Quantidade de Responsáveis</h5>
            <canvas id="graficoResponsaveis"></canvas>
            <div class="card shadow border-0 p-3">
        <h5 class="text-center text-white p-2 rounded mb-3" style="background: darkslategray;">Bairros com mais Alunos</h5>
        <canvas id="graficoBairros"></canvas>
    </div>
        </div>
    </div>

</div>


<div class="row mt-4" text-center>
<!--GRafico--->
<div class="col-md-8 mt-4">
    <div class="card shadow border-0 p-3">
        <h5 class="text-center text-white p-2 rounded mb-3" style="background: darkslategray;">Distribuição por Idade</h5>
        <canvas id="graficoIdade"></canvas>
    </div>
</div>
<!--Cards--->
    
    <div class="col-md-4 mt-4 text-center">
        <h2 class="fw-semibold">Faixas etárias</h2>
        <div class="card shadow border-0 mt-4">
            <div class="card-body">
                <h5 class="fw-semibold">14 a 16 anos</h5>
                <h2 class="text-success"><?= $faixa1?></h2>
            </div>
        </div>
        <div class="card shadow border-0 mt-2">
            <div class="card-body">
                <h5 class="fw-semibold">17 a 18 anos</h5>
                <h2 class="text-warning"><?= $faixa2?></h2>
            </div>
        </div>
        <div class="card shadow border-0 mt-2">
            <div class="card-body">
                <h5 class="fw-semibold">19+ anos</h5>
                <h2 class="text-danger"><?= $faixa3?></h2>
            </div>
        </div>


</div>


<!-- JS DOS GRÁFICOS -->
<script>
const dadosCursos = {
    enfermagem: <?= $totalEnfermagem ?>,
    info: <?= $totalInfo ?>,
    ds: <?= $totalDS ?>,
    adm: <?= $totalAdm ?>
};

const dadosResponsaveis = {
    mae: <?= $respMae ?>,
    pai: <?= $respPai ?>,
    outro: <?= $respOutro ?>
};

// GRÁFICO DE PIZZA
new Chart(document.getElementById('graficoPizza'), {
    type: 'pie',
    data: {
        labels: ['Enfermagem', 'Informática', 'D.S', 'ADM'],
        datasets: [{
            data: [
                dadosCursos.enfermagem,
                dadosCursos.info,
                dadosCursos.ds,
                dadosCursos.adm
            ],
            backgroundColor: [
                '#28a745',  // Enfermagem
                '#17a2b8',  // Informática
                '#ffc107',  // D.S
                '#ff8800'   // ADM
            ],
            borderColor: '#fff',
            borderWidth: 2
        }]
    }
});


// GRÁFICO DE BARRAS
new Chart(document.getElementById('graficoResponsaveis'), {
    type: 'bar',
    data: {
        labels: ['Mãe', 'Pai', 'Outro responsável'],
        datasets: [{
            label: 'Quantidade',
            data: [
                dadosResponsaveis.mae,
                dadosResponsaveis.pai,
                dadosResponsaveis.outro
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)'
            ]
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});

//Gráfico de barras horizontais

// GRÁFICO DE BARRAS - BAIRROS
new Chart(document.getElementById('graficoBairros'), {
    type: 'bar',
    data: {
        labels: <?= $labelsBairrosJson ?>,
        datasets: [{
            label: 'Alunos por bairro',
            data: <?= $valoresBairrosJson ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.7)'
        }]
    },
    options: {
        indexAxis: 'y', // <<< BARRAS HORIZONTAIS
        responsive: true,
        scales: {
            x: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});

new Chart(document.getElementById('graficoIdade'), {
    type: 'bar',
    data: {
        labels: ['Maiores de 18', 'Menores de 18'],
        datasets: [{
            label: 'Quantidade',
            data: [<?= $totalMaior ?>, <?= $totalMenor ?>],
            backgroundColor: [
                'rgba(255, 49, 49, 0.7)',
                'rgba(98, 255, 216, 0.7)'
            ]
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: { precision: 0 }
            }
        }
    }
});

</script>


</body>
</html>
