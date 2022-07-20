<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>News - Ranking</title>
        <link href="CSS/style.css" rel="stylesheet">
	</head>

	<body>
        

    <div class = "barra-superior" id="barra-superior">
        <div class="menu">
        <h2>News</h2>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="cadastra_noticias.php">Adicionar Notícia</a></li>
                <li>
                    <?php
                            if(!isset($_SESSION['id']))
                            {
                                echo "<a href=\"login.php\">Acesse sua conta</a>";
                            }
                            else
                            {
                                echo "<a href=\"painel.php\">Minha Conta</a>"; 
                            }
                    ?></li>
                <li><a href="cadastra_usuarios.php">Cadastrar Usuário</a></li>
                <li><a href="ranking_completo.php">Ranking</a></li>
                <li><a href="sobre.php">Sobre</a></li>
            </ul>
        </div>
	</div>



	<div class = "conteudo esquerda"id="conteudo">       
        
    <?php 
      include('connect.inc.php');
      
      $inicio = 0;
      $quantidade = 30;

      $sql = "SELECT ID, Nome, Email, Pontos FROM usuarios ORDER BY Pontos DESC LIMIT $inicio, $quantidade";
      $result = $conn->query($sql);
      

      if ($result->num_rows > 0) 
      {                    
          $sem_resultados = FALSE;
          
          // Dados de cada registro
          while($row = $result->fetch_assoc()) 
          {            

              $nome = $row['Nome'];
              $email = $row['Email'];
              $pontos = $row['Pontos'];
              echo "<div class = 'ranking-completo'>
                    <h2>$nome</h2>
                    <p>$pontos pontos</p>
                    </div>";
          }
        }
        if($sem_resultados)
        {
            echo "Sem Resultados.";
        }
    ?> 
        
    </div>
    
	</body>
	</html>
</html>