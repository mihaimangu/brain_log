<?php //var_dump($data); ?>
   <div class="single-feeling--wrapper">
    <p>Item ID: <?php echo $data['id']; ?></p>
    <p>Your feeling level: <?php echo $data['rating'] ?></p>
    <p>Time: <?php echo date('d/m/Y H:i', $data['time']); ?></p>
    <form method="POST" action="">
        <input type="submit" value="delete">
        <input type="hidden" name="delete" value="true">

    </form>
    
</div>