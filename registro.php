<?php 

    include('db.php');

    $query= "
    SELECT idtarea, tarea, categoria
    FROM tarea T
    INNER JOIN registro R ON R.fk_idtarea = T.idtarea
    INNER JOIN categoria C ON R.fk_idcategoria = C.idcategoria";

    $result= mysqli_query($conn, $query);

    if(!$result) {
        die('Query Failed');
        
    }
    
    $aTareas = array();

    while($row = mysqli_fetch_array($result)){    
            $aTareas[$row['idtarea']]['nombre'] = $row['tarea'];
            $aTareas[$row['idtarea']]['aCategoria'][] = $row['categoria'];
    }
    
    $json = json_encode($aTareas);

    echo $json;
    
    
?>