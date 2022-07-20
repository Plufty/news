<?php 
      include('connect.inc.php');
      
      $inicio = 0;
      $quantidade = 10;

      $sql = "SELECT ID, Nome, Email, Pontos FROM usuarios ORDER BY Pontos DESC LIMIT $inicio, $quantidade";
      $result = $conn->query($sql);
      

      if ($result->num_rows > 0) 
      {                    
          $sem_resultados = FALSE;
          
          // Dados de cada registro
          while($row = $result->fetch_assoc()) 
          {            

              $nome = $row['Nome'];
              $email = $row['Email'];
              $pontos = $row['Pontos'];
              echo "<li>
                    <h2>$nome</h2>
                    <p>$pontos pontos</p>
                    </li>";
          }
        }
        if($sem_resultados)
        {
            echo "Sem Resultados.";
        }
?>