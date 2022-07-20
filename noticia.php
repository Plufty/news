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
        <li><a href="minhas_noticias.php">Minhas Notícias</a></li>
        <li><a href="">Ranking</a></li>
        <li><a href="sobre.php">Sobre</a></li>
      </ul>
    </div>
	</div>
  
  <div class = "conteudo esquerda" id="conteudo">
  <?php 
    include('connect.inc.php');
        $noticia = $_GET['noticia'];

        $sem_resultados = TRUE;

        $sql = "SELECT n.ID, n.Titulo, n.Texto, n.Imagem, n.Fake, u.Nome as Autor, u.ID as ID_Autor  FROM noticias as n
                JOIN usuarios as u WHERE n.ID_Usuario = u.ID AND n.ID = $noticia";
        $result = $conn->query($sql);
        
        //Tabela de alunos
        if ($result->num_rows > 0) 
        {                    
            $sem_resultados = FALSE;
            
            // Dados de cada registro
            while($row = $result->fetch_assoc()) 
            {            
  
                $titulo = $row['Titulo'];
                $texto = $row['Texto'];
                $id = $row['ID'];
                $autor = $row['Autor'];
                $id_autor = $row['ID_Autor'];
                $fake = $row['Fake'];
                $banner = "img/".$row['Imagem'];
                echo "<form class = 'avalia' id='avalia' method='POST' action='avalia.php'>
                        <input type='hidden' id='id_usuario' name='id_usuario' value=$id_autor>
                        <input type='hidden' id='noticia' name='noticia' value=$noticia>
                            <h1>$titulo</h1>
                            <figure class = 'banner'>
                              <img src=$banner>
                              <figcaption>Autor: $autor</figcaption>
                            </figure>
                            <div class = 'texto-detalhado'>$texto</div>
                            <div class = 'botões'>
                              <input type='hidden' id='id_usuario' name='id_usuario' value=$id_autor>
                              <button class='btn' id='like' name='botão' value='like' onclick='avalia.php'><i class='fa fa-thumbs-up fa-lg' aria-hidden='true'></i></button>
                              <button class='btn' id='deslike' name='botão' value='deslike' onclick='avalia()'><i class='fa fa-thumbs-down fa-lg' aria-hidden='true'></i></button>
                              <button class='fake' id='fake' name='botão' value='fake' onclick='avalia.php'>Fake($fake)</i></button>
                            </div>
                      </form>";        

                      if($_SESSION['id'] == $id_autor)
                      {
                        echo "<br><br>
                        <form id ='voltar' method='POST' action='altera_noticia.php'>                  
                          <input type='hidden' id='noticia' name='noticia' value=$noticia>
                            <input type='submit' value='Editar' style = 'margin-top: 2%;'>
                        </form>";
                      }
            }

        }

        echo "<br><br>
        <form id ='voltar' method='POST' action='index.php'>
            <input class = 'voltar' type='submit' value='Voltar'>
        </form>";

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

    