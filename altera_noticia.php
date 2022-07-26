<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>News - Editar Notícia</title>
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
                    <?php
                            if(isset($_SESSION['id']))
                            {
                                echo "<li><a href='minhas_noticias.php'>Minhas Notícias</a></li>";
                            }
                    ?>
                <li><a href="sobre.php">Sobre</a></li>
            </ul>
        </div>
	</div>



	<div class = "conteudo esquerda"id="conteudo">
    <?php     
            if(isset($_SESSION['id']))
            {
                include('connect.inc.php');
                $noticia = $_POST['noticia'];
                $sql = "SELECT ID, Titulo, Texto, Imagem FROM noticias as n
                        WHERE ID = $noticia";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) 
                {                   
                    // Dados de cada registro
                    while($row = $result->fetch_assoc()) 
                    {            
          
                        $titulo = $row['Titulo'];
                        $texto = $row['Texto'];
                        $id = $row['ID'];
                        $banner = "img/".$row['Imagem'];      
                        echo "
                        <div class='um'>
                        <form class = 'formulário um' id='form1' method='POST' action='insere_dados.php' enctype='multipart/form-data'>            
                        <h2>Alterar Notícia:</h2>
                        <input type='hidden' id='noticia' name='noticia' value=$id>                        
                        <input type='hidden' id='usuario' name='usuario' value=".$_SESSION['id'].">
                        <input type='hidden' name='action' value='update'>
                        <p><b>Título da notícia<br></b> 
                                <input type='text' name='titulo' id = 'titulo' value = '$titulo'>
                            </p>
                            
                            <p><b>Texto da notícia<br></b>                     
                                <textarea class = 'insere-texto' id='texto' name='texto'>$texto</textarea>
                            </p>              
            
                            <p><b>Imagem <br></b>
                                <img src=$banner width='30%' style='border-radius:5px;'><br><br>
                                <label class='custom-file-upload'> 
                                    Upload
                                    <input type='file' name='arquivo' id = 'arquivo' value= '' >
                                </label>
                            </p>       
            
                            <div>
                                <b>&nbsp;</b><br>
                                <input type='submit' value='atualizar'>
                            </div>
                        </form>
                    </div>";
                    }
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
            </ul>
        </div>
	</div>
	</body>
	</html>
</html>