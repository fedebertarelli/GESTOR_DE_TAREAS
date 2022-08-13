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