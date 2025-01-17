<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width' initial-scale = '1.0'>
	<link rel="shortcut icon" href="../../img/pr.png" type="image/x-png"/>
  <link rel="stylesheet" type="text/css" href="matricula.css">
	<title>Login</title>
</head>
<body>
  <div class="root">
    <img src="../../img/logo.png">

    <div class="line">
      <h1> O que é a Gameficação?</h1>
    </div>

    <div class="wrapper-text">
      <article>
          A gameficação é uma maneira de trazer <br>
          interatividade à SEMCITEC e deixar o evento <br>
          mais divertido aos pesquisadores! <br> <br>
                        
          Esse é o espaço responsável pelo login <br>
          e iniciação na segunda Gameficação - PR. <br>
          Após o login, você terá acesso à uma página <br>
          onde poderá inserir senhas, assim ganhando pontos <br>
          e consequentemente conquistas e prêmios!<br>
      </article>
    </div>

    <div class="link-container">
      Clique <a href="../Regras/regras.html" target="_blank">aqui</a> 
      para acessar as regras da gameficação.
    </div>

    <div class="login-container">
      <div class="line-login">
        <h1>Login</h1>
      </div>

       <form method="POST" action="matricula.php">

        <div class="input">
          <input type="text" name="matricula" required maxlength="7" placeholder="Digite aqui">
        </div>

        <div class="input">
          <button id="button-submit" type="submit" name="entrar">Jogar</button> <br> <br>
        </div>
        
          <?php
            //Inicia a sessão
            session_start();
          
            //Define quais erros serão reportados
            error_reporting(0);
          
            ini_set("display_errors", 0);
          
            //Pega a matrícula do formulário
            $matricula = $_POST['matricula'];
          
            $entrar = $_POST['entrar'];
          
            //Conexão com o banco de dados
            include ('../../config/conexao.php');
          
            //Verificar se o aluno cadastrado no banco de dados é o mesmo tentando se conectar.
            $sql = "SELECT matricula FROM alunos where matricula = '$matricula'";
            $connection = mysqli_query($con, $sql) or die('<p> Erro de consulta. </p>');
            $convertion = mysqli_fetch_array($connection);
          
            if (isset($entrar)) {
              if ($matricula == $convertion['matricula'] && $convertion['matricula'] != null) {
                $_SESSION['matricula'] = $matricula;
                header('location:../Main/telasenha.php');
                }
                
                else{
                  echo "<b> Matrícula não encontrada, certifique-se que está correta, caso contrário entre em contato com um membro da comissão responsável pela gameficação </b>";
                  unset($_SESSION['matricula']);	
                }
              }
          ?>
      </form>
    </div>

    <div class="footer">
      <p> Comissão SEMCITEC - 2020. <br> 
       Redes sociais do evento: <br>
      </p>

      <div class="buttons-container">
        <a href="https://facebook.com/semcitecpr" target="_blank">
          <img src="../../img/facebook.png">
        </a>
        
        <a href="https://instagram.com/semcitecpr" target="_blank">
          <img src="../../img/insta.png">
        </a>
      </div>
      
    </div>
  </div>
  <script src="index.js"></script>	
</body>
</html>