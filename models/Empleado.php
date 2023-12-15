<?php

require '../models/Conexion.php';

Class Empleado extends Conexion{
  public $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function add($data = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_registrar_empleado(?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $data['idsede'],
          $data['apellidos'],
          $data['nombres'],
          $data['nrodocumento'],
          $data['fechanac'],
          $data['telefono']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function getAll(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_listar_empleado()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }


  public function search($data=[]){
    try{
      $consulta = $this->pdo->prepare("CALL spu_buscar_nrodocumento(?)");
      $consulta->execute(
        array($data['nrodocumento'])
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function group(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_empleado_graficar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}
// $empleado = new Empleado();
// $resultado = $empleado->group();

// echo json_encode($resultado);