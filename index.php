
<?php
include("db.php")
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <script src="https://kit.fontawesome.com/75675ff3ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class ="row">
        <div class="col-12 my-5">
            <h1>Gestor de tareas</h1>
        </div>
    </div>
    <div>
        <form id="task-form">
            <div class="form-group">    
                <div class="row">     
                    <div class="col-8">
                        <input type="txt" id="newTask" name="newTask" class="form-control" placeholder="Nueva tarea...">
                    </div>
                    <div class="col-3" style="text-align: center;">
                        <?php 
                        include("search_categoria.php");
                        ?>   
                    </div>
                    <div class="col-1" style="text-align: end;">
                        <button type="submit" id="save_task" name="save_task" class="btn btn-primary btn-block"> Añadir </button>                 
                    </div>
                </div>                          
            </div>
        </form>
        </div>  
        <table class="table table-striped table-hover mt-5" style="border: 1px solid black;">
            <thead style="background-color: darkgreen;"></thead>    
                <tr>
                    <th class="columnastabla" >Tarea</th>
                    <th class="columnastabla">Categoria</th>
                    <th class="columnastabla">Acciones</th>
                </tr>
            </thead>
            <tbody id="tasks"></tbody>
       
        </table>
        
    </div>
</div>
<script src='https://cdn.jsdelivr.net/lodash/4.17.2/lodash.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="app.js"></script>  
</body>
</html>