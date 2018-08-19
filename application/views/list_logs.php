<?php 

$today = date("d/m/Y");

$timestamp = time();

$beginofday = strtotime("midnight", $timestamp);

//var_dump($beginofday);

//var_dump(strtotime("- 1 day", $beginofday));

?>

<div class="feelings-wrapper">

    <?php foreach($logs as $key =>$log): 

    $time = date('m/d/Y H:i', $log['time']);

    ?>

    <div class="feeling">

           <a href="<?php echo base_url('/feeling/' . $log['id']); ?>">
                <button class="feeling-edit">[edit]</button>
            </a>

        <p>Type: <?php echo $log['type_name'];  ?></p>
        <p>Feeling: <?php echo $log['rating']; ?></p>
        <p>Time: <?php echo $time; ?></p>

    </div>

<?php endforeach; ?>
    
</div>
