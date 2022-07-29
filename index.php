<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>News - Início</title>
    <link href="CSS/style.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/fe459689b4.js"></script>
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
        ?>
      </li>
      <li><a href="cadastra_usuarios.php">Cadastrar Usuário</a></li>
                    <?php
                            if(isset($_SESSION['id']))
                            {
                                echo "<li><a href='minhas_noticias.php'>Minhas Notícias</a></li>";
                            }
                    ?>
      <li><a href="ranking_completo.php">Ranking</a></li>
      <li><a href="sobre.php">Sobre</a></li>
      <li><a href="relatorios.php">Relatórios</a></li>
      </ul>
    </div>
	</div>
  
  <div class = "conteudo esquerda" id="conteudo">
  <?php 

  if(isset($_SESSION['id']))
  {  
      include('connect.inc.php');
      $page  = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
      $quantidade = 10;
      $inicio   = ($quantidade*$page)-$quantidade;
      $sem_resultados = TRUE;
      
      $sql = "SELECT COUNT(*) AS Quantidade FROM noticias";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $num_pages = ceil($row['Quantidade']/$quantidade);
      

      $sql = "SELECT n.ID, n.Titulo, n.Texto, n.Imagem, u.Nome as Autor, u.Pontos  FROM noticias as n
              JOIN usuarios as u WHERE n.ID_Usuario = u.ID
              ORDER BY ID DESC LIMIT $inicio, $quantidade";
      $result = $conn->query($sql);
      

      if ($result->num_rows > 0) 
      {                    
          $sem_resultados = FALSE;
          
          // Dados de cada registro
          while($row = $result->fetch_assoc()) 
          {            

              $titulo = $row['Titulo'];
              $texto = $row['Texto'];
              if(strlen($texto) > 200)
              {
                $texto = substr($texto, 0, 200)."...";
              }
              $id = $row['ID'];
              $autor = $row['Autor'];
              $pontos = $row['Pontos'];
              $banner = "img/".$row['Imagem'];
              echo "<form class = 'form1' id='form1' method='GET' action='noticia.php'>
                      <div class='quadro-noticias'>
                      <input type='hidden' id='noticia' name='noticia' value=$id>
                          <h1>$titulo</h1>
                          <figure class = 'banner'>
                            <img src=$banner>
                          </figure>
                          <div class = 'texto'>$texto</div>
                          <div class = 'autor'>Autor: $autor<br> Pontuação: $pontos</div>
                          <div class = 'botões'>
                            <input type='submit' value='Ver Mais'>
                          </div>
                      </div>
                    </form>";
          }
        

        echo "<div><ul class = 'paginação'>";
        for($i = 1; $i < $num_pages+1; $i++)
        { 
            echo "<li><a href='index.php?page=$i' style='text-decoration: none;'>$i</a></li>";
        }
        echo "</ul></div><br><br><br>";
        }
        if($sem_resultados)
        {
            echo "Sem Resultados.";
        }
  }
  else
  {
    echo "<h2>Você deve estar logado para acessar essa página.<h2>";                    
    echo "<br><br>
    <form id ='voltar' method='POST' action='login.php'>
        <input type='submit' value='Acesse sua conta'>
    </form>";

  }
    ?>
  </div>

  <div class = "barra-lateral" id="barra-lateral">
    <div class = "ranking">
      <h1>Ranking</h1>
      <ul>        
        <?php
              include('ranking.php');
          ?>
    </div>
	</div>



	
  
        
    <script src="JavaScript/script.js"></script>
	</body>
	</html>