
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title>News - Login</title>
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
        
        <h1>Acesse sua conta</h1>
        <?php
            include('connect.inc.php');
            if(isset($_POST['email']) || isset($_POST['nome']))
            {
                if(strlen($_POST['nome']) == 0 || strlen($_POST['email']) == 0 )
                {
                    echo "Preencha seus dados!";
                }
                else
                {
                    $nome = $conn->real_escape_string($_POST['nome']);
                    $email = $conn->real_escape_string($_POST['email']);
                    $sql = "SELECT * FROM usuarios WHERE Nome = '$nome' AND Email = '$email'";            
                    $result = $conn->query($sql) or die("Falha na execução do código SQL:" .$mysqli->error);

                    $quantidade = $result->num_rows;
                    if($quantidade == 1)
                    {
                        $usuario = $result->fetch_assoc();

                        if(!isset($_SESSION))
                        {
                            session_start();
                        }

                        $_SESSION['id'] = $usuario['ID'];                
                        $_SESSION['nome'] = $usuario['Nome'];                
                        $_SESSION['email'] = $usuario['Email'];
                        header("Location: index.php");
                    }
                    else
                    {
                        echo"Nome ou E-mail incorretos.";
                    }
                }
            }
        ?>
        <form class = "formulário um"  action="" method="POST">
            <p>
                <label>E-mail</label>
                <input type="text" name="email">
            </p>
            <p>
                <label>Senha</label>
                <input type="password" name="nome">
            </p>
            <p>
            <input type="submit" value= "Entrar"></button>
            </p>
        </form>
    
        
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