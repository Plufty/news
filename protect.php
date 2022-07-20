<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION['id']))
    {
        echo "Você deve estar logado para acessar essa página.<p><a href=\"login.php\">Acesse sua conta</a></p>";
    }
?>