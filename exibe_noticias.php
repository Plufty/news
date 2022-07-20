<?php 
      include('connect.inc.php');
      $page  = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
      $quantidade = 10;
      $inicio   = ($quantidade*$page)-$quantidade;
      $sem_resultados = TRUE;
      
      $sql = "SELECT COUNT(*) AS Quantidade FROM noticias";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $num_pages = ceil($row['Quantidade']/$quantidade);
      

      $sql = "SELECT ID, Titulo, Texto, Imagem  FROM noticias ORDER BY ID LIMIT $inicio, $quantidade";
      $result = $conn->query($sql);
      

      if ($result->num_rows > 0) 
      {                    
          $sem_resultados = FALSE;
          
          // Dados de cada registro
          while($row = $result->fetch_assoc()) 
          {            

              $titulo = $row['Titulo'];
              $texto = $row['Texto'];
              $id = $row['ID'];
              $banner = "img/".$row['Imagem'];
              echo "<form class = 'detalhe' id='form_detalhado' method='POST' action='detalhado.php'>
                      <div class='quadro-noticias'>
                          <input type='text' class='id_detalhe' name ='id_detalhe' value=$id style='display: none;'>
                          <h1>$titulo</h1>
                          <div class = 'banner'><img src=$banner></div>
                          <div class = 'texto'>$texto</div>
                          <div>
                            <button class='btn' id='green'><i class='fa fa-thumbs-up fa-lg' aria-hidden='true'></i></button>
                            <button class='btn' id='red'><i class='fa fa-thumbs-down fa-lg' aria-hidden='true'></i></button>
                            <input type='button' value='Fake'>
                          </div>
                      </div>
                    </form>";
          }
        

        echo "<div><ul class = 'paginação'>";
        for($i = 1; $i < $num_pages+1; $i++)
        { 
            echo "<li><a href='index.php?page=$i' style='text-decoration: none;'>$i</a></li>";
        }
        echo "</ul></div><br><br><br>";
        }
        if($sem_resultados)
        {
            echo "Sem Resultados.";
        }
      
      $conn->close();
      exit();
    ?>