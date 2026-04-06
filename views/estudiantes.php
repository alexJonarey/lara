
<html>

<body>

<div class="container mt-4">

<h1>Sistema de Gestión de Estudiantes</h1>

<!-- BOTONES -->
<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInsertar">
    Insertar
</button>
<button class="btn btn-secondary" id="btnEditar">Editar</button>
<button class="btn btn-danger" id="btnEliminar">Eliminar</button>
   <input type="text" id="txtcedula1" name="txtcedula1">
<button class="btn btn-danger" id="btnbuscar">buscar</button>

<br><br>

<!-- TABLA -->
<div id="resultado"></div>

<!-- FORM ORIGINAL (OCULTO) -->
<form id="FormGuardar" style="display:none;">
    <input type="text" id="txtcedula" name="txtcedula">
    <input type="text" id="txtnombre" name="txtnombre">
    <input type="text" id="txtapellido" name="txtapellido">
    <input type="text" id="txttelefono" name="txttelefono">
    <input type="text" id="txtdirecion" name="txtdirecion">
</form>

</div>

<!-- 🔵 MODAL INSERTAR -->
<div class="modal fade" id="modalInsertar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5>Insertar Estudiante</h5></div>
      <div class="modal-body">

        <input id="i_cedula" class="form-control mb-2" placeholder="Cedula" >
        <input id="i_nombre" class="form-control mb-2" placeholder="Nombre">
        <input id="i_apellido" class="form-control mb-2" placeholder="Apellido">
        <input id="i_telefono" class="form-control mb-2" placeholder="Telefono">
        <input id="i_direccion" class="form-control mb-2" placeholder="Direccion">

      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-success" id="guardarInsert">Guardar</button>
         <button class="btn btn-success" id="cancelarInsert">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- 🔴 MODAL ELIMINAR -->
<div class="modal fade" id="modalEliminar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">¿Seguro que deseas eliminar el estudiante?</div>
      <div class="modal-footer">
        <button class="btn btn-outline-success" id="confirmEliminar">Aceptar</button>
         <button class="btn btn-success" id="confirnoeliminar">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- 🟡 MODAL EDITAR -->
<div class="modal fade" id="modalEditar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5>Editar Estudiante</h5></div>
      <div class="modal-body">

        <label>Cédula</label>
        <input id="e_cedula" class="form-control mb-2" readonly>

        <label>Nombre</label>
        <input id="e_nombre" class="form-control mb-2">

        <label>Apellido</label>
        <input id="e_apellido" class="form-control mb-2">

        <label>Teléfono</label>
        <input id="e_telefono" class="form-control mb-2">

        <label>Dirección</label>
        <input id="e_direccion" class="form-control mb-2">

      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-success" id="guardarEdit">Actualizar</button>
        <button class="btn btn-success" id="CancelarEdit">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>

const apiUrl='http://localhost/soa/Controllers/api.php';
let seleccionado = null;

// 🔥 LISTAR AUTOMÁTICO (SIN BOTÓN)
$(document).ready(function(){
    listar();
});

function listar(){
    $.ajax({
        url: apiUrl,
        type: 'GET',
        success: function(response) {

            let data = (typeof response === "string") ? JSON.parse(response) : response;

            let tabla = `
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            data.forEach(estudiante => {
                tabla += `
                    <tr>
                        <td>${estudiante.cedula}</td>
                        <td>${estudiante.nombre}</td>
                        <td>${estudiante.apellido}</td>
                        <td>${estudiante.telefono}</td>
                        <td>${estudiante.direccion}</td>
                    </tr>
                `;
            });

            tabla += `</tbody></table>`;

            $('#resultado').html(tabla);
        }
    });
}
function listarestudiante(){
    $.ajax({
        url: apiUrl,
        type: 'POST',
        data: {
            accion: "buscar", 
            txtcedula: $("#txtcedula1").val()
        },
        success: function(response) {

            let data = (typeof response === "string") ? JSON.parse(response) : response;

            let tabla = `
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            data.forEach(estudiante => {
                tabla += `
                    <tr>
                        <td>${estudiante.cedula}</td>
                        <td>${estudiante.nombre}</td>
                        <td>${estudiante.apellido}</td>
                        <td>${estudiante.telefono}</td>
                        <td>${estudiante.direccion}</td>
                    </tr>
                `;
            });

            tabla += `</tbody></table>`;
            $('#resultado').html(tabla);
        }
    });
}
$("#btnbuscar").click(function(){

listarestudiante();
});


