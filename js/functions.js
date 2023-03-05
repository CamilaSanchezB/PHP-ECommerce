function Agrega(id, stock){
    AgregaCompleto(id, document.getElementById('CantidadProducto').value, stock, document.getElementById('nombre').value);
  }
  function AgregaCompleto(ProductID, ProductQ, ProductS, ProductN){
    $.ajax({
    type: 'GET',
    url: 'functions.php',
    data: {FlagAdd: 1, ProductAgrega: ProductID, QuantityAgrega: ProductQ, StockAgrega: ProductS},
    success: function() {
      swal("Se añadió correctamente", ProductQ+" "+ProductN,"success");
    }, 
    error: function(){
      swal("No se pudo añadir el producto", "Intenta más tarde o comunicate con nosotras","error");
    }
});
   }
function Limpiar(){
    $.ajax({
    type: 'GET',
    url: 'functions.php',
    data: {funcion: "CarritoOut"},
    dataType: "json",
    success: function() {
        window.location.href = '?p=carrito';
    }
});
   }
function LimpiarIndividual(id){
    $.ajax({
    type: 'GET',
    url: 'functions.php',
    data: {item: id},
    dataType: "json",
    success: function() {
        window.location.href = '?p=carrito';
    }

});
   
   }