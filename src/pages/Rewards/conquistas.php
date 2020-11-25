<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width' initial-scale = '1.0'>
	<title>Conquistas</title>
	<link rel="shortcut icon" href="../../assets/pr.png" type="image/x-png"/>
	<link rel="stylesheet" type="text/css" href="conquistas.css">

  <?php

    //Inicia a sessão
    session_start();

    //Se não estiver logado com a matrícula, o usuário volta a página principal
    if((!isset ($_SESSION['matricula']) == true)) {
      unset($_SESSION['matricula']);
      header('location:../HomePage/matricula.php');
    }

    //Coloca a sessão na variável
    $logado = $_SESSION['matricula'];

  ?>

</head>
<body>
  <div id="root">
    <div class="header">
      <a href="../Main/telasenha.php">
        <img src="../../img/buttonvoltar.png" id="voltar">
      </a>

      <a href="../Exit/logout.php">
        <img src="../../img/buttonsair.png" id="sair">
      </a>
    </div>

    <?php
      //Conexão com o banco de dados
      include ('../../config/conexao.php');
      
      $sqlapresentador = "SELECT matricula, count(matricula) FROM recebeapresentador where matricula = '$logado'";
      $sqlcurioso = "SELECT matricula, count(matricula) FROM recebecurioso where matricula = '$logado'"; 
      $sqlnetworking = "SELECT matricula, count(matricula) FROM recebenetworking where matricula = '$logado'";
      $sqlrespeitavel = "SELECT matricula, count(matricula) FROM receberespeitavel where matricula = '$logado'";
      $sqlvoluntario = "SELECT matricula, count(matricula) FROM recebevoluntario where matricula = '$logado'";

      $resultapresentador = $con->query($sqlapresentador);
      $resultcurioso = $con->query($sqlcurioso);
      $resultnetworking = $con->query($sqlnetworking);
      $resultrespeitavel = $con->query($sqlrespeitavel);
      $resultvoluntario = $con->query($sqlvoluntario);
      
      //Converte as queries em array
      $arrayapresentador = mysqli_fetch_array($resultapresentador);
      $arraycurioso = mysqli_fetch_array($resultcurioso);
      $arraynetworking = mysqli_fetch_array($resultnetworking);
      $arrayrespeitavel = mysqli_fetch_array($resultrespeitavel);
      $arrayvoluntario = mysqli_fetch_array($resultvoluntario);
      
    ?>

    <?php
      //Esse é o total de cada categoria
      $totalApresentadorSenha = 3;
      $totalCuriosoSenha = 5;
      $totalNetworkingSenha = 4;
      $totalRespeitavelSenha = 3;
      $totalVoluntarioSenha = 3;

      //Resultado
      $somaApresentador = ($arrayapresentador['count(matricula)']/$totalApresentadorSenha)*100;
      $somaCurioso = ($arraycurioso['count(matricula)']/$totalCuriosoSenha)*100;
      $somaNetworking = ($arraynetworking['count(matricula)']/$totalNetworkingSenha)*100;
      $somaRespeitavel = ($arrayrespeitavel['count(matricula)']/$totalRespeitavelSenha)*100;
      $somaVoluntario = ($arrayvoluntario['count(matricula)']/$totalVoluntarioSenha)*100;
      
    ?>
		
    <div id="wrapper">
        <div class="images-wrapper">
          <img src="../../img/AP.png" class="figuras">
        </div>

        <div class="progress-wrapper">
          <h2> Apresentador: </h2>
          <div class="line"> 
            <div style="height: 10px; width: <?php echo $somaApresentador; ?>%; background:rgb(255, 92, 145);">
            </div>
          </div>
          <?php
            echo "Você tem <b>".$arrayapresentador['count(matricula)']."</b> de <b>3</b> senhas, complete as 3 e ganhe uma conquista <br><br>";
          ?>
        </div>

        <div class="images-wrapper">
          <img src="../../img/CR.png" class="figuras">
        </div>  
        
        <div class="progress-wrapper">
          <h2>Curioso:</h2>
          <div class="line"> 
            <div> style="height: 10px; width: <?php echo $somaCurioso; ?>%; background:rgb(255, 92, 145)">
            </div>
          </div>
          <?php
            echo "Curioso: Você tem <b>".$arraycurioso['count(matricula)']."</b> de <b>5</b> senhas, complete as 5 e ganhe uma conquista"."<br><br>";
          ?>
        </div>

        <div class="images-wrapper">
          <img src="../../img/NT.png" class="figuras">
        </div>
        
        <div class="progress-wrapper">
          <h2>Networking:</h2>
          <div class="line"> 
            <div style="height: 10px; width: <?php echo $somaNetworking; ?>%; background:rgb(255, 92, 145)">|</div>
          </div>
            <?php
              echo "Networking: Você tem <b>".$arraynetworking['count(matricula)']."</b> de <b>4</b> senhas, complete as 4 e ganhe uma conquista"."<br><br>";
            ?>
        </div>

        <div class="images-wrapper">
          <img src="../../img/RP.png" class="figuras">
        </div> 
        
        <div class="progress-wrapper">
          <h2>Respeitavel Público:</h2>
          <div class="line"> 
            <div style="height: 10x; width: <?php echo $somaRespeitavel; ?>%; background:rgb(255, 92, 145)">|
            </div>
            <?php
              echo "Respeitavel Público: Você tem <b>".$arrayrespeitavel['count(matricula)']."</b> de <b>3</b> senhas, complete as 3 e ganhe uma conquista"."<br><br>";
            ?>
          </div>
        </div>
        <br>

        <div class="images-wrapper">
          <img src="../../img/VO.png" class="figuras">
        </div>
        
        <div class="progress-wrapper">
          <h2>Voluntário:</h2>
          
          <div class="line"> 
              <div style="height: 10px; width: <?php echo $somaVoluntario; ?>%; background:rgb(255, 92, 145)">|
              </div>
            <?php
              echo "Voluntário: Você tem <b>".$arrayvoluntario['count(matricula)']."</b> de <b>3</b> senhas, complete as 3 e ganhe uma conquista"."<br><br>";
            ?>
          </div>
      </div>  

        <div class="footer">
          <img id="trofeu" src="../../img/trofeu.png">

          <?php   
            $totalapresentador = 0;
            $totalacurioso = 0;
            $totalnetworking = 0;
            $totalrespeitavel = 0;
            $totalvoluntario = 0;
            $total = 0;

            //Verificação das conquistas
            if ($arrayapresentador['count(matricula)'] == 3) {
              $totalapresentador += 1;
            }
            if ($arraycurioso['count(matricula)'] >= 15) {
              $totalacurioso += 3;
            }
            elseif ($arraycurioso['count(matricula)'] >= 10) {
              $totalacurioso += 2;
            }
            elseif ($arraycurioso['count(matricula)'] >= 5) {
              $totalacurioso += 1;
            }

            if ($arraynetworking['count(matricula)'] == 4) {
              $totalnetworking += 1;
            }
            if ($arrayrespeitavel['count(matricula)'] >= 9) {
              $totalrespeitavel += 3;
            }
            elseif ($arrayrespeitavel['count(matricula)'] >= 6) {
              $totalacurioso += 2;
            }
            elseif ($arrayrespeitavel['count(matricula)'] >= 3) {
              $totalacurioso += 1;
            }
            if ($arrayvoluntario['count(matricula)'] >= 6) {
              $totalvoluntario += 2;
            }
            elseif($arrayvoluntario['count(matricula)'] >= 3) {
              $totalvoluntario += 1;
            }
              
            $total =  $totalapresentador + $totalacurioso + $totalnetworking + $totalrespeitavel + $totalvoluntario;

            echo "<center>";
            echo "<b> 1º Prêmio: </b> é necessário 2 conquistas para ganhar o primeiro prêmio, você tem: <b>".$total."</b> conquistas <br><br>";
            echo "<b> 2º Prêmio: </b>  é necessário 3 conquistas para ganhar o segundo prêmio, você tem: <b>".$total."</b> conquistas<br><br>";
            echo "<b> 3º Prêmio: </b>  é necessário 4 conquistas para ganhar o terceiro prêmio, você tem: <b>".$total."</b> conquistas<br><br>";
            echo "</center>"; 
          ?>

      </div>
    </div>
  </div> 
</body>
</html>