<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>News - Cadastrar Usuários</title>
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
                    ?>
                </li>
                <li><a href="cadastra_usuarios.php">Cadastrar Usuário</a></li>
                <li><a href="ranking_completo.php">Ranking</a></li>
                <li><a href="sobre.php">Sobre</a></li>
            </ul>
        </div>
	</div>

  
	<div class = "conteudo esquerda"id="conteudo">
    <div class="um">
            <form class = "formulário um" id="form1" method="POST" action="insere_usuario.php">            
            <h2>Inserir Usuário:</h2>
            <p><b>Nome de Usuário<br></b> 
                    <input type="text" name="nome" id = "nome">
                </p>
                
                <p><b>E-mail<br></b> 
                    <input type="text" name="email" id = "email">
                </p>    

                <div>
                    <b>&nbsp;</b><br>
                    <input type="button" value="Enviar" onclick="verifica_campos_usuario()">
                </div>
            </form>
        </div>
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
  
  <script src="https://use.fontawesome.com/fe459689b4.js"></script>
  <script src="JavaScript/script.js"></script>  

	</body>
	</html>