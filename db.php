<?php
// conexion a base de datos
    session_start();
    
    $conn = mysqli_connect(
        'localhost',
        'root',
        '',
        'gestor_de_tareas'
    );
   
?>