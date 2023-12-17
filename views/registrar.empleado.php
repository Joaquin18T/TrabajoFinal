<!doctype html>
<html lang="es">
  <head>
    <title>Registrar Empleados</title>
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
      <div class="alert alert-info mt-3">
          <h5>Registro de empleados</h5>
          <span class="text-dark">Complete la informacion solicitada</span>
        <div class="card-body">
          <form action="" id="formEmpleado" autocomplete="off">
              <div class="mb-3">
                <label for="sede" class="form-label">Sede:</label>
                <select  name="sede" id="sede" class="form-select" required>
                    <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" id="apellidos" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" id="nombres" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="fechanac" class="form-label">Fecha Nac.:</label>
                <input type="text" id="fechanac" placeholder="yy-mm-dd" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="text" id="telefono"  min="0" maxlength="9" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="numdoc" class="form-label">Num.Doc:</label>
                <input type="text" id="numdoc" min="0" maxlength="8" class="form-control" required>
              </div>
              <div class="mb-3 text-end">
                <a href="../views/listar-empleado.php" style="text-decoration: none;">
                  <button type="button" class="btn btn-secondary" style="width: 100px;">Volver</button>
                </a>
                <button class="btn btn-primary" id="guardar" type="submit">Guardar datos</button>
                <button class="btn btn-secondary"  type="rest">Cancelar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", ()=>{
            function $(id) {return document.querySelector(id)}
            (function(){
                fetch(`../controllers/Sede.controller.php?operacion=listar`)
                    .then(respuesta=>respuesta.json())
                    .then(datos=>{
                        //console.log(datos);
                        datos.forEach(element => {
                            const tagOption = document.createElement("option")
                            tagOption.value = element.idsede
                            tagOption.innerHTML = element.sede
                            $("#sede").appendChild(tagOption)
                        });
                    })
                    .catch(e=>{console.error(e)})
            })()

            function alertar(mensaje, nSegundos = 1){
              Swal.fire({
                icon: 'info',
                title: 'Empleado',
                text: mensaje,
                showConfirmButton: false,
                timer: (nSegundos*1000),
                timerProgressBar: true,
                toast: true,
                position: 'top-end'
              })
            }

            $("#formEmpleado").addEventListener("submit", (event)=>{
                event.preventDefault();

                if(confirm("¿Seguro deseas registrar al empleado?")){

                    const parametros = new FormData()

                    parametros.append("operacion", "add")
                    parametros.append("idsede",       $("#sede").value)
                    parametros.append("apellidos",    $("#apellidos").value)
                    parametros.append("nombres",      $("#nombres").value)
                    parametros.append("fechanac",     $("#fechanac").value)
                    parametros.append("telefono",     $("#telefono").value)
                    parametros.append("nrodocumento", $("#numdoc").value)
                    $("#formEmpleado").reset()
                    fetch(`../controllers/Empleado.controller.php`,{
                        method: "POST",
                        body: parametros
                    })
                      .then(respuesta=>respuesta.json())
                      .then(datos => { 
                        if(datos.idempleado>0){alertar("Registrado",2)}
                         
                      })
                      .catch(e=>{console.error(e)})
                }
            })
        })
    </script>
  </body>
</html>
