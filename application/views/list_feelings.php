<?php

foreach($feelings as $key =>$feeling): 

$time = date('m/d/Y h:i', $feeling['time']);

?>

<div class="feeling">
    
       <a href="<?php echo base_url('/feeling/' . $feeling['id']); ?>">
            <button class="feeling-edit">[edit]</button>
        </a>

    <p>Feeling: <?php echo $feeling['rating']; ?></p>
    <p>Time: <?php echo $time; ?></p>
    


</div>


<?php endforeach; 