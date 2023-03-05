<?php
session_start();

if(isset($_GET['funcion']) && !empty($_GET['funcion'])) {
    CarritoOut();
}
if (isset($_REQUEST['item']) && !empty($_REQUEST['item'])){
    $flag=false;
    $aa=0;
    foreach($_SESSION['items'] as $indice => $arreglo){
        foreach($arreglo as $key => $value){
            if ($key=='ID'){
                if($value==$_REQUEST['item']){
                    $flag=true;
                    $aa=$indice;
                }
            }
        }
    }
    if($flag == true){
        \array_splice($_SESSION['items'], $aa, 1);
    }
}
if(isset($_REQUEST['FlagAdd']) && !empty($_REQUEST['FlagAdd'])){
    $producto=$_REQUEST['ProductAgrega']; $cantidad=$_REQUEST['QuantityAgrega']; $stock=$_REQUEST['StockAgrega'];
    addProduct($producto, $cantidad, $stock);
}
function CarritoOut(){
    session_unset();
    session_destroy();
}
function foto($flag, $reg2){
    if($flag){
        return $reg2;
    }
    else return 0;
}

function addProduct($producto, $cantidad, $stock){
if (!isset($_SESSION['items'])) {
  $_SESSION['items'] = array();
}
$producto=intval($producto);
$cantidad=intval($cantidad);
if(addProductVerification($producto,$cantidad,$stock)){
    $_SESSION['items'][] = array('ID' =>$producto, 'Cantidad' => $cantidad);
}
}
function addProductVerification($producto,$cantidad,$stock){
    foreach($_SESSION['items'] as $indice => $arreglo){
        foreach($arreglo as $key => $value){
            if ($key=='ID'){
                if($value==$producto){
                    if($_SESSION['items'][$indice]['Cantidad'] + $cantidad > $stock){
                        $cantMax=$stock - $_SESSION['items'][$indice]['Cantidad'];
                        $_SESSION['items'][$indice]['Cantidad']+=$cantMax;
                    }
                    else{
                        $_SESSION['items'][$indice]['Cantidad']+=$cantidad;
                    }
                    return false;
                }
            }
        }
    }
    return true;
}
?>