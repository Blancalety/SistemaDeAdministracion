<?php
define("HOST",'localhost:3307');
define("BD",'d02');
define("USER_BD",'root');
define("PASS_BD",'');
//nombre de la constante, valor

function conecta(){
    $con =new mysqli(HOST, USER_BD, PASS_BD, BD);
    return $con;
}
//archivo que se conecte a la bd para listar los empleados
?>