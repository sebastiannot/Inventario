
var app = new Vue({
  el: '#myapp',
  mounted:function(){
    this.getProductos();
    this.getBodegas();
  },
  data: {
    confirmar:Boolean,
    producto_descripcion :"",
    descripcion_actual_p:"",
    nombre_actual_p:"",
    producto_nombre:"",
    descripcion_actual :"",
    nombre_actual:"",
    id_stock:"",
    id_nuevo_stock:"",
    stock_nuevo:"",
    bodega_seleccionada:"",
    stock_actual:"",
    nuevo_stock:"",
    stock_producto:"",
    nombre_bodega:"",
    errors: [],
    nombre:"",
    descripcion:"",
    id_bodega:"",
    stock:"",
    productos: [],
    bodegas:[],
    filteredItems:[],
    busqueda:"" ,

  },
  methods: {

    getProductos: function(){
      axios.get('http://localhost/inventario/app/clases/modelos/getProductos.php')
      .then(function (response) {
         app.productos = response.data;
      })
      .catch(function (error) {
         console.log(error);
      });
    },
    getBodegas: function(){
      axios.get('http://localhost/inventario/app/clases/modelos/getBodegas.php')
      .then(function (response) {
         app.bodegas = response.data;
         console.log(this.bodegas);
      })
      .catch(function (error) {
         console.log(error);
      });
    },
    guardarProducto: function(){
      if (this.nombre && this.descripcion && this.id_bodega && this.stock) {
        axios.post('http://localhost/inventario/app/clases/modelos/postProductos.php',{
          nombre: '' + this.nombre,
          descripcion: '' + this.descripcion,
          id_bodega: '' + this.id_bodega,
          stock: '' + this.stock,
        }).then(function (response) {
          if (response.status ==200) {
            alert("Guardado!");
            window.location.href = "index.php";
          }else{
            alert("Error al guardar!");
          }
        })
      }
      this.errors = [];
      if (!this.nombre) {
        this.errors.push('Nombre requerido.');
      }
      if (!this.descripcion) {
        this.errors.push('Descripcion requerido.');
      }
      if (!this.id_bodega) {
        this.errors.push('Bodega requerido.');
      }
      if (!this.stock) {
        this.errors.push('Stock requerido.');
      }
    },
    guardarBodega: function(){
      if (this.nombre_bodega) {
        axios.post('http://localhost/inventario/app/clases/modelos/postBodegas.php',{
          nombre_bodega: '' + this.nombre_bodega,
        }).then(function (response) {
          if (response.status ==200) {
            alert("Guardado!");
            window.location.href = "bodegas.php";
          }else{
            alert("Error al guardar!");
          }
        })
      }
      this.errors = [];
      if (!this.nombre_bodega) {
        this.errors.push('Nombre bodega requerido.');
      }

    },
    cambiarStock: function(id_stock,id_nuevo_stock,stock,id_bodega_seleccionada,id_producto){
      this.id_nuevo_stock = id_nuevo_stock;
      this.id_stock = id_stock;
      this.stock_actual = stock;
      this.bodega_seleccionada = id_bodega_seleccionada;     
     
    },
    guardarCambioStock:function() {
      this.bodega_seleccionada;
      this.stock_actual;
      this.id_nuevo_stock;
      console.log(this.stock_actual)
      if (this.stock_actual>=0 ) {
        axios.post('http://localhost/inventario/app/clases/modelos/postNuevoStock.php',{
          bodega_seleccionada:this.bodega_seleccionada,
          id_stock:this.id_stock,
          stock_actual: this.stock_actual,
          id_nuevo_stock: this.id_nuevo_stock
        }).then(function (response) {
          console.log(response);
          if (response.status ==200) {
            alert("Stock modificado!");
            window.location.href = "index.php";
          }else{
            alert("Error al guardar!");
          }
        })
      }else{
        alert("Stock no debe ser negativo!");

      }
      this.errors = [];
    },
    borrarProducto:function(id) {
      this.id_producto = id;
      this.confirmar = confirm("Esta seguro ?");
      console.log()
      if (this.confirmar) {
        axios.post('http://localhost/inventario/app/clases/modelos/borrarProducto.php',{
        id_producto_borrar:this.id_producto
        }).then(function (response) {
          
          if (response.status ==200) {
            alert("Producto borrado");
            window.location.href = "index.php";
          }else{
            alert("Error al borrar!");
          }
        })
      }else{
        alert("Cancelado");
      }
    },
    borrarBodega:function(id) {
      this.id_bodega = id;
      this.confirmar = confirm("Esta seguro ?");
      console.log(this.confirmar)
      if (this.confirmar) {
        axios.post('http://localhost/inventario/app/clases/modelos/borrarBodega.php',{
          id_bodega:this.id_bodega
        }).then(function (response) {
          if (response.status ==200) {
            alert("Bodega borrada");
            window.location.href = "bodegas.php";
          }else{
            alert("Error al eliminar!");
          }
        })
      }else{
        alert("Cancelado");
      }
    },
    editarBodega:function(id,nombre_actual) {
      this.nombre_actual = nombre_actual;
      this.id_bodega = id;
      console.log(this.nombre_actual);
     
    },
    guardarNombreBodega:function(id_bodega,nombre_actual) {
      if (true) {
        axios.post('http://localhost/inventario/app/clases/modelos/editarBodega.php',{
        id_bodega: this.id_bodega  ,
        nombre_nuevo:this.nombre_actual
          
        }).then(function (response) {
          if (response.status ==200) {
            alert("Bodega modificada!");
            window.location.href = "bodegas.php";
          }else{
            alert("Error al guardar!");
          }
        })
        
      }
      
    },
    modificarProducto:function (id_producto,nombre,descripcion) {
      this.id_producto = id_producto;
      this.nombre_actual_p = nombre;
      this.descripcion_actual_p =  descripcion;
    },
    guardarProductoModificado:function () {

      if (true) {
        axios.post('http://localhost/inventario/app/clases/modelos/editarProducto.php',{
          id_producto: this.id_producto  ,
          nombre_actual_p:this.nombre_actual_p,
          descripcion_actual_p:this.descripcion_actual_p
          
        }).then(function (response) {
          console.log(response)
          if (response.status ==200) {
            alert("Producto modificado!");
            window.location.href = "index.php";
            
          }else{
            alert("Error al guardar!");
          }
        })
      }
    }
  },
  computed: {
    productosFiltrados: function () {
        var self = this;
        return this.productos.filter(function (productos) {
            return productos.nombre.toLowerCase().indexOf(self.busqueda.toLowerCase()) >= 0
        });
    }
}

})

