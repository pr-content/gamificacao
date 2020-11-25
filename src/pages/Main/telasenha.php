<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width' initial-scale='1.0'>
	<link rel="stylesheet" type="text/css" href="telasenha.css">
	<link rel="shortcut icon" href="../../assets/pr.png" type="image/x-png"/>
	<title>Senhas</title>

  <?php
  //Inicia a sessão
  session_start();

  error_reporting(0);

  ini_set("display_errors", 0);

  //Se a matricula não estiver setada, volta para tela principal
  if((!isset ($_SESSION['matricula']) == true)) {
    unset($_SESSION['matricula']);
    header('location:../HomePage/matricula.php');
  }
  
  $logado = $_SESSION['matricula']; 

  ?>
</head>

<body> 
  <main id="root"> 
    <?php
  
      //Pega as variáveis pelo método POST
      $apresentador = $_POST['apresentador'];
      $curioso = $_POST['curioso'];
      $networking = $_POST['networking'];
      $respeitavel = $_POST['respeitavel'];
      $voluntario = $_POST['voluntario'];
      $enviar = $_POST['enviar'];

      //Inicia a conexão com o banco de dados
      include ('../../config/conexao.php');
      
      //Consulta se o código inserido é igual ao código predefinido no db
      $listapresentador = "SELECT codApresentador FROM apresentador where codApresentador = '$apresentador'" or die("Erro");
      $listcurioso = "SELECT codCurioso FROM curioso where codCurioso = '$curioso'" or die("Erro");
      $listnetworking = "SELECT codNetworking FROM networking where codNetworking = '$networking'" or die("Erro");
      $listrespeitavel = "SELECT codResp FROM respeitavel where codResp = '$respeitavel'" or die("Erro");
      $listvoluntario = "SELECT codVoluntario FROM voluntario where codVoluntario = '$voluntario'" or die("Erro");
      
      //Coloca as queries em uma variável para depois converter em arrays
      $conexapresentador = mysqli_query($con, $listapresentador) or die("Erro de consulta.");
      $conexcurioso = mysqli_query($con, $listcurioso) or die("Erro de consulta.");
      $conexnetworking = mysqli_query($con, $listnetworking) or die("Erro de consulta.");
      $conexrespeitavel = mysqli_query($con, $listrespeitavel) or die("Erro de consulta.");
      $conexvoluntario = mysqli_query($con, $listvoluntario) or die("Erro de consulta.");

      //Converte as queries em array
      $conversaoapresentador = mysqli_fetch_array($conexapresentador);
      $conversaocurioso = mysqli_fetch_array($conexcurioso);
      $conversaonetworking = mysqli_fetch_array($conexnetworking);
      $conversaorespeitavel = mysqli_fetch_array($conexrespeitavel);
      $conversaovoluntario = mysqli_fetch_array($conexvoluntario);

      //Insere no banco de dados
      $insereapresentador = "INSERT INTO recebeapresentador VALUES('$apresentador','$logado')";
      $inserecurioso = "INSERT INTO recebecurioso VALUES('$curioso','$logado')";
      $inserenetworking = "INSERT INTO recebenetworking VALUES('$networking','$logado')";
      $insererespeitavel = "INSERT INTO receberespeitavel VALUES('$respeitavel','$logado')";
      $inserevoluntario = "INSERT INTO recebevoluntario VALUES('$voluntario','$logado')";
    ?>
   
    <div class="header">
      <header>
        <button href="../Exit/logout.php" id="click">
          <img src="../../assets/buttonsair.png">
        </button>

        <div class="heading">
          <h2>Insira suas senhas nos campos abaixo: </h2>
        </div>
      </header>
    </div>
      
    <form method="POST" action="telasenha.php"> 
      <div class="wrapper-categories">
        <label>Apresentador</label>
      </div>  

      <div class="categories">
          <input type="text" placeholder="AP00000000" name="apresentador" maxlength="10">

        <?php
        if (isset($enviar)) {
            if ($apresentador == $conversaoapresentador['apresentador'] && $conversaoapresentador['apresentador'] != null) {
              mysqli_query($con, $insereapresentador);
              echo "Senha APRESENTADOR enviada, se ela já estiver salva no banco de dados, você não pontuará..."."<br>"; 	
          }	   
          else{
              echo "Senha APRESENTADOR não inserida ou não existe..."."<br>";
            }
          }
        ?>

      </div>
      
      <div class="wrapper-categories">
        <label>	Curioso </label>
      </div>

      <div class="categories"><br>
        <input type="text" placeholder="CR00000000" name="curioso" maxlength="10"><br><br>
      
        <?php
        if (isset($enviar)) {
            if ($curioso == $conversaocurioso['curioso'] && $conversaocurioso['curioso'] != null) {
              mysqli_query($con, $inserecurioso);
              echo "Senha CURIOSO enviada, se ela já estiver salva no banco de dados, você não pontuará..."."<br>"; 	
          }	   
          else{
            echo "Senha CURIOSO não inserida ou não existe... <br>";
            }
          }
        ?>

      </div>
        
      <div class="wrapper-categories">
        <label>	Networking </label>
      </div>

      <div class="categories">
        <input type="text" placeholder="NT00000000" name="networking" maxlength="10">

        <?php
          if (isset($enviar)) {
            if ($networking == $conversaonetworking['networking'] && $conversaonetworking['networking'] != null) {
              mysqli_query($con, $inserenetworking);
              echo "Senha NETWORKING enviada, se ela já estiver salva no banco de dados, você não pontuará..."."<br>"; 	
          }
          else{
            echo "Senha NETWORKING não inserida ou não existe..."."<br>";
            }
          }
        ?>
      </div>
        
      <div class="wrapper-categories">
        <label>	Respeitável Público </label>
      </div>
          
      <div class="categories">
        <input type="text" placeholder="RP00000000" name="respeitavel" maxlength="10">
            
        <?php
          if (isset($enviar)) {
            if ($respeitavel == $conversaorespeitavel['respeitavel'] && $conversaorespeitavel['respeitavel'] != null) {
              mysqli_query($con, $insererespeitavel);
              echo "Senha RESPEITÁVEL PÚBLICO enviada, se ela já estiver salva no banco de dados, você não pontuará..."."<br>"; 	
            }

            else {
              echo "Senha RESPEITÁVEL PÚBLICO não inserida ou não existe..."."<br>";
              }
            }
        ?>

      </div>

      <div class="wrapper-categories">
        <label>	Voluntário </label>
      </div>

      <div class="categories">
        <input type="text" placeholder="VL00000000" name="voluntario" maxlength="10"> 
            
        <?php
          if (isset($enviar)) {
            if ($voluntario == $conversaovoluntario['voluntario'] && $conversaovoluntario['voluntario'] != null) {
            mysqli_query($con, $inserevoluntario);
            echo "<br>Senha VOLUNTÁRIO enviada, se ela já estiver salva no banco de dados, você não pontuará..."."<br>"; 	
          }	   
          else{
            echo "<br>Senha VOLUNTÁRIO não inserida ou não existe..."."<br>";
            }
          } 
          ?>

      </div>	

      <div class="buttons-container">
        <button type="submit" value="Enviar" id="enviar" name="enviar">
        <button id="conquista" name="enviar">Ver conquistas</button>
      </div>

    </form>
  </main>
  <script src="index.js"></script>
</body>
</html>