<form method="POST" class="add-form">
    
    <select>
        <option>Feeling</option>
    </select>
   
    <label for="rating"></label>
    <select name="rating">
        <option>1</option>
        <option>2</option>
        <option selected>3</option>
        <option>4</option>
        <option>5</option>
    </select>
    
    <input type="hidden" name="type" value="feeling">
    <input type="hidden" name="user_id" value="1">
    
    <input type="submit" class="btn">
    
</form>