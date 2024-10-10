

<?php
function datasubmitted(){
    $datos = array();	
    foreach($_POST as $key => $value){
        $datos[$key] = $value;
    }
    foreach($_GET as $key => $value){
        $datos[$key] = $value;
    }
    return $datos;
}