
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
<script>
    $(function(){
    
   fetchTasks();

//envio la nueva tarea para almacenar en tabla tarea y registro y la categoria para alcemanar  en tabla registro
    $('#task-form').submit(function(e){

        var categoria =[];
        $('.get_value').each(function(){
            if($(this).is(":checked")){
                categoria.push($(this).val());
            }
        });
     

        const postData = {
            name:$('#newTask').val(),
            categoria : categoria
        };
        
            
       $.post('save_task.php', postData, function(response){

            fetchTasks();
            $('#task-form').trigger('reset'); // limpia el formulario despues de enviarlo                 
         
        });    
        alert("Tarea añadida correctamente");
        e.preventDefault(); // cancela el comportamiento por defecto del evento submit evitando que la pagina se refresque
    });

// funcion para mostrar la tabla con tareas y categorias
   function fetchTasks(){
       $.ajax({
            url : 'registro.php',
            type : 'GET',
            dataType: "json",
            success : function(tasks){
                    
              console.log(tasks);
              let template ='';             
             
              Object.keys(tasks).forEach(function(id) {
                    template += `
                    <tr taskId="${id}">
                        <td class="tarea">${tasks[id].nombre}</td>
                        <td style="text-align: center;">`;
                        tasks[id].aCategoria.forEach(function(categoria){
                        template+=`<button class="categoria" >
                            ${categoria} </button>`
                        });
                        
                        template += ` 
                        </td>                       
                        <td class="eliminar">
                            <button class="task-delete btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>                      
                    </tr>
                    `
                    }); 

             $('#tasks').html(template);
            }
        });
        
    }
//funcion para eliminar
    $(document).on('click', '.task-delete', function(){
        let element = $(this)[0].parentElement.parentElement; // accedo al elemeto 0 del this (elemento clickleado) que es el button y de ahi accedo al padre es el td y despues al padre que es el tr
        let id = $(element).attr('taskId');  //accedo al atributo taskId para obtener el id
            if(confirm("¿Estas seguro que deseas eliminar la tarea selecionada?")){
                $.post('delete_task.php', {id}, function(response){
                    fetchTasks();                                        
                })
            alert("Su tarea ha sido eliminada");
        }
    })
});
</script>  
</body>
</html>