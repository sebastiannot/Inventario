
<?php include 'app/componentes/header/header.php';?>
<div id='myapp'>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="">Inventario</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Productos </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" >Bodegas <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nuevoProducto.php">Añadir Producto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nuevaBodega.php">Añadir Bodega</a>
      </li>
    </ul>
    
  </div>
  </nav><div class="mx-auto" style="width: 50%;margin-top: 3%;">
<p>Lista de bodegas</p>

<!-- Modal bodega-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar bodega </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form >
        <p v-if="errors.length" class="alert alert-danger" >
            <strong>Error!</strong> el formulario tiene errores.
            <ul>
              <li v-for="error in errors">{{ error }}</li>
            </ul>
        </p>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nombre Bodega</label>
        <div class="col-lg-10">
            <input type="hidden" v-bind:value="id_bodega" v-model="id_bodega">
            <input  type="text" class="form-control"  v-model="nombre_actual">
          </select>
        </div>
      </div>

   
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button v-on:click="guardarNombreBodega(id_bodega,nombre_actual)" type="button" class="btn btn-primary">Guardar</button>
      </div>
      </form>


    </div>
  </div>
</div>

<!-- Fin modal bodega-->

<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              <tr v-for="bodega in bodegas">
                <td>{{ bodega.id_bodega }}</td>
                <td>{{ bodega.nombre }}</td>
                
                <td>
                  <div class="btn-group  btn-group-sm">
                  <button v-on:click="editarBodega(bodega.id_bodega,bodega.nombre)" data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                  <button  v-on:click="borrarBodega(bodega.id_bodega)" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </div>
              </td>
              </tr>
              </tbody>
            </table>
          </div>

          
       

</div>
</div>





<?php include 'app/componentes/footer/footer.php';?>
 