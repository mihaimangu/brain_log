<form method="POST" class="new-log--wrapper">
    
    <div class="new-log--row">    
        <select>
            <option>Feeling</option>
        </select>
    </div>
   
   <div class="new-log--row">
        <label for="rating"></label>
        <select name="rating">
            <option>1</option>
            <option>2</option>
            <option selected>3</option>
            <option>4</option>
            <option>5</option>
        </select>
   </div>

   <div class="new-log--row">
        <input type="hidden" name="type" value="1">
        <input type="hidden" name="user_id" value="1">

        <input type="submit" class="btn">
   </div>
    
   
    
</form>