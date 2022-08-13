<?php
// secuancia para guardar tarea y registros

include("db.php");

if(isset($_POST['name'])){
    $tarea = $_POST['name'];
    $categoria =$_POST['categoria'];

    $query = "INSERT INTO tarea(tarea) VALUES ('$tarea')";  
    $result= mysqli_query($conn,$query);
    if(!$result){
        die("Query Failed");
    }



   $queryTarea= "SELECT idtarea FROM tarea WHERE tarea = '$tarea'" ;
    $resultTarea =mysqli_query($conn, $queryTarea);

    $row = mysqli_fetch_array($resultTarea);
    $tareaId = $row['idtarea'];
        
        foreach($categoria as $llave => $valor){
            $queryRegistro = "INSERT INTO registro(fk_idtarea,fk_idcategoria) VALUES('$tareaId','$valor') ";
            $resultRegistro= mysqli_query($conn, $queryRegistro);
            
        }

        if(!$resultRegistro){
            die("Query Failed");
        }

   
    echo 'guardado';
}


?>


