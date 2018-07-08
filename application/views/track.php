<div class="new-log--wrapper">
    <form method="POST">

       <div class="new-log--row">
            <select name="type">
          
                <?php foreach($types as $key => $type): ?> 
                    
                    <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                    
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="new-log--row">
             <input type="text" name="measurement" required>
        </div>
       
        <input type="submit">

    </form>
    
    
    <a href="<?php echo base_url('new-influent'); ?>">
        <p>Add new influent</p>
    </a>
</div>