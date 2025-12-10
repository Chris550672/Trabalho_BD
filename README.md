# Trabalho_Final-BD


## 📌 Uma descrição Geral do Sistema:
Este repositório contém um sistema para cadastro, edição, listagem (em tabelas) e exclusão de alunos, desenvolvido em PHP + MySQL, com interface construída em Bootstrap e ícones retiradas e feitas do Bootstrap Icons.

O objetivo do projeto é ter um melhor gerenciamento básico de alunos, armazenando informações pessoais, endereço, responsável, curso e outras informações relevantes, além de possuir dados e estatísticas que podem ajudar na análise desses dados.


### O projeto contém:
1. Login com sessão
2. Cadastro de alunos
3. Listagem com busca
4. Edição de registros
5. Exclusão de registros
6. Tabelas organizadas com Bootstrap
7. Dashboards com gráficos (faixa etária, cursos etc.)
8. Separação de arquivos (conexão, telas, ações)


## 🔌 Códigos SQL e suas funções

### 👤 Tabela User
CREATE TABLE users ( <br>
    user_id INT AUTO_INCREMENT PRIMARY KEY,<br>
    user_email VARCHAR(100) NOT NULL UNIQUE,<br>
    user_password VARCHAR(255) NOT NULL<br>
);

#### Cria um local para armazenar as pessoas cadastradas e que irão acessar nosso site

### 👨‍🎓 Tabela alunos
CREATE TABLE alunos ( <br>
    id INT AUTO_INCREMENT PRIMARY KEY, <br>
    nome_comp VARCHAR(100) NOT NULL, <br>
    ultNome VARCHAR(100) NOT NULL,<br>
    data_nasc DATE NOT NULL,<br>
    resp VARCHAR(120) NOT NULL,<br>
    genero VARCHAR(20) NOT NULL,<br>
    curso VARCHAR(100) NOT NULL,<br>
    rua VARCHAR(120) NOT NULL,<br>
    num VARCHAR(20) NOT NULL, <br>
    bairro VARCHAR(120) NOT NULL, <br>
    cep VARCHAR(20) NOT NULL <br>
);

#### Cria um local de armazenamento das informações de cada aluno regsitrado no nosso sistema

## 📌 Descrição das funcionalidades de cada arquivo
### 1. Cadastro.php

- Função: Cadastrar novos usuários no sistema.

- O que ele faz:
Recebe nome, e-mail e senha enviados pelo formulário.
Verifica se o e-mail já está cadastrado.
Criptografa a senha com MD5.
Salva o usuário no banco na tabela users.
Exibe mensagem de sucesso ou erro.
Link para voltar ao login.

### 2. login.php

- Função: Realizar autenticação dos usuários.

- O que ele faz:
Recebe email e senha do formulário.
Compara email e senha com os registros do banco.
Se estiver certo, cria uma sessão ($_SESSION['email']) e envia o usuário para o painel.
Se estiver errado, exibe mensagem de erro.

### 3. painel.php

- Função: Página principal após o login.

- O que ele faz:
Verifica se usuário está logado (via session_start).
Puxa estatísticas do banco, como:
~ quantidade de alunos por curso,
~ quantidade por gênero,
~ bairros com maior quantidade de alunos.
~ quantos alunos têm certas idades.

- Mostra tudo na tela como relatórios simples.
- Tem botão para cadastrar novo aluno e para sair.

### 4. editar.php

- Função: Editar informações de um aluno.

- O que ele faz:

Recebe o ID do aluno pela URL.
Busca esse aluno na tabela alunos.
Preenche um formulário com os dados atuais.

- Quando envia o formulário:
atualiza os dados no banco.
redireciona para uma página de sucesso ou mensagem.

### 5. excluir.php

- Função: Excluir um aluno.

- O que ele faz:
Recebe ID do aluno pela URL.
Executa um DELETE no banco.
Redireciona de volta para a listagem (ou painel).

### 6. conexao.php / conexao2.php

- Função: Criar conexão com o banco de dados MySQL.

O que eles fazem: 
- Guardam host, usuário, senha e nome do banco. 
- Criam um objeto mysqli para usar nas consultas. 
- Se a conexão falhar, mostram mensagem de erro.

### 7. Arquivos HTML e PHP associados aos códigos principais

- Função: Exibir formulários e interface
- Contêm as telas do CRUD (cadastro, edição, login).
- Enviam informações via POST ou GET para os arquivos PHP.



## 🔍 Consultas feitas:

1. Quantidade Total de Alunos registrados
2. Quantidade de Alunos por cada curso (Enfermagem, Informática, Desenvolvimento de Sistemas e Administração) --> 5 pesquisas
3. Comparação da quantidade total de alunos (Gráfico de pizza)
4. Comparação do tipo de responsável dos alunos registrados(Gráfico de colunas)
5. Comparação dos bairros com mais alunos registrados
6. Comparação das faixas etárias dos alunos + Cards com as faixas etárias exatas



## 🖼️ Imagens do Projeto

### Tela de Login
<img width="643" height="560" alt="image" src="https://github.com/user-attachments/assets/b9bd7654-e906-4682-be9a-10e22e718e30" />

### Tela de Cadastro de novos usuários

<img width="745" height="601" alt="image" src="https://github.com/user-attachments/assets/ab3448ea-ad69-49af-9b8f-b956d0a982b8" />

### Painel principal 01

<img width="1307" height="666" alt="image" src="https://github.com/user-attachments/assets/c6d95b23-966d-4665-9f8e-c8df5c9484b9" />

### Painel principal 02

<img width="1273" height="656" alt="image" src="https://github.com/user-attachments/assets/5904a9ed-8d59-413b-bf3b-7a846ad7387c" />

### Sessão de Registro de Alunos
<img width="1296" height="667" alt="image" src="https://github.com/user-attachments/assets/4ec19799-77ce-443b-aed4-16aedfc79fe9" />

### Tabela com os Alunos Registrados
<img width="1290" height="661" alt="image" src="https://github.com/user-attachments/assets/a0624fab-4b06-4432-92b3-e18eddd1989c" />

### Editar e Excluir Alunos Registrados
<img width="519" height="190" alt="image" src="https://github.com/user-attachments/assets/34dfa58a-3b95-40a5-949d-1d27fec51637" />

### Logout: Voltar pro Login
<img width="682" height="156" alt="image" src="https://github.com/user-attachments/assets/290862f9-7a0d-4ee9-9cb5-eb9ea6d1e39e" />



