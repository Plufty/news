<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>News - Minha Conta</title>
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
                <li><a href="minhas_noticias.php">Minhas Notícias</a></li>
                <li><a href="ranking_completo.php">Ranking</a></li>
                <li><a href="sobre.php">Sobre</a></li>
            </ul>
        </div>
	</div>



	<div class = "conteudo esquerda"id="conteudo">
        <?php     
            if(isset($_SESSION['id']))
            {
                echo "<h2>Bem vindo ao Painel, ".$_SESSION['nome']."</h2>";
                echo "<div class='conta'>
                        <form id='form1' method='POST' action='insere_usuario.php'>
                            <input type='hidden' name='action' value='update'>
                            <p>
                                <b>Nome:</b> 
                                <input type='text' name='nome' value='".$_SESSION['nome']."'>
                            </p>
                            
                            <p>
                                <b>E-mail:</b> 
                                <input type='text' name='email' value=".$_SESSION['email'].">
                            </p>           

                            <p><b>&nbsp;</b>
                                <input type='submit' value= 'Atualizar'>
                            </p>
                        </form>
                    </div>";            
                echo "<br><br>
                <form id ='voltar' method='POST' action='logout.php'>
                    <input type='submit' value='Sair'>
                </form>";
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
	</body>
	</html>
</html>