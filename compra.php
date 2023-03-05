<?php
include 'functions.php';
include 'conection.php';
?>
<style>
    .t-dc{
    display: inline-block;
    padding-bottom: 0.15em;
    position: relative;
}
.t-dc::after{
    background: none repeat scroll 0 0 transparent;
    bottom: 0;
    content: "";
    display: block;
    height: 2px;
    left: 50%;
    position: absolute;
    background: #dc3545;
    transition: width 0.3s ease 0s, left 0.3s ease 0s;
    width: 0;
    width: 50%; 
    left: 0; 
}

</style>
<div class="container pt-4" style="font-family: 'Roboto', sans-serif;">
<div class="d-flex justify-content-between bd-highlight mb-3" style="font-family: 'Roboto', sans-serif;">
    <div class="p-2"><p class="text-secondary" ><em><small><a href="?p=inicio" class="text-danger">Inicio</a> / <a href="?p=tienda" class="text-danger">Tienda</a> / <a href="?p=carrito" class="text-danger">Carrito</a> / Compra</small></em></p></div>
</div>
<h1 class="display-5 mb-4 mb-md-5 ms-2">Formulario de compra</h1>
<div class="container">
    <div class="row">
    <div class="col-12 col-md-7 m-0 cards ">
        <form class="row g-3 ">
            <div class="col-md-6">
                <label for="inputNombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="inputNombre" name="nombre"required>
            </div>
            <div class="col-md-6">
                <label for="inputApellido" class="form-label">Apellido</label>
                <input type="password" class="form-control" id="inputApellido" name="apellido" required>
            </div>
            <div class="col-md-6">
                <label for="inputDni" class="form-label">DNI</label>
                <input type="number" min="10000000" class="form-control" id="inputDni" max="99999999" required name="dni">
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" required class="form-control" id="inputEmail" required>
            </div>
            <div class="col-md-4">
                <label for="inputPago" class="form-label">Método de pago</label>
                <select id="inputPago" class="form-select">
                <option selected>Mercado Pago</option>
                <option>Transferencia</option>
                <option>Efectivo</option>
                </select>
            </div>
            <div class="col-12 text-danger">
                15% de descuento pagando por transferencia o en efectivo
            </div>
            <div class='d-grid col-6 col-md-3 mx-auto'>
                <button class='btn btn-outline-success mb-4 mb-md-0' type='submit' name='enviar'>Button</button>   
            </div>
           
        </form>
    </div>
    <div class="col-12 col-md-5 m-0 cards">
        <div class="bg-dark py-2 shadow container">
        <h3 class="text-white t-dc" style="font-weight: 300;line-height: 1.2;">Su compra</h3>
        <div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
        <?php 
        $aux=0;
        foreach($_SESSION['items'] as $indice => $arreglo){
            foreach($arreglo as $key => $value){
                if ($key=='ID'){
                   // $_SESSION['items'][$aux]['ID'];
                    $registros= mysqli_query($conexion, "select * from soaralproductos where IdProducto='".$value."'") or
                    die("Problemas en el select:" . mysqli_error($conexion));
                    $reg = mysqli_fetch_array($registros);
                    $nombre = $reg['NombreProducto'];
                    $cantidad = $_SESSION['items'][$aux]['Cantidad'];
                    $precio = $reg['PrecioProducto'];
                    $sub = $precio * $cantidad;
                    echo "<tr>
                            <td><img  src='https://soaral-holistica.000webhostapp.com/assets/img/products/producto".foto($reg['FotoProducto'], $reg['IdProducto']).".webp' class='a img-fluid' alt=''></td>
                        <td>".$nombre."</td>
                        <td>".$cantidad."</td>
                        <td>".$precio."</td>
                        <td>$ ".$sub."</td>";
                    $aux++;
                }
            }
           
        }
        
        ?>
        <tr>
            <th colspan="4">Total</th>
            <th class="text-warning" colspan="1">$ <?php echo $_REQUEST['suma'];?></th>
        </tr>
            </tbody>
        </table>
        </div>
 
        </div>
        
    </div>
    </div>
</div>
</div>