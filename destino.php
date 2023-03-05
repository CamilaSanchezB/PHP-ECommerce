<?php
  include 'conection.php';
  include 'functions.php';
  $registros= mysqli_query($conexion, "select * from soaralproductos where IdProducto='".$_GET['id']."'") or
  die("Problemas en el select:" . mysqli_error($conexion));
  $reg = mysqli_fetch_array($registros);
?>
<div class="container pt-4" style="font-family: 'Roboto', sans-serif;">
  <?php include_once('pagination.php')?>
  <div class="card mb-3 mt-4 shadow rounded-3">
    <div class="row g-0">
      <div class="col-md-7 d-flex align-items-center">
        <img src='https://soaral.000webhostapp.com/assets/photos/productos/producto<?php echo foto($reg['FotoProducto'], $reg['IdProducto']);?>.webp'class='a img-fluid' alt=''>
      </div>
      <div class="col-md-5">
        <div class="card-body ms-3 me-3 mt-3">
          <h3 class="card-title"><?php echo $reg['NombreProducto'];?></h3>
          <h4 class="card-text text-secondary"><small>AR</small>$ <?php echo $reg['PrecioProducto'];?></h4>
          <p class="card-text"><?php echo $reg['DescProducto'];?></p>
          <div class="row mb-3 justify-content-center pt-4">
            <input type="text" hidden value="<?php echo $reg['NombreProducto'];?>" id="nombre">
            <label for="CantidadProducto" class="col-sm-3 col-form-label"><b>Cantidad:</b></label>
            <div class="col-sm-5">
              <input type="number" aria-describedby="ProductHelp" class="form-control" name="CantidadProducto" id="CantidadProducto" min="1" max="<?php echo $reg['StockProducto'];?>" <?php if($reg['StockProducto']<1){echo 'disabled value="0"';} else echo"value='1'";?>>
              <div id="ProductHelp" class="form-text">Unidades disponibles: <?php echo $reg['StockProducto']?></div>
            </div>
          </div>
          <input type="number" name="stock-Producto" id="stock-Producto" value="<?php echo $reg['StockProducto']?>" hidden>
          <div class="d-grid gap-2 col-sm-6 mx-auto pt-3">
            <button class="btn btn-warning" id="boton-sub" name="AddProduct"<?php if($reg['StockProducto'] == 0){echo 'disabled';} ?> onclick="Agrega(<?php echo $reg['IdProducto'];?>, <?php echo $reg['StockProducto'];?>);" >Añadir al carrito</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
       let entrada = document.querySelector('#CantidadProducto');
       let stockEntrada  = document.querySelector('#stock-Producto');
       entrada.addEventListener('input', function () {
        console.log(entrada.value);
        if(Number(entrada.value) > Number(stockEntrada.value)){
          document.getElementById('boton-sub').classList.add('disabled');
        }else{
          document.getElementById('boton-sub').classList.remove('disabled');
        }
        });     
</script>
<script src="js/jquery.min.js"></script>
<script src="js/sweetalert.js"></script>
<script src="js/functions.js"></script>


