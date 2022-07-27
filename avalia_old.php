<?php
include('connect.inc.php');
$id = $_POST['id_usuario'];
$button = $_POST['botão'];
$noticia = $_POST['noticia'];
$avaliacao = $_POST['avaliacao'];

if ($button == 'like') 
{
    $sql = "UPDATE usuarios 
            SET Pontos= Pontos+1, Countpts = 1
            WHERE ID=$id"; 
    if ($conn->query($sql) === TRUE) 
    {
        echo "Registro atualizado com sucesso!";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }
}
else if ($button == 'deslike') 
{
    $sql = "UPDATE usuarios 
            SET Pontos = Pontos-2, Countpts = 0
            WHERE ID=$id"; 
    if ($conn->query($sql) === TRUE) 
    {
        echo "Registro atualizado com sucesso!";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }
}
else if ($button == 'fake') 
{
    $sql = "UPDATE usuarios 
            SET Pontos = Pontos-4
            WHERE ID=$id"; 
    if ($conn->query($sql) === TRUE) 
    {
        echo "Registro atualizado com sucesso!";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }

    $sql_noticia = "UPDATE noticias
            SET Fake= Fake+1
            WHERE ID=$noticia"; 
    if ($conn->query($sql_noticia) === TRUE) 
    {
        echo "Registro atualizado com sucesso!";
    } else 
    {
        echo "Error: " . $sql_noticia . "<br>" . $conn->error; 
    }
}

$conn->close();
    
header("Location:noticia.php?noticia=$noticia");

exit(); 




?>