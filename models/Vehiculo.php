<?php
//1. Acceso al archivo
require 'Conexion.php';

//2. Heredar sus atributos y metodos
class Vehiculo extends Conexion{

  //Este metodo almacenara la conexion y se la facilitara a todos los metodos
  private $pdo;
  
  //3.Almacenar la conexion en el objeto
  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  //$data es un arreglo  asociativo que contiene los valores
  //requerido por el SPU para registro vehiculos
  public function add($data = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_vehiculos_registrar(?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $data['idmarca'],
          $data['modelo'],
          $data['color'],
          $data['tipocombustible'],
          $data['peso'],
          $data['afabricacion'],
          $data['placa']
        )
      );
      //Actualizacion, ahora retornamos el "idvehiculo"
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
  public function search($data=[]){
    try{
      //EL SPU requiere el numero de placa
      $consulta = $this->pdo->prepare("CALL spu_vehiculos_buscar(?)");
      $consulta->execute(
        array($data['placa'])
      );

      //Devolver el registro encontrado
      //fetch       : retorna la primera coincidencia (1)
      //fetchAll    : retorna todas las coincidencia  (n)
      //FETCH_ASSOC : define el resultado como un objeto
      //FETCH_NUM   : devuelve los atributos
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  // public function add($data=[]){

  // }

  // public function getAll(){

  // }
}

//Prueba - Borrar
// $vehiculo = new Vehiculo();
// $registro = $vehiculo->search(["placa" => "ABC-112"]);
//print(json_encode($registro));