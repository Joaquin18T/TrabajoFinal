<!doctype html>
<html lang="es">
  <head>
    <title>Buscador de vehiculos</title>
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

  <body>
  <div class="container" >
      <div class="card mt-3">
        <div class="card-header bg-secondary">
          <span class="text-light">Buscador de Vehiculos</span>
        </div>
        <div class="card-body">
          <form action="" id="formBusqueda" autocomplete="off">
            <div class="input-group mb-3">
              <input type="text" autofocus placeholder="Escriba Placa del vehiculo" maxlength="7" class="form-control text-center" id="placa">
              <button class="btn btn-outline-secondary" type="button" id="buscar">Buscar Placa</button>
            </div>
            <small id="status">No hay busqueda activas</small>
              <div class="mb-3">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" id="marca" class="form-control">
              </div>
              <div class="mb-3">
                <label for="modelo" class="form-label">Modelo:</label>
                <input type="text" id="modelo" class="form-control">
              </div>
              <div class="mb-3">
                <label for="color" class="form-label">Color:</label>
                <input type="text" id="color" class="form-control">
              </div>
              <div class="mb-3">
                <label for="tipocombustible" class="form-label">Tipo de Comb.:</label>
                <input type="text" id="tipocombustible" class="form-control">
              </div>
              <div class="mb-3">
                <label for="peso" class="form-label">Peso:</label>
                <input type="text" id="peso" class="form-control">
              </div>
              <div class="mb-3">
                <label for="afabricacion" class="form-label">Año fabricacion:</label>
                <input type="text" id="afabricacion" class="form-control">
              </div>
          </form>
        </div>
      </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
          function $(id) {return document.querySelector(id)}
          
          function buscarPlaca(){
            const placa = $("#placa").value

            if(placa!=""){
              //FormData: sirve para empaquetar datos(para POST)
              const parametros = new FormData()
              parametros.append("operacion", "search")
              parametros.append("placa", placa)
              $("#status").innerHTML="Buscando por favor espere..."

              fetch(`../controllers/Vehiculo.controller.php`,{
                method: "POST",
                body: parametros
              })
                .then(respuesta =>respuesta.json())
                .then(datos=>{
                  //console.log(datos)
                  if(!datos){
                    $("#status").innerHTML="No se encontro el registro"
                    $("#formBusqueda").reset()
                    $("#placa").focus()
                  }else{
                    $("#status").innerHTML="vehiculo encontrado"
                    $("#marca").value = datos.marca
                    $("#modelo").value = datos.modelo
                    $("#color").value=datos.color
                    $("#tipocombustible").value=datos.tipocombustible
                    $("#peso").value=datos.peso
                    $("#afabricacion").value=datos.afabricacion
                  }

                })
                .catch(e=>{console.error(e)})
            }
          }
          $("#placa").addEventListener("keypress",(event)=>{
            if(event.keyCode ==13){
              buscarPlaca()
            }
          })
          $("#buscar").addEventListener("click",buscarPlaca)

          
        })
    </script>
  </body>
</html>
