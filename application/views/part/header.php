<!doctype html>
<html>
<head>
    <title>Brain Log</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link type="text/css" href="<?php echo base_url('/assets/css/main.css'); ?>" rel="stylesheet">
   

</head>

<body>

<?php if(!(isset($show_menu) && !$show_menu == 'false')): ?>
<div class="menu">
    <ul>
        <li class="menu-element">
            <a href="<?php echo base_url(); ?>">Show</a>
        </li>
        
        <li class="menu-element">
            <a href="<?php echo base_url('/track'); ?>">Track</a>
        </li>
    </ul>
</div>
<?php endif; ?>