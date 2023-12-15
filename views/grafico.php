<?php
require_once '../models/Empleado.php';
require_once '../models/Conexion.php';

$cnx = new Conexion();
$cnx = $cnx->getConexion();
$empleado = new Empleado();

$result = $cnx->query("SELECT DISTINCT SED.sede, COUNT(EMP.idsede) TOTAL FROM empleados EMP
INNER JOIN sedes SED ON SED.idsede=EMP.idsede
GROUP BY SED.sede");
$data = array();

while($row = $result->fetch()){
  $data[] = $row[1];


}


echo '<canvas id="myChart"></canvas>';
echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
echo '<script>';
echo 'var ctx = document.getElementById("myChart").getContext("2d");';
echo 'var myChart = new Chart(ctx, {';
echo 'type: "bar",';
echo 'data: {';
echo 'labels: ["Ayacucho", "Lima", "Pisco"],';
echo 'datasets: [{';
echo 'label: "Dataset",';
echo 'data: ' . json_encode($data) . ',';
echo 'backgroundColor: [';
echo '"rgba(255, 99, 132, 0.2)",';
echo '"rgba(54, 162, 235, 0.2)",';
echo '"rgba(255, 206, 86, 0.2)"';
echo '],';
echo 'borderColor: [';
echo '"rgba(255, 99, 132, 1)",';
echo '"rgba(54, 162, 235, 1)",';
echo '"rgba(255, 206, 86, 1)"';
echo '],';
echo 'borderWidth: 1';
echo '}]';
echo '},';
echo 'options: {';
echo 'scales: {';
echo 'yAxes: [{';
echo 'ticks: {';
echo 'beginAtZero: true';
echo '}';
echo '}]';
echo '}';
echo '}';
echo '});';
echo '</script>';
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
        <script src="js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
  </script>
    </head>

    <body>

    </body>
</html>