// 🔥 SELECCIONAR FILA
$(document).on("click","#resultado table tbody tr", function(){
    $("#resultado tr").removeClass("table-primary");
    $(this).addClass("table-primary");

    let c = $(this).children("td");

    seleccionado = {
        cedula: c.eq(0).text(),
        nombre: c.eq(1).text(),
        apellido: c.eq(2).text(),
        telefono: c.eq(3).text(),
        direccion: c.eq(4).text()
    };
});

// 🔵 INSERTAR
$("#guardarInsert").click(function(){

    $("#txtcedula").val($("#i_cedula").val());
    $("#txtnombre").val($("#i_nombre").val());
    $("#txtapellido").val($("#i_apellido").val());
    $("#txttelefono").val($("#i_telefono").val());
    $("#txtdirecion").val($("#i_direccion").val());

    $.ajax({
        url: apiUrl,
        type: 'POST',
        
        data: $("#FormGuardar").serialize(),
        success: function(response){
             alert(response);
            $("#modalInsertar").modal("hide");
            listar();
        }
    });
});
//cancelarInsert
$("#cancelarInsert").click(function(){

    $("#modalInsertar").modal("hide");
});
// 🔴 ELIMINAR
$("#btnEliminar").click(function(){
    if(!seleccionado){
        alert("Selecciona una fila");
        return;
    }
    $("#modalEliminar").modal("show");
});

$("#confirmEliminar").click(function(){

    $("#txtcedula").val(seleccionado.cedula);

    $.ajax({
        url: apiUrl+"?txtcedula="+seleccionado.cedula,
        type: 'DELETE',
        success: function(response){
               alert(response); // 👈 YA VIENE DEL API

            $("#modalEliminar").modal("hide");
            listar();
        }
    });
});
$("#confirnoeliminar").click(function(){

    $("#modalEliminar").modal("hide");
});

// 🟡 EDITAR
$("#btnEditar").click(function(){
    if(!seleccionado){
        alert("Selecciona una fila");
        return;
    }

    $("#e_cedula").val(seleccionado.cedula);
    $("#e_nombre").val(seleccionado.nombre);
    $("#e_apellido").val(seleccionado.apellido);
    $("#e_telefono").val(seleccionado.telefono);
    $("#e_direccion").val(seleccionado.direccion);

    $("#modalEditar").modal("show");
});

$("#guardarEdit").click(function(){

    $("#txtcedula").val($("#e_cedula").val());
    $("#txtnombre").val($("#e_nombre").val());
    $("#txtapellido").val($("#e_apellido").val());
    $("#txttelefono").val($("#e_telefono").val());
    $("#txtdirecion").val($("#e_direccion").val());

    $.ajax({
        url: apiUrl +
        "?txtcedula="+$("#e_cedula").val()+
        "&txtnombre="+$("#e_nombre").val()+
        "&txtapellido="+$("#e_apellido").val()+
        "&txttelefono="+$("#e_telefono").val()+
        "&txtdirecion="+$("#e_direccion").val(),
        type: 'PUT',
        success: function(response){
            alert(response); 
            $("#modalEditar").modal("hide");
            
            listar();
        }
    });
});
//CancelarEdit
$("#CancelarEdit").click(function(){
 $("#modalEditar").modal("hide");
});

</script>

</body>
</html>