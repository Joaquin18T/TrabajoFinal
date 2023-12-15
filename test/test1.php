<?php

//Variables
$apellidos = "Torres Condo";
$nombres = "Jose Joaquin";

//constante
define("DNI", "74840779");

//echo $apellidos . " " . $nombres . " " . DNI;

//Arreglo (1) unidimensional
$amigos = array("Karina", "Melissa", "Vania", "Emily", "Sheyla");
$paises = ["Peru", "Argentina", "Venezuela", "Brasil"];
//Funcion que imprime tres cosas: Tipo, Longitud, Dato (Debug (pruebas))
//var_dump($amigos);

// foreach($paises as $pais){
//   echo $pais . " ";
// }

//Arreglo (2) Multi-dimensional
$softwares = [
  ["Eset", "Avast", "Windows Defender", "Avira", "Karspersky"],
  ["Warzone", "GOW", "FreeFire", "Pepsiman", "MarioBross"],
  ["VSCODE", "NetBeans", "Android", "Pseint"]
];

foreach($softwares as $lista){
  foreach($lista as $software){
    //echo $software ." ";
  }
}

// echo $software[0][3]. "<br>";
// echo $software[2][0]. "<br>";
// echo $software[2][2]. "<br>";
// echo $software[1][0]. "<br>";


//PHP, JS (Asociativo), Java(Mapas), C#(Listas), Python(Diccionario)
//Arreglo (3) Asociativo (sin indice)
$catalogo = [
  "so"          =>  "Window 10",
  "antivirus"   =>  "Panda",
  "utilitario"  =>  "WinRar",
  "videojuego"  =>  "MarioBross"
];

//echo $catalogo["utilitario"];

//Arreglo (4) Multidimensional + Asociativo (con/sin indice)
$desarrollador = [
  "datospersonales" => [
    "apellidos" => "Torres Condo",
    "nombres"   => "Jose Joaquin",
    "edad"      => 18,
    "telefono"  => ["933958993", "998762804"]
  ],
  "formacion"       => [
    "inicial"      => ["Virgen Maria"],
    "primaria"     => ["Miguel Grau"],
    "secundaria"   => ["Ciro Alegria", "Maranguita School"]
  ],
  "habilidades"     => [
    "bd"          => ["MySQL", "MSSQL", "MongoDB"],
    "frameworks"  => ["Laravel", "CodeIgniter", "Hibernite", "Zend"]
  ]
];

// echo "<pre>";
// var_dump($desarrollador);
// echo "</pre>";

echo json_encode($desarrollador);