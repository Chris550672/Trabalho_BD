<?php
$email = $_SESSION['email'];
$nomeCurto = explode('@', $email)[0];
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    
    <a class="navbar-brand d-flex align-items-center gap-2" href="painel.php">
      <i class="bi bi-house-door-fill text-white"> </i> Início
      </a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="registrar.php">Registrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="tabela.php">Tabela</a>
        </li>
      </ul>

      <!-- Área do usuário -->
      <div class="d-flex align-items-center gap-3">

        <span class="text-white fw-semibold">
          Olá, <?= $nomeCurto ?>!
        </span>

        <a href="logout.php" class="btn btn-outline-light">
          Sair
        </a>

      </div>
    </div>
  </div>
</nav>
