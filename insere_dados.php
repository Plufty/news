<?php 
include('connect.inc.php');

$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$usuario = $_POST['usuario'];
$action = $_POST['action'];
$id = $_POST['noticia'];



if(isset($_FILES['arquivo']))
{
    $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));//pegando a extensão
    if($extensao == "jpeg")
    {
        $extensao = ".jpeg";
    }
    $arquivo = md5(time()).$extensao;//definindo um titulo do arquivo para ele n vir duplicado
    $diretorio = "img/";//diretório que vai armazenar o arquivo
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$arquivo);//upload do arquivo
}


//testar se os dados vieram preenchidos corretamente.
if($titulo == "" || $texto == "")
{
    echo "Dados obrigatórios em branco, nada será cadastrado";
    $conn->close();
    header("Location: index.php");    
    exit();
}

else
{    
    $existe_noticias = FALSE;

    $consulta_noticias = "SELECT Titulo, Imagem FROM noticias 
                        WHERE Titulo LIKE '$titulo'";
    $result = $conn->query($consulta_noticias);
    while($row = $result->fetch_assoc()) 
    {
        if ($result->num_rows > 0) 
        {
            $existe_noticias = TRUE;
            break;
        }
    }
    
    if(!$existe_noticias)
    {
        $sql = "INSERT INTO noticias (Titulo, Texto, Imagem, ID_Usuario, Fake) 
            VALUES ('$titulo', '$texto', '$arquivo', '$usuario', 0)";
        
        if ($conn->query($sql) === TRUE) {
            echo "Novo registro de noticias criado com sucesso!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else
    {
        if($action == 'update' && $_FILES['arquivo']['name'] == "")
        {
            $sql = "UPDATE noticias 
                SET Titulo='$titulo', Texto='$texto'
                WHERE ID=$id";  

            if ($conn->query($sql) === TRUE) 
            {
                echo "Registro atualizado com sucesso!";
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

        }
        else if($action == 'update' && isset($_FILES['arquivo']))
        {
            $sql = "UPDATE noticias 
                SET Titulo='$titulo', Texto='$texto', Imagem = '$arquivo' 
                WHERE ID=$id";  

            if ($conn->query($sql) === TRUE) 
            {
                echo "Registro atualizado com sucesso!";
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else
        {
            echo "<br>Notícia já existente.";

        }
    }    
    $conn->close();

    
    header("Location:index.php");

    exit();   

}
