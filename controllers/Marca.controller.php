<?php

require_once '../models/Marca.php';

//1. Recibe solicitud
//2. Proceso
if(isset($_GET['operacion'])){
  $marca = new Marca();

  if($_GET['operacion'] == 'listar'){
    $resultado = $marca->getAll();
    echo json_encode($resultado);
  }
}