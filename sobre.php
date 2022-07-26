<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>News - Sobre</title>
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
            </ul>
        </div>
	</div>



	<div class = "conteudo esquerda"id="conteudo">
        
        <h1>Sobre</h1>
        <h2>Membros do Grupo</h2>
        <p>Diego William Lima Queiroz</p>
        <p>diego.w.queiroz@ufv.br</p>
        <p>Matrícula: ER05222</p>
        <BR><BR><BR>
        <p>Felipe Assunção Jordão</p>
        <p>felipe.jordao@ufv.br</p>
        <p>Matrícula: ER05155</p>
        <BR><BR><BR>
        <p>Gleidson Vinícius Gomes Barbosa</p>
        <p>gleidson.barbosa@ufv.br</p>
        <p>Matrícula: ER06331</p>
    
        
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
	</body>
	</html>
</html>