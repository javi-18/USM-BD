<?php

use LDAP\Result;

function boleano ($valor){
    if($valor == 1){
        return "SI";
    }
    elseif($valor == 2){
        return "NO";
    }
    else{
        return "nose sabe";
    }
}

// funciones create- upgrade-delete

function add ($tabla,$variables,$datos){
    $querry='INSERT INTO '.$tabla.' '.$variables.' VALUES '.$datos.'';
    return ($querry);;

}

function edit($tabla ,$nuevoValor,$id){
    $sql = "UPDATE '$tabla' SET columna = '$nuevoValor' WHERE id = '$id'";
    return $sql;


}


function remove($id,$tabla,$condicion){
    $querry="DELETE FROM ".$tabla." WHERE ".$condicion."=".$id.";";
    return ($querry);
}










?>