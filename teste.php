<?php 
    include('connect.inc.php');

    if ($_POST['action'] != '') {
        $action = $_POST['action'];
        $id = $_POST['ID'];
    } else if ($_GET['action'] != '') {
        $action = $_GET['action'];
        $id = $_GET['id'];
    }

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if ($action == '') {
        $sql = "INSERT INTO aluno (Nome, Matricula, Disciplina) 
                VALUES ('$nome', $matricula, '$disciplina')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo registro criado com sucesso!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else if ($action == 'update') {
        $sql = "UPDATE aluno 
                SET Nome='$nome', Matricula=$matricula, Disciplina='$disciplina' 
                WHERE ID=$id";  

        if ($conn->query($sql) === TRUE) {
            echo "Registro atualizado com sucesso!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else if ($action == 'delete') {
        $sql = "DELETE FROM aluno WHERE ID=$id";  

        if ($conn->query($sql) === TRUE) {
            echo "Registro removido com sucesso!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


    $conn->close();

    header("Location: painel.php");
    exit();

?>