<?php

$pagina= isset($_GET['p']) ? strtolower($_GET['p']) : 'inicio';
require_once 'header.php';
require_once $pagina.'.php';
require_once 'footer.php';
?>