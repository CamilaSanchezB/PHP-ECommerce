<?php
include 'functions.php';
include 'conection.php';
$div1="<div class='container pt-4' style='font-family: 'Roboto', sans-serif;'>";
?>

<div class="container pt-4" style="font-family: 'Roboto', sans-serif;">
<div class="d-flex justify-content-between bd-highlight mb-3" style="font-family: 'Roboto', sans-serif;">
    <div class="p-2"><p class="text-secondary" ><em><small><a href="?p=inicio" class="text-danger">Inicio</a> / <a href="?p=tienda" class="text-danger">Tienda</a> / Carrito</small></em></p></div>
    <div class="p-2"><h6><a href="" class="link-dc" onclick="Limpiar();">Vaciar carrito</a></h6></div>
</div>
<?php
if (isset($_SESSION['items']) && !empty($_SESSION['items'])){
    $tabla="<div class='table-responsive'>
    <table class='table table-striped|sm|bordered|hover|inverse table-inverse table-responsive'>
    <thead class='thead-inverse|thead-default'>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio por unidad</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        </thead>
        <tbody>";
   echo $tabla;
    $suma=0;
    $aux=0;
    $prods=array();
    foreach($_SESSION['items'] as $indice => $arreglo){
        //var_dump($_SESSION['items'][0]['ID']);
        foreach($arreglo as $key => $value){
            if ($key=='ID'){
               // $abc.=$_SESSION['items'][$aux]['ID'];
                $registros= mysqli_query($conexion, "select * from soaralproductos where IdProducto='".$value."'") or
                die("Problemas en el select:" . mysqli_error($conexion));
                $reg = mysqli_fetch_array($registros);
                $prods_aux="<tr>
                <td scope='row'><img style='max-width: 200px;' src='https://soaral.000webhostapp.com/assets/photos/productos/producto".foto($reg['FotoProducto'], $reg['IdProducto']).".webp' class='img-fluid' alt=''></td>
                <td>".$reg['NombreProducto']."</td>
                <td>".$_SESSION['items'][$aux]['Cantidad']."</td>
                <td>AR$ ".$reg['PrecioProducto']."</td>
                <td>AR$ ".$reg['PrecioProducto']*$_SESSION['items'][$aux]['Cantidad']."</td>";
                echo $prods_aux."<td><a href='' onclick='LimpiarIndividual(".$reg['IdProducto'].");' class='text-danger'> <i class='bi bi-trash fs-5'></i> </a></td>
                </tr>";
                $prods_aux.="</tr>";
                array_push($prods, $prods_aux);
                $suma+=$reg['PrecioProducto']*$_SESSION['items'][$aux]['Cantidad'];
                $aux++;
            }
        }
    }
    $tabla2="<tr>
    <th class='text-end' colspan='4'>Total:</th>
    <th class='text-success' colspan='2'>AR$". $suma."</th>
</tr>";

echo $tabla2."<tr>
<td colspan='6'>
<form method='post' action='?p=compra'>

    <div class='d-grid col-3 mx-auto'>
        <button class='btn btn-outline-danger' type='submit' name='enviar'>Button</button>   
    </div>
 
</td>
</tr>
</tbody>
</table>
</div>"; 


$tabla2.="</tbody>
</table>
</div>";
$abc = "<html><head>";
$abc.="<meta charset='UTF-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1.0'>
<link rel='stylesheet' href='css/bootstrap.min.css'>
<link rel='stylesheet' href='css/bootstrap-grid.min.css'>
<link rel='stylesheet' href='css/bootstrap-reboot.min.css'>
<link rel='stylesheet' href='css/bootstrap-utilities.min.css'>
<link rel='stylesheet' href='css/style.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
<link rel='preconnect' href='https://fonts.googleapis.com'>
<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
<link href='https://fonts.googleapis.com/css2?family=Dr+Sugiyama&display=swap' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css2?family=Dr+Sugiyama&family=Roboto:ital,wght@0,100;0,300;0,400;1,300;1,400&display=swap' rel='stylesheet'>    <!--
    font-family: 'Dr Sugiyama', cursive;
    font-family: 'Roboto', sans-serif;
-->";
$abc.="</head><body><h1 class='text-center mt-5'>Gracias por tu compra</h1>".$div1;
$abc.= $tabla;
for($i=0; $i<sizeof($prods); $i++){
$abc.= $prods[$i];
}
$abc.=$tabla2;
$abc.="</body></html>";
    echo "<textarea name='abc' id='abc' cols='30' rows='10' hidden>".$abc."</textarea>
    <input type='number' name='suma' id='' value='".$suma."' hidden>
    </form>";

}
else {?>
    <div class="align-middle pt-5 text-center">
    <h1>El Carrito está vacío</h1>
    <p class="lead">Recorré la <a href="?p=tienda" class=""><em>tienda</em></a> y agregá productos</p>
    <img src="carrito-de-compras.gif" alt="" class="img-fluid rounded mx-auto d-block" style="max-width: 200px;">
    </div>
    <?php }
   // include 'prueba.php';
?>

</div>
<script src="js/jquery.min.js"></script>
<script src="js/functions.js"></script>


