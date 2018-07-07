<?php 

$today = date("d/m/Y");

$timestamp = time();

$beginofday = strtotime("midnight", $timestamp);

//var_dump($beginofday);

//var_dump(strtotime("- 1 day", $beginofday));

?>

<div class="feelings-wrapper">


    <?php foreach($feelings as $key =>$feeling): 

    $time = date('m/d/Y H:i', $feeling['time']);

    ?>

    <div class="feeling">

           <a href="<?php echo base_url('/feeling/' . $feeling['id']); ?>">
                <button class="feeling-edit">[edit]</button>
            </a>

        <p>Feeling: <?php echo $feeling['rating']; ?></p>
        <p>Time: <?php echo $time; ?></p>



    </div>



<?php endforeach; ?>
    
</div>
