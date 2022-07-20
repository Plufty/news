<?php 
include('connect.inc.php');

$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$usuario = $_POST['usuario'];


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

    $consulta_noticias = "SELECT titulo FROM noticias 
                        WHERE titulo LIKE '%$titulo%'";
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
        echo "<br>Notícia já existente.";
    }    
    $conn->close();

    
    header("Location:index.php");

    exit();   

}
