
<?php include 'app/componentes/header/header.php';?>
<div id='myapp'>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="">Inventario</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link">Productos <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="bodegas.php">Bodegas </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nuevoProducto.php">Añadir Producto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nuevaBodega.php">Añadir Bodega</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input  v-model="busqueda" class="form-control mr-sm-2" type="search" placeholder="Producto/Bodega" aria-label="Buscar">
      <button v-on:click.stop.prevent="" class="btn btn-outline-success my-2 my-sm-0" >Buscar</button>
    </form>
  </div>
</nav><div class="mx-auto" style="width: 50%;margin-top: 3%;">
<p>Lista de productos</p>

<!-- Modal stock-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar stock producto </h5>
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
        <label class="col-sm-2 col-form-label">Bodega</label>
        <div class="col-lg-10">
          <select v-model="bodega_seleccionada"  class="custom-select mr-sm-2">
            <option v-for="bodega in bodegas" :value="bodega.id_bodega" >{{bodega.nombre}}</option>
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Stock</label>
        <div class="col-sm-4">
          <input  type="number" class="form-control" v-bind:value="stock_actual" v-model="stock_actual">
        </div>
      </div>
      
      </div>
      <div class="modal-footer">
        <input type="hidden" v-bind:value="id_stock" v-model="id_stock">
        <input type="hidden" v-bind:value="id_nuevo_stock" v-model="id_nuevo_stock">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button v-on:click="guardarCambioStock()" type="button" class="btn btn-primary">Guardar</button>
      </div>
      </form>


    </div>
  </div>
</div>

<!-- Fin modal stock-->


<!-- Modal editar-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditar">Modificar producto </h5>
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
        <label class="col-sm-2 col-form-label">Nombre </label>
        <div class="col-lg-10">
        <input type="text" class="form-control"  v-model="nombre_actual_p">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Descripción </label>
        <div class="col-sm-10">
          <input type="text" class="form-control"  v-model="descripcion_actual_p">
        </div>
      </div>
      


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button v-on:click="guardarProductoModificado()" type="button" class="btn btn-primary">Guardar</button>
      </div>
      </form>


    </div>
  </div>
</div>

<!-- Fin modal editar-->


<div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Stock</th>
                  <th>Bodega</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              <tr v-for="producto in productosFiltrados">
                <td >{{ producto.id_producto }}</td>
                <td >{{ producto.nombre }}</td>
                <td>{{ producto.descripcion }}</td>
                <td>{{ producto.stock }}</td>
                <td>{{ producto.nombre_bodega }}</td>
                <td>
                  <div class="btn-group  btn-group-sm">
                  <button  v-on:click="cambiarStock(producto.id_stock,producto.id_producto,producto.stock,producto.id_bodega)" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></button>
                  <button  v-on:click="modificarProducto(producto.id_producto,producto.nombre,producto.descripcion)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar"><i class="fas fa-edit"></i></button>
                  <button v-on:click="borrarProducto(producto.id_producto)" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </div>
              </td>
              </tr>
              </tbody>
            </table>
          </div>

          
       

</div>
</div>





<?php include 'app/componentes/footer/footer.php';?>
 