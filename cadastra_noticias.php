<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>News - Cadastrar Notícia</title>
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
            if(isset($_SESSION['id']))
            {                
                echo "
                <div class='um'>
                <form class = 'formulário um' id='form1' method='POST' action='insere_dados.php' enctype='multipart/form-data'>            
                <h2>Inserir Notícia:</h2>
                <input type='hidden' id='usuario' name='usuario' value=".$_SESSION['id'].">
                <p><b>Título da notícia<br></b> 
                        <input type='text' name='titulo' id = 'titulo'>
                    </p>
                    
                    <p><b>Texto da notícia<br></b>                     
                        <textarea class = 'insere-texto' id='texto' name='texto' placeholder='Texto da Notícia'></textarea>
                    </p>              
    
                    <p><b>Imagem <br></b>
                        <label class='custom-file-upload'> 
                            Upload
                            <input type='file' name='arquivo' id = 'arquivo'>
                        </label>
                    </p>       
    
                    <div>
                        <b>&nbsp;</b><br>
                        <input type='button' value='Enviar' onclick='verifica_campos_noticias()'>
                    </div>
                </form>
            </div>";
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
      </ul>
    </div>
	</div>
  
  <script src="JavaScript/script.js"></script>  

	</body>
	</html>