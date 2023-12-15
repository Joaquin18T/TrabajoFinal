<?php 

require_once '../models/Empleado.php';
?>

<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <style>

  </style>
  <body>
    <div class="container table">
      <div style="top: 20px; float:center" class="" >
        
        <a href="../views/registrar.empleado.php" style="text-decoration: none; float: center">
          <button class="btn btn-outline-success" style="width: 100px; ">Registrar</button>
        </a>
      
        <a href="../views/buscar-empleado.php" style="float: center">
          <button class="btn btn-outline-success" style="width: 100px;">Buscar</button>
        </a>
      </div>
      <div>
        <table style="position: relative; left: 100px; top: 50px">
        <thead>
          <tr>
            
            <th scope="col" width="150">Sede</th>
            <th scope="col" width="150">Apellidos</th>
            <th scope="col" width="150">Nombres</th>
            <th scope="col" width="150">Num.Doc</th>
            <th scope="col" width="150">Fecha Nac.</th>
            <th scope="col" width="150">Telefono</th>
          </tr>
          </thead>
          <?php 
            $empleado = new Empleado();
            $obtner = $empleado->getAll(PDO::FETCH_NUM);
            $mostrar = json_encode($obtner);
            foreach($obtner as $datos){
          ?>
          <tbody>
          <tr>
            <td><?php echo $datos['sede']?></td>
            <td><?php echo $datos['apellidos']?></td>
            <td><?php echo $datos['nombres']?></td>
            <td><?php echo $datos['nrodocumento']?></td>
            <td><?php echo $datos['fechanac']?></td>
            <td><?php echo $datos['telefono']?></td>
          </tr>
          </tbody>
          <?php
            }
            ?>
        </table>
      </div>
    </div>

  </body>
</html>
