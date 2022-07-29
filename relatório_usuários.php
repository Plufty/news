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
        include('connect.inc.php');
        
        $inicio = 0;
        $quantidade = 30;      
        $sem_resultados = TRUE;

        $sql = "SELECT COUNT(*) AS Quantidade FROM usuarios";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $num_pages = ceil($row['Quantidade']/$quantidade);
        $num_usuários = $row['Quantidade'];

        $sql = "SELECT ID, Nome, Email, Pontos FROM usuarios ORDER BY Pontos DESC LIMIT $inicio, $quantidade";
        $result = $conn->query($sql);
      
        echo "<h1>$num_usuários Usuários Cadastrados</h1>";
        if ($result->num_rows > 0) 
        {                    
            $sem_resultados = FALSE;
            
            // Dados de cada registro
            while($row = $result->fetch_assoc()) 
            {            

                $nome = $row['Nome'];
                $email = $row['Email'];
                $pontos = $row['Pontos'];
                echo "<div class = 'relatorio-noticias'>
                        <h2>$nome</h2>
                        <p>$email</p>
                        <p>$pontos pontos</p>
                        </div>";
            }

            echo "<br><br>
            <form id ='voltar' method='POST' action='relatorios.php'>
                <input class = 'voltar' type='submit' value='Voltar'>
            </form>";
            

            echo "<div><ul class = 'paginação'>";
            for($i = 1; $i < $num_pages+1; $i++)
            { 
                echo "<li><a href='ranking_completo.php?page=$i' style='text-decoration: none;'>$i</a></li>";
            }
            echo "</ul></div><br><br><br>";
            }
            if($sem_resultados)
            {
                echo "Sem Resultados.";
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
        
        </body>
        </html>
    </html>