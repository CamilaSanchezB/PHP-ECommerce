
<?php 
    include 'conection.php';
    include 'functions.php';
    $registros= mysqli_query($conexion, "select * from soaralproductos order by IdProducto asc") or
    die("Problemas en el select:" . mysqli_error($conexion));
?>
<div class="container pt-4" style="font-family: 'Roboto', sans-serif;">
<div class="d-flex justify-content-between bd-highlight mb-3" style="font-family: 'Roboto', sans-serif;">
    <div class="p-2"><p class="text-secondary" ><em><small><a href="?p=inicio" class="text-danger">Inicio</a> / Tienda</small></em></p></div>
    <div class="p-2"><h5><a href="?p=carrito" class="text-danger"><i class="bi bi-cart4 "></i></a></h5></div>
</div>
    <div class="row justify-content-center mt-4">
        <?php while ($reg = mysqli_fetch_array($registros)) {
            echo "<div class='col-sm-3'>
                    <div class='shop-grid-item '>
                        <div class='shop-item-thumb shadow rounded'><a href='?p=destino&id=".$reg['IdProducto']."'><img  src='https://soaral-holistica.000webhostapp.com/assets/img/products/producto".foto($reg['FotoProducto'], $reg['IdProducto']).".webp' class='a img-fluid' alt=''></a>
                            <div class='shop-item-hidden'>
                                <div class='row justify-content-center'>
                                    <div class='bg-white col-6'>
                                        <a class='btn' href='?p=destino&id=".$reg['IdProducto']."'>Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='shop-item-captions'>
                            <h6 class='shop-item-title'>".$reg['NombreProducto']."</h6><span class='shop-item-price'>AR$ ".$reg['PrecioProducto']."</span>
                        </div>
                    </div>
                   </div>";} ?>
    </div>
</div>

