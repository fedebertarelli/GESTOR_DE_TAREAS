<?php

//secuencia para eliminar tabla

include("db.php");

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $queryRegistro = "DELETE FROM registro WHERE fk_idtarea= $id";
    $resultRegistro = mysqli_query($conn, $queryRegistro);

    if(!$resultRegistro){
        die("Query Failed");
    }


    $query = "DELETE FROM tarea WHERE idtarea = $id";
    $result= mysqli_query($conn,$query);
    if(!$result){
        die("Query Failed");
    }

    echo "Tarea Elimnada correctamente";

}

?>