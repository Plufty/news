<?php
include('connect.inc.php');
$id = $_POST['id_usuario'];
$button = $_POST['botão'];
$noticia = $_POST['noticia'];

$fake = NULL;
$votado = NULL;

$sql = "SELECT Avalia, Fake FROM avaliacao
        WHERE ID_Usuario = $id AND ID_Noticia = $noticia";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{              
    // Dados de cada registro
    while($row = $result->fetch_assoc()) 
    {
        $votado = $row['Avalia'];
        $fake = $row['Fake'];
    }
}
else
{
    $sql = "INSERT INTO avaliacao (ID_Usuario, ID_Noticia) 
        VALUES ($id, $noticia)";
    
    if ($conn->query($sql) === TRUE) 
    {
        echo "Novo registro de Likes/Deslikes criado com sucesso!";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($button == 'like') 
{
    if (is_null($votado))//Se ainda não tiver sido votado
    {
        $votado = 1;
        $sql = "UPDATE usuarios 
                SET Pontos= Pontos+1, Countpts = $votado
                WHERE ID=$id"; 
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registro atualizado com sucesso!<br>";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
    else if ($votado == 1)//Se o usuário já tiver votado com Like
    {
        $votado = NULL;
        $sql = "UPDATE usuarios 
                SET Pontos= Pontos-1, Countpts = NULLIF('$votado', '')
                WHERE ID=$id"; 
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registro atualizado com sucesso!";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
    else if ($votado == 0)//Se o usuário já tiver votado com deslike
    {
        $votado = 1;
        $sql = "UPDATE usuarios 
                SET Pontos= Pontos+3, Countpts = $votado
                WHERE ID=$id"; 
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registro atualizado com sucesso!";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    } 


}
else if ($button == 'deslike') 
{
    
    if (is_null($votado))//Se ainda não tiver sido votado
    {
        $votado = 0; 
        $sql = "UPDATE usuarios 
                SET Pontos = Pontos-2, Countpts = $votado
                WHERE ID=$id"; 
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registro atualizado com sucesso!<br>";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
    else if ($votado == 1)//Se o usuário já tiver votado com Like
    {
        $votado = 0; 
        $sql = "UPDATE usuarios 
                SET Pontos = Pontos-3, Countpts = $votado
                WHERE ID=$id"; 
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registro atualizado com sucesso!";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
    else if ($votado == 0)//Se o usuário já tiver votado com deslike
    {
        $votado = NULL;
        $sql = "UPDATE usuarios 
                SET Pontos = Pontos+2, Countpts = NULLIF('$votado', '')
                WHERE ID=$id"; 
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registro atualizado com sucesso!";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
}
else if ($button == 'fake') 
{
    
    if (is_null($fake))//Se ainda não tiver sido votado
    {
        $fake = 1;
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
    else if ($fake == 1)//Se o usuário já tiver votado com Fake
    {
        $fake = NULL;
        $sql = "UPDATE usuarios 
                SET Pontos = Pontos+4
                WHERE ID=$id"; 
        if ($conn->query($sql) === TRUE) 
        {
            echo "Registro atualizado com sucesso!";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    
        $sql_noticia = "UPDATE noticias
                SET Fake= Fake-1
                WHERE ID=$noticia"; 
        if ($conn->query($sql_noticia) === TRUE) 
        {
            echo "Registro atualizado com sucesso!";
        } else 
        {
            echo "Error: " . $sql_noticia . "<br>" . $conn->error; 
        }
    }
}

//Aqui Atualizo o voto na tabela de avaliação
$sql = "UPDATE avaliacao 
        SET Avalia = NULLIF('$votado', ''), Fake = NULLIF('$fake', '')
        WHERE ID_Usuario = $id AND ID_Noticia = $noticia"; 
if ($conn->query($sql) === TRUE) 
{
    echo "Registro atualizado com sucesso!";
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error; 
}

$conn->close();
    
header("Location:noticia.php?noticia=$noticia");

exit(); 




?>