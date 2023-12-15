<?php
//Incorpora el archivo externo 1 sola vez
//Si detecta un error, se detiene
require_once '../models/Vehiculo.php';

//1. Recibira peticiones (GET - POST - REQUEST)
//2. Realizara el proceso (MODELO - CLASE)
//3. Devolver un resultado (JSON)

//KEY = VALOR
//isset(): verifica si existe objeto
if(isset($_POST['operacion'])){

  //Instanciar la clase
  $vehiculo = new Vehiculo();

  if($_POST['operacion'] == 'search'){

    $respuesta = $vehiculo->search(["placa" => $_POST['placa']]);
    sleep(2);
    echo json_encode($respuesta);
  }
  //Nuevo proceso
  if($_POST['operacion'] == 'add'){
    //Almacenar los datos recibiendo de la vista en un arreglo
    $datosRecibidos = [
      "idmarca"         => $_POST["idmarca"],
      "modelo"          => $_POST["modelo"],
      "color"           => $_POST["color"],
      "tipocombustible" => $_POST["tipocombustible"],
      "peso"            => $_POST["peso"],
      "afabricacion"    => $_POST["afabricacion"],
      "placa"           => $_POST["placa"]
    ];

    //Enviamos el arreglo como parametro del metodo add
    $idobtenido=$vehiculo->add($datosRecibidos);
    echo json_encode($idobtenido);
  }
}

