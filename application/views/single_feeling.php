<?php //var_dump($data); ?>
   <div class="single-feeling--wrapper">
    <p>Item ID: <?php echo $data['id']; ?></p>
    <p>Your feeling level: <?php echo $data['rating'] ?></p>
    <p>Time: <?php echo date('d/m/Y h:i', $data['time']); ?></p>
</div>