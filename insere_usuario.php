<?php 
include('connect.inc.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$action = $_POST['action'];
$pontos = 0; //estático pra teste
$id;


//testar se os dados vieram preenchidos corretamente.
if($action != "update" && ($nome == "" || $email == "" || $senha == ""))
{
    echo "Dados obrigatórios em branco, nada será cadastrado";
    $conn->close();
    header("Location: index.php");    
    exit();
}

else
{    
    $existe_usuarios = FALSE;

    $consulta_usuarios = "SELECT ID, Email FROM usuarios 
                        WHERE Email LIKE '$email'";
    $result = $conn->query($consulta_usuarios);
    while($row = $result->fetch_assoc()) 
    {
        if ($result->num_rows > 0) 
        {
            $existe_usuarios = TRUE;                        
            $id = $row['ID'];
            break;
        }
    }
    
    if(!$existe_usuarios)
    {
        $sql = "INSERT INTO usuarios (Senha, Nome, Email, Pontos) 
            VALUES ('$senha', '$nome', '$email', $pontos)";
        
        if ($conn->query($sql) === TRUE) {
            echo "Novo registro de usuarios criado com sucesso!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else
    {
        if($action == 'update')
        {
            $sql;//Declarando antes para ter ficar no escopo da validação
            if($senha == "")
            {
                $sql = "UPDATE usuarios 
                    SET Nome='$nome', Email='$email' 
                    WHERE ID=$id"; 
            }
            else
            {
                $sql = "UPDATE usuarios 
                    SET Nome='$nome', Email='$email', Senha='$senha' 
                    WHERE ID=$id"; 
            } 

            if ($conn->query($sql) === TRUE) 
            {
                echo "Registro atualizado com sucesso!";                
                include('logout.php');
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else
        {            
            echo "<br>Usuário já existente.";
        }
    }    
    $conn->close();

    
    header("Location:index.php");

    exit();   

}
