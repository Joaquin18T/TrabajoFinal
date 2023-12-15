<!doctype html>
<html lang="es">
  <head>
    <title>Buscar Empleado</title>
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
          <span class="text-light">Buscador de Nro. Documento</span>
        </div>
        <div class="card-body">
          <form action="" id="formBusqueda" autocomplete="off">
            <div class="input-group mb-3">
              <input type="text" autofocus placeholder="Escriba Nro. Documento" maxlength="8" class="form-control text-center" id="numdoc">
              <button class="btn btn-outline-secondary" type="button" id="buscar">Buscar NroDoc</button>
            </div>
            <small id="status">No hay busqueda activas</small>
              <div class="mb-3">
                <label for="sede" class="form-label">Sede:</label>
                <input type="text" id="sede" class="form-control">
              </div>
              <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" id="apellidos" class="form-control">
              </div>
              <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" id="nombres" class="form-control">
              </div>
              <!-- <div class="mb-3">
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
              </div> -->
          </form>
        </div>
      </div>
    </div>
    <a href="../views/listar-empleado.php">
      <button class="btn btn-outline-secondary" style="position: relative;left: 130px; top: 20px">Volver</button>
    </a>
    
    <script>
      document.addEventListener("DOMContentLoaded", ()=>{
        function $(id){ return document.querySelector(id)}

        function buscarNroDoc(){
          const nrodoc = $("#numdoc").value
          const parametros = new FormData()
          parametros.append("operacion", "search")
          parametros.append("nrodocumento", nrodoc)
          $("#status").innerHTML="Buscando por favor espere..."

          fetch(`../controllers/Empleado.controller.php`,{
            method: "POST",
            body: parametros
          })
            .then(respuesta=>respuesta.json())
            .then(datos=>{
              //console.log(datos)
              if(!datos){
                $("#status").innerHTML="No se encontro el registro"
                $("#formBusqueda").reset()
                $("#numdoc").focus()
              }else{
                $("#status").innerHTML="persona encontrada"
                $("#sede").value = datos.sede
                $("#apellidos").value = datos.apellidos
                $("#nombres").value = datos.nombres
              }
            })
            .catch(e=>{console.error(e)})
        }

        $("#numdoc").addEventListener("keypress", (event)=>{
          if(event.keyCode ==13){
              buscarNroDoc()
            }
        })

        $("#buscar").addEventListener("click", buscarNroDoc)
      })

      
    </script>
  </body>
</html>
