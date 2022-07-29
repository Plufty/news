<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>News - Relatórios</title>
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

	<div class = "conteudo esquerda"id="conteudo">
      <?php

      
      
        echo "<h1>Relatórios</h1>";
              
        echo "<form id ='voltar' method='POST' action='relatório_usuários.php'>
        <input type='submit' value='Relatório de Usuários'>
        </form>";

        echo "<form id ='voltar' method='POST' action='relatório_notícias.php'>
        <input type='submit' value='Relatório de Notícias'>
        </form>";

        echo "<form id ='voltar' method='POST' action='relatório_ranking.php'>
        <input type='submit' value='Listagem de Ranking'>
        </form>";

        echo "<form id ='voltar' method='POST' action='relatório_fake.php'>
        <input type='submit' value='Relatório de Notícias Fake'>
        </form>";
      ?>

	</div>
	</body>
	</html>
</html>