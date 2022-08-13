<?php
// buscar categorias

    $query="SELECT * FROM categoria";
    $result_categoria= mysqli_query($conn, $query);
    
    while($rowC = mysqli_fetch_array($result_categoria)) { ?>
        <div class="form-check form-check-inline">
            <input class="form-check-input get_value" type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $rowC['idcategoria'] ?>">
            <label class="form-check-label" for="inlineCheckbox1"><?php echo $rowC['categoria'] ?></label>
        </div>

        
<?php } ?> 