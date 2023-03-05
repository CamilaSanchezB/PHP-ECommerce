<?php
include 'functions.php';
include 'conection.php';
if(isset($_POST['enviar'])){
    if(!empty($_POST['abc'])){
        echo $_POST['abc'];
    $suma=$_POST['suma'];        
        $registros= mysqli_query($conexion, "select COUNT(IdPedido) from soaralpedidos") or
                    die("Problemas en el select:" . mysqli_error($conexion));
                    $reg = mysqli_fetch_array($registros);
        $nro = $reg[0] + 100;
        $fecha = date("Y-m-d");
        mysqli_query($conexion, "INSERT INTO soaralpedidos(IdPedido, FechaPedido, NombreCliente, ApellidoCliente, DniCliente, EmailCliente, PagoPedido, TotalPedido) values 
            ('$nro','$fecha', 'Camila','Sánchez','46557196', 'sb23camila@gmail.com', 'link', '$suma')")
            or die("Problemas en el select" . mysqli_error($conexion));
            $aux=0;
        foreach($_SESSION['items'] as $indice => $arreglo){
            foreach($arreglo as $key => $value){
                if ($key=='ID'){
                   // $_SESSION['items'][$aux]['ID'];
                    $registros= mysqli_query($conexion, "select * from soaralproductos where IdProducto='".$value."'") or
                    die("Problemas en el select:" . mysqli_error($conexion));
                    $reg = mysqli_fetch_array($registros);
                    $id= $reg['IdProducto'];
                    $nombre = $reg['NombreProducto'];
                    $cantidad = $_SESSION['items'][$aux]['Cantidad'];
                    $precio = $reg['PrecioProducto'];
                    $sub = $precio * $cantidad;
                    mysqli_query($conexion, "INSERT INTO soaraldetallepedidos(IdPedido, IdProducto, NombreProducto, CantidadProducto, PrecioProducto, SubtotalProducto) values 
                    ('$nro','$id', '$nombre','$cantidad','$precio', '$sub')")
                    or die("Problemas en el select" . mysqli_error($conexion));
                    $aux++;
                }
            }
           
        }
    }

    
    

}