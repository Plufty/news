<?php 
      include('connect.inc.php');
      
      $inicio = 0;
      $quantidade = 10;
      $sem_resultados = TRUE;
      $posta_noticia= array();
      $sql = "SELECT ID_Usuario FROM noticias";
      $result = $conn->query($sql);      if ($result->num_rows > 0) 
      {
          while($row = $result->fetch_assoc()) 
          {
            array_push($posta_noticia, $row['ID_Usuario']);
          }
      } 
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
              $id = $row['ID'];
              if(in_array($id, $posta_noticia))
              {
                echo "<li>
                        <h2>$nome</h2>
                        <p>$pontos pontos</p>
                        </li>";
              }
          }
        }
        if($sem_resultados)
        {
            echo "Sem Resultados.";
        }
?>