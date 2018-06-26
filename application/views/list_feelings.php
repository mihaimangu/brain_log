<?php

foreach($feelings as $key =>$feeling): 

$time = date('m/d/Y h:m', $feeling['time']);

?>



<div class="feeling">

    <p>Feeling: <?php echo $feeling['rating']; ?></p>
    <p>Time: <?php echo $time; ?></p>

</div>


<?php endforeach; 