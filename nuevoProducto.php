
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
      <li class="nav-item">
        <a class="nav-link" href="bodegas.php">Bodegas </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" >Añadir Producto <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="nuevaBodega.php">Añadir Bodega</a>
      </li>
    </ul>
   
  </div>
  </nav><div class="mx-auto" style="width: 50%;margin-top: 3%;">
<p>Ingresar nuevo producto</p>

<form >
<p v-if="errors.length" class="alert alert-danger" >
    <strong>Error!</strong> el formulario tiene errores.
    <ul>
      <li v-for="error in errors">{{ error }}</li>
    </ul>
</p>


  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  v-model="nombre">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Descripción</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  v-model="descripcion">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Bodega</label>
    <div class="col-lg-10">
        <select :required="true" v-model="id_bodega" class="custom-select mr-sm-2"> 
        <option selected disabled>Seleccione Bodega</option>
            <option v-for="bodega in bodegas" v-bind:value="bodega.id_bodega" >{{ bodega.nombre }}</option>
        </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Stock inicial</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" v-model="stock">
    </div>
  </div>

  <button class="btn btn-primary" v-on:click.stop.prevent="guardarProducto" >Ingresar Producto</button>
  <button class="btn btn-danger" >Cancelar</button>
</form>
             
          
       

</div>
</div>





<?php include 'app/componentes/footer/footer.php';?>
 