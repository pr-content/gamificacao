<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <title>Logout</title>
	<link rel="shortcut icon" href="../../img/pr.png" type="image/x-png"/>
</head>

<body>
  <?php

  //Inicia a sessão
  session_start();

  //Termina a sessão
  session_destroy(); 

  //Libera todas as variáveis de sessão
  session_unset();

  ?>
  <script src="exit.js"></script>
</body>
</html>

